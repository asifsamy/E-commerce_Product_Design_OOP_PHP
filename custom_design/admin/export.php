<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "design_club");
$output = '';
if(isset($_POST["export"]))
{
 $t_date = date("Y-m-d");
 $query = "SELECT * FROM pd_sold WHERE date LIKE '%$t_date%'";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
      <tr>  
        <th width="5%">OID</th>
        <th width="20%">Order Time</th>
        <th width="6%">P_ID</th>
        <th width="6%">P_Type</th>
        <th width="30%">Product Name</th>
        <th width="5%">Quantity</th>
        <th width="7%">Cust.ID</th>
        <th width="12%">Price</th>
      </tr>
  ';
  $sum = 0;
  while($row = mysqli_fetch_array($result))
  {
    $sum = $sum + $row["price"];
    if ($row["pd_type"] == '0') {
      $pd_type = "Featured";
    } else {
      $pd_type = "Customized";
    } 
    $output .= '
    <tr>  
       <td width="5%">'.$row["oId"].'</td>  
       <td width="20%">'.$row["date"].'</td>  
       <td width="6%">'.$row["productId"].'</td>
       <td width="6%">'.$pd_type.'</td>  
       <td width="30%">'.$row["productName"].'</td>  
       <td width="5%">'.$row["quantity"].'</td>  
       <td width="7%">'.$row["cmrId"].'</td>  
       <td width="12%">TK. '.$row["price"].'</td>  
    </tr>
   ';
  }
  $output .= '<tr><td colspan="6">Total</td>
       <td>TK. '.$sum.'</td>
    </tr></table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>