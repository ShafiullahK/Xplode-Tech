<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title>Add a Fee type - Xplode Academy Management System</title>
    
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
                 <h4>Fee Types</h4>
                     <div class="row">
                         <!-- add session -->
                         <div class="col-sm-4">

                         <?php  include_once dirname(__DIR__) . '/lib/fee-type/create.php';   ?>

                             <div class="card">
                                 <div class="card-header" style="background: black; color:#fff">ADD FEE TYPE</div>
                                 <div class="card-body">
                                     <form action="fee-type/create.php" method="post">

                                         <div class="form-group">
                                             <label for="fee_type"><b style="color:red">*</b> Fee Type</label>
                                             <input type="text" name="fee_type" id="fee_type" class="form-control" value="<?php echo @$_SESSION['fee_type'] ?>" placeholder="Fee Type" autocomplete="off">

                                             <?php
                                                        echo @$error_name['fee_type'];
                                                    ?>
                                         </div>

                                         <div class="form-group">
                                             <label for="code"><b style="color:red">*</b> Code</label>
                                             <input type="text" name="code" id="code" class="form-control" value="<?php echo @$_SESSION['code'] ?>" placeholder="Code" autocomplete="off">

                                             <?php
                                                        echo @$error_name['code'];
                                                    ?>
                                         </div>

                                         <div class="form-group">
                                             <label for="description">Description</label>
                                             <textarea name="description" id="description" rows="4" class="form-control" value="<?php echo @$_SESSION['description'] ?>" placeholder="Description"></textarea>
                                             <?php
                                                        echo @$error_name['description'];
                                                    ?>
                                         </div>
                                         <div class="form-group">
                                             <input type="submit" value="ADD FEE TYPE" name="submit" class="btn btn-primary btn-sm">
                                         </div>

                                     </form>

                                 </div>
                             </div>


                         </div>
                         <div class="col-sm-8">
                             <!-- Insert message start -->
                                <div class="container">
                                <?php    
                                if(isset($_GET['insert'])){
                                    ?>
                                    <div class="alert alert-success" role="alert"><strong>Fee  Type added Successfully</strong></div>
                                    <?php
                                }


                                ?>

                                </div>
                                <div class="container">
                                <?php    
                                if(isset($_GET['notinsert'])){
                                    ?>
                                    <div class="alert alert-danger" role="alert"><strong>Sorry Fee Type  not added</strong></div>
                                    <?php
                                }


                                ?>

                                </div>
                                <!-- Insert message end -->

                                <!-- update message start -->
                                <div class="container">
                                <?php    
                                if(isset($_GET['update'])){
                                    ?>
                                    <div class="alert alert-success" role="alert"><strong>Fee Type  updated Successfully</strong></div>
                                    <?php
                                }


                                ?>

                                </div>
                                <div class="container">
                                <?php    
                                if(isset($_GET['notupdate'])){
                                    ?>
                                    <div class="alert alert-danger" role="alert"><strong>Sorry Fee Type  not updated</strong></div>
                                    <?php
                                }


                                ?>

                                </div>
                                <!-- update message end -->

                                <!-- Delete message start -->
                                    <div id="delete"></div>
                                    <!-- Delete message end -->

                            <div class="card">
                                <div class="card-header" style="background:black; color:#fff"> Fee Types</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="cour" class="table  table-hover" style="width:100%">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Fee Type</th>
                                                    <th>Code</th>
                                                    <th>Date Added</th>
                                                    <!-- check role -->
                                                    <?php  if($role  === 'super_admin'){   ?>
                                                    <th>Action</th>
                                                </tr>
                                                    <?php   } ?>
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