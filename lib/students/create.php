<?php


require_once dirname(__DIR__) .'/../classes/students.php';

$students = new Students();

// Validation
$error_name = [];

if(isset($_POST['submit'])){


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
    $fee_amount =  $_POST['fee_amount'];
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



  

    // SET SESSION 
    
    $_SESSION['admission_no'] = $admission_no;
    $_SESSION['sname'] = $sname;
    $_SESSION['fname'] = $fname;
    $_SESSION['phone'] = $phone;
    $_SESSION['fphone'] = $fphone;
    $_SESSION['address'] = $address;
    $_SESSION['dob'] = $dob;
    $_SESSION['gander'] = $gander;
    $_SESSION['cnic'] = $cnic;
    $_SESSION['fcnic'] = $fcnic;
    $_SESSION['course_id'] = $course_id;
    $_SESSION['fee_amount'] = $fee_amount;
    $_SESSION['discount'] = $discount;
    $_SESSION['sourse'] = $sourse;
    $_SESSION['refrence'] = $refrence;
    $_SESSION['education'] = $education;
    $_SESSION['school'] = $school;
    $_SESSION['previous'] = $previous;
    $_SESSION['image'] = $filename;


    
    $correntDateTime = Date('Y-m-d H:i:s');



    // Numeric Check
    if(! is_numeric($fee_amount)){

        $error_name['fee_amount'] = "<p style='color:red'>Amount is numeric</p>";

    }

    
    // if(! is_numeric($discount)){

    //     $error_name['discount'] = "<p style='color:red'>Discount is numeric</p>";

    // }


     // Required Check
     if(empty($sname)){

        $error_name['sname'] = "<p style='color:red'>Name is required</p>";
        
    }

    if(empty($sname)){

        $error_name['admission_no'] = "<p style='color:red'>Admission No is required</p>";
        
    }

   

    if(empty($course_id)){

        $error_name['course_id'] = "<p style='color:red'>Course  is required</p>";
        
    }

    if(empty($fee_amount)){

        $error_name['fee_amount'] = "<p style='color:red'>Amount  is required</p>";
        
    }



    $length = count($error_name);

    if ($length  === 0) {



    if($students->Create($admission_no , $sname , $fname , $phone , $fphone , $address , $dob ,  $gander  , $cnic , $fcnic , $course_id , $fee_amount , $discount ,   $sourse , $refrence , $education , $school , $previous , $filename , $filetype , $filesize , $filetmp , $correntDateTime)){

        // unset SESSION  
    unset($_SESSION['admission_no']); 
    unset($_SESSION['sname']); 
    unset($_SESSION['fname']);
    unset($_SESSION['phone']); 
    unset($_SESSION['fphone']); 
    unset($_SESSION['address']); 
    unset($_SESSION['dob']); 
    unset($_SESSION['gander']); 
    unset($_SESSION['cnic']); 
    unset($_SESSION['fcnic']);
    unset($_SESSION['course_id']);
    unset($_SESSION['fee_amount']); 
    unset($_SESSION['discount']); 
    unset($_SESSION['sourse']);  
    unset($_SESSION['refrence']); 
    unset($_SESSION['education']); 
    unset($_SESSION['school']);
    unset($_SESSION['previous']); 
    unset($_SESSION['image']); 

        echo "<script>window.location = 'students/create.php?success'</script>";
        
        
       
        
    }else{

            

        echo "<script>window.location = 'students/create.php?fail'</script>";
        

    }


}


}



?>
