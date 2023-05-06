
<?php
//include connection file 
include "dbconfig.php";
include_once('pdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(50);
    // Title
    $this->Cell(80,10,'Transaction Statements',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$display_heading = array('transactionId'=> 'Transaction ID','action'=>'Action','credit'=> 'Credit','debit'=> 'Debit','userId'=>'User ID','date'=>'Date');

$result = mysqli_query($con, "SELECT transactionId,action,credit,debit,userId,date FROM transaction") or die("database error:". mysqli_error($con));
$header = mysqli_query($con, "SHOW columns FROM transaction WHERE field != 'balance' and field != 'other'");

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);
foreach($header as $heading) {
$pdf->Cell(32,10,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->SetFont('Arial','',8);
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(32,10,$column,1);
}
$pdf->Output();
?>
