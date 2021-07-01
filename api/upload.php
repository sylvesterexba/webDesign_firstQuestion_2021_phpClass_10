<?php
include_once "../base.php";

$db=new DB($_POST['table']);
$row=$db->find($_POST['id']);

if (isset($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/".$_FILES['img']['name']);
    $row['img']=$_FILES['img']['name'];
    $db->save($row);

}

to("../backend.php?do=".$_POST['table']);