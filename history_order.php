<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	$login_check = Session::get('customer_login');
	if($login_check == false) {
		header('Location:login.php');
	}
?>

<?php
	if(isset($_GET['danhanhang'])) {
		$danhanhang = $_GET['danhanhang'];
		$danhanhang = $ct->confirm_recieved($danhanhang);
        if($danhanhang) {
            echo "<script>window.location = 'history_order.php'</script>";
        }
	}
?>


<div class="main">
	<div class="content">
		<div class="section group">
			<div class="content_top">
				<div class="heading">
                    <h3 class="payment">Lịch sử đơn đã đặt</h3>
				</div>
				<div class="clear"></div>
                <div class="wrapper_method">
                    <table class="table table-striped" id="example">
						<thead>
							<tr>
								<th>No.</th>
								<th>Order Code</th>
								<th>Customer Name</th>
								<th>Action</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$ct = new cart();
								$fm = new Format();
								$get_inbox_cart = $ct->get_inbox_cart_history(Session::get('customer_id'));
								if ($get_inbox_cart) {
									$i = 0;
									while ($result = $get_inbox_cart->fetch_assoc()) {
										$i++;
							?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['order_code'] ?></td>
								<td><?php echo $result['name'] ?></td>
								<td><a href="history_order_details.php?customerid=<?php echo $result['customer_id'] ?>&order_code=<?php echo $result['order_code'] ?>">View Order</a></td>
								<td>
									<?php
										if($result['status']==1) {
									?>

									<a href="?danhanhang=<?php echo $result['order_code'] ?>">Đã nhận hàng</a>
									
									<?php
										}elseif($result['status']==2) {
									?>
									
									<?php echo 'Nhận Đơn hàng thành công'; ?>
									
									<?php
										}
									?>
								</td>
							</tr>

							<?php
									}
								}
							?>
						</tbody>
					</table>
			    </div>
            </div>
		</div>
	</div>
</div>

<?php 
	include 'inc/footer.php';
?>
