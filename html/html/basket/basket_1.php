<?php
header('Content-type:text/html; charset=utf-8');
session_start();
$id=$_SESSION['userid'];
include "../db/dbcon.php";
$new = $_GET['new'];
//장바구니 총합계 구하는 함수
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
		<span id="join_left"><span id="red_color1">01 장바구니 > </span>02 주문서작성/결제 > 03 주문완료</span>
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
  function sum_price($cart){
    $price = 0;
	include "../db/dbcon.php";
    if(is_array($cart)){
        foreach($cart as $isbn =>$qty){
            $sql = "select price from books where isbn='$new'";
			$result = mysql_query($sql,$connect);
            if($result){
                $item=mysql_fetch_object($result);
				$item_price=$item->price;
                $price +=$item_price*$qty;
            }
        }
    }
    return $price;
}
//DB에서 불러와서 배열로 넣기
      $sql2="select * from books where isbn='$new'";
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
      ////// 아이디 상품번호 날짜 넣을꺼 id기준으로 총 갯수 불러 올꺼 //사실 어떻게 출력하는거 돌려야 할지 모르겠음///////
      $sql3="insert into basket_1(id,item_name,day)";
      $sql3.="values ('$id','$new','123')";
      mysql_query($sql3,$connect);
//장바구니 총수량을 구하는 함수
function sum_items($cart){
    $items = 0;
    if(is_array($cart)){
        foreach($cart as $isbn =>$qty){
            $items +=is_array($cart)/9;
        }
    }
    return $items;
}

// -----------------------------------------------------------------------------------------
//추가할 상품이 있는 경우(장바구니 버튼을 클릭했을 때) // 출력 폼 추가
// -----------------------------------------------------------------------------------------
if(isset($_GET['new'])){ 
    if($new){
        if(!isset($_SESSION['cart'])){
            //등록된 세션 변수가 없으면 세션변수를 등록
            $_SESSION['cart'] = array($image_name,$image_copied,$img_name,$title,$subtitle,$subtitle,$price,$point); //상품갯수
            $_SESSION['items'] = 0;
            $_SESSION['total_price']=0;
           
        }
        
        //장바구니에 똑같은 상품이 있는 경우
        if(isset($_SESSION['cart'][$new])){
            $_SESSION['cart'][$new]++;
        }else{ //장바구니에 새롭게 추가된 상품인 경우
            $_SESSION['cart'][$new] = 1;
        }
        
        //전체 상품 수량 합계 구하기
        $_SESSION['items'] = sum_items($_SESSION['cart']);

        // 장바구니 총합계 구하기        
        $_SESSION['total_price'] = sum_price($_SESSION['cart']);
        
    } // End if($new){

}//End if(isset($_GET['new'])){ 

// -----------------------------------------------------------------------------------------
//  현재 장바구니 페이지에서 refresh 버튼을 클릭했을 때 수량 및 총합계를 재계산
// -----------------------------------------------------------------------------------------
if(isset($_POST['refresh'])){
    foreach($_SESSION['cart'] as $isbn => $qty){
        if($_POST[$isbn] =='0'){
            unset($_SESSION['cart'][$isbn]);
        }else{
            $_SESSION['cart'][$isbn] = $_POST[$isbn];
        }
    } // End of foreach문    
    
    // 총수량 재계산-----------------------   
      $_SESSION['items'] = sum_items($_SESSION['cart']);
    // 총합계 재계산-----------------------
     $_SESSION['total_price'] = sum_price($_SESSION['cart']); 
}
	//exit;
	//if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
    for($j=0;$j<3;$j++){//임의로 한거 DB아이디 기준으로 총 갯수 받고 돌려야함
	?>	
	<tr>
		  <td class="notice_check"><input type="checkbox"></td>
			<td class="notice_title"><a href="#"><img src="<?=$_SESSION['cart'][2];?>" id="basket_img"></a>
			<div id="basket_img_name"><div id="deduction">소득공제</div><?=$_SESSION['cart'][3];?></div></td>
			<td class="notice"><input type="text" name= "refresh" id="basket_input" style="margin-right:5px;" value="<?=$_SESSION['cart'][$new];?>"><button>확인</button></td>
			<td class="notice"><?=number_format($price);?></td>
			<td class="notice"><?=$_SESSION['cart'][7];?></td>
			<td class="notice"><?=number_format($price*$qty);?>원</td>
			<td class="notice">03월 12일</td>
	</tr>
  <?php } ?>
  </table>
  <?php
	if($_SESSION['items']==0){
    echo("<div id='NoProduct'>상품이 없습니다.</div>");
	}
  ?>
  <div id="result">
    총 <span id="red_color1"><?=$_SESSION['items'];?></span>개의 상품금액 <b><?=number_format($_SESSION['total_price']);?></b>원 <img src="/img/basket/pluse.JPG" id="result_img"> 배송비 <b>0</b>원 <img src="/img/basket/result.JPG" id="result_img"><span id="red_color1"><?=number_format($_SESSION['total_price']);?>원</span>
	</div>
  
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