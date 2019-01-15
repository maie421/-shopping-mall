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
</head>
<body>
<? include "../lib/top_menu.php";?>
<div id="main">
  <div id="main_box">
	  <div id="title">로그인</div>
  <div id="login_box">
    <div id="tilte_side">회원 로그인</div>
		<form method="post" action="../db/loginCheck.php">
			<div id="login_input">
				<input type="text" id="input_id" placeholder="아이디" name="custom_id">
				<input type="password" id="input_id" placeholder="비밀번호" name="custom_password">
			</div>
     <input type="submit" id="login_button" value="로그인">
		</form>
    <div id="login_checkbox_box">
      <input type="checkbox" id="login_checkbox"><span id="id_color">&nbsp;아이디 저장</span>
    </div>
		<?php
		$client_id = "FDCf_e_HfHyLPdDHxv4A";
		$redirectURI = urlencode("callback.php");
		$state = "RAMDOM_STATE";
		$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;
		?>
     <a href="<?php echo $apiURL ?>">
     <button id="button_naver">
     <div class="button_center">
     <img src="/img/login/naver_logo.png" id="naver_logo_img">
     <div id="naver_logo_name">아이디 로그인</div>
     </div>
     </button>
		 </a>
     <div id="hr"></div>
     <a href="../join/join1.php"><button id="button_join"><span id="naver_logo_name_find">회원가입</span></button></a>
     <a href="id_find.php"><button id="button_join_find"><span id="naver_logo_name_find">아이디 찾기</span></button></a>
     <a href="pass_find.php"><button id="button_join_find"><span id="naver_logo_name_find">비밀번호 찾기</span></button></a>
     <!--비회원 로그인-->
    <div id="tilte_side">비회원 로그인</div>
      <form method="post" action="../db/non_check.php">
			<div id="login_input">
      <input type="text" id="input_id" placeholder="주문자명" name="name">
      <input type="text" id="input_id" placeholder="주문번호" name="number">
    </div>
    <input type="submit" id="Non-members" value="확인">
		</form>
    <div id="login_checkbox_box">
      <span id="id_color">※주문번호와 비밀번호를 잊으신 경우, 고객센터로 문의하여 주시기 바랍니다.</span>
    </div>
  </div><!--login_box-->
  </div><!--main_box-->
</div><!--main_main-->
<? include "../lib/footer.php";?>
</body>
</html>