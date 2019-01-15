<?php
session_start();
?>
<meta charset="utf-8">
<?php
$name = $_POST['name'];
$number = $_POST['number'];

if(!$name)
{
	echo("
		<script>
			window.alert('주문자명을 입력하세요.')
			history.go(-1)
		</script>
	");
	exit;
}

if(!$number)
{
	echo("
		<script>
			window.alert('주문번호를 입력하세요.')
			history.go(-1)
		</script>
	");
	exit;
}
	
include "dbcon.php";

$sql="select * from orders where customer_name ='{$name}'";
$result=mysql_query($sql,$connect);
$name_match = mysql_num_rows($result);

if(!$name_match)
{
	echo("
		<script>
			window.alert('등록되지 않은 주문자명입니다.')
			history.go(-1)
		</script>
	");
	exit;
}
else
{
	$row=mysql_fetch_array($result);
	$db_pass=$row[order_id];
	//echo $db_pass;
	//exit;

	if($number != $db_pass)
	{
		echo("
			<script>
				window.alert('주문번호가 틀립니다.')
				history.go(-1)
			</script>
		");
		exit;
	}

	else
	{
		$userid=$row[customer_name];

		$_SESSION['userid']=$userid;


		echo("
			<script>
				location.href='/index.php';
			</script>
		");
	}
}
?>
