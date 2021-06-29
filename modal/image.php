<?php include_once "../base.php";?>

<h3 class="cent"><?=$as['image'];?></h3>
<hr>

<form action="api/add.php" method="post" enctype="multipart/form-data">
  <table style="margin:auto;">
    <tr>
      <td style="text-align:right;"><?=$hs['image'];?>：</td>
      <td><input type="file" name="img" id=""></td>
    </tr>

  </table>
  <div class="cent">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
  </div>
</form>