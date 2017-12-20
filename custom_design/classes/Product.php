<?php
   $filepath = realpath(dirname(__FILE__)); 
   include_once ($filepath.'/../lib/Database.php');
   include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Product
{
   private $db;
   private $fm;

   public function __construct()
   {
	   $this->db = new Database();
	   $this->fm = new Format();
   }

   public function productInsert($data, $file)
   {
   	   $productName = $this->fm->validation($data['productName']); 
   	   $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
   	   $catId = $this->fm->validation($data['catId']); 
   	   $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
   	   $body = $this->fm->validation($data['body']); 
   	   $body = mysqli_real_escape_string($this->db->link, $data['body']);
   	   $price = $this->fm->validation($data['price']); 
   	   $price = mysqli_real_escape_string($this->db->link, $data['price']);

   	   $permited  = array('jpg', 'jpeg', 'png', 'gif');
       $file_name = $file['image']['name'];
       $file_size = $file['image']['size'];
       $file_temp = $file['image']['tmp_name'];

       $div = explode('.', $file_name);
       $file_ext = strtolower(end($div));
       $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
       $uploaded_image = "uploads/".$unique_image;

       if ($productName == "" || $catId == "" || $body == "" || $price == "" || $file_name == "") {
       	   $msg = "<span class='error'>Fields must not be empty !</span>";
	   	   	   return $msg;

       } elseif ($file_size > 1048567) {
       	   echo "<span class='error'>Image Size should be less than 1MB</span>";

       } elseif (in_array($file_ext, $permited) === false) {
       	   echo "<span class='error'>You can Upload only:-".implode(',', $permited)."</span>";
       	   
       } else {
       	   move_uploaded_file($file_temp, $uploaded_image);
       	   $query = "INSERT INTO product(productName, catId, body, price, image) VALUES('$productName', '$catId', '$body', '$price', '$uploaded_image')";

       	   $pd_inserted = $this->db->insert($query);

	   	   	   if ($pd_inserted) {
	   	   	   	   $msg = "<div class='alert alert-success'><strong>Product Inserted Successfully.</strong></div>";
	   	   	   	   return $msg;
	   	   	   } else {
	   	   	   	   $msg = "<div class='alert alert-danger'><strong>Product Insertion Unsuccessfully !</strong></div>";
	   	   	   	   return $msg;
	   	   	   }
       }
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
       $price = $this->fm->validation($pd_type); 
       $price = mysqli_real_escape_string($this->db->link, $pd_type);

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

   public function getAllProduct()
   {
      $query = "SELECT p.*, c.catName FROM product as p, category as c WHERE p.catId = c.catId ORDER BY p.productId DESC";
      /*
      $query = "SELECT product.*, category.catName FROM product INNER JOIN category ON product.catId = category.catId ORDER BY product.productId DESC";
      */
      $result = $this->db->select($query);
      return $result;
   }

   public function getProductById($id)
   {
       $query = "SELECT * FROM product WHERE productId = '$id'"; 
       $result = $this->db->select($query);
       return $result;           
   }

   public function productUpdate($data, $file, $id)
   {
       $productName = $this->fm->validation($data['productName']); 
       $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
       $catId = $this->fm->validation($data['catId']); 
       $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
       $body = $this->fm->validation($data['body']); 
       $body = mysqli_real_escape_string($this->db->link, $data['body']);
       $price = $this->fm->validation($data['price']); 
       $price = mysqli_real_escape_string($this->db->link, $data['price']);

       $permited  = array('jpg', 'jpeg', 'png', 'gif');
       $file_name = $file['image']['name'];
       $file_size = $file['image']['size'];
       $file_temp = $file['image']['tmp_name'];

       $div = explode('.', $file_name);
       $file_ext = strtolower(end($div));
       $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
       $uploaded_image = "uploads/".$unique_image;

       if ($productName == "" || $catId == "" || $body == "" || $price == "") {
           $msg = "<div class='alert alert-danger'><strong>Fields must not be emplty !</strong></div>";
           return $msg;

       } else {
           if (!empty($file_name)) {

               if ($file_size > 1048567) {
                  echo "<div class='alert alert-danger'><strong>Image Size should be less than 1MB</strong></div>";

               } elseif (in_array($file_ext, $permited) === false) {
                  echo "<div class='alert alert-danger'><strong>You can Upload only:-".implode(',', $permited)."</strong></div>";
               
               } else {
                   move_uploaded_file($file_temp, $uploaded_image);

                   $query = "UPDATE product 
                             SET 
                                productName = '$productName',
                                catId = '$catId',
                                body = '$body',
                                price = '$price',
                                image = '$uploaded_image'
                                WHERE productId = '$id'";

                   $pd_updated = $this->db->update($query);

                   if ($pd_updated) {
                     $msg = "<div class='alert alert-success'><strong>Product Updated Successfully.</strong></div>";
                     return $msg;
                   } else {
                     $msg = "<div class='alert alert-danger'><strong>Product not Updated !</strong></div>";
                     return $msg;
                   }
               }
         } else {
             $query = "UPDATE product 
                       SET 
                          productName = '$productName',
                          catId = '$catId',
                          body = '$body',
                          price = '$price'
                          WHERE productId = '$id'";

             $pd_updated = $this->db->update($query);

             if ($pd_updated) {
               $msg = "<div class='alert alert-success'><strong>Product Updated Successfully.</strong></div>";
               return $msg;
             } else {
               $msg = "<div class='alert alert-danger'><strong>Product not Updated !</strong></div>";
               return $msg;
             }   
         }
      }
   }

   public function deletePdById($id)
   {
       $query = "SELECT * FROM product WHERE productId = '$id'";
       $getData = $this->db->select($query);

       if ($getData) {
          while ($delImg = $getData->fetch_assoc()) {
             $dellink = $delImg['image'];
             unlink($dellink);
          }
       }

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

   public function getFeaturedProduct()
   {
       //$query = "SELECT * FROM product ORDER BY productId DESC"; 
       $query = "SELECT * FROM product WHERE pd_type = '0' ORDER BY productId DESC LIMIT 6"; 
       $result = $this->db->select($query);
       return $result;    
   }
   public function getAllFeaturedProduct()
   {
       $query = "SELECT * FROM product WHERE pd_type = '0' ORDER BY productId DESC"; 
       $result = $this->db->select($query);
       return $result;    
   }

   public function getSingleProduct($id)
   {
       $query = "SELECT p.*, c.catName FROM product as p, category as c WHERE p.catId = c.catId AND p.productId = '$id'";

      $result = $this->db->select($query);
      return $result;
   }

   public function productByCat($id)
   {
       $id = mysqli_real_escape_string($this->db->link, $id);
       $query = "SELECT * FROM product WHERE catId = '$id' AND pd_type = '0'"; 
       $result = $this->db->select($query);
       return $result; 
   }

}

?>