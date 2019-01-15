<?php
	session_start();
	
	include "dbcon.php";

	$mode = $_GET['mode'];
	$num = $_GET['num'];

	if($mode == "notice"){
		$sql = "delete from notice where num = $num";

		mysql_query($sql,$connect);

		mysql_close();

		echo ("
			<script>
				location.href='../notice_admin/notice.php';
			</script>
		");
	}
	if($mode == "fqa"){
		$sql = "delete from fqa where num = $num";

		mysql_query($sql,$connect);

		mysql_close();

		echo ("
			<script>
				location.href='../notice_admin/fqa.php';
			</script>
		");
	}
?>