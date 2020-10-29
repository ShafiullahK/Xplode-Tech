<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
    <title>Search Fee - Xplode Academy Management System</title>
    
</head>
<body style="height: 100vh">
    <div class="container-fluid">
        <div class="row">
            <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

            <div class="col-sm-10 main-area" id="right-area">

                 <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

                 <div class="container mt-3">
                     <div class="row">
                         <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header" style="background:black; color:#fff">SEARCH STUDENTS TO VIEW FEE RECORDS</div>
                                <div class="card-body">

                                    
                                <?php           
                                                         // Validation
                                                         $error_name = [];

                                                if(isset($_POST['search'])){

                                                        $course_id = $_POST['course_id'];
                                                        $students_id = $_POST['students_id'];
                                                        $fee_status = $_POST['fee_status'];

                                                        // Required Check
                                                        if(empty($course_id)){

                                                            $error_name['course_id'] = "<p style='color:red'>The Course field is required</p>";
                                                            
                                                        }

                                                        if(empty($students_id)){

                                                            $error_name['students_id'] = "<p style='color:red'>The Student field is required</p>";
                                                            
                                                        }

                                                        // Find Length
                                                        $length = count($error_name);



                                                        

                                                    }
   

                                        ?>

                                    <form action="search-fee/create.php" method="post">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="course_id" style="color:black">Search By Course</label>
                                                    <select name="course_id" id="course_id" class="form-control">
                                                        <?php
                                                                
                                                                require_once dirname(__DIR__). '/classes/search_fee.php';
                                                                $search = new Search_Fee();

                                                                $sql = "SELECT * FROM `courses`";
                                                                $search->getCourse($sql);

                                                            ?>
                                                    </select>

                                                    <?php
                                                        echo @$error_name['course_id'];
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group mt-4">
                                                   <select name="students_id" id="students_id" class="form-control">
                                                   <option value="">Select Student</option></select>
                                                </div>
                                                <?php
                                                        echo @$error_name['students_id'];
                                                    ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group mb-3 mt-4">
                                                    <select name="fee_status" id="students" class="form-control">
                                                        <option value="Paid">Paid</option>
                                                        <option value="unpaid">Unpaid</option>
                                                        <option value="partial">Partial</option>
                                                        <option value="advance">Advance</option>
                                                        <option value="all">All</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button type="submit" name="search" class="btn btn-dark">Search</button>
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>
                                    </form>

                                    <?php
                                            if (@$length  === 0) {


                                                $result = @$search->getCourseAndStudent($course_id , $students_id);

                                                $Records =  @$search->SelectStatus($course_id , $students_id , $fee_status);

                                                }

                                         ?>

                                       
                                </div>
                            </div> 

                                <?php   

                                                if(isset($result)){

                               
                                        if( @$result === FALSE || @$result === null){
                                            
                                        ?>  
                                        <h4>No record found</h4>

                                        <?php
                                        

                                }else{

                                    if (count(@$result) > 0 ) {
                                    ?>

                                      
                            <!-- Search Students -->
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <div class="row justify-content-sm-center" id="student_info">
                                            <div class="col-sm-2 ">
                                            <div id="image-wrapper" 
                                            
                                            style="background: url(<?php echo ! empty($result['image']) ? 'uploads/'. $result['image'] : 'uploads/default.jpg' ?>) no-repeat; background-size:cover; background-position:center;">
                                            
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <h6>
                                                <a href="students/show.php?id=<?php  echo $result['id'];  ?>" style="text-decoration:none;"><?php echo $result['sname'];   ?></a>
                                            </h6>
                                            <span>
                                                    Course:    
                                                    <?php echo $result['name'];    ?></span>
                                                
                                                <span>
                                                        Admission No:
                                                    <?php  echo $result['admission_no'];   ?>
                                                </span>
                                                
                                                <span>
                                                        Date Of Birth:
                                                    <?php  echo $result['dob'];   ?>
                                                </span>
                                                
                                                <span>
                                                    Gender:
                                                    <?php echo $result['gander'];   ?></span>
                                            </div>
                                            <div class="col-sm-5">
                                                <br><br>

                                                <span>
                                                        Mobile No:
                                                    <?php echo $result['phone'];   ?>
                                                </span>
                                                
                                                <span>
                                                    CNIC No:
                                                    <?php  echo $result['cnic'];   ?>
                                                </span>
                                                
                                                <span>
                                                        Date Of Admission:
                                                        <?php echo $result['fcnic'];    ?>
                                                </span>
                                                
                                                <span>
                                                        Current Address:
                                                    <?php  echo $result['address'];   ?>
                                                </span>
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                                    <?php if(count($Records) == 0){
                                        ?>
                                            <h4>No records found</h4>
                                        <?php
                                    }else{
                                    
                                    ?>
                                    <div class="card mt-2">
                                        <div class="card-header" style="background:black; color:#fff">
                                            FEE RECORDS
                                            <button class="btn btn-print btn-sm btn-light no-print"title="Print"id="printBtn">
                                                <i class="fas fa-print"></i>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <!-- record Tabular view -->
                                            <div class="table-responsive mt-4">
                                                <table class="table table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Fee Group</th>
                                                            <th>Fee Type</th>
                                                            <th>Due Date</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                            <th>Payment ID</th>
                                                            <th>Date</th>
                                                            <th>Paid</th>
                                                            <th>Fine</th>
                                                            <th>Discount</th>
                                                            <th>Balance</th>
                                                        </tr>
                                                    </thead>
                                                   <tbody>
                                                        <?php
                                                            foreach($Records as $m):
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $m['fee_group'];   ?></td>
                                                                    <td><?php echo $m['fee_type'];   ?></td>
                                                                    <td><?php echo $m['date'];   ?></td>
                                                                    <td><?php echo $m['amount'];   ?></td>
                                                                    <td>
                                                                        <?php

                                                                            $status = $m['status'];

                                                                            
                                                                if($status == 'paid'){
                                                                    ?>
                                                                    <span class="badge badge-success" style="padding:7px;">Paid</span>
                                                                    <?php
                                                                    
                                                                }elseif($status == 'partial'){
                                                                    ?>
                                                                        <span class="badge badge-warning" style="padding:7px;">Partial</span>
                                                                    <?php

                                                                }elseif($status == 'Unpaid'){
                                                                    ?>
                                                                        <span class="badge badge-danger" style="padding:7px;">Unpaid</span>
                                                                    <?php

                                                                }elseif($status == 'advance'){
                                                                    ?>
                                                                        <span class="badge badge-primary" style="padding:7px">Advance</span>
                                                                    <?php

                                                                }

                                                                        ?>
                                                                    
                                                                    </td>
                                                                    <td><?php  echo $m['payment'];   ?></td>
                                                                    <td><?php  echo $m['due_date'];   ?></td>
                                                                    <td><?php  echo $m['paid'];   ?></td>
                                                                    <td><?php  echo $m['fine'];   ?></td>
                                                                    <td><?php  echo $m['discount'];   ?></td>
                                                                    <td><?php  echo $m['balance'];   ?></td>
                                                                </tr>

                                                                <tr>
                                                                        <?php
                                                                            $students = $m['students_id'];
                                                                            $fee_type = $m['fee_type_id'];
                                                                            $fee_group = $m['fee_group_id'];

                                                                            $sql = "SELECT * FROM `payment` WHERE student_id = :student_id AND fee_type_id = :fee_type_id AND fee_group_id  = :fee_group_id";
                                                                            
                                                                           $final =  $search->getPayment($sql , $students , $fee_type , $fee_group);
                                                                            
                                                                            foreach($final as $i):
                                                                                ?>

                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td class="text-right">
                                                                                    <img src="images/<?php   echo 'image.png';  ?>" alt="">
                                                                                </td>
                                                                                <td class="text-primary">
                                                                                    <?php echo $i['payment_id'];   ?>
                                                                                </td>
                                                                                <td><?php  echo $i['date'];  ?></td>
                                                                                <td><?php  echo $i['paid'];  ?></td>
                                                                                <td><?php  echo $i['fine'];  ?></td>
                                                                                <td><?php  echo $i['discount'];  ?></td>
                                                                                <td></td>
                                                                                
                                                                            </tr>

                                                                            <?php endforeach; ?>
                                                                    
                                                                <?php

                                                            endforeach;

                                                                ?>
                                                                <tr style="font-size: 102%">
                                                                    <td class="text-right">
                                                                        <strong>OVERALL TOTALS</strong>
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>
                                                                        <?php 
                                                                            $students = $result['id'];
                                                                            
                                                                            $sql = "SELECT SUM(amount) as `total` FROM `master` WHERE student_id = :students_id";

                                                                            $amount = $search->getAmount($sql , $students)
                                                                            ?>
                                                                                <strong><?php echo number_format($amount);   ?></strong>
                                                                            <?php  

                                                                        ?>
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>
                                                                        <?php

                                                                           

                                                                                $sql = "SELECT SUM(paid) as `paid` FROM `master` WHERE student_id = :students_id";

                                                                                $p = $search->getPaid($sql , $students);
                                                                                ?>
                                                                                    <strong><?php  echo number_format($p);  ?></strong>
                                                                                <?php

                                                                            ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                                 $sql = "SELECT SUM(fine) as `fine` FROM `master` WHERE student_id = :students_id";

                                                                                 $fine = $search->getFine($sql , $students);
                                                                                    ?>
                                                                                        <strong><?php echo number_format($fine);  ?></strong>
                                                                                    <?php

                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php

                                                                                $sql = "SELECT SUM(discount) as `discount` FROM `master` WHERE student_id = :students_id";

                                                                                $discount = $search->getDiscount($sql , $students);
                                                                                ?>
                                                                                    <strong><?php  echo number_format($discount); ?></strong>
                                                                                <?php
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php

                                                                                $sql = "SELECT SUM(balance) as `balance` FROM `master` WHERE student_id = :students_id";

                                                                                $bal = $search->getBalance($sql , $students);
                                                                                ?>
                                                                                    <strong><?php echo number_format($bal);  ?></strong>
                                                                                <?php

                                                                            ?>
                                                                    </td>
                                                                  </tr>
                                                                <?php
                                }

                                

                                                        }
                                                        
                                                            
                                                        ?>
                                                   </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                                    <?php     }?>
                                     
                                                   

                         </div>
                     </div>
                 </div>
            </div>
        </div>
        <?php }?>
    </div>
    <script>

         $(document).ready(function() {
	        $("#printBtn").click(function(e) {
		     $("#sidebar-toggler").addClass("no-print");
		        e.preventDefault();

		// Print mode
		$(".sidebar").css({ display: "none" });
		    $("#right-area")
			    .removeClass("col-sm-10")
			        .addClass("col-sm-12");

	    	window.print();

		// Normal mode
		$(".sidebar").css({ display: "block" });
		    $("#right-area")
			    .addClass("col-sm-10")
			    .removeClass("col-sm-12");
	});

});


    $(document).ready(function(){
        $('#course_id').change(function(){

            var id = $(this).val();

            $.ajax({
                type: 'get',
                url: 'lib/search-fee/get_students.php',
                data: {id},
                success:function(response){
                
                    

                    let options = "";
                    
                    JSON.parse(response).forEach(function(student) {
                        options += `<option value="${ student.id }">${ student.sname }</option>`;
                    })

                    $('#students_id').html(options);
                }
                

            });
        })

    });

    </script>
</body>
</html>