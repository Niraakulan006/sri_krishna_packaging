<?php
    $pdf->SetTitle($file_name);
    $pdf->SetFont('Arial','B',8);

    // $company_logo = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_company', '1', 'logo');

    $company_list = array();
    $company_details = "";
    $company_list = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_factory', '1', 'factory_details');
    if (!empty($company_list)) {
        $company_details = html_entity_decode($obj->encode_decode('decrypt', $company_list));
        $company_details = explode("$$$", $company_details);
    }

    $bill_company_id = $GLOBALS['bill_company_id'];

    $pdf->SetY(8);
    $pdf->SetX(7);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(135, 6, $file_name, 1, 1, 'C', 0);

    $y = $pdf->GetY(); 
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->SetY($y);
    $pdf->SetX(7);

    $end_y = $y;

    if (!empty($company_details)) {
        for ($i = 0; $i < count($company_details); $i++) {
            $company_details[$i] = trim($company_details[$i]);
            if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                $company_details[$i] = str_replace("<br>", " ", $company_details[$i]);
                if ($i === 0) {
                    $pdf->SetFont('Arial', 'B', 7);
                    $pdf->MultiCell(135, 5, $company_details[$i], 0, 'C');
                    $end_y = $pdf->GetY();
                } else {
                    $pdf->SetFont('Arial', '', 6);
                    $pdf->SetX(7);
                    $pdf->MultiCell(135, 3.5, $company_details[$i], 0, 'C');
                    $end_y = $pdf->GetY();
                }
            }
        }
    }

    // if (!empty($company_logo) && file_exists('../include/images/upload/'.$company_logo)) {
    //     $pdf->Image('../include/images/upload/'.$company_logo, 10, 25, 18, 8); 
    // }

    $pdf->SetY(8);
    $pdf->SetX(7);
    $pdf->Cell(135, ($end_y - 8), '', 1, 1, 'C');
    $header_end = $pdf->GetY();
    $pdf->SetY($header_end);
?>
