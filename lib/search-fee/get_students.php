<?php



require_once(__DIR__) . '/../../classes/search_fee.php';

$search = new Search_Fee();


$id = $_GET['id'];


$sql = "SELECT id, sname FROM `students` WHERE course_id = :course_id";


$student = $search->getStudentCourse($sql , $id);


echo json_encode($student);







?>