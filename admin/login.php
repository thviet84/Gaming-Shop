<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <title>Log In</title>

    <link rel="stylesheet" href="styles/admin_form_login.css" />

</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">

        <h2>Admin
        </h2>

        <input type="text" name="email" class="text-field" placeholder="Email" />
        <input type="password" name="password" class="text-field" placeholder="Password" />

        <input type="submit" name="login" class="button" value="Log In" />

    </form>

</body>

<?php

include 'includes/db.php';

if (isset($_POST['login'])) {

    $email = trim(mysqli_real_escape_string($con, $_POST['email']));

    $password = trim(mysqli_real_escape_string($con, $_POST['password']));

    $hash_password = md5($password);

    $sel_user = "select * from nhanviendangnhap where usernamenv ='$email' AND passwordnv='$hash_password' ";

    $run_user = mysqli_query($con, $sel_user) or die("error: " . mysqli_error($con));

    $check_user = mysqli_num_rows($run_user);

    if ($check_user > 0) {

        $db_row = mysqli_fetch_array($run_user);

        $_SESSION['usernamenv'] = $db_row['usernamenv'];
        $_SESSION['user_id'] = $db_row['MSNV'];

        echo "<script>window.open('index.php?logged_in=Đăng nhập thành công!','_self')</script>";
    } else {
        echo "<script>alert('Mật khẩu tài khoản sai !')</script>";
    }
}
?>