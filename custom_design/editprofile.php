<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->
<?php
   $login = Session::get("cuslogin");
   if ($login == false) {
   	echo "<script>window.location = 'login.php';</script>";
         //header("Location:login.php");

   }
?>
<?php
  $cmrId = Session::get("cmrId");
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
     $updateCus = $cus->customerUpdate($_POST, $cmrId);
  }
?>
<style>
   .tblone{font-size: 18px; width: 650px; margin: 0 auto; border: 1px solid;}
   .tblone input[type="text"]{width: 400px;font-size: 18px;} 
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
		    <li class="active"> Profile</li>
      </ul>
    <?php
        $id = Session::get("cmrId");
        $getData = $cus->getCustomerData($id);
        if ($getData) {
        	while ($result = $getData->fetch_assoc()) {
    ?>    	
        <h3>  Welcome Mr. <?php echo $result['lName']; ?> </h3>
        <form action="" method="post">
        <table class="table table-striped tblone">
<?php
    if (isset($updateCus)) {
         echo "<tr><td colspan='2'>".$updateCus."</td></tr>";
     } 
?>            
        	<tr>
        		<td></td>
        		<td><strong>Update Profile Details</strong></td>
        	</tr>            
        	<tr>
        		<td width="25%">First Name</td>
                <td><input type="text" name="fName" value="<?php echo $result['fName']; ?>"></td>
        	</tr>
        	<tr>
        		<td>Last Name</td>
                <td><input type="text" name="lName" value="<?php echo $result['lName']; ?>"></td>
        	</tr>
        	<!-- <tr>
        		<td>Email Address</td>
                <td><input type="text" name="email" value="<?php //echo $result['email']; ?>"></td>
        	</tr> -->
        	<tr>
        		<td>Address</td>
                <td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
        	</tr>
        	<tr>
        		<td>City</td>
                <td><input type="text" name="city" value="<?php echo $result['city']; ?>"></td>
        	</tr>
        	<tr>
        		<td>Zip Code</td>
                <td><input type="text" name="zip" value="<?php echo $result['zip']; ?>"></td>
        	</tr>
        	<tr>
        		<td>Country</td>
                <td><input type="text" name="country" value="<?php echo $result['country']; ?>"></td>
        	</tr>
        	<tr>
        		<td>Mobile Number</td>
        		<td><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
        	</tr>
        	<tr>
        		<td></td>
        		<td><input class="btn btn-success btn-sm" type="submit" name="save" value="Save"></td>
        	</tr>
        </table> 
    </form>
    <?php } } ?>    
        </div>
     </div> 
  </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
<?php include 'inc/footer.php';?>