<div class="form_box">
    <h2>Duyệt đơn hàng</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form action="" method="get" enctype="multipart/form-data">


        <div class="search_bar">
            <input type="text" id="search" placeholder="Type to search..." />
        </div>

        <table align="center" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã số khách hàng</th>
                    <th>Ngày mua</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Nhân viên</th>
                    <th>Chấp nhận</th>
                    <th>Hủy</th>
                </tr>
            </thead>
            <?php
            function total_price_order($SoDonDH)
            {

                global $con;

                $total = 0;

                $run_cart = mysqli_query($con, "select * from chitietdathang where SoDonDH='$SoDonDH' ");

                while ($row = mysqli_fetch_array($run_cart)) {

                    $product_price = $row['GiaDatHang'];
                    $qty = $row['SoLuong'];

                    $values_qty = $product_price * $qty;

                    $total += $values_qty;
                }
                return $total;
            }

            $all_dathang = mysqli_query($con, "select * from dathang");


            while ($row = mysqli_fetch_array($all_dathang)) {
                $SoDonDH = $row["SoDonDH"];
                $GiaTong = total_price_order($SoDonDH);
            ?>
            <tbody>
                <tr>
                    <td class="text-center"><?php echo $row['SoDonDH']; ?></td>
                    <td><?php echo $row['MSKH']; ?></td>
                    <td><?php echo $row['NgayDH']; ?></td>
                    <td><?php echo $GiaTong; ?></td>
                    <td><?php echo $row['TrangThai']; ?></td>
                    <td><?php echo $row['MSNV']; ?></td>
                    <td>
                        <a class="btn btn-primary btn-submit btn-sm"
                            href="index.php?action=check_cart&accept=<?php echo $row['SoDonDH']; ?>">Đồng ý</a>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-submit btn-sm"
                            href="index.php?action=check_cart&cancel=<?php echo $row['SoDonDH']; ?>">Hủy</a>
                    </td>
                </tr>
            </tbody>
            <?php
            } // End while loop 
            ?>

        </table>

    </form>

</div><!-- /.form_box -->
<?php

if (isset($_GET['accept'])) {

    $MSNV = $_SESSION['user_id'];
    $update_dathang = mysqli_query($con, "update dathang set MSNV = '$MSNV', TrangThai='DaDuyet' where SoDonDH = '$_GET[accept]'");

    if ($update_dathang) {
        echo "<script>alert('Đơn hàng sẽ được vận chuyển cho khách hàng!')</script>";
        echo "<script>window.open(GamingShop/admin/index.php?action=check_cart,'_self')</script>";
    }
} else
if (isset($_GET['cancel'])) {
    $del_dathang = mysqli_query($con, "delete from dathang where SoDonDH = '$_GET[cancel]'");

    if ($del_dathang) {
        echo "<script>alert('Không chấp nhận đơn hàng đã được xóa!')</script>";

        echo "<script>window.open(GamingShop/admin/index.php?action=check_cart,'_self')</script>";
    }
}

?>