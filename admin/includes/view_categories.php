<div class="view_product_box">

    <h2>View Categories</h2>
    <div class="border_bottom"></div>

    <form action="" method="post" enctype="multipart/form-data" />

    <div class="search_bar">
        <input type="text" id="search" placeholder="Type to search..." />
    </div>

    <table width="100%">
        <thead>
            <tr>
                <th class='text-center'>Số thứ tự</th>
                <th>Mã Nhóm</th>
                <th>Tên Nhóm</th>
                <th>Xóa</th>
                <th>Chỉnh sửa</th>
            </tr>
        </thead>

        <?php
    $all_categories = mysqli_query($con, "select * from nhomhanghoa order by MaNhom DESC ");

    $i = 1;

    while ($row = mysqli_fetch_array($all_categories)) {
    ?>

        <tbody>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td><?php echo $row['MaNhom']; ?></td>
                <td><?php echo $row['TenNhom']; ?></td>

                <td><a class="btn btn-danger btn-submit btn-sm"
                        href="index.php?action=view_cat&delete_cat=<?php echo $row['MaNhom']; ?>">Xóa</a></td>
                <td><a class="btn btn-primary btn-submit btn-sm"
                        href="index.php?action=edit_cat&cat_id=<?php echo $row['MaNhom']; ?>">Chỉnh sửa</a></td>
            </tr>
        </tbody>

        <?php $i++;
    } // End while loop 
    ?>
    </table>

    </form>

</div><!-- /.view_product_box -->

<?php
// Delete Category

if (isset($_GET['delete_cat'])) {
  $delete_cat = mysqli_query($con, "delete from NHOMHANGHOA where MaNhom='$_GET[delete_cat]' ");

  if ($delete_cat) {
    echo "<script>alert('Sản phẩm được xóa thành công!')</script>";

    echo "<script>window.open('index.php?action=view_cat','_self')</script>";
  }
}
?>