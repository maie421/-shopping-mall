<html>
    <head>
        <title>Shopping Mall</title>
        <style>
            h3{ color:blue; margin:10px; }
            hr{ width:80%; text-align:center;}
        </style>
    </head>
    <body>
        <table width="100%" border="0" cellspacing="0" bgcolor="#cccccc">
            <tr>
                <td>
                    <h2>PHP 쇼핑몰 제작하기</h2>
                </td>
            </tr>
            <td align="right" valign="bottom">
            <?php
                if(isset($_SESSION['admin_id'])){
                    echo "[ <a href='./logout.php'>로그아웃</a> ]";
                }else{
                    echo "[ <a href='./show_cart.php'>장바구니 보기</a> ]";
                }
            ?>
            </td>            
        </table>

