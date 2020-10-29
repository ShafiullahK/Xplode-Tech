<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// Include db connection
include_once 'db.php';


class Backup extends db {

    // Insert Query
    
    public function getDATA($fileName , $user , $CurrentDateTime){
        try{

            $sql = $this->db->prepare("INSERT INTO `backups` (src , created_by , created_at) VALUES(? , ? , ?)");

            $sql->bindParam(1 , $fileName);
            $sql->bindParam(2 , $user);
            $sql->bindParam(3 , $CurrentDateTime);

            $sql->execute();
            return TRUE;
            
        }catch(PDOException $e){
            echo 'Error Please Check'.$e->getMessage();
            return FALSE;
        }
    }



    // Get Users
    public function getUsers($role , $email){

        $sql = $this->db->prepare($role);

        $sql->bindParam(":email" , $email);
        $sql->execute();
        if($sql->rowCount() > 0){

            $stmt = $sql->fetch(PDO::FETCH_ASSOC);
            return $stmt['role'];

        }
    } 


    // Show Restore data
    public function dataView($sql , $role){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $i = 0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <tr>
                        <td><?php echo ++$i;   ?></td>
                        <td><mark> <?php  echo $row['src'];   ?></mark></td>
                        <td class="text-success"><?php  echo $row['created_by'];   ?></td>
                        <!-- Check admin or user -->
                        <?php  if($role === 'super_admin'){  ?>
                        <td>
                        <button class="btn btn-xs btn-light" title="Restore this backup" 
								onClick="if (window.confirm('Are you sure you really want to restore this backup ?')) {
								document.getElementById('restore-form-<?php echo $row['id']; ?>').submit()
							}">
								<i class="fas fa-download"></i>
							</button>

                                <form method="post" action="lib/backup/restore.php" id="restore-form-<?php echo $row['id'];   ?>">
                                    <input type="hidden" name="backup_file" value="<?php echo $row['src'];    ?>">
                                
                                </form>

                        </td>
                        <td>
                            <button class="btn btn-xs btn btn-danger" title="Delete this backup"
                                     onClick="if(window.confirm('Are you sure you really want to delete this backup ?')) {
                                document.getElementById('delete-form-<?php echo $row['id'];    ?>').submit()
                            }">
                            <i class="fas fa-trash-alt"></i>
                            </button>

                            <form action="lib/backup/delete_backup.php" method="post" id="delete-form-<?php echo $row['id'];   ?>">
                                <input type="hidden" name="id"  value="<?php  echo $row['id'];   ?>">
                                <input type="hidden" name="backup_file" value="<?php  echo $row['src'];  ?>">
                            </form>

                        </td>
                        <?php  }  ?>
                    </tr>
                <?php
            }
        }
    }


    // DELETE QUERY
    public function delete($id){

        $sql = $this->db->prepare("DELETE FROM `backups` WHERE id = :id");
        $sql->bindParam(":id" , $id);
        $sql->execute();
        return TRUE;

    }

}


?>