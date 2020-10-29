<?php


if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include_once "db.php";

class Students extends db {

    // get Cousers Name
    public function getCourse($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            ?><option value="">Select Course</option><?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo $row['id'];  ?>"><?php echo $row['name'];   ?></option>
                <?php
            }
        }
 
    }

    

    // INSERT QUERY
    public function Create($admission_no , $sname , $fname , $phone , $fphone , $address , $dob ,  $gander  , $cnic , $fcnic , $course_id , $fee_amount , $discount , $sourse , $refrence , $education , $school , $previous , $filename , $filetype , $filesize , $filetmp , $correntDateTime){
        // echo '<pre>'; print_r($admission_no); return;
        try{

            $sql = $this->db->prepare("INSERT INTO `students` (admission_no  , sname , fname , phone , fphone , address , dob , gander ,  cnic , fcnic , course_id , fee_amount , discount ,  sourse , refrence , education , school , previous , image , created_at) VALUES(? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?)");

            $sql->bindParam(1 , $admission_no);
            $sql->bindParam(2 , $sname);
            $sql->bindParam(3 , $fname);
            $sql->bindParam(4 , $phone);
            $sql->bindParam(5 , $fphone);
            $sql->bindParam(6 , $address);
            $sql->bindParam(7 , $dob);
            $sql->bindParam(8 , $gander);
            $sql->bindParam(9 , $cnic);
            $sql->bindParam(10 , $fcnic);
            $sql->bindParam(11 , $course_id);
            $sql->bindParam(12 , $fee_amount);
            $sql->bindParam(13 , $discount);
            $sql->bindParam(14 , $sourse);
            $sql->bindParam(15 , $refrence);
            $sql->bindParam(16 , $education);
            $sql->bindParam(17 , $school);
            $sql->bindParam(18 , $previous);
            $sql->bindParam(19 , $filename);
            $sql->bindParam(20 , $correntDateTime);

            if($sql->execute()){

                $this->Check($filename , $filetype  , $filesize , $filetmp);

                    return TRUE;
                }
            


        }catch(PDOException $e){
            echo 'Error Please Check' .$e->getMessage();
            return FALSE;
        }
    }

    // FOr Image 
    public function Check($filename , $filetype , $filesize , $filetmp){

        // Allow certain file formate
        if($filetype == 'image/jpg' || $filetype == 'image/jpeg' || $filetype == 'image/png' || $filetype == 'image/pdf'){

            // Check File size
            if($filesize <= 5000000){
                
                if(move_uploaded_file($filetmp , '../uploads/' . $filename)){
                   

                    return TRUE;
                }
            }else{

                echo 'Sorry Your file is so large';
            }

        }else{

            return FALSE;

        }

    }

    // DELETE QUERY
    public function Delete($id){

        $sql = $this->db->prepare("DELETE FROM `students` WHERE id = :id");

        $sql->bindParam("id" ,$id);
        $sql->execute();
        return TRUE;
    }


    // GET ID
    public function getID($id){

        $sql = $this->db->prepare("SELECT courses.name , courses.fee ,  students.* FROM `students`INNER JOIN `courses` ON students.course_id = courses.id WHERE students.id = :id");

        $sql->execute(array(":id"=>$id));
        $editrow = $sql->fetch(PDO::FETCH_ASSOC);

        return $editrow;
    }



    // UPDATE QUERY
    public function Update($id , $admission_no ,  $sname , $fname , $phone , $fphone , $address , $dob , $gander , $cnic , $fcnic , $course_id , $fee_amount , $discount , $sourse , $refrence , $education , $school , $previous , $filename , $filetype , $filesize , $filetmp , $currentDateTime){

        try{

            if(!empty($filename)){

                $sql = $this->db->prepare("UPDATE `students` SET admission_no = :admission_no , sname = :sname , fname = :fname , phone = :phone , fphone = :fphone , address = :addresss , dob = :dob , gander = :gander , cnic = :cnic , fcnic = :fcnic , course_id = :course_id , fee_amount = :fee_amount , discount = :discount ,   sourse = :sourse , refrence = :refrence , education = :education , school = :school , previous = :previous , image = :imagee , updated_at = :updated_at WHERE id = :id");

            }else{

                 $sql = $this->db->prepare("UPDATE `students` SET admission_no = :admission_no ,  sname = :sname , fname = :fname , phone = :phone , fphone = :fphone , address = :addresss , dob = :dob , gander = :gander , cnic = :cnic , fcnic = :fcnic , course_id = :course_id , fee_amount = :fee_amount , discount = :discount ,  sourse = :sourse , refrence = :refrence , education = :education , school = :school , previous = :previous , updated_at = :updated_at WHERE id = :id");

            }

            $sql->bindParam(":id" , $id);
            $sql->bindParam(":admission_no" , $admission_no);
            $sql->bindParam(":sname" , $sname);
            $sql->bindParam(":fname" , $fname);
            $sql->bindParam(":phone" , $phone);
            $sql->bindParam(":fphone" , $fphone);
            $sql->bindParam(":addresss" , $address);
            $sql->bindParam(":dob" , $dob);
            $sql->bindParam(":gander" , $gander);
            $sql->bindParam(":cnic" , $cnic);
            $sql->bindParam(":fcnic" , $fcnic);
            $sql->bindParam(":course_id" , $course_id);
            $sql->bindParam(":fee_amount" , $fee_amount);
            $sql->bindParam(":discount" , $discount);
            $sql->bindParam(":sourse" , $sourse);
            $sql->bindParam(":refrence" , $refrence);
            $sql->bindParam(":education" , $education);
            $sql->bindParam(":school" , $school);
            $sql->bindParam(":previous" , $previous);
            $sql->bindParam(":updated_at" , $currentDateTime);

                if(!empty($filename)){
                    $sql->bindParam(":imagee" , $filename);
                }

                $sql->execute();

                if(!empty($filename)){
                    $this->Check($filename , $filetype , $filesize , $filetmp);
                }   
                     return TRUE;

                


        }catch(PDOException $e){
            echo 'Error please check'.$e->getMessage();
            return FALSE;
        }
    }


    // Filteration name and Course  SELECT QUERY
    public function Filter($course_id , $st_name){

        $sql = $this->db->prepare("SELECT courses.name , students.* FROM  `students`  INNER JOIN  `courses` ON students.course_id = courses.id WHERE sname LIKE :sname AND course_id = :course_id");
        $sname = '%' . $st_name . '%';
        $sql->bindParam(':sname' , $sname);
        $sql->bindParam(':course_id' , $course_id);

        $sql->execute();

        $data  = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        
    }

    // Get Fee To course table
    public function getFee($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            ?><option value="#">Select Amount</option><?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php  echo $row['id'];   ?>"><?php echo $row['fee'];   ?></option>
                <?php
            }
        }
    }
    


    // Show Students
    public function ShowStudents($id){

        $sql = $this->db->prepare("SELECT courses.name, courses.fee  , students.* FROM `students` INNER JOIN `courses` ON students.course_id = courses.id WHERE students.id = :id");

        $sql->execute(array(":id"=>$id));

        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;

    }


    // GET Course Amount 
    public function getCouresID($sql , $id){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id" , $id);

        $stmt->execute();

        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        return $arr['fee'];
        
    }


    // Update Get COures Amount
    public function Update_get_fee_amount($sql , $id){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id" , $id);

        $stmt->execute();

        $a = $stmt->fetch(PDO::FETCH_ASSOC);
        return $a['fee'];
    }


} 



?>








