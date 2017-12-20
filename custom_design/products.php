<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<?php include 'inc/sidebar.php';?>
<!-- Sidebar end=============================================== -->
<?php
    if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
       echo "<script>window.location = '404.php'; </script>";
    } else {
       $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);
    }
?>
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="active">Products Name</li>
    </ul>
	<h3> Products From <?php
			    $catByCat = $cat->getCatById($id); 
			    if ($catByCat) {
			    	while ($resultCat = $catByCat->fetch_assoc()) {
			    	   echo $resultCat['catName'];
				    }
				}       
			  ?> <!--<small class="pull-right"> 40 products are available </small>--></h3>	
	<hr class="soft"/>
	
	
<br class="clr"/>
<h4>Featured Products </h4>
<ul class="thumbnails">
			  <?php
			    $pdByCat = $pd->productByCat($id); 
			    if ($pdByCat) {
			    	while ($result = $pdByCat->fetch_assoc()) {
			  ?>	
				<li class="span3">
				  <div class="thumbnail">
					<a  href="details.php?proid=<?php echo $result['productId']; ?>"><img style="height: 200px;" src="admin/<?php echo $result['image']; ?>" alt=""/></a>
					<div class="caption">
					  <h5><?php echo $result['productName']; ?></h5>
					  <p> 
						<?php echo $fm->textShorten($result['body'], 60); ?> 
					  </p>
					 
					  <h4 style="text-align:center"><a class="btn" href="details.php?proid=<?php echo $result['productId']; ?>"> <i class="icon-zoom-in"></i></a> <a class="btn" href="details.php?proid=<?php echo $result['productId']; ?>">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" type="disable"><?php echo $result['price']; ?></a></h4>
					</div>
				  </div>
				</li>
			<?php } } else {  ?> <li class="span3"> <?php
                       echo "<div class='alert alert-warning' style='font-size:20px;'><strong> Products of this category are not available !</strong></div>"; ?>
		                         </li> 
		<?php     } ?>
			  </ul>	

<br class="clr"/>
<h4>Custom Designed Products </h4>
<ul class="thumbnails">
			  <?php
			    $pdByCat = $cPd->productCustomByCat($id); 
			    if ($pdByCat) {
			    	while ($result = $pdByCat->fetch_assoc()) {
			  ?>	
				<li class="span3">
				  <div class="thumbnail">
					<a  href="details.php?proid=<?php echo $result['productId']; ?>"><img style="height: 200px;" src="admin/<?php echo $result['image']; ?>" alt=""/></a>
					<div class="caption">
					  <h5>Designed: <?php echo $result['lName']; ?></h5>
					  <p> 
						<?php echo $fm->textShorten($result['body'], 60); ?> 
					  </p>
					 
					  <h4 style="text-align:center"><a class="btn" href="details.php?proid=<?php echo $result['productId']; ?>"> <i class="icon-zoom-in"></i></a> <a class="btn" href="details.php?proid=<?php echo $result['productId']; ?>">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" type="disable"><?php echo $result['price']; ?></a></h4>
					</div>
				  </div>
				</li>
			<?php } } else {  ?> <li class="span3"> <?php
                       echo "<div class='alert alert-warning' style='font-size:20px;'><strong> Products of this category are not available !</strong></div>"; ?>
		                         </li> 
		<?php     } ?>
			  </ul>				  

	<!--<a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
	<div class="pagination">
			<ul>
			<li><a href="#">&lsaquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">...</a></li>
			<li><a href="#">&rsaquo;</a></li>
			</ul>
			</div>-->
			<br class="clr"/>
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php include 'inc/footer.php';?>