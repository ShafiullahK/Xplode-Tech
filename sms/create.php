<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php   require_once '../layouts/header.php';    ?>
    <title>Send Message - Xplode Academy Management System</title>
</head>
<body style="height: 100hv">
    <div class="container-fluid">
        <div class="row">

            <?php  require_once dirname(__DIR__) . '../layouts/sidebar.php';    ?>

            <div class="col-sm-10 main-area">
            
            <?php require_once "../layouts/navbar.php";   ?>

                <!-- main content -->
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">SEARCH STUDENTS TO SEND SMS</div>
                                <div class="card-body">
                                    <form action="sms/create.php" method="post">
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="course_id" style="color:black">Search By Course</label>
                                                    <select name="course_id" id="course_id" class="form-control">
                                                        <?php

                                                            include_once dirname(__DIR__) . '/classes/sms.php';
                                                            $sms = new SMS();

                                                            $sql = "SELECT * FROM `courses`";

                                                            $sms->getCourse($sql);

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group mb-3 mt-4">
                                                    <input type="text" name="st_name" id="st_name" placeholder="Search Student" class="form-control" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button type="submit" name="search" class="btn btn-dark">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                        <?php   include_once dirname(__DIR__) . '/lib/sms/send_sms.php';     ?>
                                        

                                    <?php
                                                if(isset($_POST['search'])){

                                                    $course_id = $_POST['course_id'];
                                                    $st_name = $_POST['st_name'];

                                                   $student = $sms->getStudent($course_id , $st_name);

                                                  
                                                }


                                    ?>
                                </div>
                            </div>
                                <?php if(isset($student)) : if(count($student) > 0):   ?>
                                <!-- Student -->
                                <!-- Result -->
                                <div id="result"></div>
                                <div class="card mt-3">
                                    <div class="card-header">
                                        MESSAGE
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <textarea class="form-control" id="message-text" rows="6" placeholder="Enter text message "></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header">SEARCH RESULT</div>
                                    <div class="card-body">
                                        <label for="all-students">
                                            <input type="checkbox" id="all-students">
                                            Send to all students
                                        </label>
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive mt-4">
                                                    <table class="table table-hover" id="students-table-wrapper">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>
                                                                    <input type="checkbox" id="check-all">
                                                                </th>
                                                                <th>Admission No.</th>
                                                                <th>Student Name</th>
                                                                <th>Father Name</th>
                                                                <th>Course</th>
                                                                <th>Phone No.</th>
                                                                <th>Gender</th>

                                                            </tr>

                                                        </thead>
                                                            <?php

                                                                foreach($student as $s):
                                                                    ?>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="checkbox" id="id" class="id" name="id" value="<?php echo $s['id'];    ?>">
                                                                            </td>
                                                                            <td><?php echo $s['admission_no'];   ?></td>
                                                                            <td><a href="students/show.php?id=<?php   echo $s['id'];    ?>"style="text-decoration:none;"><?php echo $s['sname'];    ?></a></td>
                                                                            <td><?php echo $s['fname'];   ?></td>
                                                                            <td><?php echo $s['name'];   ?></td>
                                                                            <td><?php echo $s['phone'];   ?></td>
                                                                            <td><?php echo $s['gander'];   ?></td>

                                                                        </tr>
                                                                    <?php
                                                                endforeach;


                                                                ?>


                                                    </table>

                                                </div>

                                              <!-- Save -->
                                              <!-- checking admin and user -->
                                              <?php   if($role === 'super_admin'){  ?>
                                                <button style="submit" class="btn btn-primary mt-4 float-right" id="send-message">
                                                    Send Message
                                                </button>
                                              <?php  } ?>

                                                <script>
                                                   $(document).ready(function(){

                                                      let tableHidden = false;
                                                       
                                                       $('#all-students').change(function(){
                                                           
                                                           tableHidden = $(this).is(':checked');
                                                           
                                                           if(tableHidden){

                                                               $('#students-table-wrapper').fadeOut();

                                                           }else{

                                                               $('#students-table-wrapper').fadeIn();
                                                           }
                                                       })

                                                       
                                                        $('#check-all').click(function(){

                                                            $('.id').not(this).prop('checked', this.checked);                                                            
                                                            
                                                        })

                                                        $('#send-message').click(function(){
                                                            
                                                            let inputs = 
                                                            document.getElementsByClassName('id');

                                                            let checked = [];

                                                            Array.from(inputs).forEach(input => {
                                                                
                                                                if(input.checked) checked.push(input.value);

                                                            })

                                                                if( ! $('#all-students').is(':checked') && checked.length === 0 ){
                                                                    
                                                                    alert('Please select student(s) first')
                                                                    return;
                                                                }

                                                                // Ajax

                                                                $.ajax({
                                                                    type: 'post',
                                                                    url:  'lib/sms/send_sms.php',
                                                                    beforeSend: function(){

                                                                        $('#send-message').prepend('<span class="spinner-border spinner-border-sm"></span>')
                                                                    },
                                                                    dataType: 'html',
                                                                    data: {
                                                                        messageText: $('#message-text').val(),
                                                                        all: $('#all-students').is(':checked'),
                                                                        id: checked
                                                                    },
                                                                    success: function(res){

                                                                        $('#send-message').removeAttr('disabled');
                                                                        $('#send-message').children('span').remove();

                                                                        if(res.match(/success/gi)) {
                                                                            $('#result').html(
                                                                                `<div class="alert alert-success">SMS send successfully</div>`
                                                                            );

                                                                            return;
                                                                        }
                                                                        $('#result').html(
                                                                            `<div class="alert alert-danger">
                                                                                Message not send. ${res}
                                                                            </div>`
                                                                        );
                                                                    }
                                                                })
                                                        })
                                                   })
                                                </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php else:   ?>
                                    <h3><b>No records found</b></h3>
                                <?php endif; endif;  ?>

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>