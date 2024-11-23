<?php
ob_start();
include 'lib/Session.php';
Session::init();

include 'lib/Database.php';
include 'helpers/Formate.php';
spl_autoload_register(function($class){
    include_once "classess/".$class.".php";
});

$db = new Database();
$fm = new Format();
$pd = new Product();
$cat = new Category();
$ct = new Cart();
$cmr = new Customer();

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache"); 
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header("Cache-Control: max-age=2592000");

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <title>Ecommerce-MobileStore</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- CSS Links -->
    <link href="css/newstyle.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/tougle.css" rel="stylesheet" type="text/css" media="all"/>
    
    <!-- JavaScript Links -->
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script> 
    <script type="text/javascript" src="js/nav-hover.js"></script>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

    <!-- Mega Menu JS -->
    <script type="text/javascript">
        $(document).ready(function($){
            $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4', speed:'fast', effect:'fade'});
        });
    </script>

    <style>
        .sticky {
            position: fixed;
            top: 0;
            width: 78%;
            z-index: 10000;
        }

        .sticky + .content {
            padding-top: 102px;
        }

        img {
            height: 80px;
        }
    </style>

</head>
<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="./images/logo.png" alt="Logo" /></a>
            </div>
            
            <div class="header_top_right">
                <!-- Search Box -->
                <div class="search_box">
                    <form action="search.php" method="get">
                        <input type="text" value="Search for Products" name="search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}">
                        <input type="submit" name="submit" value="SEARCH">
                    </form>
                </div>

                <!-- Shopping Cart -->
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="#" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product">
                                <?php 
                                    $getData = $ct->checkCartTable();
                                    if ($getData) {
                                        $sum = Session::get("sum");
                                        $qty = Session::get("qty");
                                        echo "Rs. ". $sum . " qty: " . $qty;
                                    } else {
                                        echo "(Empty)";
                                    }
                                ?>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Logout functionality -->
                <?php 
                    if (isset($_GET['cid'])) {
                        $cmrId = Session::get("cmrId");
                        $ct->delCustomerCart();
                        $pd->delCompareData($cmrId);
                        Session::destroy();
                    }
                ?>

                <!-- Login/Logout -->
                <div class="login">
                    <?php 
                        $login = Session::get("cuslogin");
                        if ($login == false) { ?>
                            <a href="login.php">Login</a>
                        <?php } else { ?>
                            <a href="?cid=<?php echo Session::get('cmrId'); ?>">Logout</a>
                        <?php }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>

        <!-- Menu Section -->
        <div class="menu" id="myHeader">
            <ul id="dc_mega-menu-orange" style="text-transform: uppercase;" class="dc_mm-orange">
                <div class="topnav" id="myTopnav">
                    <a href="index.php">Home</a>
                    <a href="topbrands.php">Top Brands</a>

                    <!-- Cart & Payment Links -->
                    <?php 
                        $chkCart = $ct->checkCartTable();
                        if ($chkCart) { ?>
                            <a href="cart.php">Cart</a>
                            <a href="payment.php">Payment</a>
                    <?php } ?>

                    <!-- Order Details Link -->
                    <?php 
                        $cmrId = Session::get("cmrId");
                        $chkOrder = $ct->checkOrder($cmrId);
                        if ($chkOrder) { ?>
                            <a href="orderdetails.php">Order</a>
                    <?php } ?>

                    <!-- Profile Link for logged-in users -->
                    <?php 
                        if (Session::get("cuslogin")) { ?>
                            <a href="profile.php">Profile</a>
                    <?php } ?>

                    <!-- Compare Link -->
                    <?php 
                        $getPd = $pd->getCompareData($cmrId);
                        if ($getPd) { ?>
                            <a href="compare.php">Compare</a> 
                    <?php } ?>

                    <!-- Wishlist Link -->
                    <?php 
                        $chekwlist = $pd->checkWlistData($cmrId);
                        if ($chekwlist) { ?>
                            <a href="wishlist.php">Wishlist</a> 
                    <?php } ?>

                    <a href="contact.php">Contact</a>
                    <a href="javascript:void(0);" class="icon" onclick="myFunction1()">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="clear"></div>
            </ul>
        </div>

        <!-- Sticky Header Script -->
        <script>
            window.onscroll = function() { myFunction() };

            var header = document.getElementById("myHeader");
            var sticky = header.offsetTop;

            function myFunction() {
                if (window.pageYOffset > sticky) {
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticky");
                }
            }
        </script>
        
        <!-- Toggle Menu JS -->
        <script type="text/javascript" src="js/toggle.js"></script>
