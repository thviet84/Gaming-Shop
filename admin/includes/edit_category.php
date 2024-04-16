<?php
$edit_cat = mysqli_query($con, "select * from nhomhanghoa where MaNhom='$_GET[cat_id]'");

$fetch_cat = mysqli_fetch_array($edit_cat);

?>


<div class="form_box">

    <form action="" method="post" enctype="multipart/form-data">

        <table align="center" width="100%">

            <tr>
                <td colspan="7">
                    <h2>Sửa nhóm sản phẩm</h2>
                    <div class="border_bottom"></div>
                    <!--/.border_bottom -->
                </td>
            </tr>

            <tr>
                <td><b>Sửa nhóm sản phẩm:</b></td>
                <td><input type="text" name="product_cat" value="<?php echo $fetch_cat['TenNhom']; ?>" size="60"
                        required /></td>
            </tr>

            <tr>
                <td></td>
                <td colspan="7"><input type="submit" name="edit_cat" value="Save" /></td>
            </tr>
        </table>

    </form>

</div><!-- /.form_box -->

<?php

if (isset($_POST['edit_cat'])) {

	$cat_title = mysqli_real_escape_string($con, $_POST['product_cat']);

	$edit_cat = mysqli_query($con, "update nhomhanghoa set TenNhom='$cat_title' where MaNhom='$_GET[cat_id]'");

	if ($edit_cat) {
		echo "<script>alert('Product category was updated successfully!')</script>";

        echo "<script>window.open('index.php?action=view_cat','_self')</script>";
	}
}
?>