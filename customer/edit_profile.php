<?php

$select_user = mysqli_query($con, "select * from khachhang where MSKH='$_SESSION[user_id]' ");

$fetch_user = mysqli_fetch_array($select_user);
?>

<div class="form_box">
    <h2>Chỉnh sửa thông tin tài khoản</h2>
    <div class="border_bottom"></div>

    <form method="post" action="" enctype="multipart/form-data">
        <table class="text-center" align="center" width="100%">

            <tr>
                <td>
                    <b>Họ Tên:</b>
                </td>
                <td>
                    <input type="text" name="HoTenKH" value="<?php echo $fetch_user['HoTenKH']; ?>" size="100%" required
                        placeholder="Nhập Họ Tên" />
                </td>
            </tr>

            <tr>
                <td>
                    <b>Số Điện Thoại:</b>
                </td>
                <td>
                    <input type="text" name="SoDienThoai" value="<?php echo $fetch_user['SoDienThoai']; ?>" size="100%"
                        required placeholder="Nhập Số Điện Thoại" />
                </td>
            </tr>

            <tr>
                <td>
                    <b>Địa Chỉ:</b>
                </td>
                <td>
                    <input type="text" name="DiaChi" value="<?php echo $fetch_user['DiaChi']; ?>" required size="100%"
                        placeholder="Nhập Địa Chỉ" />
                </td>
            </tr>

            <tr>
                <td colspan="4" class="text-center">
                    <input type="submit" class="btn btn-primary btn-submit" name="edit_profile" value="Lưu" />
                </td>
            </tr>

        </table>


    </form>

</div>

<?php
if (isset($_POST['edit_profile'])) {

    if ($_POST['HoTenKH'] != '' && $_POST['SoDienThoai'] != '' && $_POST['DiaChi'] != '') {


        $HoTenKH = $_POST['HoTenKH'];

        $SoDienThoai = $_POST['SoDienThoai'];
        $DiaChi = $_POST['DiaChi'];

        $update_profile = mysqli_query($con, "update khachhang set HoTenKH='$HoTenKH',SoDienThoai='$SoDienThoai', DiaChi='$DiaChi' where MSKH='$_SESSION[user_id]'");

        if ($update_profile) {
            echo "<script>alert('Cập nhật thông tin thành công!')</script>";

            echo "<script>window.open(window.location.href,'_self')</script>";
        }
    }
}

?>