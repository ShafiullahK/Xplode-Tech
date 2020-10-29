<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title>Add Expenses To  - Xplode Academy Management System</title>
</head>
<body style="height :100vh">
    <div class="container-fluid">
        <div class="row">
             <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

            <div class="col-sm-10 main-area">
                <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

                <?php require_once  '../layouts/errors.php'; ?>

               <div class="container">
                    <h4 class="mt-4">Users</h4>
                   <div class="row">
                       <div class="col-sm-4">

                     <?php  include_once dirname(__DIR__). '/lib/expenses/create.php'  ?>

                        <!-- Add users -->
                        <div class="card">
                            <div class="card-header" style="background:black; color:#fff">ADD EXPENSE</div>
                            <div class="card-body">
                                <form action="expenses/create.php" method="post">
                                    <div class="form-group">
                                        <label for="title"><b style="color:red">*</b> Title</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" autocomplete="off" value="<?php echo @$_SESSION['title'] ?>">

                                        <?php
                                              echo @$error_name['title'];
                                         ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount"><b style="color:red">*</b> Amount</label>
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="amount" autocomplete="off" value="<?php echo @$_SESSION['amount'] ?>">

                                        <?php
                                              echo @$error_name['amount'];
                                         ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="date"><b style="color:red">*</b> Date</label>
                                        <input type="date" name="date" id="date" class="form-control" autocomplete="off" value="<?php echo @$_SESSION['date'] ?>">

                                        <?php
                                              echo @$error_name['date'];
                                         ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="description"><b style="color:red">*</b> Description</label>
                                       <textarea name="description" id="description" rows="4" class="form-control" placeholder="Description" value="<?php echo @$_SESSION['description'] ?>"></textarea>

                                       <?php
                                              echo @$error_name['description'];
                                         ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="select"><b style="color:red">*</b> Select</label>
                                        <br>
                                        <input type="radio" id="primary" name="pt" value="primary"checked>
                                            <label for="primary">Primary</label>
                                            
                                            <input type="radio" id="temporary" name="pt" value="temporary">
                                            <label for="temporary">Temporary</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" value="ADD EXPENSE" class="btn btn-primary btn-sm">
                                        </div>

                                    </div>
                                </form>
                                    
                            </div>
                        </div>


                       
                       
                       <div class="col-sm-8">

                          <!-- Insert Message Start -->
                                <div class="container">
                                <?php
                                    if(isset($_GET['insert'])){
                                        ?>
                                        <div class="alert alert-success"role="alert"><strong>Expense Added Successfully</strong></div>
                                        <?php
                                    }
                                ?>
                                </div>
                                <div class="container">
                                <?php
                                    if(isset($_GET['notinsert'])){
                                        ?>
                                        <div class="alert alert-danger"role="alert"><strong>Sorry Expense not added</strong></div>
                                        <?php
                                    }
                                ?>
                                </div>
                                <!-- Insert Message End -->  
                                <!-- Update message start -->
                                    <div class="container">
                                    <?php
                                    if(isset($_GET['update'])){
                                        ?>
                                        <div class="alert alert-success"role="alert"><strong>Expense updated Successfully</strong></div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <div class="container">
                                    <?php
                                    if(isset($_GET['notupdate'])){
                                        ?>
                                        <div class="alert alert-danger"role="alert"><strong>Sorry Expense not Updated</strong></div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <!-- Update message end -->
                                    
                                    <!-- Delete message show -->
                                    <div id="delete"></div>
                                    <!-- Delete message end -->
                                

                            <div class="card">
                                <div class="card-header" style="background:black; color:#fff">Expenses</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="cour" class="table  table-hover" style="width:100%">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Expense Title</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>

                                                    <!-- checking admin and user -->
                                                    <?php if($role === 'super_admin'){  ?>
                                                    <th>Actions</th>
                                                </tr>
                                                    <?php  } ?>
                                            </thead>

                                            <?php

                                                include_once dirname(__DIR__) . '/classes/expenses.php';
                                                $expens = new Expenses();

                                                $sql = "SELECT * FROM `expenses`";

                                                $expens->dataView($sql , $role);

                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>

                         </div>
                       </div>
                   </div>
               </div>     
            </div>
        </div>
    </div>
</body>
</html>