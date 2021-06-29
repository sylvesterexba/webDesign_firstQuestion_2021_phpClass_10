<?php include_once "../base.php";

// $total=$_POST['total'];

$Bottom->save(['id'=>1,'bottom'=>$_POST['bottom']]);

to("../backend.php?do=bottom");
