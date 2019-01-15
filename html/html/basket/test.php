	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>

  $(function(){

      $("#basket_delete").click(function(){

          $("input[name=check]:checked").each(function(){

               $(this).parent().parent().next().remove();

              $(this).parent().parent()s.remove();
							
								<? /*echo("location.href ='../db/basket_delete.php'; ");*/ ?>
<? /*unset($_SESSION['cart'][$("#check").val();]);*/?>
      //var value = '@Request.RequestContext.HttpContext.Session["cart"][<? echo $new?>]';
	  //var value = $("#check").val();
			//document.write(value);
			
			//sessionStorage.removeItem('cart');
          });

      })

  });   
</script>
	<!--
	<script>/*
	//반복실행하면서 체크된 것만 삭제 ,php문
for ($i=0; $i<sizeof($selectcheck); $i++){
       $sql = "DELETE from message WHERE me_id=$selectcheck[$i]";
       echo $sql;
}*/
	function checkbox(){
		/*
    var arr_chk = document.getElementsByName("check[]");
	document.write("value");
    for(var i=0;i<arr_chk.length;i++){
		if(arr_chk[i].checked == true) {
			//console.log(document.getElementsByName("check")[i].value+"(체크)");
			var value = arr_chk[i].value;
			document.write("value");
			//<? echo("this.document.location ='../db/basket_delete.php?value=arr_chk[i].value'; "); ?>
        }
    }*/
		document.checkbox01.submit();
	}
    </script>-->
		<script>
function check01(){
	document.checkbox01.submit();
	/*
	var ret = confirm('탈퇴하시겠습니까?');
	if(ret == true){
		<? echo("this.document.location ='../db/withdrawal.php'; "); ?> 
	}*/
}
</script>