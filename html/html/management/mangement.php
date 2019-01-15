<?php
session_start();

include "../db/dbcon.php";

$cat_id_change = $_POST['cat_id'];
$page=$_GET['page'];
$scale = 6;
//책 목록 불러오기
if($cat_id_change){
	$sql = "select * from books where cat_id=$cat_id_change";
	if($cat_id_change%100==0){
		$sql = "select * from books where cat_id>$cat_id_change and cat_id<=$cat_id_change+30";
	}
}
else{
$sql = "select * from books";
}
$result = mysql_query($sql,$connect);
$total_record = mysql_num_rows($result);


//카테고리
$sql2 = "select * from categories order by cat_id ";
$result2 = mysql_query($sql2,$connect);
$total_record2 = mysql_num_rows($result2);


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
<link href="/css/admin_main.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<script>
function change(){
	document.select.submit();
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
<div id="notice_main_title">제품목록</div>
		<form name="select" method="post" action="mangement.php">
		<select id="email_select" name="cat_id" onchange="change()">
      <option value="">카테고리</option>
	  <?php
    for($i=0;$i<$total_record2;$i++){
		mysql_data_seek($result2,$i);
	  $row2=mysql_fetch_array($result2);
	  $cat_name=$row2[cat_name];
	  $cat_id=$row2[cat_id];
		if($cat_id % 100 == 0){
	  ?>
		<option value="">--------------------------</option>
		<?
	  if($cat_id == $cat_id_change){
		?>
		<option value="<?=$cat_id;?>" selected="selected"><?=$cat_name?></option>
		<?php
			}else{
		?>
		<option value="<?=$cat_id?>"><?=$cat_name?></option>
		<? } ?>
		<option value=""></option>
	  <?
		}
		else{
			if($cat_id == $cat_id_change){
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
		</form>
		<form name="submit01" method="post" action="../db/admin_delete.php?mode=book_all">
    <table>
    <tr>
      <th class="notice_check"><input type="checkbox" id="check_all"></th>
      <th class="notice_title">상품/옵션 정보</th>
      <th class="notice">수량</th>
      <th class="notice">상품금액</th>
      <th class="notice">상품번호</th>
      <th class="notice">수정/삭제</th>
    </tr>
		
		<?php
			for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
			{
			mysql_data_seek($result, $i);       
			$row = mysql_fetch_array($result);

			$title = $row[title];
			$quantity = $row[quantity];
			$price = $row[price];
			$isbn = $row[isbn];

			$image_name = $row[file_name_0];
			$image_copied = $row[file_copied_0];

			$img_name = $image_copied;
			$img_name = "../data/".$img_name;
		  ?>
    <tr>
      <td class="notice_check"><input type="checkbox" name="ch[]" value="<?=$isbn?>"></td>
      <td class="notice_title"><a href="#"><img src="<?=$img_name; ?>" id="basket_img"></a><div id="basket_img_name"><div id="deduction">소득공제</div>
      <?=$title; ?></div>
      <td class="notice"><?=$quantity; ?></a></td>
      <td class="notice"><?=$price; ?></td>
      <td class="notice"><?=$isbn; ?></td>
      <td class="notice">
				<a href="registration.php?mode=book&&isbn=<?=$isbn;?>">수정</a> 
				<a href="<? echo "../db/admin_delete.php?mode=book&&isbn=$isbn";?>">삭제</a>
			</td>
    </tr>
		<?php
		$number--;
	  }
		mysql_close();
	  ?>
		
  </table>
	<button class="write_button" type="submit">삭제</button>
	</form>
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
				echo "<a href='mangement.php?page=$i'><button class='page_btn'> $i </button></a>";
			}
		}
		if($total_record)
			echo ("&nbsp;&nbsp;&nbsp;&nbsp;<button class='page_btn'>▶</button></div>");
		echo "</div>";
		?>
    
		
    <div id="search">
      <select id="search_select">
        <option>제목</option>
        <option>내용</option>
        <option>작성자</option>
      </select>
      <input type="text" id="search_text">
      <button id="search_button">검색</button>
    </div>
  </div>
</div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>