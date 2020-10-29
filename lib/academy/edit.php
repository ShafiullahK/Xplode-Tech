<?php

include_once dirname(__DIR__) . '/../classes/academy_info.php';

$academy = new Academy_Info();


// Validation
$error_name = [];

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $details = $_POST['details'];

    // Image principle signature
    $filename_p = $_FILES['principle']['name'];
    $filetype_p = $_FILES['principle']['type'];
    $filesize_p = $_FILES['principle']['size'];
    $filetmp_p = $_FILES['principle']['tmp_name'];

    // image logo
    $filename_l = $_FILES['logo']['name'];
    $filetype_l = $_FILES['logo']['type'];
    $filesize_l = $_FILES['logo']['size'];
    $filetmp_l = $_FILES['logo']['tmp_name'];

    $currentDateTime = Date('Y-m-d H:i:s');



     // Required Check
     if(empty($name)){

        $error_name['name'] = "<p style='color:red'>Academy Name is required</p>";
        
    }

      
      if(empty($contact)){

        $error_name['contact'] = "<p style='color:red'>Contact No is required</p>";
        
    }

    if(empty($address)){

        $error_name['address'] = "<p style='color:red'>Address  is required</p>";
        
    }

    if(empty($details)){

        $error_name['details'] = "<p style='color:red'>Details  is required</p>";
        
    }

   

    // Find length
    $length = count($error_name);

    if ($length  === 0) {



    if($academy->Update($id , $name , $contact , $address , $details , $filename_p , $filetype_p , $filesize_p , $filetmp_p , $filename_l , $filetype_l , $filesize_l , $filetmp_l , $currentDateTime)){

        echo "<script> window.location = 'academy/edit.php?update'</script>";

    }else{

        echo "<script> window.location = 'academy/edit.php?notupdate'</script>";
    }

}

}


?>
