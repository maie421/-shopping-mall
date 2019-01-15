<?php
session_start();

$custom_id = $_SESSION['userid'];

include "../db/dbcon.php";

$sql="select * from customers where custom_id='{$custom_id}'";
$result = mysql_query($sql,$connect);
$row = mysql_fetch_array($result);

$name = $row[name];
$custom_id = $row[custom_id];
$custom_password = $row[custom_password];
$zipcode = $row[zipcode];
$tel = $row[tel];
$phone = $row[phone];

$email = explode("@", $row[email]);
$email1 = $email[0];
$email2 = $email[1];

$address = explode(" ", $row[address]);
$address1 = $address[0];
$address2 = $address[1];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/full.css" rel="stylesheet">
<link href="/css/join.css" rel="stylesheet">
</head>
<body>
<? include "../lib/top_menu.php";?>
<div id="main_main">
	<div id="join_top">
		<div id="join_title">
			회원정보수정
		</div>
</div>
	<div id="basic">
		<div id="join_title">
			기본정보
		</div>
		<span id="join_left"><span id="red_color">*</span> 표시는 반드시 입력하셔야 하는 항목입니다.</span>
	</div>
	<form method="post" action="../db/custom_modify.php">
	<div id="join_box">
		<div id="join_box_mini">
			<span id="red_color">*</span> 아이디
		</div>
		<div id="join_box_mini_1">
			<?=$custom_id?>
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini">
			<span id="red_color">*</span> 비밀번호
		</div>
		<div id="join_box_mini_1">
			<input type="password" id="join_input" placeholder="영문대/소문자,숫자,특수문자 중 2가지 이상 조합하세요" name="custom_password">
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini">
			<span id="red_color">*</span> 비밀번호확인
		</div>
		<div id="join_box_mini_1">
			<input type="password" id="join_input">
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini">
			<span id="red_color">*</span> 이름
		</div>
		<div id="join_box_mini_1">
			<?=$name?>
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini_e">
			<span id="red_color">*</span> 이메일
		</div>
		<div id="join_box_mini_1">
			<input type="text" id="email_input" name="email1" value="<?=$email1?>">
      <select id="email_select" name="email2" value="<?=$email2?>">
        <option value="">직접입력</option>
        <option value="naver.com">네이버</option>
      </select>
      <div id="agree_box">
      <input type="checkbox" id="agree_checkbox"><span id="agree">정보/이벤트 메일수신에 동의합니다.</span>
      </div>
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini_e">
			<span id="red_color">*</span> 휴대폰번호
		</div>
		<div id="join_box_mini_1">
			<input type="text" id="join_input" placeholder="-없이 입력하세요" name="phone" value="<?=$phone?>">
      <div id="agree_box">
      <input type="checkbox" value="Y" id="agree_checkbox"><span id="agree">정보/이벤트 SNS수신에 동의합니다.</span>
      </div>
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini">
			<span id="red_color">&nbsp;</span> 전화번호
		</div>
		<div id="join_box_mini_1">
			<input type="text" id="join_input" placeholder="-없이 입력하세요" name="tel" value="<?=$tel?>">
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini_a">
			<span id="red_color">&nbsp;</span> 주소
		</div>
		<div id="join_box_mini_1">
			<input type="text" id="address" name="zipcode" value="<?=$zipcode?>"><input type="button" id="address_button" value="우편번호 검색">
      <input type="text" id="address_input" name="address1" value="<?=$address1?>">
      <input type="text" id="address_input" name="address2" value="<?=$address2?>">
		</div>
		<hr>
	</div>
  <div class="button_box">
   <input type="button" class="button" value="취소">
   <input type="submit" class="button_Check" value="회원수정">
  </div>
  </form>
</div><!--main_main-->
<? include "../lib/footer.php";?>
</body>
</html>