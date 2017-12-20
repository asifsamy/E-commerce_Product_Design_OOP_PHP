<?php
   $filepath = realpath(dirname(__FILE__)); 
   include_once ($filepath.'/../lib/Database.php');
   include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class CustomPd 
{
   private $db;
   private $fm;

   public function __construct()
   {
	   $this->db = new Database();
	   $this->fm = new Format();
   }

   public function customProductInsert($productName, $catId, $body, $price, $pd_type, $imageurl)
   {
       $productName = $this->fm->validation($productName); 
       $productName = mysqli_real_escape_string($this->db->link, $productName);
       $catId = $this->fm->validation($catId); 
       $catId = mysqli_real_escape_string($this->db->link, $catId);
       $body = $this->fm->validation($body); 
       $body = mysqli_real_escape_string($this->db->link, $body);
       $price = $this->fm->validation($price); 
       $price = mysqli_real_escape_string($this->db->link, $price);
       $pd_type = $this->fm->validation($pd_type); 
       $pd_type = mysqli_real_escape_string($this->db->link, $pd_type);

       $query = "INSERT INTO product(productName, catId, body, price, image, pd_type) VALUES('$productName', '$catId', '$body', '$price', '$imageurl', '$pd_type')";

       $pd_inserted = $this->db->insert($query);

         if ($pd_inserted) {
             $msg = "<div class='alert alert-success'><strong>Product Inserted Successfully.</strong></div>";
             return $msg;
         } else {
             $msg = "<div class='alert alert-danger'><strong>Product Insertion Unsuccessfully !</strong></div>";
             return $msg;
         }
   }

   public function getCustomProduct($imageurl)
   {
   	   $query = "SELECT * FROM product WHERE image = '$imageurl'"; 
       $result = $this->db->select($query);
       return $result;  
   }

   public function getCProductById($id)
   {
       $query = "SELECT * FROM c_product WHERE id = '$id'"; 
       $result = $this->db->select($query);
       return $result;
   }

   public function addToCartCustom($data, $id)
   {
      $productId = mysqli_real_escape_string($this->db->link, $id);
      $sId = session_id();

      $squery = "SELECT * FROM product WHERE productId = '$productId'";
      $result = $this->db->select($squery)->fetch_assoc();

      $productName = $result['productName'];
      $price = $result['price'];
      $image = $result['image'];
      $catId = $result['catId'];

      $chquery = "SELECT * FROM cart WHERE productId = '$productId' AND sId = '$sId'";
      $getCpd = $this->db->select($chquery);
      if ($getCpd) {
         $msg = "<div class='alert alert-warning'><strong>Product already added!</strong> You should <a href='cart.php' class='alert-link'>Check Your Cart</a>.</div>";
         return $msg;
      } else {
         if ($catId == 1 || $catId == 2 || $catId == 3) {
            $s_size = $this->fm->validation($data['s_size']); 
            $s_size = mysqli_real_escape_string($this->db->link, $data['s_size']);
            $m_size = $this->fm->validation($data['m_size']); 
            $m_size = mysqli_real_escape_string($this->db->link, $data['m_size']);
            $l_size = $this->fm->validation($data['l_size']); 
            $l_size = mysqli_real_escape_string($this->db->link, $data['l_size']);
            $quantity = $s_size + $m_size + $l_size;

            if ($quantity >= 6) {
               $query = "INSERT INTO cart(sId, catId, productId, productName, price, quantity, s_size, m_size, l_size, image) VALUES('$sId', '$catId', '$productId', '$productName', '$price', '$quantity', '$s_size', '$m_size', '$l_size', '$image')";

               $pd_inserted = $this->db->insert($query);

               if ($pd_inserted) {
                  echo "<script>window.location = '../cart.php';</script>";
               } else {
                  echo "<script>window.location = '../404.php';</script>";
               }
            } else {
               $msg = "<div class='alert alert-warning'><strong>No product has been quantified.</strong> You have to order atleast 1 product</div>";
               return $msg;
            }

         } else {
            $quantity = $this->fm->validation($data['quantity']); 
            $quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);   

            $query = "INSERT INTO cart(sId, catId, productId, productName, price, quantity, image) VALUES('$sId', '$catId', '$productId', '$productName', '$price', '$quantity', '$image')";

            $pd_inserted = $this->db->insert($query);

            if ($pd_inserted) {
               echo "<script>window.location = '../cart.php';</script>";
            } else {
               echo "<script>window.location = '../404.php';</script>";
            }   
         }
      } 
   }

   public function deleteCusPdById($id)
   {
       $delquery = "DELETE FROM product WHERE productId = '$id'";
       $pddeleted = $this->db->delete($delquery);
       if ($pddeleted) {
          $msg = "<div class='alert alert-success'><strong>Product Deleted Successfully.</strong></div>";
          return $msg;
       } else {
          $msg = "<div class='alert alert-danger'><strong>Product Not Deleted !</strong></div>";
          return $msg;
       }       

   }

   public function getCustomSoldProduct()
   {
       //$query = "SELECT * FROM product ORDER BY productId DESC"; 
       $query = "SELECT p.*, c.lName FROM product as p, customer as c, pd_sold as s WHERE s.productId = p.productId AND s.cmrId = c.id AND p.pd_type = '1' ORDER BY p.productId DESC LIMIT 4";  
       $result = $this->db->select($query);
       return $result;    
   }

   public function getAllCustomSoldProduct()
   {
       $query = "SELECT p.*, c.lName FROM product as p, customer as c, pd_sold as s WHERE s.productId = p.productId AND s.cmrId = c.id AND p.pd_type = '1' ORDER BY p.productId DESC";  
       $result = $this->db->select($query);
       return $result;    
   }

   public function productCustomByCat($id)
   {
       $id = mysqli_real_escape_string($this->db->link, $id);
       $query = "SELECT p.*, c.lName FROM product as p, customer as c, pd_sold as s WHERE s.productId = p.productId AND s.cmrId = c.id AND p.pd_type = '1' AND p.catId = '$id'"; 
       $result = $this->db->select($query);
       return $result; 
   }

}

?>