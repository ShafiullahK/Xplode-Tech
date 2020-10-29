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

                                        <?php

                                    include_once dirname(__DIR__). '/classes/courses.php';
                                    $course = new Courses();


                                         // Get id 
    
                                        if(isset($_GET['id'])){
    
                                            $id = $_GET['id'];
    
                                            $edit = $course->getID($id);
                                        }
         
                                    ?>

                                    <!-- Include file -->
                                <?php   require_once "../lib/courses/edit.php"  ?>

                            <div class="card">
                                <div class="card-header"><i class="fas fa-plus"></i> Add Course</div>
                                <div class="card-body">
                                     <form action="courses/edit.php?id=<?php  echo $id  ?>" method="post">

                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name">Course Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Course Name"  autocomplete="off" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : $edit['name'];   ?>">

                                                </div>
                                                <?php
                                                        echo @$error_name['name'];
                                                    ?>

                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="code">Course Code</label>
                                                    <input type="text" name="code" class="form-control" placeholder="Course Code" autocomplete="off" value="<?php echo isset($_SESSION['code']) ? $_SESSION['code'] : $edit['code'];   ?>">

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
                                                    <input type="text" name="fee" class="form-control" placeholder="Course Fee" autocomplete="off" value="<?php echo isset($_SESSION['fee']) ? $_SESSION['fee'] : $edit['fee'];   ?>">

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
                                                    <input type="number" name="years" class="form-control" placeholder="Years" value="<?php echo isset($_SESSION['years']) ? $_SESSION['years'] : $edit['years'];   ?>">

                                                </div>
                                                <?php
                                                        echo @$error_name['years'];
                                                    ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="months">Months</label>
                                                    <input type="number" name="months" class="form-control" placeholder="Months"autocomplete="off" value="<?php echo isset($_SESSION['months']) ? $_SESSION['months'] : $edit['months'];   ?>">

                                                </div>
                                                <?php
                                                        echo @$error_name['months'];
                                                    ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="weeks">Weeks</label>
                                                    <input type="number" name="weeks" class="form-control" placeholder="Weeks" autocomplete="off" value="<?php echo isset($_SESSION['weeks']) ? $_SESSION['weeks'] : $edit['weeks'];   ?>">

                                                </div>
                                                <?php
                                                        echo @$error_name['weeks'];
                                                    ?>
                                            </div>
                                        </div>
                                        
                                            <!-- hidden file -->
                                            <input type="hidden" name="id" id="id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : $edit['id'];  ?>">
                                        <div class="row mt-3">
                                        <div class="col-sm-3">
                                                <input type="submit" value="UPDATE" class="btn btn-primary" name="submit">
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