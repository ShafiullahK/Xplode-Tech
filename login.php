<?php 
    
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }




    if(!empty($_SESSION['email']) && !empty($_SESSION['password'])){

        exit(header("location:index.php"));
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__ . '/layouts/header.php' ?>
     <link rel="stylesheet" href="css/login.css">
     <link rel="stylesheet" href="css/fa/css/all.css">

    <title>User login</title>
</head>
<body>
        <div class="container login-wrapper">
            <div class="row justify-content-sm-center">
                <div class="col-sm-5">
                <!-- show message start -->
                <div class="container">
                        <?php
                            if(isset($_GET['fail'])){
                                ?>
                                
                                <div class="alert alert-danger"role="alert"><strong>Invalid Credentials</strong></div>

                                <?php
                            }

                        ?>   
                </div>
                        <!-- show message end -->
                        <?php

                            include_once 'classes/academy_info.php';
                    
                            $accademy = new Academy_Info();

                            $sql = 'SELECT `logo` FROM `academy`';

                            $logo =  $accademy->getLogo($sql);

                            

                        ?>

                        <div class="card">
                            <div class="card-header text-center" id="login-header">
                                <img src="uploads/<?php echo $logo['logo'];    ?>" id="academy-logo">
                                <h4 class="text-muted">
                                    <i class="fas fa-user-alt"></i>
                                    Login

                                </h4>
                            </div>
                        <div class="card-body">
                        <?php  include_once "lib/login.php";?>


                    <form method="post" action="login.php">

                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope-square"></i> Email</label>
                            <input type="email" name="email" id="email" class="form-control " placeholder="Email" autocomplete="off" value="<?php echo @$_SESSION['email']   ?>">

                            <?php
                                        echo @$error_name['email'];
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="pass"><i class="fas fa-key"></i> Password </label>
                            <input type="password" name="pass" id="pass" class="form-control " placeholder="Password" autocomplete="off">

                            <?php
                                        echo @$error_name['pass'];
                            ?>
                        </div>
                            <div class="form-group">
                                <a href="#"id="btn-link">Forgot password?</a>
                            </div>

                        <div class="form-group">
                            <input type="submit" value="LOGIN" id="submit" name="submit" class="btn btn-primary">
                        </div>

                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
</html>