<?php

require_once '../src/inc/session_check.php';

$id = $params->get("id");

$orderManger = new OrderManger($params);
$order = $orderManger->getOrder($id);
$order->setItems($orderManger->getOrderLines($order->id));

define('EURO', chr(128));

class PDF extends FPDF
{
    function Header() {
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
        $this->Cell(50, 10, "ORDER", 0, 1);

        //Display Horizontal line
        $this->Line(0, 48, 210, 48);
    }

    function body($order) {

        //Billing Details
        $this->SetY(55);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 10, "Bill To: ", 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->Cell(50, 7, $order->shipping_company, 0, 1);
        $this->Cell(50, 7, $order->shipping_name, 0, 1);
        $this->Cell(50, 7, $order->shipping_street. ', '. $order->shipping_postalcode, 0, 1);
        $this->Cell(50, 7, $order->shipping_city. ', '. $order->shipping_country, 0, 1);

        //Display Invoice no
        $this->SetY(55);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice No : " . $order->id);

        //Display Invoice date
        $this->SetY(63);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice Date : " . $order->created);

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
        foreach ($order->getItems() as $product) {
            $this->Cell(80, 9, $product->product_name, "LR", 0);
            $this->Cell(40, 9, EURO. $product->getPrice(true), "R", 0, "C");
            $this->Cell(30, 9, $product->quantity, "R", 0, "C");
            $this->Cell(40, 9, EURO. $product->getTotalPrice(true), "R", 0, "C");
            $this->Ln();
        }
        //Display table empty rows
        for ($i = 0; $i < 12 - count($order->getItems()); $i++) {
            $this->Cell(80, 9, "", "LR", 0);
            $this->Cell(40, 9, "", "R", 0, "R");
            $this->Cell(30, 9, "", "R", 0, "C");
            $this->Cell(40, 9, "", "R", 1, "R");
        }
        //Display table total row
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(150, 9, "TOTAL", 1, 0, "R");
        $this->Cell(40, 9, EURO. $order->getSubTotalPrice(true, true, true), 1, 1, "R");

    }
}
//Create A4 Page with Portrait
$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$pdf->body($order);
$pdf->Output();
