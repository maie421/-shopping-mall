<?php
session_start();
header('Content-type:text/html; charset=utf-8');

include "dbcon.php";

$custom_id = $_SESSION['userid'];
$sql = "delete from customers where custom_id='$custom_id'";
mysql_query($sql,$connect);

mysql_close();

unset($_SESSION['userid']);

echo("
		<script>
			location.href='/index.php';
		</script>
	");

?>