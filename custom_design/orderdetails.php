<?php include 'inc/header.php';?>
<!-- Header End====================================================================== -->
<?php
   $login = Session::get("cuslogin");
   if ($login == false) {
   	echo "<script>window.location = 'login.php';</script>";
         //header("Location:login.php");

   }
?>
<style>
	.notfound{}
	.notfound h2{font-size: 100px; line-height: 130px; text-align: center;}
	.notfound h2 span{display: block; color: red; font-size: 170px;}
  th{font-size: 20px; background: #565c66; color: #fff;}
  td{font-size: 16px; font-weight: bold;}
</style>

<div id="mainBody">
	<div class="container">
	<div class="row">	
    <ul class="breadcrumb">
    <li><a href="index.php">Home</a> <span class="divider">/</span></li>
    <li class="active"> Order Details</li>
    </ul>
        <div class="order">
           	<h2>Your Ordered Details</h2>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>  
                  <th>Product Name</th>
                  <th>Image</th>
                  <th>Quantity (S, M, L)</th>
                  <th>Price</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
            <?php
                $cmrId = Session::get("cmrId");
                $getOrder = $od->getOrderedProduct($cmrId);
                if ($getOrder) {
                  $i = 0;
                  while ($result = $getOrder->fetch_assoc()) {
                    $i++;
            ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['productName']; ?></td>
                  <td> <img width="60" style="max-height: 80px;" src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                  <td><?php echo $result['quantity']; ?> (<?php echo $result['s_size']; ?>, <?php echo $result['m_size']; ?>, <?php echo $result['l_size']; ?>)</td>
                  <td>Tk. <?php echo $result['price']; ?></td>
                  <td><?php echo $fm->formatDate($result['date']); ?></td>
                  <td><?php
                         if ($result['status'] == '0') {
                            echo "Pending";
                          } elseif($result['status'] == '1') {
                            echo "Approved";
                          } else {
                            echo "Cancelled";
                          }
                      ?>
                  </td>        
                </tr>
      <?php } } ?>
        </tbody>
        </table>
        </div>

		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<?php include 'inc/footer.php';?>