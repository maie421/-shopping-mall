<?php
session_start();
header('Content-type:text/html; charset=utf-8');

$mode = $_GET['mode'];
$num = $_GET['num'];

$writer = $_POST['writer'];
$title = $_POST['title'];
$content = $_POST['content'];

$upload_dir='../data/';

$upfile_name = $_FILES["upfile"]["name"];
$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
$upfile_type = $_FILES["upfile"]["type"];
$upfile_size = $_FILES["upfile"]["size"];
$upfile_error = $_FILES["upfile"]["error"];

$file = explode(".", $upfile_name);
$file_name = $file[0]; //파일명
$file_ext = $file[1]; //확장자

$regist_day = date("Y.m.d");

if(!$upfile_error)
{
	$new_file_name = date("Y_m_d_H_i_s");
	//$new_file_name = $new_file_name."_".$i;
	$copied_file_name = $new_file_name.".".$file_ext; 
	$uploaded_file = $upload_dir.$copied_file_name;
	/*	
	if($upfile_size>500000)
    {
		echo("
        <script>
          alert('업로드 파일 크기가 지정된 용량(500KB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
          history.go(-1)
        </script>
      ");
      exit;
    } 
    if(($upfile_type!="image/gif") && ($upfile_type!="image/jpeg")&& ($upfile_type!="image/pjpeg"))
    {
      echo("
        <script>
          alert('JPG와 GIF 이미지 파일만 업로드 가능합니다!');
          history.go(-1)
        </script>
      ");
      exit;
    }*/
		if(!move_uploaded_file($upfile_tmp_name, $uploaded_file))
    {
      echo("
        <script>
          alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
          history.go(-1)
        </script>
      ");
      exit;
    }
  }

include "dbcon.php";

if($mode == "modify")                               // 수정 글 저장
{
	$position = $_POST['del_file'];

	if(count($_POST['del_file'])){
		$position = "y";
	}

	$sql = "select * from fqa where num='$num'";     // 수정할 레코드 검색
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	if($position == "y")
	{
		
		$delete_name = $row[file_copied];
		$delete_path = "../data/".$delete_name;

		unlink($delete_path); //파일 삭제
		
		$sql = "update fqa set file_name='$upfile_name',file_copied='$copied_file_name' where num=$num";
		mysql_query($sql, $connect);
	}
	else
	{
		if(!$upfile_error)
		{
			$sql = "update fqa set file_name='$upfile_name',file_copied='$copied_file_name' where num=$num";
			mysql_query($sql, $connect);
		}
	}
	$sql = "update fqa set writer='$writer', title='$title', content='$content' where num='$num'";
	mysql_query($sql, $connect);
}
else                                // 새로 작성되는 글 저장
{
$sql = "insert into fqa (writer,title,regist_day,content,file_name,file_copied)";
$sql.= "values('$writer','$title','$regist_day','$content','$upfile_name','$copied_file_name')";
//echo $sql;
//exit;
mysql_query($sql,$connect);
}
mysql_close();

echo ("
	<script>
		location.href='../notice_admin/fqa.php';
	</script>
");
?>