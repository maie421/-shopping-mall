<?php
    function show_cart($cart, $modify= true){
        
        echo "<table border='0' width='100%' cellspacing='0'>"
                ."<form action ='show_cart.php' method='post'>"
                . "<tr><th colspan='2' bgcolor='#F1C40F'>주문하실 상품명</th>"
                        . "<th bgcolor='#F1C40F'>가격</th>"
                        . "<th bgcolor='#F1C40F'>수량</th>"
                        . "<th bgcolor='#F1C40F'>합계</th>"
                . "</tr>";
     foreach($cart as $isbn =>$qty){
         if((!$isbn) || ($isbn=='')){
             ?>
<script>
    alert("상품 번호가 존재하지 않습니다..");
    history.back();
</script>
            <?php
            exit;
         }
         $sql = "select * from books where isbn ='".$isbn."'";
         $db = db_conn();
         $result = $db->query($sql);
         if($result){
             $row = $result->fetch_array();
         }
         echo "<tr>";
         echo "<td align='left'>";
         
         //이미지를 불러오기 위한 처리
         if(file_exists("img/".$isbn.".png")){
             $size = getimagesize('img/'.$isbn.'.png');
             echo "<img src='img/".$isbn.".png' style='border: 1px solid black' width='".($size[0]/3)."' height='".($size[1]/3)."'/>";
         }else{
             echo "$nbsp;";
         }
         echo "</td>";
         
         //상품명(책제목, 저자) 불러오기
         echo "<td align='left'>"
                    . "<a href='show_book.php?isbn=".$isbn."'>".$row['title']."</a>"
                    . " 저자 : ".$row['author']."</td>"
                    . "<td align='center'>".number_format($row['price'])." 원 </td>"
                    . "<td align='center'>";
         if($modify == true){ 
                echo "<input type='text' name='".$isbn."' value='".$qty."' size='3'>";
         }else{
                echo $qty;
         }
         
         echo "</td><td align='center'>".number_format($row['price']*$qty)." 원</td></tr>\n";
     } // End of foreach문--------------------      
     // 총 합계
     echo "<tr>"
             . "<td colspan='2' bgcolor='#F1C40F'>&nbsp;</td>"
             . "<td align='center' bgcolor='#F1C40F'>&nbsp;</td>"
             . "<td align='center' bgcolor='#F1C40F'>".$_SESSION['items']."개</td>"
             . "<td align='center' bgcolor='#F1C40F'>총합계 : ".number_format($_SESSION['total_price'])." 원</td></tr>";
     // 수량 수정 후 수정된 내용을 저장하기 위한 새로 고침 버튼 추가
    if($modify == true){
        echo "<tr>"
                       . "<td colspan='5' align='right'>"
                       . "<input type='hidden' name='refresh' value='true'/>"             
                       . "<input type='submit' value='새로고침'/>"
                       . "</td>"
                . "</tr>";
    }
     echo "</form></table><hr/>";
    }
?>

