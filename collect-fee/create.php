<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title> Collect Fee To  - Xplode Academy Management System</title>
</head>
<body style="height :100vh">
    <div class="container-fluid">
        <div class="row">

        <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

            <div class="col-sm-10 main-area">

            <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

            <?php require_once  '../layouts/errors.php'; ?>

            <div class="container mt-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header" style="background:black; color:#fff">SEARCH STUDENTS TO COLLECT FEE</div>
                            <div class="card-body">
                            <form action="collect-fee/create.php" method="post">
                                    <div class="row mb-2">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="course_id"><b>Search by Course</b></label>          
                                            <select name="course_id" id="course_id" class="form-control">
                                                <?php

                                                        require_once dirname(__DIR__) . '/classes/collect_fee.php';
                                                        $collect = new Collect_Fee();

                                                        $sql = "SELECT * FROM `courses`";
                                                        $collect->getCourse($sql);

                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                                <div class="input-group mb-3 mt-4">
                                                    <input type="text" name="fa_name" id="st_name" class="form-control" placeholder="Search Student" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <input type="hidden" name="id" value="<?php  echo $_GET['id'] ?? $_SESSION['fee_group_id'];   ?>">
                                                        <button type="submit" name="find" class="btn btn-dark">Search</button>
                                                    </div>
                                                </div>     
                                            </div>
                                    </div>
                                </form>

                                <?php

                                $fee_group_id;


                                if(isset($_POST['find'])){
                                    
                                    $course_id = $_POST['course_id'];
                                    $fa_name = $_POST['fa_name'];
                                    $fee_group_id = $_POST['id'];
                                    $_SESSION['fee_group_id'] = $fee_group_id;

                                    


                                    $result = $collect->findOut($course_id , $fa_name , $fee_group_id);

                                    
                                    
                                }

                                

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                  <?php

                        if(isset($result)):
                            ?>

                            <div class="card">
                                <div class="card-header"  style="background:black; color:#fff">SEARCH RESULTS</div>
                                <div class="card-body">
                                    <div class="table-responsive mt-4">
                                        <table id="cour" class="table  table-hover" style="width:100%">
                                            <thead class="thead-light">
                                                <tr>

                                                    <th>Admission No.</th>
                                                    <th>Student Name</th>
                                                    <th>Father's Name</th>
                                                    <th>Phone No</th>
                                                    <th>Course</th>
                                                    <th>Gender</th>
                                                    <!-- checking admin and user -->
                                                    <?php if($role === 'super_admin'){    ?>
                                                    <th>Actions</th>

                                                </tr>
                                                    <?php  }  ?>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    foreach($result as $r): ?>
                                                        <tr>
                                                            <td><?php  echo $r['admission_no'];  ?></td>
                                                            <td><a href="students/show.php?id=<?php echo $r['id'];?>" style="text-decoration:none;"><?php  echo $r['sname'];    ?></a></td>
                                                            <td><?php  echo $r['fname'];  ?></td>
                                                            <td><?php  echo $r['phone'];  ?></td>
                                                            <td><?php  echo $r['name'];  ?></td>
                                                            <td><?php  echo $r['gander'];  ?></td>

                                                            <!-- checking admin and user -->
                                                            <?php  if($role === 'super_admin'){  ?>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="collect-fee/student_fee.php?id=<?php echo $r['id'];   ?>" class="btn btn-sm btn-secondary">
                                                                         <i class="fas fa-dollar-sign"> COLLECT FEE</i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <?php  }  ?>
                                                        </tr>

                                                       <?php 

                                                    endforeach;

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <?php
                        


                        endif;

                     ?>
            </div>
            </div>
        </div>
    </div>
</body>
</html>