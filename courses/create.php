<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '../layouts/header.php' ?>
    <title>Add a Course - Xplode Academy Management System</title>
</head>
<body style="height: 100vh">
   <div class="container-fluid">

       <div class="row">
         <?php require_once '../layouts/sidebar.php' ?>

           <div class="col-sm-10 main-area">
                <?php require_once __DIR__ .'/../layouts/navbar.php' ?>

                <div class="container mt-3">
                    <div class="row">
                        <div class="col-sm-12">

                            <?php require_once  '../layouts/errors.php'; ?>
                            
                                    <!-- insert message  start-->

                                      <div class="container">
                                                <?php

                                                    if(isset($_GET['success'])){
                                                        ?>
                                                        
                                                        <div class="alert alert-success"role="alert"><strong>Course Added Successfully</strong></div>

                                                        <?php
                                                    }

                                                ?>
                                                </div>
                                                <div class="container">
                                                <?php

                                                    if(isset($_GET['fail'])){
                                                        ?>
                                                        
                                                        <div class="alert alert-danger"role="alert"><strong>Sorry Course Not Added</strong></div>

                                                        <?php
                                                    }

                                                ?>
                                                </div>
                                                <!-- insert message end -->

                                                    
                                     <?php     require_once dirname(__DIR__) ."/lib/courses/create.php"  ?>


                            <div class="card">
                                <div class="card-header"><i class="fas fa-plus"></i> Add Course</div>
                                <div class="card-body">
                                     <form action="courses/create.php" method="post">

                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name">Course Name</label>
                                                    <input type="text" name="name" class="form-control" value="<?php echo @$_SESSION['name'] ?>" placeholder="Course Name"  autocomplete="off" >

                                                </div>
                                                <?php
                                                        echo @$error_name['name'];
                                                    ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="code">Course Code</label>
                                                    <input type="text" name="code" class="form-control" value="<?php echo @$_SESSION['code'] ?>" placeholder="Course Code" autocomplete="off" >
                                                </div>
                                                <?php
                                                        echo @$error_name['code'];
                                                    ?>
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="fee">Course Fee</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Pkr</span>
                                                    </div>
                                                    <input type="text" name="fee" class="form-control" value="<?php echo @$_SESSION['fee'] ?>" placeholder="Course Fee" autocomplete="off" >
                                            
                                                   
                                                </div>
                                                <?php
                                                        echo @$error_name['fee'];
                                                        
                                                    ?>
                                            </div>
                                        </div>

                                        <small class="d-block font-weight-bold text-mute">Duration</small>
                                        <hr>

                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="years">Years</label>
                                                    <input type="number" name="years" class="form-control" value="<?php echo @$_SESSION['years'] ?>" placeholder="Years" autocomplete="off" >

                                                </div>
                                                <?php
                                                        echo @$error_name['years'];
                                                    ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="months">Months</label>
                                                    <input type="number" name="months" class="form-control" value="<?php echo @$_SESSION['months'] ?>" placeholder="Months" autocomplete="off" >

                                                </div>
                                                <?php
                                                        echo @$error_name['months'];
                                                    ?>

                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="weeks">Weeks</label>
                                                    <input type="number" name="weeks" class="form-control" placeholder="Weeks" value="<?php echo @$_SESSION['weeks'] ?>" autocomplete="off" >

                                                </div>
                                                <?php
                                                        echo @$error_name['weeks'];
                                                    ?>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                        <div class="col-sm-3">
                                                <input type="submit" value="Add Course" class="btn btn-primary" name="submit">
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
            
</body>
</html>