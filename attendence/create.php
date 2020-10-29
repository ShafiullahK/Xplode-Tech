<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title>Student Attendence To - Xplode Academy Management System</title>
</head>
<body style="height :100vh">
    <div class="container-fluid">
        <div class="row">

        <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

            <div class="col-sm-10 main-area">
            <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

            <?php require_once  '../layouts/errors.php'; ?>
                <!-- main-content -->
                <div class="container mt-3">
                    <div class="row">
                         <!--student search form  -->
                        <div class="col-sm-12">
                            <div class="card no-print">
                                <div class="card-header" style="background:black; color:#fff">SEARCH STUDENTS</div>
                                <div class="card-body">
                                <?php
 
                                        // Validation 
                                        $error_name = [];

                                        if(isset($_POST['search'])){ 

                                                $course_id = $_POST['course_id'];
                                                $date = $_POST['date'];
 
                                            // Required Check
                                            if(empty($course_id)){

                                                $error_name['course_id'] = "<p style='color:red'>Course field  is required</p>";
                                                
                                             }

                                                // Required Check
                                             if(empty($date)){

                                                $error_name['date'] = "<p style='color:red'>Date field is required</p>";

                                              }



                                              


                                        }

                                        ?>

                                    <form action="attendence/create.php" method="post">
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="course_id"><b>Search by Course</b></label>
                                                    <select name="course_id" id="course_id" class="form-control">
                                                        <?php

                                                            include_once dirname(__DIR__) . '/classes/attendence.php';
                                                            $attendence = new Student_attendence();
                                                            
                                                            $sql = "SELECT * FROM `courses`";
                                                            $attendence->getCourses($sql);

                                                        ?>
                                                    </select>
                                                    
                                                    <?php
                                                        echo @$error_name['course_id'];
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group mt-4">
                                                    <input type="date" name="date" id="date" class="form-control" value="<?php echo @$_SESSION['date'];  ?>">
                                                        <div class="input-group-append">
                                                        <button type="submit" name="search" class="btn btn-dark">Search</button>
                                                    </div>
                                                    
                                                </div>
                                                <?php
                                                        echo @$error_name['date'];
                                                    ?>
                                            
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                     
                                            <?php

                                                

                                                // Find length

                                                 $length = count($error_name);

                                                if(isset($_POST['search']) && $length === 0){

                                                    // SET SESSION 
                                                    $_SESSION['course_id'] = $course_id;
                                                    $_SESSION['date'] = $date;


                                               $record =  $attendence->getRecords($course_id , $date); 

                                                 // unset SESSION  
                                                 unset($_SESSION['coutse_id']); 
                                                 unset($_SESSION['date']);

                                               $a = $record[0]['name'];

                                               

  
                                      
                                      ?>

                            </div>
                                
                                <div class="card mt-3">
                                    <div class="card-header" style="background:black; color: #fff">
                                        STUDENT ATTENDENCES
                                        <button class="btn btn-print btn-sm btn-light no-print float-right" id="printBtn" title="print">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </div>
                                    <div class="card-body">

                                    <!-- cheching admin and user -->
                                    <?php if($role === 'super_admin'){    ?>
                                        <button class="btn btn-sm btn-secondary no-print" id="mark-attendence">
                                                <i class="fas fa-save"> Mark Attendence</i>   
                                        </button>
                                        <button class="btn btn-sm btn-warning no-print" id="mark-as-hd">
                                                <i class="fas fa-save"> Mark as Holiday</i>
                                        </button>
                                    <?php }  ?>
                                        
                                        <script src="js/students_attendence.js"></script>

                                        <!-- Students Attendence -->
                                        <div class="table-responsive attendence-table">
                                            <div id="result"></div>
                                               <!-- Print -->
                                               <h6 class="mb-2 only-print mt-4">
                                                   Course:
                                                   <span class="text-success"><?php echo $a;  ?></span>
                                                   Date:
                                                   <span class="text-success"><?php  echo $date;  ?></span>

                                               </h6>
                                               
                                            <table class="table table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>S#</th>
                                                        <th>Student Name</th>
                                                        <th>Father's Name</th>
                                                        <th>Phone No.</th>
                                                        <th>Attendence</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                            $i = 0;
                                                        foreach($record as $r):
                                                            ?>
                                                                <!-- Date -->
                                                             <tr>
                                                                <input type="hidden" name="date" id="att-date" value="<?php echo $r['student_attendences_date'];  ?>">
                                                                 <td><?php echo ++$i;  ?></td>
                                                                 <td><?php echo $r['sname'];  ?></td>
                                                                 <td><?php echo $r['fname'];  ?></td>
                                                                 <td><?php echo $r['phone'];  ?></td>
                                                                
                                                                 <td class="<?= $r['attendence_type_id'] === '5' ? 'holiday-td' : '' ?>"> 
                                                                    <!-- Select  -->
                                                                    <?php 
                                                                    
                                                                        $stTyID = $r['student_attendenc_id'];
                                                                    
                                                                     $sql = "SELECT * FROM `student_attendences` WHERE id = :student_type_id";

                                                                     $attnc =  $attendence->selectID($sql , $stTyID);                                     
                                                                        
                                                                    
                                                                    ?>


                                                                    <input  class="att-type" type="radio" name="att_type<?php echo $r['student_attendenc_id'];  ?>"  value="1-<?php echo $r['student_attendenc_id'];   ?>" <?php echo $attnc['attendence_type_id'] === '1' ? 'checked' : '' ?>>

                                                                    <label for="att_type<?php echo $r['student_attendenc_id'];  ?>">Present</label>

                                                                    <input  class="att-type" type="radio" name="att_type<?php echo $r['student_attendenc_id'];  ?>" value="2-<?php echo $r['student_attendenc_id']  ?>" <?php echo $attnc['attendence_type_id'] === '2' ? 'checked' : '' ?>>

                                                                    <label for="att_type<?php echo $r['student_attendenc_id'];  ?>">Absent</label>

                                                                    <input  class="att-type" type="radio" name="att_type<?php echo $r['student_attendenc_id'];  ?>" value="3-<?php echo $r['student_attendenc_id'];  ?>" <?php echo $attnc['attendence_type_id'] === '3' ? 'checked' : '' ?>>

                                                                    <label for="att_type<?php echo $r['student_attendenc_id'];  ?>">Late</label>

                                                                    <input  class="att-type" type="radio" name="att_type<?php echo $r['student_attendenc_id'];  ?>" value="4-<?php echo $r['student_attendenc_id']  ?>" <?php echo $attnc['attendence_type_id'] === '4' ? 'checked' : '' ?>>

                                                                    <label for="att_type<?php echo $r['student_attendenc_id'];  ?>">Half Day</label>
                                                           
                                                                 </td>
                                                             </tr>

                                                            <?php
                                                    
                                                        endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                              

                                                    <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/print.js"></script>
</body>
</html>