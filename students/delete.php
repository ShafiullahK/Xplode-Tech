<?php

include_once dirname(__DIR__). '/classes/students.php';

$students = new Students();

if(isset($_POST['id'])){

    $id = $_POST['id'];

    $students->Delete($id);

    echo "<script> window.location = 'view.php?delete'</script>";
}




?>
