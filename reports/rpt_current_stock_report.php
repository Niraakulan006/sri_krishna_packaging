<?php
    include("../include_user_check_and_files.php");
    
    $product_id = ""; $factory_id = ""; $godown_id = ""; $location_type = "";$size_id="";$gsm_id="";$bf_id="";$from_date=""; $to_date="";$from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');

    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }
    if(isset($_REQUEST['location_type'])) {
        $location_type = $_REQUEST['location_type'];
    }
    if(isset($_REQUEST['factory_id'])) {
        $factory_id = $_REQUEST['factory_id'];
    }
    if(isset($_REQUEST['godown_id'])) {
        $godown_id = $_REQUEST['godown_id'];
    }
    if(isset($_REQUEST['size_id'])) {
        $size_id = $_REQUEST['size_id'];
    }
    if(isset($_REQUEST['gsm_id'])) {
        $gsm_id = $_REQUEST['gsm_id'];
    }
    if(isset($_REQUEST['bf_id'])) {
        $bf_id = $_REQUEST['bf_id'];
    }
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }

    $total_records_list = array();
    if($location_type =='1'){
        if(!empty($factory_id)){
            if(!empty($size_id) && !empty($gsm_id) && !empty($bf_id)){
                $total_records_list = $obj->getCurrentStockList('1',$factory_id,'',$size_id,$gsm_id,$bf_id,$from_date,$to_date);
            }
            else{
                $total_records_list = $obj->getCurrentStockList('1',$factory_id,'','','','','','');
            }
        }
        else{
            $total_records_list = $obj->getCurrentStockList('1','','','','','','','');
        }
        
    }
    else if($location_type =='2'){
        if(!empty($godown_id)){
            if(!empty($size_id) && !empty($gsm_id) && !empty($bf_id)){
                $total_records_list = $obj->getCurrentStockList('2','',$godown_id,$size_id,$gsm_id,$bf_id,$from_date,$to_date);
            }
            else{
                $total_records_list = $obj->getCurrentStockList('2','',$godown_id,'','','','','');
            }
        }
        else{
            $total_records_list = $obj->getCurrentStockList('2','','','','','','','');
        }
    }
    else{
        $total_records_list = $obj->getCurrentStockList('','',$login_godown_id,'','','','','');
    }

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $file_name="Current Stock Report";
    include("rpt_header.php");
    $pdf->SetY($header_end);
    $bill_to_y = $pdf->GetY();
    $s_no = 1; $footer_height = 15; $height = 0; $l = 0; 
    $total_stock = 0;
    $pdf->SetFont('Arial','B',9);
    if(empty($factory_id) && empty($godown_id)) {
        if(!empty($total_records_list)) {
            $total_pages = array(1);
            $page_number = 1;
            $last_count = 0;
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(190,7,'Current Stock Report',1,1,'C',0);
            $pdf->SetX(10);
            $pdf->Cell(20,8,'S.No',1,0,'C',0);
            $pdf->Cell(130,8,'Location',1,0,'C',0);
            $pdf->Cell(40,8,'Current Stock (Nos)',1,1,'C',0);
           
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

                    $file_name="Current Stock Report";
                    include("rpt_header.php");
                    $pdf->SetY($header_end);
                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(190,7,'Current Stock Report',1,1,'C',0);
                    $pdf->SetX(10);
                    $pdf->Cell(20,8,'S.No',1,0,'C',0);
                    $pdf->Cell(130,8,'Location',1,0,'C',0);
                    $pdf->Cell(40,8,'Current Stock (Nos)',1,1,'C',0);
                    $pdf->SetFont('Arial','',8);
                    $y_axis=$pdf->GetY();
                }

                $inward_unit = 0; $outward_unit = 0;
                $pdf->SetX(10);
                $pdf->Cell(20,6,$s_no,1,0,'C',0);
                
                $factory_name = "";$godown_name = "";
                if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                    $factory_name = $obj->getTableColumnValue($GLOBALS['factory_table'],'factory_id',$data['factory_id'],'factory_name');
                    $pdf->SetX(30);
                    $pdf->Cell(130,6,html_entity_decode($obj->encode_decode('decrypt', $factory_name)),1,0,'C',0);
                }else if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$data['godown_id'],'godown_name');
                    $pdf->SetX(30);
                    $pdf->Cell(130,6,html_entity_decode($obj->encode_decode('decrypt', $godown_name)),1,0,'C',0);
                }
                else{
                    $pdf->SetX(30);
                    $pdf->Cell(130,6,' - ',1,0,'C',0);
                }

                if(!empty($data['inward_unit']) || !empty($data['outward_unit'])) {
                    $pdf->SetX(160);
                    $total_stock += $data['inward_unit'] - $data['outward_unit'];
                    $pdf->Cell(40,6,$data['inward_unit'] - $data['outward_unit'],1,1,'R',0);
                    

                } else {
                    $pdf->SetX(160);
                    $pdf->Cell(40,6,' - ',1,1,'R',0);
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
                $pdf->Cell(130,270-$y_axis,'',1,0,'C',0); 
                $pdf->Cell(40,270-$y_axis,'',1,1,'C',0);
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(275);
                $pdf->SetX(10);
                $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);

                $file_name="Current Stock Report";
                include("rpt_header.php");
                
                $pdf->SetY($header_end);
                $bill_to_y = $pdf->GetY();

                $pdf->SetFont('Arial','B',9);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Current Stock Report - ( '.date('d-m-Y',strtotime($from_date)) .' to '.date('d-m-Y',strtotime($to_date)).' )',1,1,'C',0);
                $pdf->SetX(10);
                $pdf->Cell(20,8,'S.No',1,0,'C',0);
                $pdf->Cell(130,8,'Location',1,0,'C',0);
                $pdf->Cell(40,8,'Current Stock (Nos)',1,1,'C',0);
                $pdf->SetFont('Arial','',8);
                
                $y_axis=$pdf->GetY();

                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(130,($content_height-$y_axis),'',1,0);
                $pdf->Cell(40,($content_height-$y_axis),'',1,1);
                $pdf->SetY($content_height);
            } 
            else {
                $content_height = 270 - $footer_height;
                $pdf->SetY($y_axis);
                $pdf->SetX(10);
                $pdf->Cell(20,($content_height-$y_axis),'',1,0);
                $pdf->Cell(130,($content_height-$y_axis),'',1,0);
                $pdf->Cell(40,($content_height-$y_axis),'',1,1);
            }
            
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(140,8,'Total Count',1,0,'R',0);

            if(!empty($total_stock)) {
                $pdf->SetX(150);
                $pdf->Cell(50,8, $total_stock,1,1,'R',0);
                
            } else {
                $pdf->SetX(150);
                $pdf->Cell(50,8,' - ',1,1,'R',0);
            }
        }
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(275);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }
    else if(!empty($size_id) && !empty($gsm_id) && !empty($bf_id) && !empty($location_type)) {
        $pdf->SetFont('Arial','B',9);
        if(!empty($total_records_list)) {
            $total_pages = array(1);
            $page_number = 1;
            $last_count = 0;
            $inward_unit = 0; $outward_unit = 0;          
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);

            $factory_name = "";
            if(!empty($factory_id) && $factory_id !=$GLOBALS['null_value']) {
                $factory_name = $obj->GetTableColumnValue($GLOBALS['factory_table'], 'factory_id', $factory_id, 'factory_name');
            }
            $godown_name = "";
            if(!empty($godown_id) && $godown_id !=$GLOBALS['null_value']) {
                $godown_name = $obj->GetTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'godown_name');
            }
            $size_name = "";
            if(!empty($size_id) && $size_id !=$GLOBALS['null_value']) {
                $size_name = $obj->GetTableColumnValue($GLOBALS['size_table'], 'size_id', $size_id, 'size_name');
                $size_name = $obj->encode_decode('decrypt',$size_name);
            }
            $gsm_name = "";
            if(!empty($gsm_id) && $gsm_id !=$GLOBALS['null_value']) {
                $gsm_name = $obj->GetTableColumnValue($GLOBALS['gsm_table'], 'gsm_id', $gsm_id, 'gsm_name');
                $gsm_name = $obj->encode_decode('decrypt',$gsm_name);
            }
            $bf_name = "";
            if(!empty($bf_id) && $bf_id !=$GLOBALS['null_value']) {
                $bf_name = $obj->GetTableColumnValue($GLOBALS['bf_table'], 'bf_id', $bf_id, 'bf_name');
                $bf_name = $obj->encode_decode('decrypt',$bf_name);
            }
            if(!empty($factory_name) && $factory_name != $GLOBALS['null_value']) {
                $pdf->Cell(190,7,'Factory - '.html_entity_decode($obj->encode_decode('decrypt', $factory_name)).'  - ( '.date('d-m-Y',strtotime($from_date)) .' to '.date('d-m-Y',strtotime($to_date)).' )',1,1,'C',0);
            }
            else {
                $pdf->Cell(190,7,'Godown - '.html_entity_decode($obj->encode_decode('decrypt', $godown_name)).'  - ( '.date('d-m-Y',strtotime($from_date)) .' to '.date('d-m-Y',strtotime($to_date)).' )',1,1,'C',0);
            }
            $pdf->Cell(190,7,'Size - '.$size_name.' / GSM - '.$gsm_name.' / BF - '.$bf_name,1,1,'C',0);
            $current_stock = 0;
            $current_stock = $obj->ShowCurrentStock($godown_id, $factory_id, $size_id, $gsm_id, $bf_id);
            $pdf->Cell(190,7,' Current Stock : '.$current_stock.' Nos',1,1,'C',0);
            
            $product_start_y = $pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(10, 8, 'S.No', 1, 0, 'C', 0);
            $pdf->Cell(25, 8, 'Bill Date', 1, 0, 'C', 0);
            $pdf->Cell(25, 8, 'Bill No', 1, 0, 'C', 0);
            $pdf->Cell(35, 8, 'Bill Type', 1, 0, 'C', 0);
            $pdf->Cell(45, 8, 'Remarks', 1, 0, 'C', 0);
            $pdf->Cell(25, 8, 'Inward', 1, 0, 'C', 0);
            $pdf->Cell(25, 8, 'Outward', 1, 1, 'C', 0);
            
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
                    $file_name="Current Stock Report";
                    include("rpt_header.php");
                    $pdf->SetY($header_end);
                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    if(!empty($factory_name) && $factory_name!=$GLOBALS['null_value']) {
                        $pdf->Cell(190,7,'Factory - '.html_entity_decode($obj->encode_decode('decrypt', $factory_name)).' - ('.date('d-m-Y',strtotime($from_date)) .' to '.date('d-m-Y',strtotime($to_date)).')',1,1,'C',0);
                    }else{
                        $pdf->Cell(190,7,'Godown - '.html_entity_decode($obj->encode_decode('decrypt', $godown_name)).' - ('.date('d-m-Y',strtotime($from_date)) .' to '.date('d-m-Y',strtotime($to_date)).')',1,1,'C',0);
                    }
                    $pdf->Cell(190,7,'Size : '.$size_name.' / GSM : '.$gsm_name.' / BF : '.$bf_name,1,1,'C',0);
                    $pdf->Cell(190,7,' Current Stock : '.$current_stock.' Nos',1,1,'C',0);
                    $pdf->SetX(10);
                    $pdf->Cell(10, 8, 'S.No', 1, 0, 'C', 0);
                    $pdf->Cell(25, 8, 'Bill Date', 1, 0, 'C', 0);
                    $pdf->Cell(25, 8, 'Bill No', 1, 0, 'C', 0);
                    $pdf->Cell(35, 8, 'Bill Type', 1, 0, 'C', 0);
                    $pdf->Cell(45, 8, 'Remarks', 1, 0, 'C', 0);
                    $pdf->Cell(25, 8, 'Inward', 1, 0, 'C', 0);
                    $pdf->Cell(25, 8, 'Outward', 1, 1, 'C', 0);
                    $start_y = $pdf->GetY();
                    $pdf->SetFont('Arial','',8);
                    $y_axis=$pdf->GetY();
                }
                $date_y = ""; $type_y = "";$stock_type_y = ""; $remarks_y = "";  $inward_y = ""; $outward_y = "";  $y_array = array(); $max_y = ""; $outward = 0;

                $pdf->SetY($start_y);
                $pdf->SetX(10);
                $pdf->MultiCell(10, 7, $s_no, 0, 'C', 0);

                $pdf->SetY($start_y);
                if(!empty($data['stock_date'])) {
                    $stock_date = "";
                    $stock_date = date('d-m-Y', strtotime($data['stock_date']));
                    $pdf->SetX(20);
                    $pdf->MultiCell(25, 7, $stock_date, 0, 'C', 0);
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(20);
                    $pdf->MultiCell(25, 7,'-', 0, 'C', 0);
                }
                $date_y = $pdf->GetY() - $start_y;

                $pdf->SetY($start_y);
                if($data['stock_type'] == "Inward Material") {
                    if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                        $pdf->SetX(45);
                        $pdf->MultiCell(25, 7, $obj->encode_decode('decrypt',$data['remarks']), 0, 'C', 0);
                    }
                }
                else {
                    if(!empty($data['bill_unique_number'])) {
                        $pdf->SetX(45);
                        $pdf->MultiCell(25, 7, $data['bill_unique_number'], 0, 'C', 0);
                    }
                    else{
                        $pdf->SetY($start_y);
                        $pdf->SetX(45);
                        $pdf->MultiCell(25, 7, '-', 0, 'C', 0);
                        $type_y = $pdf->GetY();
                    }
                }
                $type_y = $pdf->GetY() - $start_y;

                $pdf->SetY($start_y);
                
                if(!empty($data['stock_type'])) {
                    $pdf->SetX(70);
                    $pdf->MultiCell(35, 7, $data['stock_type'], 0, 'C', 0);
                    
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(70);
                    $pdf->MultiCell(35, 7, '-', 0, 'C', 0);
                    $type_y = $pdf->GetY();
                }
                $stock_type_y = $pdf->GetY() - $start_y;

                $pdf->SetY($start_y);
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $pdf->SetX(105);
                    $pdf->MultiCell(45, 7, $obj->encode_decode('decrypt',$data['remarks']), 0, 'C', 0);
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(105);
                    $pdf->MultiCell(45, 7, '-', 0, 'C', 0);
                    $type_y = $pdf->GetY();
                }
                $remarks_y = $pdf->GetY() - $start_y;
                $inward = ""; $outward = "";
                if(!empty($data['inward_unit'])) {
                    $total_inward += $data['inward_unit'];
                    $inward = $data['inward_unit'];
                }
                if(!empty($data['outward_unit'])) {
                    $total_outward += $data['outward_unit'];
                    $outward = $data['outward_unit'];
                }

                $pdf->SetY($start_y);
                if(!empty($inward)){
                    $pdf->SetX(150);
                    $pdf->MultiCell(25, 7, $inward, 0, 'R', 0);
                } else {
                    $pdf->SetX(150);
                    $pdf->MultiCell(25, 7,' - ', 0, 'C', 0);
                }
                $inward_y = $pdf->GetY() - $start_y;

                $pdf->SetY($start_y);
                if(!empty($outward)){
                    $pdf->SetX(175);
                    $pdf->MultiCell(25, 7, $outward, 0, 'R', 0);
                } else {
                    $pdf->SetX(175);
                    $pdf->MultiCell(25, 7,' - ', 0, 'C', 0);
                }
                $outward_y = $pdf->GetY() - $start_y;

                $max_y = max(array($date_y,$type_y,$stock_type_y,$remarks_y,$inward_y,$outward_y));
                $pdf->SetY($start_y);
                $pdf->SetX(10);
                $pdf->Cell(10,$max_y,'',1,0,'C');
                $pdf->Cell(25,$max_y,'',1,0,'C');
                $pdf->Cell(25,$max_y,'',1,0,'C');
                $pdf->Cell(35,$max_y,'',1,0,'C');
                $pdf->Cell(45,$max_y,'',1,0,'C');
                $pdf->Cell(25,$max_y,'',1,0,'C');
                $pdf->Cell(25,$max_y,'',1,1,'C');

                $start_y += $max_y;
                $pdf->SetY($start_y);
                
                $s_no++;
                $start_y = $pdf->GetY();

            }
            
            $pdf->SetFont('Arial','B',8);
            $pdf->SetX(10);
            $pdf->Cell(140,8,'Total',1,0,'R',0);
            
            if(!empty($total_inward)){
                $pdf->SetX(150);
                $pdf->cell(25, 8, $total_inward,1, 0, 'R', 0);
            } else {
                $pdf->SetX(150);
                $pdf->cell(25, 8,' - ',1, 0, 'C', 0);
            } 
            if(!empty($total_outward)){
                $pdf->SetX(175);
                $pdf->cell(25, 8, $total_outward,1, 1, 'R', 0);
            } else {
                $pdf->SetX(175);
                $pdf->cell(25, 8,' - ',1, 1, 'C', 0);
            } 
            $pdf->SetX(10);
            $pdf->Cell(140,8,'Current Stock',1,0,'R',0);
            
            if(!empty($total_inward) || !empty($total_outward)){
                $pdf->SetX(150);
                $pdf->cell(50, 8, ($total_inward - $total_outward).' Nos',1, 0, 'C', 0);
            } else {
                $pdf->SetX(150);
                $pdf->cell(50, 8,' - ',1, 0, 'C', 0);
            } 
           
        }
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(275);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }
    else if((!empty($factory_id) || !empty($godown_id)) && (empty($size_id) || empty($gsm_id) || empty($bf_id)) && !empty($location_type)) {
        if(!empty($total_records_list)) {
            $total_pages = array(1);
            $page_number = 1;
            $last_count = 0;
            $inward_unit = 0; $outward_unit = 0;          
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);

            $factory_name = "";
            if(!empty($factory_id) && $factory_id!=$GLOBALS['null_value']) {
                $factory_name = $obj->GetTableColumnValue($GLOBALS['factory_table'], 'factory_id', $factory_id, 'factory_name');
            }
            $godown_name = "";
            if(!empty($godown_id) && $godown_id!=$GLOBALS['null_value']) {
                $godown_name = $obj->GetTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'godown_name');
            }

            if(!empty($factory_name) && $factory_name!=$GLOBALS['null_value']) {
                $pdf->Cell(190,7,'Factory - '.html_entity_decode($obj->encode_decode('decrypt', $factory_name)),1,1,'C',0);
            }else{
                $pdf->Cell(190,7,'Godown - '.html_entity_decode($obj->encode_decode('decrypt', $godown_name)),1,1,'C',0);
            }
            
            $product_start_y = $pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(10, 8, 'S.No', 1, 0, 'C', 0);
            $pdf->Cell(45, 8, 'Size', 1, 0, 'C', 0);
            $pdf->Cell(45, 8, 'GSM', 1, 0, 'C', 0);
            $pdf->Cell(45, 8, 'BF', 1, 0, 'C', 0);
            $pdf->Cell(45, 8, 'Reel Count (Nos)', 1, 1, 'C', 0);
           
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
                    $file_name="Current Stock Report";
                    include("rpt_header.php");
                    $pdf->SetY($header_end);
                    $bill_to_y = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    if(!empty($factory_name) && $factory_name!=$GLOBALS['null_value']) {
                        $pdf->Cell(190,7,'Factory - '.html_entity_decode($obj->encode_decode('decrypt', $factory_name)),1,1,'C',0);
                    }else{
                        $pdf->Cell(190,7,'Godown - '.html_entity_decode($obj->encode_decode('decrypt', $godown_name)),1,1,'C',0);
                    }
                    $pdf->SetX(10);
                    $pdf->Cell(10, 8, 'S.No', 1, 0, 'C', 0);
                    $pdf->Cell(45, 8, 'Size', 1, 0, 'C', 0);
                    $pdf->Cell(45, 8, 'GSM', 1, 0, 'C', 0);
                    $pdf->Cell(45, 8, 'BF', 1, 0, 'C', 0);
                    $pdf->Cell(45, 8, 'Reel Count (Nos)', 1, 1, 'C', 0);
                    $start_y = $pdf->GetY();
                    $pdf->SetFont('Arial','',8);
                    $y_axis=$pdf->GetY();
                }
                $date_y = ""; $type_y = ""; $remarks_y = "";  $inward_y = ""; $outward_y = "";  $y_array = array(); $max_y = ""; $outward = 0;

                $pdf->SetY($start_y);
                $pdf->SetX(10);
                $pdf->MultiCell(10, 7, $s_no, 0, 'C', 0);

                $pdf->SetY($start_y);
                if(!empty($data['size_name'])) {
                    $size_name = "";
                    $size_name = $obj->encode_decode('decrypt',$data['size_name']);
                    $pdf->SetX(20);
                    $pdf->MultiCell(45, 7, $size_name, 0, 'C', 0);
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(20);
                    $pdf->MultiCell(45, 7,'-', 0, 'C', 0);
                }
                $date_y = $pdf->GetY() - $start_y;

                $pdf->SetY($start_y);
                if(!empty($data['gsm_name'])) {
                    $pdf->SetX(65);
                    $pdf->MultiCell(45, 7, $obj->encode_decode('decrypt',$data['gsm_name']), 0, 'C', 0);
                    
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(65);
                    $pdf->MultiCell(45, 7, '-', 0, 'C', 0);
                    $type_y = $pdf->GetY();
                }
                $type_y = $pdf->GetY() - $start_y;

                $pdf->SetY($start_y);
                if(!empty($data['bf_name'])) {
                    $pdf->SetX(110);
                    $pdf->MultiCell(45, 7, $obj->encode_decode('decrypt',$data['bf_name']), 0, 'C', 0);
                    
                }
                else{
                    $pdf->SetY($start_y);
                    $pdf->SetX(110);
                    $pdf->MultiCell(45, 7, '-', 0, 'C', 0);
                    $type_y = $pdf->GetY();
                }
                $remarks_y = $pdf->GetY() - $start_y;

                if(!empty($data['inward_unit']) || !empty($data['outward_unit'])) {
                    $total_inward += $data['inward_unit'] - $data['outward_unit'];
                    $inward = $data['inward_unit'] - $data['outward_unit'];
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
                $pdf->Cell(45,$max_y,'',1,0,'C');
                $pdf->Cell(45,$max_y,'',1,0,'C');
                $pdf->Cell(45,$max_y,'',1,0,'C');
                $pdf->Cell(45,$max_y,'',1,1,'C');

                $start_y += $max_y;
                $pdf->SetY($start_y);
                
                $s_no++;
                $start_y = $pdf->GetY();

            }
            
            $pdf->SetFont('Arial','B',8);
            $pdf->SetX(10);
            $pdf->Cell(145,8,'Total',1,0,'R',0);
            
            if(!empty($total_inward)){
                $pdf->SetX(155);
                $pdf->cell(45, 8, $total_inward,1, 0, 'R', 0);
            } else {
                $pdf->SetX(155);
                $pdf->cell(45, 8,' - ',1, 0, 'C', 0);
            } 
        }
        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(275);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }

    $pdf_name = "Current Stock Report.pdf";
    $pdf->Output($from, $pdf_name);
?>