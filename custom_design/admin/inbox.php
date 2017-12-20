<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
   // $filepath = realpath(dirname(__FILE__)); 
   // include_once ($filepath.'/../classes/Cart.php');
   // include_once ($filepath.'/../classes/Product.php');
   // $ct = new Cart();
   // $fm = new Format();
   $pd = new Product();
?>
<?php
   if (isset($_GET['shiftid'])) {
      $id = $_GET['shiftid'];
      $time = $_GET['time'];
      $price = $_GET['price'];
      $shiftPd = $od->productShifted($id, $time, $price);
   }

   if (isset($_GET['cancelId'])) {
      $id = $_GET['cancelId'];
      $time = $_GET['time'];
      $price = $_GET['price'];
      $cancelPd = $od->cancelOrder($id, $time, $price);
      /*$pd_type = $_GET['pd_type'];
      $productId = $_GET['proid'];
      $delOrder = $od->delShiftedProduct($id, $time, $price);
      if ($pd_type == '1') {
        $delCpd = $pd->deletePdById($productId);
      }*/
   }

   if (isset($_GET['delSid'])) {
      $id = $_GET['delSid'];
      $time = $_GET['time'];
      $price = $_GET['price'];
      $pd_type = $_GET['pd_type'];
      $productId = $_GET['proid'];
      $insertSold = $od->soldPdInserted($id, $time, $price);
      $delOrder = $od->delShiftedProduct($id, $time, $price);
      // if ($pd_type == '1') {
      //   $delCpd = $pd->deletePdById($productId);
      // }
   }
?>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
    	 <h2>Order List</h2>
      	 <div class="blankpage-main">
      <?php
        if (isset($shiftPd)) {
          echo $shiftPd;
        }
        if (isset($delOrder)) {
          echo $delOrder;
        }
      ?>     
           <table class="table table-hover">
              <thead style="background-color: #666666; color: white ">
                <tr>
                  <th width="3%">OID</th>
                  <th width="22%">Order Time</th>
                  <th width="3%">P_ID</th>
                  <th width="20%">Product Name</th>
                  <th width="15%">Quantity (S, M, L)</th>
                  <th width="10%">Price</th>
                  <th width="3%">Cust.ID</th>
                  <th width="10%">Address</th>
                  <th width="14%">Action</th>
                </tr>
              </thead>
              <tbody>
      <?php
        $getOrder = $od->getAllOrderedProduct();
        if ($getOrder) {
          while ($result = $getOrder->fetch_assoc()) {
      ?>
                <tr>
                  <td><?php echo $result['id']; ?></td>
                  <td><?php echo $fm->formatDate($result['date']); ?></td>
                  <td><?php echo $result['productId']; ?></td>
                  <!-- <td><?//php echo $result['productName']; ?></td> -->
                  <td><a href="orderedPd.php?proid=<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?></a></td>
                  <td><?php echo $result['quantity']; ?> (<?php echo $result['s_size']; ?>, <?php echo $result['m_size']; ?>, <?php echo $result['l_size']; ?>)</td>
                  <td>TK. <?php echo $result['price']; ?></td>
                  <td><?php echo $result['cmrId']; ?></td>
                  <td><a style="color: blue;" href="customer.php?custId=<?php echo $result['cmrId']; ?>">View Details</a></td>
              <?php
                  if ($result['status'] == '0') {  ?>
                      <td><a href="?shiftid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Approve</a> 
                        / 
                        <a style="color: red;" onclick="return confirm('Are sure to Cancel the Order !');" href="?cancelId=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Cancel</a></td>
            <?php   } elseif($result['status'] == '1') {  ?>    
                  <td><a href="?delSid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>&pd_type=<?php echo $result['pd_type']; ?>&proid=<?php echo $result['productId']; ?>"><span class="glyphicon glyphicon-ok"></span> Remove</a> || <a href="reciept.php?delSid=<?php echo $result['cmrId']; ?>&qty=<?php echo $result['quantity']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>&proid=<?php echo $result['productName']; ?>"> Print</a></td>
              <?php } else {  ?>    
                  <td><a style="color:red;" href="?delSid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>&pd_type=<?php echo $result['pd_type']; ?>&proid=<?php echo $result['productId']; ?>"><span class="glyphicon glyphicon-remove"></span> Remove</a></td>
          <?php } ?>
                </tr>
          <?php } } ?>     
              </tbody>
            </table>
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


                      
						
