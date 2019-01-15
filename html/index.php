<?php
session_start();
include"html/db/dbcon.php";

$sql="select * from books where cat_id>=1000 and cat_id<2000 order by publication_date asc";
$result= mysql_query($sql,$connect);

$sql1="select * from books where cat_id>=2000 and cat_id<3000 order by publication_date asc";
$result1= mysql_query($sql1,$connect);

$sql2="select * from books order by click desc";
$result2 = mysql_query($sql2,$connect);

$sql3= "select * from books order by click asc";
$result3 = mysql_query($sql3,$connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>새벽서점</title>
		<link href="css/main.css" rel="stylesheet">
    <link href="css/full.css" rel="stylesheet">
    <script>
      function over(){
        document.img.src="/img/main/bnG_w02.jpg";
        document.getElementById("back-color").style.backgroundColor = "#e3f2d3";
      }
      function over1(){
        document.img.src="/img/main/bnL_w01.jpg";
        document.getElementById("back-color").style.backgroundColor = "#f9f4d7";
      }
      function over2(){
        document.img.src="/img/main/bnG_w01.jpg";
        document.getElementById("back-color").style.backgroundColor = "#fdebd7";
      }
			function BoxDomestic(){
				 document.getElementById("numberboxdomestic").style.display = "block";
				  document.getElementById("numberboxoversea").style.display = "none";
			}
			function BoxOversea(){
				 document.getElementById("numberboxoversea").style.display = "block";
				 document.getElementById("numberboxdomestic").style.display = "none";
			}
			
    </script>
	</head>
	<body>
    <? include "html/lib/top_menu.php";?>
    <div id="back-color">
      <div id="story">
        <img src="/img/main/bnG_w02.jpg" id="banner_img" name="img">
        <div id="menu_bar">
        <ul>
          <li onmouseover="over()">오늘의 책</li>
          <li onmouseover="over2()">이럴 땐 이런 책</li>
          <li onmouseover="over1()">새로나온 책</li>
        </ul>
        </div>
      </div>
    <div>
    <div id="main_gray">
      <div id="main">
      <a href="html/side/sub06.php?isbn=9791188810666"><img src="/img/main/tt1.jpg" id="advertising"></a>
      <a href="html/side/sub06.php?isbn=9791188941117"><img src="/img/main/pp1.jpg" id="advertising"></a>
      <a href="html/side/sub06.php?isbn=9788950975913"><img src="/img/main/ww41.jpg" id="advertising_right"></a>
      </div><!--main-->
    </div><!--main_gray-->
    <div class="main_white">
      <div id="main">
      <a href="#"><img src="/img/main/bnG_05.jpg" id="advertising_mini"></a>
      <a href="#"><img src="/img/main/bnL_w04.jpg" id="advertising_mini"></a>
      <a href="#"><img src="/img/main/bnL_w04 (1).jpg" id="advertising__mini_right"></a>
      </div><!--main-->
    </div><!--main_gray-->
    <div id="main">
    <div id="good_menu">
      <ul>
        <li id="good_title">화제의 권장도서</li>
        <li id="good_sid_menu" onmouseover="BoxDomestic()">국내 도서</li>
        <li id="good_sid_menu"  onmouseover="BoxOversea()">국외 도서</li>
      </ul>
    </div>
		<div id="numberboxdomestic">
		<?php
			$number = 01;
			for($i=0; $row=mysql_fetch_array($result); $i++){
			if($i>=4)
				break;
			$image_name = $row[file_name_0];
			$image_copied = $row[file_copied_0];
			$img_name = $image_copied;
			$img_name = "html/data/".$img_name;

			$isbn=$row[isbn];
			$title=$row[title];
			
			$cat_id=$row[cat_id];


			$sql0="select * from categories where cat_id=$cat_id";
			$result0= mysql_query($sql0, $connect);
			$row0=mysql_fetch_array($result0);
			$cat_name=$row0[cat_name];
		?>
    <div id="good_box">
      <a href="html/side/sub06.php?isbn=<?=$isbn;?>"><img src="<?=$img_name;?>" id="main_good_size"></a>
      <div id="good_menu_1">[<?=$cat_name;?>]</div>
      <div style="width:130px;"><?=$title;?></div>
    </div>
	<? } ?>
		</div><!--NumberBoxDomestic-->
		
		<div id="numberboxoversea">
		<?php
			$number = 01;
			for($i=0; $row1=mysql_fetch_array($result1); $i++){
			if($i>=4)
				break;
			$image_name = $row1[file_name_0];
			$image_copied = $row1[file_copied_0];
			$img_name = $image_copied;
			$img_name = "html/data/".$img_name;

			$isbn=$row1[isbn];
			$title=$row1[title];
			
			$cat_id=$row1[cat_id];

			$sql5="select * from categories where cat_id=$cat_id";
			$result5= mysql_query($sql5, $connect);
			$row5=mysql_fetch_array($result5);
			$cat_name1=$row5[cat_name];

		?>
    <div id="good_box">
      <a href="html/side/sub06.php?isbn=<?=$isbn;?>"><img src="<?=$img_name;?>" id="main_good_size"></a>
      <div id="good_menu_1">[<?=$cat_name1;?>]</div>
      <div style="width:130px;"><?=$title;?></div>
    </div>
	<? } ?>
		</div><!--BoxOversea-->
    </div><!--main-->
    <div id="back-color_blue">
    <div id="main">
    <div id="good_menu">
      <ul>
        <li id="good_title">베스트 셀러</li>
      </ul>
    </div>
    <div id="back_white">
	<?php
		$number = 01;
		for($i=0; $row2=mysql_fetch_array($result2); $i++){
			if($i>=5)
				break;
			$image_name = $row2[file_name_0];
			$image_copied = $row2[file_copied_0];
			$img_name = $image_copied;
			$img_name = "html/data/".$img_name;

			$isbn=$row2[isbn];
			$title=$row2[title];
			$author = $row2[author];
			
	?>
      <div id="best_number_side">
      <?php
	  if($i==0){?><div class="number" style="color:#ca4747;"><?} else {?> <div class="number"><?}?><?=$number;?></div>
	  
      <a href="html/side/sub06.php?isbn=<?=$isbn;?>"><img src="<?=$img_name;?>" id="main_good_side"></a><!--2-->
      <div ><b><?=$title;?></b></div><br><br>
      <?=$author;?>
      </div><!--best_number-->
	<? 
	$number++;
	} 
	?>
    </div><!--back_white-->
    </div><!--main-->
    </div><!--back-color_blue-->
    <div id="main">
      <div id="good_menu">
        <ul>
          <li id="good_title">이주의 책</li>
        </ul>
      </div>
	  <?php
		for($i=0; $row3=mysql_fetch_array($result3); $i++){
			if($i>=5)
				break;
			$image_name = $row3[file_name_0];
			$image_copied = $row3[file_copied_0];
			$img_name = $image_copied;
			$img_name = "html/data/".$img_name;

			$isbn=$row3[isbn];
			$title=$row3[title];
			$author = $row3[author];
			
		?>

      <div id="migration">
      <div id="migration_back">
        <a href="html/side/sub06.php?isbn=<?=$isbn;?>"><img src="<?=$img_name;?>" id="migration_img_size"></a>
      </div>
      <b><?=$title;?></b><br><br>
      <?=$author;?>
    </div><!--migration-->
    <?}?>
    </div>
    <? include "html/lib/footer.php";?>
	</body>
</html>