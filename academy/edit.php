<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <link rel="stylesheet" href="css/bootstrap_file_field.css">
    <title>Eddit  - Xplode Academy Management System</title>
    
</head>
<body style="height: 100vh">
    <div class="container-fluid">
        <div class="row">
        <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

            <div class="col-sm-10 main-area">

            <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

            <?php require_once  '../layouts/errors.php'; ?>

            <!-- main content goes here -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-sm-12">


                        <?php  include_once dirname(__DIR__) . '../lib/academy/edit.php'; ?>


                        <div class="card">
                            <?php
                                include_once dirname(__DIR__) . '/classes/academy_info.php';
                                $academy = new Academy_Info();
                                
                                // GET ID



                                    $edit = $academy->getID(1);
                                
                            ?>
                            <div class="card-header bg-dark text-white">
                                UPDATE ACADEMY INFO
                            </div>
                            <div class="card-body">
                                <form action="academy/edit.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name"><b style="color:red">*</b> Academy Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Academy Name" autocomplete="off" value="<?php echo $edit['name'];   ?>">

                                        <?php
                                                 echo @$error_name['name'];
                                         ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact"><b style="color:red">*</b> Contact No</label>
                                        <input type="text" name="contact" class="form-control" placeholder="Contact No" autocomplete="off" value="<?php echo $edit['contact'];  ?>">

                                        <?php
                                                 echo @$error_name['contact'];
                                         ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="address"><b style="color:red">*</b> Address</label>
                                        <input type="text" name="address" class="form-control" placeholder="Address" autocomplete="off" value="<?php echo $edit['address'];  ?>">

                                        <?php
                                                 echo @$error_name['address'];
                                         ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="details"><b style="color:red">*</b> Details</label>
                                        <textarea name="details" id="details" placeholder="Description" rows="4" class="form-control" ><?php echo $edit['details'];  ?></textarea>
                                        
                                        <?php
                                                 echo @$error_name['details'];
                                         ?>
                                    </div>
                                    <div class="form-group">
                                    <label for="principle">Principle Signature</label>
                                        <br>
                                        <input type="file" name="principle"    
                                            data-field-type="bootstrap-file-filed"  
                                            data-label="Select Image"  
                                            data-btn-class="btn btn-outline-secondary btn-sm"  
                                            data-file-types="image/jpeg,image/png,image/gif"  
                                            data-preview="on"  
                                            multiple >


                                            <ul class="list-unstyled small fileList thumbs"></ul>
                                            <small class="text-muted ml-4">
                                            <i>File must be with transparent background</i>
                                            </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Academy Logo</label>
                                        <br>
                                        <input type="file" name="logo"    
                                            data-field-type="bootstrap-file-filed"  
                                            data-label="Select Image"  
                                            data-btn-class="btn btn-outline-secondary btn-sm"  
                                            data-file-types="image/jpeg,image/png,image/gif"  
                                            data-preview="on"  
                                            multiple >


                                         <ul class="list-untyled small fileList thumbs"></ul>   
                                    </div>
                                    <!-- hidden file -->
                                    <input type="hidden" name="id" value="<?php echo $edit['id'];   ?>">
                                    <div class="form-group">
                                        <input type="submit" value="UPDATE" class="btn btn-primary btn-sm" name="update">
                                    </div>
                                    <!-- Update Message -->
                                        <div class="container">
                                        <?php
                                        if(isset($_GET['update'])){
                                            ?>
                                            <div class="alert alert-success" role="alert"><strong>Changes Saved Successfully</strong></div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                        <div class="container">
                                        <?php
                                        if(isset($_GET['notupdate'])){
                                            ?>
                                            <div class="alert alert-danger" role="alert"><strong>Sorry no changes saved</strong></div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                        <!-- Update Message end -->

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
</body>
</html>