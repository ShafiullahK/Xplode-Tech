<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include_once "db.php";

class Fess extends db {

    // Inert query
    public function Create($fee_type , $code , $description , $currentDateTime){
        try{

            $sql = $this->db->prepare("INSERT INTO `fee_types`(fee_type , code , `description` , created_at) VALUES(? , ? , ? , ?)");

            $sql->bindParam(1 , $fee_type);
            $sql->bindParam(2 , $code);
            $sql->bindParam(3 , $description);
            $sql->bindParam(4 , $currentDateTime);

            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo 'Error please check'.$e->getMessage();
            return FALSE;

        }
    }


    // GET ID
    public function getID($id){
        $sql = $this->db->prepare("SELECT * FROM `fee_types` WHERE id = :id");

        $sql->execute(array(":id"=>$id));

        $edirow = $sql->fetch(PDO::FETCH_ASSOC);
        return $edirow;

    }


    // UPDATE QUERY
    public function Update($id , $fee_type , $code , $description , $currentDateTime){
        try{

            $sql = $this->db->prepare("UPDATE `fee_types` SET fee_type = :fee_type , code = :code , description = :descriptionn , updated_at = :updated_at WHERE id = :id");

            $sql->bindParam(":id" , $id);
            $sql->bindParam(":fee_type" , $fee_type);
            $sql->bindParam(":code" , $code);
            $sql->bindParam(":descriptionn" , $description);
            $sql->bindParam(":updated_at" , $currentDateTime);

            $sql->execute();

            return TRUE;

        }catch(PDOException $e){
            echo "Error please Check" .$e->getMessage();
            return FALSE;
        }
    }

    // DELETE QUERY
    public function Delete($id){

        $sql = $this->db->prepare("DELETE FROM `fee_types` WHERE id = :id");

        $sql->bindParam(":id", $id);

        $sql->execute();
        return TRUE;
    }



    // SELECT QUERY
    public function dataView($sql , $role){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        ?> <tbody><?php
        if($stmt->rowCount() > 0){

            $i = 0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                ?>
                        <tr>
                            <td><?php  echo ++$i;  ?></td>
                            <td><?php echo $row['fee_type'];   ?></td>
                            <td><?php echo $row['code'];   ?></td>
                            <td>
                                <?php

                                    $orginal_date = $row['created_at'];
                                    $timestamp = strtotime($orginal_date);

                                    $new_date = date('F d , Y' , $timestamp);

                                    echo $new_date;

                                ?>
                            </td>

                            <!-- check role -->
                            <?php if($role === 'super_admin'){   ?>
                            <td>
                                <div class="btn-group">
                                    <a href="fee-type/edit.php?id=<?php  echo $row['id'];   ?>" class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#"onclick="event.preventDefault(); DeleteFee(event , <?php echo $row['id'];   ?>)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                            <?php }    ?>
                        </tr>
                        
                   
                <?php
            }?> </tbody><?php
        }else{
            ?>
            <tr>
                <td colspan="4" class="text-center">No data available</td>
            </tr>
            <?php
        }
    }

}




?>

<script>
    
    window.DeleteFee = function(e , id){

        if(confirm('Are you sure you  really want to delete this fee type ?')){

            $.ajax({
                url: 'fee-type/delete.php',
                type: 'post',
                data: {id : id},
                success:function(data , status){
                    $('#delete').html(`<div class="alert alert-success"role='alert'><strong>Record was deleted Successfully</strong></div>`);

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                }
            })
        }
    }

</script>