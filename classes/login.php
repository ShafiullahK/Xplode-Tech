<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include_once "db.php";

class Login extends db {


    public function dataView($sql , $pass){

        $stmt = $this->db->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();


        $data = $stmt->fetch();
        


        if(!password_verify($pass , $data['password'])){
            exit(header("location: login.php?fail"));

        }else{

            // set session
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];

            // Check session
            if(! empty($_SESSION['password']) && ! empty($_SESSION['email'])){
                exit(header("location:index.php"));
            }
        }

    }

}



?>

