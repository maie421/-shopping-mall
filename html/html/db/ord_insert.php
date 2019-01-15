<?php
	session_start();
	header('Content-type:text/html; charset=utf-8');
	include "dbcon.php";

	$custom_id = $_SESSION['userid'];
	$name = $_POST['name'];
	$phone_number = $_POST['phone_number'];
	$email = $_POST['email'];
	$custom_password = $_POST['custom_password'];
	$ship_name = $_POST['ship_name'];
	$ship_number = $_POST['ship_number'];
	$address1 = $_POST['ship_address1'];
	$address2 = $_POST['ship_address2'];
	$address3 = $_POST['ship_address3'];
	
	$address = $address1." ".$address2." ".$address3;
	$order_id = date("YmdHis");
	$date=date("Y.m.d");
	$amount = $_SESSION['items'];
	$price = $_SESSION['total_price'];
	//$sql="select * form customers where id ='{$custom_id}'"; //왜 썼지?
	//echo $sql;
	//exit;
	//$result=mysql_query($sql,$connect);
	foreach($_SESSION['cart'] as $isbn => $qty){
		$sql2="select * from books where isbn=$isbn";
		$result2=mysql_query($sql2,$connect);
		$row = mysql_fetch_array($result2);
		$title = $row[title];
	}
	
	$sql="insert into orders(order_id,custom_id, custom_phone, email, amount, date, customer_name, ship_name, ship_address, ship_number,total_price,title)";
	$sql.="values('$order_id','$custom_id', '$phone_number','$email','$amount', '$date', '$name', '$ship_name', '$address', '$ship_number','$price','$title')";
		//echo $sql;
		//exit;
	mysql_query($sql,$connect);

	mysql_close();
	unset($_SESSION['cart']);
	unset($_SESSION['total_price']);
	unset($_SESSION['items']);
	echo ("
		<script>
      window.alert('주문번호:{$order_id}')
			location.href='/index.php';
		</script>
	");
?>