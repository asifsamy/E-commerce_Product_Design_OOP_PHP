<?php
  include 'lib/Session.php';
  Session::init();
  include 'lib/Database.php';
  include 'helpers/Format.php';

  spl_autoload_register(function($class){
  	include_once "classes/".$class.".php";
  });

  $db = new Database();
  $fm = new Format();
  $pd = new Product();
  $cat = new Category();
  $ct = new Cart();
  $cus = new Customer();
  $cPd = new CustomPd();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Custom Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
	<style type="text/css" id="enject"></style>
	<style>
		.shopping {
           margin-top: 30px;
        }
        .shopleft, .shopleft {
            float: left;
            width: 610px;
        }
        .shopleft img{outline:none}
        .shopleft a,.shopright a{outline:none}
        .shopright img {
            width: 270px;
            outline:none
        }
	</style>
  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<div class="span6">
		<form class="form-inline navbar-search" method="post" action="compare.php" >
		<!-- <input id="srchFld" class="srchTxt" type="text" /> -->
		  <select class="srchTxt" name="input">
			<option>All</option>
			<option>CLOTHES </option>
			<option>FOOD AND BEVERAGES </option>
			<option>HEALTH & BEAUTY </option>
			<option>SPORTS & LEISURE </option>
			<option>BOOKS & ENTERTAINMENTS </option>
		</select> 
		  <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form>
	</div>
	<div class="span6">
	<div class="pull-right">
		<a href="cart.php"><span class="btn btn-primary"><i class="icon-shopping-cart icon-white"></i> [ <?php
			  $getData = $ct->checkCartTable(); 
			  if ($getData) {
              	$item = Session::get("item");
                echo $item;
              } else {
              	echo "0";
              }
			?> ] Itemes in your cart </span> </a> 
	</div>
	</div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="index.php"><img src="themes/images/logo1.png" alt="Nothing"/></a>
		
    <ul id="topMenu" class="nav pull-right">
	 <li class=""><a href="admin/half_sleeve.php">DESIGN NOW</a></li>
   <!--<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class=""><a href="#">Page 1-1</a></li>
          <li class=""><a href="#">Page 1-2</a></li>
          <li class=""><a href="#">Page 1-3</a></li>
        </ul>
    </li>-->
	 <li class=""><a href="products.php">Products</a></li>
	 <li class=""><a href="about.php">About</a></li>
	 <li class=""><a href="contact.php">Contact</a></li>
<?php
      $cmrId = Session::get("cmrId"); 
      $chkOrder = $ct->checkOrder($cmrId);
      if ($chkOrder) { ?>
       <li class=""><a href="orderdetails.php">Orders</a></li>	
<?php }  ?>
<?php
     $login = Session::get("cuslogin");
     if ($login == true) { ?>
        <li class=""><a href="profile.php">Profile</a></li>	
<?php }   
?>
	 <li class="">
	 
	<?php
       if (isset($_GET['cid'])) {
       	$delCartData = $ct->delCustomerCart();
       	Session::destroy();
       }
	?>
<?php
  $login = Session::get("cuslogin");
  if ($login == false) {  ?>
   	<a href="login.php" role="button" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>

<?php
  } else { ?>
    <a href="?cid=<?php Session::get('cmrId'); ?>" role="button" style="padding-right:0"><span class="btn btn-large btn-success">Logout</span></a>
<?php  
  }
?>	

	</li>
    </ul>
  </div>
</div>
</div>
</div>