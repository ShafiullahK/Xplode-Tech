<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php   require_once '../layouts/header.php';    ?>
    <link rel="stylesheet" href="css/bootstrap_file_field.css">
    <title>Add a Student - Xplode Academy Management System</title>
</head>
<body style="height: 100vh">
    <div class="container-fluid">
        <div class="row">
            <?php  require_once "../layouts/sidebar.php";    ?>

            <div class="col-sm-10 main-area">
                <?php require_once "../layouts/navbar.php";   ?>

                  <div class="container mt-3">
                      <div class="row">
                          <div class="col-sm-12">

                          <?php require_once  '../layouts/errors.php'; ?>

                                <!-- insert message show -->
                                    <div class="container">
                                    <?php
                                    if(isset($_GET['success'])){
                                        ?>
                                        <div class="alert alert-success"role="alert"><strong>Student added Successfully</strong></div>
                                        <?php
                                    }

                                    ?>
                                    </div>
                                    <div class="container">
                                    <?php
                                    if(isset($_GET['fail'])){
                                        ?>
                                        <div class="alert alert-danger"role="alert"><strong>Sorry student not added</strong></div>
                                        <?php
                                    }

                                    ?>

                                    </div>
                                    <!-- insert message end -->

                              <?php     require_once dirname(__DIR__) . '/lib/students/create.php';     ?>

                            <div class="card">
                                <div class="card-header"><i class="fas fa-plus"></i> Add Student</div>
                                <div class="card-body">
                                    <form action="students/create.php" method="post" enctype="multipart/form-data">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="admission_no"><b style="color:red">*</b>Admission No.</label>
                                                    <input type="text" name="admission_no" id="admission_no" class="form-control" value="<?php echo @$_SESSION['admission_no'] ?>" placeholder="Admission No." autocomplete="off" >

                                                    <?php
                                                        echo @$error_name['admission_no'];
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="sname"><b style="color:red">*</b>Student Name</label>
                                                    <input type="text" name="sname" id="sname" class="form-control" value="<?php echo @$_SESSION['sname'] ?>" placeholder="Student Name" autocomplete="off" >

                                                    <?php
                                                        echo @$error_name['sname'];
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="fname"><b style="color:red">*</b>Father's Name</label>
                                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="Father Name" value="<?php echo @$_SESSION['fname']   ?>" autocomplete="off" >

                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="phone"><b style="color:red">*</b>Student Phone No.</label>
                                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="<?php echo @$_SESSION['phone']   ?>" autocomplete="off" >

                                                </div>
                                            </div>   
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="fphone"><b style="color:red">*</b>Father's Phone No</label>
                                                    <input type="text" name="fphone" id="fphone" class="form-control" placeholder="Father Phone Number" value="<?php echo @$_SESSION['fphone']   ?>" autocomplete="off" >

                                                </div>
                                            </div> 
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="address"><b style="color:red">*</b>Student Address</label>
                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Student Address" value="<?php echo @$_SESSION['address']   ?>" autocomplete="off" >

                                                </div>
                                            </div>  
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="dob"><b style="color:red">*</b>Date Of Birth</label>
                                                    <input type="date" name="dob" id="dob" class="form-control" placeholder="Date Of Birth" value="<?php echo @$_SESSION['dob']   ?>" autocomplete="off" >

                                                </div>
                                            </div>   
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="gander"><b style="color:red">*</b>Gender</label>
                                                    <select name="gander" id="gander" class="form-control" value="<?php echo @$_SESSION['gander']   ?>" autocomplete="off" >
                                                        <option value=''>Select</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="cnic"><b style="color:red">*</b>Student cnic</label>
                                                    <input type="text" name="cnic" id="cnic" class="form-control" placeholder="Student cnic" value="<?php echo @$_SESSION['cnic']   ?>" autocomplete="off" >

                                                </div>
                                            </div>  
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="fcnic"><b style="color:red">*</b>Date Of Admission </label>
                                                    <input type="date" name="fcnic" id="fcnic" class="form-control" placeholder="Date Of Admission" value="<?php echo @$_SESSION['fcnic']   ?>" autocomplete="off" >

                                                </div>
                                            </div>  
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="course_id"><b style="color:red">*</b>Course</label>
                                                    <select name="course_id" id="course_id" value="<?php echo @$_SESSION['course_id']   ?>" class="form-control">

                                                        <?php
                                                                
                                                             require_once dirname(__DIR__) . '/classes/students.php';
                                                             $student = new Students();

                                                             $sql = "SELECT * FROM `courses`";
                                                             $student->getCourse($sql);


                                                        ?>
                                                    </select>
                                                    <?php
                                                        echo @$error_name['course_id'];
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="fee_amount"><b style="color:red">*</b>Amount</label>
                                                   <input type="text" name="fee_amount" id="fee_amount" class="form-control" placeholder="Select Amount" value="<?php echo @$_SESSION['fee_amount']   ?>">

                                                   <?php
                                                        echo @$error_name['fee_amount'];
                                                    ?>  
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="sourse"><b style="color:red">*</b>Discount</label>
                                                    <input type="text" name="discount" id="discount" class="form-control" placeholder="Discount" autocomplete="off" value="<?php echo @$_SESSION['Discount']   ?>">

                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="sourse"><b style="color:red">*</b>Sourse Of Awareness</label>
                                                    <input type="text" name="sourse" id="sourse" class="form-control" placeholder="Sourse Of Awareness" autocomplete="off" value="<?php echo @$_SESSION['sourse']   ?>">

                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="refrence"><b style="color:red">*</b>Refrence</label>
                                                    <input type="text" name="refrence" id="refrence" class="form-control" placeholder="Refrence" autocomplete="off" value="<?php echo @$_SESSION['refrence']   ?>">

                                                   
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="education"><b style="color:red">*</b>Education</label>
                                                    <input type="text" name="education" id="education" class="form-control" placeholder="Education" autocomplete="off" value="<?php echo @$_SESSION['education']   ?>">

                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="school"><b style="color:red">*</b>School</label>
                                                    <input type="text" name="school" id="school" class="form-control" placeholder="School" autocomplete="off"  value="<?php echo @$_SESSION['school']   ?>">

                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="previous"><b style="color:red">*</b>Previous Course</label>
                                                    <input type="text" name="previous" id="previous" class="form-control" autocomplete="off" placeholder="Previous Course" value="<?php echo @$_SESSION['previous']   ?>">

                                                </div>
                                            </div>
                                           
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="image">Student Photo</label>
                                                 <br>
                                                    <input type="file" name="image"    
                                                        data-field-type="bootstrap-file-filed"  
                                                        data-label="Select Image"  
                                                        data-btn-class="btn btn-outline-secondary btn-sm"  
                                                        data-file-types="image/jpeg,image/png,image/gif"  
                                                        data-preview="on"  
                                                        multiple >


                                                <ul class="list-untyled small fileList thumbs"></ul>   
                                         </div>     
                                     </div>
                                        </div>
                                                    
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <input type="submit" value="Add Student" name="submit" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                        
                                </div>
                            </div>
                          
                          </div>
                      </div>
                  </div>  
            </div>
        </div>
    </div>

    <script src="js/bootstrap_file_field.js"></script>
    
    <script>
        $(document).ready(function(){
            $('#course_id').change(function(){

                var id = $(this).val();
                
                $.ajax({
                    type: 'get',
                    url: 'lib/students/get_course_amount.php',
                    data: {id},
                    success:function(response){

                        $('#fee_amount').val(response);
                    }

                });
            })

        });
    
    </script>
</body>
</html>