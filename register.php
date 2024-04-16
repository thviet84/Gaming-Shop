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
        <!--  -->

        <script>
        $(document).ready(function() {

            $("#password_confirm2").on('keyup', function() {

                var password_confirm1 = $("#password_confirm1").val();

                var password_confirm2 = $("#password_confirm2").val();

                //alert(password_confirm2);

                if (password_confirm1 == password_confirm2) {

                    $("#status_for_confirm_password").html(
                        '<strong style="color:green">Password match</strong>');

                } else {
                    $("#status_for_confirm_password").html(
                        '<strong style="color:red">Password do not match</strong>');

                }

            });

        });
        </script>

        <div class="login-sign">
            <h5>Đăng kí tài khoản</h5>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="group-input">
                    <label for="inputEmail">Họ và tên</label>
                    <br>
                    <input type="text" name="name" placeholder="Họ và tên" required autofocus>
                </div>

                <div class="group-input">
                    <label for="inputEmail">Username</label>
                    <br>
                    <input type="text" name="usernamekh" placeholder="Username" required autofocus>
                </div>

                <div class="group-input">
                    <label for="inputPassword">Mật khẩu</label>
                    <br>
                    <input type="password" id="password_confirm1" name="passwordkh" placeholder="Password" required>
                </div>
                <div class="group-input">
                    <label for="inputPassword">Nhập lại mật khẩu</label>
                    <br>
                    <input type="password" id="password_confirm2" name="confirm_password" placeholder="Password"
                        required>
                    <p id="status_for_confirm_password"></p>
                </div>
                <div class="group-input">
                    <label for="inputEmail">Số điện thoại</label>
                    <br>
                    <input type="text" name="phone" placeholder="0123456789" required autofocus>
                </div>
                <div class="group-input">
                    <label for="inputEmail">Địa chỉ</label>
                    <br>
                    <input type="text" name="address" placeholder="Địa chỉ" required autofocus>
                </div>

                <div>
                    <button type="submit" name="register" class="sign-in">Đăng kí</button>
                </div>

            </form>

        </div>

        <?php
        if (isset($_POST['register'])) {

            if (!empty($_POST['usernamekh']) && !empty($_POST['passwordkh']) && !empty($_POST['confirm_password']) && !empty($_POST['name'])) {
                $ip = get_ip();
                $name = $_POST['name'];
                $usernamekh = trim($_POST['usernamekh']);
                $passwordkh = trim($_POST['passwordkh']);
                $hash_password = md5($passwordkh);
                $confirm_password = trim($_POST['confirm_password']);
                $phone = $_POST['phone'];
                $address = $_POST['address'];

                $check_exist = mysqli_query($con, "select * from khachhangdangnhap where usernamekh = '$usernamekh'");

                $usernamekh_count = mysqli_num_rows($check_exist);

                $row_register = mysqli_fetch_array($check_exist);

                if ($usernamekh_count > 0) {
                    echo "<script>alert('Sorry, your username $usernamekh already exist in our database !')</script>";
                } elseif ($row_register['usernamekh'] != $usernamekh && $passwordkh == $confirm_password) {

                    $userid = UserID();
                    $run_insertkh = mysqli_query($con, "insert into khachhang (DiaChi,HoTenKH,MSKH,SoDienThoai) values ('$address','$name','$userid','$phone')");
                    $run_insertdn = mysqli_query($con, "insert into khachhangdangnhap(usernamekh, passwordkh,MSKH) values('$usernamekh','$hash_password','$userid')");
                    echo "Thanh cong roi";
                    if ($run_insertkh && $run_insertdn) {
                        $sel_user = mysqli_query($con, "select * from khachhangdangnhap where usernamekh='$usernamekh' ");
                        $row_user = mysqli_fetch_array($sel_user);

                        $_SESSION['user_id'] = $row_user['id'] . "<br>";
                        $_SESSION['role'] = $row_user['role'];
                    }

                    $run_cart = mysqli_query($con, "select * from khachhangdangnhap where usernamekh='$usernamekh'");

                    $check_cart = mysqli_num_rows($run_cart);

                    if ($check_cart == 0) {

                        $_SESSION['usernamekh'] = $usernamekh;

                        echo "<script>alert('Account has been created successfully!')</script>";

                        echo "<script>window.open('customer/my_account.php','_self')</script>";
                    } else {

                        $_SESSION['usernamekh'] = $usernamekh;

                        echo "<script>alert('Account has been created successfully!')</script>";

                        echo "<script>window.open('login.php','_self')</script>";
                    }
                }
            }
        }

        ?>


        <!-- End PHP -->

</body>

</html>