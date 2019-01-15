<?php
	session_start(); //세션 시작

   include "../db/dbcon.php";

$page=$_GET['page'];
$scale = 6;

    //카테고리 테이블로부터 카테고리 가져오기
    $sql = "select cat_id, cat_name from categories order by cat_id"; 
    $result = mysql_query($sql,$connect); // 입력된 SQL 명령 실행

	//똑같은 카테고리의 책들을 가져오기
	$cat_id = $_GET['cat_id'];
	
	
	if ($cat_id){
	$sql2 = "select * from books where cat_id=$cat_id";
	$result2 = mysql_query($sql2,$connect);
	}
	else{
	$sql2 = "select * from books where cat_id<=4017 and cat_id>=4000"; // 범위처리 수정 필요
	
	$result2 = mysql_query($sql2,$connect);
	}
	//책 테이블로부터 책 정보 가져오기
	

/*
	if ($result2){
		$num_cats = mysql_num_rows($result2);
	}

	$row2 = mysql_fetch_array($result2);
	$title = $row2[title];
	$subtitle = $row2[subtitle];
	$author = $row2[author];
	$publisher = $row2[publisher];
	$publication_date = $row2[publication_date];
	$price = $row2[price];
	$point = $row2[point];
	$book_introduction = $row2[book_introduction];
	
	//$cat_name = $cat_name($row);
	



	$books_array = array();

		for($count = 0; $row2 = mysql_fetch_array($result2); $count++){
			$books_array[$count] = $row2;
		}
*/
$total_record = mysql_num_rows($result2);

if($total_record % $scale == 0)
	$total_page = floor($total_record / $scale);
else
	$total_page = floor($total_record / $scale) + 1;

if(!$page)
	$page = 1;

$start = ($page - 1) * $scale;
$number = $total_record - $start;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/side_menu.css" rel="stylesheet">
<link href="/css/full.css" rel="stylesheet">
<link href="/css/sub04.css" rel="stylesheet">
</head>
<body>
<? include "../lib/top_menu.php";?>
<div id="main">
<div id="side_menu">
   <ul id="menu01">
       <li>수험정보</li>
   </ul>
   <ul id="menu02">
   <?php
	for($i=0;$row=mysql_fetch_array($result);$i++){
	$cat_id=$row[cat_id];
	$cat_name=$row[cat_name];	
		if(4001 <= $cat_id && $cat_id <= 4017){
			
	
    $url="sub04.php?cat_id=$cat_id"; 
	echo "<li><a href='$url'>$cat_name</a></li>";
		}
	}
	?>
	</ul>
</div><!--side_menu-->

	<div>
		<img id="examtop" src="/img/side/exam1.png">
		<img id="exam" src="/img/side/exam2.PNG">
		<img id="exam" src="/img/side/exam3.PNG">
		<img id="exam" src="/img/side/exam4.PNG">
		<img id="exam" src="/img/side/exam5.PNG">
		<img id="exam" src="/img/side/exam6.PNG">
		<img id="exam" src="/img/side/exam7.PNG">
		<img id="exam" src="/img/side/exam8.PNG">
		<img id="exam" src="/img/side/exam9.PNG">
		<img id="exam" src="/img/side/exam10.png">
		<img id="exam"src="/img/side/exam.png">
		<img id="exam" src="/img/side/exam12.PNG">
	</div>

</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>