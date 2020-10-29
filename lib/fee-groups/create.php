<?php


include_once dirname(__DIR__) ."/../classes/fee_group.php";

$Group = new Fee_Group();


// Validation
$error_name = [];

if(isset($_POST['submit'])){

    $fee_group = $_POST['fee_group'];
    $description = $_POST['description'];

     // SET SESSION 
    
     $_SESSION['fee_group'] = $fee_group;
     $_SESSION['description'] = $description;

     $currentDateTime = Date('Y-m-d H:i:s');


     // Required Check
    if(empty($fee_group)){

        $error_name['fee_group'] = "<p style='color:red'>Fee Group is required</p>";
        
    }

    if(empty($description)){

        $error_name['description'] = "<p style='color:red'>Description is required</p>";
        
    }


    // Find Length

    $length = count($error_name);


    if ($length  === 0) {


     if($Group->Create($fee_group , $description , $currentDateTime)){

         // unset SESSION  
         unset($_SESSION['fee_group']); 
         unset($_SESSION['description']); 

         echo "<script> window.location = 'fee-groups/create.php?insert'</script>";

     }else{

         echo "<script> window.location = 'fee-groups/create.php?notinsert'</script>";

     }


    }

}

 

?>

