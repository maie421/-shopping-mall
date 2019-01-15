<?php
session_start();

$custom_id = $_SESSION['userid'];
include "../db/dbcon.php";

$sql="select * from orders where custom_id='$custom_id'";
$result = mysql_query($sql,$connect);
$total_record = mysql_num_rows($result);

$page=$_GET['page'];
$scale = 10;

//페이지 버튼
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
<link href="/css/mypage.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/side_menu.css" rel="stylesheet">
</head>
<body>
<? include "../lib/top_menu.php";?>
<? include "../lib/mypage_side_menu.php";?>
  <div id="notice_main">
     <div id="notice_main_title">주문내역</div>
    <div class="search_requirement">검색조건</div>
    <div class="requirement">
      <input type="radio" value="1"  name="drone" id="radio" checked>오늘주문 
      <input type="radio"  value="2" name="drone" id="radio">최근1주간 
      <input type="radio" value="3"  name="drone" id="radio">최근한달간 
      <input type="radio" value="4"  name="drone" id="radio">최근1년간 
    </div>
    <div class="search_requirement">기간지정</div>
    <div class="requirement">
      <select id="email_select">
				<option value="0">선택</option>
				<option value="2018"> 2018 </option>
				<option value="2019"> 2019 </option>
			</select>년 
			<select id="email_select">
				<option value="0">선택</option>
				<option value="01"> 01 </option>
				<option value="02"> 02 </option>
				<option value="03"> 03 </option>
				<option value="04"> 04 </option>
				<option value="05"> 05 </option>
				<option value="06"> 06 </option>
				<option value="07"> 07 </option>
				<option value="08"> 08 </option>
				<option value="09"> 09 </option>
				<option value="10"> 10 </option>
				<option value="11"> 11 </option>
				<option value="12"> 12 </option>
			</select>월 
			<select id="email_select">
			  <option value="0">선택</option>
				<option value="01"> 01 </option>
				<option value="02"> 02 </option>
				<option value="03"> 03 </option>
				<option value="04"> 04 </option>
				<option value="05"> 05 </option>
				<option value="06"> 06 </option>
				<option value="07"> 07 </option>
				<option value="08"> 08 </option>
				<option value="09"> 09 </option>
				<option value="10"> 10 </option>
				<option value="11"> 11 </option>
				<option value="12"> 12 </option>
				<option value="13"> 13 </option>
				<option value="14"> 14 </option>
				<option value="15"> 15 </option>
				<option value="16"> 16 </option>
				<option value="17"> 17 </option>
				<option value="18"> 18 </option>
				<option value="19"> 19 </option>
				<option value="20"> 20 </option>
				<option value="21"> 21 </option>
				<option value="22"> 22 </option>
				<option value="23"> 23 </option>
				<option value="24"> 24 </option>
				<option value="25"> 25 </option>
				<option value="26"> 26 </option>
				<option value="27"> 27 </option>
				<option value="28"> 28 </option>
				<option value="29"> 29 </option>
				<option value="30"> 30 </option>
				<option value="31"> 31 </option>
			</select>일 부터 
			<select id="email_select">
				<option value="0">선택</option>
				<option value="2018"> 2018 </option>
				<option value="2019"> 2019 </option>
			</select>년
		<select id="email_select">
				<option value="0">선택</option>
				<option value="01"> 01 </option>
				<option value="02"> 02 </option>
				<option value="03"> 03 </option>
				<option value="04"> 04 </option>
				<option value="05"> 05 </option>
				<option value="06"> 06 </option>
				<option value="07"> 07 </option>
				<option value="08"> 08 </option>
				<option value="09"> 09 </option>
				<option value="10"> 10 </option>
				<option value="11"> 11 </option>
				<option value="12"> 12 </option>
			</select>월 
			<select id="email_select">
				<option value="0">선택</option>
				<option value="01"> 01 </option>
				<option value="02"> 02 </option>
				<option value="03"> 03 </option>
				<option value="04"> 04 </option>
				<option value="05"> 05 </option>
				<option value="06"> 06 </option>
				<option value="07"> 07 </option>
				<option value="08"> 08 </option>
				<option value="09"> 09 </option>
				<option value="10"> 10 </option>
				<option value="11"> 11 </option>
				<option value="12"> 12 </option>
				<option value="13"> 13 </option>
				<option value="14"> 14 </option>
				<option value="15"> 15 </option>
				<option value="16"> 16 </option>
				<option value="17"> 17 </option>
				<option value="18"> 18 </option>
				<option value="19"> 19 </option>
				<option value="20"> 20 </option>
				<option value="21"> 21 </option>
				<option value="22"> 22 </option>
				<option value="23"> 23 </option>
				<option value="24"> 24 </option>
				<option value="25"> 25 </option>
				<option value="26"> 26 </option>
				<option value="27"> 27 </option>
				<option value="28"> 28 </option>
				<option value="29"> 29 </option>
				<option value="30"> 30 </option>
				<option value="31"> 31 </option>								
			</select>일 까지
      <input type="button" style="background-color:white; border:1px solid #a3a3a3; padding:3px;margin-left:12px; color: #717171;" value="찾기">
    </div>
    <table>
      <tr>
        <th id="buy_name">주문일</th>
        <th id="buy_name">주문번호</th>
        <th id="buy_name">수령인</th>
        <th id="buy_book">주문상품</th>
				<th class="notice">취소</th>
      </tr>
	  <?php 
			for ($i=$start; $i<$start+$scale && $i < $total_record; $i++){
				mysql_data_seek($result, $i);
				$row = mysql_fetch_array($result);

				$date=$row['date'];
				$order_id=$row[order_id];
				$ship_name=$row[ship_name];
				$title = $row[title];
				$amount = $row[amount];
			?>
      <tr>
        <td id="buy_name"><?=$date?></td>
        <td id="buy_name"><?=$order_id?></td>
        <td id="buy_name"><?=$ship_name?></td>
        <td id="buy_book"><?=$title?>  포함 총 <?=$amount?>권</td>
				<td class="notice">취소</td>
      </tr>
	  <?php
		$number--;
	  }
		mysql_close();
	  ?>
    </table>
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
			echo "<a href='member_admin.php?page=$i'><button class='page_btn'> $i </button></a>";
		}
	}
	if($total_record)
		echo ("&nbsp;&nbsp;&nbsp;&nbsp;<button class='page_btn'>▶</button></div>");
	echo "</div>";
	?>
  </div><!--notice_main-->

</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>