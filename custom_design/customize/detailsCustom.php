<?php include '../inc/header_c.php';?>
<!-- Header End====================================================================== -->
<?php
   $id = Session::get("productId");

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $addcart = $cPd->addToCartCustom($quantity, $id);
    $delPd = $pd->deletePdById($id);
  }
?>

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<?php include '../inc/sidebar.php';?>
<!-- Sidebar end=============================================== -->
	<div class="span9">	
	    <div class="row">
	    <?php
	        $getPd = $pd->getSingleProduct($id);
	        if ($getPd) {
	        	while ($result = $getPd->fetch_assoc()) {

		?>	  	  
			<div id="gallery" class="span3">
            <a href="admin/<?php echo $result['image']; ?>" title="<?php echo $result['productName']; ?>">
				<img src="<?php echo $result['image']; ?>" style="width:100%; height: 350px" alt="Image"/>
            </a>
			</div>
			<div class="span6">
				<h3><?php echo $result['productName']; ?>  </h3>
				<hr class="soft"/>
				<form class="form-horizontal qtyFrm" action="" method="POST">
				  <div class="control-group">
					<label class="control-label">Price: <span><?php echo $result['price']; ?> Tk</span></label>
					<label class="control-label">Category: <span><?php echo $result['catName']; ?></span></label>
				  </div>
				  <div class="control-group">
					<input type="number" placeholder="Qty." name="quantity" required min="5" />
					<button type="submit" name="submit" class="btn btn-medium btn-primary"> Add to cart <i class=" icon-shopping-cart"></i></button>
				  </div>
				</form>
				<span style="color: red; font-size: 18px">
					<?php
                        if (isset($addcart)) {
                         	echo $addcart;
                        } 
					?>
				</span>
				
				<p><?php echo $result['body']; ?></p>
				<a class="btn btn-small pull-right" href="#detail">More Details</a>
				<br class="clr"/>
			<a href="#" name="detail"></a>
			</div>
      <?PHP } } ?>    

	</div>
</div>
</div> </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
<?php include '../inc/footer_c.php';?>