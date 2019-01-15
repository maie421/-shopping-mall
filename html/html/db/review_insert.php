<?php
session_start();

$userid = $_SESSION['userid'];
$content = $_POST['content'];
$score = $_POST['score'];
$isbn = $_GET['isbn'];
?>
<meta charset="utf-8">
<?php

	if(!$userid)
	{
		echo ("
			<script>
				window.alert('로그인 후 이용해 주세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	if(!$content)
	{
		echo ("
			<script>
				window.alert('내용을 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	$regist_day = date("Y-m-d H:i:s");

	include "dbcon.php";

	$sql = "insert into review (id,regist_day,score,content,isbn)";
	$sql.= "values('$userid','$regist_day','$score','$content','$isbn')";
	mysql_query($sql,$connect);

	mysql_close();

	echo ("
		<script>
			location.href='../side/sub06.php?isbn=$isbn#member_review';
		</script>
	");
?>