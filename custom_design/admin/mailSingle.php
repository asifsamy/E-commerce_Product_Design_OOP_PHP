<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
   include_once '../helpers/Format.php'; 
?>
<?php
   if (!isset($_GET['msid']) || $_GET['msid'] == NULL) {
       echo "<script>window.location = 'mailbox.php'; </script>";
   } else {
       $id = $_GET['msid'];
       $upst = $msg->updateStatusMsg($id);
   }
?>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">
    <div class="blank">
      <h2>Message Deatail</h2>
       <div class="col-md-8 mailbox-content  tab-content tab-content-in">
        <div class="tab-pane active text-style" id="tab1">
      <?php
        $getmsg = $msg->getMsgById($id);
        if ($getmsg) {
            while ($result = $getmsg->fetch_assoc()) {
      ?> 
            <ul><li><strong style="font-size: 20px"><?php echo $result['name']; ?></strong></li></ul>
            <ul><?php echo $result['date']; ?></ul><br>
            <ul>Subject: <?php echo $result['subject']; ?></ul><br>
            <ul><p><?php echo $result['body']; ?></p></ul><br>
            <ul>From: <?php echo $result['email']; ?></ul>
               </div>
       <?php } } ?>       
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


                      
            
