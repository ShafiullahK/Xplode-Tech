<?php

include_once 'db.php';


class Fee_Group extends db {

    // INSERT QUERY
    public function Create($fee_group , $description , $currentDateTime){
        try{

            $sql = $this->db->prepare("INSERT INTO `fee_groups`(fee_group , description , created_at) VALUES(? , ? , ?)");
            
            $sql->bindParam(1 , $fee_group);
            $sql->bindParam(2 , $description);
            $sql->bindParam(3 , $currentDateTime);

            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo 'Error please check' .$e>getMessage();
            return FALSE;
        }
    }


    // GET ID
    public function getID($id){

        $sql = $this->db->prepare("SELECT * FROM  `fee_groups` WHERE id = :id");

        $sql->execute(array(":id"=>$id));

        $editrow = $sql->fetch(PDO::FETCH_ASSOC);

        return $editrow;
    }

    // DELETE QUERY
    public function Delete($id){

        $sql = $this->db->prepare("DELETE FROM  `fee_groups` WHERE id = :id");

        $sql->bindParam(":id" , $id);
        $sql->execute();

        return TRUE;
    }
    


    // UPDATE QUERY
    public function Update($id , $fee_group , $description , $currentDateTime){
        try{

            $sql = $this->db->prepare("UPDATE `fee_groups` SET fee_group = :fee_group , 	description = :descriptionn , updated_at = :updated_at WHERE id = :id");

            $sql->bindParam(":id" , $id);
            $sql->bindParam(":fee_group" , $fee_group);
            $sql->bindParam(":descriptionn" , $description);
            $sql->bindParam(":updated_at" , $currentDateTime);

            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo 'Error please Check' .$e->getMessage();
            return FALSE;
        }
    }


    // Select Query
    public function dataView($sql , $role){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
            ?> <tbody><?php
        if($stmt->rowCount() > 0){

            $i = 0;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
               
                    <tr>
                        <td><?php echo ++$i;   ?></td>
                        <td><?php echo $row['fee_group'];   ?></td>
                        <td>
                            <?php

                                $original_date = $row['created_at'];
                                $timestamp = strtotime($original_date);

                                $new_date = Date('F d , Y' , $timestamp);

                                echo $new_date;

                            ?>
                        </td>

                        <?php  if($role === 'super_admin'){   ?>
                        <td>
                            <div class="btn-group">
                                <a href="fee-groups/edit.php?id=<?php  echo $row['id'];  ?>" class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" onclick="event.preventDefault(); deleteGroup(event , <?php echo $row['id']    ?>)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        <?php  }   ?>
                    </tr>
                
                <?php
            }?></tbody><?php
        }else{
            ?>
            <tr>
                <td colspan="5" class="text-center">No data available</td>
            </tr>
            <?php
        }
    }

}




?>

<script>

    window.deleteGroup = function(e , id){

        if(confirm('Are you sure you really want to delete this fee group ?')){

            $.ajax({
                url: 'fee-groups/delete.php',
                type: 'post',
                data: {id : id},
                success:function(data , status){

                    $('#delete').html(`<div class="alert alert-success"role='alert'><strong>Fee group deleted successfully</strong></div>`);

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                }
            })
        }
    }

</script>