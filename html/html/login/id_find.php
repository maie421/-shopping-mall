<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/full.css" rel="stylesheet">
<link href="/css/login.css" rel="stylesheet">
<script>
function id_find(){
}
</script>
</head>
<body>
<? include "../lib/top_menu.php";?>
<div id="main">
  <div id="main_box">
	  <div id="title">아이디찾기</div>
  <div id="login_find_box">
    <div id="tilte_side">회원 아이디찾기</div>
    <form method="post" action="../db/id_find_insert.php">
    <div id="login_input">
      <input type="text" id="input_id" placeholder="이름" name="name">
      <input type="text" id="input_id" placeholder="이메일" name="email">
    </div>
    <input type="submit" id="login_button" value="아이디찾기" onclick="id_find()">
    </form>
    <div id="find_button">
    <a href="pass_find.php"><button id="button_join_find"><div id="naver_logo_name_find">비밀번호 찾기</div></button></a>
     <a href="login.php"><button id="button_join_find"><span id="naver_logo_name_find">로그인하기</span></button></a>
    </div>
  </div><!--login_find_box-->
  </div><!--main_box-->
</div><!--main_main-->
<? include "../lib/footer.php";?>
</body>
</html>