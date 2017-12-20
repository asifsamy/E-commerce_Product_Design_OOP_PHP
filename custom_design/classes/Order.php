<?php
   $filepath = realpath(dirname(__FILE__)); 
   include_once ($filepath.'/../lib/Database.php');
   include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Order
{
   private $db;
   private $fm;

   public function __construct()
   {
	   $this->db = new Database();
	   $this->fm = new Format();
   }

   public function insertOrderedProduct($cmrId)
   {
      $sId = session_id();
      $query = "SELECT * FROM cart WHERE sId = '$sId'";
      $getPd = $this->db->select($query);
      if ($getPd) {
         while ($result = $getPd->fetch_assoc()) {
            $productId = $result['productId'];
            $productName = $result['productName'];
            $quantity = $result['quantity'];
            $s_size = $result['s_size'];
            $m_size = $result['m_size'];
            $l_size = $result['l_size'];
            $price = $result['price'];
            $image = $result['image'];
            $pd_type = $result['pd_type'];
            
            $query = "INSERT INTO cus_order(cmrId, productId, productName, quantity, s_size, m_size, l_size, price, image, pd_type) VALUES('$cmrId', '$productId', '$productName', '$quantity', '$s_size', '$m_size', '$l_size', '$price', '$image', '$pd_type')";

            $od_inserted = $this->db->insert($query);
            if ($od_inserted) {
               $queryCus = "SELECT email FROM customer WHERE id = '$cmrId'";
               $cus_result = $this->db->select($queryCus);
               return $cus_result;
            }
         }
      }
   }

   public function payableAmount($cmrId)
   {
      $query = "SELECT price FROM cus_order WHERE cmrId = '$cmrId' AND date = now()";
      $result = $this->db->select($query);
      return $result;
   }

   public function getOrderedProduct($cmrId)
   {
      $query = "SELECT * FROM cus_order WHERE cmrId = '$cmrId' ORDER BY date DESC";
      $result = $this->db->select($query);
      return $result;
   }

   public function checkOrder($cmrId)
   {
      $query = "SELECT * FROM cus_order WHERE cmrId = '$cmrId'";
      $result = $this->db->select($query);
      return $result;
   }

   public function getAllOrderedProduct()
   {
      $query = "SELECT * FROM cus_order ORDER BY date DESC";
      $result = $this->db->select($query);
      return $result;
   }
   
   public function getPendingOrder()
   {
      $query = "SELECT * FROM cus_order WHERE status = '0' ORDER BY date DESC";
      $result = $this->db->select($query);
      return $result;
   }

   public function productShifted($id, $date, $price)
   {
      $id    = $this->fm->validation($id);
      $id    = mysqli_real_escape_string($this->db->link, $id);
      $date  = $this->fm->validation($date);
      $date  = mysqli_real_escape_string($this->db->link, $date);
      $price = $this->fm->validation($price);
      $price = mysqli_real_escape_string($this->db->link, $price);

      $query = "UPDATE cus_order SET status = '1' WHERE cmrId = '$id' AND date = '$date' AND price = '$price'";

      $updated_row = $this->db->update($query);
      if ($updated_row) {
            $msg = "<div class='alert alert-success'><strong>Updated Successfully !</strong></div>";
            return $msg;
      } else {
            $msg = "<div class='alert alert-danger'><strong>Not Updated !</strong></div>";
            return $msg;
      }
   }

   public function cancelOrder($id, $date, $price)
   {
      $id    = $this->fm->validation($id);
      $id    = mysqli_real_escape_string($this->db->link, $id);
      $date  = $this->fm->validation($date);
      $date  = mysqli_real_escape_string($this->db->link, $date);
      $price = $this->fm->validation($price);
      $price = mysqli_real_escape_string($this->db->link, $price);

      $query = "UPDATE cus_order SET status = '2' WHERE cmrId = '$id' AND date = '$date' AND price = '$price'";

      $updated_row = $this->db->update($query);
      if ($updated_row) {
            $msg = "<div class='alert alert-success'><strong>Updated Successfully !</strong></div>";
            return $msg;
      } else {
            $msg = "<div class='alert alert-danger'><strong>Not Updated !</strong></div>";
            return $msg;
      }
   }

   public function delShiftedProduct($id, $time, $price)
   {
      $id    = $this->fm->validation($id);
      $id    = mysqli_real_escape_string($this->db->link, $id);
      $date  = $this->fm->validation($time);
      $date  = mysqli_real_escape_string($this->db->link, $time);
      $price = $this->fm->validation($price);
      $price = mysqli_real_escape_string($this->db->link, $price);

      $query = "DELETE FROM cus_order WHERE cmrId = '$id' AND date = '$date' AND price = '$price'";

      $deldata = $this->db->delete($query);
      if ($deldata) {
          $msg = "<div class='alert alert-success'><strong>Data Deleted Successfully !</strong></div>";
          return $msg;
      } else {
          $msg = "<div class='alert alert-danger'><strong>Data Not Deleted !</strong></div>";
          return $msg;
      }
   }

   public function soldPdInserted($id, $time, $price)
   {
      $id    = $this->fm->validation($id);
      $id    = mysqli_real_escape_string($this->db->link, $id);
      $date  = $this->fm->validation($time);
      $date  = mysqli_real_escape_string($this->db->link, $time);
      $price = $this->fm->validation($price);
      $price = mysqli_real_escape_string($this->db->link, $price);

      $squery = "SELECT * FROM cus_order WHERE cmrId = '$id' AND date = '$date' AND price = '$price'";
      $getPd = $this->db->select($squery);
      if ($getPd) {
         while ($result = $getPd->fetch_assoc()) {
            $oId = $result['id'];
            $cmrId = $result['cmrId'];
            $productId = $result['productId'];
            $productName = $result['productName'];
            $quantity = $result['quantity'];
            $price = $result['price'] * $quantity;
            $pd_type = $result['pd_type'];
         }
         $query = "INSERT INTO pd_sold(oId, cmrId, productId, productName, quantity, price, pd_type) VALUES('$oId', '$cmrId', '$productId', '$productName', '$quantity', '$price', '$pd_type')";

         $od_inserted = $this->db->insert($query);
      }
   }

   public function getSoldProduct($t_date)
   {
      $query = "SELECT * FROM pd_sold WHERE date LIKE '%$t_date%'";
      $result = $this->db->select($query);
      return $result;
      //$query = "SELECT * FROM pd_sold WHERE date BETWEEN 't_date' AND '2017-11-01'";
   }

   public function getSoldProduct2($t1_date, $t2_date)
   {
      $query = "SELECT * FROM pd_sold WHERE date BETWEEN '$t1_date' AND '$t2_date'";
      $result = $this->db->select($query);
      return $result;
   }

   public function getSoldInfoByCustomer($id)
   {
      $query = "SELECT * FROM pd_sold WHERE cmrId = '$id'";
      $result = $this->db->select($query);
      return $result;
   }

   public function getYear()
   {
      $query = "SELECT sum(price) as total FROM pd_sold WHERE YEAR(date) = YEAR(curdate()) ; ";
      $result = $this->db->select($query);
      return $result;
   }

   public function getMonth($i)
   {
      $query = "SELECT sum(price) as total2 FROM pd_sold WHERE MONTH(date) = '$i' ; ";
      $result = $this->db->select($query);
      return $result;
   }

}
?>