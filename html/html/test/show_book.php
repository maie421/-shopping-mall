<?php
	include "dbconfig.php";

	$isbn = $_GET['isbn'];

	/*
	if ((!$isbn)||($isbn=='')){
	?>
		<script>
			alert('정상적인 경로로 이용하세요!');
			history.back();
		</script>
		*/
		<?php
			
		$sql = "select * from books where isbn='".$isbn."'";
		$result = mysql_query($sql,$connect);
		
		if($result){
			$row = mysql_fetch_array($result); 
		}
		

		echo $row['title']; //책 제목 출력
		echo "<table><tr>"
			if (file_exists("img/".$row['isbn'].".png")){
				echo"<td><img src =='img/".$row['isbn'].".png'/></td>";
			}
		echo "<td><ul>";
		echo "<li><strong>저자: </strong>";
		echo $row['author'];
		echo "</li><li><strong>ISBN: </strong>";
		echo $row['isbn'];
		echo "</li><li><strong>가격: </strong>";
		echo $row['price']."원";
		echo"</li><li><strong>책 소개: </strong>";
		echo $row['description'];
		echo "</li></ul></td></tr></table>";

		echo "<hr/>"

		if($row['cat_id']){
			$url = "show_category.php?cat_id=".$row['cat_id'];
		}	
		// 쇼핑하기 / 장바구니 이동
		echo "<div align='center'>"."<span><a href='".$url"'><img src='img/coninue_shopping.png'></a></span>"."<span><a href='show_cart.php?new=".$isbn"'><img src='img/addcart.png'></a></span>"."</div>";
		
		
		?>
	}
?>