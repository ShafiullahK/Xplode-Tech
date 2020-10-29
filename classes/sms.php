<?php

include_once 'db.php';

class SMS extends db {

    // GET Course
    public function getCourse($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            ?><option value="">Select Course</option><?php    
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <option value="<?php echo $row['id']   ?>"><?php  echo $row['name'];  ?></option>
                <?php
            }
        }
    }

    // Get Student
    public function getStudent($course_id , $st_name){

        $sql = $this->db->prepare("SELECT courses.name , students.* FROM `students` INNER JOIN `courses`ON students.course_id = courses.id WHERE sname LIKE :sname AND course_id = :course_id");

        $sname = '%' . $st_name . '%';

        $sql->bindParam(":sname" , $sname);
        $sql->bindParam(":course_id" , $course_id);

        $sql->execute();

        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;

        

    }


    // Send Message
    public function sendSMS($text_message , $all , $students){
        $numbers = [];
        try {

            if($students !== NULL) {
            
            foreach($students as $student_id):

            $sql = $this->db->prepare("SELECT students.fphone FROM `students` where id = :students_id");
            $sql->bindParam(":students_id", $student_id);

            $sql->execute();

            if($sql->rowCount() > 0){

                $a = $sql->fetch(PDO::FETCH_ASSOC);

                array_push($numbers, $a['fphone']);

             }
             

            endforeach;

            

        }elseif($students === NULL && $all) {


                $sql = $this->db->prepare("SELECT * FROM `students`");

                $sql->execute();

                if($sql->rowCount() > 0){

                    $full = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($full as $record) {
                        array_push($numbers, $record['fphone']);
                    }


                    
                }

            }


            return $numbers;

            
        } catch (PDOException $e) {

            echo 'Error please check' .$e->getMessage();
            return FALSE;
        }
        
        
    }



    // GET SMS CREDENTIALS ID
    public function getID($id){
        $sql = $this->db->prepare("SELECT * FROM `sms_creadentials` WHERE id = 1");

        $sql->bindParam(1 , $id);
        $sql->execute();

        $editrow = $sql->fetch(PDO::FETCH_ASSOC);

        return $editrow;
    }


    // SELECT SMS CREDENTIALS 
    public function dataView($sql){
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
       
          $res = $stmt->fetch(PDO::FETCH_ASSOC);
         return $res;
        

    }




    // UPDATE QUERY SMS CREDENTIALS 
    public function Update($id , $username , $password , $sender){
        try {
             $sql = $this->db->prepare('UPDATE `sms_creadentials` SET username = :username , `password` = :pass , sender = :sender WHERE id = :id');

             $sql->bindParam(":id" , $id);
             $sql->bindParam(":username" , $username);
             $sql->bindParam(":pass" , $password);
             $sql->bindParam(":sender" , $sender);

             $sql->execute();
             return TRUE;
            
        } catch (PDOException $e) {
            echo 'Error Please check' .$e->getMessage();
            return FALSE;
        }
    }



}






?>