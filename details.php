<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if(!isset($_GET['proid']) || $_GET['proid']==NULL) {
		echo "<script>window.location = '404.php'</script>";
	}else {
		$id = $_GET['proid'];
	}
	if ($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_POST['submit'])) {
		$product_stock = $_POST['product_stock'];
		$quantity = $_POST['quantity'];
		$insertCart = $ct->add_to_cart($quantity, $product_stock, $id);
	}
	if (isset($_POST['cmt_submit'])) {
		$cmt_insert = $product->insert_cmt();
	}
?>

<style>
	.cmt {
		display: flex;
		flex-direction: column;
    	margin-left: 120px;
	}
</style>
	
<div class="main">
	<div class="content">
		<div class="section group">
			<?php
				$get_product_details = $product->get_details($id);
				if($get_product_details) {
					while($result_details = $get_product_details->fetch_assoc()) {

					
			?>

			<div class="cont-desc span_1_of_2">				
				<div class="grid images_3_of_2">
					<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName'] ?></h2>
					<!-- <p><?php echo $result_details['product_desc'] ?></p> -->
					<div class="price">
						<p>Price: <span><?php echo $fm->format_currency($result_details['price'])." VNĐ" ?></span></p>
						<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
						<p>Brand: <span><?php echo $result_details['brandName'] ?></span></p>
						<p>Stock: <span><?php echo $result_details['product_quantity'] ?></span></p>
					</div>

					<!-- SHARE ON FACEBOOK -->
					<div> 
						<meta property="og:title" content="<?php echo $result_details['productName'] ?>">
						<meta property="og:description" content="<?php echo $result_details['product_desc']?>">
						<meta property="og:image" content="<?php echo $result_details['image'] ?>">
						<meta property="og:url" content="http://winxshop.000webhostapp.com/">
						<meta property="og:type" content="website">

					</div>

					<div class="fb-share-button" data-href="http://winxshop.000webhostapp.com/details.php?proid=<?php echo $result_details['productId'] ?>" data-layout="button_count"></div>

					<!-- END SHARE ON FACEBOOK -->

					<div class="add-cart">
						<form action="" method="post">
							<input type="hidden" class="buyfield" name="product_stock" value="<?php echo $result_details['product_quantity'] ?>"/>
							<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
							<?php
								if($result_details['product_quantity'] > 0) {
							?>
							<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
							<?php
								}
							?>
						</form>				
						<?php
							if(isset($AddtoCart)) {
								echo '<span style="color: green; font-size: 18px;">Sản phẩm đã được thêm vào</span>';
							}
						?>
					</div>
				</div>
				<div class="product-desc">
				<h2>Product Details</h2>
				<?php echo $result_details['product_desc'] ?>
				
			</div>
				
		</div>

			<?php
					}
				}
			?>

		<div class="rightsidebar span_3_of_1">
			<h2>CATEGORIES</h2>
			<ul>
				<?php
					$getall_category = $cat->show_category_fontend();
					if($getall_category) {
						while($result_allcat = $getall_category->fetch_assoc()) {
				?>
			<li><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a></li>
				<?php
						}
					}
				?>

			</ul>

		</div>
	</div>

	<!-- Comment -->
	<div class="comment">
		<div class="row">
			<div class="cmt" style="width:900px; margin-left:90px">
				<h5 style="background-color:#ab4f47; color:white; padding:10px 20px; border-radius:5px">Phản hồi khách hàng</h5>
				<ul>
					<?php 
						if (isset($cmt_insert)) {
							echo $cmt_insert;
						}
						$get_cmt = $product->show_cmt();
						if($get_cmt) {
						while($result_cmt = $get_cmt->fetch_assoc()) {
					?>
					<li>
						<p><b>[<?php echo $result_cmt['tenbinhluan']?>]</b> - <?php echo $result_cmt['binhluan']?></p>
					</li>

					<?php
						}
						}
					?>
				</ul>
				
				<form action="" method="POST">
					<p><input type="hidden" value="<?php echo $id ?>" name="product_id_binhluan"></p>
					<p><input type="text" placeholder="Điền tên" class="form-control" name="tennguoibinhluan"></p>
					<p><textarea rows="5" style="resize: none;" placeholder="Bình luận...." class="form-control" name="binhluan"></textarea></p>
					<p><input type="submit" name="cmt_submit" class="btn btn-success" value="Gửi bình luận"></p>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	include 'inc/footer.php';
?>

<!-- <div id="fb-root"></div>
<script>
	(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script> -->
