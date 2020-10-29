<?php

include_once "db.php";

class ADDUsers extends db {

    public function getUsername($sql , $email){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":email" , $email);
        $stmt->execute();

        if($stmt->rowCount() > 0){

            $show = $stmt->fetch();
            return $show['role'];
        }
    }

    // Sidebar
    public function SelectRole($sql , $email){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email" , $email);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $res = $stmt->fetch();
            return $res['role'];
        }

    }
}



?>