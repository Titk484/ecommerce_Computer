<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>

<?php
    class cart {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function add_to_cart($quantity, $product_stock, $id) {
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);

            $product_stock = $this->fm->validation($product_stock);
            $product_stock = mysqli_real_escape_string($this->db->link, $product_stock);

            $id = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();

            $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId='$sId'";
            $result_check_cart = $this->db->select($check_cart);
            if($quantity < $product_stock) {
                if($result_check_cart) {
                    $msg = "Product Already Added";
                    return $msg;
                }else {
                    $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
                    $result = $this->db->select($query)->fetch_assoc();
                    
                    $image = $result["image"];
                    $price = $result["price"];
                    $productName = $result["productName"];

                    $query_insert = "INSERT INTO tbl_cart(stock, productId, quantity, sId, image, price, productName) 
                        VALUE('$product_stock','$id','$quantity','$sId','$image','$price','$productName')";
                    $insert_cart = $this->db->insert($query_insert);

                    if($insert_cart) {
                        header('Location:cart.php');
                    }else {
                        header('Location:404.php');
                    }
                }
            }
        }

        public function get_product_cart() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_quantity_cart($quantity, $stock, $cartId) {
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $stock = mysqli_real_escape_string($this->db->link, $stock);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            if($stock >= $quantity) {
                $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
            
                $result = $this->db->update($query);
                
                if($result) {
                    header('Location: cart.php');
                }else {
                    $msg = "<span class='error'>Product Quantity Updated Not Successfully</span>";
                    return $msg;
                }
            } else {
                $msg = "<span class='error'>Số lượng đặt hàng phải nhỏ hơn hoặc bằng số lượng tồn kho</span>";
                return $msg;
            }
            
        }

        public function del_product_cart($cartid) {
            $cartid = mysqli_real_escape_string($this->db->link, $cartid);
            $query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
            $result = $this->db->delete($query);
            if($result) {
                header('Location: cart.php');
            }else {
                $msg = "<span class='error'>Product Deleted Not Successfully</span>";
                return $msg;
            }
        }

        public function check_cart() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function check_order($customer_id) {
            $sId = session_id();
            $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_all_data_cart() {
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertOrder($customer_id) {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $get_product = $this->db->select($query);
            $order_code = rand(0000,9999);
            //insert vao don hang
            $query_placed = "INSERT INTO tbl_placed(customer_id, order_code, status) VALUES('$customer_id','$order_code','0')";
            $insert_placed = $this->db->insert($query_placed);

            if($get_product) {
                while($result = $get_product->fetch_assoc()) {
                    $productid = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'];
                    $image = $result['image'];
                    $customer_id = $customer_id;

                    $query_order = "INSERT INTO tbl_order(order_code, productId, productName, quantity, price, image, customer_id) 
                        VALUE('$order_code','$productid','$productName','$quantity','$price','$image','$customer_id')";
                    $insert_order = $this->db->insert($query_order);

                    
                }
            }
        }
        
        public function getAmountPrice($customer_id) {
            $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
            $get_price = $this->db->select($query);
            return $get_price;
        }

        public function get_cart_ordered($customer_id) {
            $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;           
        }

        public function get_inbox_cart() {
            $query = "SELECT * FROM tbl_placed, tbl_customer WHERE tbl_placed.customer_id = tbl_customer.id ORDER BY order_code";
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart;     
        }

        public function get_inbox_cart_history($customer_id) {
            $query = "SELECT * FROM tbl_placed, tbl_customer 
                WHERE tbl_placed.customer_id = tbl_customer.id AND tbl_placed.customer_id='$customer_id'
                ORDER BY order_code";
                
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart;     
        }

        public function shifted($id) {
            $id = mysqli_real_escape_string($this->db->link, $id);
            
            $query = "UPDATE tbl_placed SET 

                    status = '1'

                    WHERE order_code = '$id'";
            $result = $this->db->update($query);
            if($result) {
                $msg = "<span class='success'>Update Order Successfully</span>";
                return $msg;
            }else {
                $msg = "<span class='error'>Update Order Not Successfully</span>";
                return $msg;
            }
        } 

        public function confirm_recieved($id) {
            $id = mysqli_real_escape_string($this->db->link, $id);
            
            $query = "UPDATE tbl_placed SET 

                    status = '2'

                    WHERE order_code = '$id'";
            $result = $this->db->update($query);
            if($result) {
                $msg = "<span class='success'>Update Order Successfully</span>";
                return $msg;
            }else {
                $msg = "<span class='error'>Update Order Not Successfully</span>";
                return $msg;
            }
        } 


        public function del_shifted($id) {
            $id = mysqli_real_escape_string($this->db->link, $id);

            $query = "DELETE FROM tbl_placed WHERE order_code = '$id'";
            $result = $this->db->update($query);
            if($result) {
                $msg = "<span class='success'>Delete Order Successfully</span>";
                return $msg;
            }else {
                $msg = "<span class='error'>Delete Order Not Successfully</span>";
                return $msg;
            }
        }

        public function shifted_confirm($id, $time, $price) {
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $query = "UPDATE tbl_order SET 

                    status = '2'

                    WHERE customer_id = '$id' AND date_order = '$time' AND price = '$price'";
            $result = $this->db->update($query);
            return $result;
        }
    }

?>