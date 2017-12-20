<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
    <ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3> Forgot Password</h3>	
	<hr class="soft"/>

		<?php
           if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
              $cusPass = $cus->updateCusPassword($_POST);
           }
        ?>
		<div class="span6">
			<div class="well">		
			<h4>Forgot Password</h4>
			<?php
		       if (isset($cusPass)) {
		   	      echo $cusPass;
		       }else { 
		    ?>
	              <div class='alert alert-info'>Please enter your email address. You will receive a link to create a new password via email.</div>  
	        <?php 
	           } 
	        ?>
			<form action="" method="post">
			  <div class="control-group">
				<label class="control-label" for="email">Email</label>
				<div class="controls">
				  <input class="span4" required type="email" name="email" placeholder="Email Address">
				</div>
			  </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" name="login" class="btn btn-danger btn-primary">Generate new Password</button>
				</div>
			  </div>
			</form>
		</div>
		</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php include 'inc/footer.php';?>