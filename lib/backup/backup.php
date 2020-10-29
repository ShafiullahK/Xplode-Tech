<?php

    // Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $database_name = "xplode-tech";
    $output = '';


    // DB Connection
    $conn = mysqli_connect($host, $username, $password, $database_name);
    
    $q = mysqli_query( $conn, 'SHOW TABLES' );

    while ( $tables = mysqli_fetch_array( $q ) ) {

        // DROP the table if exists
        $output .= "\n" . 'DROP TABLE IF EXISTS `' . $tables['Tables_in_xplode-tech'] . "`; \n" ;

        $table = mysqli_query( $conn, 'SHOW CREATE TABLE ' . $tables['Tables_in_xplode-tech'] );
        
        while ( $tableStructure = mysqli_fetch_row( $table ) ) {
            echo '<pre>';
            $output .= "\n\n" . $tableStructure[1] . ";\n\n";
        }

        $select_query = mysqli_query( $conn, 'SELECT * FROM ' . $tables['Tables_in_xplode-tech'] );
        $rowCount = mysqli_num_rows( $select_query );

        for ( $i = 0; $i < $rowCount; $i++ ) {
            $assoc = mysqli_fetch_assoc( $select_query );
            $columns = array_keys( $assoc );
            $values =  array_values( $assoc ); 
            $tableName = $tables['Tables_in_xplode-tech'];
            $output .= "\n INSERT INTO $tableName ("; 
            $output .= "`" . implode( "`,`", $columns )  . "`) VALUES ("; 
            $output .= "'" . implode( "','", $values ) . "');\n"; 
        }    
        
        

    }

    echo '</pre>';

    $fileName = dirname(dirname( __DIR__)) . '\backups/DATABASE_xplode-tech_' . date( 'm-d-Y' ) . '.sql';
    $fileHandle = fopen($fileName , 'w+' );

   
    include_once dirname(__DIR__) . '/../classes/backup.php';
    $backup = new Backup();

    $CurrentDateTime = date('Y-m-d H:i:s');

    // Created By User or Admin
    $email = "";

    if(isset($_SESSION['email'])){

        $email = $_SESSION['email'];
    }


    $role = "SELECT role FROM `users` WHERE email = :email";
    
    $user = $backup->getUsers($role , $email);

    
  

    if ( fwrite( $fileHandle, $output) ) {

        if ($backup->getDATA($fileName , $user , $CurrentDateTime)) {

            header('Location: ../../backup/create.php?success');

    }
}
       
    // Close
    fclose( $fileHandle );

    

?>

