<?php

// include db
include_once 'db.php';

class Index extends db {

    // Students
    public function getStudents($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $res = $stmt->rowCount();
        return $res;
    }


    // Users 
    public function getUsers($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $a = $stmt->rowCount();
        return $a;

    }

    // Collect fee
    public function getFee($sql , $month , $year){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":cm" , $month);
        $stmt->bindParam(":cy" , $year);
        $stmt->execute();

        $a = $stmt->fetch();
        return $a['total'];

    }


    // GET EXpenses
    public function getExpenses($sql , $cm ,$year){

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":cm" , $cm);
        $stmt->bindParam(":cy" , $year);
        $stmt->execute();

        $e = $stmt->fetch();
        return $e['total'];

    }


    /**
     * 
     * @method get_monthly_fee
     * @desc Gets monthly fee record to display On Chart
     * 
     */

     public function get_monthly_records($month){
        
        $sql = $this->db->prepare("SELECT SUM(`paid`) as total FROM `payment` WHERE MONTH(`date`) = :cm AND YEAR(`date`) = :cy");
        
        $cy = date('Y');
        
        $sql->bindParam(":cm" , $month);
        $sql->bindParam(":cy" , $cy);
        $sql->execute();

        $f = $sql->fetch();
        return $f['total'];
         
     }
      /**
       * @method get_monthly_expense_record
       * @desc Get monthly fee record to display On chart
       * 
       */

     public function get_monthly_expense_record($month){
         
        $sql = $this->db->prepare("SELECT SUM(`amount`) as `total` FROM `expenses` WHERE MONTH(`date`) = :cm AND YEAR(`date`) = :cy");

        $cy = date('Y');

        $sql->bindParam(':cm' , $month);
        $sql->bindParam(':cy' , $cy);
        $sql->execute();

        $e = $sql->fetch();
        return $e['total'];

     }


}



?>