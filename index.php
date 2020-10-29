<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){

    exit(header('location:login.php'));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once  'layouts/header.php' ?>
     <link rel="stylesheet" href="css/fa/css/all.css">
     <link rel="stylesheet" href="css/app.css">

    <title>Index</title>
</head>
<body>
        <div class="container-fluid">
            <div class="row">
                <?php require_once "layouts/sidebar.php"   ?>
                <div class="col-sm-10 main-area">
                    <?php require_once "layouts/navbar.php" ?>

                    <!-- Main content goes here -->
                    <div class="container">
                        <div class="row cards mt-4">
                            <div class="col-sm-6">
                                <div class="card total-student">
                                    <div class="card-body">
                                        <i class="fas fa-user-tie fa-6x"></i>

                                        <?php include_once 'classes/index.php';

                                            $index = new Index();

                                            $sql = "SELECT * FROM `students`";
                                            $student = $index->getStudents($sql);

                                        ?>

                                        <h3 class="display-5"><?php  echo $student;  ?></h3>
                                        <footer>Total Students</footer>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card total-usesrs">
                                    <div class="card-body">
                                        <i class="fas fa-user-alt fa-6x"></i>

                                        <?php include_once 'classes/index.php';

                                            $index = new Index();

                                            $sql = "SELECT * FROM `users`";
                                            $user = $index->getUsers($sql);

                                        ?>
                                        <h3 class="display-5"><?php echo $user;   ?></h3>
                                        <footer>Total Users</footer>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row cards mt-4">
                                <div class="col-sm-6">
                                    <div class="card fee-collected">
                                        <div class="card-body">
                                            <i class="fas fa-dollar-sign fa-6x"></i>
                                            <h3 class="display-5">
                                            <?php include_once 'classes/index.php';

                                                    $index = new Index();

                                                    $sql = "SELECT SUM(`paid`) as total FROM `payment` WHERE MONTH(`date`) = :cm AND YEAR(`date`) = :cy";

                                                    $month = date('m');
                                                    $year = date('Y');
                                                    

                                                    $fee = $index->getFee($sql , $month , $year);

                                                    echo number_format(($fee));

                                                    ?>
                                            </h3>
                                            <footer>Fee Collected this month</footer>
                                        </div>
                                    </div>    
                                </div>
                                <div class="col-sm-6">
                                    <div class="card fee-expenses">
                                        <div class="card-body">
                                            <i class="fas fa-euro-sign fa-6x"></i>
                                            <h3 class="display-5">
                                            <?php include_once 'classes/index.php';

                                                $index = new Index();

                                                $sql = "SELECT SUM(amount) as total FROM `expenses` WHERE MONTH(`date`) = :cm AND YEAR(`date`) = :cy";


                                                $cm = date('m');
                                                $year = date('Y');


                                                $expenses = $index->getExpenses($sql , $cm , $year);

                                                   echo number_format($expenses);

                                                ?>
                                                 
                                            </h3>
                                            <footer>Expenses this month</footer>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Chart -->
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <figure class="highcharts-figure">
                                                <div id="fee_chart"></div>
                                            </figure>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <figure class="highcharts-figure">
                                                    <div id="expense_chart"></div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="./../../xplode-tech/js/highcharts.js"></script>
        <script src="./../../xplode-tech/js/exporting.js"></script>
        <script src="./../../xplode-tech/js/export-data.js"></script>
        <script src="./../../xplode-tech/js/fee_chart.js"></script>
        <script src="./../../xplode-tech/js/expense_chart.js"></script>
</body>
</html>