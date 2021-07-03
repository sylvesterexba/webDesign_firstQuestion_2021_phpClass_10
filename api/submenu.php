<?php include_once "../base.php";

// 新增
if(isset($_POST['text2'])){
  foreach($_POST['text2'] as $key => $text){
    if(!empty($text)){
      $new['text']=$text;
      $new['href']=$_POST['href2'][$key];
      $new['sh']=1;
      $new['parent']=$_POST['parent'];

      $Menu->save($new);
    }
  }

}

// 編輯
if(isset($_POST['text'])){

}


to("../backend.php?do=menu");
?>