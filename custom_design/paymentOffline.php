<?php include 'inc/header.php';?>
<?php require_once 'vendor/autoload.php'; ?>
<!-- Header End====================================================================== -->
<?php
   $login = Session::get("cuslogin");
   if ($login == false) {
   	echo "<script>window.location = 'login.php';</script>";
         //header("Location:login.php");

   }
?>
<?php
   $stripe = [
      'publishable' => 'pk_test_HauRbDoADWAIcxJwnf53wUhV',
      'private' => 'sk_test_QWW9kove891kn8SUwvs2rUbS'
  ];

  \Stripe\Stripe::setApiKey($stripe['private']);
?>
<style>
  .ordernow{padding-bottom: 30px; padding-top: 20px;}
  .ordernow a{width: 200px; margin: 20px auto 0; text-align: center; padding: 15px; font-size: 30px; display: block; background: #e60000; color: #fff; border-radius: 5px; text-decoration: none;}
</style>

<div id="mainBody">
  <div class="container">
	<div class="row">
	    <div class="span12">	
  	    <ul class="breadcrumb">
  		    <li><a href="index.php">Home</a> <span class="divider">/</span></li>
  		    <li class="active"> Offline Payment</li>
        </ul>
        <div class="span6">
          <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>  
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
            <?php
                $getproduct = $ct->getCartProduct();
                if ($getproduct) {
                  $i = 0;
                  $sum = 0;
                  $item = 0;
                  while ($result = $getproduct->fetch_assoc()) {
                    $i++;
            ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['productName']; ?></td>
                  <td>Tk. <?php echo $result['price']; ?></td>
                  <td><?php echo $result['quantity']; ?></td>
                  <td>Tk. <?php
                                $total = $result['price'] * $result['quantity'];
                      echo $total; 
                  ?>
                  </td>
                </tr>
      <?php
         $sum = $sum + $total; 
         $item = $item + $result['quantity'];
      ?>  
      <?php } } ?>
                <tr>
                  <td colspan="4" style="text-align:right">Sub Total </td>
                  <td colspan="2"> TK. <?php echo $sum; ?></td>
                </tr>
                 <tr>
                  <td colspan="4" style="text-align:right">VAT </td>
                  <td colspan="2"> 10%</td>
                </tr>
                <tr>
                  <?php $vat = $sum * 0.1; ?>
                  <td colspan="4" style="text-align:right"><strong>GRAND TOTAL (TK. <?php echo $sum; ?> + TK. <?php echo $vat; ?>) </strong></td>
                  <td colspan="2" class="badge-warning"> <strong> TK. 
                    <?php
                       $gtotal = $sum + $vat;
                       echo $gtotal;
                       $gtotalP = 100 * $gtotal;
                    ?> </strong>
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="span5">
          <?php
        $id = Session::get("cmrId");
        $getData = $cus->getCustomerData($id);
        if ($getData) {
          while ($result = $getData->fetch_assoc()) {
    ?>
        <table class="table table-hover" style="font-size: 15px; width: 500px; margin: 0 auto; border: 1px solid;">
          <tr>
            <td></td>
            <td></td>
            <td><strong>Yor Address Details<?php echo $gtotalP; ?></strong></td>
          </tr>
          <tr>
            <td width="25%">First Name</td>
            <td width="5%">:</td>
            <td><?php echo $result['fName']; ?></td>
          </tr>
          <tr>
            <td>Last Name</td>
            <td>:</td>
            <td><?php echo $result['lName']; ?></td>
          </tr>
          <tr>
            <td>Email Address</td>
            <td>:</td>
            <td><?php echo $result['email']; $eml = $result['email']; ?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td>:</td>
            <td><?php echo $result['address']; ?></td>
          </tr>
          <tr>
            <td>City</td>
            <td>:</td>
            <td><?php echo $result['city']; ?></td>
          </tr>
          <tr>
            <td>Zip Code</td>
            <td>:</td>
            <td><?php echo $result['zip']; ?></td>
          </tr>
          <tr>
            <td>Country</td>
            <td>:</td>
            <td><?php echo $result['country']; ?></td>
          </tr>
          <tr>
            <td>Mobile Number</td>
            <td>:</td>
            <td><?php echo $result['phone']; ?></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><a href="editprofile.php"><strong style="color: blue;">Update Details</strong></a></td>
          </tr>
        </table> 
    <?php } } ?>
        </div>
      </div>
      <div class="span12">
        <form action="" method="POST">
<script
  src="https://checkout.stripe.com/checkout.js" class="stripe-button"
  data-key="<?php echo $stripe['publishable']; ?>"
  data-currency="bdt"
  data-email="<?php echo $eml; ?>"
  data-amount="<?php echo $gtotalP; ?>"
  data-name="Custom Design"
  data-description="Premium membership"
  data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
  data-locale="auto">
</script>
</form> 
      </div>
     </div> 
  </div>
</div>
<!-- MainBody End ============================= -->
<?php
   if(isset($_POST['stripeToken'])) {
      $token = $_POST['stripeToken'];

      try {

        \Stripe\Charge::create(array(
           "amount" => $gtotalP,
           "currency" => "bdt",
           "source" => $token, // obtained with Stripe.js
           "description" => $eml
        ));

        $cmrId = Session::get("cmrId");
        $insertOrder = $od->insertOrderedProduct($cmrId);
        if ($insertOrder) {
          while ($resultCus = $insertOrder->fetch_assoc()) {
            $cusPmnt = $cus->confirmPaymentMail($resultCus['email'], $gtotal);
          }
          $delCartData = $ct->delCustomerCart();
          //header("Location:success.php");
          echo "<script>window.location = 'success.php';</script>";
          exit();
        
        }
        
      } catch (Stripe_CardError $e) {
        echo "<script>window.location = 'paymentOffline.php';</script>";
        exit();
      }  

   }
?>
<!-- Footer ================================================================== -->
<?php include 'inc/footer.php';?>