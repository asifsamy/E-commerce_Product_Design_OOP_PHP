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
	$verify = $cus->updateCusStatus($id, $code);	
}
?>

<div id="mainBody">
	<div class="container">
	<div class="row">	
        <div class="notfound">
           	<h2>Email Verification</h2>
           	<?php
		         if (isset($verify)) {
		             echo $verify;
		         }
		    ?> 
        </div>

		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<?php include 'inc/footer.php';?>