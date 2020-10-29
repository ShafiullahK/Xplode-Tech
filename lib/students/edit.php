<?php

include_once dirname(__DIR__) . '/../classes/students.php';
$students = new Students();

// Validation
$error_name = [];

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $admission_no = $_POST['admission_no'];
    $sname = $_POST['sname'];
    $fname = $_POST['fname'];
    $phone = $_POST['phone'];
    $fphone = $_POST['fphone'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $gander = $_POST['gander'];
    $cnic = $_POST['cnic'];
    $fcnic = $_POST['fcnic'];
    $course_id = $_POST['course_id'];
    $fee_amount = $_POST['fee_amount'];
    $discount = $_POST['discount'];
    $sourse = $_POST['sourse'];
    $refrence = $_POST['refrence'];
    $education = $_POST['education'];
    $school = $_POST['school'];
    $previous = $_POST['previous'];
    
    $filename = $_FILES['image']['name'];
    $filetype = $_FILES['image']['type'];
    $filesize = $_FILES['image']['size'];
    $filetmp = $_FILES['image']['tmp_name'];


    $currentDateTime = Date('Y-m-d H:i:s');

     // Numeric Check
    if(! is_numeric($fee_amount)){

        $error_name['fee_amount'] = "<p style='color:red'>Amount is numeric</p>";

    }

    
    


     // Required Check

     if(empty($admission_no)){

        $error_name['admission_no'] = "<p style='color:red'>Admission No is required</p>";
        
    }
     if(empty($sname)){

        $error_name['sname'] = "<p style='color:red'>Name is required</p>";
        
    }

   

    if(empty($course_id)){

        $error_name['course_id'] = "<p style='color:red'>Course  is required</p>";
        
    }

    if(empty($fee_amount)){

        $error_name['fee_amount'] = "<p style='color:red'>Amount  is required</p>";
        
    }


 


    $length = count($error_name);
    
    if ($length  === 0) {



    if($students->Update($id , $admission_no ,  $sname , $fname , $phone , $fphone , $address , $dob , $gander , $cnic , $fcnic , $course_id , $fee_amount , $discount ,   $sourse , $refrence , $education , $school , $previous , $filename , $filetype , $filesize , $filetmp , $currentDateTime)){


        echo "<script> window.location = 'students/view.php?update'</script>";


    }else{

        echo "<script> window.location = 'students/view.php?notupdate'</script>";

    }

}

} 


?>
