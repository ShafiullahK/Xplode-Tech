<?php

if(session_status() === PHP_SESSION_NONE){

    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__ . '/../layouts/header.php' ?>
    <title>Courses - Xplode Academy Management System</title>
</head>
<body style="height: 100vh">
   <div class="container-fluid">

       <div class="row">
           <?php require_once __DIR__ . '/../layouts/sidebar.php'; ?> 

           <div class="col-sm-10 main-area">
                <?php require_once __DIR__ . '/../layouts/navbar.php'; ?> 

                <div class="container mt-3">
                    <div class="row">
                        <div class="col-sm-12">

                            <?php require_once  __DIR__ . '/../layouts/errors.php'; ?>

                           
                                    <!-- Update message show -->
                                        <div class="container">
                                        <?php

                                        if(isset($_GET['update'])){
                                            ?>
                                            <div class="alert alert-success"role="alert"><strong>Course updated Successfully</strong></div>
                                            <?php
                                        }

                                        ?>
                                        </div>
                                        <div class="container">
                                        <?php

                                        if(isset($_GET['notupdate'])){
                                            ?>
                                            <div class="alert alert-danger"role="alert"><strong>Course Not updated Successfully</strong></div>
                                            <?php
                                        }

                                        ?>
                                        </div>
                                        <!-- Update message end -->

                                         <!-- Delete message show -->
                                         <div id="delete"></div>
                                    <!-- Delete message end -->

                            <div class="card">
                                <div class="card-header">Courses</div>
                                <div class="card-body">
                                   <div class="table-responsive">
                                        <table id="cour"class="table table-hover" style="width:100%">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Course Name</th>
                                                    <th>Course Code</th>
                                                    <th>Duration</th>
                                                    <th>Fee</th>
                                                    <?php  if($role === 'super_admin'){   ?>
                                                    <th class="no-print">Actions</th>
                                                </tr>
                                                    <?php  }  ?>
                                            </thead>

                                            <?php

                                                include_once "../classes/courses.php";

                                                $course = new Courses();

                                                $sql = "SELECT * FROM `courses`";

                                                $course->dataView($sql , $role);

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