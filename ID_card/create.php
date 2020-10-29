<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
        <title>Students ID Cards - Xplode Academy Management System</title>
    
</head>
<body style="height: 100hv">
    <div class="container-fluid">
        <div class="row">

        <?php require_once dirname(__DIR__) .'/layouts/sidebar.php' ?>

            <div class="col-sm-10 main-area">

            <?php require_once dirname(__DIR__) .'/layouts/navbar.php' ?>

            <?php require_once  '../layouts/errors.php'; ?>

                <!-- main content goes here -->
                 <div class="container mt-3">
                     <div class="row">
                         <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">SEARCH STUDENTS TO VIEW ID CARDS</div>
                                <div class="card-body">
                                    <form action="ID_card/showCard.php" method="post">
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="course_id" style="color:black">Search By Course</label>
                                                    <select name="course_id" id="course_id" class="form-control">
                                                        <?php 

                                                            require_once dirname(__DIR__) . '/classes/ID_card.php';
                                                            $card = new ID_Card();

                                                            $sql = "SELECT * FROM `courses`";

                                                            $card->getCourse($sql);
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group mb-3 mt-4">
                                                    <select name="student_id" id="student_id" class="form-control">
                                                        <option value="">Select Student</option>
                                                    </select>

                                                    <div class="input-group-append">
                                                         <button type="submit" name="search" class="btn btn-dark">Search</button>
                                                    </div>
                                                </div> 
                                                    <?php

                                                        if(isset($_GET['required'])){
                                                            ?>
                                                                <p style="color:red">The Student feild is required</p>
                                                            <?php
                                                        }

                                                    ?>
                                                
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                         </div>
                     </div>
                 </div> 


            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){

            $('#course_id').change(function(){
               var id =  $(this).val();

               $.ajax({
                   type: 'get',
                   url: 'lib/ID_card/getStudent.php',
                   dataType: 'html',
                   data: {id},
                   success:function(response){
                     
                     let options = '';

                     JSON.parse(response).forEach(function(student){
                         options += `<option value="${student.id}">${student.sname}</option>`

                     })

                          $('#student_id').html(options);

                   }

               });

            });

        });
           
        
    
    </script>
</body>
</html>