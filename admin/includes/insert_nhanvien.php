<div class="form_box">
    <h2>Thêm tài khoản nhân viên</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form action="" method="post" enctype="multipart/form-data">

        <table align="center" width="100%">
            <tr>
                <td><b>Họ tên nhân viên:</b></td>
                <td><input type="text" name="HoTenNV" size="60" required /></td>
            </tr>

            <tr>
                <td><b>Mã số nhân viên: </b></td>
                <td><input type="text" name="MSNV" required /></td>
            </tr>


            <tr>
                <td><b>Chức vụ:</b></td>
                <td><input type="text" name="ChucVu" required /></td>
            </tr>

            <tr>
                <td><b>Địa chỉ: </b></td>
                <td><input type="text" name="DiaChi" require /></td>
            </tr>


            <tr>
                <td valign="top"><b>Số điện thoại:</b></td>
                <td><input type="text" name="SoDienThoai" /></td>
            </tr>

            <tr>
                <td valign="top"><b>UsernameNV:</b></td>
                <td><input type="text" name="usernamenv" /></td>
            </tr>
            <tr>
                <td valign="top"><b>Mật khẩu:</b></td>
                <td><input type="password" name="passwordnv"></td>
            </tr>
            <tr>
                <td><b>Vai trò:</b></td>
                <td>
                    <select name="role">
                        <option>Chọn vai trò</option>
                        <option value='NhanVien' selected>Nhân viên</option>
                        <option value='Admin' selected>Admin</option>
                    </select>
                </td>
            </tr>

            <tr>

                <td colspan="7" class="text-center"> <input type="submit" class="btn-submit" name="insert_post"
                        value="Thêm tài khoản">
                </td>

            </tr>
        </table>

    </form>

</div><!-- /.form_box -->

<?php

if (isset($_POST['insert_post'])) {
    $HoTenNV = $_POST['HoTenNV'];
    $MSNV = $_POST['MSNV'];
    $DiaChi = $_POST['DiaChi'];
    $ChucVu = $_POST['ChucVu'];
    $SoDienThoai = $_POST['SoDienThoai'];
    $usernamenv = $_POST['usernamenv'];
    $passwordnv = $_POST['passwordnv'];
    $hash_password = md5($passwordnv);

    $role = $_POST['role'];
    $insert_nhanvien = " insert into nhanvien (MSNV, HoTenNV, ChucVu, DiaChi, SoDienThoai)
       values ('$MSNV','$HoTenNV','$ChucVu','$DiaChi','$SoDienThoai') ";

    $insert_nhanvien = mysqli_query($con, $insert_nhanvien);

    $insert_nhanviendangnhap = " insert into nhanviendangnhap (MSNV, usernamenv, passwordnv, role)
    values ('$MSNV','$usernamenv','$hash_password','$role') ";

    $insert_nhanviendangnhap = mysqli_query($con, $insert_nhanviendangnhap);

    if ($insert_nhanvien & $insert_nhanviendangnhap) {
        echo "<script>alert('Thêm nhân viên thành công!')</script>";
    } else {
        echo "<script>alert('Mã số nhân viên đã có trong hệ thống!')";
    }
}
?>