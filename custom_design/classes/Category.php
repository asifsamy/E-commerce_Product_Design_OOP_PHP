<?php
   $filepath = realpath(dirname(__FILE__)); 
   include_once ($filepath.'/../lib/Database.php');
   include_once ($filepath.'/../helpers/Format.php');
?>

<?php  
   class Category
   { 	
   	   private $db;
   	   private $fm;
   	
   	   public function __construct()
   	   {
   		   $this->db = new Database();
   		   $this->fm = new Format();
   	   }

   	   public function catInsert($catName)
   	   {
   	   	   $catName = $this->fm->validation($catName); 
   	   	   $catName = mysqli_real_escape_string($this->db->link, $catName);

   	   	    if (empty($catName)){
   	   	   	   $msg = "<div class='alert alert-danger'><strong>Category Field must not be empty !</strong></div>";
   	   	   	   return $msg;
   	   	   } else {
   	   	   	   $query = "INSERT INTO category(catName) VALUES('$catName')";
   	   	   	   $catinsert = $this->db->insert($query);

   	   	   	   if ($catinsert) {
   	   	   	   	   $msg = "<div class='alert alert-success'><strong>Category Inserted Successfully!</strong></div>";
   	   	   	   	   return $msg;
   	   	   	   } else {
   	   	   	   	   $msg = "<div class='alert alert-danger'><strong>Category is not Inserted !</strong></div>";
   	   	   	   	   return $msg;
   	   	   	   }
   	   	   }
   	   }

   	   public function getAllCat()
   	   {
   	   	   $query = "SELECT * FROM category ORDER BY catId DESC"; 
   	   	   $result = $this->db->select($query);
   	   	   return $result;
   	   }

   	   public function getCatById($id)
   	   {
   	   	   $query = "SELECT * FROM category WHERE catId = '$id'"; 
   	   	   $result = $this->db->select($query);
   	   	   return $result;
   	   }

       public function catUpdate($catName, $id)
       {
       	   $catName = $this->fm->validation($catName); 
   	   	   $catName = mysqli_real_escape_string($this->db->link, $catName);
           $id = mysqli_real_escape_string($this->db->link, $id);

   	   	    if (empty($catName)){
   	   	   	   $msg = "<div class='alert alert-danger'><strong>Category Field must not be empty !</strong></div>";
   	   	   	   return $msg;
   	   	   } else {
   	   	   	   $query = "UPDATE category SET catName = '$catName' WHERE catId = '$id'";

   	   	   	   $catupdated = $this->db->update($query);
   	   	   	   if ($catupdated) {
   	   	   	   	   $msg = "<div class='alert alert-success'><strong>Category Updated Successfully.</strong></div>";
   	   	   	   	   return $msg;
   	   	   	   } else {
   	   	   	   	   $msg = "<div class='alert alert-danger'><strong>Category Not Updated !</strong></div>";
   	   	   	   	   return $msg;
   	   	   	   }
   	   	   }
       }
    
       public function delCatById($id)
       {
       	   $query = "DELETE FROM category WHERE catId = '$id'";

       	   $catdeleted = $this->db->delete($query);
       	   if ($catdeleted) {
 	   	   	    $msg = "<div class='alert alert-success'><strong>Category Deleted Successfully.</strong></div>";
 	   	   	    return $msg;
   	   	   } else {
   	   	   	  $msg = "<div class='alert alert-danger'><strong>Category Not Deleted !</strong></div>";
   	   	   	  return $msg;
   	   	   }

       }

   }
?>