<?php include_once "../base.php";

if ($_POST['acc']=='admin' && $_POST['pw']=='1234') {
    to("../backend.php?do=title");
}else{
    echo "<script>";
    echo "alert('帳號密碼錯誤');\n";
    echo "location.href='../index.php?do=login'";
    echo "</script>";
}

?>