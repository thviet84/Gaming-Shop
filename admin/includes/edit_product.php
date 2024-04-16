<?php
$edit_product = mysqli_query($con, "select * from hanghoa where MSHH='$_GET[product_id]' ");
$fetch_edit = mysqli_fetch_array($edit_product);
?>

<div class="form_box">
    <h2>Sửa sản phẩm</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form action="" method="post" enctype="multipart/form-data">

        <table align="center" width="100%">
            <tr>
                <td><b>Tên sản phẩm:</b></td>
                <td><input type="text" name="product_title" value="<?php echo $fetch_edit['TenHH'];  ?>" size="60"
                        required /></td>
            </tr>

            <tr>
                <td><b>Nhóm sản phẩm:</b></td>
                <td>
                    <select name="product_cat">
                        <option>Chọn nhóm</option>

                        <?php
                        $get_cats = "select * from nhomhanghoa";

                        $run_cats = mysqli_query($con, $get_cats);

                        while ($row_cats = mysqli_fetch_array($run_cats)) {
                            $cat_id = $row_cats['MaNhom'];

                            $cat_title = $row_cats['TenNhom'];

                            if ($fetch_edit['product_cat'] == $cat_id) {
                                echo "<option value='$fetch_edit[product_cat]' selected>$cat_title</option>";
                            } else {
                                echo "<option value='$cat_id'>$cat_title</option>";
                            }
                        }
                        ?>
                    </select>
                </td>

            </tr>

            <tr>
                <td valign="top"><b>Hình sản phẩm: </b></td>
                <td>
                    <input type="file" name="product_image" />
                    <div class="edit_image">
                        <img src="product_images/<?php echo $fetch_edit['Hinh']; ?>" width="100" height="70" />
                    </div>
                </td>
            </tr>

            <tr>
                <td><b>Giá sản phẩm: </b></td>
                <td><input type="text" name="product_price" value="<?php echo $fetch_edit['Gia']; ?>" required /></td>
            </tr>

            <tr>
                <td valign="top"><b>Mô tả sản phẩm:</b></td>
                <td><textarea name="product_desc" rows="10"><?php echo $fetch_edit['MoTaHH']; ?></textarea></td>
            </tr>

            <tr>
                <td colspan="5" class="text-center"><input class="btn btn-primary btn-submit" type="submit"
                        name="edit_product" value="Lưu" /></td>
            </tr>
        </table>

    </form>

</div><!-- /.form_box -->

<?php

if (isset($_POST['edit_product'])) {
    $product_title = trim(mysqli_real_escape_string($con, $_POST['product_title']));
    $product_cat = $_POST['product_cat'];
    $product_price = $_POST['product_price'];
    echo
        "$product_price";
    $product_desc = trim(mysqli_real_escape_string($con, $_POST['product_desc']));

    // Getting the image from the field
    $product_image  = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

    if (!empty($_FILES['product_image']['name'])) {

        if (move_uploaded_file($product_image_tmp, "product_images/$product_image")) {

            $update_product = mysqli_query($con, "update hanghoa set MaNhom='$product_cat', TenHH='$product_title', Gia='$product_price', MoTaHH='$product_desc',Hinh='$product_image' where MSHH='$_GET[product_id]' ");
        }
    } else {
        $update_product = mysqli_query($con, "update hanghoa set MaNhom='$product_cat', TenHH='$product_title', Gia='$product_price', MoTaHH='$product_desc' where MSHH='$_GET[product_id]' ");
        echo "update hanghoa set MaNhom='$product_cat', TenHH='$product_title', Gia='$product_price', MoTaHH='$product_desc' where MSHH='$_GET[product_id]'";
    }

    if ($update_product) {

        echo "<script>alert('Sản phẩm đã được chỉnh sửa thành công!')</script>";
        echo "<script>window.open('index.php?action=view_pro','_self')</script>";
    }
}
?>