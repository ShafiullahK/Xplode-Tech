<?php

include_once dirname(__DIR__) . "/classes/login.php";

$Result = new Login();

    // Validation
    $error_name = [];

    if(isset($_POST['submit'])){

        $email = $_POST['email'];
        $pass = $_POST['pass'];


        // set session
        $_SESSION['email'] = $email;

        // Required Check
        if(empty($email)){

            $error_name['email'] = "<p style='color:red'>Email is required</p>";
        }

        if(empty($pass)){

            $error_name['pass'] = "<p style='color:red'>Password is required</p>";

        }

        $length = count($error_name);

        if($length === 0){
            

        $sql = "SELECT * FROM `users` WHERE email = '$email'";

        $Result->dataView($sql , $pass);

        // Unset session
        unset($_SESSION['email']);

    }


    }



?>