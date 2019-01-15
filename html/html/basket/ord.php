<?php
session_start();
header('Content-type:text/html; charset=utf-8');

$custom_id = $_SESSION['userid'];
include "../db/dbcon.php";

$sql="select * from customers where custom_id='{$custom_id}'";
$result = mysql_query($sql,$connect);
$row = mysql_fetch_array($result);

$name = $row[name];
$phone = $row[phone];
$email = $row[email];
$zipcode = $row[zipcode];
$address = explode(" ", $row[address]);
$address1 = $address[0];
$address2 = $address[1];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>새벽서점</title>
		<link href="/css/full.css" rel="stylesheet">
		<link href="/css/basket.css" rel="stylesheet">
		<link href="/css/ord.css" rel="stylesheet">
    <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script src="../join/daum.js"></script>
</head>
<body>
   <? include "../lib/top_menu.php";?>
<div id="main">
  <div id="join_main_top_basket">
		<div id="ord_title">
			주문상품확인
		</div>
		<span id="join_left">01 장바구니 > <span id="red_color1">02 주문서작성/결제 > </span>03 주문완료</span>
	</div>
    <table>
    <tr>
      <th class="notice_title">상품/옵션 정보</th>
      <th class="notice">수량</th>
      <th class="notice">상품금액</th>
      <th class="notice">할인/적립</th>
      <th class="notice">합계금액</th>
      <th class="notice">배송일정</th>
    </tr>
<?php
if(isset($_SESSION['cart']) && array_count_values($_SESSION['cart'])){
	foreach($_SESSION['cart'] as $isbn => $qty){
		$sql2="select * from books where isbn=$isbn";
		$result2=mysql_query($sql2,$connect);
			if($result2){
				$row=mysql_fetch_array($result2);
				
				$image_name = $row[file_name_0];
				$image_copied = $row[file_copied_0];
				$img_name = $image_copied;
				$img_name = "../data/".$img_name;

				$title = $row[title];
				$subtitle = $row[subtitle];
				$price = $row[price];
				$point = $row[point];
			}
			?>

    <tr>
      <td class="notice_title"><a href="sub06.php?isbn=<?=$isbn;?>"><img src="<?=$img_name; ?>" id="basket_img"></a><div id="basket_img_name"><div id="deduction">소득공제</div>
<?=$title;?></div></td>
      <td class="notice"><?=$_SESSION['cart'][$isbn];?></td>
      <td class="notice"><?=number_format($price);?></td>
      <td class="notice"><?=number_format($point*$qty);?></td>
      <td class="notice"><?=number_format($price*$qty);?>원</td>
      <td class="notice"><?=date("m월 d일",strtotime("+1 day"));?></td>
    </tr>
  
  <?php
	}
}?>         
</table>
<?php
if($_SESSION['items']==0){
    echo("<div id='NoProduct'>주문하실 상품이 없습니다.</div>");
}
?>
<form method="post" action="../db/ord_insert.php">
	<!-구매정보-->
	<div id="OrdBox">
	<div id="join_top_basket">
		<div id="ord_title">
			구매자정보
		</div>
	</div>
  <div id="join_box">
		<div id="join_box_mini">
			이름
		</div>
		<div id="join_box_mini">
			<input type="text" id="join_input" name="name" value="<?=$name?>">
		</div>
	</div>
	<div id="join_box">
		<div id="join_box_mini">
			연락처
		</div>
		<div id="join_box_mini">
			<input type="text" id="join_input" placeholder="-없이 입력해 주세요" name="phone_number" value="<?=$phone?>">
		</div>
	</div>
  <div id="join_box">
		<div id="join_box_mini">
			이메일
		</div>
		<div id="join_box_mini">
			<input type="text" id="join_input" name="email" value="<?=$email?>">
		</div>
	</div>
	<div id="join_box">
		<div id="join_box_mini">
			주문비밀번호
		</div>
		<div id="join_box_mini">
			<input type="password" id="join_input" name="custome_password">
		</div>
	</div>
	</div>
	<div id="OrdBox">
	<div id="join_top_basket">
		<div id="ord_title">
			배송지 정보 지정
		</div>
	</div>
	<div id="join_box">
		<div id="join_box_mini">
			이름
		</div>
		<div id="join_box_mini">
			<input type="text" id="join_input" name="ship_name" value="<?=$name?>">
		</div>
	</div>
	<div id="join_box">
		<div id="join_box_mini">
			연락처
		</div>
		<div id="join_box_mini">
			<input type="text" id="join_input" placeholder="-없이 입력해 주세요" name="ship_number" value="<?=$phone?>">
		</div>
	</div>
	<div id="join_box">
  <div id="join_box_mini">
			주소
	</div>
	<div id="ord_box_mini">
			<input type="text" id="address" name="zipcode" placeholder="우편번호" value="<?=$zipcode?>">
      &nbsp;<input type="button" id="address_button" value="우편번호 검색" onclick="sample4_execDaumPostcode()" name="ship_address1"><br><br>
      <input type="text" id="address_input" name="ship_address2"  id="sample4_roadAddress" placeholder="도로명주소" value="<?=$address1?>">
      <input type="text" id="address_input" name="ship_address3"  id="sample6_address2"  placeholder="상세주소" value="<?=$address2?>">
	</div>
	</div>
	</div>
  <div id="result">
    총 <span id="red_color1"><?=$_SESSION['items'];?></span>개의 상품금액 <b><?=number_format($_SESSION['total_price']);?></b>원 <img src="/img/basket/pluse.JPG" id="result_img"> 배송비 <b>0</b>원 <img src="/img/basket/result.JPG" id="result_img"><span id="red_color1"><?=number_format($_SESSION['total_price']);?>원</span>
  </div>
  <div id="basket_buy">
    <button type="submit" id="basket_select_buy">
      결제하기
    </button>
		<a href="basket.php">
    <div id="basket_full_buy">
      이전페이지
    </div>
		</a>
  </div> 
  </form>
</div>
    <? include "../lib/footer.php";?>
	</body>
</html>