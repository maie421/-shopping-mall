<?php
session_start();
include "../db/dbcon.php";
$mode = $_GET['mode'];
$num = $_GET['num'];

if($mode == "modify"){
	$sql = "select * from notice where num='$num'";
	$result = mysql_query($sql,$connect);
	$row = mysql_fetch_array($result);

	$writer = $row[writer];
	$title = $row[title];
	$content = $row[content];
	$file_name = $row[file_name];
	$file_copied = $row[file_copied];
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/full.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/write.css" rel="stylesheet">
<link href="/css/admin_side_menu.css" rel="stylesheet">
<script>
function check_input(){
	if(!document.notice.writer.value)
	{
		alert("이름을 입력하세요");
		document.notice.writer.focus();
		return;
	}
	if(!document.notice.title.value)
	{
		alert("제목을 입력하세요");
		document.notice.title.focus();
		return;
	}
	if(!document.notice.content.value)
	{
		alert("내용을 입력하세요");
		document.notice.content.focus();
		return;
	}
	document.notice.submit();
}
</script>
</head>
<body>
<? include "../lib/admin_top_menu.php";?>
<? include "../lib/admin_notice.php";?>
  <div id="notice_main">
    <div id="notice_main_title">공지</div>
		<?php if($mode == "modify"){ ?>
		<form name="notice" method="post" action="../db/notice_insert.php?mode=modify&&num=<?=$num?>" enctype="multipart/form-data">
		<?php } else { ?>
	<form name="notice" method="post" action="../db/notice_insert.php" enctype="multipart/form-data">
	<?php } ?>
    <div id="write_box">
      <div id="title">이름</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="writer" value="<?=$writer; ?>">
      </div>
      <hr>
    </div>
    <div id="write_box">
      <div id="title">제목</div>
      <div id="write_text_box">
        <input type="text" id="write_input" name="title" value="<?=$title; ?>">
      </div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title">첨부파일</div>
      <div id="write_text_box">
			<?php if($mode == "modify" && $file_name){ ?>
			<input type="file" name="upfile">&nbsp&nbsp<?=$file_name; ?>&nbsp&nbsp
			<input type="checkbox" name="del_file" value="0">삭제
			<?php } else { ?>
			<input type="file" name="upfile">
			<?php } ?>
			</div>
    <hr>
    </div>
    <div id="write_box">
      <div id="title_textarea">내용</div>
      <div id="write_text_box">
        <textarea rows="10" cols="75" id="write_textarea" name="content"><?=$content; ?></textarea>
      </div>
    <hr>
    </div>
    <div id="write_button_box">
      <button class="write_button">목록</button>
      <button type="button" class="write_button" onclick="check_input()">확인</button>
    </div><!--search-->
	</form>
  </div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>