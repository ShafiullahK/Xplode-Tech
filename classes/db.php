<?php



class db {

    public $db;
   
       // Create Database connection 
       public function __construct(){
   
        try{

            $this->db = new PDO('mysql:host=localhost;dbname=xplode-tech','root','');

        
        }catch(PDOException $e){
            echo 'Please Check' .$e->getMessage();

        } 
   
   
       }
   }







?>