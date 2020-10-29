<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title>Attendence Report To - Xplode Academy Management System</title>
</head>
<body style="heigth: 100vh">
    <div class="container-fluid">
        <div class="row">

        <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

            <div class="col-sm-10 main-area">

            <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

            <?php require_once  '../layouts/errors.php'; ?>
                <!-- main-content -->
                <div class="container mt-3">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="card no-print">
                                <div class="card-header bg-dark text-light">SEARCH ATTENDENCE REPORT</div>
                                <div class="card-body">
                                    <?php

                                        $error_name = [];

                                        if(isset($_POST['search'])){
                                            
                                            $course_id = $_POST['course_id'];
                                            $month = $_POST['month'];

                                            // Required Check
                                            if(empty($course_id)){

                                                $error_name['course_id'] = "<p style='color:red'>Course field is required</p>";
                                            }

                                            if(empty($month)){

                                                $error_name['month'] = "<p style='color:red'>Month field is required</p>";
                                            }

                                        }



                                    ?>
                                    <form action="attendence-report/create.php" method="post">
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="course_id"><b>Search by Course</b></label>
                                                    <select name="course_id" id="course_id" class="form-control">
                                                        <?php

                                                            include_once dirname(__DIR__) . '/classes/attendence_report.php';
                                                            $report = new Attendence_report();        

                                                            $sql = "SELECT * FROM `courses`";
                                                            $report->getCourse($sql);

                                                        ?>
                                                    </select>
                                                    <?php
                                                        echo @$error_name['course_id'];
                                                    ?>
                                                </div>
                                            </div>
                                       
                                        
                                            <div class="col-sm-6">
                                                <div class="input-group mt-4">
                                                    <input type="month" name="month" id="month" class="form-control" value="<?php echo @$_SESSION['month'];  ?>">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-dark" name="search">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <?php
                                                // Find length
                                                $length = count($error_name);

                                                if(isset($_POST['search']) && $length === 0){

                                                    // Set session 
                                                    $_SESSION['course_id'] = $course_id;
                                                    $_SESSION['date'] = $month;

                                                    
 

                                                $student = $report->getData($course_id , $month);

                                                 // unset SESSION  
                                                 unset($_SESSION['coutse_id']); 
                                                 unset($_SESSION['date']);

                                                
                                                 

                                                 ?>  
                            </div>

                            <?php if($student != NULL): ?>
                                         
                                         
                                                
                        
                                                 
                            <div class="card mt-3">
                                    <div class="card-header">ATTENDENCE REPORT OF 
                                        Course:
                                        <span class="text-success"><?php  echo $student[0]['name'];  ?></span>
                                        |
                                        Date:
                                         <span class="text-success"><?php echo $month;   ?></span>
                                         <button class="btn btn-light btn-sm no-print float-right" title="Print" id="printBtn">
                                             <i class="fas fa-print"></i></button>
                                     </div>
                                    <div class="card-body">
                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover" id="attendence-report-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>S#</th>
                                                        <th>Student Name</th>
                                                        <th>Father's Name</th>
                                                        <th>Phone No.</th>
                                                        <th>Presents</th>
                                                        <th>Absents</th>
                                                        <th>Lates</th>
                                                        <th>Half Days</th>
                                                        <th>Holidays</th>
                                                        <th>Total Days</th>
                                                        <th>Presence %</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 0;
                                                        foreach($student as $s):
                                                            ?>
                                                            <tr>
                                                                <td><?php echo ++$i;  ?></td>
                                                                <td><?php echo $s['sname'];  ?></td>
                                                                <td><?php echo $s['fname'];  ?></td>
                                                                <td><?php echo $s['phone'];  ?></td>
                                                                <td>
                                                                    <?php
                                                                        $student_id = $s['student_id'];
                                                                        $course_id = $s['course_id'];
                                                                        $student_attendences_date = $_POST['month'];

                                                                        $month = date('m' , strtotime($student_attendences_date));
                                                                        
                                                                        
                                                                        $sql = "SELECT  * FROM student_attendences WHERE attendence_type_id = '1' AND student_id = :student_id AND  course_id = :course_id AND MONTH(`student_attendences`.`date`) = :months";
                                                                        $p = $report->getPresent($sql  ,  $student_id , $course_id , $month);

                                                                            echo $p;
                                                                        
                                                                        ?>
                                                                </td>
                                                                <td>
                                                                    <?php


                                                                        $sql = "SELECT * FROM `student_attendences` WHERE attendence_type_id = '2' AND student_id = :student_id AND course_id = :course_id AND MONTH(`student_attendences`.`date`) = :months";
                                                                        $a = $report->getAbsent($sql , $student_id , $course_id , $month);

                                                                        echo $a;

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                <?php
                                                                        $sql = "SELECT * FROM `student_attendences` WHERE attendence_type_id = '3' AND student_id = :student_id AND course_id = :course_id AND MONTH(`student_attendences`.`date`) = :months";
                                                                        $l = $report->getLates($sql , $student_id , $course_id , $month);

                                                                        echo $l;

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                <?php
                                                                        $sql = "SELECT * FROM `student_attendences` WHERE attendence_type_id = '4' AND student_id = :student_id AND course_id = :course_id AND MONTH(`student_attendences`.`date`) = :months";
                                                                        $h = $report->getHalfday($sql , $student_id , $course_id , $month);

                                                                        echo $h;

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                <?php
                                                                        $sql = "SELECT * FROM `student_attendences` WHERE attendence_type_id = '5' AND student_id = :student_id AND course_id = :course_id AND MONTH(`student_attendences`.`date`) =  :months";
                                                                        $H = $report->getHoliday($sql , $student_id , $course_id , $month);

                                                                        echo $H;

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                <?php
                                                                        $sql = "SELECT  *  FROM `student_attendences` WHERE  student_id = :student_id AND course_id = :course_id AND MONTH(`student_attendences`.`date`) = :months";
                                                                        $t = $report->getTotals($sql , $student_id , $course_id , $month);

                                                                        echo $t;

                                                                    ?>
                                                                </td>

                                                                <?php
                                                                        $Percentage = $p;
                                                                        $totalday = $t;



                                                                        if ($Percentage !== 0 && $totalday !== 0 ) {
                                                                            $a = $Percentage / $totalday;
                                                                        } else {
                                                                            $a = 0;
                                                                        }

                                                                        $pres_per = number_format($a * 100 , 2);


                                                                       

                                                                       ?>
                                                                <td class="text-white <?php  echo $pres_per < 50 ? 'bg-danger' : 'bg-success'; ?> pres-per">
                                                                    <h6 class="text-center">
                                                                        <?php  echo  $pres_per !== 'nan' && $pres_per > 0 ? $pres_per  . '%' : 'N/A' ?>
                                                                    </h6>

                                                                    


                                                                        
                                                                    

                                                                    
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
                                                    <?php  else: ?>
                                                    <h4>No record found</h4>
                                                    <?php  endif;   ?>
                                                     <!--  -->
                        </div>


                        <?php  }  ?>
                        
                    </div>
                </div>
                <!-- End report  -->
            </div>
        </div>
    </div>
    <script src="js/print.js"></script>
</body>
</html>