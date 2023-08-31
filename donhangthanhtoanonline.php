<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>

<?php
if (isset($_GET['cartid'])) {
    $cartid = $_GET['cartid'];
    $delcart = $ct->del_product_cart($cartid);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId, $stock);
    if ($quantity <= 0) {
        $delcart = $ct->del_product_cart($cartId);
    }
}
?>

<?php
// if(!isset($_GET['id'])) {
// 	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
// }
?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">

                <h2>Cổng thanh toán online</h2>

                <?php
                if (isset($update_quantity_cart)) {
                    echo $update_quantity_cart;
                }
                ?>
                <?php
                if (isset($delcart)) {
                    echo $delcart;
                }
                ?>
                <table class="tblone">
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>

                    <?php
                    $get_product_cart = $ct->get_product_cart();
                    if ($get_product_cart) {
                        $subtotal = 0;
                        $qty = 0;
                        while ($result = $get_product_cart->fetch_assoc()) {
                    ?>

                            <tr>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
                                <td><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
                                        <input type="number" name="quantity" value="<?php echo $result['quantity'] ?>" />
                                        <input type="submit" name="submit" value="Update" />
                                    </form>
                                </td>
                                <td><?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $fm->format_currency($total) . " VNĐ";

                                    ?></td>
                                <td><a href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></td>
                            </tr>

                    <?php
                            $subtotal += $total;
                            $qty = $qty + $result['quantity'];
                        }
                    }
                    ?>

                </table>

                <?php
                $check_cart = $ct->check_cart();
                if ($check_cart) {
                ?>
                    <table style="float:right;text-align:left;" width="40%">
                        <tr>
                            <th>Sub Total : </th>
                            <td><?php

                                echo $fm->format_currency($subtotal) . " VNĐ";
                                Session::set('sum', $subtotal);
                                Session::set('qty', $qty);
                                ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td><?php
                                $vat = $subtotal * 0.1;
                                $gtotal = $subtotal + $vat;
                                echo $fm->format_currency($gtotal) . " VNĐ";
                                ?></td>
                        </tr>
                    </table>

                <?php
                } else {
                    echo 'Giỏ hàng bạn đang trống, vui lòng chọn mua sản phẩm';
                }
                ?>
            </div>

            <style type="text/css">
                a.btn-thanhtoan {
                    display: block;
                    width: 33%;
                    margin: 6px auto;
                }
                .pay_online{
                    margin-top: 5px;
                    display: flex;
                    gap: 2px;
                    justify-content: flex-end;
                }
            </style>

            <?php
            $check_cart = $ct->check_cart();
            if (Session::get('customer_id') == true && $check_cart) {
            ?>
                <!-- Thanh toán VNPAY -->
                <div class="pay_online">
                    <form action="congthanhtoan_vnpay.php"  method="POST">
                        <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal ?>">
                        <button class="btn btn-info " id="redirect" name="redirect">Thanh toán VNPAY</button>
                    </form>
                    <p></p>
                    <!-- Thanh toán     MOMO -->
                    <form action="congthanhtoan_momo.php" method="POST">
                        <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal ?>">
                        <button class="btn btn-danger" name="captureWallet">Thanh toán QR MOMO</button>
                    </form>
                    <p></p>
                    <form action="congthanhtoan_momo.php" method="POST">
                        <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal ?>">
                        <button class="btn btn-danger" name="payWithATM">Thanh toán MOMO ATM</button>
                    </form>
                    <!-- Thanh toán OnePay -->
                    <p></p>
                    <form action="congthanhtoan_onepay.php" method="POST">
                        <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal ?>">
                        <button class="btn btn-warning">Thanh toán ONEPAY</button>
                    </form>
                    <!-- Thanh toán PayPal -->
                    <p></p>
                    <div id="paypal-button"></div>
                    <div />
                </div>

            <?php
            } else {
            ?>
                <a class="btn btn-primary btn-thanhtoan" href="cart.php"> Quay về giỏ hàng</a>
            <?php
            }
            ?>

        </div>
        <style type="text/css">
            a.muahang {
                float: right;
                padding: 10px 20px;
                border: 1px solid #ddd;
                background: #414045;
                color: #fff;
                cursor: pointer;
            }
        </style>
        <div class="clear"></div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>


<script src="https://www.paypal.com/sdk/js?client-id=AWmz0wbJgbusKndaRPK717wd8Ry2y7xlK1VHL6js1ofSdD6bk9IJcQPZoH2KaSIK--h1HES9GQh0NOcc&currency=USD"></script>

<script>
    paypal.Buttons({
        // Order is created on the server and the order id is returned
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: "<?php echo $gtotal * 0.00004 ?>"
                    }
                }]
            });
        },

        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                window.location.replace('https://winx-store.000webhostapp.com/success.php');
            });
        },

        onCancel:function(data) {
            window.location.replace('https://winx-store.000webhostapp.com/donhangthanhtoanonline.php');
        }
    }).render('#paypal-button');
</script>