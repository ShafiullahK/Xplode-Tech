<?php

include_once dirname(__DIR__) . '/classes/assign_fee.php';

$assign = new Assign_Fee();


$fee_id = $_POST['fee_id'];
$fee_group_id = $_POST['fee_group_id'];
$fee_type_id = $_POST['fee_type_id'];
$date = $_POST['date'];
$amount = $_POST['amount'];

$currentDateTime = date('Y-m-d H:i:s');

$assign->Update($fee_id , $fee_group_id , $fee_type_id , $date , $amount , $currentDateTime);




?>