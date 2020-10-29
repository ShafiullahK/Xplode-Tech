<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();


}

?>

<!DOCTYPE html>
<html lang="en">
<head>

        <?php  require_once dirname(__DIR__) .'/layouts/header.php';   ?>
         <script  src="js/qrcode.min.js"></script>
        <title>Students ID Cards - Xplode Academy Management System</title>
        <style>
            *{
                box-sizing:border-box;
            }

            .id-cards{
                width: 90%;
                margin: 60px auto;
                display: flex;
                
                
            }

            #card-wrapper{
                width:204px;
                height: 324px;
                position: relative;
                background: linear-gradient(#83b2db , #a6d2fc);
            }

            #card-wrapper #image-wrapper{
             width: 72px;
			height: 72px;
			margin: 10px auto;
			background-size: cover;
			background-position: center top;
			border: 2px solid grey;
                
            }

            #card-wrapper #header-top{
                background: #004F99;
                padding: 5px;
            }

    #card-wrapper #header-top #academy-name {
        margin-right: 10px;
        font-size: 11pt;
        text-align: center;
    }

        #pic-top-heading{
            font-size:9pt;
        }
 

            #card-wrapper img{
                width: 42px;
                height: 42px;
                object-fit: contain;
            }

            #card-wrapper #footer-area {
                width:100%;
                height:30px;
                background: #004F99;
                font-size:6.5pt;
                color:#fff;
                text-align:center;
                margin-top:5px;
                padding:2px;
                display:flex;
                justify-content:center;
                align-items:center;
                position:absolute;
                bottom:0;
            }


           #card-wrapper #sign{
                width:70px;
                height:40px;
                object-fit:contain;
                float:right;
                margin-bottom:5px;
                
            }

            #card-wrapper p,
            small{
                font-size:76%
            }

            #card-wrapper.back{
                display:flex;
                justify-content:center;
                align-items:center;
            }

            #card-wrapper.back #qrCode{

                width:80px;

            }

            
            

        
        </style>
      
</head>
<body style="background: #fff !important">

    <?php

            include_once dirname(__DIR__) . '/classes/ID_card.php';
            $card = new ID_Card();

            $error_name = [];

            if(isset($_POST['search'])){

                $student_id = $_POST['student_id'];
                $course_id = $_POST['course_id'];

                
                // Required Checked
                if(empty($course_id)){
                    $error_name['course_id'] = '<p style="color:red">The Course field is required</p>';
                }

                if(empty($student_id)){
                    $error_name['student_id'] = '<p style="color:red">The Student field is required</p>';
                }

                // Find length
                $length = count($error_name);
                
            }



    ?>

<?php
                                                if(@$length === 0){

                                                  $record =  $card->dataView($student_id , $course_id);


                                                  
                                                } else {
                                                   echo '<script>window.location = "ID_card/create.php?required"</script>';
                                                }


                                                $sql = "SELECT * FROM `academy`";
                                                $show = $card->SelectLogo($sql);
         
                                    ?>


                    <?php  if($record !== NULL && $record !== FALSE):   ?>

                    
                                
                 <div class="container">
                     <div class="row justify-content-center">
                         <div class="col-sm-6">
                            
                            <div class="id-cards">
                                <!-- Card Front -->
                                <div id="card-wrapper">
                                    <div id="header-top">
                                        <div class="row">

                                        <div class="col-md-3 col-3 text-center">
                                            <img src="uploads/<?php  echo $show['logo'];  ?>" class="mb-2">
                                        
                                        </div>
                                        <div class="col-md-9 col-9">
                                            <h6 class="mt-2 text-white" id="academy-name">
                                                <?php  echo $show['name'];   ?>
                                            </h6>
                                        </div>
                                        </div>
                                    </div>
                                    <h6 class="text-center mt-2" id="pic-top-heading">IDENTITY CARD</h6>
                                    <div id="image-wrapper" style="background: url(<?php echo ! empty($record['image']) ? 'uploads/'. $record['image'] : 'uploads/default.jpg' ?>) no-repeat; background-size:cover; background-position:center;"></div>
                                    <h6 class="text-center" style="font-size:8pt">
                                        <strong><?php  echo $record['sname'];  ?></strong> s/o d/o
                                        <strong><?php  echo $record['fname'];  ?></strong>
                                    </h6>
                                    <p class="text-center" style="font-size:8pt">
                                        <strong>Course: </strong>
                                        <?php   echo $record['name'];  ?>
                                    </p>
                                    <div class="row">
                                        <div class="col-md-3 col-3"></div>
                                        <div class="col-sm-5 col-5 text-right">
                                            <strong><em style="font-size:6.2pt">Principle's Sign</em></strong>
                                        </div>
                                        <div class="col-md-4 col-4">
                                             <img src="uploads/<?php echo $show['principle']; ?>" id="sign">           
                                        </div>
                                    </div>

                                    <div id="footer-area">
                                        <em><?php echo $show['address'];   ?></em>
                                    </div>
                                </div>

                                <!-- Card front -->
                                <div id="card-wrapper" class="back">
                                    <div id="qrCode"></div>
                                </div>
                                                
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-4">
                                    <button class="btn btn-sm btn-primary btn-block no-print" id="printIDCard" style="padding:10px;">
                                        <i class="fas fa-print"></i> Print ID Card
                                    </button>
                                </div>
                            </div>
                         
                         </div>
                     </div>
                 </div>   
                    <?php  else:  ?>  
                    <h4>No record exists</h4>   
                    <?php endif;  ?>    


     <script>
            $(document).ready(function(){
                $('#qrCode').qrcode({
                    width: 80,
                    height: 80,
                    text: "<?php echo $record['admission_no'] !== NULL && $record['admission_no'] !== FALSE ? $record['admission_no'] : ''    ?>"
                    

                })
                

                // Print
                $('#printIDCard').click(function(){
                    window.print();
                })
                

            })
 </script>                   
    
</body>
</html>