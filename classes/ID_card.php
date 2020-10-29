<?php


if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include_once "db.php";


class ID_Card extends db {


    // GET Course
    public function getCourse($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            ?><option value="">Select Course</option><?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <option value="<?php echo $row['id']   ?>"><?php echo $row['name'];   ?></option>
                <?php
            }
        }
    }


    // Select Student with the help of query
    public function getStudent($sql , $id){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":course_id" , $id);
        $stmt->execute();

        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }



    // Select All element
    public function dataView($student_id , $course_id){
        $stmt = $this->db->prepare("SELECT  courses.name , students.* FROM `students` INNER JOIN `courses` ON students.course_id = courses.id INNER JOIN `academy` WHERE students.id = :students_id AND courses.id = :course_id");

        $stmt->bindParam(":students_id" , $student_id);
        $stmt->bindParam(":course_id" , $course_id);

        $stmt->execute();
        
        $s = $stmt->fetch(PDO::FETCH_ASSOC);
        return $s;
    }

    // Academy Logo And overall
    public function SelectLogo($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $a = $stmt->fetch(PDO::FETCH_ASSOC);
        return $a;

    }

}





?>