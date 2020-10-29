<?php


include_once dirname(__DIR__) . '/../classes/backup.php';
$backup = new Backup();

if ( isset( $_POST['backup_file']) && isset($_POST['id']) ) {
        
    $filePath = $_POST['backup_file'];
    $id = $_POST['id'];

    // Delete Record to database
    $backup->delete($id);
    unlink($filePath);

    echo "<script> window.location = '../../backup/restore.php?delete'</script>";


    // unlink function is delete to backup file in folder




}



?>