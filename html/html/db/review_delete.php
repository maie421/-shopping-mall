<?php
	$num=$_GET['num'];
	$isbn = $_GET['isbn'];

	include "dbcon.php";

	$sql = "delete from review where num = $num";

	mysql_query($sql,$connect);

	mysql_close();

	echo ("
		<script>
			location.href='../side/sub06.php?isbn=$isbn#member_review';
		</script>
	");
?>