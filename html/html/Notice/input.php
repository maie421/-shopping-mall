<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/full.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/write.css" rel="stylesheet">
<link href="/css/side_menu.css" rel="stylesheet">

</head>
<body>
<? include "../lib/top_menu.php";?>
<? include "../lib/side_menu.php";?>
  <div id="notice_main">
    <div id="notice_main_title">문의하기</div>
    <div id="write_box">
      <div id="title">이름</div>
      <div id="write_text_box">
        <input type="text" id="write_input">
      </div>
      <hr>
    </div>
    <div id="write_box">
      <div id="title">주문번호</div>
      <div id="write_text_box">
        <input type="text" id="write_input">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">비밀번호</div>
      <div id="write_text_box">
        <input type="password" id="write_input">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">제목</div>
      <div id="write_text_box">
        <input type="text" id="write_input">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">첨부파일1</div>
      <div id="write_text_box">
        <input type="file">
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
      <div id="title_textarea">내용</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="write_textarea"></textarea>
      </div>
    <hr>
    </div>
    <div id="write_button_box">
      <button class="write_button">목록</button>
      <button class="write_button">확인</button>
    </div><!--search-->
  </div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>