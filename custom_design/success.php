<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->
<?php
   $login = Session::get("cuslogin");
   if ($login == false) {
   	echo "<script>window.location = 'login.php';</script>";
         //header("Location:login.php");

   }
?>
<style>
    .payment{width: 500px; min-height: 200px; text-align: center; border: 1px solid #ddd; margin: 0 auto; padding: 20px;}
    .payment h2{border-bottom: 1px solid #ddd; margin-bottom: 20px; padding-bottom: 10px;}
</style>

<div id="mainBody">
  <div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<?php include 'inc/sidebar.php';?>
<!-- Sidebar end=============================================== -->
	    <div class="span9">	
	    <ul class="breadcrumb">
		    <li><a href="index.php">Home</a> <span class="divider">/</span></li>
		    <li class="active"> Payment</li>
        </ul>
        <div class="payment">
            <h2>Success</h2>
            <?php /*
                $cmrId = Session::get("cmrId");
                $amount = $ct->payableAmount($cmrId);
                if ($amount) {
                  $sum = 0;
                  while ($result = $amount->fetch_assoc()) {
                    $price = $result['price'];
                    $sum = $sum + $price;
                  }
                } */
            ?>
            <div class="alert alert-success" style="font-size: 18px;"><strong>Payment Successful !</strong><br>Check your Email. Thanks for Purchasing.<!-- Total Payable Amount (Including VAT) TK. 
              <?php /*
                 $vat = $sum * 0.1;
                 $total = $sum + $vat;
                 echo $total; */
              ?>.--> We will contact you as soon as possible with deivery details. Here is your Order Details... <a href="orderdetails.php" class="alert-link">Visit Here</a></div>
        </div>
        </div>
     </div> 
  </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
<?php include 'inc/footer.php';?>