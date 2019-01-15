<?php
require_once './dbconfig.php';
header('Content-type:text/html; charset=utf-8');
session_start();

//장바구니 총합계 구하는 함수
function sum_price($cart){
    $price = 0;
    if(is_array($cart)){
        foreach($cart as $isbn =>$qty){
            $sql = "select price from books where isbn ='".$isbn."'";
            $db = db_conn();
            $result = $db->query($sql);
            if($result){
                $item =$result->fetch_object();
                $item_price = $item->price;
                $price +=$item_price*$qty;
            }
        }
    }
    return $price;
}

//장바구니 총수량을 구하는 함수
function sum_items($cart){
    $items = 0;
    if(is_array($cart)){
        foreach($cart as $isbn =>$qty){
            $items +=$qty;
        }
    }
    return $items;
}


// -----------------------------------------------------------------------------------------
//추가할 상품이 있는 경우(장바구니 버튼을 클릭했을 때)
// -----------------------------------------------------------------------------------------
if(isset($_GET['new'])){
    $new = $_GET['new'];
    
    if($new){
        if(!isset($_SESSION['cart'])){
            //등록된 세션 변수가 없으면 세션변수를 등록
            $_SESSION['cart'] = array();
            //상품갯수
            $_SESSION['items'] = 0;
            $_SESSION['total_price']=0;
        }
        
        //장바구니에 똑같은 상품이 있는 경우
        if(isset($_SESSION['cart'][$new])){
            $_SESSION['cart'][$new]++;
        }else{ //장바구니에 새롭게 추가된 상품인 경우
            $_SESSION['cart'][$new] = 1;
        }
        
        //전체 상품 수량 합계 구하기
        $_SESSION['items'] = sum_items($_SESSION['cart']);
        
        // 장바구니 총합계 구하기        
        $_SESSION['total_price'] = sum_price($_SESSION['cart']);
        
    } // End if($new){

}//End if(isset($_GET['new'])){

// -----------------------------------------------------------------------------------------
//  현재 장바구니 페이지에서 refresh 버튼을 클릭했을 때 수량 및 총합계를 재계산
// -----------------------------------------------------------------------------------------
if(isset($_POST['refresh'])){
    foreach($_SESSION['cart'] as $isbn => $qty){
        if($_POST[$isbn] =='0'){
            unset($_SESSION['cart'][$isbn]);
        }else{
            $_SESSION['cart'][$isbn] = $_POST[$isbn];
        }
    } // End of foreach문    
    
    // 총수량 재계산-----------------------   
      $_SESSION['items'] = sum_items($_SESSION['cart']);
    // 총합계 재계산-----------------------
     $_SESSION['total_price'] = sum_price($_SESSION['cart']); 
}

require_once './header.php';

// 장바구니 내역 제목
echo "<h3>당신의 장바구니 내역</h3>";
//session_unset();

// -----------------------------------------------------------------------------------------
// [ 장바구니 보기 ] 버튼을 클릭했을 때
// -----------------------------------------------------------------------------------------
if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
    //장바구니에 추가된 상품이 있는 경우에는 화면에 상품을 출력
    show_cart($_SESSION['cart']);
}else{
    echo "<p>장바구니에 담긴 상품이 없습니다!!!</p>";
}

// -----------------------------------------------------------------------------------------
// 버튼(쇼핑하기, 구매하기) 추가하기 
// -----------------------------------------------------------------------------------------
//장바구니 보기 버튼을 클릭하고 들어왔을 경우 쇼핑하기 버튼을 클릭하면 index.php로 이동한다.
//show_book.php 페이지에서 장바구니 버튼을 클릭하고 들어왔을 경우에는 show_category.php 로 이동한다.
$url = "index.php";

if(isset($new)){
    $sql2="select cat_id from books where isbn='".$new."'";
    $db = db_conn();
    $result2 = $db->query($sql2);
    if($result2){
        $obj = $result2->fetch_object();
        $cat_id = $obj->cat_id;
        $url = "show_category.php?cat_id=".$cat_id;
    }
}

if(isset($_SESSION['cart'])){
    echo "<div align='center'>"
        . "<a href='".$url."'><img src='img/continue_shopping.png'></a> "
        . " <a href='checkout.php'><img src='img/buy.png'></a>"
        . "</div>";
}else{
    echo "<div align='center'>"
        . "<a href='".$url."'><img src='img/continue_shopping.png'></a> "
        . "</div>";
}


//------------------------------------------------------------------------------------
require_once './footer.php';
?>

