<?php
require_once './../config/database.php';
require_once './../library/fpdf/fpdf.php';

function track($transaction_id)
{
    global $conn;

    $query = "SELECT * FROM t_item
              JOIN `transaction` ON t_item.transaction_id = `transaction`.transaction_id
              JOIN product ON t_item.product_id = product.product_id
              WHERE t_item.transaction_id = '$transaction_id' 
              ORDER BY t_item.t_item_id ASC";

    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function track2($transaction_id)
{
    global $conn;

    $query = "SELECT transaction_id, transaction_status, transaction_total 
              FROM `transaction`
              WHERE transaction_id = '$transaction_id'
              LIMIT 1";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

if (!isset($_GET['trx'])) {
    die("Kode transaksi tidak ditemukan.");
}

$transaction_id = $_GET['trx'];


$items = track($transaction_id);
$summary = track2($transaction_id);

if (!$summary) {
    die("Transaksi tidak ditemukan.");
}


$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();


$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(0, 10, 'KitaShop', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 50, 'INVOICE PEMBELIAN', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 8, 'Kode Transaksi : ' . $transaction_id, 0, 1);
$pdf->Cell(0, 8, 'Status : ' . $summary['transaction_status'], 0, 1);
$pdf->Ln(5);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 8, 'No', 1);
$pdf->Cell(70, 8, 'Produk', 1);
$pdf->Cell(30, 8, 'Harga', 1);
$pdf->Cell(30, 8, 'Qty', 1);
$pdf->Cell(40, 8, 'Subtotal', 1);
$pdf->Ln();


$pdf->SetFont('Arial', '', 12);
$no = 1;
$total = 0;

foreach ($items as $item) {
    $sub = $item['product_price'] * $item['t_item_qty'];
    $total += $sub;

    $pdf->Cell(10, 8, $no++, 1);
    $pdf->Cell(70, 8, $item['product_name'], 1);
    $pdf->Cell(30, 8, number_format($item['product_price']), 1);
    $pdf->Cell(30, 8, $item['t_item_qty'], 1);
    $pdf->Cell(40, 8, number_format($sub), 1);
    $pdf->Ln();
}


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(140, 10, 'TOTAL', 1);
$pdf->Cell(40, 10, number_format($summary['transaction_total']), 1);
$pdf->Ln(15);


$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(0, 10, 'Terima kasih sudah berbelanja!', 0, 1, 'C');

$pdf->Output();
