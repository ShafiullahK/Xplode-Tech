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
    <title>Backup - Xplode Academy Management System</title>
</head>
<body style="height:100vh">
    <div class="container-fluid">
        <div class="row">

         <?php  require_once "../layouts/sidebar.php";    ?>

            <div class="col-sm-10 main-area">

                 <?php require_once "../layouts/navbar.php";   ?>
                    <!-- Main containt -->
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col-sm-12">
                            <!-- Success Message -->
                            <div class="container">
                            <?php
                                if(isset($_GET['success'])){
                                    ?>
                                        <div class="alert alert-success">Backup created successfully</div>
                                    <?php
                                }
                            ?>
                            </div>
                            <!-- end message -->

                                <div class="card">
                                    <div class="card-header">
                                        BACKUP
                                        <a href="backup/restore.php" class="btn btn-sm btn-success float-right">Restore Backup</a>
                                    </div>
                                    <div class="card-body">
                                        <form action="lib/backup/backup.php">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-sm btn-primary" value="Backup">
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

