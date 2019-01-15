<?php
session_start();
include "../db/dbcon.php";

	if(isset($_GET['new'])){
		$new = $_GET['new'];
	
		//추가할 상품이 있는 경우(상품 세부페이지에서 장바구니 버튼을 클릭했을 때)
		if($new){
			if(!isset($_SESSION['cart'])){//등록된 세션 변수가 없으면 세션변수를 등록
				$_SESSION['cart']=array();
			
				//상품갯수
				$_SESSION['items']=0;
				$_SESSION['total_price']=0;
			}
			//장바구니에 똑같은 상품이 있는 경우
			if(isset($SESSION['cart'][$new])){ //isbn을 식별자로 new변수에 들어감
				$_SESSION['cart'][$new]++;
			}
			else{ //장바구니에 새로운 상품을 추가하는 경우
				$_SESSION['cart'][$new]=1;
			}
		

			//전체 상품 수량 합계 구하기
			if(is_array($_SESSION['cart'])){
				$_SESSION['items']=0;
				foreach($_SESSION['cart'] as $isbn=>$qty){
					$_SESSION['items']+=$qty;
				}
			}//if문 끝


			//장바구니 총 합계 구하기
			if(is_array($_SESSION['cart'])){
				$_SESSION['total_price']=0;
				foreach($_SESSION['cart'] as $isbn=>$qty){
					$sql="select * from price from books where isbn='".$isbn."'";
					$result=mysql_query($sql,$connect);
					if($result){
						$item=mysql_fetch_object($result);
						$item_price=price($item);
						$_SESSION['total_price']+=$item_price*$qty;
					}
				}//foreach문 끝
			}//if문 끝
		}//if(new)문 끝
	}//if(isset($_GET['new']))문 끝

//------------------------------------------------------------------------------
//현재 장바구니 페이지에서 refresh 버튼을 클릭했을 때 새 수량 및 총 합계를 재계산
	if(isset($_POST['refresh'])){
		foreach($_SESSION['cart'] as $isbn=>$qty){
			if($_POST[$isbn]=='0'){//수량을 0으로 했을때 상품삭제
				unset($_SESSION['cart'][$isbn]);
			}
			else{
				$_SESSION['cart'][$isbn]=$_POST[$isbn];
			}
		}//foreach문 끝


	//총 합계 재계산
	if(is_array($_SESSION['cart'])){
		$_SESSION['total_price']=0;
			foreach($_SESSION['cart'] as $isbn=>$qty){
				$sql="select * from price from books where isbn='".$isbn."'";
				$result=mysql_query($sql,$connect);
				if($result){
					$item=mysql_fetch_object($result);
					$item_price=price($item);
					$_SESSION['total_price']+=$item_price*$qty;
			}
		}//foreach문 끝
	}//총 합계 재계산 끝------------------------------------------------------------

	//총 수량 재계산
	if(is_array($_SESSION['cart'])){
		$_SESSION['items']=0;
			foreach($SESSION['cart'] as $isbn=>$qty){
				$_SESSION['items']+=$qty;
			}
	}//총 수량 재계산 끝------------------------------------------------------------
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>새벽서점</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script>
    $(function(){
        //전체선택 체크박스 클릭
        $("#check_all").click(function(){
            //전체선택 체크박스가 체크된상태일경우
            if($("#check_all").prop("checked")) {
                //input type 이 checkbox인 경우 전부 선택
                $("input[type=checkbox]").prop("checked",true);
            } else {
                //input type 이 checkbox인 경우 전부 해제
                $("input[type=checkbox]").prop("checked",false);
            }
        })
    })
    </script>
		    <link href="/css/full.css" rel="stylesheet">
        <link href="/css/basket.css" rel="stylesheet">
    </head>
<body>
   <? include "../lib/top_menu.php";?>
<div id="main">
  <div id="join_top">
		<div id="join_title">
			장바구니
		</div>  
    <!--<?php session_unset(); // 세션삭제 수정 필요함...?>-->
    <!--상품 출력폼-->
		<span id="join_left"><span id="red_color1">01장바구니 > </span>02주문서작성/결제 > 03주문완료</span>
	</div>
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
<?php 

	//장바구니 버튼을 클릭했을 때 장바구니에 추가된 상품이 있는 경우에는 화면에 상품을 출력
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){ 
	/*	
		//cart변수의 배열개수만큼 for문을 계속 돌려야 함 
		foreach($_SESSION['cart'] as $isbn=>$qty){
			if((!$isbn)||($isbn=='')){
				echo"<script>
					alert('상품번호가 존재하지 않습니다.');
					history.back();
					</script>";
				exit;
			}
			$sql="select * from books where isbn='".$isbn."'";
			$result=mysql_query($sql,$connect);
			if($result){
				$row=mysql_fetch_array($result);
				
				$image_name = $row[file_name_0];
				$image_copied = $row[file_copied_0];
				$img_name = $image_copied;
				$img_name = "../data/".$img_name;

				$title = $row[title];
				$subtitle = $row[subtitle];
				$price = $row[price];
				$point = $row[point];
			}
		}*/
?>
    <tr>
	  <div id="basket_img_name">
		    <td class="notice_check"><input type="checkbox"></td>
			<td class="notice_title"><a href="#"><img src="/img/basket/basket.jpg" id="basket_img"></a>
			<div id="basket_img_name"><div id="deduction">소득공제</div><?=$title;?></div></td>
			<td class="notice"><input type="text" name= "refresh" id="basket_input" style="margin-right:5px;" value="1"><button>확인</button></td>
			<td class="notice"><?=number_format($price);?></td>
			<td class="notice"><?=$point;?></td>
			<td class="notice"><?=number_format($price*$qty);?>원</td>
			<td class="notice">03월 12일</td>
    </tr>
  </table>
  <div id="result">
    총 <span id="red_color1"><?=$_SESSION['items'];?></span>개의 상품금액 <b><?=number_format($_SESSION['total_price']);?></b>원 <img src="/img/basket/pluse.JPG" id="result_img"> 배송비 <b>0</b>원 <img src="/img/basket/result.JPG" id="result_img"><span id="red_color1"><?=number_format($_SESSION['total_price']);?>원</span>
	</div>
  <?php 
	}
	//else{
	//	echo"<b>! 장바구니에 담긴 상품이 없습니다 !</b>";
	}
	?>
  <div id="basket_delete">
  선택 상품 삭제
  </div>
  <div id="basket_buy">
    <a href="ord.php">
    <div id="basket_select_buy">
      선택 상품 주문
    </div>
		</a>
			<?php/*
				if(!$userid)
				echo "<a href='../login/no_id.php'>";
				else
				echo "<a href='ord.php'>";*/
			?>
    <div id="basket_full_buy">
      전체 상품 주문
    </div>
    <div id="red_color">※ 주문서 작성단계에서 할인 및 적립금 적용을 하실 수 있습니다</div>
  </div>
</div>
    <? include "../lib/footer.php";?>
</body>
</html> 