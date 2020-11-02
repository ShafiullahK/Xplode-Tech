<?php



    if(! isset($_SESSION['email']) && ! isset($_SESSION['password'])){

        exit(header("location:login.php"));
    }


$email = "";

    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];
    }


    $sql = "SELECT role FROM `users` WHERE email = :email";

    require_once dirname(__DIR__) . '/classes/addUser.php';

    
    $addNav = new ADDUsers();

    $name = $addNav->getUsername($sql , $email);

    

?>

<nav class="navbar navbar-expand-md bg-light navbar-light">

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <!-- Left menu -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="sidebar-toggler-desk" title="show/hide sidebar">
                    <i class="fas fa-bars fa-2x"></i>
                </a>
            </li>
        </ul>  
                     
        <!-- Right menu -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="fas fa-user-alt"></i>
                    <?php echo $name   ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="lib/logout.php" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>


        </ul>
  

    </div>
    
</nav>
