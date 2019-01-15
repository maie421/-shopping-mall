<?php
session_start();

include "../db/dbcon.php";
$page=$_GET['page'];
$mode=$_GET['mode'];
$scale = 10;

if($mode == "search"){
	$today = date("Y-m-d (H:i)");
	$drone = $_POST['drone'];
	//echo $drone;
	//exit;
	//아이디
	$find1 = $_POST['find1'];
	$find2 = $_POST['find2'];
  //기간
	$find3 = $_POST['find3'];
	$find4 = $_POST['find4'];
	$find5 = $_POST['find5'];
	$find6 = $_POST['find6'];
	$find7 = $_POST['find7'];
	$find8 = $_POST['find8'];
	$from = $find3."-".$find4."-".$find5." (00:00)";
	$to = $find6."-".$find7."-".$find8." (23:59)";
	if($drone && $drone != "5"){
		$sql = "select * from customers where regist_day<='$today' and regist_day>='$drone'";
	}
	else{
		if($find2){
			if($from){
				$sql = "select * from customers where $find1 like '%$find2%' and regist_day>='$from' and regist_day<='$to'";
			}
			else{
				$sql = "select * from customers where $find1 like '%$find2%'";
			}
		}
		else{
			$sql = "select * from customers where regist_day>='$from' and regist_day<='$to'";
		}
	}
}
else{
	$sql = "select * from customers";
}
	$result = mysql_query($sql,$connect);
	$total_record = mysql_num_rows($result);

//페이지 버튼
	if($total_record % $scale == 0)
	$total_page = floor($total_record / $scale);
else
	$total_page = floor($total_record / $scale) + 1;

if(!$page)
	$page = 1;

$start = ($page - 1) * $scale;
$number = $total_record - $start;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script>
    $(function(){
        //전체선택 체크박스 클릭
        $("#check_all").click(function(){
            //전체선택 체크박스가 체크된상태일경우
            if($("#check_all").prop("checked")) {
                //input type 이 checkbox인 경우 전부 선택
                $("input[type=checkbox]").prop("checked",true);
            } else {
                //input type 이 checkbox인 경우 전부 해제
                $("input[type=checkbox]").prop("checked",false);
            }
        })
    })
    </script>
<link href="/css/admin_side_menu.css" rel="stylesheet">
<link href="/css/full.css" rel="stylesheet">
<link href="/css/member_select.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/member_admin.css" rel="stylesheet">
<link href="/css/basket.css" rel="stylesheet">
</head>
<body>
<? include "../lib/admin_top_menu.php";?>
<div id="main">
<div id="side_menu">
   <ul id="menu01">
       <li>회원관리</li>
   </ul>
    <ul class="menu02">
        <li>회원관리</li>
    </ul>
</div><!--side_menu-->
<div id="notice_main">
	<div id="notice_main_title">회원관리</div>
	<form method = "post" action="member_admin.php?mode=search">
    <div class="search_requirement">검색조건</div>
    <div class="requirement">
      <input type="radio" value="<?=date("Y-m-d (00:00)");?>" name="drone" id="radio" checked onclick="div_OnOff(this.value,'#con');">오늘가입
      <input type="radio"  value="<?=date("Y-m-d (00:00)",strtotime("-1 week"));?>" name="drone" id="radio" <?if($drone == date("Y-m-d (00:00)",strtotime('-1 week'))) echo "checked"; ?>>최근1주간 
      <input type="radio" value="<?=date("Y-m-d (00:00)",strtotime("-1 month"));?>" name="drone" id="radio" <?if($drone == date("Y-m-d (00:00)",strtotime('-1 month'))) echo "checked"; ?>>최근한달간 
      <input type="radio" value="<?=date("Y-m-d (00:00)",strtotime("-1 year"));?>" name="drone" id="radio" <?if($drone == date("Y-m-d (00:00)",strtotime('-1 year'))) echo "checked"; ?>>최근1년간 
      <input type="radio" value="5"  name="drone" id="radio" <?if($drone == "5") echo "checked"; ?>>상세검색
			<!--<?php //if($drone == "5"){?>-->
      <select id="email_select" name="find1">
        <option value="custom_id">아이디</option>
        <option value="email">이메일</option>
        <option value="name">이름</option>
      </select>
      <input type="text" id="member_text" name="find2">
    </div><!--검색조건 끝-->
    <div class="search_requirement">기간지정</div>
    <div class="requirement">
      <select id="email_select" name="find3">
				<option>선택</option>
				<option value="2018"> 2018 </option>
				<option value="2019"> 2019 </option>
			</select>년 
			<select id="email_select" name="find4">
				<option>선택</option>
				<option value="01"> 01 </option>
				<option value="02"> 02 </option>
				<option value="03"> 03 </option>
				<option value="04"> 04 </option>
				<option value="05"> 05 </option>
				<option value="06"> 06 </option>
				<option value="07"> 07 </option>
				<option value="08"> 08 </option>
				<option value="09"> 09 </option>
				<option value="10"> 10 </option>
				<option value="11"> 11 </option>
				<option value="12"> 12 </option>
			</select>월 
			<select id="email_select" name="find5">
			  <option>선택</option>
				<option value="01"> 01 </option>
				<option value="02"> 02 </option>
				<option value="03"> 03 </option>
				<option value="04"> 04 </option>
				<option value="05"> 05 </option>
				<option value="06"> 06 </option>
				<option value="07"> 07 </option>
				<option value="08"> 08 </option>
				<option value="09"> 09 </option>
				<option value="10"> 10 </option>
				<option value="11"> 11 </option>
				<option value="12"> 12 </option>
				<option value="13"> 13 </option>
				<option value="14"> 14 </option>
				<option value="15"> 15 </option>
				<option value="16"> 16 </option>
				<option value="17"> 17 </option>
				<option value="18"> 18 </option>
				<option value="19"> 19 </option>
				<option value="20"> 20 </option>
				<option value="21"> 21 </option>
				<option value="22"> 22 </option>
				<option value="23"> 23 </option>
				<option value="24"> 24 </option>
				<option value="25"> 25 </option>
				<option value="26"> 26 </option>
				<option value="27"> 27 </option>
				<option value="28"> 28 </option>
				<option value="29"> 29 </option>
				<option value="30"> 30 </option>
				<option value="31"> 31 </option>
			</select>일 부터 
			<select id="email_select" name="find6">
				<option>선택</option>
				<option value="2018"> 2018 </option>
				<option value="2019"> 2019 </option>
			</select>년
		<select id="email_select" name="find7">
				<option>선택</option>
				<option value="01"> 01 </option>
				<option value="02"> 02 </option>
				<option value="03"> 03 </option>
				<option value="04"> 04 </option>
				<option value="05"> 05 </option>
				<option value="06"> 06 </option>
				<option value="07"> 07 </option>
				<option value="08"> 08 </option>
				<option value="09"> 09 </option>
				<option value="10"> 10 </option>
				<option value="11"> 11 </option>
				<option value="12"> 12 </option>
			</select>월 
			<select id="email_select" name="find8">
				<option>선택</option>
				<option value="01"> 01 </option>
				<option value="02"> 02 </option>
				<option value="03"> 03 </option>
				<option value="04"> 04 </option>
				<option value="05"> 05 </option>
				<option value="06"> 06 </option>
				<option value="07"> 07 </option>
				<option value="08"> 08 </option>
				<option value="09"> 09 </option>
				<option value="10"> 10 </option>
				<option value="11"> 11 </option>
				<option value="12"> 12 </option>
				<option value="13"> 13 </option>
				<option value="14"> 14 </option>
				<option value="15"> 15 </option>
				<option value="16"> 16 </option>
				<option value="17"> 17 </option>
				<option value="18"> 18 </option>
				<option value="19"> 19 </option>
				<option value="20"> 20 </option>
				<option value="21"> 21 </option>
				<option value="22"> 22 </option>
				<option value="23"> 23 </option>
				<option value="24"> 24 </option>
				<option value="25"> 25 </option>
				<option value="26"> 26 </option>
				<option value="27"> 27 </option>
				<option value="28"> 28 </option>
				<option value="29"> 29 </option>
				<option value="30"> 30 </option>
				<option value="31"> 31 </option>								
			</select>일 까지
			<!--<?php //}?>-->
      <input type="submit" style="background-color:white; border:1px solid #a3a3a3; padding:3px;margin-left:12px;" value="확인">
    </div>
		</form>
		<form method="post" action="../db/admin_delete.php?mode=member_all">
      <table id="member_table">
      <tr>
        <th class="notice_ch" ><input type="checkbox" id="check_all"></th>
        <th id="new_notice">아이디</th>
        <th id="new_notice">이름</th>
        <th id="member_email">이메일</th>
        <th id="new_notice">포인트</th>
        <th id="new_notice">접속횟수</th>
        <th id="new_notice">가입날짜</th>
        <th id="new_notice">수정/삭제</th>
      </tr>
			<?php 
			for($i;$row = mysql_fetch_array($result);$i++){
					$custom_id = $row[custom_id];
					//$custom_id = $row[]; //등급
					$name = $row[name];
					$email = $row[email];
					//$custom_id = $row[]; //포인트
					$regist_day = $row[regist_day];
					$access = $row[access];
					if($custom_id=="admin")
						continue;
				?>
      <tr>
        <td class="notice_ch"><input type="checkbox" name="ch[]" value="<?=$custom_id?>"></td>
        <td id="new_notice"><?=$custom_id; ?></th>
        <td id="new_notice"><?=$name; ?></th>
        <td id="member_email"><?=$email; ?></th>
        <td id="new_notice">0<input type="text" value="0" id="point_text"></th>
        <td id="new_notice"><?=$access; ?></th>
        <td id="new_notice"><?=$regist_day; ?></th>
        <td id="new_notice">
					<a href="#">수정</a>
					<a href="<?echo "../db/admin_delete.php?mode=member&&custom_id=$custom_id";?>">삭제</a>
				</td>
      </tr>
			<?php
			$number--; 
			} 
			mysql_close();
      echo "</table>";
      if($total_record==0)
        echo ('<div id="NoProduct">회원이 존재하지 않습니다</div>');
      ?>
			<input class="write_button" type="submit" value="삭제">
			</form>
			<!--
      <div class="number_page_center">
        <ul>
          <li id="number_page"><a href="#">1</a></li>
        </ul>
      </div>-->
			<?php

	echo "<div id='page'>";
	if($total_record)
		echo ("<div id='page_num01'><button class='page_btn'>◀ </button> &nbsp;&nbsp;&nbsp;&nbsp;");
	for($i = 1; $i <= $total_page; $i++)
	{
		if($page == $i)
		{
			echo "<button id='now'> $i </button>";
		}
		else
		{
			echo "<a href='member_admin.php?page=$i'><button class='page_btn'> $i </button></a>";
		}
	}
	if($total_record)
		echo ("&nbsp;&nbsp;&nbsp;&nbsp;<button class='page_btn'>▶</button></div>");
	echo "</div>";
	?>
      
</div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>