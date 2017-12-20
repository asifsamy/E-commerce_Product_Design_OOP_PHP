<?php
   $filepath = realpath(dirname(__FILE__)); 
   include_once ($filepath.'/../lib/Database.php');
   include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Customer
{
   private $db;
   private $fm;

   public function __construct()
   {
	   $this->db = new Database();
	   $this->fm = new Format();
   }

   public function customerRegistration($data)
   {
      $fName = $this->fm->validation($data['fName']); 
      $fName = mysqli_real_escape_string($this->db->link, $data['fName']);
      $lName = $this->fm->validation($data['lName']); 
      $lName = mysqli_real_escape_string($this->db->link, $data['lName']);
      $email = $this->fm->validation($data['email']); 
      $email = mysqli_real_escape_string($this->db->link, $data['email']);
      $pass = $this->fm->validation(md5($data['pass'])); 
      $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
      $address = $this->fm->validation($data['address']); 
      $address = mysqli_real_escape_string($this->db->link, $data['address']);
      $city = $this->fm->validation($data['city']); 
      $city = mysqli_real_escape_string($this->db->link, $data['city']);
      $zip = $this->fm->validation($data['zip']); 
      $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
      $country = $this->fm->validation($data['country']); 
      $country = mysqli_real_escape_string($this->db->link, $data['country']);
      $phone = $this->fm->validation($data['phone']); 
      $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
      $code = md5(uniqid(rand())); //for email veification

      if ($fName == "" || $lName == "" || $email == "" || $pass == "" || $address == "" || $city == "" || $zip == "" || $country == "" || $phone == "") {
         $msg = "<div class='alert alert-danger'><strong>Fields must not be empty !</strong></div>";
         return $msg;
       }

       $mailquery = "SELECT * FROM customer WHERE email='$email' LIMIT 1";
       $mailchk = $this->db->select($mailquery);
       if ($mailchk != false) {
          $msg = "<div class='alert alert-danger'><strong>Email already Exist !</strong></div>";
          return $msg;
       } else {
           $query = "INSERT INTO customer(fName, lName, email, pass, address, city, zip, country, phone, code) VALUES('$fName', '$lName', '$email', '$pass', '$address', '$city', '$zip', '$country', '$phone', '$code')";

            $cus_inserted = $this->db->insert($query);

            if ($cus_inserted) {
                // $msg = "<div class='alert alert-success'><strong>Customer Data Inserted Successfully !</strong></div>";

              /*email verification*/
              $idC = $this->db->lastIdInsert();    
              $key = base64_encode($idC);
              $idC = $key;
              
              $message = "          
                    Hello $lName,
                    <br /><br />
                    Welcome to Coding Cage!<br/>
                    To complete your registration  please , just click following link<br/>
                    <br /><br />
                    <a href='http://localhost/custom_design/verify.php?id=$idC&code=$code'>Click HERE to Activate :)</a>
                    <br /><br />
                    Thanks,";
                    
              $subject = "Confirm Registration";
                    
              $this->send_mail($email,$message,$subject); 
              $msg = "
                  <div class='alert alert-success'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Success!</strong>  We've sent an email to $email.
                            Please click on the confirmation link in the email to create your account. 
                    </div>
                  ";
                /*end of email verification*/  
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'><strong>Customer Data Insertion Unsuccessfully !</strong></div>";
                return $msg;
            }
       }
   }

   public function customerLogin($data)
   {
      $email = $this->fm->validation($data['email']); 
      $email = mysqli_real_escape_string($this->db->link, $data['email']);
      $pass = $this->fm->validation(md5($data['pass'])); 
      $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));

      if (empty($email) || empty($pass)) {
         $msg = "<div class='alert alert-danger'><strong>Fields must not be empty !</strong></div>";
         return $msg;
      }

      $query = "SELECT * FROM customer WHERE email='$email'";
      $result = $this->db->select($query);
      if ($result != false) {
         $value = $result->fetch_assoc();
         if ($value['status'] == 0) {
           $msg = "<div class='alert alert-error'><button class='close' data-dismiss='alert'>&times;</button><strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it.</div>";
           return $msg;
         } elseif ($value['status'] == 1 && $value['pass'] == $pass) {
           Session::set("cuslogin", true);
           Session::set("cmrId", $value['id']);
           Session::set("cmrName", $value['lName']);
           echo "<script>window.location = 'cart.php';</script>";
           //header("Location:cart.php");  
         } elseif($value['status'] == 2) {
           echo "<script>window.location = 'block.php';</script>";
         } else {
           if (!isset($_SESSION['failed_login'])) 
           {
             $_SESSION['failed_login'] = 1;
           } else {
             if ($_SESSION['failed_login'] >= 2){
               $query = "UPDATE customer 
                      SET 
                      status = '2' 
                  WHERE email='$email'";
                $upStatus = $this->db->update($query);
                if ($upStatus) {
                   unset($_SESSION["failed_login"]);
                }
             } else {
               $_SESSION['failed_login']++;
             }
           } 
           $msg = "<div class='alert alert-error'><strong> Password missmatch !</strong></div>";
           return $msg;
         }
         
      } else {
         $msg = "<div class='alert alert-error'><strong>Email or Password missmatch !</strong></div>";
         return $msg;
      }
   }

   public function getCustomerData($id)
   {
      $query = "SELECT * FROM customer WHERE id = '$id'";
      $result = $this->db->select($query);
      return $result;
   }

   public function getAllCustomer()
   {
      $query = "SELECT * FROM customer";
      $result = $this->db->select($query);
      return $result;
   }

   public function deleteCustomerById($id)
   {
      $query = "DELETE FROM customer WHERE id = '$id'";
      $cusdeleted = $this->db->delete($query);
      if ($cusdeleted) {
          $msg = "<div class='alert alert-success'><strong>Customer Deleted Successfully.</strong></div>";
          return $msg;
       } else {
          $msg = "<div class='alert alert-danger'><strong>Customer Not Deleted !</strong></div>";
          return $msg;
       }
   }

   public function updateCusStatus($id, $code)
   {
      $query = "UPDATE customer 
                    SET 
                    status = '1' 
                WHERE id = '$id' AND code = '$code'";
      $upStatus = $this->db->update($query);

      if ($upStatus) {
         $msg = "<div class='alert alert-success'>
           <button class='close' data-dismiss='alert'>&times;</button>
            <strong>WoW !</strong>  Your Account is Now Activated : <a href='login.php'>Login here</a>
             </div>";
         return $msg;
      } else {
         $msg = "<div class='alert alert-error'>
           <button class='close' data-dismiss='alert'>&times;</button>
            <strong>sorry !</strong>  Your Account is allready Activated : <a href='login.php'>Login here</a>
             </div>";
         return $msg;
      }
   }

   public function updateCusPassword($data)
   {
      $email = $this->fm->validation($data['email']); 
      $email = mysqli_real_escape_string($this->db->link, $data['email']);

      $query = "SELECT id FROM customer WHERE email = '$email'";
      $result = $this->db->select($query);
      if ($result != false) {
        $value = $result->fetch_assoc();
        $id = base64_encode($value['id']);
        $code = md5(uniqid(rand()));

        $upQuery = "UPDATE customer SET code = '$code' WHERE email = '$email'"; 
        $passUpdate = $this->db->update($upQuery);
        
        $message= "
               Hello , $email
               <br /><br />
               We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
               <br /><br />
               Click Following Link To Reset Your Password 
               <br /><br />
               <a href='http://localhost/custom_design/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
               <br /><br />
               thank you :)
               ";
        $subject = "Password Reset";
        
        $this->send_mail($email,$message,$subject);
        
        $msg = "<div class='alert alert-success'>
              <button class='close' data-dismiss='alert'>&times;</button>
              We've sent an email to $email.
                        Please click on the password reset link in the email to generate new password. 
              </div>";

        return $msg;      
      } else {
        $msg = "<div class='alert alert-danger'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong>  This email is not found. 
          </div>";
        return $msg;
      }

   }

   public function resetPassword($id, $data)
   {
      $pass = $this->fm->validation(md5($data['pass'])); 
      $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
      $cPass = $this->fm->validation(md5($data['cPass'])); 
      $cPass = mysqli_real_escape_string($this->db->link, md5($data['cPass']));

      if($cPass !== $pass)
      {
        $msg = "<div class='alert alert-block'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>Sorry!</strong>  Password Doesn't match. 
            </div>";
        return $msg;    
      }
      else
      {
        $query = "UPDATE customer SET pass = '$cPass', status = '1' WHERE id = '$id'";
        $resPass = $this->db->update($query);

        if ($resPass) {
          $msg = "<div class='alert alert-success'>
            <button class='close' data-dismiss='alert'>&times;</button>
            Password Changed.
            </div>";
          return $msg;
        } else {
          $msg = "<div class='alert alert-success'>
          <button class='close' data-dismiss='alert'>&times;</button>
          No Account Found, Try again
          </div>";
          return $msg;
        }
      }
   }

   public function customerUpdate($data, $cmrId)
   {
      $fName = $this->fm->validation($data['fName']); 
      $fName = mysqli_real_escape_string($this->db->link, $data['fName']);
      $lName = $this->fm->validation($data['lName']); 
      $lName = mysqli_real_escape_string($this->db->link, $data['lName']);
      // $email = $this->fm->validation($data['email']); 
      // $email = mysqli_real_escape_string($this->db->link, $data['email']);
      $address = $this->fm->validation($data['address']); 
      $address = mysqli_real_escape_string($this->db->link, $data['address']);
      $city = $this->fm->validation($data['city']); 
      $city = mysqli_real_escape_string($this->db->link, $data['city']);
      $zip = $this->fm->validation($data['zip']); 
      $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
      $country = $this->fm->validation($data['country']); 
      $country = mysqli_real_escape_string($this->db->link, $data['country']);
      $phone = $this->fm->validation($data['phone']); 
      $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

      if ($fName == "" || $lName == "" || /*$email == "" || */$address == "" || $city == "" || $zip == "" || $country == "" || $phone == "") {
         $msg = "<div class='alert alert-danger'><strong>Fields must not be empty !</strong></div>";
         return $msg;
       } else {
          $query = "UPDATE customer 
                    SET 
                    fName = '$fName',
                    lName = '$lName',

                    address = '$address',
                    city = '$city',
                    zip = '$zip',
                    country = '$country',
                    phone = '$phone' 
                    WHERE id = '$cmrId'";

          $cusupdated = $this->db->update($query);
          if ($cusupdated) {
            
             $msg = "<div class='alert alert-success'><strong>Customer Data Updated Successfully !</strong></div>";
             return $msg;
          } else {
             $msg = "<div class='alert alert-danger'><strong>Customer Data Not Updated Successfully !</strong></div>";
             return $msg;
          }
       }    
   }

   public function confirmPaymentMail($email, $t_amnt)
   {
      $message= "
               Hello , $email
               <br /><br />
               Your have paid $t_amnt TK Successfully. Soon you will be responded by our company vaia mobile. Please active your given number.<br><br> Thank You :)
               ";
        $subject = "Payment Verification";
        
        $this->send_mail($email,$message,$subject);
        $email = "customdesign75@gmail.com";

        $message= "
               Hello , $email
               <br /><br />
               Your have been paid $t_amnt TK Successfully by $email. Contact with this Customer as soon as possible.<br><br> Thank You :)
               ";
        
        $this->send_mail($email,$message,$subject);
   }

  function send_mail($email,$message,$subject)
  {           
      require_once('mailer/class.phpmailer.php');
      $mail = new PHPMailer();
      $mail->IsSMTP(); 
      $mail->SMTPDebug  = 0;                     
      $mail->SMTPAuth   = true;                  
      $mail->SMTPSecure = "ssl";                 
      $mail->Host       = "smtp.gmail.com";      
      $mail->Port       = 465;             
      $mail->AddAddress($email);
      $mail->Username="customdesign75@gmail.com";  
      $mail->Password="blok887516";            
      $mail->SetFrom('customdesign75@gmail.com','Custom Design');
      $mail->AddReplyTo("customdesign75@gmail.com","Custom Design");
      $mail->Subject    = $subject;
      $mail->MsgHTML($message);
      $mail->Send();
  }

}
?>