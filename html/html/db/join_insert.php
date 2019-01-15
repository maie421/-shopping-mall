<?php
	session_start();
	header('Content-type:text/html; charset=utf-8');
	include "dbcon.php";

	$name = $_POST['name'];
	$custom_id = $_POST['custom_id'];
	$custom_password = $_POST['custom_password'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$zipcode = $_POST['zipcode'];
	$tel = $_POST['tel'];
	$phone = $_POST['phone'];
	$email1 = $_POST['email1'];
	$email2 = $_POST['email2'];
	$email = $email1."@".$email2;
	$address = $address1." ".$address2;
	$regist_day = date("Y-m-d (H:i)");
	//$sql="select * form customers where id ='{$custom_id}'"; //왜 썼지?
	//echo $sql;
	//exit;
	//$result=mysql_query($sql,$connect);

	
	$sql="insert into customers(name,custom_id,custom_password,address,zipcode,tel,phone,email,regist_day)";
	$sql.="values('$name','$custom_id','$custom_password','$address','$zipcode','$tel','$phone','$email','$regist_day')";
		//echo $sql;
		//exit;
	mysql_query($sql,$connect);

	mysql_close();
	echo ("
		<script>
			location.href='/index.php';
		</script>
	");
?>