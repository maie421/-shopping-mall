<?php
	$connect=mysql_connect("localhost","dawnbookstore","dawnbookstore18")or
	die("SQL sever에 연결할 수 없습니다.");

	mysql_select_db("dawnbookstore",$connect);
	mysql_query("set names utf8",$connect);
?>