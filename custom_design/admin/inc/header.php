<?php
  include '../lib/Session.php';
  Session::checkSession();

  spl_autoload_register(function($class){
    include_once "../classes/".$class.".php";
  });
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Custom Shop | Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css2/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css2/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js2/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css2/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--static chart-->
<script src="js2/Chart.min.js"></script>
<!--//charts-->
<!-- geo chart -->
    <script src="//cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script>window.modernizr || document.write('<script src="lib/modernizr/modernizr-custom.js"><\/script>')</script>
    <!--<script src="lib/html5shiv/html5shiv.js"></script>-->
     <!-- Chartinator  -->
    <script src="js2/chartinator.js" ></script>
    <script type="text/javascript">
        // jQuery(function ($) {

        //     var chart3 = $('#geoChart').chartinator({
        //         tableSel: '.geoChart',

        //         columns: [{role: 'tooltip', type: 'string'}],
         
        //         colIndexes: [2],
             
        //         rows: [
        //             ['China - 2015'],
        //             ['Colombia - 2015'],
        //             ['France - 2015'],
        //             ['Italy - 2015'],
        //             ['Japan - 2015'],
        //             ['Kazakhstan - 2015'],
        //             ['Mexico - 2015'],
        //             ['Poland - 2015'],
        //             ['Russia - 2015'],
        //             ['Spain - 2015'],
        //             ['Tanzania - 2015'],
        //             ['Turkey - 2015']],
              
        //         ignoreCol: [2],
              
        //         chartType: 'GeoChart',
              
        //         chartAspectRatio: 1.5,
             
        //         chartZoom: 1.75,
             
        //         chartOffset: [-12,0],
             
        //         chartOptions: {
                  
        //             width: null,
                 
        //             backgroundColor: '#fff',
                 
        //             datalessRegionColor: '#F5F5F5',
               
        //             region: 'world',
                  
        //             resolution: 'countries',
                 
        //             legend: 'none',

        //             colorAxis: {
                       
        //                 colors: ['#679CCA', '#337AB7']
        //             },
        //             tooltip: {
                     
        //                 trigger: 'focus',

        //                 isHtml: true
        //             }
        //         }

               
        //     });                       
        // });
    </script>
<!--geo chart-->

<!--skycons-icons-->
<script src="js2/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>  
<div class="page-container">    
   <div class="left-content">
       <div class="mother-grid-inner">
            <!--header start here-->
                <div class="header-main">
                    <div class="header-left">
                            <div class="logo-name">
                                    <a href="index.html"><img id="logo" src="../themes/images/logo2.png" alt="Logo"/></a>
                            </div>      
                            <!--search-box
                                <div class="search-box">
                                    <form>
                                        <input type="text" placeholder="Search..." required=""> 
                                        <input type="submit" value="">                  
                                    </form>
                                </div><!--//end-search-box-->
                            <div class="clearfix"> </div>
                         </div>
                         <div class="header-right">
                            <div class="profile_details_left"><!--notifications of menu start -->
                                 <ul class="nofitications-dropdown">
                                    <li class="dropdown head-dpdn">
                            <?php
                                $msg = new Contact();
                                $countmsg = $msg->CountUnreadMsg();
                                $i = 0;
                                if ($countmsg) {
                                    $i = 0;
                                    while ($result = $countmsg->fetch_assoc()) {
                                        $i++;
                                    }
                                }
                            ?>             
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><?php if ($i > 0) {?><span class="badge"><?php echo $i; ?></span><?php } ?></a>           
                                        <ul class="dropdown-menu">
                                        <li>                   
                                            <div class="notification_header">
                                                <h3>Unread messages (<?php echo $i;?>)</h3>
                                            </div>
                                        </li>
                            <?php
                                $fm = new Format();
                                $getUmsg = $msg->getUnreadMsg();
                                if ($getUmsg) {
                                    while ($resulth = $getUmsg->fetch_assoc()) {
                            ?>            
                                            <li><a href="mailSingle.php?msid=<?php echo $resulth['id']; ?>">
                                               <div class="notification_desc">
                                                <p><?php echo $fm->textShorten($resulth['subject'], 15); ?></p>
                                                <p><span><?php echo $resulth['date']?></span></p>
                                                </div>
                                               <div class="clearfix"></div> 
                                            </a></li>
                            <?php } } ?>
                                            <li>
                                                <div class="notification_bottom">
                                                    <a href="mailbox.php">See all messages</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown head-dpdn">
                            <?php
                                $od = new Order();
                                $getPOrder = $od->getPendingOrder();
                                $i_p = 0;
                                if ($getPOrder) {
                                  while ($resultP = $getPOrder->fetch_assoc()) {
                                    $i_p++;
                                  }
                                }  
                            ?>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><?php if ($i_p > 0) {?><span class="badge blue"><?php echo $i_p; ?></span><?php } ?></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have <?php echo $i_p; ?> new order request</h3>
                                                </div>
                                            </li>
                            <?php
                                $getPOrder2 = $od->getPendingOrder();
                                if ($getPOrder2) {
                                  while ($resultP2 = $getPOrder2->fetch_assoc()) { 
                            ?>                
                                            <li>
                                               <div class="notification_desc">
                                                <p><?php echo $fm->textShorten($resultP2['productName'], 23); ?></p>
                                                <p><span><?php echo $resultP2['date']; ?></span></p>
                                                </div>
                                              <div class="clearfix"></div>  
                                             </li>
                            <?php } } ?>                 
                                             <li>
                                                <div class="notification_bottom">
                                                    <a href="inbox.php">See Order Details</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li> 
                                  <!--  <li class="dropdown head-dpdn">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">9</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 8 pending task</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                                    <div class="clearfix"></div>    
                                                </div>
                                                <div class="progress progress-striped active">
                                                    <div class="bar yellow" style="width:40%;"></div>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                                   <div class="clearfix"></div> 
                                                </div>
                                                <div class="progress progress-striped active">
                                                     <div class="bar green" style="width:90%;"></div>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                                    <div class="clearfix"></div>    
                                                </div>
                                               <div class="progress progress-striped active">
                                                     <div class="bar red" style="width: 33%;"></div>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                                   <div class="clearfix"></div> 
                                                </div>
                                                <div class="progress progress-striped active">
                                                     <div class="bar  blue" style="width: 80%;"></div>
                                                </div>
                                            </a></li>
                                            <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all pending tasks</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>   -->
                                </ul> 
                                <div class="clearfix"> </div>
                            </div>
                            <!--notification menu end -->
                            <div class="profile_details">       
                                <ul>
                                    <li class="dropdown profile_details_drop">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?php
                            if (isset($_GET['action']) && $_GET['action'] == "logout") {
                                Session::destroy();
                            }
                        ?>         
                                            <div class="profile_img">   
                                                <span class="prfil-img"><img src="images/px.png" alt=""> </span> 
                                                <div class="user-name">
                                                    <p><?php echo Session::get('adminName'); ?></p>
                                                    <span>Administrator</span>
                                                </div>
                                                <i class="fa fa-angle-down lnr"></i>
                                                <i class="fa fa-angle-up lnr"></i>
                                                <div class="clearfix"></div>    
                                            </div>  
                                        </a>
                                        <ul class="dropdown-menu drp-mnu">
                                            <li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
                                            <li> <a href="?action=logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"> </div>               
                        </div>
                     <div class="clearfix"> </div>  
                </div>
<!--heder end here-->
<!-- script-for sticky-nav -->
        <script>
        $(document).ready(function() {
             var navoffeset=$(".header-main").offset().top;
             $(window).scroll(function(){
                var scrollpos=$(window).scrollTop(); 
                if(scrollpos >=navoffeset){
                    $(".header-main").addClass("fixed");
                }else{
                    $(".header-main").removeClass("fixed");
                }
             });
             
        });
        </script>
        <!-- /script-for sticky-nav -->
    