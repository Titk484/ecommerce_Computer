<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php 
    $cs = new customer();  
    if(!isset($_GET['customerid']) || $_GET['customerid']==NULL) {
        echo "<script>window.location = 'inbox.php'</script>";
    }else {
        $id = $_GET['customerid'];
        $order_code = $_GET['order_code'];
    }
	
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chi tiết đơn hàng</h2>
                <div class="block copyblock"> 
                    <?php 
                        $get_customer = $cs ->show_customers($id);
                        if($get_customer) {
                            while($result = $get_customer->fetch_assoc()) {
                        
                    ?>
                    <form action="" method="post">
                        <h3>Thông tin người đặt hàng</h3>
                        <table class="form">					
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>CCCD</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['cccd'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['country'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['address'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Zipcode</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['zipcode'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            
                        </table>
                    </form>

                    <?php 
                            }
                        }
                    ?>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Số lượng sản phẩm</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $get_order = $cs->show_order($order_code);
                            if($get_order) {
                                $subtotal = 0;
                                $total = 0;
                                while($result = $get_order->fetch_assoc()) {
                                    $subtotal = $result['quantity'] * $result['price'];
                                    $total+=$subtotal;
                        ?>
                        <tr>
                            <td><?php echo $result['productName'] ?></td>
                            <td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>
                            <td><?php echo number_format($result['price'],0,',','.') ?> VNĐ</td>
                            <td><?php echo $result['quantity'] ?></td>
                            <td><?php echo number_format($subtotal,0,',','.') ?> VNĐ</td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                        <tr>
                            <td colspan="5">Thành tiền: <?php echo number_format($total,0,',','.') ?> VNĐ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
<?php include 'inc/footer.php';?>