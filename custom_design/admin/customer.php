<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
   $filepath = realpath(dirname(__FILE__)); 
   include_once ($filepath.'/../classes/Customer.php');
?>
<?php
   if (!isset($_GET['custId']) || $_GET['custId'] == NULL) {
       echo "<script>window.location = 'inbox.php'; </script>";
   } else {
       $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custId']);
   }

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'inbox.php'; </script>";
  }
?>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
    	 <h2>Customer Details</h2>
       <div class="col-md-8">
      	 <div class="blankpage-main">
      <?php
       $cus = new Customer();
       $getCust = $cus->getCustomerData($id);
       if ($getCust) {
           while ($result = $getCust->fetch_assoc()) {

      ?>   
           <form action="" method="post">
              <table>          
                <tr>
                  <td width="150px" height="40px"><h4>First Name: </h4></td>
                  <td>
                      <?php echo $result['fName']; ?>
                  </td>
                </tr>
                <tr>
                  <td height="40px"><h4>Last Name: </h4></td>
                  <td>
                      <?php echo $result['lName']; ?>
                  </td>
                </tr>
                <tr>
                  <td height="40px"><h4>Email: </h4></td>
                  <td>
                      <?php echo $result['email']; ?>
                  </td>
                </tr>
                <tr>
                  <td height="40px"><h4>Adress: </h4></td>
                  <td>
                      <?php echo $result['address']; ?>
                  </td>
                </tr>
                <tr>
                  <td height="40px"><h4>City: </h4></td>
                  <td>
                      <?php echo $result['city']; ?>
                  </td>
                </tr>
                <tr>
                  <td height="40px"><h4>Zip Code: </h4></td>
                  <td>
                      <?php echo $result['zip']; ?>
                  </td>
                </tr>
                <tr>
                  <td height="40px"><h4>Country: </h4></td>
                  <td>
                      <?php echo $result['country']; ?>
                  </td>
                </tr>
                <tr>
                  <td height="40px"><h4>Mobile No: </h4></td>
                  <td>
                      <?php echo $result['phone']; ?>
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


                      
						
