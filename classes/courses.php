<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include_once "db.php";


class Courses extends db {

    // Insert query
    public function Create($name , $code , $fee , $years , $months , $weeks , $currentDateTime){
        try{

            $sql = $this->db->prepare("INSERT INTO `courses`(`name` , code , years , months , weeks , fee ,created_at) VALUES(? , ? , ? , ? , ? , ? , ?)");

            $sql->bindParam(1 , $name);
            $sql->bindParam(2 , $code);
            $sql->bindParam(3 , $years);
            $sql->bindParam(4 , $months);
            $sql->bindParam(5 , $weeks);
            $sql->bindParam(6 , $fee);
            $sql->bindParam(7 , $currentDateTime);

            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo "Error Please Check" .$e->getMessage();
            return FALSE;
        }

}

        // GET ID
        public function getID($id){

            $sql = $this->db->prepare("SELECT * FROM courses WHERE id = :id");
    
            $sql->execute(array(":id"=>$id));
    
            $editrow = $sql->fetch(PDO::FETCH_ASSOC);
    
            return $editrow;
    
        }


        // Delete Query
        public function Delete($id){
            $sql = $this->db->prepare("DELETE FROM `courses`WHERE id = :id");

            $sql->bindParam(":id", $id);
            
            $sql->execute();

            return TRUE;


        }


        // UPDATE QUERY
        public function Update($id , $name , $code , $fee , $years , $months , $weeks , $currentDateTime){
            try{

                $sql = $this->db->prepare("UPDATE `courses` SET `name` = :namee , code = :code , years = :years , months = :months , weeks = :weeks , fee = :fee , updated_at = :updated_at WHERE id = :id");

                $sql->bindParam(":id" , $id);
                $sql->bindParam(":namee" , $name);
                $sql->bindParam(":code" , $code);
                $sql->bindParam(":years" , $years);
                $sql->bindParam(":months" , $months);
                $sql->bindParam(":weeks" , $weeks);
                $sql->bindParam(":fee" , $fee);
                $sql->bindParam(":updated_at" , $currentDateTime);

                $sql->execute();
                return TRUE;

            }catch(PDOException $e){
                echo "Error Please check" .$e->getMessage();
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
                        <td><?php echo ++$i;   ?></td>
                        <td><?php echo $row['name'];   ?></td>
                        <td><?php echo $row['code'];   ?></td>
                        <td><?php  echo $row['years'] ." Y | " . $row['months'] . " M | " . $row['weeks'] . " W"  ?></td>
                        <td><?php echo number_format($row['fee']);   ?></td>
                        <!-- checking for adin and user -->
                        <?php  if($role === 'super_admin'){  ?>
                        <td>
                            <div class="btn-group">
                                <a href="courses/edit.php?id=<?php echo $row['id'];  ?>" class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" onclick="event.preventDefault(); deleteCourse(event , <?php  echo $row['id'];  ?>)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        <?php  }  ?>
                    </tr>
                
                <?php
            }
            ?></tbody><?php
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
    
    window.deleteCourse = function(e , id){

        if(confirm('Are you sure you really want to delete this course ?')){

            $.ajax({
                url: 'courses/delete.php',
                type: 'post',
                data: {id : id},
                success:function(data , status){
                    $('#delete').html(`<div class="alert alert-success"role="alert"><strong>Course deleted successfully</strong></div>`);
                    
                    setTimeout(() => {
                        window.location.reload();
                        
                    }, 1000);

                    
                    
                   
                    
                }
            })
        }
    }

</script>