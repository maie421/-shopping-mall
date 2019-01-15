<?php
	//include "./dbconfig.php";

	//$cat_id = $_GET['cat_id'];

	$sql = "select cat_name from categories where cat_id=".$cat_id."";
	$result = mysql_query($sql,$connect);
	
	if ($result){
		$num_cats = mysql_num_rows($result);
	}

	$row = mysql_fetch_object($result);
	//$row = mysql_fetch_array($result);
	//$title = $row[title];
	$cat_name = $cat_name($row);

	//$sql = "select * from books where cat_id ='".$cat_id"'"; // 카테고리 아이디와 같은 레코드를 전부 가져 옴
	//$result = mysql_query($sql,$connect);
	if($result){
		$num_books = $num_rows($result);
		if($num_books == 0){
			echo "죄송합니다. 해당 카테고리의 책은 준비 중입니다.";
		}

		$books_array = array();

		for($count = 0; $row = mysql_fetch_array($result); $count++){
			$books_array[$count] = $row;
		}

		if(!is_array($books_array)){
			echo "죄송합니다. 해당 카테고리의 책은 준비 중입니다.";

		else{
			echo "<table width='100%' border='0'>";

			foreach($books_array as $row){
				$url='show_book.php?isbn='.$row['isbn'];
				echo"<tr><td>";
				if(file_exists("img/".$row['isbn'].".png")){
					$book_img = "<img src='img/".$row['isbn'].".png'style='border: 1px solid black' width=100px height=120px/>";
					?>
					<a href="<?php echo $url;?>"><?php echo $book_img;?></a>
				}
				<?php
				else{
					echo"&nbsp;";
				}
				echo "</td><td>";
				$title = $row['title'].", 저자: ".$row['author'];
				?>
				<a href="<?php echo $url;?>"><?php echo $title;?></a> 
				<? php
				$book_img;?></a>
				echo "</td><tr>";
			}
			echo "</table>";
		}
		echo "<hr/>";
		}
	}
?>
