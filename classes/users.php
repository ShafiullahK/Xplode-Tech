<?php


if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include_once "db.php";

class Users extends db {

    // Inert Query
    public function Create($username , $email  , $pass , $pass_confirm , $role , $correntDateTime){
        try{
            
            $sql = $this->db->prepare("INSERT INTO `users`(username , email , `password` , `role` , created_at) VALUES(? , ? , ? , ? , ?)");

            $hash = password_hash($pass , PASSWORD_DEFAULT);
            

            $sql->bindParam(1 , $username);
            $sql->bindParam(2 , $email);
            $sql->bindParam(3 , $hash);
            $sql->bindParam(4 , $role);
            $sql->bindParam(5 , $correntDateTime);

            $sql->execute();
            return TRUE;
        }catch(PDOException $e){
            echo 'Error Please check'.$e->getMessage();
            return FALSE;
        }
    }


    // GET id
    public function getID($id){

        $sql = $this->db->prepare("SELECT * FROM `users` WHERE id = :id");
        $sql->bindParam(":id" , $id);
        $sql->execute();

        $editrow = $sql->fetch(PDO::FETCH_ASSOC);
        return $editrow;
    }


    // UPDATE QUERY
    public function Update($id , $username , $email , $current_pass , $new_pass , $role , $correntDateTime){
        try {
              $sql = $this->db->prepare("UPDATE `users` SET username = :username , email = :email , password = :passwordd , role = :rolee , updated_at = :updated_at WHERE id = :id");

            $new_hash = password_hash($new_pass , PASSWORD_DEFAULT);

              $sql->bindParam(':id' , $id);
              $sql->bindParam(':username' , $username);
              $sql->bindParam(':email' , $email);
              $sql->bindParam(':passwordd' , $current_pass);
              $sql->bindParam(':passwordd' , $new_hash);
              $sql->bindParam(':rolee' , $role);
              $sql->bindParam(':updated_at' , $correntDateTime);

              $sql->execute();
              return TRUE;
        } catch (PDOExcepton $e) {
            echo 'Error please check' .$e->getMessage();
            return FALSE;
        }
    }


    // Select Query
    public function dataView($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
            ?><tbody><?php
        if($stmt->rowCount() > 0){
            $i = 0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <tr>
                        <td><?php echo ++$i;   ?></td>
                        <td><?php  echo $row['username'];   ?></td>
                        <td><?php  echo $row['email'];   ?></td>
                        <td>
                            <strong class="text-info"><?php echo $row['role'];   ?></strong>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="users/edit.php?id=<?php echo $row['id'];   ?>" class="btn btn-xs btn-success"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>

                    </tr>
                <?php
            }
            ?></tbody><?php
        }
    }

}



?>