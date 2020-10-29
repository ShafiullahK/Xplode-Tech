<?php


include_once "db.php";

class Student_attendence extends db {


    // GET Courses Name
    public function getCourses($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            ?><option value="">Select Course</option><?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo  $row['id'];  ?>"><?php echo $row['name'];   ?></option>
                <?php
            }
        }
    }


    // UPDATE QUERY 
    public function Update($sql , $attTypeID , $stAttId , $currentDateTime){
        try {


            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":attendence_type_id" , $attTypeID);
            $stmt->bindParam(":id" , $stAttId);
            $stmt->bindParam(":updated_at" , $currentDateTime);

            $stmt->execute();
                   
            
        } catch (PDOException $e) {
            
            echo "Error Something Wrong" .$e->getMessage();
            return FALSE;
        }

    }

    // UPDATE HOLIDAY WORK QUERY
    public function updateHoliday($sql , $date){
        try {
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":datee" , $date);

            $stmt->execute();
          
        } catch (PDOException $e) {
            echo 'Error pleace check' .$e->getMessage();
            return FALSE;
            
        }

    }


    // SELECT RECORD TO ATTENDENCE TYPE ID
    public function selectID($sql , $stTyID){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':student_type_id', $stTyID);
        
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res;

    }



    // SELECT RECORDS 
    public function getRecords($course_id , $date){
        
        $sql = $this->db->prepare("SELECT students.sname , students.fname , students.phone ,   courses.name , attendence_type.type , courses.id as course_id , students.id as students_id , attendence_type.id as attendence_type_id , student_attendences.id as student_attendenc_id , student_attendences.date as student_attendences_date FROM `student_attendences` INNER JOIN `students` ON student_attendences.student_id = students.id INNER JOIN `courses` ON student_attendences.course_id = courses.id LEFT JOIN attendence_type ON student_attendences.attendence_type_id = attendence_type.id WHERE courses.id = :course_id AND date = :datee");

        $sql->bindParam(':course_id' , $course_id);
        $sql->bindParam(':datee' , $date);

        $sql->execute();

        if($sql->rowCount() > 0){

    
        $stmt = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $stmt;


        }else{

            $s = $this->db->prepare("SELECT * FROM `students` WHERE course_id = :course_id");


            $s->bindParam(':course_id' , $course_id);
            $s->execute();

            $res = $s->fetchAll(PDO::FETCH_ASSOC);

            $currentDateTime = date('Y-m-d H:i:s');

            foreach($res  as $d):

                 $students_id = $d['id'];

                

                // INSERT QUERY
                $student = $this->db->prepare("INSERT INTO `student_attendences`(student_id , course_id , `date`  , created_at) VALUES(? , ? , ? , ?)");

                $student->bindParam(1 , $students_id);
                $student->bindParam(2 , $course_id);
                $student->bindParam(3 , $date);
                $student->bindParam(4 , $currentDateTime);

                $student->execute();
                

                
                
            endforeach;


            $sql = $this->db->prepare("SELECT students.sname , students.fname , students.phone ,   courses.name , attendence_type.type , courses.id as course_id , students.id as students_id , attendence_type.id as attendence_type_id , student_attendences.id as student_attendenc_id , student_attendences.date as student_attendences_date FROM `student_attendences` INNER JOIN `students` ON student_attendences.student_id = students.id INNER JOIN `courses` ON student_attendences.course_id = courses.id LEFT JOIN attendence_type ON student_attendences.attendence_type_id = attendence_type.id WHERE courses.id = :course_id AND date = :datee");

        $sql->bindParam(':course_id' , $course_id);
        $sql->bindParam(':datee' , $date);

        $sql->execute();


            $stmt = $sql->fetchAll(PDO::FETCH_ASSOC);
        
            return $stmt;



            
        }

        
        

    }
    
}



?>