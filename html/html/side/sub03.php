<?php
session_start();
include"../db/dbcon.php";

$sql="select * from books order by publication_date desc";
$result=mysql_query($sql, $connect);

$sql2="select * from books where cat_id>=1000 and cat_id<2000 order by publication_date desc";
$result2=mysql_query($sql2, $connect);

$sql3="select * from books where cat_id>=2000 and cat_id<3000 order by publication_date desc";
$result3=mysql_query($sql3, $connect);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/side_menu.css" rel="stylesheet">
<link href="/css/full.css" rel="stylesheet">
<link href="/css/sub03.css" rel="stylesheet">
<link href="/css/sub04.css" rel="stylesheet">
</head>
<body>
<? include "../lib/top_menu.php";?>
<div id="main">
<div id="side_menu">
   <ul id="menu01">
       <li>신간도서</li>
   </ul>
    <ul class="menu02">
        <li><a href="sub01.php?mode=mode01">국내도서</a></li>
        <li><a href="sub02.php?mode=mode01">외국도서</a></li>
    </ul>
</div><!--side_menu-->
<div id="books">
	<h2>화제의 <span id="new_title">신간</span></h2>
	<div id="new">
		<?php
		for($i=0; $row=mysql_fetch_array($result); $i++){
			if($i>=4)
				break;
			$image_name = $row[file_name_0];
			$image_copied = $row[file_copied_0];
			$img_name = $image_copied;
			$img_name = "../data/".$img_name;

			$isbn=$row[isbn];
			$title=$row[title];
			$price = $row[price];
			$point = $row[point];
			
		?>
		<div id="new_box">
			<a href ="../side/sub06.php?isbn=<?=$isbn;?>"><img id="new_book" src="<?=$img_name;?>"></a>
			<h5><?=$title;?></h5>
			<ul>
				<li id="book_money"><?=$price;?>원</li>
				<li><img id="book_point_icon" src="/img/side/point.png"><span id="book_point"><?=$point;?>원</span></li>
			</ul>
		</div><!--new_box-->
		<? } ?>
	</div><!--new-->
	<div id="domestic">
		<ul id="head">
			<li><h2>국내도서</h2></li>
			<li id="add"><a href="sub01.php?mode=mode01">더보기 <span id="add01">></span></a></li>
		</ul>
		<div id="domestic_new">
		<?php
		for($i=0; $row2=mysql_fetch_array($result2); $i++){
			if($i>=8)
				break;
			$image_name = $row2[file_name_0];
			$image_copied = $row2[file_copied_0];
			$img_name = $image_copied;
			$img_name = "../data/".$img_name;

			$isbn=$row2[isbn];
			$title=$row2[title];
			$price = $row2[price];
			$point = $row2[point];
			
		?>
		<div id="new_box">
			<a href ="../side/sub06.php?isbn=<?=$isbn;?>"><img id="new_book" src="<?=$img_name;?>"></a>
			<h5><?=$title;?></h5>
			<ul>
				<li id="book_money"><?=$price;?>원</li>
				<li><img id="book_point_icon" src="/img/side/point.png"><span id="book_point"><?=$point;?>원</span></li>
			</ul>
		</div><!--new_box-->
		<? } ?>
		</div><!--domestic_new-->
	</div><!--domestic-->
	<div id="domestic">
		<ul id="head">
			<li><h2>외국도서</h2></li>
			<li id="add"><a href="sub02.php?mode=mode01">더보기 <span id="add01">></span></a></li>
		</ul>
		<div id="domestic_new">
			<?php
		for($i=0; $row3=mysql_fetch_array($result3); $i++){
			if($i>=8)
				break;
			$image_name = $row3[file_name_0];
			$image_copied = $row3[file_copied_0];
			$img_name = $image_copied;
			$img_name = "../data/".$img_name;

			$isbn=$row3[isbn];
			$title=$row3[title];
			$price = $row3[price];
			$point = $row3[point];
			
		?>
		<div id="new_box">
			<a href ="../side/sub06.php?isbn=<?=$isbn;?>"><img id="new_book" src="<?=$img_name;?>"></a>
			<h5><?=$title;?></h5>
			<ul>
				<li id="book_money"><?=$price;?>원</li>
				<li><img id="book_point_icon" src="/img/side/point.png"><span id="book_point"><?=$point;?>원</span></li>
			</ul>
		</div><!--new_box-->
		<? } ?>
		</div><!--domestic_new-->
	</div><!--domestic-->
</div><!--books-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>