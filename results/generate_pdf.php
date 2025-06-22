<?php
require_once "../includes/db.php";
require_once "../libs/fpdf.php";
session_start();

$student_id = ($_SESSION["role"] == "student") ? $_SESSION["user_id"] : $_SESSION["student_id"];

$stmt = $conn->prepare("SELECT * FROM results WHERE student_id = ?");
$stmt->execute([$student_id]);
$results = $stmt->fetchAll();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 16);
$pdf->Cell(0, 10, "Student Result Slip", 0, 1, "C");

$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(30, 10, "Year", 1);
$pdf->Cell(40, 10, "Term", 1);
$pdf->Cell(70, 10, "Subject", 1);
$pdf->Cell(30, 10, "Score", 1);
$pdf->Ln();

$pdf->SetFont("Arial", "", 12);
foreach ($results as $r) {
    $pdf->Cell(30, 10, $r["year"], 1);
    $pdf->Cell(40, 10, $r["term"], 1);
    $pdf->Cell(70, 10, $r["subject"], 1);
    $pdf->Cell(30, 10, $r["score"], 1);
    $pdf->Ln();
}

$pdf->Output("I", "result-slip.pdf");
?>