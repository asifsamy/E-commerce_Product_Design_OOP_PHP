<?php
   $filepath = realpath(dirname(__FILE__)); 
   include_once ($filepath.'/../lib/Database.php');
   include_once ($filepath.'/../helpers/Format.php');
?>

<?php  
   class Contact
   { 	
   	   private $db;
   	   private $fm;
   	
   	   public function __construct()
   	   {
   		   $this->db = new Database();
   		   $this->fm = new Format();
   	   }

       public function userMessage($data)
         {
            $name = $this->fm->validation($data['name']); 
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $email = $this->fm->validation($data['email']); 
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $subject = $this->fm->validation($data['subject']); 
            $subject = mysqli_real_escape_string($this->db->link, $data['subject']);
            $body = $this->fm->validation($data['body']); 
            $body = mysqli_real_escape_string($this->db->link, $data['body']);

            if ($name == "" || $email == "" || $subject == "" || $body == "") {
               $msg = "<div class='alert alert-danger'><strong>Fields must not be empty !</strong></div>";
               return $msg;
             } else {
               $query = "INSERT INTO contact(name, email, subject, body) VALUES('$name', '$email', '$subject', '$body')";

               $cus_msg = $this->db->insert($query);

               if ($cus_msg) {
                   $msg = "<div class='alert alert-success'><strong>Message has been sent Successfully.</strong> We will reply you via email</div>";
                   return $msg;
                 
               } else {
                   $msg = "<div class='alert alert-danger'><strong>Message has not been sent Successfully !</strong></div>";
                   return $msg;
               }
             }
         }

         public function getUnreadMsg()
         {
            $query = "SELECT * FROM contact ORDER BY date DESC";
            $result = $this->db->select($query);
            return $result;
         }

         public function CountUnreadMsg()
         {
            $query = "SELECT id FROM contact WHERE status = '0' ORDER BY date DESC";
            $result = $this->db->select($query);
            return $result;
         }

         public function deleteMsgById($id)
         {
             $delquery = "DELETE FROM contact WHERE id = '$id'";
             $msgdeleted = $this->db->delete($delquery);
             if ($msgdeleted) {
                $msg = "<div class='alert alert-success'><strong>Message Deleted Successfully.</strong></div>";
                return $msg;
             } else {
                $msg = "<div class='alert alert-danger'><strong>Message Not Deleted !</strong></div>";
                return $msg;
             } 
         }

         public function getMsgById($id)
         {
             $query = "SELECT * FROM contact WHERE id = '$id'"; 
             $result = $this->db->select($query);
             return $result;  
         }

         public function updateStatusMsg($id)
         {
             $query = "UPDATE contact SET status = '1' WHERE id = $id AND status = '0'";
             $result = $this->db->update($query);
             return $result;  
         }

         public function visitorCount()
         {
             $date = date("Y-m-d");
             $userIP = $_SERVER['REMOTE_ADDR'];
             $query = "SELECT * FROM visits WHERE date = '$date'";
             $result = $this->db->select($query);

             if (!isset($_COOKIE['visitor'])) {
               $time = strtotime('next day 00:00');
               setcookie('visitor','hey',$time);
             }
             if ($result != false) {
               $row = $result->fetch_assoc();
               if (!isset($_COOKIE['visitor'])) {
                 $newIP = $row['ip'];
                 if (!preg_match('/'.$userIP.'/', $newIP)) {
                   $newIP .= "$userIP";
                 }
                 $t_views = $row['views'] + 1;
                  //echo $t_views."<br>";
                 $updateQuery = "UPDATE visits SET ip = '$newIP', views = '$t_views' WHERE date = '$date'";
                 $updatedVisits = $this->db->update($updateQuery);
               }
             } else {
               $insertVisitor = "INSERT INTO visits (date, ip) VALUES('$date', '$userIP')";
               $vis_inserted = $this->db->insert($insertVisitor);
             }
         }

         public function getTotalVisitors()
         {
            $query = "SELECT * FROM visits";
            $result = $this->db->select($query);
            return $result;
         }

         public function dailyViews()
         {
            $date = date("Y-m-d");
            $query = "SELECT * FROM visits WHERE date = '$date'";
            $result = $this->db->select($query);
            if ($result != false) {
              $row_cnt = $result->fetch_assoc();
              $td_views = $row_cnt['cnt_views'] + 1;
              $updateCntQuery = "UPDATE visits SET cnt_views = '$td_views' WHERE date = '$date'";
              $updatedDVisits = $this->db->update($updateCntQuery);
            }
         }
   }
?>