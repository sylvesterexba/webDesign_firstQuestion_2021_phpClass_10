<?php
include_once "../base.php";

$db=new DB($_POST['table']);

$data['text']=$_POST['text'];
$data['img']="img1.jpg";

$db->save($data);

to("../backend.php?do=".$_POST['table']);





?>