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
                        <!-- get id -->
                        <?php   
                                include_once dirname(__DIR__) . '/classes/users.php';
                                $users = new Users();
                                    if(isset($_GET['id'])){
                                        $id = $_GET['id'];

                                        $edit = $users->getID($id);

                                        
                                    }
                        ?>
                            <!-- Add user -->
                            <div class="card mt-2">
                                <div class="card-header">EDIT USER</div>
                                <div class="card-body">
                                    <form action="lib/users/edit.php?id=<?php echo $id ?>"method="post">
                                        <div class="form-group">
                                            <label for="username"><b style="color:red">*</b> 
                                                Username
                                            </label>
                                            <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required value="<?php echo $edit['username'];   ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email"><b style="color:red">*</b> 
                                                Email
                                            </label>
                                            <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required value="<?php echo $edit['email'];   ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="role"><b style="color:red">*</b> 
                                                Role
                                            </label>
                                            <select name="role" id="role" class="form-control" >
                                                <option value="admin"<?php  echo $edit['role'] === 'admin' ? 'selected' : ''   ?>>Admin</option>
                                                <option value="super_admin"<?php echo $edit['role'] === 'super_admin'? 'selected': ''   ?>>Super_admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="current_pass"><b style="color:red">*</b> 
                                                Current Password
                                            </label>
                                            <input type="password" name="current_pass" class="form-control" placeholder="Current Password" autocomplete="off" >
                                            <?php
                                                if(isset($_GET['error'])){
                                                    ?>
                                                    <small class="text-danger">Your entered an incorrect password</small>
                                                    <?php
                                                }


                                                ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="pass"><b style="color:red">*</b> 
                                                New Password
                                            </label>
                                            <input type="password" name="pass" class="form-control" placeholder="New Password" autocomplete="off" >
                                        </div>
                                             <!-- hidden files -->
                                             <input type="hidden" name="old_pass" value="<?php echo $edit['password']; ?>">
                                            <input type="hidden" name="id" value="<?php echo  $edit['id']; ?>">
                                        <div class="form-group">
                                            <label for="pass_confirm"><b style="color:red">*</b> 
                                                Password Confirm
                                            </label> 
                                            <input type="password" name="pass_confirm" class="form-control" placeholder="Password Confirm" autocomplete="off" >
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-sm" name="update"value="UPDATE">
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