<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
   include_once '../helpers/Format.php'; 
?>
<?php
   if (isset($_GET['delid'])) {
      $id = $_GET['delid'];
      $delmsg = $msg->deleteMsgById($id); 
   }
?>

<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
      <h2>All Messages</h2>
      <?php
        if (isset($delmsg)) {
          echo $delmsg;
        }
      ?> 
       <div class="col-md-8 mailbox-content  tab-content tab-content-in">
        <div class="tab-pane active text-style" id="tab1">
          <div class="mailbox-border">
                  <table class="table tab-border">
                      <tbody>
                  <?php
                      $getAllmsg = $msg->getUnreadMsg();
                      if ($getAllmsg) {
                          while ($result = $getAllmsg->fetch_assoc()) {
                  ?>       
                          <tr class="read checked">
                              <td class="hidden-xs">
                          <?php if ($result['status'] == 0) { ?>
                                  <i class="fa fa-star icon-state-warning"></i>
                          <?php } else { ?>  
                                  <i class="fa fa-star"></i>
                          <?php } ?>        
                              </td>
                              <td class="hidden-xs">
                                  <?php echo $result['name']; ?>
                              </td>
                              <td>
                                  <?php echo $fm->textShorten($result['subject'], 20); ?>
                              </td>
                              <td>
                                  <?php echo $result['date']; ?>
                              </td>
                              <td><a href="mailSingle.php?msid=<?php echo $result['id']; ?>">view</a>
                              </td>
                              <td>
                                <a href="?delid=<?php echo $result['id']; ?>"><i class="fa fa-trash fa-lg" style="color: red"></i></a>
                              </td>
                          </tr>
                  <?php } } ?>        
                      </tbody>
                  </table>
                 </div>   
               </div>
              
            </div>
          <div class="clearfix"> </div>     
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


                      
            
