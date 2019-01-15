<?php
session_start();

header('Content-type:text/html; charset=utf-8');

$userid = $_SESSION['userid'];
$find = $_POST['find'];
$search = $_POST['search'];
$mode = $_GET['mode'];
$page=$_GET['page'];
$scale = 10;

include "../db/dbcon.php";

if($mode == "search"){
	if(!$search){
		echo("
			<script>
				window.alert('검색할 단어를 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}
	$sql = "select * from inquiry where $find like '%$search%'";
}
else{
$sql = "select * from inquiry order by num desc";
}

$result = mysql_query($sql,$connect);
$count = 1;

$total_record = mysql_num_rows($result);

if($total_record % $scale == 0)
	$total_page = floor($total_record / $scale);
else
	$total_page = floor($total_record / $scale) + 1;

if(!$page)
	$page = 1;

$start = ($page - 1) * $scale;
$number = $total_record - $start;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/full.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/side_menu.css" rel="stylesheet">
<script>
function check(){
	if(<?$userid == $custom_id?>)
}
</script>
</head>
<body>
<? include "../lib/top_menu.php";?>
<? include "../lib/side_menu.php";?>
  <div id="notice_main">
    <div id="notice_main_title">문의 사항</div>
    <table>
      <tr>
        <th class="notice">번호</th>
        <th class="notice_title">제목</th>
        <th class="notice">상태</th>
        <th class="notice">날짜</th>
        <th class="notice">작성자</th>
        <th class="notice">조회</th>
      </tr>
			<?php
			for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
			{
      mysql_data_seek($result, $i);       
      $row = mysql_fetch_array($result);
			
			$custom_id = $row[custom_id];
			$num = $row[num];
			$title = $row[title];
			$state = $row[state];
			$regist_day = $row[regist_day];
			$writer = $row[writer];
			$hit = $row[hit];
			$answer = $row[answer];
			?>
			<tr>
        <td class="notice" ><?=$number; ?></th>
        <td class="notice_title">
				<?
				if($userid == $custom_id){
					echo "<a href='write10_in.php?num=$num'>";
				}

				echo $title;

				if($userid == $custom_id){
					echo "</a>";
				}
				?>
				<img src="/img/main/p.JPG" id="p"></td>
        <td class="notice">
		<?php if($answer){?>
		답변완료
		<?php } else{?>
		답변대기
		<?php }?>
		</td>
        <td class="notice"><?=$regist_day; ?></th>
        <td class="notice"><?=$writer; ?></th>
        <td class="notice"><?=$hit?></th>
      </tr>
			<?php
	  $count++;
		$number--;
	  }
		mysql_close();
	  ?>
    </table>
    <!--
    <div class="number_page_center">
    <ul>
      <li><button class="page_btn">◀ </button></li>
      <li id="number_page"><a href="#">1</a></li>
      <li><button class="page_btn">▶ </button></li>
    </ul>
    </div>
		-->
		<?php
		echo "<div id='page'>";
		if($total_record)
			echo ("<div id='page_num01'><button class='page_btn'>◀ </button> &nbsp;&nbsp;&nbsp;&nbsp;");
		for($i = 1; $i <= $total_page; $i++)
		{
			if($page == $i)
			{
				echo "<button id='now'> $i </button>";
			}
			else
			{
				echo "<a href='write10.php?page=$i'><button class='page_btn'> $i </button></a>";
			}
		}
		if($total_record)
			echo ("&nbsp;&nbsp;&nbsp;&nbsp;<button class='page_btn'>▶</button></div>");
		echo "</div>";
    if($userid)
    echo '<a href="write10_write.php"><div class="write_button">글쓰기</div></a>';
    ?>
    <form method="post" action="write10.php?mode=search">
    <div id="search">
      <select id="search_select" name="find">
        <option value="title">제목</option>
        <option value="content">내용</option>
        <option value="writer">작성자</option>
      </select>
      <input type="text" id="search_text" name="search">
      <button type="submit" id="search_button">검색</button>
      </div><!--search-->
			</form>
  </div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>