<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/side_menu.css" rel="stylesheet">
<link href="/css/full.css" rel="stylesheet">
<link href="/css/sub05.css" rel="stylesheet">
</head>
<body>
<? include "../lib/top_menu.php";?>
<div id="main">
	<div id="slide">
	</div>
	<div id="event">
		<a href="#coupon_page"><button id="coupon">쿠폰/혜택<span class="event01">></span></button></a>
		<a href="#event_page"><button id="event01">행사<span class="event01">></span></button></a>
		<a href="#gift_page"><button id="gift">사은품<span class="event01">></span></button></a>
		<a href="#attendance_page"><button id="attendance">출석체크<span class="event01">></span></button></a>
	</div>
	<div class="clear"></div>
	<div id="coupon_page">
		<h3>쿠폰/혜택</h3>
		<div class="event02">
		<?php for($i=0;$i<10;$i++){ ?>
			<div id="event_box">
				
			</div>
		<? } ?>
		</div>
	</div>
	<div id="event_page">
		<h3>행사</h3>
		<div class="event02">
		<?php for($i=0;$i<10;$i++){ ?>
			<div id="event_box">
				
			</div>
		<? } ?>
		</div>
	</div>
	<div id="gift_page">
		<h3>사은품</h3>
		<div class="event02">
		<?php for($i=0;$i<10;$i++){ ?>
			<div id="event_box">
				<img src="/img/side/event.jpg">
				<h5 id="event_title"><걸크러쉬> 출간 이벤트</h5>
				<ul>
					<li id="event_date">2018.09.19 ~ 사은품 소진 시</li>
					<li id="ing">진행중</li>
				</ul>
			</div><!--event_box-->
		<? } ?>
		</div>
	</div>
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>