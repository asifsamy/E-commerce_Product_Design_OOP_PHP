<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->

<style>
	.notfound{}
	.notfound h2{font-size: 50px; line-height: 130px; text-align: center;}
	.notfound h2 span{display: block; color: red; font-size: 50px;}
</style>

<div id="mainBody">
	<div class="container">
	<div class="row">	
        <div class="notfound">
        	<?php
	           if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	              $cusPass = $cus->updateCusPassword($_POST);
	           }
	        ?>
           	<h2><span>Account BLOCKED!</span></h2>
           	<?php
		       if (isset($cusPass)) {
		   	      echo $cusPass;
		       }else { 
		    ?>
	              <div class='alert alert-danger' style="font-size: 15px">To recover your Account you have to submit your email address. After that you will get a link via SMS to reset your password.</div>  
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
				  <button type="submit" name="login" class="btn btn-danger btn-success">Submit</button>
				</div>
			  </div>
			</form>
        </div>

		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<?php include 'inc/footer.php';?>