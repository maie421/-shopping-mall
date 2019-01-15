<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/full.css" rel="stylesheet">
<link href="/css/join.css" rel="stylesheet">
<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script src="daum.js"></script>
<script>
function check_input(){
	if(!document.customers.custom_id.value)
	{
		alert("아이디를 입력하세요");
		document.customers.custom_id.focus();
		return;
	}
	if(!document.customers.custom_password.value)
	{
		alert("비밀번호를 입력하세요");
		document.customers.custom_password.focus();
		return;
	}
	if(!document.customers.pwc.value)
	{
		alert("비밀번호 확인을 입력하세요");
		document.customers.pwc.focus();
		return;
	}
	if(!document.customers.name.value)
	{
		alert("이름을 입력하세요");
		document.customers.name.focus();
		return;
	}
	if(!document.customers.email1.value)
	{
		alert("이메일을 입력하세요");
		document.customers.email1.focus();
		return;
	}
	if(!document.customers.phone.value)
	{
		alert("휴대폰번호을 입력하세요");
		document.customers.phone.focus();
		return;
	}
	if(!document.customers.tel.value)
	{
		alert("집전화번호을 입력하세요");
		document.customers.tel.focus();
		return;
	}
	if(!document.customers.zipcode.value)
	{
		alert("우편주소를 입력하세요");
		document.customers.zipcode.focus();
		return;
	}
	//주소문제
	/*
	if(!document.customers.address.value)
	{
		alert("주소를 입력하세요");
		document.customers.address.focus();
		return;
	}*/
	document.customers.submit();
}
</script>
</head>
<body>
<? include "../lib/top_menu.php";?>
<div id="main">
<form name="customers" method="post" action="../db/join_insert.php">
	<div id="join_top">
		<div id="join_title">
			회원가입
		</div>
	</div>
	<div id="basic">
		<div id="join_title">
			기본정보
		</div>
		<span id="join_left"><span id="red_color">*</span> 표시는 반드시 입력하셔야 하는 항목입니다.</span>
	</div>
	<div id="join_box">
		<div id="join_box_mini">
			<span id="red_color">*</span> 아이디
		</div>
		<div id="join_box_mini_1">
			<input type="text" id="join_input" name="custom_id">
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
			<input type="password" id="join_input" name="pwc">
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini">
			<span id="red_color">*</span> 이름
		</div>
		<div id="join_box_mini_1">
			<input type="text" id="join_input" name="name">
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini_e">
			<span id="red_color">*</span> 이메일
		</div>
		<div id="join_box_mini_1">
			<input type="text" id="email_input" name="email1">
      <select id="email_select" name="email2">
        <option value="">직접입력</option>
        <option value="naver.com">네이버</option>
        <option value="엥?">엥?</option>
        <option value="기타">기타</option>
      </select>
      <div id="agree_box">
      <input type="checkbox" value="Y" id="agree_checkbox"><span id="agree">정보/이벤트 메일수신에 동의합니다.</span>
      </div>
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini_e">
			휴대폰번호
		</div>
		<div id="join_box_mini_1">
			<input type="text" id="join_input" placeholder="-없이 입력하세요" name="phone">
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
			<input type="text" id="join_input" placeholder="-없이 입력하세요" name="tel">
		</div>
		<hr>
	</div>
  <div id="join_box">
		<div id="join_box_mini_a">
			<span id="red_color">&nbsp;</span> 주소
		</div>
		<div id="join_box_mini_1">
			<input type="text" id="address" name="zipcode" placeholder="우편번호"><input type="button" onclick="sample4_execDaumPostcode()" id="address_button" value="우편번호 검색">
      <input type="text" id="address_input" placeholder="도로명주소" name="adress1">
      <input type="text" id="address_input" class="sample4_jibunAddress" name="address2" placeholder="상세주소">
      <span id="guide" style="color:#999"></span>
		</div>
		<hr>
	</div>
  <div class="button_box">
   <input type="button" class="button" value="취소">
   <input type="button" class="button_Check" value="회원가입" onclick="check_input()">
  </div>
  </form>
</div><!--main_main-->
<? include "../lib/footer.php";?>
</body>
</html>