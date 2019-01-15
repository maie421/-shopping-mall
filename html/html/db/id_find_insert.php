<?php
session_start();
header('Content-type:text/html; charset=utf-8');

include "dbcon.php";

$name = $_POST['name'];
$email = $_POST['email'];

$sql = "select * from customers where name='$name' and email='$email'";
//echo $sql;
//exit;
$result = mysql_query($sql,$connect);
$row = mysql_fetch_array($result);

$custom_id = $row[custom_id];

echo ("
		<script>
			window.alert('{$custom_id}')
			history.go(-1)
		</script>
	");
?>