<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

<?php include 'includes/db.php';
    ?>

<!DOCTYPE html><!-- HTML5 Declaration -->

<html>

<head>
    <title>Gaming Shop admin</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="styles/desktop.css" type="text/css" rel="stylesheet">

    </script>


    <head>

    <body>
        <div class="header">
            <div class="navbar-header">
                <h3><a class="admin_name">Tiệm bánh Ngọt</a></h3>
            </div><!-- /.navbar-header -->

            <div class="navbar-right-header">

                <ul class="dropdown-navbar-right">
                    <li>
                    <li><a href="logout.php">Đăng xuất</a></li>
                    </li>
                </ul>

            </div><!-- /.navbar-right-header -->

        </div><!-- /.header -->

        <div class="body_container">
            <div class="left_sidebar">
                <ul class="left_sidebar_first_level">

                    <li><a href="../index.php" target="_blank"><i class="fa fa-dashboard"></i> My Site</a></li>

                    <li>
                        <a href="#"><i class="fa fa-th-large"></i>&nbsp;Sản phẩm <i
                                class="arrow fa fa-angle-left"></i></a>

                        <ul class="left_sidebar_second_level">
                            <li><a href="index.php?action=add_pro">Thêm sản phẩm</a></li>
                            <li><a href="index.php?action=view_pro">Xem sản phẩm</a></li>
                        </ul><!-- /.left_sidebar_second_level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-plus"></i>&nbsp;Nhóm sản phẩm<i
                                class="arrow fa fa-angle-left"></i></a>

                        <ul class="left_sidebar_second_level">
                            <li><a href="index.php?action=add_cat">Thêm nhóm</a></li>
                            <li><a href="index.php?action=view_cat">Xem nhóm</a></li>
                        </ul><!-- /.left_sidebar_second_level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-gift"></i>&nbsp;Admin <i class="arrow fa fa-angle-left"></i></a>

                        <ul class="left_sidebar_second_level">
                            <li><a href="index.php?action=add_user">Thêm nhân viên</a></li>
                            <li><a href="index.php?action=view_nhanvien">Danh sách nhân viên</a></li>
                            <li><a href="index.php?action=view_users">Danh sách người dùng</a></li>
                        </ul><!-- /.left_sidebar_second_level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-gift"></i>&nbsp;Đơn hàng <i class="arrow fa fa-angle-left"></i></a>

                        <ul class="left_sidebar_second_level">
                            <li><a href="index.php?action=check_cart">Duyệt đơn hàng</a></li>

                        </ul><!-- /.left_sidebar_second_level -->
                    </li>

                </ul><!-- /.left_sidebar_first_level -->
            </div><!-- /. -->

        </div><!-- /.left_sidebar -->
        <div class="container">
            <div class="content">
                <div class="content_box">
                    <?php
                        if (isset($_GET['action'])) {
                            $action = $_GET['action'];
                        } else {
                            $action = '';
                        }

                        switch ($action) {
                            case 'add_pro';
                                include 'includes/insert_product.php';
                                break;

                            case 'view_pro';
                                include 'includes/view_products.php';
                                break;

                            case 'edit_pro';
                                include 'includes/edit_product.php';
                                break;

                            case 'add_cat';
                                include 'includes/insert_category.php';
                                break;

                            case 'view_cat';
                                include 'includes/view_categories.php';
                                break;

                            case 'edit_cat';
                                include 'includes/edit_category.php';
                                break;

                            case 'view_users';
                                include 'includes/view_users.php';
                                break;
                            case 'view_nhanvien';
                                include 'includes/view_nhanvien.php';
                                break;
                            case 'check_cart';
                                include 'includes/check_cart.php';
                                break;
                        }

                        ?>
                </div><!-- /.content_box -->

            </div><!-- /.content -->

        </div><!-- /.body_container -->

        </div><!-- /.container -->

    </body>

</html>




<?php } // End else 
?>