<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php //include '../classes/Category.php'; ?>
<?php
   $cat = new Category();
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $catName = $_POST['catName'];
      $insertCat = $cat->catInsert($catName);
  }
?>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
    	<h2>Add New Category</h2>
    	<div class="col-md-8">
    	<div class="blankpage-main">
    		
    	<?php
             if (isset($insertCat)) {
                 echo $insertCat;
             }
        ?> 
    		<form action="" method="post">    
    		    <div class="col-xs-8"> 
	                <input type="text" class="form-control" name="catName" placeholder="Enter Category Name..." class="medium" />
                </div><br><br>
                <div class="col-xs-8">
                	<input type="submit" class="btn btn-info" name="submit" Value="Save" />
                </div><br><br>
                
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
<!--scrolling js-->
		<script src="js2/jquery.nicescroll.js"></script>
		<script src="js2/scripts.js"></script>
		<!--//scrolling js-->
<script src="js2/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>


                      
						
