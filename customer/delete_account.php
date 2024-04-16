<div class="delete_account_container">

    <h1 style="text-align:left">Xác Nhận</h1>
    <hr />

    <div class="delete_account_box">

        <h4>Bạn có chắc rằng bạn muốn xóa tài khoản không ? </h4>

        <form action="" method="post">
            <input type="submit" class="yes_btn" name="yes" value="Yes" />
            <input type="submit" name="cancel" value="Cancel" />
    </div><!-- /.delete_account_box -->

</div><!-- /.delete_account_container -->

<?php
if (isset($_POST['yes'])) {


  $delete_account_2 = mysqli_query($con, "delete from khachangdangnhap where MSKH='$_SESSION[user_id]' ");


  $delete_account_1 = mysqli_query($con, "delete from khachhang where MSKH='$_SESSION[user_id]' ");

  session_destroy();

  echo "<script>alert('Tài khoản của bạn đã được xóa! ')</script>";

  echo "<script>window.open('index.php','_self')</script>";
}

if (isset($_POST['cancel'])) {

  echo "<script>window.open(window.location.href,'_self')</script>";
}
?>