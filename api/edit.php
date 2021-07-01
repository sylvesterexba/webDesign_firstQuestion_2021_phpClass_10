<?php include_once "../base.php";

$table=$_POST['table'];
$db=new DB($table);
$texts=$_POST['text'];
$ids=$_POST['id'];

foreach ($ids as $key => $id) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $db->del($id);
    } else {
        $row=$db->find($id);
        $row['text']=$texts[$key];

        switch ($table) {
          case 'title':
            $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0;
          break;
          default:
            $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
            break;

        }
  
        $db->save($row);
    }
}
to("../backend.php?do=".$table);