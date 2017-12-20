<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->
<?php
   
?>
<style>
    .payment{width: 500px; min-height: 200px; text-align: center; border: 1px solid #ddd; margin: 0 auto; padding: 20px;}
    .payment h2{border-bottom: 1px solid #ddd; margin-bottom: 20px; padding-bottom: 10px;}
</style>

<div id="mainBody">
  <div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<?php include 'inc/sidebar.php';?>
<!-- Sidebar end=============================================== -->
	    <div class="span9">	
	    <ul class="breadcrumb">
		    <li><a href="index.php">Home</a> <span class="divider">/</span></li>
		    <li class="active"> Payment</li>
        </ul>
        <div class="payment">
            <?php
               $y = $ct->yz();
               if ($y) {
                $i = 0;
                 while ($r = $y->fetch_assoc()) {
                     $d[$i] = $r['date'];
                     // echo $d[$i]."<br>";
                     $a = $d[$i];
                     $i++;
                 }
               }
               echo "<br>"."<br>";
               $j = $i-1;
               while ($j >= ($i - 5)) {
                 echo $d[$j]."<br>";
                 $j--;
               }
            ?>
            <?php
                 $p = date("Y-m-d");
                // $p = "2017-11-01";
                $x = $ct->xyz($p);
                if ($x) {
                 while ($r = $x->fetch_assoc()) {
                     echo $r['x']."<br>";
                 }
               }

                // echo "Today is " . $p . "<br>";
            ?>
        </div>
        </div>
     </div> 
  </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
<?php include 'inc/footer.php';?>