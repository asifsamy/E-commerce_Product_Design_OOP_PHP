<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
   // $filepath = realpath(dirname(__FILE__)); 
   // include_once ($filepath.'/../classes/Cart.php');
   $ct = new Cart();
   $fm = new Format();
?>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
    	 <h2>Todays Income</h2>
      	 <div class="blankpage-main">     
           <table class="table table-hover">
              <thead style="background-color: #666666; color: white ">
                <tr>
                  <th>OID</th>
                  <th>Order Time</th>
                  <th>P-ID</th>
                  <th>P-Type</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Cust.ID</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
          <?php
            $t_date = date("Y-m-d");
            $getSPd = $od->getSoldProduct($t_date);
            if ($getSPd) {
              $sum = 0;
              while ($result = $getSPd->fetch_assoc()) {
          ?>
                <tr>
                  <td><?php echo $result['oId']; ?></td>
                  <td><?php echo $fm->formatDate($result['date']); ?></td>
                  <td><?php echo $result['productId']; ?></td>
                  <td><?php if ($result['pd_type'] == '0') {
                             echo "Featured";
                            } else {
                               echo "Customized";
                            }
                                     ?> 
                  </td>
                  <td><?php echo $result['productName']; ?></td>
                  <td><?php echo $result['quantity']; ?></td>
                  <td><?php echo $result['cmrId']; ?></td>          
                  <td>TK. 
                    <?php 
                       echo $result['price']; 
                       $sum = $sum + $result['price'];
                    ?>
                  </td>
                </tr>
          <?php } ?>  
                <tr>
                  <td style="font-weight: bold;" colspan="7" align="right">Total</td> 
                  <td style="font-weight: bold;"> TK. <?php echo $sum; ?></td>
              </tr>
        <?php }  ?>    
              </tbody>
            </table>
            <form method="post" action="export.php" style="text-align: center;">
              <input type="submit" name="export" class="btn btn-success" value="Export To Excel" />
          </form>
         </div>
    </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include 'inc/copyright.php';?>	
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
    <?php include 'inc/sidebar.php';?>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="js2/jquery.nicescroll.js"></script>
		<script src="js2/scripts.js"></script>
		<!--//scrolling js-->
<script src="js2/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>


                      
						
