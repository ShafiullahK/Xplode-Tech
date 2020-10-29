<?php



require_once dirname(__DIR__) . '/../classes/students.php';
$student = new Students();


$id = $_GET['id'];


$sql = "SELECT fee FROM `courses` WHERE id = :id";

$fee = $student->getCouresID($sql , $id);

echo $fee;


?>