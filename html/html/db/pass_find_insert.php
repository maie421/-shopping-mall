<?php
session_start();
header('Content-type:text/html; charset=utf-8');

include "dbcon.php";

$name = $_POST['name'];
$custom_id = $_POST['custom_id'];

$sql = "select * from customers where name='$name' and custom_id='$custom_id'";
//echo $sql;
//exit;
$result = mysql_query($sql,$connect);
$row = mysql_fetch_array($result);

$custom_password = $row[custom_password];

echo ("
		<script>
			window.alert('{$custom_password}')
			history.go(-1)
		</script>
	");
?>