<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Load data
function LoadData($file)
{
	// Read file lines
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
		$data[] = explode(';',trim($line));
	return $data;
}

// Simple table
function BasicTable($header, $data)
{
	// Header
	foreach($header as $col)
		$this->Cell(30,7,$col,1);
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(30,14,$col,1);
		$this->Ln();
	}
}

// Better table
function ImprovedTable($header, $data)
{
	// Column widths
	$w = array(40, 35, 40, 45);
	// Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C');
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR');
		$this->Cell($w[1],6,$row[1],'LR');
		$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
		$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
		$this->Ln();
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($header, $data)
{
	// Colors, line width and bold font
	$this->SetFillColor(255,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	// Header
	$w = array(40, 35, 40, 45);
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	// Color and font restoration
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	// Data
	$fill = false;
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		$this->Ln();
		$fill = !$fill;
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}

function SetReportFirstPageHead($report_name, $print_date, $optional_text = '')
{
      $this->Image('logo.png',20,13,60,0,''); 
      $this->SetFont('Arial','',15);
      $this->Cell(170,10,'abc tourism,','',0,'R');
      $this->Ln(7);
      $this->SetFont('Arial','',12);
      $this->Cell(170,10,'address 1,','',0,'R');
      $this->Ln(5);
      $this->Cell(170,10,'address 2,','',0,'R');
      $this->Ln(5);
      $this->Cell(170,10,'address 3 ','',0,'R');
      $this->Ln(7);
      $this->SetFont('Arial','',10);
      $this->Cell(170,10,'phone','',0,'R');
      $this->Ln(5);
      $this->Cell(170,10,'mail','',0,'R');
      $this->Line(20, 48, 190, 48);
      $this->Ln(9);

      $this->SetFont('Arial','',12);
      $this->Cell(140,8,$report_name,'',0,'L');
      $this->SetFont('Arial','',10);
      $this->Cell(30,9, "Printed On: ".$print_date,'',0,'R');

      $this->Line(20, 55, 190, 55);

      if ($optional_text != '')
      {
        $this->Ln(10);
        $this->WriteHTML($optional_text);
        $this->Ln(15);
      }
      else 
      {
        $this->Ln(15);
      }
}

function SetReportGeneralPageHead($report_name, $print_date,$emp_name,$job_name,$tot_amt)
{
       $this->SetFont('Arial','',11);
       $this->Cell(80,8,$report_name,'',0,'L');
       $this->SetFont('Arial','',9);
       $this->Cell(30,9,$print_date,'',1,'L');
	   $this->Cell(80,9,$emp_name,'',1,'L');
	   $this->Cell(80,9,$job_name,'',0,'L');
	   $this->Cell(30,9,$tot_amt,'',1,'L');
       $this->Line(10, 20,130,20);

       $this->Ln(5);
}
}

/*$pdf = new PDF();
// Column headings
$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
// Data loading
$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();*/
?>
