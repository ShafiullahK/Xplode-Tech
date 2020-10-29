<?php

    include_once dirname(__DIR__) . '/../classes/backup.php';
    $backup = new Backup();

    /**
     * Validate the file
     */
    function is_valid_file ( $fileName ) {
        $allowed_extension = 'sql';

        if ( pathinfo( $fileName , PATHINFO_EXTENSION ) === $allowed_extension ) {
            return true;
        } 
        return false;
    }

    if ( isset( $_POST['backup_file'] ) ) {
        
        $filePath = $_POST['backup_file'];

        $sql = file_get_contents( $filePath );
    
        $mysqli = new mysqli("localhost", "root", "", "xplode-tech");

        if ( mysqli_connect_errno() ) { /* check connection */
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        /* execute multi query */
        if ( $mysqli->multi_query( $sql ) ) {

            echo "<script> window.location = '../../backup/restore.php?restore'</script>";
            

        } else {

            echo "<script> window.location = '../../backup/restore.php?not'</script>";
            // echo 'not';
        }

    }
    


    ?>

