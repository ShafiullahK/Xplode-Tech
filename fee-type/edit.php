<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title>Edit Fee type - Xplode Academy Management System</title>
    
</head>
<body style="height :100vh">
     <div class="container-fluid">
         <div class="row">
             <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

             <div class="col-sm-10 main-area">
                 <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

                 <!-- main content -->
                 <div class="container mt-3">
                 <h4>Fee Types</h4>
                     <div class="row">
                         <!-- add session -->
                         <div class="col-sm-4">

                             <?php      

                                    include_once dirname(__DIR__) .'/classes/fee_type.php';
                                    $fee =  new Fess();

                                        if(isset($_GET['id'])){

                                            $id = $_GET['id'];

                                           $edit =  $fee->getID($id);
                                        }

                                    ?>

                                <?php  include_once dirname(__DIR__) . '/lib/fee-type/edit.php';   ?>


                             <div class="card">
                                 <div class="card-header" style="background: black; color:#fff">EDIT FEE TYPE</div>
                                 <div class="card-body">
                                     <form action="fee-type/edit.php?id=<?php echo $id;   ?>" method="post">

                                         <div class="form-group">
                                             <label for="fee_type"><b style="color:red">*</b> Fee Type</label>
                                             <input type="text" name="fee_type" id="fee_type" class="form-control" placeholder="Fee Type" autocomplete="off" value="<?php echo $edit['fee_type'];   ?>">

                                             <?php
                                                        echo @$error_name['fee_type'];
                                                    ?>
                                         </div>

                                         <div class="form-group">
                                             <label for="code"><b style="color:red">*</b> Code</label>
                                             <input type="text" name="code" id="code" class="form-control" placeholder="Code" autocomplete="off" value="<?php echo $edit['code'];   ?>">

                                             <?php
                                                        echo @$error_name['code'];
                                                    ?>
                                         </div>

                                         <div class="form-group">
                                             <label for="description">Description</label>
                                             <textarea name="description" id="description" rows="4" class="form-control" placeholder="Description" value="<?php echo  $edit['description'];   ?>"></textarea>

                                         </div>
                                          <!-- hidden file -->
                                          <input type="hidden" name="id" id="id" value=<?php echo  $edit['id'];   ?>>
                                         <div class="form-group">
                                             <input type="submit" value="UPDATE FEE TYPE" name="update" class="btn btn-primary btn-sm">
                                         </div>

                                     </form>

                                 </div>
                             </div>


                         </div>
                         <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header" style="background:black; color:#fff"> Fee Types</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="cour" class="table table-hover" style="width:100%">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Fee Type</th>
                                                    <th>Code</th>
                                                    <th>Date Added</th>
                                                    <?php  if($role === 'super_admin'){   ?>
                                                    <th>Action</th>
                                                </tr>
                                                    <?php  } ?>
                                            </thead>

                                            <?php

                                                include_once dirname(__DIR__). '/classes/fee_type.php';

                                                $fee = new Fess();

                                                $sql = 'SELECT * FROM `fee_types`';

                                                $fee->dataView($sql , $role);

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