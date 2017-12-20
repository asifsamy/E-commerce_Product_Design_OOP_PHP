<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
   //include '../classes/Product.php';
   include_once '../helpers/Format.php'; 
?>

<?php
   $pd = new Product();
   $fm = new Format();
?>
<?php
   if (isset($_GET['delpd'])) {
      $id = $_GET['delpd'];
      $delpd = $pd->deletePdById($id); 
   }
?>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
    	 <h2>Product List</h2>
      	 <div class="blankpage-main">
      <?php
        if (isset($delpd)) {
          echo $delpd;
        }
      ?>    
           <table class="table table-hover">
              <thead style="background-color: #666666; color: white ">
                <tr>
                  <th>#</th>
                  <th>Product Name</th>
                  <th>PdID</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
      <?php
          $getPd = $pd->getAllProduct();
          if ($getPd) {
            $i = 0;
            while ($result = $getPd->fetch_assoc()) {
              $i++;
      ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['productName']; ?></td>
                  <td><?php echo $result['productId']; ?></td>          
                  <td><?php echo $result['catName']; ?></td>
                  <td><?php echo $fm->textShorten($result['body'], 40); ?></td>
                  <td><?php echo $result['price']; ?>TK.</td>
                  <td><img src="<?php echo $result['image']; ?>" alt="Image Not Found" height="50px" width="60px"></td>
                  <td><a href="productedit.php?pdid=<?php echo $result['productId']; ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a> || <a onclick="return confirm('Are Sure to Delete!')" href="?delpd=<?php echo $result['productId']; ?>"><i class="fa fa-trash fa-lg" style="color: red"></i></a></td>
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


                      
						
