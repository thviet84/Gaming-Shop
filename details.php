<?php
include "functions/functions.php";
include "functions/db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" type="text/css" href="styles/reset.css" media="all"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://kit.fontawesome.com/f724e98ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="styles/style_details.css" media="all">

    <title>Gaming Shop</title>
</head>

<body>
    <div class="main-wrapper">
        <div class="navigation-bar">
            <div class="logo">
                <a href="/GamingShop/index.php"><img src="images/logos/logo.jpg" alt="Cake"></a>
            </div>

            <div class="name-shop">
                <h3>Gaming Shop</h3>
            </div>

            <div class="user">
                <div class="actionhotline">
                    <i class="fas fa-mobile"> </i> <span class="phone-number"> Đặt hàng: 0868224463 </span>
                </div>
            </div>
        </div>

        <div class="side-nav">
            <ul>
                <?php
                if (!isset($_SESSION['user_id'])) {
                    echo "
                    <li><a href='login.php'><i class='far fa-user'></i>Đăng nhập</a></li>
                    ";
                } else {
                    echo "
                    <li><a href='logout.php'><i class='far fa-user'></i>Đăng xuất</a></li>
                    ";
                }
                ?>

                <li><a href="cart.php"><i class="fas fa-cube"></i>Giỏ hàng</a></li>
                <li><a href="my_order.php"><i class="fas fa-money-bill"></i>Đơn hàng của tôi</a></li>
                <li><a href="index.php"><i class="fas fa-align-justify"></i>Tất cả sản phẩm</a></li>
                <li><a href="#"><i class="far fa-address-card"></i>Liên hệ</a></li>
            </ul>

        </div>

        <div class="page-container">
            <div class="page-wrapper">
                <div class="">
                    <div class="collapse navbar-collapse" id="bs-main-navbar-collapse-1" style="position: relative;">
                        <ul class="topbar">
                            <?php
                            getCats();
                            ?>
                        </ul>
                        <div class="right-banner-desktop" style="float:right;height: 32px;">
                        </div>
                    </div>
                </div>

                <!-- -->
                <!-- Start details -->
                <div class="container">
                    <div class="product-images">
                        <div class='images'>
                            <?php
                            if (isset($_GET['pro_id'])) {
                                $product_id = $_GET['pro_id'];

                                $run_query_by_pro_id = mysqli_query($con, "select * from hanghoa where MSHH='$product_id' ");

                                while ($row_pro = mysqli_fetch_array($run_query_by_pro_id)) {

                                    $pro_id = $row_pro['MSHH'];
                                    $pro_title = $row_pro['TenHH'];
                                    $pro_price = number_format($row_pro['Gia']);
                                    $pro_soluong = $row_pro['SoLuongHang'];
                                    $pro_cat = $row_pro['MaNhom'];
                                    $pro_image = $row_pro['Hinh'];
                                    $pro_description = $row_pro['MoTaHH'];
                                    $old_price = number_format($row_pro['Gia'] * 10 / 100);
                                    echo "
						        <img src='/GamingShop/admin/product_images/$pro_image' alt='$pro_title'>
        				        ";
                                }
                            }
                            ?>
                        </div>
                    </div><!-- /#products_box -->

                    <div class='product-details'>
                        <h5><?php echo "$pro_title"; ?></h5>
                        <hr>
                        <br>
                        <p class='product-id'> Mã sản phẩm: <?php echo "$pro_id"; ?></p>
                        <h4 class='product-count'>Số lượng còn: <?php echo "$pro_soluong"; ?></h4>
                        <h2 class='product-price'><?php echo "$pro_price"; ?> VND</h2>
                        <h3 class='des'>MÔ TẢ</h3>
                        <p class='product-des'>
                            <?php echo nl2br($pro_description); ?>
                        </p>
                        <hr>
                        <div class="text-center">
                            <button onclick="window.location.href='index.php?add_cart=<?php echo "$pro_id"; ?> ';"
                                class="bnt btn-primary btn-chonmua">CHỌN MUA</button>
                        </div>
                    </div>
                    <script>
                    function myFunction() {
                        alert("Hello! I am an alert box!");
                    }
                    </script>
                </div>
                <br>
                <h2>Sản phẩm tương tự</h2>
                <div class="container">
                    <?php
                    details_show_pro_of_cat($pro_cat);
                    cart();
                    ?>
                </div>

                <!-- End Details -->
            </div>
            <!-- End page container -->
        </div> <!-- End main_wrapper-->
        <!-- Footer -->
        <footer class="footer">
            <!-- Copyright -->
            <div class="footer-copyright text-center p-4 footer-div">
                <i>Địa chỉ: Số 113 Đường 3/2, Phường Hưng Lợi, Quận Ninh Kiều, TP.Cần Thơ  </i>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
                
</body>

</html>