<?php
	include("config.php"); 
   session_start();
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 0))
   {
      header('Location: ../login.php');
      exit();
   }
   ob_start(); 
   $membership_number = $_SESSION['membership_number'];
   $application_id = $_SESSION['application_id'];
   $amount = $_SESSION['amount'];
   $query_user = mysqli_query($conn,"SELECT CONCAT(fname,' ',lname) AS name FROM users WHERE membership_number = '$membership_number'") or die(mysqli_error($comm));
   $row = mysqli_fetch_assoc($query_user);
   $name = ucwords($row['name']);
   $loan_type = $_SESSION['loan_type'];
   $query_loan_name = mysqli_query($conn,"SELECT type, FROM applications WHERE type = '$loan_type' AND membership_number = '$membership_number'") or die(mysqli_error($conn));
   $row = mysqli_fetch_assoc($query_loan_name);
   switch($row['type'])
   {
   	case 2:
   	$loan_name = 'Normal Loan';
   	break;

   	case 3:
   	$loan_name = 'School Fees';
   	break;

   	case 4:
   	$loan_name = 'Top Up Loan';
   	break;


   }


// Include the main TCPDF library (search for installation path).
require_once('TCPDF/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Alarm Sacco Loan Application');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' Guarantor Form', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<h1 style="text-align:center">$name ( Membership No:$membership_number)</h1>
<h2 style="text-align:center">$loan_name application($application_id)</h2>
<h2 style="text-align:center">Amount:$amount</h2>
<p>I alarm sacco member number..............................hereby confirms to abide by the rules of loan payment as written by the laws and regulations.
Sign..........................Date.........................</p>
<p style="text-align:center">Guarantor 1:Full Name:...............................................</p>
<p>Membership Number...........................Sign......................Date.....................
<p style="text-align:center">Guarantor 2:Full Name:...............................................</p>
<p>Membership Number...........................Sign......................Date.....................
<p>Membership Number...........................Sign......................Date.....................
<p style="text-align:center">Guarantor 3:Full Name:...............................................</p>
<p>Membership Number...........................Sign......................Date.....................


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($name.'_'.$loan_name.'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+