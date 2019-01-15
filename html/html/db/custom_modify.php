<?
	session_start();
	header('Content-type:text/html; charset=utf-8');
	$custom_id = $_SESSION['userid'];
	
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

    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    include "dbcon.php";       // dconn.php 파일을 불러옴

    $sql = "update customers set custom_password='$custom_password', address='$address' , ";
    $sql .= "zipcode='$zipcode', tel='$tel', phone='$phone', email='$email', regist_day='$regist_day' where custom_id='{$custom_id}'";

    mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

    mysql_close();                // DB 연결 끊기
    echo "
	    <script>
	     location.href = '/index.php';
	    </script>
	 ";
?>