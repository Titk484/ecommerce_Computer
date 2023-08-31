<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>

<style>
	.page {
	display: flex;
	justify-content: center;
	}
	.page a {
	color: black;
	float: left;
	padding: 8px 16px;
	margin:0 5px;
	text-decoration: none;
	transition: background-color .3s;
	}
	.page a:hover {
		background-color: #ddd;
	}
</style>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
			<h3>Sản phẩm nổi bật</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section1 group">
			<?php
				$product_feathered = $product->getproduct_feathered();
				if($product_feathered) {
					while($result = $product_feathered->fetch_assoc()) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					<h2><?php echo $result['productName'] ?></h2>
					<!-- <p><?php echo $fm->textShorten($result['product_desc'], 50) ?></p> -->
					<p><span class="price"><?php echo $fm->format_currency($result['price'])." VNĐ" ?></span></p>
					<div class="btn btn-dark"><span><a style="color: #fff; text-decoration: none;" href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Thông tin</a></span></div>
				</div>
				<?php
					}
				}
				?>
			</div>

			<div class="content_bottom">
			<div class="heading">
			<h3>Sản phẩm mới</h3>
			</div>
			<div class="clear"></div>
		</div>
			<div class="section1 group">
				<?php
					$product_new = $product->getproduct_new();
					if($product_new) {
						while($result_new = $product_new->fetch_assoc()) {
				?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $result_new['productId'] ?>"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
					<h2><?php echo $result_new['productName'] ?></h2>
					<!-- <p><?php echo $fm->textShorten($result_new['product_desc'], 50) ?></p> -->
					<p><span class="price"><?php echo $fm->format_currency($result_new['price']). " VNĐ" ?></span></p>
					<div class="btn btn-dark"><span><a style="color: #fff; text-decoration: none;" href="details.php?proid=<?php echo $result_new['productId'] ?>" class="details">Thông tin</a></span></div>
				</div>
				<?php
					}
				}
				?>
			</div>
				
			<div class="page">
				<?php 
					$product_all = $product->get_all_product();
					$product_count = mysqli_num_rows($product_all); //đếm số sản phẩm
					$product_button = $product_count/4; //hiển thị tối đa 4 sản phẩm trên 1 trang

					//Hiển thị trang
					$i = 1;
					// echo '<p>Trang : </p>';
					for ($i=1; 	$i<=$product_button; $i++) {
						echo '<a href="index.php?trang='.$i.'">'.$i.'</a>';
					}
				?>
			</div>
	</div>
</div>


<?php 
	include 'inc/footer.php';
?>

