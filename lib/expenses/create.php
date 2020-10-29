<?php


include_once dirname(__DIR__). '/../classes/expenses.php';

$expens = new Expenses();

// Validation
$error_name = [];

if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $pt = $_POST['pt'];

     // SET SESSION 
    
     $_SESSION['title'] = $title;
     $_SESSION['amount'] = $amount;
     $_SESSION['date'] = $date;
     $_SESSION['description'] = $description;
     $_SESSION['pt'] = $pt;

    $currentDateTime = Date('Y-m-d H:i:s');

    // Numeric Check
    if(! is_numeric($amount)){

        $error_name['amount'] = "<p style='color:red'>Amount is numeric</p>";

    }


     // Required Check
     if(empty($title)){

        $error_name['title'] = "<p style='color:red'>Title is required</p>";
        
    }

    if(empty($amount)){

        $error_name['amount'] = "<p style='color:red'>Amount is required</p>";
        
    }

    if(empty($date)){

        $error_name['date'] = "<p style='color:red'>Date is required</p>";
        
    }

    
    if(empty($description)){

        $error_name['description'] = "<p style='color:red'>Description is required</p>";
        
    }



    
    $length = count($error_name);

    if ($length  === 0) {


    if($expens->Create($title , $amount , $date , $description , $pt , $currentDateTime)){

        // unset SESSION  
        unset($_SESSION['title']); 
        unset($_SESSION['amount']); 
        unset($_SESSION['date']); 
        unset($_SESSION['description']); 
        unset($_SESSION['pt']); 

        echo "<script> window.location = 'expenses/create.php?insert'</script>";

    }else{

        echo "<script> window.location = 'expenses/create.php?notinsert'</script>";
    }

}

}


?>
