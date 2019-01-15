<?php
session_start();
header('Content-type:text/html; charset=utf-8');

include "dbcon.php";

$check = $_POST['check'];

for($i =0 ; $i < count($check); $i++){          
  $check2 = $check[$i];
	unset($_SESSION['cart'][$check2]);
}
echo ("
		<script>
			location.href='../basket/basket.php';
		</script>
	");
?>