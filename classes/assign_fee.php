<?php


include_once 'db.php';


class Assign_Fee extends db {

    // Get Fee Group  In Assign fee type
    public function getGroup($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['fee_group'];   ?></option>
                <?php
            }
        }
    }



    // Ajax function to collect ids 

    public function GetFunc($ids  , $fee_group , $currentDateTime){
        try{

            foreach($ids as $i):

                $sql = $this->db->prepare("SELECT assign_fee.fee_type_id FROM `assign_fee` WHERE fee_group_id = :fee_group");
    
                $sql->bindParam(':fee_group' , $fee_group);
                $sql->execute();
    
                if($sql->rowCount() > 0){
                    foreach($sql->fetchAll() as $s):

                        // Select Fee Group  Amount
                        $r = $this->db->prepare("SELECT assign_fee.amount FROM `assign_fee` WHERE fee_group_id = :fee_group_id AND fee_type_id = :fee_type_id");

                        $ass = $s['fee_type_id'];

                        $r->bindParam(":fee_group_id" , $fee_group);
                        $r->bindParam(':fee_type_id' , $ass);
                        $r->execute();

                        

                       $a =  $r->fetch(PDO::FETCH_ASSOC);
                       
  
                        $amount =   $a['amount'];
                        
    
                        $stmt = $this->db->prepare("INSERT INTO `master`(fee_type_id , fee_group_id , student_id , amount ,balance ,   created_at) VALUES(? , ? , ? , ?  , ? , ?)");
    
                        $stmt->bindParam(1 , $ass);
                        $stmt->bindParam(2 , $fee_group);
                        $stmt->bindParam(3 , $i);
                        $stmt->bindParam(4 , $amount);
                        $stmt->bindParam(5 , $amount);
                        $stmt->bindParam(6 , $currentDateTime);
    
                        $stmt->execute();
    
                    endforeach;
                }
    
    
            endforeach;

        }catch(PDOException $e){
            echo 'Error please Check' .$e->getMessage();
            return FALSE;
        }
        
       
    }


    // Get Fee Type In Assign Fee Type
    public function getType($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php  echo $row['id'];  ?>"><?php echo $row['fee_type'];    ?></option>
                <?php
            }
        }
    }


    // INSERT QUERY
    public function Create($fee_group_id , $fee_type_id , $date , $amount , $currentDateTime){
        try{

            $sql = $this->db->prepare("INSERT INTO `assign_fee` (fee_group_id , fee_type_id , date , amount , created_at) VALUES(? , ? , ? , ? , ?)");

            $sql->bindParam(1 , $fee_group_id);
            $sql->bindParam(2 , $fee_type_id);
            $sql->bindParam(3 , $date);
            $sql->bindParam(4 , $amount);
            $sql->bindParam(5 , $currentDateTime);

            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo 'Error please check' .$e->getMessage();
            return FALSE;
        }
    }



    // DELETE Particular 
    public function delete($id , $fee_group_id){
        $sql = $this->db->prepare("DELETE FROM `assign_fee` WHERE id = :id  AND fee_group_id = :fee_group_id");

        $sql->bindParam(":id" , $id);
        $sql->bindParam(":fee_group_id" , $fee_group_id);
        $sql->execute();

        return TRUE;
    }




    // GET course id
    public function getCourse($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            ?><option value="">Select Course</option><?php
            while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo $res['id'];   ?>"><?php  echo $res['name'];   ?></option>
                <?php
            }
        }
    }





    // Filteration Findout course and name
    public function findOut($course_id , $fa_name , $fee_group_id){

        if(empty($course_id) && empty($fa_name)){

            $sql = $this->db->prepare("SELECT courses.name , students.* FROM students INNER JOIN courses ON students.course_id = courses.id");

        }else{

            $sql = $this->db->prepare("SELECT courses.name , students.* FROM students INNER JOIN courses ON students.course_id = courses.id WHERE sname LIKE :sname AND course_id = :course_id");
        }

            $sname = '%' . $fa_name . '%';

        if(! empty($fa_name) || ! empty($course_id)) {
            $sql->bindParam(':sname' , $sname);
            $sql->bindParam(':course_id' , $course_id);
        }

        $sql->execute();

        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }



    // Get data to assign fee
    public function getData($fee_group_id){
        
        $sql = $this->db->prepare("SELECT assign_fee.id, assign_fee.amount, fee_types.fee_type , fee_groups.fee_group ,  assign_fee.date ,  fee_types.id as fee_id  FROM `assign_fee` INNER JOIN `fee_types` ON assign_fee.fee_type_id = fee_types.id INNER JOIN fee_groups ON assign_fee.fee_group_id = fee_groups.id WHERE assign_fee.fee_group_id = :fee_group_id");

        $sql->bindParam(':fee_group_id' , $fee_group_id);
        $sql->execute();

        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }




    // DELETE ALL QUERY
    public function removeData($fee_group_id){
        $sql = $this->db->prepare("DELETE FROM `assign_fee` WHERE fee_group_id = :fee_group_id");

        $sql->bindParam(":fee_group_id" , $fee_group_id);
        $sql->execute();

        return TRUE;
    }



    // UPDATE QUERY
    public function Update($fee_id , $fee_group_id , $fee_type_id , $date , $amount , $currentDateTime){
        try{

            $sql = $this->db->prepare("UPDATE `assign_fee` SET fee_group_id = :fee_group_id , fee_type_id = :fee_type_id , date = :datee , amount = :amount , updated_at = :updated_at WHERE fee_type_id = :fee_id AND fee_group_id = :fee_group_id");

            $sql->bindParam(":fee_id" , $fee_id);
            $sql->bindParam(":fee_group_id" , $fee_group_id);
            $sql->bindParam(":fee_type_id" , $fee_type_id);
            $sql->bindParam(":datee" , $date);
            $sql->bindParam(":amount" , $amount);
            $sql->bindParam(":updated_at" , $currentDateTime);

            $sql->execute();
            return TRUE;

        }catch(PDOException $e){
            echo 'Error Please Check'.$e->getMessage();
            return FALSE;
        }
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
                        <td><?php echo ++$i;  ?></td>
                        <td><?php  echo $row['fee_group'];   ?></td>
                        <td>
                            <?php
                                   $sql = "SELECT assign_fee.id, assign_fee.amount, fee_types.fee_type , assign_fee.date ,  fee_types.id as fee_id  FROM `assign_fee` INNER JOIN `fee_types` ON assign_fee.fee_type_id = fee_types.id WHERE assign_fee.fee_group_id = :fee_group_id"; 

                                   $fee_group_id = $row['fee_group_id'];

                                   $record = $this->db->prepare($sql);
                                   $record->bindParam(":fee_group_id" , $fee_group_id);
                                   $record->execute();

                                   $data = $record->fetchAll(PDO::FETCH_ASSOC);
                                   
                                   foreach($data as $d):
                                    ?>

                                        <div><?php echo $d['fee_type'];    ?>&nbsp;&nbsp;&nbsp;<?php echo $d['amount'];   ?>&nbsp;&nbsp;&nbsp;

                                            <!-- checking admin and user -->
                                            <?php   if($role === 'super_admin') {  ?>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-light btn-xs" title="edit" data-toggle="modal" data-target="#myModal<?php echo $d['id'] ?>"><i class="fas fa-pencil-alt"></i></a>


                                                <!-- Eddit Fee Type Modal -->
                                            <div class="modal fade" id="myModal<?php  echo $d['id']    ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Change Fee Type</h4>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    
                                                    
                                                <form>
                                                        <div class="form-group">
                                                            <label for="fee_type">Fee Type</label>
                                                            <select name="fee_type_id" id="fee_type_id<?php  echo $d['id']    ?>" class="form-control">
                                                                <?php

                                                                    $sql = $this->db->prepare('SELECT * FROM `fee_types`');
                                                                    $sql->execute();

                                                                    if($sql->rowCount() > 0){
                                                                        while($show = $sql->fetch(PDO::FETCH_ASSOC)){
                                                                            ?>
                                                                                <option value="<?php echo $show['id'];    ?>"<?php echo $show['id'] === $d['fee_id'] ? 'selected': ''   ?>><?php echo $show['fee_type'];    ?></option>
                                                                            <?php
                                                                        }
                                                                    }

                                                                    ?>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date">Due Date</label>
                                                            <input type="date" name="date" id="date<?php  echo $d['id']    ?>" class="form-control" value="<?php echo $d['date'];   ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="amount">Amount</label>
                                                            <input type="amount" name="amount" id="amount<?php  echo $d['id']    ?>" class="form-control" value="<?php echo $d['amount'];    ?>">
                                                        </div>
                                                </form>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <input type="hidden" name="fee_id" id="fee_id<?php  echo $d['id']    ?>" value="<?php echo $d['fee_id'];    ?>">
                                                        <input type="hidden" name="fee_group_id" id="fee_group_id<?php  echo $d['id']    ?>" value="<?php echo $fee_group_id;    ?>">
                                                        <div class="form-group">
                                                        <input type="submit" value="Change" name="change" id="change<?php  echo $d['id']    ?>" class="btn btn-success btn-sm ml-3">
                                                    </div>
                                                    </div>
                                                </div>
                                                                
                                                
                                                <script>
                                                    $(document).ready(function(){
                                                        $('#change<?php  echo $d['id']    ?>').click(function(e){
                                                            e.preventDefault();


                                                            var fee_id = $('#fee_id<?php  echo $d['id']    ?>').val();
                                                            var fee_group_id = $('#fee_group_id<?php  echo $d['id']    ?>').val();
                                                            var fee_type_id = $('#fee_type_id<?php  echo $d['id']    ?>').val();
                                                            var date = $('#date<?php  echo $d['id']    ?>').val();
                                                            var amount = $('#amount<?php  echo $d['id']    ?>').val();
                                                            
                                                            $.ajax({
                                                                url: 'assign-fee/edit.php',
                                                                type: 'post',
                                                                data: {fee_id , fee_group_id , fee_type_id , date , amount},
                                                                success:function(data , status){
                                                                        
                                                                    window.location = 'assign-fee/create.php?update'

                                                                }
                                                            })
                                                            
                                                        })


                                                    });

                                                    window.deleteData = function (e , fee_group_id){

                                                            if(confirm('Are you sure ?')){

                                                                $.ajax({
                                                                    url: 'assign-fee/delete.php',
                                                                    type: 'post',
                                                                    data: {id : fee_group_id},
                                                                    success:function(data , status){
                                                                        
                                                                        $('#delete').html(`<div class="alert alert-success"role='alert'><strong>Changes saved Successfully</strong></div>`);

                                                                        setTimeout(() => {
                                                                            window.location.reload();
                                                                        }, 1000);
                                                                        
                                                                    }
                                                                })
                                                            }
                                                         }




                                                    window.removeFee = function (e, fee_group_id, ftid){
                                                  
                                                            
                                                                if(confirm('Are you sure ?')){
                                                                    
                                                                    $.ajax({
                                                                        url: 'assign-fee/delete_fee.php',
                                                                        type: 'post',
                                                                        data: {id : ftid , fee_group_id},
                                                                        success:function(data , status){

                                                                            $('#remove').html(`<div class="alert alert-success"role='alert'><strong>Changes saved Successfully</strong></div>`);

                                                                                setTimeout(() => {
                                                                                    window.location.reload();
                                                                                }, 1000);

                                                                        }
                                                                    })
                                                                }
                                                            }

                                                </script>

                                                </div>
                                            </div>
                                            </div>


                                                <a href="#" class="btn btn-light btn-xs" 
                                                onclick='event.preventDefault(); removeFee(event, "<?php echo $fee_group_id ?>", "<?php echo $d["id"]; ?>")'
                                                title="delete"><i class="fas fa-times"></i></a>
                                            </div>
                                                        <?php   } ?>
                                        
                                        </div>

                                            

                                    <?php

                                   endforeach;

                                ?>
                        </td>
                        <td>
                            <?php echo date('M d, Y', strtotime($row['created_at'])) ?>
                        </td>
                        <!-- checking admin and user -->
                        <?php if($role ==='super_admin'){   ?>
                        <td>
                             <div class="btn-group">
                                 <a href="#" class="btn btn-danger btn-xs" onclick="event.preventDefault(); deleteData(event , <?php  echo $fee_group_id;   ?>)"><i class="fas fa-trash"></i></a>
                                 <a href="assign-fee/fee_master.php?id=<?php  echo $fee_group_id;   ?>" class="btn btn-dark btn-xs"><i class="fas fa-tag"></i></a>
                             </div>
                        </td>
                        <?php  }  ?>
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





