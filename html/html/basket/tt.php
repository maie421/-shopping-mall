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
		  <link href="/css/full.css" rel="stylesheet">
      <link href="/css/basket.css" rel="stylesheet">
    </head>
<body>
   <? include "../lib/top_menu.php";?>
<div id="main">
  <div id="join_top">
		<div id="join_title">
			장바구니
		</div>  
    <!--<?php session_unset(); // 세션삭제 수정 필요함...?>-->
    <!--상품 출력폼-->
		<span id="join_left"><span id="red_color1">01 장바구니 > </span>02 주문서작성/결제 > 03 주문완료</span>
	</div>

  <table>
    <tr>
      <th class="notice_check"><input type="checkbox" id="check_all"></th>
      <th class="notice_title">상품/옵션 정보</th>
      <th class="notice">수량</th>
      <th class="notice">상품금액</th>
      <th class="notice">할인/적립</th>
      <th class="notice">합계금액</th>
      <th class="notice">배송일정</th>
    </tr>