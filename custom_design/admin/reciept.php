<?php
require('fpdf17/fpdf.php');

$filepath = realpath(dirname(__FILE__)); 
include_once ($filepath.'/../classes/Order.php');
include_once ($filepath.'/../classes/Customer.php');

$od = new Order();
$cus = new Customer();

if (!isset($_GET['delSid']) || $_GET['time'] == NULL || $_GET['price'] == NULL || $_GET['qty'] == NULL || $_GET['proid'] == NULL) {
	echo "<script>window.location = '404.php'; </script>";
} else {
	$cmrId = $_GET['delSid'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$quantity = $_GET['qty'];
	$productName = $_GET['proid'];
	$amnt = $price * $quantity;
	$g_total = $amnt * 0.10;
	$g_total = $g_total + $amnt;

	//A4 width : 219mm
	//default margin : 10mm each side
	//writable horizontal : 219-(10*2)=189mm

	$t_date = date("d/m/Y");

	$pdf = new FPDF('P','mm','A4');

	$pdf->AddPage();

	//set font to arial, bold, 14pt
	$pdf->SetFont('Arial','B',14);

	//Cell(width , height , text , border , end line , [align] )

	$pdf->Cell(130	,5,'CUSTOM DESIGN',0,0);//end of line

	//set font to arial, regular, 12pt
	$pdf->SetFont('Arial','',12);

	$pdf->Cell(12	,5,'Date:',0,0);
	$pdf->Cell(34	,5,$t_date,0,1);//end of line

	$pdf->Cell(130	,5,'House#53, Road#1, Bloack#A',0,0);
	$pdf->Cell(59	,5,'',0,1);//end of line

	$pdf->Cell(130	,5,'Juhurul Islam City, Aftabnagar, Dhaka-1212',0,1);


	$pdf->Cell(130	,5,'Phone [+12345678]',0,1);//end of line

	$pdf->Cell(130	,5,'Fax [+12345678]',0,1);//end of line


	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189	,20,'',0,1);//end of line
    
    $getCustomer = $cus->getCustomerData($cmrId);
    if ($getCustomer) {
       while ($resultCus = $getCustomer->fetch_assoc()) {

			//billing address
			$pdf->Cell(100	,5,'Bill to',0,1);//end of line

			//add dummy cell at beginning of each line for indentation
			$pdf->Cell(10	,5,'',0,0);
			$pdf->Cell(90	,5,$resultCus['fName'],0,1);

			$pdf->Cell(10	,5,'',0,0);
			$pdf->Cell(90	,5,$resultCus['address'],0,1);

			$pdf->Cell(10	,5,'',0,0);
			$pdf->Cell(90	,5,$resultCus['city'],0,1);

			$pdf->Cell(10	,5,'',0,0);
			$pdf->Cell(90	,5,$resultCus['phone'],0,1);
        }
     }   

	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189	,50,'',0,1);//end of line

	//invoice contents
	$pdf->SetFont('Arial','B',12);
    
    $pdf->Cell(41	,5,'Order Date',1,0);
	$pdf->Cell(70	,5,'Product Name',1,0);
	$pdf->Cell(25	,5,'Price',1,0);
	$pdf->Cell(25	,5,'Quantity',1,0);
	$pdf->Cell(34	,5,'Amount',1,1);//end of line

	$pdf->SetFont('Arial','',12);

	//Numbers are right-aligned so we give 'R' after new line parameter


    $pdf->Cell(41	,5,$time,1,0);
	$pdf->Cell(70	,5,$productName,1,0);
	$pdf->Cell(25	,5,$price,1,0);
	$pdf->Cell(25	,5,$quantity,1,0);
	$pdf->Cell(34	,5,$amnt,1,1,'R');//end of line

	//summary

	$pdf->Cell(136	,5,'',0,0);
	$pdf->Cell(25	,5,'Tax Rate',0,0);
	$pdf->Cell(7	,5,'TK',1,0);
	$pdf->Cell(27	,5,'10%',1,1,'R');//end of line

	$pdf->Cell(136	,5,'',0,0);
	$pdf->Cell(25	,5,'Total Due',0,0);
	$pdf->Cell(7	,5,'TK',1,0);
	$pdf->Cell(27	,5,$g_total,1,1,'R');//end of line

	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189	,50,'',0,1);//end of line

    $pdf->Cell(10	,5,'',0,0);
	$pdf->Cell(90	,5,'__________',0,1);
	$pdf->Cell(10	,5,'',0,0);
	$pdf->Cell(90	,5,'Sign & Date',0,1);

}



















$pdf->Output();
?>
