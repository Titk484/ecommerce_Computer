<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	$login_check = Session::get('customer_login');
	if($login_check==false) {
		header('Location:login.php');
	}
?>

<style>
	h3.payment {
		text-align: center;
		font-size: 20px;
		font-weight: bold;
		text-decoration: underline;
	}
	
	.wrapper_method {
		text-align: center;
		width: 550px;
		margin: 0 auto;
		border: 1px solid #666;
		padding: 20px;
		background: cornsilk;
	}

	.wrapper_method a {
		padding: 10px;
		/* background: red; */
		color: #fff;
	}

	.wrapper_method h3 {
		margin-bottom: 20px;
	}

	p.small-size {
		text-align: center;
		font-size: 16px;
		text-decoration: underline;
		margin-bottom: 0px;
	}
</style>

<div class="main">
	<div class="content">
		<div class="section group">
			<div class="content_top">
				<div class="heading">
					<h3>Thanh toán online</h3>
				</div>	

				<div class="clear"></div>
				<div class="wrapper_method">
					<h3 class="payment">Chọn cổng thanh toán online</h3>
					<button class="btn btn-info"><a href="donhangthanhtoanonline.php"> Thanh toán VNPAY </a></button> 
					<button class="btn btn-danger"><a href="donhangthanhtoanonline.php"> Thanh toán MOMO </a></button> 
					<p class="small-size">Or</p>
					<button class="btn btn-secondary"><a href="payment.php"> << Quay về </a></button>
				</div>
			</div>
		</div>	
	</div>
</div>

<?php 
	include 'inc/footer.php';
?>