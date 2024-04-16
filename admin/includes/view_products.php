<div class="view_product_box">

    <h2>Xem sản phẩm</h2>
    <div class="border_bottom"></div>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="search_bar">
            <input type="text" id="search" placeholder="Type to search..." />
        </div>

        <table width="100%">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Hình</th>
                    <th>Mô tả</th>
                    <th>Số lượng</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <?php
            $all_products = mysqli_query($con, "select * from hanghoa order by MSHH DESC ");

            $i = 1;

            while ($row = mysqli_fetch_array($all_products)) {
            ?>

            <tbody>
                <tr>

                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['TenHH']; ?></td>
                    <td><?php echo $row['Gia']; ?></td>

                    <td><img src="/GamingShop/admin/product_images/<?php echo $row['Hinh']; ?>" width="70"
                            height="50" /></td>
                    <td><?php echo $row['MoTaHH']; ?></td>
                    <td><?php echo $row['SoLuongHang']; ?></td>

                    <td><a class="btn btn-danger btn-submit btn-sm"
                            href="index.php?action=view_pro&delete_product=<?php echo $row['MSHH']; ?>">Delete</a>
                    </td>
                    <td><a class="btn btn-primary btn-submit btn-sm"
                            href="index.php?action=edit_pro&product_id=<?php echo $row['MSHH']; ?>">Edit</a></td>
                </tr>
            </tbody>

            <?php $i++;
            } // End while loop 
            ?>
        </table>

    </form>

</div><!-- /.view_product_box -->

<?php
// Delete Product

if (isset($_GET['delete_product'])) {
    $delete_product = mysqli_query($con, "delete from hanghoa where MSHH='$_GET[delete_product]' ");

    if ($delete_product) {
        echo "<script>alert('Product has been deleted successfully!')</script>";

        echo "<script>window.open('index.php?action=view_pro','_self')</script>";
    }
}

?>