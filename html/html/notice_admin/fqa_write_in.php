<?php
session_start();

$num = $_GET['num'];
include "../db/dbcon.php";

$sql = "select * from fqa where num = $num";
$result = mysql_query($sql,$connect);

$row = mysql_fetch_array($result);
$title = $row[title];
$regist_day = $row[regist_day];
$writer = $row[writer];
$content = str_replace("\n","<br>",$row[content]);
$content = str_replace(" ","&nbsp;",$content);
$hit = $row[hit];
$image_name = $row[file_name];
$image_copied = $row[file_copied];

$img_name = $image_copied;
$img_name = "../data/".$img_name;
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
    <div id="notice_main_title">자주묻는 질문</div>
    <div class="in_title"><?=$title; ?></div>
    <div class="in_side"><span class="admin"><?=$writer; ?></span><?=$regist_day; ?> <span class="num"><b>조회수</b> &nbsp;<?=$hit; ?></span></div>
    <div class="content">
	<?php 
		if($image_copied){
			echo "<img src='$img_name' id='file_img'>";
		}
		?><br><br>
    <?=$content; ?></div>
    <a href="fqa.php"><div class="write_button" style="margin-top:10px;">목록</div></a>
    <? echo "<a href='fqa_write.php?mode=modify&&num=$num'><div class='write_button' style='margin-top:10px;'>수정</div></a>";?>
    <? echo "<a href='../db/notice_delete.php?mode=fqa&&num=$num'><div class='write_button' style='margin-top:10px;'>삭제</div></a>";?>
  </div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>