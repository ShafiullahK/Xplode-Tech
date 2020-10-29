<?php


require_once dirname(__DIR__). '/classes/expenses.php';
$expens = new Expenses();

if(isset($_POST['id'])){

    $id = $_POST['id'];

    $expens->Delete($id);

    echo "<script> window.location = '../expenses/create.php?delete'</script>";
}




?>