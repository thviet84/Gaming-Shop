<div class="view_product_box">

    <h2>Danh sách khách hàng</h2>
    <div class="border_bottom"></div>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="search_bar">
            <input type="text" id="search" placeholder="Type to search..." />
        </div>

        <table width="100%">
            <thead>
                <tr>
                    <th class="text-center">Mã khách hàng</th>
                    <th>Họ và tên</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Delete</th>

                </tr>
            </thead>

            <?php
      $all_users = mysqli_query($con, "select * from khachhang order by MSKH DESC ");


      while ($row = mysqli_fetch_array($all_users)) {
      ?>

            <tbody>
                <tr>
                    <td class="text-center"><?php echo $row['MSKH']; ?></td>
                    <td><?php echo $row['HoTenKH']; ?></td>
                    <td><?php echo $row['DiaChi']; ?></td>
                    <td><?php echo $row['SoDienThoai']; ?></td>
                    <td><a class="btn btn-danger btn-submit btn-sm"
                            href="index.php?action=view_users&delete_user=<?php echo $row['MSKH']; ?>">Delete</a></td>
                </tr>
            </tbody>

            <?php
      } // End while loop 
      ?>
        </table>

    </form>

</div><!-- /.view_product_box -->

<?php
// Delete User Account

if (isset($_GET['delete_user'])) {
  $delete_user = mysqli_query($con, "delete from khachhangdangnhap where MSKH='$_GET[delete_user]' ");
  $delete_user1 = mysqli_query($con, "delete from khachhang where MSKH='$_GET[delete_user]' ");

  if ($delete_user&$delete_user1) {
    echo "<script>alert('User Account has been deleted successfully!')</script>";

    echo "<script>window.open('index.php?action=view_users','_self')</script>";
  }
}

?>