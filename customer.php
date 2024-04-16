<?php
include "functions/functions.php";
include "functions/db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/resetcss.css" media="all">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://kit.fontawesome.com/f724e98ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="styles/style_customer.css" media="all">
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
            <a href="index.php">Trang Chủ</a>
            <a href="customer.php?action=edit_profile">Chỉnh sửa thông tin</a>
            <a href="customer.php?action=change_password">Đổi mật khẩu</a>
            <a href="customer.php?action=delete_account">Xóa tài khoản</a>
            <a href="logout.php">Đăng xuất</a>
        </div>

        <div class="page-container">
            <div class="page-wrapper">
                <div class=""></div>
                <!-- -->
                <!--Profile Card-->
                <?php
                if (isset($_GET['action'])) {
                    $action = $_GET['action'];
                } else {
                    $action = '';
                }

                switch ($action) {

                    case "edit_profile";
                        include('customer/edit_profile.php');
                        break;

                    case "user_profile_picture";
                        include('customer/user-profile-picture.php');
                        break;

                    case "change_password";
                        include('customer/change_password.php');
                        break;

                    case "delete_account";
                        include('customer/delete_account.php');
                        break;

                }

                ?>
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