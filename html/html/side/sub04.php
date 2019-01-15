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
<div id="info">
	<a href="information.php"><img class="info" src="/img/side/example_information.PNG"></a>
	<!--<img class="info01" src="/img/side/exam02.png">
	<img class="info" src="/img/side/exam03.png">-->
	<div id="top">
		<ul>
			<li><a href="#">신간도서순</a></li>
			<li>|</li>
			<li><a href="#">발행일자순</a></li>
			<li>|</li>
			<li><a href="#">가격순</a></li>
		</ul>
	</div><!--top-->
	<?php /*
	foreach($books_array as $row2){
				$url2="sub06.php?isbn=".$isbn.$isbn;
		}*/
	for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
		{
			mysql_data_seek($result2, $i);
			$row2 = mysql_fetch_array($result2);
			$title = $row2[title];
			$subtitle = $row2[subtitle];
			$author = $row2[author];
			$publisher = $row2[publisher];
			$publication_date = $row2[publication_date];
			$price = $row2[price];
			$point = $row2[point];
			$book_introduction = $row2[book_introduction];
			$isbn = $row2[isbn];

			$image_name = $row2[file_name_0];
			$image_copied = $row2[file_copied_0];

			$img_name = $image_copied;
			$img_name = "../data/".$img_name;

			//리뷰 개수
			$sql3 = "select * from review where isbn=$isbn";
			$result3 = mysql_query($sql3,$connect);	
			$review_count = mysql_num_rows($result3);
			?>
	<div id="book01">
		<a href="sub06.php?isbn=<?=$isbn;?>"><img id="book_img" src="<?=$img_name;?>"></a>
		<h5><a href="sub06.php?isbn=<?=$isbn;?>"><?=$title;?></a></h5>
		<ul>
			<li id="book_money"><?=$price;?>원</li>
			<li><img id="book_point_icon" src="/img/side/point.png"><span id="book_point"><?=$point;?>원</span></li>
		</ul>
	</div><!--book01-->
	<?php
		$number--;
	  }
		mysql_close();
	?>
</div><!--info-->
<!--임시 페이지 버튼-->
<?php
	echo "<div id='page'>";
	if($total_record)
		echo ("<div id='page_num'><button class='page_btn'>◀ </button> &nbsp;&nbsp;&nbsp;&nbsp;");
	for($i = 1; $i <= $total_page; $i++)
	{
		if($page == $i)
		{
			echo "<button id='now'> $i </button>";
		}
		else
		{
			echo "<a href='sub04.php?page=$i'><button class='page_btn'> $i </button></a>";
		}
	}
	if($total_record)
		echo ("&nbsp;&nbsp;&nbsp;&nbsp;<button class='page_btn'>▶</button></div>");
	echo "</div>";
	?>
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>