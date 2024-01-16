<?php
require_once('../fpdf186/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(60,20,'Hello world');
$pdf->output();
