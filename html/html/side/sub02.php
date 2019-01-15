<?php
	session_start(); //세션 시작

   include "../db/dbcon.php";
$page=$_GET['page'];
$mode=$_GET['mode'];
$find_select=$_GET['find_select'];
$find_text=$_GET['find_text'];
$scale = 6;

    //카테고리 테이블로부터 카테고리 가져오기
    $sql = "select cat_id, cat_name from categories order by cat_id"; 
    $result = mysql_query($sql,$connect); // 입력된 SQL 명령 실행

	//똑같은 카테고리의 책들을 가져오기
	$cat_id1 = $_GET['cat_id'];
	
	
	if ($cat_id1){
		if($cat_id1 == 2100){
			if($mode == "mode01"){
				$sql2 = "select * from books where cat_id>2100 and cat_id<=2109 order by publication_date desc";
			}
			else if($mode == "mode02"){
				$sql2 = "select * from books where cat_id>2100 and cat_id<=2109 order by publication_date";
			}
			else if($mode == "mode03"){
				$sql2 = "select * from books where cat_id>2100 and cat_id<=2109 order by price";
			}
			else{
				$sql2 = "select * from books where cat_id>2100 and cat_id<=2109";
			}
		}
		else if($cat_id1 == 2200){
			if($mode == "mode01"){
				$sql2 = "select * from books where cat_id>2200 and cat_id<=2211 order by publication_date desc";
			}
			else if($mode == "mode02"){
				$sql2 = "select * from books where cat_id>2200 and cat_id<=2211 order by publication_date";
			}
			else if($mode == "mode03"){
				$sql2 = "select * from books where cat_id>2200 and cat_id<=2211 order by price";
			}
			else{
				$sql2 = "select * from books where cat_id>2200 and cat_id<=2211";
			}
		}
		else if($cat_id1 == 2300){
			if($mode == "mode01"){
				$sql2 = "select * from books where cat_id>2300 and cat_id<=2304 order by publication_date desc";
			}
			else if($mode == "mode02"){
				$sql2 = "select * from books where cat_id>2300 and cat_id<=2304 order by publication_date";
			}
			else if($mode == "mode03"){
				$sql2 = "select * from books where cat_id>2300 and cat_id<=2304 order by price";
			}
			else{
				$sql2 = "select * from books where cat_id>2300 and cat_id<=2304";
			}
		}
		else{
			if($mode == "mode01"){
				$sql2 = "select * from books where cat_id=$cat_id1 order by publication_date desc";
			}
			else if($mode == "mode02"){
				$sql2 = "select * from books where cat_id=$cat_id1 order by publication_date";
			}
			else if($mode == "mode03"){
				$sql2 = "select * from books where cat_id=$cat_id1 order by price";
			}
			else{
				$sql2 = "select * from books where cat_id=$cat_id1";
			}
		}
	}
	else if($find_text){
		$sql2 = "select * from books where $find_select and title like '%$find_text%'";
	}
	else{
		if($mode == "mode01"){
			$sql2 = "select * from books where cat_id>=2000 and cat_id<=2304 order by publication_date desc";
		}
		else if($mode == "mode02"){
			$sql2 = "select * from books where cat_id>=2000 and cat_id<=2304 order by publication_date";
		}
		else if($mode == "mode03"){
			$sql2 = "select * from books where cat_id>=2000 and cat_id<=2304 order by price";
		}
		else{
			$sql2 = "select * from books where cat_id>=2000 and cat_id<=2304"; // 범위처리 수정 필요
		}
	}
	$result2 = mysql_query($sql2,$connect);
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
<script>
function up(id,max){
	var count = document.getElementById("count_"+id);
	count.value++;
}
function down(id){
	var count = document.getElementById("count_"+id);
	if(count.value > 1)
		count.value--;
}
</script>
</head>
<body>
<? include "../lib/top_menu.php";?>
<div id="main">
<div id="side_menu">
   <ul id="menu01">
       <li>외국도서</li>
   </ul>
    <ul id="menu02">
	<?php
	for($i=0;$row=mysql_fetch_array($result);$i++){
		
		$cat_id=$row[cat_id];
		$cat_name=$row[cat_name];	
	
		if (2100 <= $cat_id && $cat_id <=2304){
			$url="sub02.php?cat_id=$cat_id"; 
		
			if ($cat_id ==2100 || $cat_id == 2200 || $cat_id == 2300)
				echo "<li><a href='$url'><span>$cat_name</span></a></li>";
			else
				echo "<li><a href='$url'>$cat_name</a></li>";
		}
	}
	?>
    </ul>    
</div><!--side_menu-->
<div id="books">
	<div id="top">
		<ul>
			<li><? if(!$cat_id1){?><a href="sub02.php?mode=mode01"><? }else{?><a href="sub02.php?cat_id=<?=$cat_id1?>&&mode=mode01"><? }?>신간도서순</a></li>
			<li>|</li>
			<li><? if(!$cat_id1){?><a href="sub02.php?mode=mode02"><? }else{?><a href="sub02.php?cat_id=<?=$cat_id1?>&&mode=mode02"><? }?>발행일자순</a></li>
			<li>|</li>
			<li><? if(!$cat_id1){?><a href="sub02.php?mode=mode03"><? }else{?><a href="sub02.php?cat_id=<?=$cat_id1?>&&mode=mode03"><? }?>가격순</a></li>
		</ul>
	</div><!--top-->
	<?php 
	/*
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

//$book_introduction = str_replace("\n","<br>",$row2[book_introduction]);
//$book_introduction = str_replace(" ","&nbsp;",$book_introduction);

			$image_name = $row2[file_name_0];
			$image_copied = $row2[file_copied_0];

			$img_name = $image_copied;
			$img_name = "../data/".$img_name;

			$sql3 = "select * from review where isbn=$isbn";
			$result3 = mysql_query($sql3,$connect);	
			$review_count = mysql_num_rows($result3);
			?>
	<div id="book">
		<a href="sub06.php?isbn=<?=$isbn;?>"><img src="<?=$img_name;?>" id="img"></a>
		<div id="explanation">
			<h3 class="title"><a href="sub06.php?isbn=<?=$isbn;?>"><?=$title;?></a></h3>
			<ul id="writer">
				<li><?=$author;?></li>
				<li>|</li>
				<li><?=$publisher;?></li>
				<li>|</li>
				<li><?=$publication_date;?></li>
			</ul>
				<ul id="money">
					<li><b id="strong"><?=$price;?></b></li>
					<li id="won">원</li>
					<li><img id="point_icon" src="/img/side/point.png"></li>
					<li id="point"><?=$point;?>원</li>
				</ul>
			<ul id="review">
				<li><?php for($j=0; $j<5; $j++){ ?><img id="star" src="/img/side/star.png"><? } ?></li>
				<li>0.0</li>
				<li>&nbsp&nbsp&nbsp</li>
				<li><img id="bubble" src="/img/side/bubble.png"></li>
				<li>리뷰</li>
				<li><?=$review_count;?></li>
			</ul>
			<p><!--주인공이 과거에 저지른 죄, 그리고 15년 전에 했던 어떤 약속을 둘러싸고 벌어지는 미스터리를 그린 야쿠마루 가쿠의 소설 『돌이킬 수 없는 약속』. 자신이 일하던 가게의 손님이었던 오치아이의 제안으로 바를-->
			<?php 
				$book_introduction = iconv_substr($book_introduction, 0, 100, "utf-8");
				echo $book_introduction."...";
		?>
			</p>
		</div><!--explanation-->
		<div id="box">
			<ul id="quantity">
				<li><input type="checkbox"></li>
				<li>수량:</li>
				<li><input type="text" class="count" id="count_<?=$isbn;?>" value="1"><button id="up" onclick="up('<?=$isbn;?>','100')">+</button><button id="down" onclick="down('<?=$isbn;?>')">-</button></li>
			</ul>
			<div class="btn">
			<form method="post" action="../basket/basket.php">
			<input type="hidden" name="new" value="<?=$isbn; ?>">
				<button type="submit" class="btn01">장바구니에 담기</button>
				</form>
				<form method="post" action="../basket/ord.php">
			<input type="hidden" name="new" value="<?=$isbn; ?>">
				<button class="btn02">바로구매하기</button>
				</form>
				<button class="btn03">위시리스트</button>
			</div><!--btn-->
		</div><!--box-->
	</div><!--book-->
	<?php
		$number--;
	  }
		mysql_close();
	?>
</div><!--books-->
<div class="clear"></div>
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
			echo "<a href='sub02.php?page=$i'><button class='page_btn'> $i </button></a>";
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