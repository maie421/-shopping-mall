<?php
    require_once './dbconfig.php';
    require_once './cartFun.php';
    session_start();
    
    require_once './header.php';
    echo "<h3>주문 정보 입력하기</h3>";
    if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
        show_cart($_SESSION['cart'], false);
?>        
<br/><br/>
<table border="0" width="100%" cellspacing="0" padding="5" cellpadding="10">
    <form action="purchase.php" method ="post"> <!--구매페이지 연결-->
        <tr>
            <th colspan="2" bgcolor="#ffedcc">주문자 정보</th>
        </tr>
        <tr>
            <td>이름 : </td>
            <td><input type="text" name="name" value="" maxlength="40" size="40"/></td>
        </tr>
        <tr>
            <td>우편번호 :</td>
            <td><input type="text" name="zipcode" value="" maxlength="10" size="10"/></td>
        </tr>
        <tr>
            <td>주문자 주소 : </td>
            <td><input type="text" name="address" value="" maxlength="100" size="100"/></td>
        </tr>
        
        <tr>
            <th colspan="2" bgcolor="#ffedcc">수령인 정보 (수령인이 위의 주문자일 경우 생략 무방) </th>
        </tr>
        <tr>
            <td> 수령인: </td>
            <td><input type="text" name="ship_name" value="" maxlength="40" size="40"/></td>            
        </tr>
        
        <tr>
            <td>우편번호 :</td>
             <td><input type="text" name="ship_zipcode" value="" maxlength="10" size="10"/></td>
        </tr>
        <tr>
            <td>수령인 주소 : </td>
            <td><input type="text" name="ship_address" value="" maxlength="100" size="100"/></td>
        </tr>
<?php    
    }else{
        echo "<p align='center'>주문하실 상품내역이 존재하지 않습니다!!!!</p>";
    }
    ?>
       <div align="center">
        <tr>
            <td colspan="2" align="center">
                <input type="image" src="img/buy.png" border="0"/>
                <a href="show_cart.php"><img src="img/continue_shopping.png" border="0"/></a>
            </td>
        </tr>        
       </div> 
    </form>
</table>        
<?php
   require_once("./footer.php");
?>
