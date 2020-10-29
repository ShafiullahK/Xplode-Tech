<?php

include_once dirname(__DIR__) . '/classes/courses.php';
$course = new Courses();


if(isset($_POST['id'])){

    $id = $_POST['id'];

    $course->Delete($id);

    echo "<script> window.location = 'view.php?delete'</script>";
}



?>

