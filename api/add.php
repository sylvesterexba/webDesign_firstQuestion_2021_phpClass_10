<?php
include_once "../base.php";

$db=new DB($_POST['table']);

if (isset($_FILES['img']['tmp_name'])) {
  // echo $_FILES['img']['tmp_name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/".$_FILES['img']['name']);
    $data['img']=$_FILES['img']['name'];

}

$data['text']=$_POST['text'];

$db->save($data);

to("../backend.php?do=".$_POST['table']);