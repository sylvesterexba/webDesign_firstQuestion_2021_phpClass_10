<div class="di"
  style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
  <!-- 跑馬燈物件 -->
  <?php include "./front/marquee.php";?>
  <!-- 空白 -->
  <div style="height:32px; display:block;"></div>

  <!--正中央-->
  <div class='cent'>更多最新消息顯示區</div>
  <hr>
  <?php
  // 分頁函式(
$all=$News->count(['sh'=>1]);
// division
// 每頁筆數
$div=5;
$pages=ceil($all/$div);
// 三元運算
$now=isset($_GET['p'])?$_GET['p']:1;
$start=($now-1)*$div;
  ?>
  <ol start='<?=$start+1;?>'>
    <?php

$rows=$News->all(['sh'=>1], " limit $start,$div");
// )分頁函式
      foreach ($rows as $key => $value) {
          echo "<li class='sswww'>";
          echo mb_substr($value['text'], 0, 20)."...";
          echo "<span class='all' style='display:none'>{$value['text']}</span>";
          echo "</li>";
      }
          ?>
  </ol>
  <div style="text-align:center;">
    <?php
if (($now-1)>0) {
              echo "<a class='bl' href='?do=news&p=".($now-1)."'> < </a>";
          }

for ($i=1;$i<=$pages;$i++) {
    $fontsize=($now==$i)?'24px':'16px';
    echo "<a class='bl' href='?do=news&p=$i' style='font-size:$fontsize'> $i </a>";
}

if (($now+1)<=$pages) {
    echo "<a class='bl' href='?do=news&p=".($now+1)."'> > </a>";
}

?>
  </div>
</div>
<div id="alt"
  style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
</div>
<script>
$(".sswww").hover(
  function() {
    $("#alt").html("<pre>" + $(this).children(".all").html() + "</pre>").
    css({"top": $(this).offset().top - 50})
    $("#alt").show()
  }
)
$(".sswww").mouseout(
  function() {
    $("#alt").hide()
  }
)
</script>