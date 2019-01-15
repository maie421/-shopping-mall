<script>
function check(){
	var ret = confirm('탈퇴하시겠습니까?');
	if(ret == true){
		<? echo("this.document.location ='../db/withdrawal.php'; "); ?> 
	}
}
</script>
<div id="main">
<div id="side_menu">
   <ul id="menu01">
      <li>나의 계정</li>
      <b><li>gold</li></b>
   </ul>
   <ul class="menu02">
      <li><span>주문내역</span></li>
      <li><a href="mypage.php">주문조회/변경/취소</a></li>
   </ul>
   <ul class="menu02">
      <li><span>회원정보관리</span></li>
      <li><a href="mypage_Information.php">개인정보수정</a></li>
      <li><a href="javascript:check();">회원탈퇴</a></li>
    </ul>
</div><!--side_menu-->