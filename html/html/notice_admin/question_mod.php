<?php
session_start();
include "../db/dbcon.php";

$num = $_GET['num'];

$sql = "select * from inquiry where num = $num";
$result = mysql_query($sql,$connect);

$row = mysql_fetch_array($result);
$title = $row[title];
$regist_day = $row[regist_day];
$writer = $row[writer];
$content = str_replace("\n","<br>",$row[content]);
$content = str_replace(" ","&nbsp;",$content);
$hit = $row[hit];
$answer = str_replace("\n","<br>",$row[answer]);
$answer = str_replace(" ","&nbsp;",$answer);
$image_name = $row[file_name];
$image_copied = $row[file_copied];

$img_name = $image_copied;
$img_name = "../data/".$img_name;

//echo $img_name;
//exit;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/full.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/write_in.css" rel="stylesheet">
<link href="/css/admin_side_menu.css" rel="stylesheet">
</head>
<body>
<? include "../lib/admin_top_menu.php";?>
<? include "../lib/admin_notice.php";?>
  <div id="notice_main">
    <div id="notice_main_title">문의사항</div>
    <div class="in_title"><?=$title; ?></div>
    <div class="in_side"><span class="admin"><?=$writer; ?></span><?=$regist_day; ?> <span class="num"><b>조회수</b> &nbsp;<?=$new_hit; ?></span></div>
    <div class="content">
	<?php 
		if($image_copied){
			echo "<img src='$img_name' id='file_img'>";
		}
		?><br><br>
      <?=$content; ?><br>
      <br>
	  </div>
	 <form method="post" action="../db/inquiry_insert.php?mode=answer_mod&&num=<?=$num;?>">
    <textarea rows="10" cols="120" id="write_textarea" name="answer_mod"><?=$answer; ?></textarea>
    <a href="notice.php"><div class="write_button">목록</div></a>
    <input type="submit" class="write_button" value="확인">
	</form>
  </div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>