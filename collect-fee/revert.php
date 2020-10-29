<?php

    include_once dirname(__DIR__) . '/classes/collect_fee.php';
    $collect_fee = new Collect_Fee();


    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $collect_fee->Revert($id);
    }



?>