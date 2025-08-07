<?php
include("../include_files.php");

$search_text = "";
if(isset($_REQUEST['search_text'])) {
    $search_text = $_REQUEST['search_text'];
}

$total_records_list = array();
$total_records_list = $obj->getTableRecords($GLOBALS['supplier_table'], '', '', '');

if(!empty($search_text)) {
    $search_text = strtolower($search_text);
    $list = array();
    if(!empty($total_records_list)) {
        foreach($total_records_list as $val) {
            if(strpos(strtolower($obj->encode_decode('decrypt', $val['name_mobile_location'])), $search_text) !== false) {
                $list[] = $val;
            }
        }
    }
    $total_records_list = $list;
}

require_once('../fpdf/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A5'); 
$pdf->AliasNbPages(); 
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetTitle('Supplier List');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY(8);
$pdf->SetX(7);
$file_name = "Supplier List";
include("rpt_header_a5.php");


$pdf->SetFont('Arial', 'B', 7);
$pdf->SetX(7);
$pdf->Cell(8, 6, 'S.No', 1, 0, 'C');
$pdf->Cell(50, 6, 'Name', 1, 0, 'C');
$pdf->Cell(30, 6, 'Mobile No.', 1, 0, 'C');
$pdf->Cell(47, 6, 'Location', 1, 1, 'C');

$pdf->SetFont('Arial', '', 7);
$start_y = $pdf->GetY();

if(!empty($total_records_list)) {
    foreach($total_records_list as $key => $list) {
        if($pdf->GetY() > 190) {
            $pdf->SetFont('Arial','I',5.9);
            $pdf->SetY(200);
            $pdf->SetX(7.0);
            $pdf->Cell(133.0, 2.8, 'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetY(8);
            $pdf->SetX(7);
            include("rpt_header_a5.php");

            $pdf->SetFont('Arial', 'B', 7);
            $pdf->SetX(7);
            $pdf->Cell(8, 6, 'S.No', 1, 0, 'C');
            $pdf->Cell(50, 6, 'Name', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Mobile No.', 1, 0, 'C');
            $pdf->Cell(47, 6, 'Location', 1, 1, 'C');

            $pdf->SetFont('Arial', '', 7);
            $start_y = $pdf->GetY();
        }

        $key += 1;
        $pdf->SetY($start_y);
        $pdf->SetX(7);
        $pdf->Cell(8, 6, $key, 0, 0, 'C');

        // Supplier Name
        if(!empty($list['supplier_name'])) {
            $list['supplier_name'] = html_entity_decode($obj->encode_decode('decrypt', $list['supplier_name']));
            $pdf->SetY($start_y);
            $pdf->SetX(15);
            $pdf->MultiCell(50, 6, $list['supplier_name'], 0, 'C');
        } else {
            $pdf->SetY($start_y);
            $pdf->SetX(15);
            $pdf->MultiCell(50, 6, '-', 0, 'C');
        }
        $name_y = $pdf->GetY() - $start_y;

        // Mobile
        if(!empty($list['mobile_number']) && $list['mobile_number'] != $GLOBALS['null_value']) {
            $list['mobile_number'] = $obj->encode_decode('decrypt', $list['mobile_number']);
            $pdf->SetY($start_y);
            $pdf->SetX(65);
            $pdf->Cell(30, 6, $list['mobile_number'], 0, 0, 'C');
        } else {
            $pdf->SetY($start_y);
            $pdf->SetX(65);
            $pdf->Cell(30, 6, '-', 0, 0, 'C');
        }
        $mobile_y = $pdf->GetY() - $start_y;

        // Location
        if(!empty($list['location']) && $list['location'] != $GLOBALS['null_value']) {
            $list['location'] = html_entity_decode($obj->encode_decode('decrypt', $list['location']));
            $pdf->SetY($start_y);
            $pdf->SetX(95);
            $pdf->MultiCell(47, 6, $list['location'], 0, 'C');
        } else {
            $pdf->SetY($start_y);
            $pdf->SetX(95);
            $pdf->MultiCell(47, 6, '-', 0, 'C');
        }
        $location_y = $pdf->GetY() - $start_y;

        $row_height = max($name_y, $mobile_y, $location_y);

        // Draw Borders
        $pdf->SetY($start_y);
        $pdf->SetX(7);
        $pdf->Cell(8, $row_height, '', 1, 0, 'C');
        $pdf->SetX(15);
        $pdf->Cell(50, $row_height, '', 1, 0, 'C');
        $pdf->SetX(65);
        $pdf->Cell(30, $row_height, '', 1, 0, 'C');
        $pdf->SetX(95);
        $pdf->Cell(47, $row_height, '', 1, 1, 'C');

        $start_y += $row_height;
    }
    $pdf->SetFont('Arial','I',5.9);
    $pdf->SetY(200);
    $pdf->SetX(7.0);
    $pdf->Cell(133.0, 2.8, 'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
}

$pdf->Output();
?>
