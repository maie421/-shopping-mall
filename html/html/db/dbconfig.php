<!--<?php
	$db = new mysqli('localhost', 'root', 'test1', 'dawnbookstore');

	if($db->connect_error)
	{
		die('데이터베이스 연결문제 있음');
	}

	$db->set_charset('utf8');
?>-->
<!--db와 컨텍-->
<?php
	$connect=mysql_connect("localhost","dawnbookstore","dawnbookstore18")or
	die("SQL sever에 연결할 수 없습니다.");

	mysql_select_db("dawnbookstore",$connect);
	mysql_query("set names utf8",$connect);
?>