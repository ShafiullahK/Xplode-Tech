<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title> Collect Fee To  - Xplode Academy Management System</title>
</head>
<body style="hight:100vh">
    <div class="container-fluid">
        <div class="row">

        <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

            <div class="col-sm-10 main-area" id="right-area">

            <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

            <?php require_once  '../layouts/errors.php'; ?>

                <div class="container mt-3">
                    <div class="row">
                    <?php

                        $student = $_GET['id'];

                        include_once dirname(__DIR__) . '/classes/collect_fee.php';
                        $collect = new Collect_Fee();

                        $sql = "SELECT courses.name , students.* FROM `students` INNER JOIN `courses` ON students.course_id = courses.id WHERE students.id = :student_id";

                        $res = $collect->getStudent($sql , $student);


                        

                        ?>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header" style="background:black; color:#fff"><i class="fas fa-user"></i> STUDENT INFO</div>
                                <div class="card-body">
                                    <div class="row justify-content-sm-center"id="student_info">
                                        <div class="col-sm-2">
                                            <div id="image-wrapper"
                                                style="background: url(<?php echo ! empty($res['image']) ? 'uploads/'. $res['image'] : 'uploads/default.jpg' ?>) no-repeat; background-size:cover; background-position:center;">
                                            
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-5">
                                            <h6>
                                                <a href="students/show.php?id=<?php  echo $res['id'];  ?>" style="text-decoration:none;"><?php echo $res['sname'];   ?></a>
                                            </h6>
                                            <span>
                                                    Course:    
                                                    <?php echo $res['name'];    ?></span>
                                                
                                                <span>
                                                        Admission No:
                                                    <?php  echo $res['admission_no'];   ?>
                                                </span>
                                                
                                                <span>
                                                        Date Of Birth:
                                                    <?php  echo $res['dob'];   ?>
                                                </span>
                                                
                                                <span>
                                                    Gander:
                                                    <?php echo $res['gander'];   ?></span>
                                            </div>
                                            <div class="col-sm-5">
                                                <br><br>

                                                <span>
                                                        Mobile No:
                                                    <?php echo $res['phone'];   ?>
                                                </span>
                                                
                                                <span>
                                                    CNIC No:
                                                    <?php  echo $res['cnic'];   ?>
                                                </span>
                                                
                                                <span>
                                                        Date Of Admission:
                                                        <?php echo $res['fcnic'];    ?>
                                                </span>
                                                
                                                <span>
                                                        Current Address:
                                                    <?php  echo $res['address'];   ?>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <!-- Search result -->
                                <div class="card">
                                    <div class="card-header" style="background:black; color:#fff">
                                        FEE RECORDS
                                        <button class="btn btn-print btn-sm btn-light no-print" title="print" id="printBtn">
                                            <i class="fa fa-print"></i>
                                        </button>

                                        <script>

                                                $(document).ready(function() {
                                                $("#printBtn").click(function(e) {
                                                    $("#sidebar-toggler").addClass("no-print");
                                                    e.preventDefault();

                                                // Print mode
                                                $(".sidebar").css({ display: "none" });
                                                $("#right-area")
                                                    .removeClass("col-sm-10")
                                                        .addClass("col-sm-12");

                                                window.print();

                                                // Normal mode
                                                $(".sidebar").css({ display: "block" });
                                                $("#right-area")
                                                    .addClass("col-sm-10")
                                                    .removeClass("col-sm-12");
                                                });

                                            });

                                         </script>

                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table  table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Fee Group</th>
                                                        <th>Fee Type</th>
                                                        <th>Due Date</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Payment ID</th>
                                                        <th>Date</th>
                                                        <th>Paid</th>
                                                        <th>Fine</th>
                                                        <th>Discount</th>
                                                        <th>Balance</th>
                                                        <th><i class="fas fa-plus"></i></th>
                                                    </tr>
                                                </thead>
                                                <?php

                                                    include_once dirname(__DIR__) . '/classes/collect_fee.php';
                                                    $collect = new Collect_Fee();

                                                    $student = $_GET['id'];

                                                    $sql = "SELECT DISTINCT fee_groups.fee_group ,  fee_types.fee_type , assign_fee.amount , assign_fee.date , `master`.payment, `master`.paid , `master`.due_date ,`master`.fine , `master`.discount , `master`.balance ,`master`.amount , `master`.status ,      students.id  as students_id , fee_groups.id as fee_group_id , fee_types.id as fee_type_id FROM `master` INNER JOIN `fee_groups` ON `master`.fee_group_id = fee_groups.id  INNER JOIN fee_types ON `master`.fee_type_id = fee_types.id INNER JOIN assign_fee ON `master`.fee_type_id = assign_fee.fee_type_id AND `master`.fee_group_id = assign_fee.fee_group_id INNER JOIN `students` ON `master`.student_id = students.id WHERE students.id = :students_id";

                                                    $collect->dataView($sql , $student);

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
    
</body>
</html>