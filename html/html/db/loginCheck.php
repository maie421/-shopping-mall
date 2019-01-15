<?php
	session_start();
	header('Content-type:text/html; charset=utf-8');

	$custom_id=$_POST['custom_id'];//다른 페이지에서 변수 전달
	$custom_password=$_POST['custom_password'];

	if(!$custom_id)
	{
		echo("
			<script>
				window.alert('아이디를 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	if(!$custom_password)
	{
		echo("
			<script>
				window.alert('비밀번호를 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	include "../db/dbcon.php";
	
	if($custom_id == "admin"){
		if($custom_password == "1234"){
			echo("
				<script>
					location.href='/admin.php';
				</script>
			");
		}
	}
	$sql="select * from customers where custom_id ='{$custom_id}'";
	$result=mysql_query($sql,$connect);
	$num_match = mysql_num_rows($result);
	
	if(!$num_match)
	{
		echo("
			<script>
				window.alert('등록되지 않은 아이디입니다.')
				history.go(-1)
			</script>
		");
		exit;
	}

	else
	{
		$row=mysql_fetch_array($result);
		$db_pass=$row[custom_password];
		//echo $db_pass;
		//exit;

		if($custom_password != $db_pass)
		{
			echo("
				<script>
					window.alert('비밀번호가 틀립니다.')
					history.go(-1)
				</script>
			");
			exit;
		}

		else
		{
			$userid=$row[custom_id];
			$name=$row[name];
			$access = $row[access]+1;

			$_SESSION['userid']=$userid;
			$_SESSION['name']=$name;

			$sql = "update customers set access='$access' where custom_id='$userid'";
			mysql_query($sql,$connect);

			mysql_close();

			echo("
				<script>
					location.href='/index.php';
				</script>
			");
		}
	}
?>