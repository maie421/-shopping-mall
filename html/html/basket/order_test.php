<?php
session_start();
header('Content-type:text/html; charset=utf-8');
include "../db/dbcon.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>새벽서점</title>
		<link href="/css/full.css" rel="stylesheet">
		<link href="/css/basket.css" rel="stylesheet">
		<link href="/css/ord.css" rel="stylesheet">
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
	
			echo print_r($_SESSION['cart']);
			?>

    <tr>
      <td class="notice_title"><a href="sub06.php?isbn=<?=$isbn;?>"><img src="<?=$img_name; ?>" id="basket_img"></a><div id="basket_img_name"><div id="deduction">소득공제</div>
<?=$title;?></div></td>
      <td class="notice">1</td>
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
			<input type="text" id="join_input" name="name">
		</div>
	</div>
	<div id="join_box">
		<div id="join_box_mini">
			연락처
		</div>
		<div id="join_box_mini">
			<input type="text" id="join_input" placeholder="-없이 입력해 주세요" name="custom_password">
		</div>
	</div>
  <div id="join_box">
		<div id="join_box_mini">
			이메일
		</div>
		<div id="join_box_mini">
			<input type="text" id="join_input" name="name">
		</div>
	</div>
	<div id="join_box">
		<div id="join_box_mini">
			주문비밀번호
		</div>
		<div id="join_box_mini">
			<input type="password" id="join_input" name="name">
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
			<input type="text" id="join_input" name="name">
		</div>
	</div>
	<div id="join_box">
		<div id="join_box_mini">
			연락처
		</div>
		<div id="join_box_mini">
			<input type="text" id="join_input" placeholder="-없이 입력해 주세요" name="custom_password">
		</div>
	</div>
	<div id="join_box">
  <div id="join_box_mini">
			주소
	</div>
	<div id="ord_box_mini">
			<input type="text" id="address" > &nbsp;<input type="button" id="address_button" value="우편번호 검색"><br><br>
      <input type="text" id="address_input">
      <input type="text" id="address_input">
	</div>
	</div>
	</div>
  <div id="result">
    총 <span id="red_color1"><?=$_SESSION['items'];?></span>개의 상품금액 <b><?=number_format($_SESSION['total_price']);?></b>원 <img src="/img/basket/pluse.JPG" id="result_img"> 배송비 <b>0</b>원 <img src="/img/basket/result.JPG" id="result_img"><span id="red_color1"><?=number_format($_SESSION['total_price']);?>원</span>
  </div>
  <div id="basket_buy">
    <div id="basket_select_buy">
      결제하기
    </div>
		<a href="basket.php">
    <div id="basket_full_buy">
      이전페이지
    </div>
		</a>
  </div>                     
</div>
    <? include "../lib/footer.php";?>
	</body>
</html>