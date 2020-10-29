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
    <title>Users - Xplode Academy Management System</title>
</head>
<body style="height:100vh">
    <div class="container-fluid">
        <div class="row">

             <?php  require_once "../layouts/sidebar.php";    ?>

            <div class="col-sm-10 main-area">

                <?php require_once "../layouts/navbar.php";   ?>

                <!-- main content goes here -->
                <div class="container">
                    <h4 class="mt-4">Users</h4>
                    <div class="row">
                        <div class="col-sm-4">
                        <!-- Insert message -->
                        <div class="container">
                        <?php
                        if(isset($_GET['success'])){
                            ?>
                                <div class="alert alert-success">User added successfully</div>
                            <?php
                        }
                        ?>
                        </div>
                        <div class="container">
                        <?php
                        if(isset($_GET['not'])){
                            ?>
                                <div class="alert alert-danger">Sorry user not added</div>
                            <?php
                        }
                        ?>
                        </div>
                        <!-- message -->
                         <!-- update message -->
                         <div class="container">
                        <?php
                        if(isset($_GET['update'])){
                            ?>
                                <div class="alert alert-success">User updated successfully</div>
                            <?php
                        }
                        ?>
                        </div>
                        <div class="container">
                        <?php
                        if(isset($_GET['notupdate'])){
                            ?>
                                <div class="alert alert-danger">Sorry user not uodated</div>
                            <?php
                        }
                        ?>
                        </div>
                        <!-- message -->
                            <!-- Add user -->
                            <div class="card mt-2">
                                <div class="card-header">ADD USER</div>
                                <div class="card-body">
                                    <form action="lib/users/create.php"method="post">
                                        <div class="form-group">
                                            <label for="username"><b style="color:red">*</b> 
                                                Username
                                            </label>
                                            <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email"><b style="color:red">*</b> 
                                                Email
                                            </label>
                                            <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="role"><b style="color:red">*</b> 
                                                Role
                                            </label>
                                            <select name="role" id="role" class="form-control">
                                                <option>Select</option>
                                                <option value="admin">Admin</option>
                                                <option value="super_admin">Super_admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pass"><b style="color:red">*</b> 
                                                Password
                                            </label>
                                            <input type="password" name="pass" class="form-control" placeholder="Password" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pass_confirm"><b style="color:red">*</b> 
                                                Password Confirm
                                            </label> 
                                            <input type="password" name="pass_confirm" class="form-control" placeholder="Password Confirm" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-sm" name="submit"value="ADD USER">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $('form').submit(function(e){
                                    const pass = $('input[name=pass]').val();
                                    const pass_conf = $('input[name=pass_confirm]').val();

                                    if(pass !== pass_conf){
                                        alert('Password don\'t match');
                                        e.preventDefault();
                                        return;
                                    }

                                    if(pass.length < 8){
                                        alert('Password must not be less then 8 characters in length');
                                        e.preventDefault();
                                        return;
                                    }
                                })

                                
                            })
                        </script>
                        <!-- Show Users -->
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header">Users</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="cour" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Actions</th>

                                                </tr>
                                            </thead>
                                            <?php
                                                include_once dirname(__DIR__) . '/classes/users.php';
                                                $users = new Users();

                                                $sql = "SELECT * FROM `users`";
                                                $users->dataView($sql);
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