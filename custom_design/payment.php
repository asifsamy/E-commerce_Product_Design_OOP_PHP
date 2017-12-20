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
    .payment{width: 500px; min-height: 200px; text-align: center; border: 1px solid #ddd; margin: 0 auto; padding: 50px;}
    .payment h2{border-bottom: 1px solid #ddd; margin-bottom: 40px; padding-bottom: 10px;}
    .payment a{background: #e60000 none repeat scroll 0 0; border-radius: 4px; color: #fff; font-size: 25px; padding: 5px 30px; text-decoration: none;}
    .back a{width: 160px; margin: 5px auto 0; padding: 7px 0; text-align: center; display: block; background: #555; border: 1px solid #333; color: #fff; border-radius: 3px; font-size: 25px; text-decoration: none;}
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
            <h2>Choose Payment Option</h2>
            <a href="paymentOffline.php">Offline Payment</a>
            <a href="paymentOnline.php">Online Payment</a>
        </div>
        <div class="back">
            <a href="cart.php">Previous</a>
        </div>
        </div>
     </div> 
  </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
<?php include 'inc/footer.php';?>