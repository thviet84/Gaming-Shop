<?php
include "functions/functions.php";
include "functions/db.php";
session_start();
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
    <title>Gaming Shop</title>
    <style>
    .footer {
        position: fixed;
    }
    </style>
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
                    <i class="fas fa-mobile"> </i> <span class="phone-number"> Đặt hàng: 00868224463 </span>
                </div>
            </div>
        </div>
        <!--  -->

        <div class="login-sign">
            <div class="login">

                <h5>Đăng nhập</h5>
                <form method="post">
                    <div class="group-input">
                        <label for="inputEmail">Username</label>
                        <br>
                        <input type="text" name="usernamekh" placeholder="Username" required autofocus>
                    </div>

                    <div class="group-input">
                        <label for="inputPassword">Mật khẩu</label>
                        <br>
                        <input type="password" name="passwordkh" placeholder="Password" required>
                    </div>

                    <div class="group-input">
                        <a href="register.php">Đăng ký nếu chưa có tài khoản</a>
                    </div>
                    <div>
                        <button type="submit" name="login" class="sign-in">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End login -->
        <!-- Start php -->
        <?php
        if (isset($_POST['login'])) {

            $usernamekh = trim($_POST['usernamekh']);
            $password = trim($_POST['passwordkh']);
            $password = md5($password);

            $run_login = mysqli_query($con, "select * from khachhangdangnhap where passwordkh='$password' AND usernamekh='$usernamekh' ");

            $check_login = mysqli_num_rows($run_login);

            $row_login = mysqli_fetch_array($run_login);

            if ($check_login == 0) {
                echo "<script>alert('Mật khẩu không đúng vui lòng thử lại!')</script>";
                exit();
            }
            $ip = get_ip();
            $MSKH = $row_login['MSKH'];
            $run_cart = mysqli_query($con, "select * from dathang where MSKH='$MSKH'");

            $check_cart = mysqli_num_rows($run_cart);

            if ($check_login > 0 and $check_cart == 0) {

                $_SESSION['user_id'] = $row_login['MSKH'];
                $_SESSION['usernamekh'] = $usernamekh;
                echo "<script>alert('You have logged in successfully !')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } else {
                $_SESSION['user_id'] = $row_login['MSKH'];

                $_SESSION['usernamekh'] = $usernamekh;
                echo "<script>alert('You have logged in successfully !')</script>";
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }

        ?>

        <!-- End PHP -->
    
</body>

</html>