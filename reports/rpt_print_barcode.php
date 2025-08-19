<?php
    include("../include_user_check_and_files.php");

    $size_name = "";
    if(isset($_REQUEST['size_name'])) {
        $size_name = trim($_REQUEST['size_name']);
    }
    $gsm_name = "";
    if(isset($_REQUEST['gsm_name'])) {
        $gsm_name = trim($_REQUEST['gsm_name']);
    }
    $bf_name = "";
    if(isset($_REQUEST['bf_name'])) {
        $bf_name = trim($_REQUEST['bf_name']);
    }
    $supplier_name = "";
    if(isset($_REQUEST['supplier_name'])) {
        $supplier_name = trim($_REQUEST['supplier_name']);
    }
    $barcode_file = "";
    if(isset($_REQUEST['barcode_file'])) {
        $barcode_file = trim($_REQUEST['barcode_file']);
    }
    else {
        header("Location: ../inward_material.php");
        exit;
    }
    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('L', 'mm', [100, 70]);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetTitle('Sticker Barcode');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetY(4);
    $pdf->SetX(8);
    $pdf->Cell(84,10,'SRI KRISHNA PACKAGING',0,1,'L');
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetX(8);
    $pdf->Cell(84,10,'SUPPLIER : '.($obj->encode_decode('decrypt', $supplier_name)),1,1,'C');
    $pdf->SetFont('Arial', 'B', 14);
    $start_y = $pdf->GetY();
    $pdf->SetX(8);
    $pdf->Cell(28,10,'SIZE',0,0,'C');
    $pdf->Cell(28,10,'GSM',0,0,'C');
    $pdf->Cell(28,10,'BF',0,1,'C');
    $pdf->SetTextColor(255,0,0);
    $pdf->SetX(8);
    $pdf->Cell(28,10,($obj->encode_decode('decrypt', $size_name)),0,0,'C');
    $pdf->Cell(28,10,($obj->encode_decode('decrypt', $gsm_name)),0,0,'C');
    $pdf->Cell(28,10,($obj->encode_decode('decrypt', $bf_name)),0,1,'C');
    $end_y = $pdf->GetY();
    $pdf->SetTextColor(0,0,0);
    $pdf->SetY($start_y);
    $pdf->SetX(8);
    $pdf->Cell(28,20,'',1,0,'C');
    $pdf->Cell(28,20,'',1,0,'C');
    $pdf->Cell(28,20,'',1,1,'C');
    if(file_exists('../'.$obj->barcode_directory().($obj->encode_decode('decrypt', $barcode_file)))) {
        $pdf->Image('../'.$obj->barcode_directory().($obj->encode_decode('decrypt', $barcode_file)), 20, $end_y+4, 60, 10);
    }
    $pdf->SetY($end_y);
    $pdf->SetX(8);
    $pdf->Cell(84,18,'',1,1,'C');
    $pdf->Output();
?>