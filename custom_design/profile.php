<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->
<?php
   $login = Session::get("cuslogin");
   if ($login == false) {
   	echo "<script>window.location = 'login.php';</script>";
         //header("Location:login.php");

   }
?>
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
        <table class="table table-hover" style="font-size: 18px; width: 650px; margin: 0 auto; border: 1px solid;">
        	<tr>
        		<td></td>
        		<td></td>
        		<td><strong>Yor Profile Details</strong></td>
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
        		<td><?php echo $result['email']; ?></td>
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
  </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
<?php include 'inc/footer.php';?>