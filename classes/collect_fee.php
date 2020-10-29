<?php

include_once 'db.php';


class Collect_Fee extends db {

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



    // Get Students to col-sm-2
    public function getStudent($sql , $student){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':student_id' , $student);

        $stmt->execute();

        $recod = $stmt->fetch(PDO::FETCH_ASSOC);

        return $recod;
    }



    
    // SELECT QUERY
    public function dataView($sql , $student){
        

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':students_id' , $student);

        $stmt->execute();
            
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                if(count($res) == 0){
                    ?>
                        <h4>No records found</h4>
                    <?php
                }else{

                
            ?><tbody><?php
            foreach($res  as $a):

                ?>
                        <tr>
                            <td><?php echo $a['fee_group'];  ?></td>
                            <td><?php echo $a['fee_type'];  ?></td>
                            <td><?php echo $a['date'];  ?></td>
                            <td><?php echo $a['amount'];  ?></td>
                            <td>
                                <?php

                                   $status = $a['status'];

                                   if($status == 'paid'){
                                       ?>
                                        <span class="badge badge-success" style="padding:7px;">Paid</span>
                                       <?php
                                       
                                   }elseif($status == 'partial'){
                                       ?>
                                            <span class="badge badge-warning" style="padding:7px;">Partial</span>
                                       <?php

                                   }elseif($status == 'Unpaid'){
                                       ?>
                                            <span class="badge badge-danger" style="padding:7px;">Unpaid</span>
                                       <?php

                                   }elseif($status == 'advance'){
                                       ?>
                                            <span class="badge badge-primary" style="padding:7px">Advance</span>
                                       <?php

                                   }

                                    
                                
                                ?>

                                       
                            </td>
                            <td><?php echo $a['payment'];  ?></td>
                            <td><?php echo $a['due_date'];  ?></td>
                            <td><?php echo $a['paid'];  ?></td>
                            <td><?php echo $a['fine'];  ?></td>
                            <td><?php echo $a['discount'];  ?></td>
                            <td><?php echo $a['balance'];  ?></td>

                            <td class="no-print">
                                <button class="btn btn-xs btn-light" title="Collect Fee" data-toggle="modal" data-target="#collect-fee-modal<?php  echo $a['fee_type_id'];  ?>" style="padding-right:17px; display:block;" aria-modal="true"><i class="fas fa-plus"></i></button>

                                
                                <!-- Modal Fee Collect -->
                                <div class="modal fade" id="collect-fee-modal<?php  echo $a['fee_type_id'];   ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    
                                    <div class="modal-header">
                                        <h4>
                                        <i class="fas fa-dollar-sign"></i>
                                            Collect Fee
                                        </h4>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                    <?php
                                        $students_id = $a['students_id'];
                                        $collect = new Collect_Fee();

                                        $sql = "SELECT discount, fee_amount FROM `students`WHERE id = :students_id";
                                        $dis = $collect->SelectStudents($sql , $students_id);

                                        $discount = $dis[0];
                                        $amount = $dis[1];

                                    ?>

                                        <form id="collect-fee-form<?php echo $a['fee_type_id'];   ?>">
                                            <div class="form-group">
                                                <label for="paid">Amount</label>
                                                <input type="number" name="paid" id="paid" class="form-control" placeholder="Amount" autocomplete="off">
                                                <?php
                                                        echo @$json_decode['paid'];
                                                    ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="discount">Discount</label>
                                                <input type="number" name="discount" id="discount" class="form-control" value="<?php echo $discount ?>" autocomplete="off">

                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="fine">Fine</label>
                                                <input type="number" name="fine"  class="form-control" placeholder="Fine" autocomplete="off">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="date" name="date" class="form-control" placeholder="date">

                                                <?php
                                                    ?>
                                            </div>

                                            <!-- hiden files -->
                                            <input type="hidden" name="fee_type_id"  value="<?php echo $a['fee_type_id'];     ?>">
                                            <input type="hidden" name="fee_group_id"  value="<?php echo $a['fee_group_id'];     ?>">
                                            <input type="hidden" name="students_id"   value="<?php echo $a['students_id'];    ?>">
                                            <div class="form-group">
                                                <input type="submit" value="COLLECT FEE"  class="btn btn-sm btn-success btn-block collect-btn">
                                            </div>
                                        </form>

                                        <script>
                                            $(document).ready(function(){
                                                $('#collect-fee-form<?php echo $a['fee_type_id']; ?>').submit(function(e){
                                                    e.preventDefault();

                                                   const data =   $(this).serialize();
                                                    
                                                    


                                                    $.ajax({
                                                        type: 'post',
                                                        url:  'lib/collect-fee/edit.php',
                                                        dataType: 'html',
                                                        data: data,
                                                        beforeSend: function(){

                                                            $('.collect-btn').attr('disabled',true)
                                                        },
                                                        success:function(data , status){
                                                            

                                                            const d = JSON.parse(data);

                                                        
                                                            

                                                                if (Object.keys(d.verrors).length > 0) {
                                                                    Object.keys(d.verrors).map(fieldName => {
                                                                        $(`input[name=${ fieldName }]`).after(d.verrors[fieldName])

                                                                    });

                                                                } else {
                                                                    $('.collect-btn').attr('disabled', false)
                                                                    
                                                                     window.location.reload();
                                                                }


                                                                
                                                          


                                                        }


                                                    })
                                                    
                                                    
                                                })

                                            });

                                                // Revert Record
                                                window.revertData = function(e , id){
                                                    if(confirm('Are you sure?')){

                                                       $.ajax({
                                                           url: 'collect-fee/revert.php',
                                                           type: 'post',
                                                           data: {id},
                                                           success:function(data , status){

                                                               window.location.reload();


                                                           }
                                                       })
                                                    }
                                                };
                                        </script>
                                       
                                    </div>
                                    </div>
                                </div>
                                </div>

                            
                            </td>
                        </tr>
                        <tr>
                            <?php

                                $students = $a['students_id'];
                                $fee_type = $a['fee_type_id'];
                                $fee_group = $a['fee_group_id'];
                                
                                $sql = $this->db->prepare("SELECT * FROM `payment` WHERE student_id = :student_id AND fee_type_id = :fee_type_id AND fee_group_id  = :fee_group_id");
                                $sql->bindParam(":student_id" , $students);
                                $sql->bindParam(":fee_type_id" , $fee_type);
                                $sql->bindParam(":fee_group_id" , $fee_group);
                                $sql->execute();
                                $stmt = $sql->fetchAll(PDO::FETCH_ASSOC);

                                // Call getStudent function 

                                 $studentRe = $this->getStudent("SELECT courses.name , students.* FROM `students` INNER JOIN `courses` ON students.course_id = courses.id WHERE students.id = :student_id" , $student);


                                foreach($stmt as $i):
                                    ?>
                                    
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right">
                                            <img src="images/<?php  echo  'image.png';    ?>" >
                                            
                                        </td>
                                        <td class="text-primary"><?php  echo $i['payment_id'];  ?></td>
                                        <td><?php  echo $i['date'];   ?></td>
                                        <td><?php  echo $i['paid'];   ?></td>
                                        <td><?php  echo $i['fine'];   ?></td>
                                        <td><?php  echo $i['discount'];   ?></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-xs btn-light" title="Revert" id="revert<?php echo $i['id'];  ?>" onclick="event.preventDefault(); revertData(event , <?php echo $i['id']; ?>)"><i class="fas fa-sync"></i></button>
                                            <!-- print payment -->
                                            <button class="btn btn-xs btn-light" id="print<?php    echo $i['id'];  ?>"><i class="fas fa-print"></i></button>
                                        </td>   
                                            <?php
                                                  $sql = $this->db->prepare("SELECT * FROM `academy` WHERE id = 1");

                                                  $sql->execute(array(":id"=>1));  

                                                 $row = $sql->fetch(PDO::FETCH_ASSOC);
                                                    ?>

                                                        
                                        <script>
                                                // Invoice
                                                $(document).ready(function(){
                                                    $("#print<?php echo $i['id'];  ?>").click(function(){
                                                         
                                                        const templete = `
                                                               <div class="container mt-3">
                                                                   <div class="row justify-content-center">
                                                                        <div class="col-sm-12">
                                                                            <div class="row justify-content-center">
                                                                                <div class="col-2">
                                                                                    <img src="http://localhost/xplode-tech/uploads/<?php echo $row['logo'];   ?>"  style="width:80px; height:80px; object-fit:contain">
                                                                                </div>
                                                                                <div class="col-8 text-center">
                                                                                    <h4><?php echo $row['name'];   ?></h4>
                                                                                    <small class="d-block text-muted">
                                                                                        <?php echo $row['address'];    ?>
                                                                                    </small>

                                                                                </div>
                                                                            </div>

                                                                            <h6 class="text-center mt-3">Payment Voucher</h6>
                                                                            <hr>
                                                                            <p style="font-family: monospace">
                                                                                Payment ID:
                                                                                <?php echo $i['payment_id'];    ?>
                                                                            </p>

                                                                            <div class="card">
                                                                                <div class="card-header text-center font-weight-bold">
                                                                                    Invoice Details
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <ul class="list-group list-group-flush" style="font-size:90%">
                                                                                        <li class="list-group-item">
                                                                                            <div class="row">
                                                                                                <div class="col-6">
                                                                                                   <strong>Student Name</strong>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <?php echo $studentRe['sname'];   ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li class="list-group-item">
                                                                                            <div class="row">
                                                                                                <div class="col-6">
                                                                                                    <strong>Father's Name</strong>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <?php echo $studentRe['fname'];   ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li class="list-group-item">
                                                                                            <div class="row">
                                                                                                <div class="col-6">
                                                                                                    <strong>Course</strong>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <?php echo $studentRe['name'];    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li class="list-group-item">
                                                                                            <div class="row">
                                                                                                <div class="col-6">
                                                                                                    <strong>Amount</strong>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <?php echo number_format($i['paid']);    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li class="list-group-item">
                                                                                            <div class="row">
                                                                                                <div class="col-6">
                                                                                                    <strong>Fine</strong>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <?php echo number_format($i['fine']);    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li class="list-group-item">
                                                                                            <div class="row">
                                                                                                <div class="col-6">
                                                                                                    <strong>Discount</strong>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <?php echo number_format($i['discount']);    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                
                                                                                </div>
                                                                            
                                                                            </div>

                                                                            <small class="d-block p-2 float-right text-muted">
                                                                                <i>Thank You !</i>
                                                                            </small>
                                                                        
                                                                        </div>
                                                                   
                                                                   </div> 
                                                               
                                                               </div>     
                                                        
                                                              `

                                                            let wind = window.open('', '_blank', 'width=400; height=400;resizeable=0;');

                                                            wind.document.head.innerHTML = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">'
                                                            wind.document.body.innerHTML = templete;
                                                            wind.print();

                                                                        
                                                    })

                                                });    

                                        
                                        
                                        </script>

                                        

                                    </tr>

                                <?php  endforeach;
                           
            endforeach;
            ?></tbody><?php

                ?>
                    <!-- TOTAL AMOUNT  -->
                <tr style="font-size:110%" class="bg-dark text-white">
                    <td class="text-right">
                        <strong>TOTALS</strong>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <?php
                                

                                $sql = $this->db->prepare("SELECT SUM(amount) as `total` FROM `master` WHERE student_id = :students_id");
                                $sql->bindParam(':students_id' , $students);
                                $sql->execute();

                                $f = $sql->fetch(PDO::FETCH_ASSOC);
                                
                                    ?> <strong style="text-white"><?php echo  number_format($f['total']);   ?></strong><?php
                            ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <?php

                                $sql = $this->db->prepare("SELECT SUM(paid) as `paid` FROM `master` WHERE student_id = :students_id");
                                $sql->bindParam(':students_id' , $students);
                                $sql->execute();

                                $p = $sql->fetch(PDO::FETCH_ASSOC);
                                ?><strong style="text-white"><?php echo number_format($p['paid']);   ?></strong><?php

                        ?>
                    </td>
                    <td>
                         <?php
                                 $sql = $this->db->prepare("SELECT SUM(fine) as `fine` FROM `master` WHERE student_id = :students_id");
                                $sql->bindParam(':students_id' , $student);
                                $sql->execute();

                                $i = $sql->fetch(PDO::FETCH_ASSOC);
                                ?><strong style="text-white"><?php echo number_format($i['fine']);   ?></strong>
                    </td>
                    <td>
                         <?php
                                 $sql = $this->db->prepare("SELECT SUM(discount) as `discount` FROM `master` WHERE student_id = :students_id");
                                $sql->bindParam(':students_id' , $students);
                                $sql->execute();

                                $d = $sql->fetch(PDO::FETCH_ASSOC);
                                ?><strong style="text-white"><?php echo number_format($d['discount']);   ?></strong>
                    </td>
                    <td>
                         <?php
                                 $sql = $this->db->prepare("SELECT SUM(balance) as `balance` FROM `master` WHERE student_id = :students_id");
                                $sql->bindParam(':students_id' , $students);
                                $sql->execute();

                                $b = $sql->fetch(PDO::FETCH_ASSOC);
                                ?><strong style="text-white"><?php echo number_format($b['balance']);   ?></strong>
                    </td>
                    <td></td>
                </tr>
                <?php


        } 
    
    }



    // Insert data in payment table 
    public function Insert($paid , $discount , $fine , $date , $fee_type_id , $fee_group_id , $students_id , $total , $currentDateTime){
        try{

            $sql = $this->db->prepare("INSERT INTO `payment`(fee_group_id , fee_type_id	, student_id , payment_id , date , paid , fine , discount , created_at) VALUES(? , ? , ? , ? , ? , ? , ? , ? , ?)");

            $sql->bindParam(1 , $fee_group_id);
            $sql->bindParam(2 , $fee_type_id);
            $sql->bindParam(3 , $students_id);
            $sql->bindParam(4 , $total);
            $sql->bindParam(5 , $date);
            $sql->bindParam(6 , $paid);
            $sql->bindParam(7 , $fine);
            $sql->bindParam(8 , $discount);
            $sql->bindParam(9 , $currentDateTime);

            $sql->execute();


            // Select `amount, paid & balance` from `master`
            // if (masterBalance - paid) === 0)   => paid
            // if ((masterPaid + paid) < amount)    => partial
            // unpaid


            // Call FeeCollect Class
           $this->FeeCollect($students_id , $fee_type_id , $fee_group_id , $paid , $fine , $discount);
           
           $sql = $this->db->prepare('SELECT `amount` , `paid` , `balance`FROM `master` WHERE student_id = :students_id AND fee_type_id = :fee_type_id AND fee_group_id = :fee_group_id');

           $sql->bindParam(':students_id' , $students_id);
           $sql->bindParam(':fee_type_id' ,$fee_type_id);
           $sql->bindParam(':fee_group_id' , $fee_group_id);
           
           $sql->execute();
          $res =  $sql->fetch(PDO::FETCH_ASSOC);
          

          $masteramount = $res['amount'];
          $masterpaid = $res['paid'];
          $masterbalance = $res['balance'];

          if($masterbalance  == 0){

            // Update status 
            $stat = $this->db->prepare("UPDATE `master` SET `status` = 'paid' WHERE student_id = :students_id AND fee_type_id = :fee_type_id AND fee_group_id = :fee_group_id");


          }elseif($masterpaid > 0 && $masterbalance > 0){

            $stat = $this->db->prepare("UPDATE `master` SET `status` = 'partial' WHERE student_id = :students_id AND fee_type_id = :fee_type_id AND fee_group_id = :fee_group_id");

          }elseif($masterpaid == 0){

            $stat = $this->db->prepare("UPDATE `master` SET `status` = 'unpaid' WHERE student_id = :students_id AND fee_type_id = :fee_type_id AND fee_group_id = :fee_group_id");

          }elseif($masterbalance < 0){

            $stat = $this->db->prepare("UPDATE `master` SET `status` = 'advance' WHERE student_id = :students_id AND fee_type_id = :fee_type_id AND fee_group_id = :fee_group_id");
              
              
          }

          $stat->bindParam(':students_id' , $students_id);
          $stat->bindParam(':fee_type_id' ,$fee_type_id);
          $stat->bindParam(':fee_group_id' , $fee_group_id);

          $stat->execute();

           
           

            return json_encode(['msg' => 'OK']);
        

        }catch(PDOException $e){

            echo "Error please Check".$e->getMessage();
            return FALSE;
        }
    }





    // GET Payment ID
    public function getPaymentID($sql ,$fee_type_id , $fee_group_id , $students_id){
        
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":fee_type_id", $fee_type_id);
        $stmt->bindParam(":fee_group_id", $fee_group_id);
        $stmt->bindParam(":student_id", $students_id);
        $stmt->execute();

        $count = $stmt->rowCount() + 1;
        return $count;

        
    }


    // Update Fee Collect
    public function FeeCollect($students_id , $fee_type_id , $fee_group_id , $amount , $fine , $discount){
        $total = $amount + $discount;

        $sql = $this->db->prepare("UPDATE `master` SET paid = paid + $total , balance =  balance -  $total  , fine = fine + $fine , discount = discount + $discount WHERE student_id = :students_id AND fee_group_id = :fee_group_id AND fee_type_id = :fee_type_id");

        $sql->bindParam(':students_id' , $students_id);
        $sql->bindParam(':fee_group_id' , $fee_group_id);
        $sql->bindParam(':fee_type_id' , $fee_type_id);

        $sql->execute();

        return TRUE;
    }








    // Get Discount From Students
    public function SelectStudents($sql , $students_id){

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":students_id" , $students_id);

        $stmt->execute();
        
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return [$res['discount'], $res['fee_amount']];

    }





    // Revert /Delete Data
    public function Revert($id){

        $stmt = $this->db->prepare("SELECT paid , payment_id ,  discount , fine , fee_group_id , fee_type_id , student_id  FROM `payment` WHERE id = :id");  

        $stmt->bindParam(":id" , $id);   
        $stmt->execute();

        $a = $stmt->fetch(PDO::FETCH_ASSOC);


        
        $discount = $a['discount'];
        $paid = $a['paid'];
        $fine = $a['fine'];
        $students_id = $a["student_id"];
        $fee_group_id = $a["fee_group_id"];
        $fee_type_id = $a["fee_type_id"];



        $total = $paid + $discount;

        $sql = $this->db->prepare("UPDATE `master` SET paid = paid - $total , balance = balance + $total , fine = fine - $fine , discount = discount - $discount WHERE student_id = :students_id AND fee_group_id = :fee_group_id AND fee_type_id = :fee_type_id");

        $sql->bindParam(":students_id" , $students_id);
        $sql->bindParam(":fee_group_id" , $fee_group_id);
        $sql->bindParam(":fee_type_id" , $fee_type_id);
        

        $sql->execute();


        $sql = $this->db->prepare("DELETE FROM `payment` WHERE id = :id");
        $sql->bindParam(":id" , $id);

        $sql->execute();

        return TRUE;

}




}
?>