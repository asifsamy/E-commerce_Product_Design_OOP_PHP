<?php 
   include '../inc/header_c.php'; 

   $productName = "Customized Half-Sleeve T-Shirt";
   $catId = 2;
   $body = "High quality cut & sew Designer Half Tshirt direct from the manufacturers. 100% Pure combed 155 - 160 GSM Cotton used. Gives you perfect fit, comfort feel and handsome look. Trusted brand online and no compromise on quality. Standard Indian size : S-36 , M-38 , L-40 , XL-42";
   $price = 350;
   $pd_type = 1;
?>
<?php
  $imagedata = base64_decode($_POST['imgdata']);
  $filename = md5(uniqid(rand(), true));
  //path where you want to upload image
  $file = '../admin/uploads/'.$filename.'.png';
  //$imageurl  = 'http://example.com/upload/'.$filename.'.png';
  $imageurl  = '../admin/uploads/'.$filename.'.png';
  file_put_contents($file,$imagedata);
  echo $imageurl;

  $insertProduct = $cPd->customProductInsert($productName, $catId, $body, $price, $pd_type, $imageurl);

  $getPd = $cPd->getCustomProduct($imageurl);
  if ($getPd) {
  	while ($result = $getPd->fetch_assoc()) {
  		$productId = $result['productId'];
  	}
  	Session::set("productId", $productId);
  	echo "<script>window.location = 'detailsCustom.php';</script>";
  	//header("Location:detailsCustom.php");
  } else {
  	echo "<script>window.location = '404.php';</script>";
  	//header("Location:404.php");
  }
?>