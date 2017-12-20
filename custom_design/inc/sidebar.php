<div id="sidebar" class="span3">
		<div class="well well-small"><a id="myCart" href="cart.php"><img src="themes/images/ico-cart.png" alt="cart">
			<?php
			  $getData = $ct->checkCartTable(); 
			  if ($getData) {
              	$item = Session::get("item");
                echo $item;
              } else {
              	echo "0";
              }
			?> Items in your cart  <span class="badge badge-warning pull-right">
          <?php
              $getData = $ct->checkCartTable(); 
              if ($getData) {
              	$sum = Session::get("sum");
                echo "TK. ".$sum;
              } else {
              	echo "TK. 0.00";
              }
              
          ?>
		</span></a></div>
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
			<li class="subMenu open"><a> CATEGORIES</a>
				<ul>
			<?php
				$getCat = $cat->getAllCat();
				if ($getCat) {
				  while ($result = $getCat->fetch_assoc()) {
			?>
				<li><a href="products.php?catId=<?php echo $result['catId']; ?>"><i class="icon-chevron-right"></i><?php echo $result['catName']; ?> </a></li>
			<?php } } ?>	
				</ul>
			</li>
		</ul>
		<br/>
<!--
		  <div class="thumbnail">
			<img src="themes/images/products/panasonic.jpg" alt="Bootshop panasonoc New camera"/>
			<div class="caption">
			  <h5>Panasonic</h5>
				<h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$222.00</a></h4>
			</div>
		  </div><br/>
			<div class="thumbnail">
				<img src="themes/images/products/kindle.png" title="Bootshop New Kindel" alt="Bootshop Kindel">
				<div class="caption">
				  <h5>Kindle</h5>
				    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$222.00</a></h4>
				</div>
			  </div><br/> -->
			<div class="thumbnail">
				<img src="themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
				<div class="caption">
				  <h5>Payment Methods</h5>
				</div>
			  </div>
	</div>