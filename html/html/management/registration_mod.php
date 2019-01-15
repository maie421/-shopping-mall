<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/admin_side_menu.css" rel="stylesheet">
<link href="/css/full.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/write.css" rel="stylesheet">
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
<div id="notice_main_title">제품수정</div>
    <div id="write_box">
      <div id="title">제목</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="subject">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">사이드 제목</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="side_subject">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">저자</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="price">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">역자</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="price">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">출판일</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="price">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">쪽수</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="price">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">ISBN</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="price">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">크기</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="price">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">판매가</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="price_result">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">재고</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="quantity">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">첨부파일1</div>
      <div id="write_text_box">
        <input type="file" name="file_name">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">첨부파일2</div>
      <div id="write_text_box">
        <input type="file">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title_textarea">책소개</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="write_textarea"></textarea>
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title_textarea">저자소개</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="write_textarea"></textarea>
      </div>
    <hr>
    </div>
</div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>