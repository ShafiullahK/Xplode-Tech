<?php

// include db
include_once 'db.php';


class Academy_Info extends db {


    // GET ID
    public function getID($id){

        $sql = $this->db->prepare("SELECT * FROM `academy` WHERE id = 1");

        $sql->bindParam(1 , $id);

        $sql->execute();

        $editrow = $sql->fetch(PDO::FETCH_ASSOC);
        return $editrow;
    }

    // LOGIN LOGIN TO Academy
    public function getLogo($sql){

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $a = $stmt->fetch(PDO::FETCH_ASSOC);
        return $a;
    }


    // FOr principle signature
    public function Check($filename_p , $filetype_p , $filesize_p , $filetmp_p){

        // Allow certain file formate
        if($filetype_p == 'image/jpg' || $filetype_p == 'image/jpeg' || $filetype_p == 'image/png' || $filetype_p == 'image/pdf'){

            // Check File size
            if($filesize_p <= 5000000){
                
                if(move_uploaded_file($filetmp_p , '../uploads/' . $filename_p)){
                    echo 'Success';

                    return TRUE;
                }
            }else{

                echo 'Sorry Your file is so large';
            }

        }else{

            echo 'Sorry Only JPG , JPEG , PNG  , GIF file are allowed';
            return FALSE;

        }

    }



    // FOr Logo image
    public function LogoCheck($filename_l , $filetype_l , $filesize_l , $filetmp_l){

        // Allow certain file formate
        if($filetype_l == 'image/jpg' || $filetype_l == 'image/jpeg' || $filetype_l == 'image/png' || $filetype_l == 'image/pdf'){

            // Check File size
            if($filesize_l <= 5000000){

                if(move_uploaded_file($filetmp_l , '../uploads/' . $filename_l)){
                    echo 'Success';

                    return TRUE;
                }

            }else{

                echo 'Sorry Your file is so large';
            }

        }else{

            echo 'Sorry Only JPG , JPEG , PNG  , GIF file are allowed';
            return FALSE;

        }

    }


    // UPATE QUERY
    public function Update($id , $name , $contact , $address , $details , $filename_p , $filetype_p , $filesize_p , $filetmp_p , $filename_l , $filetype_l , $filesize_l , $filetmp_l , $currentDateTime){

        $sql = "UPDATE `academy` SET name = :namee , contact = :contact , address = :addresss , details = :details  , updated_at = :updated_at";
        try{

            if(!empty($filename_p) && empty($filename_l)){

                $sql .= ", principle = :principle WHERE id = :id";

                

            }
            

            if(!empty($filename_l) && empty($filename_p)){

                $sql .= ", logo = :logo WHERE id = :id";
                


            }

                if(!empty($filename_p) && !empty($filename_l)){

                    $sql .= ", principle = :principle , logo = :logo WHERE id = :id"; 
                }


            if(empty($filename_p) && empty($filename_l)){

                $sql .= " WHERE id = :id";
            }


            $stmt = $this->db->prepare($sql);

                

            //  For principle Signature         
            if(!empty($filename_p)){
                $stmt->bindParam(':principle' , $filename_p);
            }

            if(!empty($filename_p)){
                $this->Check($filename_p , $filetype_p , $filesize_p , $filetmp_p);
            }


            // For Logo Image
            if(!empty($filename_l)){
                $stmt->bindParam(':logo' , $filename_l);
            }


            if(!empty($filename_l)){
                $this->Check($filename_l , $filetype_l , $filesize_l , $filetmp_l);
            }

            $stmt->bindParam(":id" , $id);
            $stmt->bindParam(":namee" , $name);
            $stmt->bindParam(":contact" , $contact);
            $stmt->bindParam(":addresss" , $address);
            $stmt->bindParam(":details" , $details);
            $stmt->bindParam(":updated_at" , $currentDateTime);

            $stmt->execute();

            return TRUE;

        }catch(PDOException $e){
            echo 'Error pleace Check'.$e->getMessage();
            return FALSE;
        }
        
    }


}





?>