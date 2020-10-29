<?php


include_once dirname(__DIR__) . '/../classes/fee_type.php';

$fees = new Fess();

// Validation
$error_name = [];

if(isset($_POST['submit'])){

    $fee_type = $_POST['fee_type'];
    $code = $_POST['code'];
    $description = $_POST['description'];

     // SET SESSION 
    
     $_SESSION['fee_type'] = $fee_type;
     $_SESSION['code'] = $code;
     $_SESSION['description'] = $description;
    

    $currentDateTime = Date('Y-m-d H:i:s');

     // Numeric Check
     if(! is_numeric($code)){

        $error_name['code'] = "<p style='color:red'>Code is numeric</p>";

    }


    // Required Check
    if(empty($fee_type)){

        $error_name['fee_type'] = "<p style='color:red'>Fee type is required</p>";
        
    }

    if(empty($code)){

        $error_name['code'] = "<p style='color:red'>Code  is required</p>";
        
    }

    if(empty($description)){

        $error_name['description'] = "<p style='color:red'>Description  is required</p>";
        
    }


    // Find Length

    $length = count($error_name);

    if ($length  === 0) {

    if($fees->Create($fee_type , $code , $description , $currentDateTime)){

         // unset SESSION  
         unset($_SESSION['fee_type']); 
         unset($_SESSION['code']);
         unset($_SESSION['description']); 

        echo "<script> window.location = 'fee-type/create.php?insert'</script>";

    }else{

        echo "<script> window.location = 'fee-type/create.php?notinsert'</script>";

    }


}


}


?>

