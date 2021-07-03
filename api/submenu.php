<?php include_once "../base.php";

// 新增
if (isset($_POST['text2'])) {
    foreach ($_POST['text2'] as $key => $text) {
        if (!empty($text)) {
            $new['text']=$text;
            $new['href']=$_POST['href2'][$key];
            $new['sh']=1;
            $new['parent']=$_POST['parent'];

            $Menu->save($new);
        }
    }
}

// 編輯
if (isset($_POST['text'])) {
    foreach ($_POST['id'] as $key => $id) {
        if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
            $Menu->del($id);
        } else {
            $row=$Menu->find($id);
            $row['text']=$_POST['text'][$key];
            $row['href']=$_POST['href'][$key];
            $Menu->save($row);
        }
    }
}

to("../backend.php?do=menu");