<?php

include_once dirname(__DIR__) . '/../classes/assign_fee.php';
$assign = new Assign_Fee();


$ids = $_POST['id'];
$fee_group = $_POST['fee_group'];

$currentDateTime = date('Y-m-d H:i:s');

$assign->GetFunc($ids  , $fee_group , $currentDateTime);


?>