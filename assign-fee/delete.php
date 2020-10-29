<?php


include_once dirname(__DIR__) . '/classes/assign_fee.php';

$assign = new Assign_Fee();


if(isset($_POST['id'])){

    $fee_group_id = $_POST['id'];

    $assign->removeData($fee_group_id);


    echo "<script> window.location = '../assign-fee/create.php?delete' </script>";
}


?>

