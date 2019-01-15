<?php
	/* 신버전
	$db = new mysqli('localhost', 'dawnbookstore', 'dawnbookstore18');

	if($db->connect_error)
	{
		die('데이터베이스 연결문제 있음');
	}

	$db->set_charset('utf8');
	*/
	$connect = mysql_connect ("localhost", "dawnbookstore", "dawnbookstore18") or die ("SQL sever에 연결할 수 없습니다.");

	mysql_select_db("dawnstore", $connect);
	mysql_query("set names utf8", $connect); // 접속했을 때 자동으로 utf8로 문자 세팅
?>

