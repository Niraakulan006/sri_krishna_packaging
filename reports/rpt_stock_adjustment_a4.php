<?php

    include("../include_user_check_and_files.php");
    include("../include/number2words.php");

    $view_stock_adjustment_id = "";
    if (isset($_REQUEST['view_stock_adjustment_id'])) {
        $view_stock_adjustment_id = $_REQUEST['view_stock_adjustment_id'];
    } else {
        header("Location: ../stock_adjustment.php");
        exit;
    }
    
    if(isset($_REQUEST['view_stock_adjustment_id'])) { 
        $view_stock_adjustment_id = trim($_REQUEST['view_stock_adjustment_id']);
        $stock_adjustment_date = date('Y-m-d'); $stock_adjustment_number = ""; $supplier_id = ""; $location_type = ""; $godown_type = "";$supplier_details ="";$product_count = 0; $godown_ids = array(); $factory_ids = array(); $size_ids = array(); $gsm_ids = array(); $godown_name = array(); $factory_name = array(); $size_name = array(); $gsm_name = array();$bf_name = array(); $quantity = array(); $stock_type =array();$selected_godown_id = ""; $selected_factory_id = "";$cancelled =0;$remarks = "";
        $stock_adjustment_list = array();
        $stock_adjustment_list = $obj->getTableRecords($GLOBALS['stock_adjustment_table'], 'stock_adjustment_id', $view_stock_adjustment_id);
        if(!empty($stock_adjustment_list)) {
            foreach($stock_adjustment_list as $data) {
                if(!empty($data['stock_adjustment_date']) && $data['stock_adjustment_date'] != "0000-00-00") {
                    $stock_adjustment_date = date('d-m-Y', strtotime($data['stock_adjustment_date']));
                }
                if(!empty($data['stock_adjustment_number']) && $data['stock_adjustment_number'] != $GLOBALS['null_value']) {
                    $stock_adjustment_number = $data['stock_adjustment_number'];
                }
                if(!empty($data['location_type']) && $data['location_type'] != $GLOBALS['null_value']) {
                    $location_type = $data['location_type'];
                }
                if(!empty($data['godown_type']) && $data['godown_type'] != $GLOBALS['null_value']) {
                    $godown_type = $data['godown_type'];
                }
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $godown_ids = explode(",", $data['godown_id']);
                    if($godown_type == '1') {
                        $selected_godown_id = $godown_ids[0];
                    }
                }
                if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                    $godown_ids = explode(",", $data['factory_id']);
                    if($location_type == '2') {
                        $selected_factory_id = $godown_ids[0];
                    }
                }
                if(!empty($data['factory_name']) && $data['factory_name'] != $GLOBALS['null_value']) {
                    $factory_name = explode(",", $data['factory_name']);
                }
                if(!empty($data['godown_name']) && $data['godown_name'] != $GLOBALS['null_value']) {
                    $godown_name = explode(",", $data['godown_name']);
                }
                if(!empty($data['size_name']) && $data['size_name'] != $GLOBALS['null_value']) {
                    $size_name = explode(",", $data['size_name']);
                    $product_count = count($size_name);
                }
                if(!empty($data['gsm_name']) && $data['gsm_name'] != $GLOBALS['null_value']) {
                    $gsm_name = explode(",", $data['gsm_name']);
                }
                if(!empty($data['bf_name']) && $data['bf_name'] != $GLOBALS['null_value']) {
                    $bf_name = explode(",", $data['bf_name']);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity = explode(",", $data['quantity']);
                }
                if(!empty($data['stock_type']) && $data['stock_type'] != $GLOBALS['null_value']) {
                    $stock_type = explode(",", $data['stock_type']);
                }
                if(!empty($data['cancelled']) && $data['cancelled'] != $GLOBALS['null_value']) {
                    $cancelled =$data['cancelled'];
                }
                if(!empty($data['total_quantity']) && $data['total_quantity'] != $GLOBALS['null_value']) {
                    $total_quantity = $data['total_quantity'];
                }
                if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                    $remarks = $data['remarks'];
                }
            }
        }

        $company_name = "";
        $company_name = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_factory', '1', 'factory_name');
        if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
            $company_name = $obj->encode_decode('decrypt', $company_name);
        }

        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Stock Adjustment');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);

        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        $file_name="Stock Adjustment";
        include("rpt_header.php");

        if($cancelled == '1') {
            if(file_exists('../include/images/cancelled.jpg')) {
                $pdf->SetAlpha(0.3);
                $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                $pdf->SetAlpha(1);
            }
        }

        $bill_to_y = $pdf->GetY();
        $party_y = $pdf->GetY();
        $pdf->SetFont('Arial','B',9);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(80,8,'Stock Adjustment No   ',0,0,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(45);
        $pdf->Cell(40,8,": ".$stock_adjustment_number,0,0,'L',0);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(110);
        $pdf->Cell(20,8,'Date',0,0,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(122);
        $pdf->Cell(40,8,": ".$stock_adjustment_date,0,1,'L',0);

        $bill_to_y2 = $pdf->GetY();
        $y_array = array($party_y,$bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(100,8,'',1,0,'L',0);
        $pdf->SetX(110);
        $pdf->Cell(90,8,'',1,1,'L',0);
        $bill_to_y1 = $pdf->GetY();
        $pdf->SetY($bill_to_y);
        $bill_to_y2 = $pdf->GetY();
        $y_array = array($bill_to_y1,$bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(100,($max_bill_y - $bill_to_y),'',1,0,'L',0);
        $pdf->SetX(110);
        $pdf->Cell(90,($max_bill_y - $bill_to_y),'',1,1,'L',0);

        $header_height = $max_bill_y - 10;
        if($header_height > 25){
            // $height -= ($header_height - 45);
        }
        $address_height = $max_bill_y - $bill_to_y;


        $starting_y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(101,114,122);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetX(10);
        $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
        $pdf->Cell(60, 7, 'Location', 1, 0, 'C', 1);
        $pdf->Cell(25, 7, 'Reel Size', 1, 0, 'C', 1);
        $pdf->Cell(25, 7, 'GSM', 1, 0, 'C', 1);
        $pdf->Cell(25, 7, 'BF', 1, 0, 'C', 1);
        $pdf->Cell(25, 7, 'QTY (Nos)', 1, 0, 'C', 1);
        $pdf->Cell(20, 7, 'Stock Type', 1, 1, 'C', 1);
        $pdf->SetTextColor(0,0,0);
        

        $pdf->SetFont('Arial', '', 8);
        $product_y = $pdf->GetY();

        $y_axis = $pdf->GetY();
        $s_no = 1;
        $net_amount = 0;
        $footer_height = 0;
        $footer_height += 25;
        $total_pages = array(1);
        $page_number = 1;
        $last_count = 0;
        $quantity_total = 0;

        if (!empty($view_stock_adjustment_id) && !empty($godown_ids)) {
            for ($p = 0; $p < count($godown_ids); $p++) {

                if ($pdf->GetY() >= 265) {
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 9);

                    $next_page = $pdf->PageNo() + 1;
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(-15);
                    $pdf->SetX(10);
                    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);

                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $p + 1;
                    $pdf->SetTitle('Stock Adjustment');
                    $pdf->SetFont('Arial', 'B', 10);
                    // $pdf->SetY(5);
                    // $pdf->Cell(0, 5, 'Stock Adjustment', 0, 0, 'C', 0);
                    $pdf->SetFont('Arial', 'BI', 10);

                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);
            
                    $file_name="Stock Adjustment";

                    include("rpt_header.php");
                

                    if($cancelled == '1') {
                        if(file_exists('../include/images/cancelled.jpg')) {
                            $pdf->SetAlpha(0.3);
                            $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                            $pdf->SetAlpha(1);
                        }
                    }

                    $bill_to_y = $pdf->GetY();
                    $party_y = $pdf->GetY();
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(80,8,'Stock Adjustment No   ',0,0,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(45);
                    $pdf->Cell(40,8,": ".$stock_adjustment_number,0,0,'L',0);

                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(110);
                    $pdf->Cell(20,8,'Date',0,0,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(122);
                    $pdf->Cell(40,8,": ".$stock_adjustment_date,0,1,'L',0);

                    $bill_to_y2 = $pdf->GetY();
                    $y_array = array($party_y,$bill_to_y2);
                    $max_bill_y = max($y_array);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(100,8,'',1,0,'L',0);
                    $pdf->SetX(110);
                    $pdf->Cell(90,8,'',1,1,'L',0);
                    $bill_to_y1 = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $bill_to_y2 = $pdf->GetY();
                    $y_array = array($bill_to_y1,$bill_to_y2);
                    $max_bill_y = max($y_array);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(100,($max_bill_y - $bill_to_y),'',1,0,'L',0);
                    $pdf->SetX(110);
                    $pdf->Cell(90,($max_bill_y - $bill_to_y),'',1,1,'L',0);

                    $header_height = $max_bill_y - 10;
                    if($header_height > 25){
                        // $height -= ($header_height - 45);
                    }
                    $address_height = $max_bill_y - $bill_to_y;


                    $starting_y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->SetFillColor(101,114,122);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetX(10);
                    $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
                    $pdf->Cell(60, 7, 'Location', 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, 'Reel Size', 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, 'GSM', 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, 'BF', 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, 'QTY (Nos)', 1, 0, 'C', 1);
                    $pdf->Cell(20, 7, 'Stock Type', 1, 1, 'C', 1);
                    $pdf->SetTextColor(0,0,0);
                    
                    
                    $pdf->SetFont('Arial', '', 8);
                    $product_y = $pdf->GetY();
                }

                
                if(!empty($godown_name[$p])){
                    $godown_name[$p] = trim($godown_name[$p]);
                }
                if(!empty($factory_name[$p])){
                    $factory_name[$p] = trim($factory_name[$p]);
                }
                $size_name[$p] = trim($size_name[$p]);
                $gsm_name[$p] = trim($gsm_name[$p]);
                $bf_name[$p] = trim($bf_name[$p]);
                $quantity[$p] = trim($quantity[$p]);
                $stock_type[$p] = trim($stock_type[$p]);
                
                $y = $pdf->GetY();
                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10, 6, $s_no, 0, 0, 'L', 0);

                $pdf->SetY($product_y);
                if(!empty($godown_name[$p])){
                    $pdf->SetX(20);
                    $pdf->MultiCell(60, 6, html_entity_decode($obj->encode_decode("decrypt", $godown_name[$p])), 0, 'L');
                }else if(!empty($factory_name[$p])){
                    $pdf->SetX(20);
                    $pdf->MultiCell(60, 6, html_entity_decode($obj->encode_decode("decrypt", $factory_name[$p])), 0, 'L');
                }else{
                    $pdf->SetX(20);
                    $pdf->MultiCell(60, 6,'', 0, 'L');
                }
                
                $name_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($size_name[$p])){
                    $pdf->SetX(80);
                    $pdf->MultiCell(25, 6,$obj->encode_decode('decrypt',$size_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(80);
                    $pdf->Cell(25, 6,' - ',0,0, 'L');
                }
                
                $qty_y = $pdf->GetY() - $product_y;
                
                $pdf->SetY($product_y);
                if(!empty($gsm_name[$p])){
                    $pdf->SetX(105);
                    $pdf->MultiCell(25, 6,$obj->encode_decode('decrypt', $gsm_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(105);
                    $pdf->MultiCell(25, 6,' - ', 0, 'C');
                }

                $unit_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($bf_name[$p])){
                    $pdf->SetX(130);
                    $pdf->MultiCell(25, 6,$obj->encode_decode('decrypt',$bf_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(130);
                    $pdf->Cell(25, 6,' - ',0, 0, 'C');
                }
                
                $contains_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($quantity[$p])){
                    $pdf->SetX(155);
                    $pdf->MultiCell(25, 6,$quantity[$p], 0, 'R');
                    $quantity_total = $total_quantity; 
                } else {
                    $pdf->SetX(155);
                    $pdf->Cell(25, 6,' - ',0, 0, 'C');
                }

                $pdf->SetY($product_y);
                if(!empty($stock_type[$p])){
                    $pdf->SetX(180);
                    $pdf->MultiCell(20, 6,$stock_type[$p], 0, 'C');
                    
                } else {
                    $pdf->SetX(180);
                    $pdf->Cell(20, 6,' - ',0, 0, 'C');
                }
                
                $total_qty_y = $pdf->GetY() - $product_y;

                $y_array = array($name_y, $contains_y,$unit_y, $total_qty_y, $qty_y);
                $product_max = max($y_array);

                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10,$product_max,'',1,0,'C');
                $pdf->SetX(20);
                $pdf->Cell(60,$product_max,'',1,0,'C');
                $pdf->SetX(80);
                $pdf->Cell(25,$product_max,'',1,0,'C');
                $pdf->SetX(105);
                $pdf->Cell(25,$product_max,'',1,0,'C');
                $pdf->SetX(130);
                $pdf->Cell(25,$product_max,'',1,0,'C');
                $pdf->SetX(155);
                $pdf->Cell(25,$product_max,'',1,0,'C');
                $pdf->SetX(180);
                $pdf->Cell(20,$product_max,'',1,1,'C');

                $product_y += $product_max;
                $s_no++;

            }

        }

        $end_y = $pdf->GetY();
        $last_page_count = $s_no - $last_count;

        if (($footer_height + $end_y) > 270) {
            $y = $pdf->GetY();
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
        
            $pdf->Cell(10, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(60, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 270 - $y_axis, '', 1, 1, 'C', 0);

            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-15);
            $pdf->SetX(10);
            $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);

            $pdf->SetTitle('Stock Adjustment');
            $pdf->SetFont('Arial', 'B', 10);
            // $pdf->SetY(5);
            // $pdf->Cell(0, 5, 'Stock Adjustment', 0, 0, 'C', 0);
            $pdf->SetFont('Arial', 'BI', 10);

            $y2 = $pdf->GetY();
            $y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetY(11);
            
            $file_name="Stock Adjustment";

            include("rpt_header.php");

            if($cancelled == '1') {
                if(file_exists('../include/images/cancelled.jpg')) {
                    $pdf->SetAlpha(0.3);
                    $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                    $pdf->SetAlpha(1);
                }
            }

            $bill_to_y = $pdf->GetY();
            $party_y = $pdf->GetY();
            $pdf->SetFont('Arial','B',9);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(80,8,'Stock Adjustment No   ',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(45);
            $pdf->Cell(40,8,": ".$stock_adjustment_number,0,0,'L',0);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(110);
            $pdf->Cell(20,8,'Date',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(122);
            $pdf->Cell(40,8,": ".$stock_adjustment_date,0,1,'L',0);

            $bill_to_y2 = $pdf->GetY();
            $y_array = array($party_y,$bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(100,8,'',1,0,'L',0);
            $pdf->SetX(110);
            $pdf->Cell(90,8,'',1,1,'L',0);
            $bill_to_y1 = $pdf->GetY();
            $pdf->SetY($bill_to_y);
            $bill_to_y2 = $pdf->GetY();
            $y_array = array($bill_to_y1,$bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(100,($max_bill_y - $bill_to_y),'',1,0,'L',0);
            $pdf->SetX(110);
            $pdf->Cell(90,($max_bill_y - $bill_to_y),'',1,1,'L',0);

            $header_height = $max_bill_y - 10;
            if($header_height > 25){
                // $height -= ($header_height - 45);
            }
            $address_height = $max_bill_y - $bill_to_y;

            $starting_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(101,114,122);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetX(10);
            $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
            $pdf->Cell(60, 7, 'Location', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Reel Size', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'GSM', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'BF', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'QTY (Nos)', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'Stock Type', 1, 1, 'C', 1);
            $pdf->SetTextColor(0,0,0);
            
            $pdf->SetFont('Arial', '', 8);

            $y_axis = $pdf->GetY();
            $content_height = 270 - $footer_height;

            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(60, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(20, $content_height - $y_axis, '', 1, 1);
        
            $pdf->SetY($content_height);
        }

        $max_page = max($total_pages);
        $pdf->SetY($y_axis);
        $pdf->SetX(10);

        $pdf->Cell(10, 206 + $height, '', 1, 0);
        $pdf->Cell(60, 206 + $height, '', 1, 0);
        $pdf->Cell(25, 206 + $height, '', 1, 0);
        $pdf->Cell(25, 206 + $height, '', 1, 0);
        $pdf->Cell(25, 206 + $height, '', 1, 0);
        $pdf->Cell(25, 206 + $height, '', 1, 0);
        $pdf->Cell(20, 206 + $height, '', 1, 1);
            
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(10);

        $pdf->Cell(145, 5, 'Total Qty', 1, 0, 'R', 0);
        $pdf->Cell(25, 5, $quantity_total." ", 1, 1, 'R', 0);

        $line_y = $pdf->GetY();
        $pdf->Line(10, $line_y, 200, $line_y);
        $pdf->SetFont('Arial', 'BU', 8);
        $pdf->SetX(10);

        $pdf->SetY($line_y);
        $pdf->SetX(155);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetY($line_y+2);
        $pdf->SetX(150);

        $pdf->MultiCell(45, 5,html_entity_decode($company_name), 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);

        $pdf->SetY($line_y+15);
        $pdf->SetX(155);
        $pdf->Cell(90, 5, 'Authorized Signatory', 0, 1, 'L', 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetY($line_y);
        $pdf->SetX(10);
        $pdf->MultiCell(140,5,'Remarks : '.$remarks,0,'L');

        $pdf->SetFont('Arial', '', 7);
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(190, 270, '', 1, 0, 'C');


        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-15);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

        $pdf->OutPut('', $stock_adjustment_number);
    }
