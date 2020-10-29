<?php



include_once dirname(__DIR__) . '/../classes/assign_fee.php';
$assign = new Assign_Fee();

// Validation
$error_name = [];


if(isset($_POST['submit'])){
    
    $fee_group_id = $_POST['fee_group_id'];
    $fee_type_id = $_POST['fee_type_id'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];

    // SET SESSION 
    
    $_SESSION['date'] = $date;
    $_SESSION['amount'] = $amount;

    $currentDateTime = date('Y-m-d H:i:s');


    // Numeric Check
    if(! is_numeric($amount)){

        $error_name['amount'] = "<p style='color:red'>Amount is numeric</p>";

    }


     // Required Check
     if(empty($fee_group_id)){

        $error_name['fee_group_id'] = "<p style='color:red'>Fee Group is required</p>";
        
    }

    if(empty($fee_type_id)){

        $error_name['fee_type_id'] = "<p style='color:red'>Fee Type is required</p>";
        
    }


    if(empty($date)){

        $error_name['date'] = "<p style='color:red'>Date is required</p>";
        
    }

    if(empty($amount)){

        $error_name['amount'] = "<p style='color:red'>Amount is required</p>";
        
    }


    $length = count($error_name);

    if ($length  === 0) {



    if($assign->Create($fee_group_id , $fee_type_id , $date , $amount , $currentDateTime)){

        // unset SESSION  
        unset($_SESSION['date']); 
        unset($_SESSION['amount']); 

        echo "<script> window.location = 'assign-fee/create.php?success'</script>";

    }else{

        echo "<script> window.location = 'assign-fee/create.php?not'</script>";

    }

}



}



?>

