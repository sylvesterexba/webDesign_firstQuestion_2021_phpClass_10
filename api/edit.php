<?php include_once "../base.php";

$texts=$_POST['text'];
$ids=$_POST['id'];

foreach ($ids as $key => $id) { 
  $row=$Title->find($id);
  // print_r($row);
  // echo "<br>";
  $row['text']=$texts[$key];
  // print_r($row);
  // echo "<hr>";
  $Title->save($row);
}

