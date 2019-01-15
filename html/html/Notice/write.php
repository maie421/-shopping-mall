<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>새벽서점</title>
<link href="/css/full.css" rel="stylesheet">
<link href="/css/notice.css" rel="stylesheet">
<link href="/css/side_menu.css" rel="stylesheet">
</head>
<script>
 function over(){
        document.getElementById("answer").style.display = "block";
    }
    function out(){
        document.getElementById("answer").style.display = "none";
    }
</script>
<body>
<? include "../lib/top_menu.php";?>
<? include "../lib/side_menu.php";?>
  <div id="notice_main">
    <div id="notice_main_title">1:1문의 사항</div>
    <table>
      <tr>
        <th class="notice">번호</th>
        <th class="notice_title">제목</th>
        <th class="notice">상태</th>
        <th class="notice">날짜</th>
        <th class="notice">작성자</th>
        <th class="notice">조회</th>
      </tr>
      <tr onmousedown="over()">
        <td class="notice" >1</th>
        <td class="notice_title"><a href="write_in.php">ㄴㅇㄻㄴㄹ</a><img src="/img/main/p.JPG" id="p"></td>
        <td class="notice">답변대기</td>
        <td class="notice">2018.02.31</th>
        <td class="notice">홍길동</th>
        <td class="notice">1</th>
      </tr>
    </table>
    <div id="answer" onmouseout="out()">
      가나다라ㅇㅇㅇㅇㅇㅇㅇ
      </div>
    <div class="number_page_center">
    <ul>
      <li><button class="page_btn">◀ </button></li>
      <li id="number_page"><a href="#">1</a></li>
      <li><button class="page_btn">▶ </button></li>
    </ul>
    </div>
    <div id="search">
      <select id="search_select">
        <option>제목</option>
        <option>내용</option>
        <option>작성자</option>
      </select>
      <input type="text" id="search_text">
      <button id="search_button">검색</button>
      </div><!--search-->
  </div><!--notice_main-->
</div><!--main-->
<? include "../lib/footer.php";?>
</body>
</html>