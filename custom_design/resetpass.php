<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->

<?php
   if(empty($_GET['id']) && empty($_GET['code']))
   {
	  echo "<script>window.location = 'login.php';</script>";
   }
   if(isset($_GET['id']) && isset($_GET['code']))
   {   
		$id = base64_decode($_GET['id']);
		$code = $_GET['code'];	
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rst'])) {
		  $resetPass = $cus->resetPassword($id, $_POST);
		}
   }
   
?>

<div id="mainBody">
	<div class="container">
	<div class="row">
    <ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3> Reset Password</h3>	
	<hr class="soft"/>
		<div class="span6">
			<div class="well">		
			<h4>Rest Your Password</h4>
			<?php
		       if (isset($resetPass)) {
		   	      echo $resetPass;
		   	      echo "<meta http-equiv='refresh' content='5; url=login.php'>";
		       } 
		    ?>
			<form action="" method="post">
			  <div class="control-group">
				<label class="control-label" for="email">New Password</label>
				<div class="controls">
				  <input class="span4" required type="password" name="pass" placeholder="New Password">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="email">Confirm Password</label>
				<div class="controls">
				  <input class="span4" required type="password" name="cPass" placeholder="Confirm Password">
				</div>
			  </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" name="rst" class="btn btn-danger btn-success">Reset Password</button>
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