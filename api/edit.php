<?php include_once "../base.php";

$texts=$_POST['text'];
$ids=$_POST['id'];

foreach ($ids as $key => $id) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $Title->del($id);
    } else {
        $row=$Title->find($id);
        $row['text']=$texts[$key];
        $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0;

        // 判斷是否顯示
        // if (isset($_POST['sh']) && $_POST['sh']==$id) {
        //     $row['sh']=1;
        // }else {
        //     $row['sh']=0;
        // }
  
        $Title->save($row);
    }
}
to("../backend.php?do=title");

