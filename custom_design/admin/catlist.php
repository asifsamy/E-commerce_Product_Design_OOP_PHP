<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php //include '../classes/Category.php'; ?>
<?php
   $cat = new Category();

   if (isset($_GET['delcat'])) {
      $id = $_GET['delcat'];
      $delcat = $cat->delCatById($id); 
   }
?>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
    	 <h2>Category List</h2>
       <div class="col-md-10">
      	 <div class="blankpage-main">
      <?php
          if (isset($delcat)) {
            echo $delcat;
          }
      ?>   
           <table class="table table-hover">
              <thead style="background-color: #666666; color: white ">
                <tr>
                  <th>Serial No.</th>
                  <th>Category Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
          <?php 
            $getCat = $cat->getAllCat(); 
            if ($getCat) {
              $i = 0;
              while ($result = $getCat->fetch_assoc()) {
                $i++;
          ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['catName']; ?></td>
                  <td><a href="catedit.php?catid=<?php echo $result['catId']; ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a> || <a onclick="return confirm('Deleting a category will delete all the product under this category. Are Sure to Delete!')" href="?delcat=<?php echo $result['catId']; ?>"><i class="fa fa-trash fa-lg" style="color: red"></i></a></td>
                </tr>
          <?php } } ?>     
              </tbody>
            </table>
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


                      
						
