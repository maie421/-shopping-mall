<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/full.css" rel="stylesheet">
<link href="/css/mypage.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/side_menu.css" rel="stylesheet">
</head>
<body>
<? include "../lib/top_menu.php";?>
<? include "../lib/mypage_side_menu.php";?>
  <div id="notice_main">
     <div id="notice_main_title">반품내역</div>
    <table>
      <tr>
        <th id="buy_name">접수일</th>
        <th id="buy_name">반품시한</th>
        <th id="buy_name">원주문번호</th>
        <th id="buy_book">주문상품</th>
				<th id="buy_name">회송방법</th>
				<th id="buy_name">환불방법</th>
				<th id="buy_name">처리상태</th>
      </tr>
      <tr>
        <td id="buy_name">2018.02.31</td>
        <td id="buy_name">잘못시킴</td>
				<td id="buy_name">123213213123</td>
        <td id="buy_book">php프로그래밍입문</td>
				<td id="buy_name">택배</td>
				<td id="buy_name">카드</td>
				<td id="buy_name">미완료</td>
      </tr>
    </table>
  </div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>