<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('../fpdf186/fpdf.php');
include_once '../config/connect.php';

$id = $_GET['id'];

$sql = "SELECT
            *,
            `invoices`.`id` AS `invoice_id`
        FROM
            `invoices`
        INNER JOIN customers ON invoices.customer_id=customers.id
        WHERE
            `invoices`.`id` = $id";

$result = $con->query($sql);
$array = array($result);
while ($row = mysqli_fetch_array($result)) {
    $array['invoice_id'] = $row['invoice_id'];
    $array['created'] = $row['created'];
    $array['first_name'] = $row['first_name'];
    $array['last_name'] = $row['last_name'];
    $array['company'] = $row['shipping_company'];
    $array['street'] = $row['shipping_street'];
    $array['postalcode'] = $row['shipping_postalcode'];
    $array['city'] = $row['shipping_city'];
    $array['country'] = $row['shipping_country'];
}

$sql = "SELECT
            *
        FROM
            `invoice_line`
        INNER JOIN products ON invoice_line.product_id=products.id
        WHERE
            `invoice_id` = $id";
$result = $con->query($sql);
$productenArray = array();
while($product_info = mysqli_fetch_array($result)) {

    $product_array['product_name'] = $product_info['product_name'];
    $product_array['product_price'] = $product_info['product_price'];
    $product_array['quantity'] = $product_info['quantity'];
    $product_array['total'] = $product_info['product_price'] * $product_info['quantity'];
    $productenArray[] = $product_array;
}

$total = 0;
foreach ($productenArray as $key) {
    $total += $key['total'];
}

$array['total'] = $total;

define('EURO', chr(128));

class PDF extends FPDF
{
    function Header()
    {

        //Display Company Info
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(50, 10, "Drukkerij Teeuwen & Zonen", 0, 1);
        $this->SetFont('Arial', '', 14);
        $this->Cell(50, 7, "Schinkelse baan 15,", 0, 1);
        $this->Cell(50, 7, "2908 LE, Capelle aan den IJssel", 0, 1);
        $this->Cell(50, 7, "TEL : +31 010 458 1511", 0, 1);

        //Display INVOICE text
        $this->SetY(15);
        $this->SetX(-40);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(50, 10, "INVOICE", 0, 1);

        //Display Horizontal line
        $this->Line(0, 48, 210, 48);
    }

    function body($row, $product_info,)
    {

        //Billing Details
        $this->SetY(55);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 10, "Bill To: ", 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->Cell(50, 7, $row['company'], 0, 1);
        $this->Cell(50, 7, $row['first_name']. ' ' .$row['last_name'], 0, 1);
        $this->Cell(50, 7, $row['street']. ', '. $row['postalcode'], 0, 1);
        $this->Cell(50, 7, $row['city']. ', '. $row['country'], 0, 1);

        //Display Invoice no
        $this->SetY(55);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice No : " . $row['invoice_id']);

        //Display Invoice date
        $this->SetY(63);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice Date : " . $row['created']);

        //Display Table headings
        $this->SetY(95);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80, 9, "DESCRIPTION", 1, 0);
        $this->Cell(40, 9, "PRICE", 1, 0, "C");
        $this->Cell(30, 9, "QTY", 1, 0, "C");
        $this->Cell(40, 9, "TOTAL", 1, 1, "C");
        $this->SetFont('Arial', '', 12);

        //Display table product rows
        foreach ($product_info as $row) {
            $this->Cell(80, 9, $row['product_name'], "LR", 0);
            $this->Cell(40, 9, EURO. $row['product_price'], "R", 0, "C");
            $this->Cell(30, 9, $row["quantity"], "R", 0, "C");
            $this->Cell(40, 9, EURO. $row['total'], "R", 0, "C");
            $this->Ln();
        }
        //Display table empty rows
        for ($i = 0; $i < 12 - count($product_info); $i++) {
            $this->Cell(80, 9, "", "LR", 0);
            $this->Cell(40, 9, "", "R", 0, "R");
            $this->Cell(30, 9, "", "R", 0, "C");
            $this->Cell(40, 9, "", "R", 1, "R");
        }
        //Display table total row
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(150, 9, "TOTAL", 1, 0, "R");
        $this->Cell(40, 9, EURO. $row['total'], 1, 1, "R");

    }
}
//Create A4 Page with Portrait
$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$pdf->body($array, $productenArray);
$pdf->Output();
