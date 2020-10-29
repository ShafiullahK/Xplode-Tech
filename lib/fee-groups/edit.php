<?php

include_once dirname(__DIR__) . '/../classes/fee_group.php';

$Group = new Fee_Group();

// Validation
$error_name = [];

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $fee_group = $_POST['fee_group'];
    $description = $_POST['description'];
    $currentDateTime = Date('Y-m-d H:i:s');


     // Required Check
     if(empty($fee_group)){

        $error_name['fee_group'] = "<p style='color:red'>Fee Group is required</p>";
        
    }



    // Find Length

    $length = count($error_name);

    if ($length  === 0) {

    if($Group->Update($id , $fee_group , $description , $currentDateTime)){

        echo "<script> window.location = 'fee-groups/create.php?update'</script>";

    }else{


        echo "<script> window.location = 'fee-groups/create.php?notupdate'</script>";

    }

}

}



?>
