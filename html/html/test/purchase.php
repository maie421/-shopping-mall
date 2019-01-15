<?php
header('Content-type:text/html; charset=utf-8');
include "../db/dbcon.php";
session_start();

echo"<h3>결제페이지</h3>";

//주문정보 받아오기 --주문정보 수정 해야 함 
$name=$_POST['name'];
$zipcode=$_POST['zipcode'];
$address=$_POST['address'];

//주문자 정보가 입력되었는지 확인하고 주문정보를 데이터베이스에 입력처리
if($_SESSION['cart'] && $name && $zipcode && $address){
	extract($_POST); //배열의 식별자(키) 값을 변수로 만들어 줌 

	//수령인 정보가 있는지 체크 후 DB oreders 테이블에 저장 
	if(empty($ship_name)&&empty($ship_zipcode)&&empty($ship_address)){
	//비어 있으면 주문자 정보와 수령자 정보가 같다는 의미
	$ship_name=$name;
	$ship_zipcode=$zipcode;
	$ship_address=$address;
	}

	//$db=db_conn();
	//=========================================
	//트랙잭션 시작 처리(주문사항을 데이터베이스에 입력하기 위한 트랙잭션)
	//=========================================
	$db->autocommit(FALSE);

	//customers 테이블에 custom_id가 없으면(=회원이 아니면)주문자정보를 입력
	$sql="select custom_id from customers where name='".$name."' and address='".$address."' and zipcode='".$zipcode."'";
	$result = mysql_query($sql,$connect);


	//테이블에 주문자정보가 있는 경우, custom_id를 얻어 옴
	if($result->num_rows>0){
		$customer=mysql_fetch_object($result);
		$custom_id = $customer->custom_id;
	} 
	//테이블에 주문자정보가 없는 경우, 주문자 정보를 입력 함
	else{
		$sql="insert into customers values('', '".$name."','".$address."','".$zipcode."')";
		$result = mysql_query($sql,$connect);

		if(!$result){
?>
	<script>
		alert("오류가 발생했습니다. 확인해 주세요.");
		history.back();
	</script>
<?php
	exit;
		}
		//입력된 주문자 정보의 custom_id를 얻어 옴
		$custom_id=$db->insert_id;
	}
	$date=date("Y-m-d"); //주문 날짜

	//orders 테이블에 저장
	//!!DB위치에 맞춰서 변경해야 함
	$sql="insert into orders values('','".$custom_id."','".$_SESSION['total_price']."','".$date."','주문','".$ship_name."','".$ship_address."','".$ship_zipcode."')";

	//$result=$db->query($sql);
	$result = mysql_query($sql,$connect);
	if(!$result){
	?>
	<script>
		alert("데이터베이스 오류 발생");
		history.back();
	</script>
	<?php
		exit;
	}
	//order_id값을 얻어 옴
	$sql="select order_id from orders where custom_id='".$custom_id."'and amount=".$_SESSION['total_price']." and date='".$date."' and order_status='주문'and ship_name='".$ship_name."' and ship_address='".$ship_address."' and ship_zipcode='".$ship_zipcode."'"; 

	//$result=$db->query($sql);
	$result = mysql_query($sql,$connect);

	if($result->num_rows>0){
		$obj=mysql_fetch_object($result);
		$order_id=$obj->order_id;
	}
	else{
	?>
	<script>
		alert("주문한 상품내역이 존재하지 않습니다.");
		history.back();
	</script>
	<?php
	exit;
	}
	//주문한 상품들을 order_items테이블에 저장
	foreach($_SESSION['cart'] as $isbn=>$qty){
		//books테이블에서 주문된 책외 정보를 가져옴
		if(isset($isbn)){
			//$db=db_conn(); 디비접속
			
			$sql="delete from order_items where order_id='".$order_id."' and isbn='".$isbn."'";
			$result = mysql_query($sql,$connect);

			
			$sql="select * from books where isbn='".$isbn."'";
			$result = mysql_query($sql,$connect);
			if(!$result){
				?>
				<script>
					alert("데이터베이스 오류 발생");
					history.back();
				</script>
				<?php
				exit;
			}
			$row=mysql_fetch_array($result);
		}

		$sql="insert into order_items values('".$order_id."','".$isbn."',".$row['price'].",$qty)";
		$result = mysql_query($sql,$connect);
		if(!$result){
			?>
			<script>
				alert("데이터베이스 입력오류");
				history.back();	
			</script>
			<?php
			exit;
		}
	}//갯수만큼 저장

	$db->commit();
	$db->autocommit(TRUE);
	//=========================================
	//트랙잭션 끝(주문사항 데이터베이스에 입력처리 완료)
	//=========================================
show_cart($_SESSION['cart'], FALSE); //장바구니에 담은 내용 출력
/* <?php
    function show_cart($cart, $modify= true){
        
        echo "<table border='0' width='100%' cellspacing='0'>"
                ."<form action ='show_cart.php' method='post'>"
                . "<tr><th colspan='2' bgcolor='#F1C40F'>주문하실 상품명</th>"
                        . "<th bgcolor='#F1C40F'>가격</th>"
                        . "<th bgcolor='#F1C40F'>수량</th>"
                        . "<th bgcolor='#F1C40F'>합계</th>"
                . "</tr>";
     foreach($cart as $isbn =>$qty){
         if((!$isbn) || ($isbn=='')){
             ?>
<script>
    alert("상품 번호가 존재하지 않습니다..");
    history.back();
</script>
            <?php
            exit;
         }
         $sql = "select * from books where isbn ='".$isbn."'";
         $db = db_conn();
         $result = $db->query($sql);
         if($result){
             $row = $result->fetch_array();
         }
         echo "<tr>";
         echo "<td align='left'>";
         
         //이미지를 불러오기 위한 처리
         if(file_exists("img/".$isbn.".png")){
             $size = getimagesize('img/'.$isbn.'.png');
             echo "<img src='img/".$isbn.".png' style='border: 1px solid black' width='".($size[0]/3)."' height='".($size[1]/3)."'/>";
         }else{
             echo "$nbsp;";
         }
         echo "</td>";
         
         //상품명(책제목, 저자) 불러오기
         echo "<td align='left'>"
                    . "<a href='show_book.php?isbn=".$isbn."'>".$row['title']."</a>"
                    . " 저자 : ".$row['author']."</td>"
                    . "<td align='center'>".number_format($row['price'])." 원 </td>"
                    . "<td align='center'>";
         if($modify == true){ 
                echo "<input type='text' name='".$isbn."' value='".$qty."' size='3'>";
         }else{
                echo $qty;
         }
         
         echo "</td><td align='center'>".number_format($row['price']*$qty)." 원</td></tr>\n";
     } // End of foreach문--------------------      
     // 총 합계
     echo "<tr>"
             . "<td colspan='2' bgcolor='#F1C40F'>&nbsp;</td>"
             . "<td align='center' bgcolor='#F1C40F'>&nbsp;</td>"
             . "<td align='center' bgcolor='#F1C40F'>".$_SESSION['items']."개</td>"
             . "<td align='center' bgcolor='#F1C40F'>총합계 : ".number_format($_SESSION['total_price'])." 원</td></tr>";
     // 수량 수정 후 수정된 내용을 저장하기 위한 새로 고침 버튼 추가
    if($modify == true){
        echo "<tr>"
                       . "<td colspan='5' align='right'>"
                       . "<input type='hidden' name='refresh' value='true'/>"             
                       . "<input type='submit' value='새로고침'/>"
                       . "</td>"
                . "</tr>";
    }
     echo "</form></table><hr/>";
    }
?>
*/
$shipping=2700;
echo "<table border='0' width='100%' cellspacing='0'>"
."<tr><td colspan='4' align='right'>배송비: </td>"
."<td align='right'>".number_format($shipping)."</td></tr>"
."<tr><td colspan='4' align='right'>전체 총합계:</td>"
."<td align='right'>".number_format($shipping+$_SESSION['total_price'])."원</td></tr>"."</table><br/>";
?>

	<!--결제사항 정보 출력-->
	<table border='0' width='100%' cellspacing='0'>
		<form>
			<tr>
				<th colspan="2">신용카드 결제 정보</th>
			</tr>
			<tr>
				<td>신용카드사: </td>
				<td><select name="card_type">
					<option value="BC">비씨카드</option>
					<option value="SAMSUNG">삼성카드</option>
					<option value="LOTTE">롯데카드</option>
					<option value="KB">국민카드</option>
				</select></td>
			</tr>
			<tr>
				<td>카드번호: </td>
				<td><input type="text" name="card_number" value="" maxlength="16" size="16"></td>
			</tr>
			<tr>
				<td>카드 만료일: </td>
				<td>month: <select name="card_month">
					<option value="01">01</option>
					<option value="01">02</option>
					<option value="01">03</option>
					<option value="01">04</option>
					<option value="01">05</option>
					<option value="01">06</option>
					<option value="01">07</option>
					<option value="01">08</option>
					<option value="01">09</option>
					<option value="01">10</option>
					<option value="01">11</option>
					<option value="01">12</option>
					</select>
					년도: <select name="card_year">
					<?php
						for($y=date("Y"); $y <date("Y")+10; $y++){
						echo"<option value='".$y."'>".$y."</option>";	
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>이름: </td>
				<td><input type="text" name="card_name" value="<?echo $name;?>"maxlength="40" size="40"></td>
			</tr>

		</form>
	</table>
<?php
echo"<div align='center'>
		<a href='basket.php'><img></a>
	</div>";
}
else{
	echo"<b>주문정보가 입력되지 않았습니다. 주문사항을 다시 확인 해주세요.</b>";
	echo"<a href='ord.php'>뒤로가기</a>";
}

	

?>
