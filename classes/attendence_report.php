<?php

// include Db connection
include_once 'db.php';

class Attendence_report extends db {

    // Get course id form course
    public function getCourse($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            ?><option value="">Select Course</option><?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <option value="<?php echo $row['id']  ?>"><?php echo $row['name'];  ?></option>
                <?php
            }
        }
    }

    // SELECT RECORDS
    public function getData($course_id , $att_date){

        $date = $_SESSION['date'];

        $sql = $this->db->prepare("SELECT students.sname , students.fname , students.phone , courses.name , students.id as student_id , courses.id as course_id FROM `students` INNER JOIN `courses` ON students.course_id = courses.id WHERE course_id  = :course_id");

        $sql->bindParam(":course_id" , $course_id);
        $sql->execute();

        if($sql->rowCount() > 0){

            $stmt = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;

        }
    }

        // Present Query
        public function getPresent($sql ,  $student_id , $course_id , $month){

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":student_id" , $student_id);
            $stmt->bindParam(":course_id" , $course_id);
            $stmt->bindParam(":months" , $month);

            $stmt->execute();
       
            $present = $stmt->rowCount();
            return $present;

        }


        // Absent Query
        public function getAbsent($sql , $student_id , $course_id , $month){

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":student_id" , $student_id);
            $stmt->bindParam(":course_id" , $course_id);
            $stmt->bindParam(":months" , $month);

            $stmt->execute();

            $absent = $stmt->rowCount();
            return $absent;

        }


        // Lates Query
        public function getLates($sql , $student_id , $course_id , $month){

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":student_id" , $student_id);
            $stmt->bindParam(":course_id" , $course_id);
            $stmt->bindParam(":months" , $month);

            $stmt->execute();

            $lates = $stmt->rowCount();
            return $lates;

        }

        // Halfday Query
        public function getHalfday($sql , $student_id , $course_id , $month){

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":student_id" , $student_id);
            $stmt->bindParam(":course_id" , $course_id);
            $stmt->bindParam(":months" , $month);

            $stmt->execute();

            $half = $stmt->rowCount();
            return $half;

        }

         // Holiday Query
         public function getHoliday($sql , $student_id , $course_id , $month){

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":student_id" , $student_id);
            $stmt->bindParam(":course_id" , $course_id);
            $stmt->bindParam(":months" , $month);

            $stmt->execute();

            $half = $stmt->rowCount();
            return $half;

        }


          // Total Days Query
          public function getTotals($sql , $student_id , $course_id , $month){

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":student_id" , $student_id);
            $stmt->bindParam(":course_id" , $course_id);
            $stmt->bindParam(":months" , $month);

            $stmt->execute();

            $total = $stmt->rowCount();
            return $total;

        }




}




?>