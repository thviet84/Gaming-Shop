<?php
include "functions/functions.php";
include "functions/db.php";
session_start();
?>
<?php
if (isset($_SESSION['usernamekh']) == '') {
  echo "<script>window.open('login.php','_self')</script>";
} else {
  $username = $_SESSION['usernamekh'];}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://kit.fontawesome.com/f724e98ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="styles/style_order.css" media="all">
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
            <div class="dropdown-btn1" style="font-size: 20px;">
                <p><u>Xin chào <b><?php echo"$username" ?> !</b></u></p>
            </div>
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
                <li><a href="customer.php?action=edit_profile"><i class="fas fa-align-justify"></i>Tài Khoản</a></li>
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
                <!-- Đơn hàng -->
                <div class="container">
                    <div class="order-wrapper">
                        <h5>Đơn hàng của tôi</h5>
                        <div class="table-wrapper">
                            <table>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày mua</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Nhân viên</th>
                                </tr>
                                <?php
                                load_order();
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- -->


            </div>
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