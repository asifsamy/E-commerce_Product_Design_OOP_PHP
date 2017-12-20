<?php include '../classes/Adminlogin.php'; ?>
<?php
  $al = new Adminlogin();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  	$adminUser = $_POST['adminUser'];
  	$adminPass = md5($_POST['adminPass']);

  	$loginChk = $al->adminLogin($adminUser, $adminPass);
  }
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Custom Shop | Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css2/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css2/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js2/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css2/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--static chart-->
</head>
<body>	
<div class="login-page">
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Login</h1>
			</div>
			<div class="login-block">
				<form action="login.php" method="post">
					<span style="color: red; font-size: 18px";>
						<?php
						    if (isset($loginChk)) {
						     	echo $loginChk;
						     } 
						?>
			        </span>
					<input type="text" placeholder="Username" name="adminUser"/>
					<input type="password" class="lock" placeholder="Password" name="adminPass"/>
					<input type="submit" value="Log in" />
					<!-- <h3>Not a member?<a href="signup.html"> Sign up now</a></h3> -->
				</form>
			</div>
      </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include 'inc/copyright.php';?>
<!--COPY rights end here-->

<!--scrolling js-->
		<script src="js2/jquery.nicescroll.js"></script>
		<script src="js2/scripts.js"></script>
		<!--//scrolling js-->
<script src="js2/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>


                      
						
