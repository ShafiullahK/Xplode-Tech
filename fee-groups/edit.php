<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title>Edit Fee group - Xplode Academy Management System</title>
    
</head>
<body style="height :100vh">
     <div class="container-fluid">
         <div class="row">
             <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

             <div class="col-sm-10 main-area">
                 <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

                 <?php require_once  '../layouts/errors.php'; ?>
                 <!-- main content -->
                 <div class="container mt-3">
                 
                 <h4>Fee Groups</h4>
                     <div class="row">
                         <!-- add session -->
                         <div class="col-sm-4">

                            <?php

                                    include_once dirname(__DIR__) . '/classes/fee_group.php';
                                    $Group = new Fee_Group();

                                    if(isset($_GET['id'])){

                                        $id = $_GET['id'];

                                        $edit = $Group->getID($id);
                                    }

                                ?>

                                 <?php  include_once dirname(__DIR__) . '/lib/fee-groups/edit.php';   ?>

                             <div class="card">
                                 <div class="card-header" style="background: black; color:#fff">EDIT FEE GROUP</div>
                                 <div class="card-body">
                                     <form action="fee-groups/edit.php?id=<?php echo $id;   ?>" method="post">

                                         <div class="form-group">
                                             <label for="fee_group"><b style="color:red">*</b> Fee group</label>
                                             <input type="text" name="fee_group" id="fee_group" class="form-control" placeholder="Fee Group" autocomplete="off" value="<?php echo $edit['fee_group'];   ?>">

                                             <?php
                                                        echo @$error_name['fee_group'];
                                                    ?>
                                         </div>

                                         <div class="form-group">
                                             <label for="description">Description</label>
                                             <textarea name="description" id="description" rows="4" class="form-control" placeholder="Description" value="<?php echo $edit['description']  ?>"></textarea>

                                         </div>

                                         <!-- hidden file -->
                                         <input type="hidden" name="id" value="<?php echo $edit['id'];   ?>">
                                         <div class="form-group">
                                             <input type="submit" value="UPDATE FEE GROUP" name="update" class="btn btn-primary btn-sm">
                                         </div>

                                     </form>


                                 </div>
                             </div>


                         </div>
                         <div class="col-sm-8">
                             <div class="card">
                                 <div class="card-header" style="background:black; color:#fff;">Fee Groups</div>
                                 <div class="card-body">
                                     <div class="table-responsive">
                                         <table id="cour" class="table table-hover " style="width:100%">
                                             <thead class="thead-light">
                                                 <tr>
                                                     <th>S#</th>
                                                     <th>Fee Group</th>
                                                     <th>Date Added</th>

                                                     <?php  if($role === 'super_admin'){  ?>
                                                     <th>Action</th>
                                                 </tr>
                                                     <?php  } ?>
                                             </thead>
                                             <?php

                                                include_once dirname(__DIR__) . '/classes/fee_group.php';
                                                $Group = new Fee_Group();

                                                $sql = "SELECT * FROM `fee_groups`";

                                                $Group->dataView($sql , $role);

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