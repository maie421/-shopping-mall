<?php
session_start();

include "html/db/dbcon.php";
$today = date("Y-m-d (H:i)");
$past = date("Y-m-d (00:00)");
$past2 = date("Y-m-d (00:00)",strtotime("-1 week"));
$today2 = date("Y.m.d");
$past3 = date("Y.m.d",strtotime("-1 week"));

$sql = "select * from customers where regist_day<='$today' and regist_day>='$past'"; //오늘을 기준으로 
$result = mysql_query($sql, $connect);
$today_num = mysql_num_rows($result);

$sql2 = "select * from customers where regist_day<='$today' and regist_day>='$past2'";
$result2 = mysql_query($sql2, $connect);
$total_num2 = mysql_num_rows($result2);

$sql3 = "select * from customers";
$result3 = mysql_query($sql3, $connect);
$total_num = mysql_num_rows($result3);

//주문리스트
$sql4 = "select * from orders where date='$today2'";
$result4 = mysql_query($sql4, $connect);

$sql5 = "select * from orders";
$result5 = mysql_query($sql5, $connect);
$total_num3 = mysql_num_rows($result5);

$sql6 = "select * from orders where '$past3'<=date and date<='$today2'";
$result6 = mysql_query($sql6, $connect);
$total_num4 = mysql_num_rows($result6);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="css/admin_side_menu.css" rel="stylesheet">
<link href="css/full.css" rel="stylesheet">
<link href="css/admin_main.css" rel="stylesheet">
</head>
<body>
<? include "html/lib/admin_top_menu.php";?>
<div id="main">
<div id="side_menu">
   <ul id="menu01">
       <li>월별 현황 분석</li>
   </ul>
    <ul class="menu02">
        <li>주문 0</li>
        <li>게시글 0</li>
        <li>회원가입 <?=$total_num; ?></li>
        <li>매출액 0</li>
    </ul>
</div><!--side_menu-->
<div id="notice_main">
	<div id="title_box">오늘의 주문 리스트<span id="more">week <?=$total_num4?> / total <?=$total_num3?> &nbsp;&nbsp;<a href="html/delivery/delivery.php" style="color:#7c7c7c;text-decoration:none;">더보기</a></span></div>
    <div id="table_box">
      <table>
      <tr>
        <th id="notice">주문번호</th>
        <th id="notice">주문자</th>
        <th id="notice">전화번호</th>
        <th id="notice">결제방법</th>
        <th id="notice">결제금액</th>
        <th id="notice">결제상태</th>
        <th id="notice">주문날짜</th>
      </tr>
	  <?php
			for($i=0; $row2=mysql_fetch_array($result4); $i++){
			$order_id1 = $row2[order_id];
					$customer_name = $row2[customer_name];
					$custom_phone = $row2[custom_phone];
					$total_price = $row2[total_price];
					$date = $row2['date'];
		?>
      <tr>
        <td id="notice"><?=$order_id1?></th>
        <td id="notice"><?=$customer_name?></td>
        <td id="notice"><?=$custom_phone?></th>
        <td id="notice">무통장 입금</th>
        <td id="notice"><?=$total_price?></th>
        <td id="notice">배송준비중</th>
        <td id="notice"><?=$date?></th>
      </tr>
	  <?}?>
      </table>
      </div>
      <div id="title_box">신규회원가입리스트<span id="more">week <?=$total_num2; ?> / total <?=$total_num; ?> &nbsp;&nbsp;<a href="html/member_admin/member_admin.php"  style="color:#7c7c7c;text-decoration:none;">더보기</a></span></div>
      <div id="table_box">
      <table>
      <tr>
        <th id="new_notice">아이디</th>
        <th id="new_notice">등급</th>
        <th id="new_notice">이름</th>
        <th id="notice_title">이메일</th>
        <th id="new_notice">포인트</th>
        <th id="new_notice">접속횟수</th>
        <th id="new_notice">가입날짜</th>
      </tr>
			<?php
				for($i;$row = mysql_fetch_array($result2);$i++){
					$custom_id = $row[custom_id];
					//$custom_id = $row[]; //등급
					$name = $row[name];
					$email = $row[email];
					//$custom_id = $row[]; //포인트
					//$custom_id = $row[]; //접속횟수
					$regist_day = $row[regist_day];
					$access = $row[access];
			?>
      <tr>
        <td id="new_notice"><?=$custom_id; ?></th>
        <td id="new_notice">gold</td>
        <td id="new_notice"><?=$name; ?></th>
        <td id="notice_title"><?=$email; ?></th>
        <td id="new_notice">100</th>
        <td id="new_notice"><?=$access; ?></th>
        <td id="new_notice"><?=$regist_day; ?></th>
      </tr>
			<?php } ?>
      </table>
  </div>
</div>
</div><!--main-->
<? include "html/lib/footer.php";?>
</body>
</html>