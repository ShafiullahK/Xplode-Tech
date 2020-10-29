<?php

include_once dirname(__DIR__) . '/classes/addUser.php';
$add = new ADDUsers();

$email = '';
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}
$sql = "SELECT role FROM `users` WHERE email = :email";
$role =   $add->SelectRole($sql , $email);

?>

<!-- Toggler -->
<button class="btn btn-sm btn-primary" id="sidebar-toggler-sm">
    <i class="fas fa-bars"></i> Side Menu
</button>

<!-- Sidebar -->
<div class="col-sm-2 sidebar">
    <div class="sidebar-top w-100">
        <span class="fname">Xplode</span> Tech
    </div>
    <ul class="nav nav-pills flex-column"> 
        <div class="separator-text">Main Inventory</div>
        <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="collapse" data-target="#courses">
                <span class="icon"><i class="fas fa-warehouse"></i></span> 
                <span class="text">Courses</span>

                <span class="caret">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </a>

            <ul class="collapse" id="courses">
                <li class="nav-item">
                    <a href="courses/create.php" class="nav-link">
                        Add Course
                    </a>
                </li>
                <li class="nav-item">
                    <a href="courses/view.php" class="nav-link">
                        Manage Courses
                    </a>
                </li>
            </ul>
        </li>
            <!-- Students -->
        <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="collapse" data-target = "#students">
                <span class="icon"><i class="fas fa-graduation-cap"></i></span>
                <span class="text">Students</span>

                <span class="caret">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </a>

            <ul class="collapse" id="students">
                <li class="nav-item">
                    <a href="students/create.php" class="nav-link">
                        Add Student
                    </a>
                </li>
                <li class="nav-item">
                    <a href="students/view.php" class="nav-link">
                        View Students
                    </a>
                </li>
            </ul>
                
            </li>

            <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="collapse" data-target = "#ft">
                <span class="icon"><i class="fas fa-euro-sign"></i></span>
                <span class="text">Fee Collection</span>

                <span class="caret">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </a>

            <ul class="collapse" id="ft">
                <li class="nav-item">
                    <a href="fee-type/create.php" class="nav-link">
                        Fee Type
                    </a>
                </li>
                <li class="nav-item">
                    <a href="fee-groups/create.php" class="nav-link">
                        Fee Group
                    </a>
                </li>
                <li class="nav-item">
                    <a href="assign-fee/create.php" class="nav-link">
                        Assign Fee Types
                    </a>
                </li>
                <li class="nav-item">
                    <a href="collect-fee/create.php" class="nav-link">
                        Collect Fee
                    </a>
                </li>
                <li class="nav-item">
                    <a href="search-fee/create.php" class="nav-link">
                        Search Fee
                    </a>
                </li>
            </ul>
                
            </li>

            <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="collapse" data-target = "#student-att">
                <span class="icon"><i class="fas fa-calendar-check"></i></span>
                <span class="text">Student Attendence</span>

                <span class="caret">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </a>

            <ul class="collapse" id="student-att">
                <li class="nav-item">
                    <a href="attendence/create.php" class="nav-link">
                        Student Attendence
                    </a>
                </li>
                <li class="nav-item">
                    <a href="attendence-report/create.php" class="nav-link">
                        Attendence Report
                    </a>
                </li>
                
            </ul>
                
            </li>

            
              <!-- Students -->
        <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="collapse" data-target = "#IDCards">
                <span class="icon"><i class="fas fa-graduation-cap"></i></span>
                <span class="text">ID Cards</span>

                <span class="caret">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </a>

            <ul class="collapse" id="IDCards">
                <li class="nav-item">
                    <a href="ID_card/create.php" class="nav-link">
                        ID Cards
                    </a>
                </li>
            </ul>
                
            </li>

            <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="collapse" data-target = "#expenses">
                <span class="icon"><i class="fas fa-hand-holding-usd"></i></span>
                <span class="text">Utilities Expenses</span>

                <span class="caret">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </a>

            <ul class="collapse" id="expenses">
                <li class="nav-item">
                    <a href="expenses/create.php" class="nav-link">
                        Expenses
                    </a>
                </li>
            </ul>
            <!-- sms -->
            <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="collapse" data-target = "#Sms">
                <span class="icon"><i class="fas fa-mobile-alt"></i></span>
                <span class="text">Text Messages</span>

                <span class="caret">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </a>

            <ul class="collapse" id="Sms">
                <li class="nav-item">
                    <a href="sms/create.php" class="nav-link">
                        Send SMS
                    </a>
                </li>
                <li class="nav-item">
                    <a href="sms_credentials/edit.php" class="nav-link">
                        SMS Credentials
                    </a>
                </li>
            </ul>
                 <hr class="sidebar-separator mt-3">

                 <div class="sidebar-head">SETTINGS</div>
            </li>


            
            <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="collapse" data-target = "#setting">
                <span class="icon"><i class="fas fa-cogs"></i></span>
                <span class="text">Settings</span>

                <span class="caret">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </a>

            <ul class="collapse" id="setting">

                <?php  if($role === 'super_admin'){   ?>
                <li class="nav-item">
                        <a href="users/create.php" class="nav-link">
                            Users
                        </a>
                    </li>
                <?php   } ?>
                
                <li class="nav-item">
                    <a href="backup/create.php" class="nav-link">
                        Backup
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="academy/edit.php" class="nav-link">
                        Academy info
                    </a>
                
                </li>
            </ul>

            </li>
      

            
    </ul>
</div>

