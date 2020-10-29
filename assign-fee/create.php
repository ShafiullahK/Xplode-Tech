<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title>Add Assign Fee Types - Xplode Academy Management System</title>
    
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
                 
                 <h4>Assign Fee Types</h4>
                     <div class="row">
                         <!-- add session -->
                         <div class="col-sm-4">

                        <!-- Include file  -->
                        <?php  include_once dirname(__DIR__) . '/lib/assign-fee/create.php';   ?>


                             <div class="card">
                                 <div class="card-header" style="background: black; color:#fff">ASSIGN FEE TYPE </div>
                                 <div class="card-body">
                                     <form action="assign-fee/create.php" method="post">

                                         <div class="form-group">
                                             <label for="fee_group_id"><b style="color:red">*</b> Select Fee Group</label>
                                            <select name="fee_group_id" id="fee_group_id" class="form-control">

                                                <?php
                                                    
                                                    include_once dirname(__DIR__) . '/classes/assign_fee.php';
                                                    $assign = new Assign_Fee();

                                                    $sql = "SELECT * FROM `fee_groups`";

                                                    $assign->getGroup($sql);



                                                    ?>
                                            </select>

                                            <?php
                                                        echo @$error_name['fee_group_id'];
                                                    ?>
                                         </div>

                                         <div class="form-group">
                                             <label for="fee_type_id"><b style="color:red">*</b> Select Fee Type</label>
                                             <select name="fee_type_id" id="fee_type_id" class="form-control">
                                               
                                                 <?php

                                                       include_once dirname(__DIR__) . '/classes/assign_fee.php';
                                                       $assign = new Assign_Fee();

                                                       $sql = "SELECT * FROM `fee_types`";

                                                       $assign->getType($sql);


                                                    ?>
                                             
                                             </select>

                                             <?php
                                                        echo @$error_name['fee_type_id'];
                                                    ?>
                                         </div>

                                         <div class="form-group">
                                             <label for="date"><b style="color:red">*</b> Due Date</label>
                                             <input type="date" name="date" id="date" class="form-control" autocomplete="off" value="<?php echo @$_SESSION['date'] ?>">

                                             <?php
                                                        echo @$error_name['date'];
                                                    ?>
                                         </div>

                                         <div class="form-group">
                                             <label for="amount"><b style="color:red">*</b> Amount</label>
                                             <input type="amount" name="amount" id="amount" class="form-control" placeholder="Enter Amount" autocomplete="off" value="<?php echo @$_SESSION['amount'] ?>">

                                             <?php
                                                        echo @$error_name['amount'];
                                                    ?>
                                         </div>

                                         
                                         <div class="form-group">
                                             <input type="submit" value="ASSIGN" name="submit" class="btn btn-primary btn-sm">
                                         </div>

                                     </form>


                                 </div>
                             </div>


                         </div>
                         <div class="col-sm-8">
                            <!-- Insert message start -->
                            <div class="container">
                            <?php
                            if(isset($_GET['success'])){
                                ?>
                                <div class="alert alert-success"role="alert"><strong>Fee type assigned Successfully</strong></div>
                                <?php
                            }
                            ?>
                            </div>
                            <div class="container">
                            <?php
                            if(isset($_GET['not'])){
                                ?>
                                <div class="alert alert-danger"role="alert"><strong>Sorry Fee type not assigned</strong></div>
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
                                        <div class="alert alert-success"role="alert"><strong>Changes saved Successfully</strong></div>
                                        <?php
                                    }
                                    ?>
                                    </div>

                        <!-- update message end -->

                        <!-- delete message start -->
                                  <div id="delete"></div>
                            <!-- delete message end -->
                            <!-- delete mesaage start -->
                                <div id="remove"></div>
                                <!-- delete mesaage end -->

                            <div class="card">
                                <div class="card-header" style="background:black; color:#fff">ASSIGNED FEE TYPES</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="cour" class="table table-hover" style="width:100%">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Fee Group</th>
                                                    <th>Fee Type(s)</th>
                                                    <th>Date Added</th>

                                                    <!-- checking admin or user -->
                                                    <?php  if($role === 'super_admin'){   ?>
                                                    <th>Actions</th>
                                                </tr>
                                                    <?php  }  ?>
                                            </thead>

                                                <?php

                                                    include_once dirname(__DIR__) . '/classes/assign_fee.php';
                                                    $assign = new Assign_Fee();


                                                    $sql = "SELECT DISTINCT fee_groups.fee_group , assign_fee.created_at, fee_groups.id as fee_group_id FROM `assign_fee` INNER JOIN `fee_groups` ON assign_fee.fee_group_id = fee_groups.id GROUP BY fee_groups.fee_group";

                                                    

                                                    $assign->dataView($sql , $role);
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