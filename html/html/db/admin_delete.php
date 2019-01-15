<?php
	$mode = $_GET['mode'];
	$custom_id = $_GET['custom_id'];

	include "dbcon.php";
	//회원관리 삭제
	if($mode == "member"){
		$sql = "delete from customers where custom_id = $custom_id";
		mysql_query($sql,$connect);

		mysql_close();

		echo ("
			<script>
				location.href='../member_admin/member_admin.php';
			</script>
		");
	}
	//회원관리 선택 삭제
	if($mode == "member_all"){
		$chk= $_POST['ch'];
		for($i=0;$i<count($chk);$i++){ 
			$custom_id = $chk[$i];
			$sql = "delete from customers where custom_id = $custom_id";
			mysql_query($sql,$connect);
	  }
		mysql_close();

		echo ("
			<script>
				location.href='../member_admin/member_admin.php';
			</script>
		");
	}
	//주문관리 삭제
	if($mode == "delivery"){
		$sql = "delete from orders where custom_id = $custom_id";//테이블명 고치기
		mysql_query($sql,$connect);

		mysql_close();

		echo ("
			<script>
				location.href='../delivery/delivery.php';
			</script>
		");
	}
	//주문관리 선택 삭제
	if($mode == "delivery_all"){
		
		$chk= $_POST['ch'];
		for($i=0;$i<count($chk);$i++){ 
			$order_id = $chk[$i];
			$sql = "delete from orders where order_id = $order_id";
			mysql_query($sql,$connect);
	  }
		mysql_close();

		echo ("
			<script>
				location.href='../delivery/delivery.php';
			</script>
		");
	}

	$isbn = $_GET['isbn'];
	//제품관리 삭제
	if($mode == "book"){
		$sql = "delete from books where isbn = $isbn";
		mysql_query($sql,$connect);

		mysql_close();

		echo ("
			<script>
				location.href='../management/mangement.php';
			</script>
		");
	}
	//제품관리 선택 삭제
	if($mode == "book_all"){
		$chk= $_POST['ch'];
		for($i=0;$i<count($chk);$i++){ 
			$isbn = $chk[$i];
			$sql = "delete from books where isbn = $isbn";
			mysql_query($sql,$connect);
	  }
		mysql_close();

		echo ("
			<script>
				location.href='../management/mangement.php';
			</script>
		");
	}
?>