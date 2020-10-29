<?php
     if(session_status() === PHP_SESSION_NONE){
        session_start();
    }


   

include_once dirname(__DIR__) . '/classes/addUser.php';
$add = new ADDUsers();

$email = '';
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}
$sql = "SELECT role FROM `users` WHERE email = :email";
$role =   $add->SelectRole($sql , $email);

?>


<base href="http://localhost/xplode-tech/">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
<link rel="stylesheet"  href="css/bootstrap.min.css">
<link rel="stylesheet"  href="css/app.css">



<!-- DataTable CSS -->
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="css/buttons.dataTables.min.css">


<!--- JS -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<!-- DataTables JS -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script> 
<script src="js/buttons.html5.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/buttons.flash.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>

<script src="js/toggler.js"></script>

<script>
        $(document).ready(function(){
            if($('.alert').is(':visible')){
                setTimeout(() => {
                    $('.alert').fadeOut('slow');
                    
                }, 3000);
            }

        })
    </script>




  <!-- DataTables Buttons -->
  <script>
        $(document).ready(function(){
            $('#cour').DataTable({
                dom : 'Bfrtip',
                buttons : [
                    'excel','copy','pdf','csv','print'
                ]
            });
        });
    </script>











