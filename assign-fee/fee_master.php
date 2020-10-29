<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title> Assign Fee  - Xplode Academy Management System</title>
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
                            <div class="card-header" style="background:black; color:#fff">SEARCH STUDENTS TO ASSIGN FEE GROUP</div>
                            <div class="card-body">
                                <form action="assign-fee/fee_master.php" method="post">
                                    <div class="row mb-2">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="course_id"><b>Search by Course</b></label>          
                                            <select name="course_id" id="course_id" class="form-control">
                                                <?php

                                                        require_once dirname(__DIR__) . '/classes/assign_fee.php';
                                                        $assign = new Assign_Fee();

                                                        $sql = "SELECT * FROM `courses`";
                                                        $assign->getCourse($sql);

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

                                            


                                            $result = $assign->findOut($course_id , $fa_name , $fee_group_id);

                                            
                                        }
                                           
                                        

                                        if (!empty($_SESSION['fee_group_id'])) {
                                            $fee_group_id = $_SESSION['fee_group_id'];
                                        }

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                            <br>
                            <?php if(isset($result)): ?>
                                    <div class="card">
                                        <div class="card-header" style="background:black; color:#fff">SEARCH RESULTS</div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <h6 class="text-info" style="font-size:95%;"><?php  

                                                            include_once dirname(__DIR__) . '/classes/assign_fee.php';
                                                            $assign = new Assign_Fee();

                                                            $res = $assign->getData($fee_group_id);
                                                            $a = $res[0]['fee_group']. ' (FEE GROUP)' ;

                                                            echo $a;
                                                    ?></h6>
                                                        <hr>
                                                        <ul class="list-group-flush" style="font-size:90%;">
                                                           
                                                           <?php foreach ($res as $ft):  ?>
                                                               <li class="list-group-item" style="border:none;"><?= $ft['fee_type']; ?>

                                                               <span class="badge badge-secondary float-right" style="padding:7px; font-size:10px">
                                                                            <?php echo number_format($ft['amount'])    ?>
                                                                        </span>
                                                               </li>
                                                           
                                                           <?php endforeach ?>
                                                        </ul>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="table-responsive mt-4">
                                                        <table id="cour" class="table table-hover" style="width:100%">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>
                                                                        <input type="checkbox" name="check-all" id="check-all">
                                                                    </th>
                                                                    <th>Admission No.</th>
                                                                    <th>Student Name</th>
                                                                    <th>Father's Name</th>
                                                                    <th>Course</th>
                                                                    <th>Phone No</th>
                                                                    <th>Gender</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                if (count($result) > 0) :
                                                                foreach($result as $d):

                                                                ?>
                                                                    <tr>
                                                                        <td><input type="checkbox" name="students_id"  
                                                                        class="student_id" value="<?php  echo $d['id'];   ?>"></td>
                                                                        <td><?php  echo $d['admission_no'];   ?></td>
                                                                        <td><a href="students/show.php?id=<?php  echo $d['id'];   ?>" style="text-decoration:none;"><?php echo $d['sname'];   ?></a></td>
                                                                        <td><?php  echo $d['fname'];   ?></td>
                                                                        <td><?php  echo $d['name'];   ?></td>
                                                                        <td><?php  echo $d['phone'];   ?></td>
                                                                        <td><?php  echo $d['gander'];   ?></td>
                                                                        
                                                                    </tr>
                                                                    <?php
                                                                        endforeach;

                                                                        else:
                                                                    ?>

                                                                    <tr>
                                                                        <td colspan="6"><h3>No records found</h3></td>
                                                                    </tr>

                                                                        <?php endif; ?>
                                                            
                                                            </tbody>
                                                        </table>
                                                </div>

                                                <!-- Check -->
                                                <script>
                                                    $(document).ready(function(){
                                                        $('#check-all').click(function(){

                                                            $('input:checkbox').not(this).prop('checked', this.checked);                                                            
                                                            
                                                        })
                                                    });
                                                </script>
                                                     <input type="hidden" name="fee_group" class="fee_group" value="<?php echo $fee_group_id ?>">
                                                            <!-- end save -->
                                                            <!-- alert message -->
                                                            <div id="result"></div>
                                                            
                                                          <button type="submit" class="btn btn-primary mt-4 float-right" id="assign-fee-group">Assign Fee Group</button>  
                                                </div>

                                                <script>
                                                    $(document).ready(function(){

                                                        $('#assign-fee-group').click(function(){

                                                            var student = $('.student_id:checked');
                                                            var fee_group = $('.fee_group').val();
                                                    
                                                            let ids = [];

                                                            Array.from(student).forEach(id => {

                                                                ids.push(id.value);
                                                   
                                                            })

                                                            if(ids.length === 0){

                                                                alert('Please Select Student(s) first');
                                                                return;
                                                            }

                                                            // Ajax
                                                            $.ajax({
                                                                type: 'post',
                                                                url: 'lib/assign-fee/master.php',
                                                                beforeSend: function(){

                                                                    $('#assign-fee-group').attr('disabled', true);

                                                                    $('#assign-fee-group').prepend(`<span class="spinner-border spinner-border-sm"></span>`)
                                                                },
                                                                dataType: 'html',
                                                                data: {id: ids , fee_group},
                                                                success:function(data , status){
                                                                    
                                                                    
                                                                   
                                                                   $('#assign-fee-group').removeAttr('disabled')
                                                                   $('#assign-fee-group').children('span').remove();

                                                                   $('#result').html(
                                                                    `<div class="alert alert-success">

                                                                        Fee Group assigned Successfully

                                                                         </div>`);
                                                                    
                                                                    
                                                                }
                                                            })

                                                            
                                                            

                                                        })
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                            <?php  endif;  ?>

                            
                        
            </div>

            </div>
        </div>
    </div>
</body>
</html>