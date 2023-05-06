
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
    $this->Cell(80,10,'Customer Accounts',1,0,'C');
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

$display_heading = array('id'=> 'ID','email'=>'Email','name'=> 'Name','balance'=> 'Balance','cnic'=>'CNIC','number'=>'PhoneNo.','accountNo'=>'AccountNo','branch'=>'Branch','accountType'=>'Acc.Type','panNo'=>'PanNo.','nationName'=>'Nationality');

$result = mysqli_query($con, "SELECT id,email,name,balance,cnic,number,accountNo,branch,accountType,panNo,nationName FROM useraccounts") or die("database error:". mysqli_error($con));
$header = mysqli_query($con, "SHOW columns FROM useraccounts WHERE field != 'password' and field != 'date'and field != 'source'and field != 'city'and field != 'address'");

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);
foreach($header as $heading) {
$pdf->Cell(18,4,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->SetFont('Arial','',4);
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(18,5,$column,1);
}
$pdf->Output();
?>
