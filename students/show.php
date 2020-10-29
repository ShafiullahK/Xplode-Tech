<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) . '/layouts/header.php';   ?>
    <title>Students - Xplode Academy Management System</title>
</head>
<body style="height: 100vh">
    <div class="container-fluid">
        <div class="row">
            <?php require_once '../layouts/sidebar.php';    ?>

            <div class="col-sm-10 main-area">
                <?php  require_once '../layouts/navbar.php';   ?>
                <div class="container mt-3">
                    <div class="row">

                        <?php
                                include_once "../classes/students.php";
                                $student = new Students();

                                if(isset($_GET['id'])){

                                    $id = $_GET['id'];

                                    $show = $student->ShowStudents($id);

                                }
                            ?>
                        <div class="col-sm-12">
                           <div class="row mt-3">
                                <!--left Intro  -->
                               <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                          <div class="row justify-content-center"> 
                                            <div id="image-wrapper" style="background: url(<?php echo ! empty($show['image']) ? 'uploads/'. $show['image'] : 'uploads/default.jpg' ?>) no-repeat; background-size:cover; background-position:center; border-radius:50%; border:3px solid lightgray; width:110px; height:110px;"></div>
                                       </div> 
                                            <h5 class="text-center mt-2"><?php echo $show['sname'];  ?>
                                            <br>
                                            <br>
                                                <?php  if($role    === 'super_admin'){  ?>
                                            <a href="students/edit.php?id=<?php  echo $show['id'];   ?>" class="btn btn-sm btn-light"><i class="fas fa-pencil-alt"></i></a>
                                                <?php  } ?>
                                            </h5>

                                            <ul class="list-group student-info-list mt-4 list-group-flush">
                                                 <li class="list-group-item" style>
                                                        <strong>Admission No.</strong>
                                                        <span style="float: right"><?php  echo $show['admission_no'];   ?></span>
                                                  </li>
                                                  <li class="list-group-item">
                                                    <strong>Course</strong>
                                                    <span style="float: right; font-size:90%"><?php  echo $show['name'];   ?></span>
                                                </li>
                                                <li class="list-group-item" style>
                                                    <strong>Phone No</strong>
                                                    <span style="float: right"><?php  echo $show['phone'];   ?></span>
                                                </li>
                                                <li class="list-group-item" style>
                                                    <strong>Gender</strong>
                                                    <span style="float: right"><?php  echo $show['gander'];   ?></span>
                                                </li>
                                                
                                            </ul>
                                            
                                        </div>
                                    </div>
                               </div>
                               <div class="col-sm-9">
                                <div class="card">
                                    <div class="card-header">BASIC DETAILS</div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Student CNIC </td>
                                                        <td><?php  echo $show['cnic'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Admission Date</td>
                                                        <td><?php echo $show['fcnic'];    ?></td>
                                                    </tr>
                                                    <tr>
                                                    <tr>
                                                        <td>Father Mobile No</td>
                                                        <td><?php echo $show['fphone'];   ?></td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td>Date Of Birth</td>
                                                        <td><?php echo $show['dob'];    ?></td>
                                                    </tr>
                                                        <tr>
                                                            <td>Amount</td>
                                                            <td><?php echo $show['fee_amount'];    ?></td>
                                                        </tr>
                                                      <tr>
                                                          <td>Discount</td>
                                                          <td><?php echo $show['discount'];   ?></td>
                                                      </tr>  
                                                    <tr>
                                                        <td>Address</td>
                                                        <td><?php echo $show['address'];   ?></td>
                                                    </tr>
                                                            <td>Source Of Awareness</td>
                                                            <td><?php echo $show['sourse'];   ?></td>
                                                        </tr>
                                                    <tr>
                                                        <td>Refrence</td>
                                                        <td><?php  echo $show['refrence'];   ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Education</td>
                                                        <td><?php  echo $show['education'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>School</td>
                                                        <td><?php echo $show['school'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Previous Course</td>
                                                        <td><?php  echo $show['previous'];  ?></td>
                                                    </tr>
                                                </tbody>
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
        </div>
    </div>
</body>
</html>