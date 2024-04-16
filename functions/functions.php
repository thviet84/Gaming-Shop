<?php
$con = mysqli_connect("localhost", "root", "", "quanlybanhang");
if (mysqli_connect_errno()) {
	echo "The Connection was not established: " . mysqli_connect_error();
}
function cart()
{
	global $con;

	if (isset($_GET['add_cart'])) {

		$product_id = $_GET['add_cart'];

		$ip = get_ip();

		$run_check_pro = mysqli_query($con, "select * from giohang where MSHH='$product_id'");

		if (mysqli_num_rows($run_check_pro) > 0) {
			$fetch_pro = mysqli_query($con, "select * from hanghoa where MSHH='$product_id'");

			$fetch_check_pro = mysqli_fetch_array($run_check_pro);

			$fetch_pro = mysqli_fetch_array($fetch_pro);

			$pro_title = $fetch_pro['TenHH'];
			$cart_SoLuong = (int) $fetch_check_pro['SoLuong'];
			$cart_SoLuong += 1;
			$soLuongKho = (int) $fetch_pro['SoLuongHang'];
			if ($cart_SoLuong <= $soLuongKho) {
				$run_insert_pro = mysqli_query($con, "update giohang set SoLuong = $cart_SoLuong where MSHH = '$product_id' and IP ='$ip'");

				echo "
					<script>
					window.alert('Mua hàng thành công. Vui lòng kiểm tra lại trong giỏ hàng! $cart_SoLuong');
					window.open('index.php','_self');
					</script>
					";
			}
		} else {

			$fetch_pro = mysqli_query($con, "select * from hanghoa where MSHH='$product_id'");

			$fetch_pro = mysqli_fetch_array($fetch_pro);

			$pro_title = $fetch_pro['TenHH'];

			$run_insert_pro = mysqli_query($con, "insert into giohang (MSHH,TenHH,IP,SoLuong) values ('$product_id','$pro_title','$ip',1)");

			echo "
			  <script>
			  window.alert('Mua hàng thành công. Vui lòng kiểm tra lại trong giỏ hàng !');
			  window.open('index.php','_self');
			  </script>
			  
			  ";
		}
	}
}

// 
function get_cart()
{
	global $con;

	$ip = get_ip();

	$run_carts = mysqli_query($con, "select * from giohang where IP= '$ip'");
	while ($row_carts = mysqli_fetch_array($run_carts)) {
		$cart_MSHH = $row_carts['MSHH'];
		$cart_SoLuong = $row_carts['SoLuong'];
		$run_pro = mysqli_query($con, "select * from hanghoa where MSHH='$cart_MSHH'");

		while ($row_pro = mysqli_fetch_array($run_pro)) {
			$cart_Gia = $row_pro['Gia'];
			$cart_Hinh = $row_pro['Hinh'];
			$cart_Ten = $row_pro['TenHH'];
			$cart_MoTa = $row_pro['MoTaHH'];
		}
		$cart_GiaTong = $cart_SoLuong * $cart_Gia;
		echo "
					<div class='product-shopping'>
					<div class='produc-shopping-left'>
						<img src='/GamingShop/admin/product_images/$cart_Hinh' alt='$cart_Ten'>
					</div>
					<div class='product-shopping-info'>
					<h2>$cart_Ten</h2>
						<p>$cart_MoTa</p>
					</div>
					<div class='product-shopping-right'>
						
						<div class='product-shopping-soluong'>
							<h2>Giá $cart_Gia VND</h2>
							<form method='post' action='cart.php'>
								<input type='submit' name='descrea' class='button-soluong btn btn-outline-success' value='-'>
								<input type='tel' name='input-soluong' class='btn btn-outline-success button-soluong' value='$cart_SoLuong'>
								<input type='submit' name='inscrea' class='btn btn-outline-success button-soluong' value='+'>
								<input type='submit' name='del_cart' class='btn btn-danger button-soluong' value='Xóa'>
								<input type='hidden' name='cart_MSHH' value ='$cart_MSHH'>
							</form>
						</div>
					</div>
				</div>
				";
	}
	if (mysqli_num_rows($run_carts) == 0) {
		echo "
		<div class='product-shopping'>
					<h2>Không có sản phẩm nào.</h2>
				</div>
		";
	}
}

function dathang()
{
	if (isset($_SESSION['user_id'])) {
		global $con;
		$MSKH = $_SESSION['user_id'];
		$ip = get_ip();

		$numrow = mysqli_query($con, "select * from dathang");
		$SoDonDH = mysqli_num_rows($numrow);
		$SoDonDH = $SoDonDH + 1;
		$today = date("Y-m-d H:i:s");
		$dathang = mysqli_query($con, "insert into dathang (SoDonDH, MSKH, NgayDH, TrangThai) values ('$SoDonDH','$MSKH','$today','ChuaDuyet') ");

		$run_carts = mysqli_query($con, "select * from giohang where IP= '$ip'");
		while ($row_carts = mysqli_fetch_array($run_carts)) {
			$cart_MSHH = $row_carts['MSHH'];
			$cart_SoLuong = $row_carts['SoLuong'];
			$run_pro = mysqli_query($con, "select * from hanghoa where MSHH='$cart_MSHH'");

			while ($row_pro = mysqli_fetch_array($run_pro)) {
				$cart_Gia = $row_pro['Gia'];
			}
			$query = "insert into chitietdathang (SoDonDH, MSHH, SoLuong, GiaDatHang) values ('$SoDonDH','$cart_MSHH','$cart_SoLuong','$cart_Gia')";
			$chitiet = mysqli_query($con, $query);
		}
		$run_del = mysqli_query($con, "delete from giohang where IP='$ip'");
		echo "<script> alert('Đặt hàng thành công. Vui lòng chờ nhân viên duyệt hàng.')</script>";
	} else {
		echo "<script> alert('Vui lòng đăng nhập để đặt hàng')</script>";
	}
}

function update_account()
{
	global $con;
	if (isset($_POST['update_account'])) {
		$hovaten = $_POST["HoTenKH"];
		$diachi = $_POST["DiaChi"];
		$sodienthoai = $_POST["SoDienThoai"];
		$MSKH = $_POST["MSKH"];
		$run_update = mysqli_query($con, "update khachhang set HoTenKH = '$hovaten', DiaChi = '$diachi', SoDienThoai='$sodienthoai'  where MSKH ='$MSKH'");
		echo "
			<script>
				window.alert('Thanh cong!');

			</script>
		";
	}
}


function load_account()
{
	global $con;
	if (isset($_SESSION['user_id'])) {
		$MSKH = $_SESSION['user_id'];
		echo $MSKH;
		$query = "SELECT * FROM khachhangdangnhap JOIN khachhang ON khachhangdangnhap.MSKH=khachhang.MSKH WHERE khachhang.MSKH='$MSKH'";
		$run_account = mysqli_query($con, "SELECT * FROM khachhangdangnhap JOIN khachhang ON khachhangdangnhap.MSKH=khachhang.MSKH WHERE khachhang.MSKH='$MSKH'");
		while ($row = mysqli_fetch_array($run_account)) {
			$usernamekh = $row['usernamekh'];
			$passwordkh = $row['passwordkh'];
			$hovaten = $row["HoTenKH"];
			$diachi = $row["DiaChi"];
			$sodienthoai = $row["SoDienThoai"];
		}

		echo "
		<div class='login-sign'>
		<div class='account'>

			<h5>Thông tin tài khoản</h5>
			<form method='post' action='my_accountkh.php'>
				<div class='group-info'>
					<label for='inputEmail'>Username</label>
					<input type='text' name='usernamekh' disabled value='$usernamekh' required autofocus>
				</div>
				<div class='group-info'>
					<input type='hidden' name='MSKH'  value='$MSKH' required autofocus>
				</div>
				<div class='group-info'>
					<label for='inputEmail'>Họ và tên</label>
					<input type='text' name='HoTenKH' value='$hovaten' required autofocus>
				</div>
				<div class='group-info'>
					<label for='inputPassword'>Mật khẩu</label>
					<input type='password' name='passwordkh' value='$passwordkh' required>
				</div>
				<div class='group-info'>
					<label for='inputEmail'>Địa chỉ</label>
					<input type='text' name='DiaChi' value='$diachi' required autofocus>
				</div>
				<div class='group-info'>
					<label for='inputEmail'>Số điện thoại</label>
					<input type='text' name='SoDienThoai' value='$sodienthoai' required autofocus>
				</div>
				<div>
					<button type='submit' name='update_account' class='sign-in'>Cập nhật thông tin</button>
				</div>
				<hr>

		</div>
		</form>
	</div>
	</div>
		";
	} else {
		echo "<script> window.alert('Vui lòng đăng nhập để truy cập trang này');
				window.open('login.php','_self');
		</script>
		";
	}
}

function update_cart($cart_SoLuong, $product_id)
{

	if ($cart_SoLuong >= 1) {
		global $con;
		$fetch_pro = mysqli_query($con, "select * from hanghoa where MSHH='$product_id'");
		$IP = get_ip();
		$fetch_pro = mysqli_fetch_array($fetch_pro);

		$soLuongKho = (int) $fetch_pro['SoLuongHang'];
		if ($cart_SoLuong <= $soLuongKho) {
			$run_insert_pro = mysqli_query($con, "update giohang set SoLuong = $cart_SoLuong where MSHH = '$product_id' and IP ='$IP'");
		}
	} else {
		echo "
				<script> windows.alert('Số lượng không thể bằng 0);</script>
			";
	}
}

function update_cart_del($product_id)
{
	global $con;
	$IP = get_ip();
	$fetch_pro = mysqli_query($con, "delete from giohang where MSHH='$product_id' and IP='$IP'");
	if ($fetch_pro) {
		echo "
		<script> windows.alert('Đã xóa khỏi giỏ hàng');</script>
		<script>window.open(GamingShop/cart.php,'_self')</script>
		";
	}
}

function load_order()
{

	global $con;
	if (isset($_SESSION['user_id'])) {
		$MSKH = $_SESSION['user_id'];

		$run_order = mysqli_query($con, "SELECT * FROM `dathang` where MSKH='$MSKH'");
		while ($row = mysqli_fetch_array($run_order)) {
			$sodon = $row['SoDonDH'];
			$ngaydat = $row['NgayDH'];
			$trangthai = $row['TrangThai'];
			$nhanvien = $row['MSNV'];
			$sanphamid = mysqli_query($con, "SELECT * FROM `chitietdathang` where SoDonDH=$sodon");
			while ($row_sp = mysqli_fetch_array($sanphamid)){
				$sanphamhh=$row_sp['MSHH'];
			}
			$sanphamch = mysqli_query($con,"SELECT * FROM `hanghoa` where MSHH='$sanphamhh'");
			while ($row_ps = mysqli_fetch_array($sanphamch)){
				$sp=$row_ps['TenHH'];
			}
			$total = total_price_order($sodon);

			echo
				"
					<tr>
					<td><a href='#'>$sodon</a></td>
					<td>
						<p>$ngaydat</p>
					</td>
					<td>
						<p>$sp</p>
					</td>
					<td>
						<p>$total</p>
					</td>
					<td>
						<p>$trangthai</p>
					</td>
					<td>
						<p>$nhanvien</p>
					</td>
					</tr>
					";
		}
	}
}



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


function total_price()
{

	global $con;

	$total = 0;

	$ip = get_ip();

	$run_cart = mysqli_query($con, "select * from giohang where IP='$ip' ");

	while ($fetch_cart = mysqli_fetch_array($run_cart)) {

		$product_id = $fetch_cart['MSHH'];

		$result_product = mysqli_query($con, "select * from hanghoa where MSHH = '$product_id'");

		while ($fetch_product = mysqli_fetch_array($result_product)) {

			$product_price = array($fetch_product['Gia']);

			$single_price = $fetch_product['Gia'];

			$values = array_sum($product_price);

			// Getting Quality of the product

			$run_qty = mysqli_query($con, "select * from giohang where MSHH = '$product_id'");

			$row_qty = mysqli_fetch_array($run_qty);

			$qty = $row_qty['SoLuong'];

			$values_qty = $values * $qty;

			$total += $values_qty;
		}
	}

	echo "
		<p>Tạm tính: $total VND</p>
            <p>Giá tổng: $total VND</p>
		
		";
}

function total_items()
{
	global $con;

	$ip = get_ip();

	$run_items = mysqli_query($con, "select * from khachang where ip_address='$ip' ");

	echo $count_items = mysqli_num_rows($run_items);
}
function get_ip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		//ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		//ip pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function getCats()
{

	global $con;

	$get_cats = "select * from nhomhanghoa";

	$run_cats = mysqli_query($con, $get_cats);

	while ($row_cats = mysqli_fetch_array($run_cats)) {
		$cat_id = $row_cats['MaNhom'];

		$cat_title = $row_cats['TenNhom'];

		echo "
				<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>
				";
	}
}

function getPro()
{
	if (!isset($_GET['cat'])) {
		global $con;

		$get_pro = "select * from hanghoa";

		$run_pro = mysqli_query($con, $get_pro);

		while ($row_pro = mysqli_fetch_array($run_pro)) {
			$pro_id = $row_pro['MSHH'];
			$pro_title = $row_pro['TenHH'];
			$pro_price = $row_pro['Gia'];
			$pro_soluong = $row_pro['SoLuongHang'];
			$pro_cat = $row_pro['MaNhom'];
			$pro_image = $row_pro['Hinh'];
			$pro_desription = $row_pro['MoTaHH'];
			$old_price = $pro_price + 10;
			echo "
				<div class='col-md-4 mt-3'>
    		    	<div class='card profile-card-5'>
    		        	<div class='card-img-block'>
    		            	<img class='card-img-top' src='/GamingShop/admin/product_images/$pro_image' alt='$pro_title'>
    		        	</div>
                    	<div class='card-body pt-0'>
                    		<h5 class='card-title'>$pro_title</h5>
							<span class='price-new'>Giá $pro_price đ</span> <del class='price-old'></del>
						 
							<a href='index.php?add_cart=$pro_id' class='btn btn-sm btn-primary float-right'>Mua ngay</a>	
							<div class='price-wrap h5'>
								<a href='details.php?pro_id=$pro_id'>Chi tiết</a>
							</div> <!-- price-wrap.// -->
                  		</div>
                	</div>
					<div class='bottom-wrap'>
					</div> <!-- bottom-wrap.// -->
            	</div>
					";
		}
	}
}



function get_pro_by_cat_id()
{

	global $con;

	if (isset($_GET['cat'])) {
		$cat_id = $_GET['cat'];

		$get_cat_pro = "select * from hanghoa where MaNhom='$cat_id' ";

		$run_cat_pro = mysqli_query($con, $get_cat_pro);

		$count_cats = mysqli_num_rows($run_cat_pro);

		if ($count_cats == 0) {
			echo "<h2 style='padding:20px;'>No products where found in this category!!</h2>";
		}

		while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
			$pro_id = $row_cat_pro['MSHH'];
			$pro_cat = $row_cat_pro['MaNhom'];
			$pro_title = $row_cat_pro['TenHH'];
			$pro_price = $row_cat_pro['Gia'];
			$pro_image = $row_cat_pro['Hinh'];
			$old_price = $pro_price + 10;
			echo " 
			<div class='col-md-4 mt-3'>
			<div class='card profile-card-5'>
				<div class='card-img-block'>
					<img class='card-img-top' src='/GamingShop/admin/product_images/$pro_image' alt='$pro_title'>
				</div>
				<div class='card-body pt-0'>
					<h5 class='card-title'>$pro_title</h5>
					<span class='price-new'>Giá $pro_price đ</span> <del class='price-old'></del>
				 
					<a href='index.php?add_cart=$pro_id' class='btn btn-sm btn-primary float-right'>Mua ngay</a>	
					<div class='price-wrap h5'>
						<a href='details.php?pro_id=$pro_id'>Chi tiết</a>
					</div> <!-- price-wrap.// -->
				  </div>
			</div>
			<div class='bottom-wrap'>
			</div> <!-- bottom-wrap.// -->
		</div>
				";
		}
	}
}

function details_show_pro_of_cat($pro_cat)
{

	global $con;

	if (isset($_GET['pro_id'])) {
		$cat_id = $pro_cat;

		$get_cat_pro = "select * from hanghoa where MaNhom='$cat_id' ";

		$run_cat_pro = mysqli_query($con, $get_cat_pro);

		$count_cats = mysqli_num_rows($run_cat_pro);

		if ($count_cats == 0) {
			echo "<h2 style='padding:20px;'>Không có sản phẩm loại này!</h2>";
		}

		while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
			$pro_id = $row_cat_pro['MSHH'];
			$pro_cat = $row_cat_pro['MaNhom'];
			$pro_title = $row_cat_pro['TenHH'];
			$pro_price = $row_cat_pro['Gia'];
			$pro_image = $row_cat_pro['Hinh'];
			$old_price = $pro_price + 10;
			echo " 
				<div class='col-md-4 mt-3'>
    		    	<div class='card profile-card-5'>
    		        	<div class='card-img-block'>
    		            	<img class='card-img-top' src='/GamingShop/admin/product_images/$pro_image' alt='$pro_title'>
    		        	</div>
                    	<div class='card-body pt-0'>
                    		<h5 class='card-title'>$pro_title</h5>
							<span class='price-new'>Giá $pro_price đ</span> <del class='price-old'></del>
						 
							<div class='price-wrap h5'>
								<a href='details.php?pro_id=$pro_id'>Chi tiết</a>
							</div> <!-- price-wrap.// -->
                  		</div>
                	</div>
					<div class='bottom-wrap'>
					</div> <!-- bottom-wrap.// -->
            	</div>
				";
		}
	}
}

function generateRandomString($length)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function UserID()
{
	global $con;
	$generateID = '';
	do {
		$generateID = generateRandomString(5);
		$check_exist = mysqli_query($con, "select * from khachhang where MSKH = '$generateID'");
		$userid_count = mysqli_num_rows($check_exist);
	} while ($userid_count != 0);
	return $generateID;
}