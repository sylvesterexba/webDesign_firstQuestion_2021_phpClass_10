<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli"><?=$ts[$do];?></p>
  <form method="post" action="api/edit.php">
    <table width="100%" class="cent">
      <tbody>
        <tr class="yel">
          <td width="80%">替代文字</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
        </tr>

        <?php
      
      $rows=$Ad->all();
      foreach ($rows as $key => $value) {
          ?>
    <tr>

      <td>
        <input type="text" name="text[]" value="<?=$value['text']; ?>" style="width:90%">
      </td>
      <td>
        <input type="checkbox" name="sh[]" value="<?=$value['id']; ?>" <?=($value['sh']==1)?"checked":""?>>
      </td>
      <td>
        <input type="checkbox" name="del[]" value="<?=$value['id']; ?>">
      </td>

      <input type="hidden" name="id[]" value="<?=$value['id'];?>">
    </tr>
    <?php
      }
    ?>
      </tbody>
    </table>
    <table style="margin-top:40px; width:70%;">
      <tbody>
        <tr>
          <td width="200px">
            <input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/<?=$do;?>.php&#39;)"
              value="<?=$as[$do];?>">
          </td>
          <td class="cent">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
            <input type="hidden" name="table" value="<?=$do;?>">
          </td>
        </tr>
      </tbody>
    </table>

  </form>
</div>
</div>