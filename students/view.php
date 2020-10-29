<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) . '/layouts/header.php';   ?>
    <title>Students - Xplode Academy Management System</title>
</head>
<body style="height: 100vh">
    <div class="container-fluid">
        <div class="row">
            <?php require_once '../layouts/sidebar.php';    ?>

            <div class="col-sm-10 main-area">
                <?php  require_once '../layouts/navbar.php';   ?>
                <div class="container mt-3">
                    <div class="row">
                    
                        <!-- Update message start -->
                        <div class="container">
                        <?php

                        if(isset($_GET['update'])){
                            ?>
                            <div class="alert alert-success"role="alert"><strong>Student updated Successfully</strong></div>
                            <?php
                        }

                        ?>
                        </div>
                        <div class="container">
                        <?php

                        if(isset($_GET['notupdate'])){
                            ?>
                            <div class="alert alert-danger"role="alert"><strong>Sorry student not  updated</strong></div>
                            <?php
                        }

                        ?>
                        </div>
                        <!-- Update message end -->
                        <!-- Delete Message show -->
                           <div id="delete"></div>
                            <!-- Delete Message end -->

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">SEARCH STUDENTS</div>
                                <div class="card-body">
                                    <form  action="students/view.php" method="post">
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="course_id" style="color:black">Search by Course</label>
                                                    <select name="course_id" id="course_id" class="form-control">
                                                    <?php
                                                                
                                                                require_once dirname(__DIR__) . '/classes/students.php';
                                                                $student = new Students();
   
                                                                $sql = "SELECT * FROM `courses`";
                                                                $student->getCourse($sql);
   
   
                                                           ?>
                                                    
                                                    </select>
                                                </div>  
                                            </div>
                                            
                                            
                                            <div class="col-sm-6">
                                                <div class="input-group mb-3 mt-4">
                                                    <input type="text" name="st_name" id="st_name" class="form-control" placeholder="Search Student" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button type="submit" name="search" class="btn btn-dark">Search</button>
                                                    </div>
                                                </div>     
                                            </div>
                                         </div> 
                                         </div> 
                                         </div>
                                    </form>
                                    </div>

                                    <?php   
                                    
                                        if(isset($_POST['search'])){

                                            $course_id = $_POST['course_id'];
                                            $st_name = $_POST['st_name'];

                                            $students = $student->Filter($course_id , $st_name); 

                                           
                                                    
                                        }
                                        ?>

                                </div>
                            </div>
                                        <br>

                                    <?php if (isset($students)) : ?>
                                <div class="card ml-3 mr-3">
                                <div class="card-body">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#list-view"><i class="fas fa-list-alt"></i> List View</a>
                                            </li>
                                            <li class="nav-item">
                                                <a  class="nav-link" data-toggle="tab" href="#details-view"><i class="fas fa-address-card"></i> Detailed View</a>
                                            </li>
                                        </ul>

                                        
                                        <div class="tab-content">
                                            <div class="tab-pane  container active" id="list-view">
                                                <!-- List / Tabular View -->
                                                <div class="table-responsive mt-4">
                                                    <table id="cour" class="table  table-hover mt-4" style="width:100%">
                                                        <thead class="thead-light">
                                                                <tr>
                                                                    <th>Admission No.</th>
                                                                    <th>Student Name</th>
                                                                    <th>Father Name</th>
                                                                    <th>Phone No</th>
                                                                    <th>Father Phone No</th>
                                                                    <th>Gender</th>
                                                                        <!-- check role -->
                                                                    <?php if($role === 'super_admin'){   ?>
                                                                    <th>Action</th>

                                                                </tr>
                                                                    <?php    } ?>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                                if (count($students) > 0) :
                                                                foreach($students as $d):

                                                                ?>
                                                                    <tr>
                                                                        <td><?php  echo $d['admission_no'];   ?></td>
                                                                        <td><a href="students/show.php?id=<?php  echo $d['id'];   ?>" style="text-decoration:none;"><?php echo $d['sname'];   ?></a></td>
                                                                        <td><?php  echo $d['fname'];   ?></td>
                                                                        <td><?php  echo $d['phone'];   ?></td>
                                                                        <td><?php  echo $d['fphone'];   ?></td>
                                                                        <td><?php  echo $d['gander'];   ?></td>
                                                                            <!-- check role -->
                                                                        <?php if($role === 'super_admin'){     ?>

                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <a href="students/edit.php?id=<?php  echo $d['id'];   ?>" class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                                                                <a href="#" onclick="event.preventDefault(); deleteStudent(event , <?php echo $d['id'];   ?>)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
                                                                        <?php   }  ?>
                                                                    </tr>
                                                                    <?php
                                                                        endforeach;

                                                                        else:
                                                                    ?>

                                                                    <tr>
                                                                        <td colspan="7"><h3>No records found</h3></td>
                                                                    </tr>

                                                                        <?php endif; ?>
                                                                
                                                                
                                                        
                                                        </tbody>
                                                    
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Detailed view -->

                                            <div class="tab-pane container fade" id="details-view">
                                               <div class="row">
                                               <?php
                                                    foreach($students as $v):
                                                    ?>
                                                    
                                                    <div class="col-sm-12">
                                                        <div class="card tab-card mt-4">
                                                            <div class="card-body">
                                                                <div class="row justify-content-center">
                                                                    <div class="col-sm-2">
                                                                        <div id="image-wrapper" style="background: url(<?php echo ! empty($v['image']) ? 'uploads/'. $v['image'] : 'uploads/default.jpg' ?>) no-repeat; background-size:cover; background-position:center;">  
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <h6><a href="students/show.php?id=<?php echo $v['id'];  ?>" style="text-decoration:none;"><?php echo $v['sname'];   ?></a></h6>
                                                                        
                                                                       
                                                                        <span>
                                                                            Course:    
                                                                            <?php echo $v['name'];    ?></span>
                                                                        
                                                                        <span>
                                                                              Admission No:
                                                                            <?php  echo $v['admission_no'];   ?>
                                                                        </span>
                                                                       
                                                                        <span>
                                                                             Date Of Birth:
                                                                            <?php  echo $v['dob'];   ?>
                                                                        </span>
                                                                        
                                                                        <span>
                                                                            Gender:
                                                                            <?php echo $v['gander'];   ?></span>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <br><br>

                                                                        <span>
                                                                             Mobile No:
                                                                            <?php echo $v['phone'];   ?>
                                                                        </span>
                                                                        
                                                                        <span>
                                                                            CNIC No:
                                                                            <?php  echo $v['cnic'];   ?>
                                                                        </span>
                                                                        
                                                                        <span>
                                                                               Date Of Admission:
                                                                               <?php echo $v['fcnic'];    ?>
                                                                        </span>
                                                                        
                                                                        <span>
                                                                             Current Address:
                                                                            <?php  echo $v['address'];   ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                    <?php

                                                        endforeach;

                                                ?>
                                               </div> 
                                              


                                                   
                                            </div>
                                        </div>

                                </div>
                                </div>

                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

    window.deleteStudent = function(e , id){

       if(confirm('Are you sure you really want to delete this student ?\n Note: All the records associated with this student will also be removed.\n This action cannot be undone.')){

           $.ajax({
               url: 'students/delete.php',
               type: 'post',
               data: {id : id},
               success:function(data , status){
                   $('#delete').html(`<div class="alert alert-success"role="alert"></a><strong>Student deleted successfully</strong></div>`);

                       setTimeout(() => {
                           window.location.reload();
                       }, 1000);
               }
           })
       }
   };

</script>
</body>
</html>

