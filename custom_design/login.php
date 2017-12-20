<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->
<?php
   $login = Session::get("cuslogin");
   if ($login == true) {
   	echo "<script>window.location = 'order.php';</script>";
         //header("Location:order.php");

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
		<li class="active">Login</li>
    </ul>
	<h3> Login</h3>	
	<hr class="soft"/>
	
   <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
         $cusReg = $cus->customerRegistration($_POST);
      }
  ?>

	<div class="row">
		<div class="span4">
			<div class="well">
		<?php
		   if (isset($cusReg)) {
		   	echo $cusReg;
		   }
		?>		
			<h5>CREATE YOUR ACCOUNT</h5><br/>
			<form action="" method="post">
			  <div class="control-group">
				<label class="control-label" for="fName">First Name <sup>*</sup></label>
				<div class="controls">
				  <input class="span3" required type="text" name="fName" placeholder="First Name">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="lName">Last Name <sup>*</sup></label>
				<div class="controls">
				  <input class="span3" required type="text" name="lName" placeholder="Last Name">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="email">E-mail address <sup>*</sup></label>
				<div class="controls">
				  <input class="span3" required type="text" name="email" placeholder="Email">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="pass">Password <sup>*</sup></label>
				<div class="controls">
				  <input class="span3" required type="text" name="pass" placeholder="Password">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="address">Address <sup>*</sup></label>
				<div class="controls">
				  <input class="span3" required type="text" name="address" placeholder="Address"> <br><span>Street address, P.O. box, company name, c/o, Apartment</span>
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="city">City <sup>*</sup></label>
				<div class="controls">
				  <input class="span3" required type="text" name="city" placeholder="City">
				</div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="zip">Zip-Code<sup>*</sup></label>
			    <div class="controls">
			      <input class="span3" required type="text" name="zip" placeholder="Zip-Code"/> 
			    </div>
		      </div>	
			  <div class="control-group">
			    <label class="control-label" for="country">Country<sup>*</sup></label>
			    <div class="controls">
			      <input class="span3" required type="text" name="country" placeholder="Country"/> 
			    </div>
		      </div>
		      <div class="control-group">
			     <label class="control-label" for="phone">Mobile Number<sup>*</sup></label>
			     <div class="controls">
			       <input class="span3" required type="text" name="phone" placeholder="Mobile Number"/> 
			     </div>
		      </div>
		      <p><sup>*</sup>Required field	</p>
			  <div class="controls">
			    <button type="submit" name="register" class="btn block">Create Your Account</button>
			  </div>
			</form>
		</div>
		</div>
		<?php
           if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
              $cusLogin = $cus->customerLogin($_POST);
           }
        ?>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
		    <?php
		       if (isset($cusLogin)) {
		   	      echo $cusLogin;
		       }
		    ?>		
			<h5>ALREADY REGISTERED ?</h5>
			<form action="" method="post">
			  <div class="control-group">
				<label class="control-label" for="email">Email</label>
				<div class="controls">
				  <input class="span3" required type="text" name="email" placeholder="Email">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="pass">Password</label>
				<div class="controls">
				  <input type="password" class="span3" required name="pass" placeholder="Password">
				</div>
			  </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" name="login" class="btn">Sign in</button> <a href="fpass.php">Forget password?</a>
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php include 'inc/footer.php';?>