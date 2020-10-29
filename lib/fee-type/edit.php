<?php

include_once dirname(__DIR__). '/../classes/fee_type.php';
$fee = new Fess();

// Validation
$error_name = [];

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $fee_type = $_POST['fee_type'];
    $code = $_POST['code'];
    $description = $_POST['description'];
     
  
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
    
       
    
    
        // Find Length
    
        $length = count($error_name);

        if ($length  === 0) {

    if($fee->Update($id , $fee_type , $code , $description , $currentDateTime)){

       
        echo "<script> window.location = 'fee-type/create.php?update'</script>";

    }else{

        echo "<script> window.location = 'fee-type/create.php?notupdate'</script>";
    }

}


}



?>