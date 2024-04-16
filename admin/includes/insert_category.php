<div class="form_box">
    <h2>Thêm nhóm</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form action="" method="post" enctype="multipart/form-data">

        <table class="text-center" align="center" width="100%">

            <tr>
                <td colspan="7">

                </td>
            </tr>

            <tr>
                <td><b>Tên nhóm:</b></td>
                <td><input type="text" name="product_cat" size="100%" required /></td>
            </tr>
            <tr>
                <td><b>Mã nhóm:</b></td>
                <td><input type="text" name="id_cat" size="100%" required /></td>
            </tr>

            <tr>
                <td colspan="7" class="text-center"><input class="btn btn-primary btn-submit" type="submit"
                        name="insert_cat" value="Thêm nhóm" /></td>
            </tr>
        </table>

    </form>

</div><!-- /.form_box -->

<?php

if (isset($_POST['insert_cat'])) {

    $product_cat = mysqli_real_escape_string($con, $_POST['product_cat']);
    $id_cat = mysqli_real_escape_string($con, $_POST['id_cat']);
    $insert_cat = mysqli_query($con, "insert into nhomhanghoa (MaNhom, TenNhom) values ('$id_cat','$product_cat') ");

    if ($insert_cat) {
        echo "<script>alert('Nhóm hàng hóa đã được thêm thành công!')</script>";

        echo "<script>window.open(window.location.href,'_self')</script>";
    }
}
?>