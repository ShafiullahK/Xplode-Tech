<?php


include_once 'db.php';



class Expenses extends db {


    // INSERT QUERY
    public function Create($title , $amount , $date , $description , $pt , $currentDateTime){
        try{

            $sql = $this->db->prepare("INSERT INTO `expenses`(title , amount , `date` , `description` , `status` , created_at) VALUES(? , ? , ? , ? , ? , ?)");

            $sql->bindParam(1 , $title);
            $sql->bindParam(2 , $amount);
            $sql->bindParam(3 , $date);
            $sql->bindParam(4 , $description);
            $sql->bindParam(5 , $pt);
            $sql->bindParam(6 , $currentDateTime);

            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo 'Error pleace check'.$e->getMessage();
            return FALSE;
        }
    }


    // GET ID
    public function getID($id){

        $sql = $this->db->prepare("SELECT * FROM `expenses` WHERE id = :id");

        $sql->execute(array(":id"=>$id));

        $editrow = $sql->fetch(PDO::FETCH_ASSOC);

        return $editrow;
        
    }



    // Delete Query
    public function Delete($id){

        $sql = $this->db->prepare('DELETE FROM `expenses` WHERE id = :id');
        
        $sql->bindParam(":id" , $id);

        $sql->execute();
        return TRUE;

    }



    // UPDATE QUERY
    public function Update($id , $title , $amount , $date , $description , $pt , $currentDateTime){
        try{

            $sql = $this->db->prepare("UPDATE `expenses` SET title = :title , amount = :amount , date = :datee , `description` = :descriptionn , status = :statuss , updated_at = :updated_at WHERE id = :id");

            $sql->bindParam(":id" , $id);
            $sql->bindParam(":title" , $title);
            $sql->bindParam(":amount" , $amount);
            $sql->bindParam(":datee" , $date);
            $sql->bindParam(":descriptionn" , $description);
            $sql->bindParam(":statuss" , $pt);
            $sql->bindParam(":updated_at" , $currentDateTime);
            
            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo 'Error pleace check' .$e->getMessage();
            return FALSE;
        }
    }


    // SELECT QUERY
    public function dataView($sql , $role){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        ?><tbody><?php
        if($stmt->rowCount() > 0){
            $i = 0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                
                    <tr>
                        <td><?php  echo ++$i;  ?></td>
                        <td><?php   echo $row['title'];  ?></td>
                        <td>
                            <?php  
                            
                                $status = $row['status'];
                                if($status == 'primary'){
                                    ?>
                                        <span class="badge badge-primary" style="padding:7px;"><?php echo $status;  ?></span>
                                    <?php
                                }elseif($status == 'temporary'){
                                    ?>
                                        <span class="badge badge-success" style="padding:7px;"><?php  echo $status;  ?></span>
                                    <?php
                                }

                            ?>
                        </td>
                        <td><?php echo number_format($row['amount']);  ?></td>
                        <td><?php echo $row['date'];  ?></td>

                        <?php if($role === 'super_admin'){  ?>
                        <td>
                            <div class="btn-group">
                                <a href="expenses/edit.php?id=<?php echo $row['id'];  ?>" class="btn btn-success btn-xs">
                                <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#" onclick="event.preventDefault(); deleteExpensess(event , <?php  echo $row['id'];  ?>)" class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                        <?php  }  ?>

                    </tr>
                
                <?php

            }?></tbody><?php
        }
    }
    
}





?>

<script>

window.deleteExpensess = function(e , id){
    if(confirm('Are you sure you really want to delete this expense?')){
        
        $.ajax({
            url: 'expenses/delete.php',
            type: 'post',
            dataType: 'html',
            data: {id : id},
            success:function(data , status){
                $('#delete').html(`<div class="alert alert-success"role='alert'><strong>Expense  deleted Successfully</strong></div>`);

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                

            }
        })
    }
}

</script>

