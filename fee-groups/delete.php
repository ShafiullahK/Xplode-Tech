<?php


include_once dirname(__DIR__) . '/classes/fee_group.php';

$Group = new Fee_Group();


if(isset($_POST['id'])){

    $id = $_POST['id'];

    $Group->Delete($id);

    echo "<script> window.location = '../fee-groups/create.php?delete'</script>";
}





?>
