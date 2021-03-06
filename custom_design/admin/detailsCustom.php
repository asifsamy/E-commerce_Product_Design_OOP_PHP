<?php include '../inc/header_c.php';?>
<!-- Header End====================================================================== -->
<?php
   $id = Session::get("productId");

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addcart = $cPd->addToCartCustom($_POST, $id);
    if ($_POST['upload'] != 'yes') {
    	$delPd = $cPd->deleteCusPdById($id);
    }
    //$delPd = $pd->deletePdById($id);
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
					<input type="checkbox" name="upload" value="yes" checked /> Upload this Product in our Website.
				  </div>
				  <div class="control-group">
		<?php
			    $catId = $result['catId'];
			    if ($catId == 1 || $catId == 2 || $catId == 3) { ?>
			    	<input type="number" placeholder="Qty of Small" name="s_size" required min="0" /><br><br>
			    	<input type="number" placeholder="Qty of Medium" name="m_size" required min="0" /><br><br>
			    	<input type="number" placeholder="Qty of Large" name="l_size" required min="0" /><br><br>
		<?php    
		        } else {  ?>   
			  	
					<input type="number" placeholder="Qty." name="quantity" required min="6" />
		<?php   } ?>		
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
            <br class="clr"/>
			<hr class="soft clr"/>	
            
            <div class="span9">
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Details</h4>
                <table class="table table-bordered">
				<tbody>
				<tr class="techSpecRow">
					<th colspan="2">Size Details</th>
				</tr>
				<tr class="techSpecRow">
					<td class="techSpecTD1">Size: </td>
					<td class="techSpecTD2">S</td>
					<td class="techSpecTD2">M</td>
					<td class="techSpecTD2">L</td>
				</tr>
				<tr class="techSpecRow">
					<td class="techSpecTD1">Width:</td>
					<td class="techSpecTD2">18</td>
					<td class="techSpecTD2">20</td>
					<td class="techSpecTD2">22</td>
				</tr>
				<tr class="techSpecRow">
					<td class="techSpecTD1">Length:</td>
					<td class="techSpecTD2">28</td>
					<td class="techSpecTD2">29</td>
					<td class="techSpecTD2">30</td>
				</tr>
				</tbody>
				</table>
		<?php
		    if ($catId == 2) {
		?>		
				<img src="../themes/images/size/measerment.jpg" alt="Not found">
              </div>
              <br class="clr"/>
		    <img src="../themes/images/size/m1.jpg" alt="Not found"> <img src="../themes/images/size/m2.jpg" alt="Not found"> <img src="../themes/images/size/m3.jpg" alt="Not found"> <img src="../themes/images/size/m4.jpg" alt="Not found">
		<?php } elseif ($catId == 3) {
		 ?>
		         <img src="../themes/images/size/measerment2.jpg" alt="Not found">
              </div>
              <br class="clr"/>
		    <img src="../themes/images/size/mf1.jpg" alt="Not found"> <img src="../themes/images/size/mf2.jpg" alt="Not found"> <img src="../themes/images/size/mf3.jpg" alt="Not found"> <img src="../themes/images/size/mf4.jpg" alt="Not found">
		<?php } ?>        
          </div>
          <br class="clr"/>
          <p><strong>Length:</strong> Shoulder seam at collar to bottom hem.<br><strong>Width:</strong> Underarm to underarm.<br>
<strong>Care Instructions:</strong> Turn inside out. Machine wash cold.<br>Use non-chlorine bleach only when needed. Tumble dry low. Do not iron image.<br><br><strong>Fit Tip:</strong> Please note that our SignatureSoft tee has a slightly different fit than our basic T-<br>shirt. The shoulders and sleeves are smaller than the basic. If you prefer a relaxed fit, then<br>we recommend ordering one size up.</p>    
	</div>

      <?PHP } } ?>    

	</div>
</div>
</div> </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
<?php include '../inc/footer_c.php';?>