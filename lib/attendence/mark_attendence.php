<?php


include_once dirname(__DIR__) . '/../classes/attendence.php';
$attendence = new Student_attendence();



$date = $_POST['date'];
$studentAttendences = $_POST['studentAttendences'];


$currentDateTime = date('Y-m-d H:i:s');


foreach($studentAttendences as $s):

    $attTypeID = explode('-', $s)[0];
    $stAttId = explode('-', $s)[1];

    $sql =  "UPDATE `student_attendences` SET attendence_type_id = :attendence_type_id , updated_at = :updated_at WHERE student_attendences.id = :id";

    $attendence->Update($sql , $attTypeID , $stAttId , $currentDateTime);


endforeach;







?>