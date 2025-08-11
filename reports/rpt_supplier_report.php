<?php
    include("../include_user_check_and_files.php");
    
    $supplier_id = ""; $from_date=""; $to_date="";
    $from_date = date('Y-m-d', strtotime('-7 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');

    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }
    if(isset($_REQUEST['supplier_id'])) {
        $supplier_id = $_REQUEST['supplier_id'];
    }
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }

    $total_records_list = array();
    $total_records_list = $obj->getSupplierReport($supplier_id,$from_date,$to_date);

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $file_name="Supplier Report";
    include("rpt_header.php");
    $pdf->SetY($header_end);
    $bill_to_y = $pdf->GetY();
    $s_no = 1; $footer_height = 15; $height = 0; $l = 0; 
    $total_stock = 0;
    $pdf->SetFont('Arial','B',9);
    if(empty($supplier_id)) {
        if(!empty($total_records_list)) {
            $total_pages = array(1);
            $page_number = 1;
            $last_count = 0;
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(190,7,'Supplier Report',1,1,'C',0);
            $pdf->SetX(10);
            $pdf->Cell(20,8,'S.No',1,0,'C',0);
            $pdf->Cell(90,8,'Supplier Name',1,0,'C',0);
            $pdf->Cell(80,8,'Reel Count',1,1,'C',0);
            $pdf->SetFont('Arial','',8);
            
            $y_axis=$pdf->GetY();
            $s_no = "1"; $total_stock = 0; $content_height = 0;
            if(!empty($total_stock)){
                $height -= 15;
                $footer_height += 15;
            }
            
            foreach($total_records_list as $key => $data) {
                if($pdf->GetY() > 270){
                    $y = $pdf->GetY();

                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(275);
                    $pdf->SetX(10);
                    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $l+1;

                    $file_name="Supplier Report";
                    include("rpt_header.php");
                    $pdf->SetY($header_end);
                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(190,7,'Supplier Report',1,1,'C',0);
                    $pdf->SetX(10);
                    $pdf->Cell(20,8,'S.No',1,0,'C',0);
                    $pdf->Cell(90,8,'Supplier Name',1,0,'C',0);
                    $pdf->Cell(80,8,'Reel Count',1,1,'C',0);
                    $pdf->SetFont('Arial','',8);
                    $y_axis=$pdf->GetY();
                }

                $inward_unit = 0; $outward_unit = 0;
                $pdf->SetX(10);
                $pdf->Cell(20,6,$s_no,1,0,'C',0);
                
                $supplier_name = "";
                if(!empty($data['supplier_id']) && $data['supplier_id'] != $GLOBALS['null_value']) {
                    $supplier_name = $obj->getTableColumnValue($GLOBALS['supplier_table'],'supplier_id',$data['supplier_id'],'supplier_name');
                    $pdf->SetX(30);
                    $pdf->Cell(90,6,html_entity_decode($obj->encode_decode('decrypt', $supplier_name)),1,0,'C',0);
                }
                else{
                    $pdf->SetX(30);
                    $pdf->Cell(90,6,' - ',1,0,'C',0);
                }

                if(!empty($data['inward_unit'])) {
                    $pdf->SetX(120);
                    $total_stock += $data['inward_unit'];
                    $pdf->Cell(80,6,$data['inward_unit'],1,1,'R',0);
                    
                } else {
                    $pdf->SetX(120);
                    $pdf->Cell(80,6,' - ',1,1,'R',0);
                }
                
                $s_no++;
            }

            $end_y = $pdf->GetY();
            $last_page_count = $s_no - $last_count;
            
            if(($footer_height+$end_y) >= 270){
                $y = $pdf->GetY();
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(90,270-$y_axis,'',1,0,'C',0);
                $pdf->Cell(80,270-$y_axis,'',1,1,'C',0);
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(275);
                $pdf->SetX(10);
                $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Supplier Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->SetFont('Arial','B',9);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Supplier Report',1,1,'C',0);
                $pdf->SetX(10);
                $pdf->Cell(20,8,'S.No',1,0,'C',0);
                $pdf->Cell(90,8,'Supplier Name',1,0,'C',0);
                $pdf->Cell(80,8,'Reel Count',1,1,'C',0);
                $pdf->SetFont('Arial','',8);
                
                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(90,($content_height-$y_axis),'',1,0);
                $pdf->Cell(80,($content_height-$y_axis),'',1,1);
                $pdf->SetY($content_height);
            } 
            else {
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(90,($content_height-$y_axis),'',1,0);
                $pdf->Cell(80,($content_height-$y_axis),'',1,1);
            }
            
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(110,8,'Total Count',1,0,'R',0);

            if(!empty($total_stock)) {
                $pdf->SetX(120);
                $pdf->Cell(80,8, $total_stock,1,1,'R',0);
                
            } else {
                $pdf->SetX(120);
                $pdf->Cell(80,8,' - ',1,1,'R',0);
            }
        }
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(275);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }
    else if(!empty($supplier_id)) {
        if(!empty($total_records_list)) {
            $total_pages = array(1);
            $page_number = 1;
            $last_count = 0;
            $inward_unit = 0; $outward_unit = 0;
            if(!empty($supplier_id)) {
                $supplier_name = "";
                $supplier_name = $obj->GetTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $supplier_id, 'supplier_name');
            }
                      
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            
            $pdf->Cell(190,7,'Supplier Name - '.html_entity_decode($obj->encode_decode('decrypt', $supplier_name)).' - ( '.date('d-m-Y',strtotime($from_date)) .' to '.date('d-m-Y',strtotime($to_date)).' )',1,1,'C',0);
            
            $product_start_y = $pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(10, 8, 'S.No', 1, 0, 'C', 0);
            $pdf->Cell(30, 8, 'Bill Date', 1, 0, 'C', 0);
            $pdf->Cell(30, 8, 'Bill No ', 1, 0, 'C', 0);
            $pdf->Cell(80, 8, 'Location', 1, 0, 'C', 0);
            $pdf->Cell(40, 8, 'Inward Qty', 1, 1, 'C', 0);
           
            $start_y = $pdf->GetY();
            $y_axis = $pdf->GetY();
            $total_inward = 0; $total_outward = 0; $s_no = '1'; $content_height = 0;
            // if(!empty($total_inward) || !empty($total_outward)){
            //     $height -= 15;
            //     $footer_height += 15;
            // }
            $pdf->SetFont('Arial','',8);
            foreach($total_records_list as $data) {
                $inward_unit = 0; $outward_unit = 0; $unit_name = ""; $subunit_name = ""; $outward_unit = 0; 
                if($pdf->GetY() > 260){
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial','B',10);
                    $next_page = $pdf->PageNo() +1;
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(275);
                    $pdf->SetX(10);
                    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $l+1;
                    $file_name="Supplier Report";
                    include("rpt_header.php");
                    $pdf->SetY($header_end);
                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(190,7,'Supplier Name - '.html_entity_decode($obj->encode_decode('decrypt', $supplier_name)).' - ( '.date('d-m-Y',strtotime($from_date)) .' to '.date('d-m-Y',strtotime($to_date)).' )',1,1,'C',0);
                    $pdf->SetX(10);
                    $pdf->Cell(10, 8, 'S.No', 1, 0, 'C', 0);
                    $pdf->Cell(30, 8, 'Bill Date', 1, 0, 'C', 0);
                    $pdf->Cell(30, 8, 'Bill No ', 1, 0, 'C', 0);
                    $pdf->Cell(80, 8, 'Location', 1, 0, 'C', 0);
                    $pdf->Cell(40, 8, 'Inward Qty', 1, 1, 'C', 0);
                    $start_y = $pdf->GetY();
                    $pdf->SetFont('Arial','',8);
                    $y_axis=$pdf->GetY();
                }
                $date_y = ""; $type_y = ""; $remarks_y = "";  $inward_y = ""; $outward_y = "";  $y_array = array(); $max_y = ""; $outward = 0;

                $pdf->SetY($start_y);
                $pdf->SetX(10);
                $pdf->MultiCell(10, 7, $s_no, 0, 'C', 0);

                $pdf->SetY($start_y);
                if(!empty($data['stock_date'])) {
                    $stock_date = "";
                    $stock_date = date('d-m-Y', strtotime($data['stock_date']));
                    $pdf->SetX(20);
                    $pdf->MultiCell(30, 7, $stock_date, 0, 'C', 0);
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(20);
                    $pdf->MultiCell(30, 7,'-', 0, 'C', 0);
                }
                $date_y = $pdf->GetY() - $start_y;

                $pdf->SetY($start_y);
                if(!empty($data['bill_unique_number'])) {
                    $pdf->SetX(50);
                    $pdf->MultiCell(30, 7, $data['bill_unique_number'], 0, 'C', 0);
                    
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(50);
                    $pdf->MultiCell(30, 7, '-', 0, 'C', 0);
                    $type_y = $pdf->GetY();
                }
                $type_y = $pdf->GetY() - $start_y;

                $pdf->SetY($start_y);
                if(!empty($data['factory_name']) && $data['factory_name'] != $GLOBALS['null_value']) {
                    $pdf->SetX(80);
                    $pdf->MultiCell(80, 7, html_entity_decode($obj->encode_decode('decrypt',$data['factory_name'])), 0,  'C', 0);
                }
                else if(!empty($data['godown_name']) && $data['godown_name'] != $GLOBALS['null_value']) {
                    $pdf->SetX(80);
                    $pdf->MultiCell(80, 7, html_entity_decode($obj->encode_decode('decrypt',$data['godown_name'])), 0,  'C', 0);
                }else {
                    $pdf->SetX(80);
                    $pdf->MultiCell(30, 7, '-', 0,  'C', 0);
                }
                $remarks_y = $pdf->GetY() - $start_y;

                if($data['inward_unit'] != $GLOBALS['null_value']) {
                    $total_inward += $data['inward_unit'];
                    $inward = $data['inward_unit'];
                }

                $pdf->SetY($start_y);
                if(!empty($inward)){
                    $pdf->SetX(170);
                    $pdf->MultiCell(30, 7, $inward, 0, 'R', 0);
                } else {
                    $pdf->SetX(170);
                    $pdf->MultiCell(30, 7,' - ', 0, 'C', 0);
                }
                $inward_y = $pdf->GetY() - $start_y;

                $max_y = max(array($date_y,$type_y,$remarks_y,$inward_y));
                $pdf->SetY($start_y);
                $pdf->SetX(10);
                $pdf->Cell(10,$max_y,'',1,0,'C');
                $pdf->Cell(30,$max_y,'',1,0,'C');
                $pdf->Cell(30,$max_y,'',1,0,'C');
                $pdf->Cell(80,$max_y,'',1,0,'C');
                $pdf->Cell(40,$max_y,'',1,1,'C');

                $start_y += $max_y;
                $pdf->SetY($start_y);
                
                $s_no++;
                $start_y = $pdf->GetY();

            }
            
            $pdf->SetFont('Arial','B',8);
            $pdf->SetX(10);
            $pdf->Cell(150,8,'Total',1,0,'R',0);
            
            if(!empty($total_inward)){
                $pdf->SetX(160);
                $pdf->cell(40, 8, $total_inward,1, 0, 'R', 0);
            } else {
                $pdf->SetX(160);
                $pdf->cell(40, 8,' - ',1, 0, 'C', 0);
            } 
        }
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(275);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }

    $pdf_name = "Supplier Report.pdf";
    $pdf->Output($from, $pdf_name);
?>