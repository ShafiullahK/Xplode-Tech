<?php

include_once "db.php";


class Search_Fee extends db {

    // GET COURSE
    public function getCourse($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            ?><option value="">Select Course</option><?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <option value="<?php  echo $row['id']  ?>"><?php  echo $row['name'];  ?></option>
                <?php
            }
        }
    }

    // GET STUDENTS
    public function getStudents($sql){

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            ?><option value="">Select Students</option><?php
           while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               ?>
                <option value="<?php echo $row['id'];  ?>"><?php  echo $row['sname']; ?></option>
               <?php
           } 
        }
    }



    // GET STUDENT FROM STUDENTS TABLE
    public function getStudentCourse($sql , $id){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":course_id" , $id);

        $stmt->execute();

        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arr;

    }


    // SELECT Status value
    public function SelectStatus($course_id , $students_id , $fee_status){


        if($fee_status == 'all'){

            $sql = $this->db->prepare("SELECT fee_groups.fee_group ,  fee_types.fee_type , assign_fee.amount , assign_fee.date , `master`.payment, `master`.paid , `master`.due_date ,`master`.fine , `master`.discount , `master`.balance ,`master`.amount , `master`.status ,      students.id  as students_id , fee_groups.id as fee_group_id , fee_types.id as fee_type_id FROM `master` INNER JOIN `fee_groups` ON `master`.fee_group_id = fee_groups.id  INNER JOIN fee_types ON `master`.fee_type_id = fee_types.id INNER JOIN assign_fee ON `master`.fee_type_id = assign_fee.fee_type_id AND `master`.fee_group_id = assign_fee.fee_group_id INNER JOIN `students` ON `master`.student_id = students.id WHERE  students.id = :students_id AND course_id = :course_id");

        }else{

            $sql = $this->db->prepare("SELECT fee_groups.fee_group ,  fee_types.fee_type , assign_fee.amount , assign_fee.date , `master`.payment, `master`.paid , `master`.due_date ,`master`.fine , `master`.discount , `master`.balance ,`master`.amount , `master`.status ,      students.id  as students_id , fee_groups.id as fee_group_id , fee_types.id as fee_type_id FROM `master` INNER JOIN `fee_groups` ON `master`.fee_group_id = fee_groups.id  INNER JOIN fee_types ON `master`.fee_type_id = fee_types.id INNER JOIN assign_fee ON `master`.fee_type_id = assign_fee.fee_type_id AND `master`.fee_group_id = assign_fee.fee_group_id INNER JOIN `students` ON `master`.student_id = students.id WHERE  students.id = :students_id AND course_id = :course_id AND `master`.status = :statuss");
        }

        $sql->bindParam(':students_id' , $students_id);
         $sql->bindParam(':course_id' , $course_id);

        if($fee_status !== 'all'){

            $sql->bindParam(':statuss' , $fee_status);
            
        }

        $sql->execute();

        $data  = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;


        

    }

   


    // Get Students
    public function getCourseAndStudent($course_id , $students_id){

        $stmt = $this->db->prepare("SELECT courses.name , students.* FROM `students`INNER JOIN `courses`ON students.course_id = courses.id WHERE students.id = :students_id AND courses.id = :coures_id");

        $stmt->bindParam(":students_id" , $students_id);
        $stmt->bindParam(":coures_id" , $course_id);

        $stmt->execute();

        $f = $stmt->fetch(PDO::FETCH_ASSOC);
        return $f;
    }


    // Get Payment
    public function getPayment($sql , $students , $fee_type , $fee_group){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":student_id" , $students);
        $stmt->bindParam(":fee_type_id" , $fee_type);
        $stmt->bindParam(":fee_group_id" , $fee_group);

        $stmt->execute();

        $q = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $q;


    }


    // GET AMOUNT 
    public function getAmount($sql , $students){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":students_id" , $students);
        $stmt->execute();

        $amount = $stmt->fetch(PDO::FETCH_ASSOC);

        return $amount['total'];
    }


    // GET paid
    public function getPaid($sql , $students){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":students_id" , $students);
        $stmt->execute();

        $paid = $stmt->fetch(PDO::FETCH_ASSOC);

        return $paid['paid'];
    }


    // GET FINE
    public function getFine($sql , $students){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":students_id" , $students);
        $stmt->execute();

        $fine = $stmt->fetch(PDO::FETCH_ASSOC);

        return $fine['fine'];

    }


    // GET DISCOUNT
    public function getDiscount($sql , $students){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":students_id" , $students);
        $stmt->execute();

        $discount = $stmt->fetch(PDO::FETCH_ASSOC);

        return $discount['discount'];
        
    }


    // GET BALANCE
    public function getBalance($sql , $students){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":students_id" , $students);
        $stmt->execute();

        $b = $stmt->fetch(PDO::FETCH_ASSOC);

        return $b['balance'];


    }

   
  
}

?>