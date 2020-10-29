<?php

// include Courses class
include_once dirname(__DIR__) . "/../classes/courses.php";


$courses = new Courses();

// Validation
$error_name = [];


if(isset($_POST['submit'])){
    

    $name = $_POST['name'];
    $code = $_POST['code'];
    $fee = $_POST['fee'];
    $years = $_POST['years'];
    $months = $_POST['months'];
    $weeks = $_POST['weeks'];

    // SET SESSION 
    
    $_SESSION['name'] = $name;
    $_SESSION['code'] = $code;
    $_SESSION['fee'] = $fee;
    $_SESSION['years'] = $years;
    $_SESSION['months'] = $months;
    $_SESSION['weeks'] = $weeks;
   

    $currentDateTime = Date('Y-m-d H:i:s');


    // Numeric Check
    if(! is_numeric($code)){

        $error_name['code'] = "<p style='color:red'>Code is numeric</p>";

    }

    if(! is_numeric($fee)){

        $error_name['fee'] = "<p style='color:red'>Fee is numeric</p>";

    }


    // Required Check
    if(empty($name)){

        $error_name['name'] = "<p style='color:red'>Name is required</p>";
        
    }

    if(empty($code)){

        $error_name['code'] = "<p style='color:red'>Code is required</p>";
        
    }

    if(empty($fee)){

        $error_name['fee'] = "<p style='color:red'>Fee is required</p>";
        
    }


    $length = count($error_name);

    if ($length  === 0) {

        if($courses->Create($name , $code , $fee , $years , $months , $weeks , $currentDateTime)){

              // unset SESSION  
            unset($_SESSION['name']); 
            unset($_SESSION['code']);
            unset($_SESSION['fee']); 
            unset($_SESSION['years']); 
            unset($_SESSION['months']); 
            unset($_SESSION['weeks']); 

            echo "<script> window.location = 'courses/create.php?success'</script>";
            
        }else{
    
              echo "<script> window.location = 'courses/create.php?fail'</script>";
    
        }
    }


   
    


}




?>

