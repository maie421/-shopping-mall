<?php
	session_start(); //세션 시작
	  header('Content-type:text/html; charset=utf-8');
   include "./dbconfig.php";

    //카테고리 테이블로부터 카테고리 가져오기
    $sql = "select cat_id, cat_name from categories"; 
    $result = mysql_query($sql,$connect); // 입력된 SQL 명령 실행
    
    if($result){
		// return false;
	//} // result값이 아닌 경우, false 값을 반환 

	// $num_cats=mysql_num_rows($result); //카테고리 전체 개수값을 변수 num_cats에 얻어옴
		
    //if ($num_cats == 0){
	//	return false;
	//} // num_cats == 0 : 카테고리가 없는 경우, false 값을 반환

	$cat_array = array(); // 배열 선언

	// num_cats != 0: num_cats값을 fetch_array를 통해 각각 받아와야 함
	// 여러 개의 카테고리가 있기 때문에 for문으로 돌림
	for ($count = 0; $row = mysql_fetch_array($result); $count++){
		$cat_array[$count]=$row;
	}
	}
	// 문제 생김: 카테고리의 cat_id 와 cat_name을 전부 다 끌고 와서 국내/국외/참고서 서적 카테고리 구분 불가능 해짐 => 카테고리 테이블을 종류별로 만들어서 연결시킬지 고민 (상의 필요함)
    
?>
        
        <!----------------------------->
        
        <h3>쇼핑몰에 오신것을 환영합니다!!!</h3>
        
        <p>원하는 카테고리를 선택하세요 :</p>
        <?php
            if(!array($cat_array)){
                echo "<p>카테고리가 존재하지 않습니다!!!</p>";
            }
            echo "<ul>";
            foreach($cat_array as $row){
                $url= "show_category.php?cat_id=".$row['cat_id']; 
				// url에 show_category 페이지 연결
				// url으로 넘어갈 때 cat_id값과 같이 넘어감
                // 연결 안되는 것 같음... cat_name 까지만해도 말짱했음 ㅠ
				$cat_name = $row['cat_name'];
                echo "<li>";
                ?>
                <a href = "<?php echo $url?>"><?php echo $cat_name;?></a>
                <?php
                echo "</li>";
            }
            echo "</ul>";
            echo "<hr />";
			?>
            
     </body>
	</html>