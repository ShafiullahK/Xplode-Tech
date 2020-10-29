<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php   require_once '../layouts/header.php';    ?>
    <title>SMS  Credentials - Xplode Academy Management System</title>
</head>
<body style="height:100hv">
    <div class="container-fluid">
        <div class="row">

        <?php  require_once dirname(__DIR__) . '../layouts/sidebar.php';    ?>

            <div class="col-sm-10 main-area">

            <?php require_once "../layouts/navbar.php";   ?>

                <!-- main content -->
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-sm-12">

                        <?php  include_once dirname(__DIR__) . '../lib/sms_credentials/edit.php'   ?>
                            <?php
                                    require_once dirname(__DIR__) . '/classes/sms.php';
                                    $sms = new SMS();

                                    $sms_credentials = $sms->getID(1);
                            ?>

                            <?php  if($sms_credentials !== NULL && $sms_credentials !== FALSE):     ?>
                            <div class="card">
                                <div class="card-header">UPDATE SMS CREDENTIALS</div>
                                <div class="card-body">
                                    <form action="sms_credentials/edit.php"method="post">
                                        <div class="form-group">
                                            <label for="username"><b style="color:red">*</b>Username</label>
                                            <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Enter username" value="<?php echo $sms_credentials['username'];    ?>">
                                            <?php    echo @$error_name['username'];   ?>
                                        </div>
                                        <div class="form-group" id="pwd-wrapper">
                                            <label for="password"><b style="color:red">*</b>Password</label>
                                            <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Enter Password" value="<?php echo $sms_credentials['password'];   ?>">
                                            <button type="button" class="btn btn-sm" id="show-pwd">
                                                <i class="fas fa-eye-slash" id="pwd-toggle-icon"></i>
                                            </button>
                                            <?php    echo @$error_name['password'];   ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="sender"><b style="color:red">*</b>Sender</label>
                                            <input type="text" name="sender" class="form-control" autocomplete="off" placeholder="Sender" value="<?php echo $sms_credentials['sender'];   ?>">
                                            <?php    echo @$error_name['sender'];   ?>
                                        </div>
                                            <!-- hidden file -->
                                            <input type="hidden" name="id" id="id" value="<?php  echo $sms_credentials['id'];  ?>">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-sm" value="UPDATE" name="update">
                                        </div>
                                    </form>

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
                                </div>
                            </div>
                            <?php  else:   ?>
                            <h4>No record found</h4>
                            <?php endif;   ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>

            document.getElementById('show-pwd').onclick = function(){

                let fieldType = document.querySelector('input[name=password]');
                let icon = document.getElementById('pwd-toggle-icon');

                if(fieldType.type === 'password'){
                    fieldType.type = 'text';
                    icon.className = 'fas fa-eye';

                }else{

                    fieldType.type = 'password';
                    icon.className = 'fas fa-eye-slash';
                }
            }

    </script>
</body>
</html>