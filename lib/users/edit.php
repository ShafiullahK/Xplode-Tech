<?php

include_once dirname(__DIR__) . '/../classes/users.php';
$users = new Users();


if(isset($_POST['update'])){

    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['pass'];
    $old_pass = $_POST['old_pass'];
    $pass_confirm = $_POST['pass_confirm'];
    $correntDateTime = Date('Y-m-d H:i:s');
    

    if(! password_verify($current_pass , $old_pass)){

        header("Location: ../../users/edit.php?id=$id&error");
        return;

    }elseif($users->Update($id , $username , $email  , $current_pass , $new_pass , $role  , $correntDateTime)){


        echo "<script> window.location = '../../users/create.php?update'</script>";

    }else{

        echo "<script> window.location = '../../users/create.php?notupdate'</script>";
    }
}



?>



