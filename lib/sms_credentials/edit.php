<?php

include_once dirname(__DIR__) . '/../classes/sms.php';

$sms  = new SMS();

// Validation
$error_name = [];
if(isset($_POST['update'])){

    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sender = $_POST['sender'];

    // Required
    if(empty($username)){
        $error_name['username'] = "<p style='color:red'>The username field is required</p>";
    }

    if(empty($password)){
        $error_name['password'] = "<p style='color:red'>The password field is required</p>";
    }

    if(empty($sender)){
        $error_name['sender'] = "<p style='color:red'>The sender field is required</p>";
    }

    // find Length

    $length = count($error_name);

    if($length === 0){

        if($sms->Update($id , $username , $password , $sender)){

            echo "<script> window.location = 'sms_credentials/edit.php?update'</script>";

        }else{

            echo "<script> window.location = 'sms_credentials/edit.php?notupdate'</script>";
        }

    }

   
}







?>