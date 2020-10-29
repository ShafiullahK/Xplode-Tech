<?php

include_once dirname(__DIR__) . '/../classes/users.php';
$users = new Users();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $pass = $_POST['pass'];
    $pass_confirm = $_POST['pass_confirm'];

    $correntDateTime = Date('Y-m-d H:i:s');

    if($users->Create($username , $email  , $pass , $pass_confirm ,  $role ,  $correntDateTime)){

        echo "<script> window.location = '../../users/create.php?success'</script>";
    }else{

        echo "<script> window.location = '../../users/create.php?not'</script>";
    }

}



?>
