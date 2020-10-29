<?php

include_once dirname(__DIR__).'/classes/fee_type.php';

$fee = new Fess();

if(isset($_POST['id'])){

    $id = $_POST['id'];

    $fee->Delete($id);

    echo "<script> window.location = '../fee-type/create.php?delete'</script>";
}


?>

