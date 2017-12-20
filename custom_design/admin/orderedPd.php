<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
   // $filepath = realpath(dirname(__FILE__)); 
   // include_once ($filepath.'/../classes/Product.php');
?>
<?php
   if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
       echo "<script>window.location = 'inbox.php'; </script>";
   } else {
       $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
   }

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'inbox.php'; </script>";
  }
?>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
    	 <h2>Ordered Product Details</h2>
      	 <div class="blankpage-main">
      <?php
         $pd = new Product();
         $getPd = $pd->getProductById($id);
         if ($getPd) {
             while ($result = $getPd->fetch_assoc()) {

      ?>    
           <form action="" method="post">
              <table>          
                <tr>
                  <td width="200px"><h4>Product ID: </h4></td>
                  <td>
                      <?php echo $result['productId']; ?>
                  </td>
                </tr>
                <tr>
                  <td><h4>Product Name: </h4></td>
                  <td>
                      <?php echo $result['productName']; ?>
                  </td>
                </tr>
                <tr>
                  <td><h4>Category ID: </h4></td>
                  <td>
                      <?php echo $result['catId']; ?>
                  </td>
                </tr>
                <tr>
                  <td><h4>Product Description: </h4></td>
                  <td>
                      <?php echo $result['body']; ?>
                  </td>
                </tr>
                <tr>
                  <td><h4>Price: </h4></td>
                  <td>
                      <?php echo $result['price']; ?>
                  </td>
                </tr>
                <tr>
                  <td><h4>Product Type: </h4></td>
                  <td>
                      <?php if ($result['pd_type'] == 0) {
                          echo "Featured";
                      } else {
                          echo "Customized";
                      } ?>
                  </td>
                </tr>
                <tr>
                  <td><h4>Image: </h4></td>
                  <td>
                      <a href="#"><img style="height: 400px;" src="<?php echo $result['image']; ?>" alt=""/></a>
                  </td>
                </tr>      
                <tr> 
                  <td>
                      <input class="btn btn-info" type="submit" name="submit" Value="OK" />
                  </td>
                </tr>
              </table>
            </form>
            <?php } } ?> 
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


                      
						
