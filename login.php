<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	$login_check = Session::get('customer_login');
	if($login_check) {
		header('Location:order.php');
	}
?>

<?php 
	if ($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_POST['submit'])) {
		$insertCustomers = $cs->insert_customers($_POST);
	}
?>

<?php 
	if ($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_POST['login'])) {
		$login_Customers = $cs->login_customers($_POST);
	}
?>

<div class="main">
	<div class="content content_login">
		<div class="login_panel">
			<h3>Đăng nhập</h3>
			<p>Đăng nhập theo form bên dưới.</p>
			<?php
				if(isset($login_Customers)) {
					echo $login_Customers;	
				}
			?>
			<form action="" method="POST">
					<input type="text" name="email" class="field" placeholder="Nhập Email...">
					<input type="password" name="password" class="field" placeholder="Nhập Pass...">
				<p class="note">Nếu bạn quên email hoặc pass hãy nhấn tại <a href="#">đây</a></p>
					<div class="buttons"><div><input type="submit" name="login" value="Đăng nhập"></div></div>
			</form>
		</div>

		<div class="register_account">
			<h3>Tạo tài khoản mới</h3>
			<?php
				if(isset($insertCustomers)) {
					echo $insertCustomers;	
				}
			?>
			<form action="" method="POST">
					<table>
						<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập tên..." >
							</div>
							
							<div>
							<input type="text" name="cccd" placeholder="Nhập căn cước công dân...">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Nhập mã bưu chính...">
							</div>
							<div>
								<input type="text" name="email" placeholder="Nhập email...">
							</div>
						</td>
						<td>
						<div>
							<input type="text" name="address" placeholder="Nhập địa chỉ...">
						</div>
					<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Chọn vùng miền</option>         
							<option value="HCM">Hồ Chí Minh</option>
							<option value="VT">Vũng Tàu</option>
							<option value="BL">Bạc Liêu</option>
							<option value="BG">Bắc Giang</option>
							<option value="BK">Bắc Kạn</option>
							<option value="BN">Bắc Ninh</option>
							<option value="BT1">Bến Tre</option>
							<option value="BD1">Bình Dương</option>
							<option value="BD2">Bình Định</option>
							<option value="BP">Bình Phước</option>
							<option value="BT2">Bình Thuận</option>
							<option value="CM">Cà Mau</option>
							<option value="CB">Cao Bằng</option>
							<option value="CT">Cần Thơ</option>
							<option value="DN1">Đà Nẵng</option>
							<option value="DL">Đắk Lắk</option>
							<option value="DN2">Đắk Nông</option>
							<option value="DB">Điện Biên</option>
							<option value="DN3">Đồng Nai</option>
							<option value="DT">Đồng Tháp</option>
							<option value="GL">Gia Lai</option>
							<option value="HG1">Hà Giang</option>
							<option value="HN1">Hà Nam</option>
							<option value="HT">Hà Tĩnh</option>
							<option value="HD">Hải Dương</option>
							<option value="HP">Hải Phòng</option>
							<option value="HG2">Hậu Giang</option>
							<option value="HB">Hòa Bình</option>
							<option value="HY">Hưng Yên</option>
							<option value="KH">Khánh Hòa</option>
							<option value="KG">Kiên Giang</option>
							<option value="KT">Kon Tum</option>
							<option value="LC1">Lai Châu</option>
							<option value="LS">Lạng Sơn</option>
							<option value="LC2">Lào Cai</option>
							<option value="LD">Lâm Đồng</option>
							<option value="LA">Long An</option>
							<option value="ND">Nam Định</option>
							<option value="NA">Nghệ An</option>
							<option value="NB">Ninh Bình</option>
							<option value="NT">Ninh Thuận</option>
							<option value="PT">Phú Thọ</option>
							<option value="PY">Phú Yên</option>
							<option value="QB">Quảng Bình</option>
							<option value="QN1">Quảng Nam</option>
							<option value="QN2">Quảng Ngãi</option>
							<option value="QN3">Quảng Ninh</option>
							<option value="QT">Quảng Trị</option>
							<option value="ST">Sóc Trăng</option>
							<option value="SL">Sơn La</option>
							<option value="TN1">Tây Ninh</option>
							<option value="TB">Thái Bình</option>
							<option value="TN2">Thái Nguyên</option>
							<option value="TH">Thanh Hóa</option>
							<option value="TTH">Thừa Thiên Huế</option>
							<option value="TG">Tiền Giang</option>
							<option value="TV">Trà Vinh</option>
							<option value="TQ">Tuyên Quang</option>
							<option value="VL">Vĩnh Long</option>
							<option value="VP">Vĩnh Phúc</option>
							<option value="YB">Yên Bái</option>

					</select>
					</div>		        
	
				<div>
				<input type="text" name="phone" placeholder="Nhập số điện thoại...">
				</div>
				
				<div>
					<input type="text" name="password" placeholder="Nhập Pass...">
				</div>
				</td>
			</tr> 
			</tbody></table> 
		<div class="search"><div><input type="submit" name="submit" value="Tạo tài khoản"></div></div>
			<p class="terms">By clicking 'Tạo tài khoản' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
			<div class="clear"></div>
			</form>
		</div>  	
	<div class="clear"></div>
	</div>
</div>

