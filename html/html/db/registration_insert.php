<?php
session_start();
header('Content-type:text/html; charset=utf-8');

$title = $_POST['title'];
$subtitle = $_POST['subtitle'];
$author = $_POST['author'];
$translator = $_POST['translator'];
$publisher = $_POST['publisher'];
$publication_date = $_POST['publication_date'];
$page = $_POST['page'];
$isbn = $_POST['isbn'];
$cat_id = $_POST['cat_id'];
$size = $_POST['size'];
$price = $_POST['price'];
$point = $price*0.05;
$quantity = $_POST['quantity'];
$book_introduction_bold = $_POST['book_introduction_bold'];
$book_introduction = $_POST['book_introduction'];
$author_introduction = $_POST['author_introduction'];
$translator_introduction = $_POST['translator_introduction'];
$contents = $_POST['contents'];
$publisher_review = $_POST['publisher_review'];
$publisher_review_bold = $_POST['publisher_review_bold'];
$regist_day = date("Y-m-d (H:i)");

$files = $_FILES["file_name"];
$count = count($files["name"]);

$upload_dir = '../data/';



for ($i=0; $i<$count; $i++){
	$upfile_name[$i]=$files["name"][$i];
  $upfile_tmp_name[$i]=$files["tmp_name"][$i];
  $upfile_type[$i]=$files["type"][$i];
  $upfile_size[$i]=$files["size"][$i];
  $upfile_error[$i]=$files["error"][$i];

	$file=explode(".", $upfile_name[$i]);
	$file_name=$file[0];
	$file_ext=$file[1];

	if(!$upfile_error[$i]){
    $new_file_name=date("Y_m_d_H_i_s");
    $new_file_name=$new_file_name."_".$i;
    $copied_file_name[$i]=$new_file_name.".".$file_ext; 
    $uploaded_file[$i]=$upload_dir.$copied_file_name[$i];

/* 수정 할거임 
		if($upfile_size[$i]>500000){
			echo("
        <script>
        alert('업로드 파일 크기가 지정된 용량(500KB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
        history.go(-1)
        </script>
        ");
        exit;
		}
     
		if(($upfile_type[$i]!="image/gif") && ($upfile_type[$i]!="image/jpeg") && ($upfile_type[$i]!="image/pjpeg")){
    echo("
        <script>
        alert('JPG와 GIF 이미지 파일만 업로드 가능합니다!');
        history.go(-1)
        </script>
        ");
        exit;
		}
*/
		if(!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i])){
		 echo("
        <script>
          alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
          history.go(-1)
         </script>
			");
      exit;
		}
	} 
}
   include "dbcon.php";        // dcon.php 파일을 불러옴

$mode = $_GET['mode'];


// 수정 글 저장
if($mode=="book"){
	$isbn = $_GET['isbn'];

  $num_checked = count($_POST['del_file']);
	$position = $_POST['del_file'];

	for($i=0; $i<$num_checked; $i++)                      // delete checked item
		{
			$index = $position[$i];
			$del_ok[$index] = "y";

		}

	$sql = "select * from books where isbn='$isbn'"; // 수정할 레코드 검색
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	for ($i=0; $i<$count; $i++)					// update DB with the value of file input box
	{

		$field_org_name = "file_name_".$i;
		$field_real_name = "file_copied_".$i;

		$org_name_value = $upfile_name[$i];
		$org_real_value = $copied_file_name[$i];

		if ($del_ok[$i] == "y")
		{
			$delete_field = "file_copied_".$i;
			$delete_name = $row[$delete_field];
			$delete_path = "../data/".$delete_name;

			unlink($delete_path); //파일 삭제
			
			$sql = "update books set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where isbn=$isbn";
			mysql_query($sql, $connect);
		}
		else
		{
			if (!$upfile_error[$i])
			{
				$sql = "update books set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where isbn=$isbn";
				mysql_query($sql, $connect);
			}
		}
	}

	$sql = "update books set cat_id='$cat_id', title='$title', subtitle='$subtitle',author='$author', translator='$translator', publication_date='$publication_date',publisher='$publisher', page='$page', isbn='$isbn',size='$size', price='$price', point='$point', quantity='$quantity',book_introduction_bold='$book_introduction_bold',book_introduction='$book_introduction', contents='$contents', author_introduction='$author_introduction',publisher_review_bold='$publisher_review_bold', publisher_review='$publisher_review' where isbn='$isbn'";
	mysql_query($sql, $connect);                // $sql에 저장된 명령 실행

	mysql_close();

	echo ("
    <script>
      location.href='../management/mangement.php';
    </script>
  ");
  }
   // 새로 작성되는 글 저장
else{
	
    $sql="insert into books (title, subtitle, author, translator, publisher, 
		publication_date, page, isbn, cat_id, size, price, point, quantity, book_introduction_bold, book_introduction,
		author_introduction, translator_introduction, contents, publisher_review_bold, publisher_review,";
		$sql.="file_name_0,file_name_1, file_copied_0, file_copied_1) ";
    $sql.="values('$title', '$subtitle', '$author', '$translator', '$publisher',  
        '$publication_date', '$page', '$isbn', '$cat_id', '$size', '$price', '$point', '$quantity','$book_introduction_bold', 
		'$book_introduction', '$author_introduction', '$translator_introduction', '$contents', '$publisher_review_bold', '$publisher_review', ";
$sql.= "'$upfile_name[0]','$upfile_name[1]', '$copied_file_name[0]','$copied_file_name[1]')";
    mysql_query($sql, $connect);      // $sql 에 저장된 명령 실행
  
  mysql_close();                      // 데이터베이스 연결 끊기 
  echo ("
    <script>
      location.href='../management/registration.php';
    </script>
  ");
}
?>



