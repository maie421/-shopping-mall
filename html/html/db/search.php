<?php
session_start(); 
header('Content-type:text/html; charset=utf-8');

		$mode = $_POST['mode'];
		$find_select = $_POST['find_select'];
		$find_text = $_POST['find_text'];
//echo $find_select;echo $find_text;
//exit;
    include "dbcon.php";

		if($mode == "search"){
			if(!$find_text){
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
					location.href='../side/sub01.php?find_select=$find_select&&find_text=$find_text';
				</script>
			");
			}
			if($find_select == "cat_id<=2304 and cat_id>=2000"){
				echo("
				<script>
					location.href='../side/sub02.php?find_select=$find_select&&find_text=$find_text';
				</script>
			");
			}
			//$sql2 = "select * from books where $find_select like '%$find_text%'";
		}
		//$result2 = mysql_query($sql2,$connect);
?>