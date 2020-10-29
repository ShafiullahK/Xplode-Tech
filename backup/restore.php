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
    <title>Restore Backup - Xplode Academy Management System</title>
</head>
<body style="height:100vh">
    <div class="container-fluid">
        <div class="row">

        <?php  require_once "../layouts/sidebar.php";    ?>

            <div class="col-sm-10 main-area">

           <?php   require_once "../layouts/navbar.php";   ?>
                <!-- Main content -->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 class="mt-3 mb-2">Backups</h6>
                                <!-- restore message -->
                                    <div class="container">
                                    <?php

                                    if(isset($_GET['restore'])){
                                        ?>
                                        <div class="alert alert-success">Backup restored successfully</div> 
                                        <?php
                                    }


                                    ?>
                                    </div>
                                    <div class="container">
                                    <?php

                                    if(isset($_GET['not'])){
                                        ?>
                                        <div class="alert alert-danger">Sorry  backup not restored</div> 
                                        <?php
                                    }


                                    ?>
                                    </div>
                                    <!-- restor message -->
                                      <!-- delete  -->
                                <div class="container">
                                <?php

                                if(isset($_GET['delete'])){
                                    ?>
                                    <div class="alert alert-success">Backup removed successfully</div> 
                                    <?php
                                }


                                ?>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Restore Backup
                                        <a href="backup/create.php" class="btn btn-sm btn-success float-right">Create Backup</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>S#</th>
                                                        <th>Backup Name</th>
                                                        <th>Created By</th>
                                                        <?php  if($role === 'super_admin'){  ?>
                                                        <th><i class="fas fa-download"></i></th>
                                                        <th><i class="fas fa-trash-alt"></i></th>
                                                    </tr>
                                                        <?php  } ?>
                                                </thead>

                                                <?php
                                                            include_once dirname(__DIR__) . '/classes/backup.php';
                                                            $backup = new Backup();

                                                                $sql = "SELECT * FROM `backups`";
                                                                $backup->dataView($sql , $role);

                                                                ?>
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
    
</body>
</html>