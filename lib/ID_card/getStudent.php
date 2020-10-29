<?php


require_once dirname(__DIR__) . '/../classes/ID_card.php';

$card = new ID_Card();

$id = $_GET['id'];

$sql = "SELECT id , sname FROM `students` WHERE course_id = :course_id";

$student = $card->getStudent($sql , $id);

// convert to json decode
echo json_encode($student);

?>