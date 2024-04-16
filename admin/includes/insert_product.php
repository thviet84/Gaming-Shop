<div class="form_box">
    <h2>Thêm sản phẩm</h2>
    <div class="border_bottom"></div>

    <form action="" method="post" enctype="multipart/form-data">

        <table align="center" width="100%">
            <tr>
                <td><b>Tên sản phẩm:</b></td>
                <td><input type="text" name="TenHH" size="60" required /></td>
            </tr>

            <tr>
                <td><b>Nhóm hàng hóa:</b></td>
                <td>
                    <select name="MaNhom">
                        <option>Chọn nhóm</option>

                        <?php
                        $get_cats = "select * from nhomhanghoa";

                        $run_cats = mysqli_query($con, $get_cats);

                        while ($row_cats = mysqli_fetch_array($run_cats)) {
                            $cat_id = $row_cats['MaNhom'];
                            $cat_title = $row_cats['TenNhom'];
                            echo "<option value='$cat_id'>$cat_title</option>";
                        }
                        ?>
                    </select>
                </td>

            </tr>

            <tr>
                <td><b>Mã số hàng hóa: </b></td>
                <td><input type="text" name="MSHH" required /></td>
            </tr>

            <tr>
                <td><b>Giá: </b></td>
                <td><input type="text" name="Gia" required /></td>
            </tr>

            <tr>
                <td><b>Số lượng hàng: </b></td>
                <td><input type="text" name="SoLuongHang" required /></td>
            </tr>

            <tr>
                <td><b>Hình ảnh: </b></td>
                <td><input type="file" name="Hinh" require /></td>
            </tr>


            <tr>
                <td valign="top"><b>Mô tả sản phẩm:</b></td>
                <td><textarea name="MoTaHH" rows="15"></textarea></td>
            </tr>

            <tr>
                <!-- <td colspan="7"> <button type="submit" name="insert_post" class="bnt btn-primary">Thêm sản phẩm</button>
				</td> -->
                <td colspan="7" class="text-center"><input type="submit" class="btn-submit" name="insert_post"
                        value="Thêm sản phẩm" />
                </td>

            </tr>
        </table>

    </form>

</div><!-- /.form_box -->

<?php

if (isset($_POST['insert_post'])) {
    $TenHH = $_POST['TenHH'];
    $MSHH = $_POST['MSHH'];
    $SoLuongHang = $_POST['SoLuongHang'];
    $MaNhom = $_POST['MaNhom'];
    $Gia = $_POST['Gia'];
    $MoTaHH = trim(mysqli_real_escape_string($con, $_POST['MoTaHH']));

    // Getting the image from the field
    $Hinh  = $_FILES['Hinh']['name'];
    $product_image_tmp = $_FILES['Hinh']['tmp_name'];

    move_uploaded_file($product_image_tmp, "product_images/$Hinh");

    $insert_product = " insert into hanghoa (MSHH, TenHH, Gia, SoLuongHang, MaNhom, Hinh, MoTaHH)
   values ('$MSHH','$TenHH','$Gia','$SoLuongHang','$MaNhom','$Hinh','$MoTaHH') ";

    $insert_pro = mysqli_query($con, $insert_product);

    if ($insert_pro) {
        echo "<script>alert('Product Has Been inserted successfully!')</script>";

        //echo "<script>window.open('index.php?insert_product','_self')</script>";
    }
}
?>