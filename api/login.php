<?php include_once "../base.php";

$chk=$Admin->count(['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);

if($chk>0){
// if ($_POST['acc']=='admin' && $_POST['pw']=='1234') {
  $_SESSION['admin']=1;
    to("../backend.php?do=title");
}else{
    echo "<script>";
    echo "alert('帳號密碼錯誤');\n";
    echo "location.href='../index.php?do=login'";
    echo "</script>";
}

?>