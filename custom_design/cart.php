<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->
<?php
   if (isset($_GET['delCart'])) {
   	$delId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delCart']);
   	$delPdCart = $ct->delPdFromCart($delId);
   }
?>
<?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   	// $cartId = $_POST['cartId'];
    // $quantity = $_POST['quantity'];
    // $updateCart = $ct->updateCartQuantity($cartId, $quantity);
    $updateCart = $ct->updateCartQuantity($_POST);
  }
?>
<?php
   if (!isset($_GET['id'])) {
   	echo "<meta http-equiv='refresh' content='0;URL=?id=samy'/>";
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
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small>3 Item(s) </small>]</h3>	
	<hr class="soft"/>	
	<?php
         if (isset($delPdCart)) {
         	echo $delPdCart;
         }
         if (isset($delPdCart)) {
         	echo $updateCart;
         }
	?>	
			
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th width="3%">SL</th>	
                  <th width="20%">Product Name</th>
				  <th width="10%">Image</th>
				  <th width="10%">Price</th>
				  <th width="27%">Quantity (Small/Medium/Large)</th>
				  <th width="15%">Total Price</th>
				  <th width="15%">Action</th>
				</tr>
              </thead>
              <tbody>
            <?php
                $getproduct = $ct->getCartProduct();
                if ($getproduct) {
                	$i = 0;
                	$sum = 0;
                	$item = 0;
                	while ($result = $getproduct->fetch_assoc()) {
                		$i++;
            ?>
                <tr>
                	<td><?php echo $i; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td> <img style="max-height: 80px;" width="60" src="admin/<?php echo $result['image']; ?>" alt=""/></td>
					<td>Tk. <?php echo $result['price']; ?></td>
					<td>
						<form action="" method="post" class="form-horizontal qtyFrm">
							<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>" />
							<input type="hidden" name="catId" value="<?php echo $result['catId']; ?>" />
					<?php
						$catId = $result['catId'];
		                if ($catId == 1 || $catId == 2 || $catId == 3) {       
					?>								
							<input style="width: 40px" type="number" name="s_size" value="<?php echo $result['s_size']; ?>" min="0" />
							<input style="width: 40px" type="number" name="m_size" value="<?php echo $result['m_size']; ?>" min="0" />
							<input style="width: 40px" type="number" name="l_size" value="<?php echo $result['l_size']; ?>" min="0" /><br><br>
			      <?php } else { ?>	
			                <input style="width: 60px" type="number" name="quantity" value="<?php echo $result['quantity']; ?>" min="1" />
			      <?php } ?>	          						
							<input class="btn btn-primary" type="submit" name="submit" value="Update"/>
						</form>
					</td>			
					<td>Tk. <?php
                        $total = $result['price'] * $result['quantity'];
					    echo $total; 
					?>
					</td>
					<td><a onclick="return confirm('Are sure to delete !');" class="btn btn-danger" href="?delCart=<?php echo $result['cartId']; ?>">X</a></td>
				</tr>
			<?php
			   $sum = $sum + $total; 
			   $item = $item + $result['quantity'];
			   Session::set("sum", $sum); 
			   Session::set("item", $item); 
			?>	
			<?php } } ?>
			<?php
			    $getData = $ct->checkCartTable(); 
                if ($getData) { 
			?>

                <tr>
                  <td colspan="5" style="text-align:right">Sub Total </td>
                  <td colspan="2"> TK. <?php echo $sum; ?></td>
                </tr>
                 <tr>
                  <td colspan="5" style="text-align:right">VAT </td>
                  <td colspan="2"> 10%</td>
                </tr>
				 <tr>
                  <td colspan="5" style="text-align:right"><strong>GRAND TOTAL (TK. <?php $vat = $sum * 0.1; echo $sum; ?> + TK. <?php echo $vat ?>) </strong></td>
                  <td colspan="2" class="badge-warning"> <strong> TK. 
                  	<?php
                       $gtotal = $sum + $vat;
                       echo $gtotal;
                    ?> </strong>
                  </td>
                </tr>
                <?php } else {
                	    //echo "<h3 style='color:red;'>Cart is Emplty ! Shop Now.</h3>";
                	echo "<script>window.location = 'index.php';</script>";
                } ?>
				</tbody>
        </table>
		
	<div class="shopping">
		<table>
			<tr>
				<td>
					<div class="shopleft">
			           <a href="index.php"> <img src="themes/images/shop2.png" alt="" /></a>
		            </div>
				</td>
				<td>
					<div class="shopright pull-right">
			           <!-- <a href="payment.php"> <img src="themes/images/chk.jpg" alt="" /></a> -->
			           <a href="paymentOffline.php"> <img src="themes/images/chk.jpg" alt="" /></a>
		            </div>
				</td>
			</tr>
		</table>
	</div>
	
</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php include 'inc/footer.php';?>
	<?php
	    if( $updateCart ) 
           echo "<script type='text/javascript'>alert('Updated Successfully!')</script>";
        //else
           //echo "<script type='text/javascript'>alert('failed!')</script>";
	?>
</body>
</html>