<?php

include_once '../API/config/Database.php';

$database = new Database();
$db = $database->getConnection();

require('../fpdf/fpdf.php');

// New object created and constructor invoked
$pdf = new FPDF();

// Add new pages. By default no pages available.
$pdf->AddPage();

// Set font format and font-size
$pdf->SetFont('Times', 'B', 20);

// Framed rectangular area
$pdf->Cell(176, 30, 'Rapoarte de sistem', 0, 0, 'C');

// Set it new line
$pdf->Ln();

// Set font format and font-size
$pdf->SetFont('Times', 'B', 18);

// Framed rectangular area
$pdf->Cell(176, 15, 'Stocuri existente', 0, 0, 'C');

$pdf->SetFont('Times','', 12);

$stmt = $db->prepare("SELECT * FROM products ORDER BY stock DESC");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    $pdf->Ln();
    $pdf->Cell(100, 10, $row['name'], 0, 0, 'C');
    $pdf->Cell(150, 10, $row['stock'], 0, 0, 'C');
}

$pdf->Ln();

// Set font format and font-size
$pdf->SetFont('Times', 'B', 18);

// Framed rectangular area
$pdf->Cell(176, 15, 'Situatii vanzari', 0, 0, 'C');

$pdf->Ln();

$pdf->Cell(100, 15, 'In functie de brand', 0, 0, 'C');

$pdf->SetFont('Times','', 12);

$stmt = $db->prepare("SELECT brand, COUNT(brand) AS cnt FROM orders GROUP BY brand");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    $pdf->Ln();
    $pdf->Cell(100, 10, $row['brand'], 0, 0, 'C');
    $pdf->Cell(150, 10, $row['cnt'], 0, 0, 'C');
}

$pdf->Ln();

$pdf->SetFont('Times', 'B', 18);

$pdf->Cell(100, 15, 'In functie de ocazie', 0, 0, 'C');

$pdf->SetFont('Times','', 12);

$stmt = $db->prepare("SELECT occasion, COUNT(occasion) AS cnt FROM orders GROUP BY occasion");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    $pdf->Ln();
    $pdf->Cell(100, 10, $row['occasion'], 0, 0, 'C');
    $pdf->Cell(150, 10, $row['cnt'], 0, 0, 'C');
}

$pdf->Ln();

$pdf->SetFont('Times', 'B', 18);

$pdf->Cell(100, 15, 'In functie de aroma parfumurilor', 0, 0, 'C');

$pdf->SetFont('Times','', 12);

$stmt = $db->prepare("SELECT taste, COUNT(taste) AS cnt FROM orders GROUP BY taste");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    $pdf->Ln();
    $pdf->Cell(100, 10, $row['taste'], 0, 0, 'C');
    $pdf->Cell(150, 10, $row['cnt'], 0, 0, 'C');
}

$pdf->Ln();

$pdf->SetFont('Times', 'B', 18);

$pdf->Cell(100, 15, 'In functie de profilul utilizatorului', 0, 0, 'C');

$pdf->SetFont('Times','', 12);

$stmt = $db->prepare("SELECT user_gender, COUNT(user_gender) AS cnt FROM orders GROUP BY user_gender");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    $pdf->Ln();
    $pdf->Cell(100, 10, $row['user_gender'], 0, 0, 'C');
    $pdf->Cell(150, 10, $row['cnt'], 0, 0, 'C');
}

$pdf->Ln();

$pdf->SetFont('Times', 'B', 18);

$pdf->Cell(100, 15, 'In functie de anotimp', 0, 0, 'C');

$pdf->SetFont('Times','', 12);

$stmt = $db->prepare("SELECT season, COUNT(season) AS cnt FROM orders GROUP BY season");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    $pdf->Ln();
    $pdf->Cell(100, 10, $row['season'], 0, 0, 'C');
    $pdf->Cell(150, 10, $row['cnt'], 0, 0, 'C');
}

// Close document and sent to the browser
$pdf->Output();

?>
