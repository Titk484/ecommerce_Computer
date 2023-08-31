<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>

<?php
    class product {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function search_product($tukhoa) {
            $tukhoa = $this->fm->validation($tukhoa);
            $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_product($data, $files) {
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $product_quantity = mysqli_real_escape_string($this->db->link, $data['product_quantity']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            //Kiem tra hinh anh va lay hinh anh cho vao folder uploads
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.' .$file_ext;
            $uploaded_image = "uploads/" .$unique_image;
        
            if($productName=="" || $product_quantity=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type=="" || $file_name=="") {
                $alert = "<span class='error'>Files must be not empty</span>";
                return $alert;
            }else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName, product_quantity, brandId, catId, product_desc, price, type, image) 
                    VALUE('$productName','$product_quantity','$brand','$category','$product_desc','$price','$type','$unique_image')";
                $result = $this->db->insert($query);

                if($result) {
                    $alert = "<span class='success'>Insert Product Successfully</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Insert Product Not Success</span>";
                    return $alert;
                }
            }
        }

        public function insert_slider($data, $files) {
            $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            
            //Kiem tra hinh anh va lay hinh anh cho vao folder uploads
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.' .$file_ext;
            $uploaded_image = "uploads/" .$unique_image;

            if($sliderName=="" || $type=="") {
                $alert = "<span class='error'>Files must be not empty</span>";
                return $alert;
            }else {
                if(!empty($file_name)) {
                    //Nếu người dùng chọn ảnh
                    if($file_size > 2048000) {
                        $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
                            return $alert;
                    }elseif(in_array($file_ext, $permited) === false) { 
                        // echo "<span class='error'>You can upload only:-".implode(',', $permited)."</span>";
                        $alert = "<span class='success'>You can upload only:-".implode(',', $permited)."</span>";
                            return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO tbl_slider(sliderName, type, slider_image) 
                    VALUE('$sliderName','$type','$unique_image')";
                    $result = $this->db->insert($query);

                    if($result) {
                        $alert = "<span class='success'>Slider Added Successfully</span>";
                        return $alert;
                    }else {
                        $alert = "<span class='error'>Slider Added Not Success</span>";
                        return $alert;
                    }

                }               
            }
        }

        public function show_slider() {
            $query = "SELECT * FROM tbl_slider WHERE type='1' ORDER BY sliderId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_slider_list() {
            $query = "SELECT * FROM tbl_slider ORDER BY sliderId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        //Bình luận
        public function insert_cmt() {
            $productId = $_POST['product_id_binhluan'];
            $tenbinhluan = $_POST['tennguoibinhluan'];
            $binhluan = $_POST['binhluan'];
            if ($tenbinhluan==''|| $binhluan=='') {
                $alert = "<span class='error'>Files must be not empty</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_cmt(tenbinhluan, binhluan, productId) 
                VALUES('$tenbinhluan','$binhluan','$productId')";
                $result = $this->db->insert($query);

                if($result) {
                    $alert = "<span class='success'>Bình luận đã được gửi</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Bình luận không thành công</span>";
                    return $alert;
            }
            }
        }

        public function show_cmt() {
            $query = "SELECT * FROM tbl_cmt,tbl_product WHERE tbl_cmt.productId = tbl_product.productId ORDER BY cmt_id DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_product() {
            $query = 
            "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
            
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId

            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
            
            ORDER BY tbl_product.productId DESC";
            // $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_type_slider($id, $type) {
            $type = mysqli_real_escape_string($this->db->link, $type);

            $query = "UPDATE tbl_slider SET type = '$type' WHERE sliderId='$id'";
            
            $result = $this->db->update($query);
            return $result;
        }

        public function del_slider($id) {
            $query = "DELETE FROM tbl_slider WHERE sliderId = '$id'";
            $result = $this->db->delete($query);
            if($result) {
                $alert = "<span class='success'>Slider Deleted Successfully</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Slider Not Success</span>";
                return $alert;
            }
        }

        public function update_product($data, $files, $id) {
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $product_quantity = mysqli_real_escape_string($this->db->link, $data['product_quantity']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            //Kiem tra hinh anh va lay hinh anh cho vao folder uploads
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.' .$file_ext;
            $uploaded_image = "uploads/" .$unique_image;

            if($productName=="" || $product_quantity=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type=="") {
                $alert = "<span class='error'>Files must be not empty</span>";
                return $alert;
            }else {
                if(!empty($file_name)) {
                    //Nếu người dùng chọn ảnh
                    if($file_size > 20480) {
                        $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
                            return $alert;
                    }elseif(in_array($file_ext, $permited) === false) { 
                        // echo "<span class='error'>You can upload only:-".implode(',', $permited)."</span>";
                        $alert = "<span class='success'>You can upload only:-".implode(',', $permited)."</span>";
                            return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product SET 

                    productName = '$productName', 
                    product_quantity = '$product_quantity',
                    brandId = '$brand', 
                    catId = '$category', 
                    type = '$type', 
                    price = '$price', 
                    image = '$unique_image', 
                    product_desc = '$product_desc'

                    WHERE productId = '$id'";


                }else {
                    //Nếu người dùng không chọn ảnh
                    $query = "UPDATE tbl_product SET 

                    productName = '$productName', 
                    product_quantity = '$product_quantity',
                    brandId = '$brand', 
                    catId = '$category', 
                    type = '$type', 
                    price = '$price', 
                    product_desc = '$product_desc' 

                    WHERE productId = '$id'";
                }

                $result = $this->db->update($query);

                if($result) {
                    $alert = "<span class='success'>Product Updated Successfully</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Product Updated Not Success</span>";
                    return $alert;
                }
            }
        }

        public function del_product($id) {
            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->delete($query);
            if($result) {
                $alert = "<span class='success'>Product Deleted Successfully</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Product Updated Not Success</span>";
                return $alert;
            }
        }

        public function getproductbyId($id) {
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        //END RACKEND

        //xuất sản phẩm ra trang chủ
        public function getproduct_feathered() {
            $query = "SELECT * FROM tbl_product WHERE type = '0' LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_new() {
            $sp_tungtrang = 4;
            if (!isset($_GET['trang'])) {
                $trang =1;
            }else {
                $trang = $_GET['trang'];
            }
            $tung_trang = ($trang-1) * $sp_tungtrang;
            $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang,$sp_tungtrang";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_product () {
            $query = "SELECT * FROM tbl_product ";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_razer() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '1' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_daeru() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '4' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_logitech() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '7' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_sony() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '5' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_details($id) {
            $query = 
            "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
            
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId

            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'
            
            ";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function getLastestDareu() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestJBL() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestAkko() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestRazer() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
    }

?>