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

<?php
$select_user = mysqli_query($con, "select * from khachhangdangnhap where usernamekh='$_SESSION[user_id]' ");

$fetch_user = mysqli_fetch_array($select_user);
?>

<div class="form_box">
    <h2>Đổi mật khẩu</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form method="post" action="" enctype="multipart/form-data">
        <table class="text-center" align="center" width="100%">
            <tr>
                <td colspan="7">

                </td>
            </tr>

            <tr>
                <td><b>Mật Khẩu Cũ:</b></td>
                <td><input type="password" name="passwordkh" size="100%" required placeholder="Current Password" /></td>
            </tr>

            <tr>
                <td><b>Mật Khẩu Mới:</b></td>
                <td><input type="password" id="password_confirm1" name="new_password" size="100%" required
                        placeholder="New Password" /></td>
            </tr>

            <tr>
                <td><b>Nhập Lại Mật Khẩu Mới:</b></td>
                <td><input type="password" id="password_confirm2" name="confirm_new_password" size="100%" required
                        placeholder="Re-Type New Password" />
                    <p id="status_for_confirm_password"></p><!-- Showing validate password here -->
                </td>
            </tr>

            <tr>
                <td></td>
                <td colspan="7" class="text-center">
                    <input type="submit" class="btn btn-primary btn-submit" name="change_password"
                        value="Lưu mật khẩu" />
                </td>
            </tr>
        </table>
    </form>

</div>

<?php
if (isset($_POST['change_password'])) {

    $passwordkh = trim($_POST['passwordkh']);
    $hash_current_password = md5($passwordkh);

    $new_password = trim($_POST['new_password']);
    $hash_new_password = md5($new_password);
    $confirm_new_password = trim($_POST['confirm_new_password']);

    $select_password = mysqli_query($con, "select * from khachhangdangnhap where passwordkh='$hash_current_password' and MSKH='$_SESSION[user_id]' ");


    if (mysqli_num_rows($select_password) == 0) {

        echo "<script>alert('Sai mật khẩu!')</script>";
    } elseif ($new_password != $confirm_new_password) {

        echo "<script>alert('Mật khẩu không khớp!')</script>";
    } else {
        $update = mysqli_query($con, "update khachhangdangnhap set passwordkh='$hash_new_password' where MSKH='$_SESSION[user_id]' ");

        if ($update) {
            echo "<script>alert('Mật khẩu của bạn đã được cập nhật thành công!')</script>";

            echo "<script>window.open(window.location.href,'_self')</script>";
        } else {

            echo "<script>alert('Database query failed: mysqli_error($con) !')</script>";
        }
    }
}

?>