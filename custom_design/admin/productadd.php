<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php //include '../classes/Category.php'; ?>
<?php //include '../classes/Product.php'; ?>
<?php
    $pd = new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
       $insertProduct = $pd->productInsert($_POST, $_FILES);
  }
?>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
    	<h2>Add New Product</h2>
    	<div class="col-md-8">
        	<div class="blankpage-main">
        		
        	<?php
             if (isset($insertProduct)) {
                 echo $insertProduct;
             }
          ?>  
        		<!-- <form action="" method="post">    
        		    <div class="col-xs-8"> 
                    <input type="text" class="form-control" name="catName" placeholder="Enter Category Name..." class="medium" />
                </div><br><br>
                <div class="col-xs-8">
                    <input type="submit" class="btn btn-info" name="submit" Value="Save" />
                </div><br><br>  
            </form> -->
            <form action="" method="post" enctype="multipart/form-data">
              <table class="form">
                <tr>
                  <td><label>Name</label></td>
                  <td height="50px;">
                    <div class="col-xs-12">
                      <input class="form-control" type="text" name="productName" placeholder="Enter Product Name..." />
                    </div>  
                  </td>
                </tr>
                <tr>
                  <td><label>Category</label></td>
                  <td height="50px;"><div class="col-xs-6">
                    <select class="form-control" id="select" name="catId">
                      <option>Select Category</option>
                <?php
                    $cat = new Category();
                    $getCat = $cat->getAllCat();
                    if ($getCat) {
                      while ($result = $getCat->fetch_assoc()) {
                ?>    
                       <option value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                <?php } } ?>    
                    </select></div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top; padding-top: 9px;"><label>Description</label></td>
                  <td><textarea name="body"></textarea></td>
                </tr>
                <tr>
                  <td><label>Price</label></td>
                  <td height="50px;"><div class="col-xs-12">
                    <input class="form-control" type="text" name="price" placeholder="Enter Price..." /></div>
                  </td>
                </tr>
                <tr>
                  <td><label>Upload Image</label></td>
                  <td height="50px;"><div class="col-xs-8">
                    <input class="form-control" type="file" name="image" /></div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td><div class="col-xs-12">
                    <input class="btn btn-info" type="submit" name="submit" Value="Save" /></div>
                  </td>
                </tr>
              </table>
            </form>
          </div>
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
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<!--scrolling js-->
		<script src="js2/jquery.nicescroll.js"></script>
		<script src="js2/scripts.js"></script>
		<!--//scrolling js-->
<script src="js2/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>


                      
						
