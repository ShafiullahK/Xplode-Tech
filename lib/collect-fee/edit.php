<?php

include_once dirname(__DIR__) . '/../classes/collect_fee.php';

$collect = new Collect_Fee();

// Validation
$error_name = [];

$paid = $_POST['paid'];
$discount = $_POST['discount'];
$fine = $_POST['fine'];
$date = $_POST['date'];
$fee_type_id = $_POST['fee_type_id'];
$fee_group_id = $_POST['fee_group_id'];
$students_id = $_POST['students_id'];

$currentDateTime = date('Y-m-d H:i:s');


// Numeric Check
if(! is_numeric($paid)){

    $error_name['paid'] = "<p style='color:red'>Paid is numeric</p>";

}


if(! is_numeric($discount)){

    $error_name['discount'] = "<p style='color:red'>Discount is numeric</p>";

}



// Required Check
if(empty($fee_group_id)){

    $error_name['fee_group_id'] = "<p style='color:red'>Fee Group is required</p>";
    
}




     // Required Check
     if(empty($paid)){

        $error_name['paid'] = "<p style='color:red'>Amount is required</p>";
        
    }



    if(empty($date)){

        $error_name['date'] = "<p style='color:red'>Date is required</p>";
        
    }

    // Find Length
 $length = count($error_name);

 $json_decode = json_encode(['verrors' =>  $error_name]);

 print_r($json_decode);
 

 if ($length  === 0) {

// Select payment Id
$sql = "SELECT * FROM `payment` WHERE student_id = :student_id AND fee_type_id = :fee_type_id AND fee_group_id = :fee_group_id";

$total =  $collect->getPaymentID($sql , $fee_type_id , $fee_group_id , $students_id);


 

// Inert data in payment table
$collect->Insert($paid , $discount , $fine , $date , $fee_type_id , $fee_group_id , $students_id , $total , $currentDateTime);

 }