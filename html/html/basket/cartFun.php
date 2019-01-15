<?php
	function show_cart($cart){
	<table>
		<tr>
			<th class="notice_check"><input type="checkbox" id="check_all"></th>
			<th class="notice_title">상품/옵션 정보</th>
			<th class="notice">수량</th>
			<th class="notice">상품금액</th>
			<th class="notice">할인/적립</th>
			<th class="notice">합계금액</th>
			<th class="notice">배송일정</th>
		</tr>
	</table>
	}
?>
<?php 
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
		
	//echo count($_SESSION['cart']);
	//exit;
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){ 
		//장바구니 버튼을 클릭했을 때 장바구니에 추가된 상품이 있는 경우에는 화면에 상품을 출력
		show_cart($_SESSION['cart']);
	?>	
	<tr>
		  <td class="notice_check"><input type="checkbox"></td>
			<td class="notice_title"><a href="#"><img src="/img/basket/basket.jpg" id="basket_img"></a>
			<div id="basket_img_name"><div id="deduction">소득공제</div><?=$title;?></div></td>
			<td class="notice"><input type="text" name= "refresh" id="basket_input" style="margin-right:5px;" value="1"><button>확인</button></td>
			<td class="notice"><?=number_format($price);?></td>
			<td class="notice"><?=$point;?></td>
			<td class="notice"><?=number_format($price*$qty);?>원</td>
			<td class="notice">03월 12일</td>
	</tr>
  <?php } ?>
  </table>
  <?php
	if(!(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart'])))){
    echo("<div id='NoProduct'>상품이 없습니다.</div>");
	}
  ?>
  <div id="result">
    총 <span id="red_color1"><?=$_SESSION['items'];?></span>개의 상품금액 <b><?=number_format($_SESSION['total_price']);?></b>원 <img src="/img/basket/pluse.JPG" id="result_img"> 배송비 <b>0</b>원 <img src="/img/basket/result.JPG" id="result_img"><span id="red_color1"><?=number_format($_SESSION['total_price']);?>원</span>
	</div>
  