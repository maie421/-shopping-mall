<?php

// page 변수명 겹쳐서 중복 출력됨
session_start();

$page=$_GET['page'];
$isbn=$_GET['isbn'];
$scale = 5;

include "../db/dbcon.php";

$sql = "select * from review where isbn=$isbn order by num desc";
$result = mysql_query($sql,$connect);
$total_record = mysql_num_rows($result);
$review_count = mysql_num_rows($result);//리뷰 개수

$sql2 = "select * from books where isbn='".$isbn."'";
$result2 = mysql_query($sql2,$connect);
	if($result2){
		$row2 = mysql_fetch_array($result2); 
	}
	
	$title = $row2[title];
	$subtitle = $row2[subtitle];
	$subtitle = $row2[subtitle];
	$author = $row2[author];
	$translator = $row2[translator];
	$publisher = $row2[publisher];
	$publication_date = $row2[publication_date];
	$page2 = $row2[page];
	$isbn =$row2[isbn];
	$size = $row2[size];
	$price = $row2[price];
	$point = $row2[point];
	$click = $row2[click];
	//$book_introduction_bold = $row2[book_introduction_bold];
	$book_introduction_bold = str_replace("\n","<br>",$row2[book_introduction_bold]);
	$book_introduction_bold = str_replace(" ","&nbsp;",$book_introduction_bold);
	//$book_introduction = $row2[book_introduction];
	$book_introduction = str_replace("\n","<br>",$row2[book_introduction]);
	$book_introduction = str_replace(" ","&nbsp;",$book_introduction);
	//$author_introduction = $row2[author_introduction];
	$author_introduction = str_replace("\n","<br>",$row2[author_introduction]);
	$author_introduction = str_replace(" ","&nbsp;",$author_introduction);
	//$translator_introduction = $row2[translator_introduction];
	$translator_introduction = str_replace("\n","<br>",$row2[translator_introduction]);
	$translator_introduction = str_replace(" ","&nbsp;",$translator_introduction);

	$contents = str_replace("\n","<br>",$row2[contents]);
	$contents = str_replace(" ","&nbsp;",$contents);
	//$contents = $row2[contents];
	//$publisher_review_bold = $row2[publisher_review_bold];
	$publisher_review_bold = str_replace("\n","<br>",$row2[publisher_review_bold]);
	$publisher_review_bold = str_replace(" ","&nbsp;",$publisher_review_bold);
	//$publisher_review = $row2[publisher_review];
	$publisher_review = str_replace("\n","<br>",$row2[publisher_review]);
	$publisher_review = str_replace(" ","&nbsp;",$publisher_review);
	$cat_id = $row2[cat_id];

	$image_name[0] = $row2[file_name_0];
	$image_name[1] = $row2[file_name_1];

	$image_copied[0] = $row2[file_copied_0];
	$image_copied[1] = $row2[file_copied_1];

	$img_name[0] = $image_copied[0];
	$img_name[1] = $image_copied[1];

	$img_name[1] = "../data/".$img_name[1];
	$img_name[0] = "../data/".$img_name[0];

	$new_click = $click+1;
	$sql = "update books set click=$new_click where isbn=$isbn";
	mysql_query($sql,$connect);
/*
	$image_name = $row2[file_name_0];
$image_copied = $row2[file_copied_0];

$img_name = $image_copied;
$img_name = "../data/".$img_name;
*/
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
<link href="/css/full.css" rel="stylesheet">
<link href="/css/sub06.css" rel="stylesheet">
<script>
function up(id,max){
	var count = document.getElementById("count_"+id);
	count.value++;
}
function down(id){
	var count = document.getElementById("count_"+id);
	if(count.value > 1)
		count.value--;
}
function calculatePrice()
{
    var totalprice = 0;
    var itemprice = parseInt($('span#item-price').text().replace(/[^0-9]/g, ''));
    $('ul#selected-result li').each(function() {
        var $prcelmt = $(this).find('.price-value');
        var optprc = 0;
        var itcnt = parseInt($(this).find('input').val());
        $prcelmt.each(function() {
            var prc = parseInt($(this).text());
            optprc += prc;
        });
        totalprice += (itemprice + optprc) * itcnt;
    });
    $('#total-price span').text(number_format(totalprice) + '원');
}
</script>
</head>
<body>
<? include "../lib/top_menu.php";?>
<div id="main">
<img src="<?=$img_name[0];?>" id='img'>
<div id="top">
	<h2><?=$title;?><? if($subtitle) echo": ".$subtitle;?></h2>
	<ul id="writer">
		<li><?=$author;?></li>
		<li>|</li>
		<li><?=$publisher;?></li>
		<li>|</li>
		<li><?=$publication_date;?></li>
	</ul>
	<ul id="review">
		<li><?php for($j=0; $j<5; $j++){ ?><img id="star" src="/img/side/star.png"><? } ?></li>
		<li>0.0</li>
		<li>&nbsp&nbsp&nbsp</li>
		<li><img id="bubble" src="/img/side/bubble.png"></li>
		<li>리뷰</li>
		<li><?=$review_count; ?></li>
		<li>&nbsp&nbsp&nbsp</li>
		<li>구매자수</li>
		<li>0</li>
	</ul>
</div><!--top-->
<div id="cols_box">
	<div id="cols">
		<ul id="col01">
			<li>판매가</li>
			<li>포인트</li>
		</ul>
		<ul id="col02">
			<li><?=$price;?>원</li>
			<li><?=$point;?>원</li>
		</ul>
	</div><!--cols-->
	<div id="cols">
		<ul id="col01">
			<li>추가혜택쿠폰</li>
		</ul>
		<ul id="col02">
			<li>쿠폰받기</li>
		</ul>
	</div><!--cols-->
	<div id="cols">
		<ul id="col01">
			<li>배송비</li>
			<li>배송일정</li>
		</ul>
		<ul id="col02">
			<li>무료</li>
			<li>주문시 1일이내 출고 예정</li>
		</ul>
	</div><!--cols-->
</div><!--cols_box-->
<?php

		//$count = "<script>document.write (document.getElementById('count_'+id).value);</script>";
?>
<div id="buy">
	<ul id="quantity">
		<li>수량:</li>
		<li>
		<input type="text" class="count" id="count_<?=$isbn;?>" value="1" name="count"><button id="up" onclick="up('<?=$isbn;?>','100')">+</button><button id="down" onclick="down('<?=$isbn;?>')">-</button>
		</li>
	</ul>
	<ul id="total">
		<li>총 금액:</li>
		<li id="bold"><?=number_format($price);?>원</li>
	</ul>
	<div class="btn">
		<form method="post" action="../basket/basket.php">
		<input type="hidden" id="count_<?=$isbn;?>" value="document.write(count.value);" name="count">
			<input type="hidden" name="new" value="<?=$isbn; ?>">
				<button type="submit" class="btn01">장바구니에 담기</button>
				</form>
				<button class="btn02">바로구매하기</button>
				<button class="btn03">위시리스트</button>
		
	</div><!--btn-->
</div><!--buy-->
<div class="clear"></div>
<div id="product">
<div id="btn02">
	<a href="#product"><button class="btn04">상품정보</button></a>
	<a href="#member_review"><button class="btn05">회원리뷰</button></a>
	<a href="#exchange"><button class="btn05">교환/반품/품절</button></a>
</div>
	<table id="table01">
		<tr>
			<th class="th01">ISBN</th>
			<td class="td01"><?=$isbn;?></td>
		</tr>
		<tr>
			<th class="th01">쪽수</th>
			<td class="td01"><?=$page2;?></td>
		</tr>
		<tr>
			<th class="th01">크기</th>
			<td class="td01"><?=$size;?></td>
		</tr>
	</table>
	<div class="book">
		<h3>책소개</h3>
		<!--<h4>이 책이 속한 분야</h4>
		<ul id="category">
			<li>소설   > 일본소설   > 추리/미스터리소설 </li>
			<li>소설   > 장르소설   > 추리/미스터리소설 </li>
		</ul>-->
		<img src="<?=$img_name[1]?>" id='file_img'>
		<b><!--응징과 용서의 진정한 의미는 무엇인가!--><?=$book_introduction_bold;?></b>
		<p>
		<?=$book_introduction;?></p>
	</div><!--book-->
	<div class="book">
		<h3>저자소개</h3>
		<div class="writer">
			<ul>
				<li>저자</li>
				<li>:</li>
				<li><?=$author;?></li>
			</ul>
		</div>
		<!--<h4>저자가 속한 분야</h4>
		<ul id="category">
			<li>문학가  > 현대소설가＞일본작가 </li>
			<li>문학가  > 현대문학가＞공포/추리소설작가 </li>
		</ul>-->
		<p><?=$author_introduction;?> </p>
		<?php if($translator){?>
		<div class="writer">
			<ul>
				<li>역자</li>
				<li>:</li>
				<li><?=$translator;?></li>
			</ul>
		</div>
		<?php } ?>
		<p><?=$translator_introduction;?></p>
	</div><!--book-->
	<div class="book">
		<h3>목차</h3>
		<ul id="category">
			<li><?=$contents;?></li>
		</ul>
	</div><!--book-->
	<div class="book">
		<h3>출판사 서평</h3>
		<b><?=$publisher_review_bold;?> </b>
		<p><?=$publisher_review;?></p>
	</div><!--book-->
</div><!--product-->
<div id="member_review">
	<div id="btn02">
		<a href="#product"><button class="btn05">상품정보</button></a>
		<a href="#member_review"><button class="btn04">회원리뷰</button></a>
		<a href="#exchange"><button class="btn05">교환/반품/품절</button></a>
	</div>
	<div class="book">
		<form id="review_box" method="post" action="../db/review_insert.php?isbn=<?=$isbn;?>">
		<?php
		
		
		?>
			<div id="num">리뷰 <?=$review_count ?></div>
			<select name="score">
				<option value="5">★★★★★</option>
				<option value="4">★★★★</option>
				<option value="3">★★★</option>
				<option value="2">★★</option>
				<option value="1">★</option>
			</select>
			<div class="clear"></div>
			<textarea rows="6" cols="95" name="content" placeholder="리뷰를 등록해주세요."></textarea>
			<button id="submit">등록</button>
		</form>
		<?php
		for($i = $start; $i < $start + $scale && $i < $total_record; $i++)
		{
		mysql_data_seek($result,$i);
		$row = mysql_fetch_array($result);
		
		$review_num = $row[num];
		$review_id = $row[id];
		$review_date = $row[regist_day];
		$review_score = $row[score];
		
		$review_content = str_replace("\n","<br>",$row[content]);
		$review_content = str_replace(" ","&nbsp;",$review_content);
		?>
		<div id="review_writer">
			<ul>
				<li id="writer_title1"><?=$review_id ?></li>
				<li id="writer_title2"><?=$review_date ?></li>
				<li id="writer_title3">
				<?php
				for($j=1;$j<=$review_score;$j++){
					echo "<img src='/img/side/star02.png' id='star'>";
				}
				for($k=0;$k<(5-$review_score);$k++){
					echo "<img src='/img/side/star.png' id='star1'>";
				}
				?>
				</li>
				<li id="writer_title4">
				<?php
					if($userid == "admin" || $userid == $review_id)
						echo "<a href='../db/review_delete.php?isbn=$isbn&&num=$review_num'>[삭제]</a>"; 
				?>
				</li>
			</ul>
			<div id="review_content"><?=$review_content ?></div>
		</div>
		<?php
		$number--;
		} //for문 종료
		mysql_close();
		?>
	<?php
	echo "<div id='page'>";
	if($total_record)
		echo ("<div id='page_num'><button class='page_btn'>◀ </button> &nbsp;&nbsp;&nbsp;&nbsp;");
	for($i = 1; $i <= $total_page; $i++)
	{
		if($page == $i)
		{
			echo "<button id='now'> $i </button>";
		}
		else
		{
			echo "<a href='sub06.php?page=$i #member_review'><button class='page_btn'> $i </button></a>";
		}
	}
	if($total_record)
		echo ("&nbsp;&nbsp;&nbsp;&nbsp;<button class='page_btn'>▶</button></div>");
	echo "</div>";
	?>
	</div><!--book-->
</div><!--member_review-->
<div id="exchange">
	<div id="btn02">
		<a href="#product"><button class="btn05">상품정보</button></a>
		<a href="#member_review"><button class="btn05">회원리뷰</button></a>
		<a href="#exchange"><button class="btn04">교환/반품/품절</button></a>
	</div>
	<div class="book">
		<h3>교환/반품/품절안내</h3>
		<span>※ 상품 설명에 반품/교환 관련한 안내가 있는 경우 그 내용을 우선으로 합니다. (업체 사정에 따라 달라질 수 있습니다.)</span>
		<table id="table02">
			<tr>
				<th class="th02">반품/교환방법</th>
				<td class="td02"><span>마이룸 > 주문관리 > 주문/배송내역 > 주문조회 > 반품/교환신청 ,<br> [1:1상담>반품/교환/환불] 또는 고객센터 (1544-1900)</span><br>
				※ 오픈마켓, 해외배송주문, 기프트 주문시 [1:1상담>반품/교환/환불]
    또는 고객센터 (1544-1900)</td>
			</tr>
			<tr>
				<th class="th02">반품/교환가능 기간</th>
				<td class="td02">변심반품의 경우 수령 후 7일 이내,<br>상품의 결함 및 계약내용과 다를 경우 문제점 발견 후 30일 이내</td>
			</tr>
			<tr>
				<th class="th02">반품/교환비용</th>
				<td class="td02">변심 혹은 구매착오로 인한 반품/교환은 반송료 고객 부담</td>
			</tr>
			<tr>
				<th class="th02">반품/교환 불가 사유</th>
				<td class="td02">
					<ul>
						<li>소비자의 책임 있는 사유로 상품 등이 손실 또는 훼손된 경우<br>(단지 확인을 위한 포장 훼손은 제외)</li>
						<li>소비자의 사용, 포장 개봉에 의해 상품 등의 가치가 현저히 감소한 경우<br> 예) 화장품, 식품, 가전제품(악세서리 포함) 등</li>
						<li>복제가 가능한 상품 등의 포장을 훼손한 경우<br> 예) 음반/DVD/비디오, 소프트웨어, 만화책, 잡지, 영상 화보집</li>
						<li>소비자의 요청에 따라 개별적으로 주문 제작되는 상품의 경우 ((1)해외주문도서)</li>
						<li>디지털 컨텐츠인 eBook, 오디오북 등을 1회 이상 다운로드를 받았을 경우</li>
						<li>시간의 경과에 의해 재판매가 곤란한 정도로 가치가 현저히 감소한 경우</li>
						<li>전자상거래 등에서의 소비자보호에 관한 법률이 정하는 소비자 청약철회 제한 내용에 해당되는 경우</li>
						<li>해외주문도서 : 이용자의 요청에 의한 개인주문상품으로 단순변심 및 착오로 인한 취소/교환/반품 시 ‘해외주문 반품/취소 수수료’ 고객 부담 (해외주문 반품/취소 수수료 : ①양서-판매정가의 12%, ②일서-판매정가의 7%를 적용) </li>
					</ul>
				</td>
			</tr>
			<tr>
				<th class="th02">상품 품절</th>
				<td class="td02">공급사(출판사) 재고 사정에 의해 품절/지연될 수 있으며, 품절 시 관련 사항에 대해서는 이메일과 문자로 안내드리겠습니다. </td>
			</tr>
			<tr>
				<th class="th02">소비자 피해보상<br>환불지연에 따른 배상</th>
				<td class="td02">
					<ul>
						<li>상품의 불량에 의한 교환, A/S, 환불, 품질보증 및 피해보상 등에 관한 사항은 소비자분쟁해결 기준 (공정거래위원회 고시)에 준하여 처리됨</li>
						<li>대금 환불 및 환불지연에 따른 배상금 지급 조건, 절차 등은 전자상거래 등에서의 소비자 보호에 관한 법률에 따라 처리함</li>
					</ul>
				</td>
			</tr>
		</table>
	</div><!--book-->
</div><!--exchange-->
</div><!--main-->
<? include "../lib/footer.php"; ?>
</body>
</html>