<!--역자소개, 포인트 적립가 입력 창 없음-->
<?php
session_start();
include "../db/dbcon.php";
$mode = $_GET['mode'];
$isbn = $_GET['isbn'];

if($mode == "book"){
	$sql = "select * from books where isbn='$isbn'";
	$result = mysql_query($sql,$connect);
	$row = mysql_fetch_array($result);

	$cat_id_1 = $row[cat_id];
	$cat_name_1 = $row[cat_name];
	$title = $row[title];
	$subtitle = $row[subtitle];
	$author = $row[author];
	$translator = $row[translator];
	$publication_date = $row[publication_date];
	$publisher = $row[publisher];
	$page = $row[page];
	$isbn = $row[isbn];
	$size = $row[size];
	$price = $row[price];
	$quantity = $row[quantity];
	$book_introduction_bold = $row[book_introduction_bold];
	$book_introduction = $row[book_introduction];
	$contents = $row[contents];
	$author_introduction = $row[author_introduction];
	$publisher_review_bold = $row[publisher_review_bold];
	$publisher_review = $row[publisher_review];
	$translator_introduction = $row[translator_introduction];
	$file_name_0 = $row[file_name_0];
	$file_copied_0 = $row[file_copied_0];
	$file_name_1 = $row[file_name_1];
	$file_copied_1 = $row[file_copied_1];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/admin_side_menu.css" rel="stylesheet">
<link href="/css/full.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/write.css" rel="stylesheet">
<script>
function check_input(){
	if(!document.registration.cat_id.value)
	{
		alert("카테고리를 입력하세요");
		document.registration.cat_id.focus();
		return;
	}
	if(!document.registration.title.value)
	{
		alert("제목을 입력하세요");
		document.registration.title.focus();
		return;
	}
	if(!document.registration.author.value)
	{
		alert("저자를 입력하세요");
		document.registration.author.focus();
		return;
	}
	if(!document.registration.publication_date.value)
	{
		alert("출판일을 입력하세요");
		document.registration.publication_date.focus();
		return;
	}
	if(!document.registration.publisher.value)
	{
		alert("출판사를 입력하세요");
		document.registration.publisher.focus();
		return;
	}
	if(!document.registration.page.value)
	{
		alert("쪽수를 입력하세요");
		document.registration.page.focus();
		return;
	}
	if(!document.registration.isbn.value)
	{
		alert("isbn을 입력하세요");
		document.registration.isbn.focus();
		return;
	}
	if(!document.registration.size.value)
	{
		alert("크기를 입력하세요");
		document.registration.size.focus();
		return;
	}
	if(!document.registration.price.value)
	{
		alert("판매가를 입력하세요");
		document.registration.price.focus();
		return;
	}
	if(!document.registration.quantity.value)
	{
		alert("재고를 입력하세요");
		document.registration.quantity.focus();
		return;
	}
	document.registration.submit();
}
</script>
</head>
<body>
<? include "../lib/admin_top_menu.php";?>
<div id="main">
<div id="side_menu">
   <ul id="menu01">
       <li>제품관리</li>
   </ul>
    <ul class="menu02">
        <li><a href="mangement.php">제품목록</a></li>
        <li><a href="registration.php">제품관리</a></li>
    </ul>
</div><!--side_menu-->
<div id="notice_main">
<div id="notice_main_title">제품등록</div>
<?php if($mode == "book"){ ?>
<form name="registration" method="post" action="../db/registration_insert.php?mode=book&&isbn=<?=$isbn;?>" enctype="multipart/form-data">
<?php } else{ ?>
<form name="registration" method="post" action="../db/registration_insert.php" enctype="multipart/form-data">
<?php } ?>
<?php
include "../db/dbcon.php";

$sql = "select * from categories order by cat_id ";
$result = mysql_query($sql,$connect);
$total_record = mysql_num_rows($result);
?>
	<select id="email_select" name="cat_id">
      <option>카테고리</option>
	  <?php

    for($i=0;$i<$total_record;$i++){
		mysql_data_seek($result,$i);
	  $row=mysql_fetch_array($result);
	  $cat_name=$row[cat_name];
	  $cat_id=$row[cat_id];
		if($cat_id % 100 == 0){
	  ?>
		<option>--------------------------</option>
	  <option><?=$cat_name?></option>
		<option></option>
	  <?
		}
		else{
			if($mode == "book" && $cat_id == $cat_id_1){
		?>
		<option value="<?=$cat_id;?>" selected="selected">&nbsp;&nbsp;&nbsp;<?=$cat_name?></option>
		<?php
			}else{
		?>
		<option value="<?=$cat_id?>">&nbsp;&nbsp;&nbsp;<?=$cat_name?></option>
		<?php
			}
			}//else
		}//for
	  ?>
		</select>
    <div id="write_box">
      <div id="title">제목</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="title" value="<?=$title; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">사이드 제목</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="subtitle" value="<?=$subtitle; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">저자</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="author" value="<?=$author; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">역자</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="translator" value="<?=$translator; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">출판일</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="publication_date" value="<?=$publication_date; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">출판사</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="publisher" value="<?=$publisher; ?>">
      </div>
    <hr>
    </div>
    
    <div id="write_box">
      <div id="title">쪽수</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="page" value="<?=$page; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">ISBN</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="isbn" value="<?=$isbn; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">크기</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="size" value="<?=$size; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">판매가</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="price" value="<?=$price; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">재고</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="quantity" value="<?=$quantity; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">책표지</div>
      <div id="write_text_box">
        <!--<input type="file" name="file_name[]">-->
				<?php if($mode == "book" && $file_name_0){ ?>
				<input type="file" name="file_name[]">&nbsp&nbsp<?=$file_name_0; ?>&nbsp&nbsp
				<input type="checkbox" name="del_file[]" value="0">삭제
				<?php } else { ?>
				<input type="file" name="file_name[]">
				<?php } ?>
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">상세이미지</div>
      <div id="write_text_box">
        <!--<input type="file" name="file_name[]">-->
				<?php if($mode == "book" && $file_name_1){ ?>
				<input type="file" name="file_name[]">&nbsp&nbsp<?=$file_name_1; ?>&nbsp&nbsp
				<input type="checkbox" name="del_file[]" value="1">삭제
				<?php } else { ?>
				<input type="file" name="file_name[]">
				<?php } ?>
      </div>
    <hr>
    </div>
		<div id="write_box">
      <div id="title_textarea">책 소개 bold</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="book_introduction" name="book_introduction_bold"><?=$book_introduction_bold; ?></textarea>
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title_textarea">책 소개</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="book_introduction" name="book_introduction"><?=$book_introduction; ?></textarea>
      </div>
    <hr>
    </div>
	<div id="write_box">
		<div id="title_textarea">목차</div>
		<div id="write_text_box">
        <textarea rows="10" cols="75" id="contents" name="contents"><?=$contents; ?></textarea>
      </div>
    <hr>
    </div>
		<div id="write_box">
      <div id="title_textarea">저자 소개</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="author_introduction" name="author_introduction"><?=$author_introduction; ?></textarea>
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title_textarea">역자 소개</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="author_introduction" name="translator_introduction"><?=$translator_introduction; ?></textarea>
      </div>
    <hr>
    </div>
		<div id="write_box">
      <div id="title_textarea">출판사 서평bold</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="publisher_review" name="publisher_review_bold"><?=$publisher_review_bold; ?></textarea>
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title_textarea">출판사 서평</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="publisher_review" name="publisher_review"><?=$publisher_review; ?></textarea>
      </div>
    <hr>
    </div>
	<button type="button" class="write_button" onclick="check_input()">확인</button>
	</form>
</div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>