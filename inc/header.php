<?php 
    include 'lib/session.php';
    Session::init();
?>

<?php
    include_once('lib/database.php');
    include_once('helpers/format.php');

    spl_autoload_register(function($className) {
        include_once "classes/".$className.".php";
    });

    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $us = new user();
    $cat = new category();
    $cs = new customer();
    $product = new product();
    
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>WinX Store</title>
<!-- <base href="http://thuongmaidientu-php.test/"/> -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

<script type="text/javascript">
$(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
});
</script>


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CW80VG853N"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CW80VG853N');
</script>
</head>
<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="img/logo1.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form action="search.php" method="post">
                        <input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
                        <input type="submit" name="search_product" value="Tìm kiếm">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a style="text-decoration: none;" href="cart.php" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product">
                                <?php
                                    $check_cart = $ct->check_cart();
                                    if($check_cart) {
                                        $sum = Session::get("sum");
                                        $qty = Session::get("qty");
                                        echo $fm->format_currency($sum).'đ'.'-'.'SL:'.$qty ;
                                    }else {
                                        echo 'Empty';
                                    }
                                    
                                ?>
                            </span>
                        </a>
                    </div>
                </div>
                
                <?php
                    if(isset($_GET['customer_id'])) {
                        $delCart = $ct->del_all_data_cart();
                        Session::destroy();
                    }
                ?>
        
                <div class="login">
                    <?php
                        $login_check = Session::get('customer_login');
                        if($login_check==false) {
                            echo '<a style=" text-decoration: none;" href="login.php">Đăng nhập</a></div>';
                        }else {
                            echo '<a style=" text-decoration: none;" href="?customer_id='.Session::get('customer_id').'">Logout</a></div>';
                        }
                    ?>
                </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="menu">
        <ul id="dc_mega-menu-orange" class="nav">
        <li><a style="color: #fff; text-decoration: none;" href="index.php">Trang chủ</a></li>
        <li><a style="color: #fff; text-decoration: none;" href="topbrands.php">Thương hiệu nổi bật</a></li>
            <?php
                $check_cart = $ct->check_cart();
                if($check_cart==true) {
                    echo '<li><a style="color: #fff; text-decoration: none;" href="cart.php">Giỏ hàng</a></li>';
                }else {
                    echo '';
                }
            ?>

            <?php
                // $customer_id = Session::get('customer_id');
                // $check_order = $ct->check_order($customer_id);
                // if($check_order==true) {
                //     echo '<li><a style="color: #fff; text-decoration: none;" href="orderdetails.php">Sản phẩm đã đặt</a></li>';
                // }else {
                //     echo '';
                // }
            ?>
        
            <?php
            $login_check = Session::get('customer_login');
            if($login_check == false) {
                echo '';
            }else {
                echo '<li><a style="color: #fff; text-decoration: none;" href="profile.php">Thông tin cá nhân</a> </li>';
                echo '<li><a style="color: #fff; text-decoration: none;" href="history_order.php">Lịch sử</a> </li>';
            }
            ?>
        <li><a style="color: #fff; text-decoration: none;" href="seo.php">SEO Content</a> </li>
        <li><a style="color: #fff; text-decoration: none;" href="contact.php">Liên hệ</a> </li>
        <div class="clear"></div>
        </ul>
</div>