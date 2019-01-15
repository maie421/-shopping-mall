		<?php
		session_start();
		
		$userid=$_SESSION['userid'];
		$postname = $_POST['postname'];
		/*
		$mode = $_POST['mode'];
		$find_select = $_POST['find_select'];
		$find_text = $_POST['find_text'];

    //include "html/db/dbcon.php";//지랄이네..

		if($mode == "search"){
			/*if(!$find_text){
				echo("
					<script>
						window.alert('검색할 단어를 입력하세요.')
						history.go(-1)
					</script>
				");
				exit;
			}
			if($find_select == "cat_id>=1000 and cat_id<=1018"){
				echo("
				<script>
					location.href='html/side/sub01.php';
				</script>
			");
			}
			if($find_select == "cat_id<=2304 and cat_id>=2000"){
				echo("
				<script>
					location.href='html/side/sub02.php';
				</script>
			");
			}
			$sql2 = "select * from books where $find_select like '%$find_text%'";
		}
		$result2 = mysql_query($sql2,$connect);*/
		?>
		<script>
		function MainSideMenu(){
				 document.getElementById("SideMainMenue").style.display = "block";
		}
		function FullOut(){
				document.getElementById("SideMainMenue").style.display = "none";
		}
		</script>
		<script>
		function submit(){
			document.find.submit();
		}
		</script>
		<div id="login_menu">
			<div id="login_menu_1">
				<ul>
					<?
					if(!$userid)
					{
					?>
					<li><a href="/html/login/login.php">로그인</a></li>
          <li>|</li>
					<li><a href="/html/join/join1.php">회원가입</a></li>
					<li>|</li>
					<?
					}
					else
					{
					?>
					<li><a href="/html/login/logout.php">로그아웃</a></li>
          <li>|</li>
					<li><a href="/html/mypage/mypage.php">마이페이지</a></li>
					<li>|</li>
					<?
					}
          ?>
					<li><a href="/html/Notice/notice.php">고객센터</a></li>
					<li><a href="/html/basket/basket.php"><img src="/img/main/top_basket.gif" id="top_basket"></a></li>
				</ul>
			</div>
		</div>
    <div id="top_logo_back">
      <a href="http://dawnbookstore.dothome.co.kr/"><img src="/img/main/top_logo.png" id="top_logo"></a>
	  <?php if($postname){?>
			<form name="find" method="post" action="../db/search.php">
			<?php } else{ ?>
			<form name="find" method="post" action="html/db/search.php">
			<?php }?>
			<input type="hidden" name="mode" value="search">
      <div id="find">
      <select id="find_select" name="find_select">
        <option value="">통합검색</option>
        <option value="cat_id>=1000 and cat_id<=1018">국내도서</option>
        <option value="cat_id<=2304 and cat_id>=2000">외국도서</option>
      </select>
      <input type="input" placeholder="챕터마다 나오는 글들이 뼈를 때린다!" id="find_text" name="find_text">
      <img src="/img/main/find.jpg" id="find_img" onclick="submit()">
      </div><!--find-->
			</form>
    </div>
    <div id="center_menu">
			<div id="relative">
      <div id="center_menu_1">
        <ul>
          <!--<li id="contents"><img src="/img/main/contents.png" id="contents_img" onmouseover="MainSideMenu()">-->
          <li><a href="/html/side/sub01.php">국내도서</a></li>
          <li>|</li>
					<li><a href="/html/side/sub02.php">외국도서</a></li>
					<li>|</li>
					<li><a href="/html/side/sub03.php">신간도서</a></li>
          <li>|</li>
					<li><a href="/html/side/sub04.php">수험정보</a></li>
        </ul>
      </div>
			<div id="SideMainMenue"  onmouseout="FullOut()">
			<ul>
				<a href="/html/side/sub01.php"><li>국내도서</li></a>
				<a href="/html/side/sub02.php"><li>외국도서</li></a>
				<a href="/html/side/sub04.php"><li>수험정보</li></a>
      </ul>   	
			</div>
			</div>
    </div>
		