<?php

include_once dirname(__DIR__) . '/classes/assign_fee.php';

$assign = new Assign_Fee();

if(isset($_POST['id']) && isset($_POST['fee_group_id'])){

    $id = $_POST['id'];
    $fee_group_id = $_POST['fee_group_id'];

    $assign->delete($id , $fee_group_id);

    echo "<script> window.location = '../assign-fee/create.php?remove'</script>";

}



?>
