<?php

include_once dirname(__DIR__) . '/../classes/attendence.php';
$attendence = new Student_attendence();



$date = $_POST['date'];


$sql = "UPDATE `student_attendences` SET attendence_type_id = 5 WHERE date = :datee";

 $attendence->updateHoliday($sql , $date);









?>