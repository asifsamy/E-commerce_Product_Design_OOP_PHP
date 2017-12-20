<?php
   $filepath = realpath(dirname(__FILE__)); 
   include_once ($filepath.'/../lib/Database.php');
   include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Cart
{
   private $db;
   private $fm;

   public function __construct()
   {
	   $this->db = new Database();
	   $this->fm = new Format();
   }

   public function addToCart($data, $id)
   {
      $productId = mysqli_real_escape_string($this->db->link, $id);
      $sId = session_id();

      $squery = "SELECT * FROM product WHERE productId = '$productId'";
      $result = $this->db->select($squery)->fetch_assoc();

      $productName = $result['productName'];
      $price = $result['price'];
      $image = $result['image'];
      $pd_type = $result['pd_type'];
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
               $query = "INSERT INTO cart(sId, catId, productId, productName, price, quantity, s_size, m_size, l_size, image, pd_type) VALUES('$sId', '$catId', '$productId', '$productName', '$price', '$quantity', '$s_size', '$m_size', '$l_size', '$image', '$pd_type')";

               $pd_inserted = $this->db->insert($query);

               if ($pd_inserted) {
                  echo "<script>window.location = 'cart.php';</script>";
               } else {
                  echo "<script>window.location = '404.php';</script>";
               }
            } else {
               $msg = "<div class='alert alert-warning'><strong>No product has been quantified.</strong> You have to order atleast 6 product</div>";
               return $msg;
            }

         } else {
            $quantity = $this->fm->validation($data['quantity']); 
            $quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);   

            $query = "INSERT INTO cart(sId, catId, productId, productName, price, quantity, image, pd_type) VALUES('$sId', '$catId', '$productId', '$productName', '$price', '$quantity', '$image', '$pd_type')";

            $pd_inserted = $this->db->insert($query);

            if ($pd_inserted) {
               echo "<script>window.location = 'cart.php';</script>";
            } else {
               echo "<script>window.location = '404.php';</script>";
            }   
         }
      } 
   }

   public function getCartProduct()
   {
      $sId = session_id();
      $query = "SELECT * FROM cart WHERE sId = '$sId'"; 
      $result = $this->db->select($query);
      return $result; 
   }

   public function updateCartQuantity($data)
   {
      $catId = $this->fm->validation($data['catId']);
      $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
      $cartId = $this->fm->validation($data['cartId']);
      $cartId = mysqli_real_escape_string($this->db->link, $data['cartId']);

      if ($catId == 1 || $catId == 2 || $catId == 3) {
         $s_size = $this->fm->validation($data['s_size']);
         $s_size = mysqli_real_escape_string($this->db->link, $data['s_size']);
         $m_size = $this->fm->validation($data['m_size']); 
         $m_size = mysqli_real_escape_string($this->db->link, $data['m_size']);
         $l_size = $this->fm->validation($data['l_size']); 
         $l_size = mysqli_real_escape_string($this->db->link, $data['l_size']);
         $quantity = $s_size + $m_size + $l_size;
         if ($quantity >= 6) {
            $query = "UPDATE cart SET quantity = '$quantity', s_size = '$s_size', m_size = '$m_size', l_size = '$l_size' WHERE cartId = '$cartId'";

            $cartupdated = $this->db->update($query);
            if ($cartupdated) {
                  echo "<script>window.location = 'cart.php';</script>";
            } else {
                  $msg = "<div class='alert alert-danger'><strong>Quantity Not Updated !</strong></div>";
                  return $msg;
            }
         } else {
            $msg = "<div class='alert alert-warning'><strong>You have to order alleast 6 product</strong></div>";
               return $msg;
               exit();
         }
      } else {
         $quantity = $this->fm->validation($data['quantity']); 
         $quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);

         $query = "UPDATE cart SET quantity = '$quantity' WHERE cartId = '$cartId'";

         $cartupdated = $this->db->update($query);
         if ($cartupdated) {
               echo "<script>window.location = 'cart.php';</script>";
         } else {
               $msg = "<div class='alert alert-danger'><strong>Quantity Not Updated !</strong></div>";
               return $msg;
         }
      }
   }

   public function delPdFromCart($delId)
   {
      $delId = $this->fm->validation($delId);
      $delId = mysqli_real_escape_string($this->db->link, $delId);

      $query = "DELETE FROM cart WHERE cartId = '$delId'";

      $cartdeleted = $this->db->delete($query);
      if ($cartdeleted) {
          echo "<script>window.location = 'cart.php';</script>";
      } else {
          $msg = "<div class='alert alert-danger'><strong>Product Not Deleted !</strong></div>";
          return $msg;
      }
   }

   public function checkCartTable()
   {
      $sId = session_id();
      $query = "SELECT * FROM cart WHERE sId = '$sId'";
      $result = $this->db->select($query);
      return $result;
   }

   public function delCustomerCart()
   {
      $sId = session_id();
      $query = "DELETE FROM cart WHERE sId = '$sId'";
      $this->db->delete($query);
   }
   // delete from here 

   public function payableAmount($cmrId)
   {
      $query = "SELECT price FROM cus_order WHERE cmrId = '$cmrId' AND date = now()";
      $result = $this->db->select($query);
      return $result;
   }

}
?>