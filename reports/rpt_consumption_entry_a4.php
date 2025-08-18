<?php

    include("../include_user_check_and_files.php");
    include("../include/number2words.php");

    $view_consumption_entry_id = "";
    if (isset($_REQUEST['view_consumption_entry_id'])) {
        $view_consumption_entry_id = $_REQUEST['view_consumption_entry_id'];
    } else {
        header("Location: ../consumption_entry.php");
        exit;
    }
    
    if(isset($_REQUEST['view_consumption_entry_id'])) { 
        $view_consumption_entry_id = trim($_REQUEST['view_consumption_entry_id']);
        $consumption_entry_date = date('Y-m-d'); $consumption_entry_number = ""; $supplier_id = ""; $location_type = ""; $godown_type = "";$supplier_details ="";$product_count = 0; $godown_ids = array(); $factory_ids = array(); $size_ids = array(); $gsm_ids = array(); $godown_name = array(); $factory_name = array(); $size_name = array(); $gsm_name = array();$bf_name = array(); $quantity = array(); $selected_godown_id = ""; $selected_factory_id = "";$cancelled =0;
        $consumption_entry_list = array(); $godown_name_location = array();$remarks = "";
        $consumption_entry_list = $obj->getTableRecords($GLOBALS['consumption_entry_table'], 'consumption_entry_id', $view_consumption_entry_id);
        if(!empty($consumption_entry_list)) {
            foreach($consumption_entry_list as $data) {
                if(!empty($data['consumption_entry_date']) && $data['consumption_entry_date'] != "0000-00-00") {
                    $consumption_entry_date = date('d-m-Y', strtotime($data['consumption_entry_date']));
                }
                if(!empty($data['consumption_entry_number']) && $data['consumption_entry_number'] != $GLOBALS['null_value']) {
                    $consumption_entry_number = $data['consumption_entry_number'];
                }
               
                if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                    $selected_factory_id = $data['factory_id'];
                }
                if(!empty($data['factory_name']) && $data['factory_name'] != $GLOBALS['null_value']) {
                    $factory_name = html_entity_decode($obj->encode_decode('decrypt',$data['factory_name']));
                }
                if(!empty($data['godown_name']) && $data['godown_name'] != $GLOBALS['null_value']) {
                    $godown_name = html_entity_decode($obj->encode_decode('decrypt',$data['godown_name']));
                }
                if(!empty($data['godown_name_location']) && $data['godown_name_location'] != $GLOBALS['null_value']) {
                    $godown_name_location = html_entity_decode($obj->encode_decode('decrypt',$data['godown_name_location']));
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

        $factory_name_location = "";
        $factory_name_location = $obj->getTableColumnValue($GLOBALS['factory_table'],'factory_id',$selected_factory_id,'name_location');
        $factory_name_location = html_entity_decode($obj->encode_decode('decrypt',$factory_name_location));


        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Consumption Entry');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);

        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        $file_name="Consumption Entry";
        include("rpt_header.php");

        if($cancelled == '1') {
            if(file_exists('../include/images/cancelled.jpg')) {
                $pdf->SetAlpha(0.3);
                $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                $pdf->SetAlpha(1);
            }
        }

        $bill_to_y = $pdf->GetY();
        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(10);
        $pdf->Cell(0,1,'',0,1,'L',0);

        $pdf->SetX(10);
        $pdf->Cell(50,6,'Factory :  ',0,1,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(30);
        $pdf->MultiCell(75,6,$factory_name_location,0,'L',0);
        $party_y = $pdf->GetY();
        $pdf->SetFont('Arial','B',9);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(110);
        $pdf->Cell(80,8,'Consumption Entry No   ',0,0,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(145);
        $pdf->Cell(40,8,": ".$consumption_entry_number,0,1,'L',0);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(110);
        $pdf->Cell(20,8,'Date',0,0,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(145);
        $pdf->Cell(40,8,": ".$consumption_entry_date,0,1,'L',0);

        $bill_to_y2 = $pdf->GetY();
        $y_array = array($party_y,$bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(100,20,'',1,0,'L',0);
        $pdf->SetX(110);
        $pdf->Cell(90,20,'',1,1,'L',0);
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
        $pdf->Cell(45, 7, 'Reel Size', 1, 0, 'C', 1);
        $pdf->Cell(45, 7, 'GSM', 1, 0, 'C', 1);
        $pdf->Cell(45, 7, 'BF', 1, 0, 'C', 1);
        $pdf->Cell(45, 7, 'QTY (Nos)', 1, 1, 'C', 1);
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

        if (!empty($view_consumption_entry_id) && !empty($size_name)) {
            
            for ($p = 0; $p < count($size_name); $p++) {

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
                    $pdf->SetTitle('Consumption Entry');
                    $pdf->SetFont('Arial', 'B', 10);
                    // $pdf->SetY(5);
                    // $pdf->Cell(0, 5, 'Consumption Entry', 0, 0, 'C', 0);
                    $pdf->SetFont('Arial', 'BI', 10);

                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);
            
                    $file_name="Consumption Entry";

                    include("rpt_header.php");
                

                    if($cancelled == '1') {
                        if(file_exists('../include/images/cancelled.jpg')) {
                            $pdf->SetAlpha(0.3);
                            $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                            $pdf->SetAlpha(1);
                        }
                    }

                    $bill_to_y = $pdf->GetY();
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(10);
                    $pdf->Cell(0,1,'',0,1,'L',0);

                    $pdf->SetX(10);
                    $pdf->Cell(50,6,'Factory :  ',0,1,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(30);
                    $pdf->MultiCell(75,6,$factory_name_location,0,'L',0);
                    $party_y = $pdf->GetY();
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(110);
                    $pdf->Cell(80,8,'Consumption Entry No   ',0,0,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(145);
                    $pdf->Cell(40,8,": ".$consumption_entry_number,0,1,'L',0);

                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(110);
                    $pdf->Cell(20,8,'Date',0,0,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(145);
                    $pdf->Cell(40,8,": ".$consumption_entry_date,0,1,'L',0);

                    $bill_to_y2 = $pdf->GetY();
                    $y_array = array($party_y,$bill_to_y2);
                    $max_bill_y = max($y_array);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(100,20,'',1,0,'L',0);
                    $pdf->SetX(110);
                    $pdf->Cell(90,20,'',1,1,'L',0);
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
                    $pdf->Cell(45, 7, 'Reel Size', 1, 0, 'C', 1);
                    $pdf->Cell(45, 7, 'GSM', 1, 0, 'C', 1);
                    $pdf->Cell(45, 7, 'BF', 1, 0, 'C', 1);
                    $pdf->Cell(45, 7, 'QTY (Nos)', 1, 1, 'C', 1);
                    $pdf->SetTextColor(0,0,0);
                    
                    
                    $pdf->SetFont('Arial', '', 8);
                    $product_y = $pdf->GetY();
                }

                $size_name[$p] = trim($size_name[$p]);
                $gsm_name[$p] = trim($gsm_name[$p]);
                $bf_name[$p] = trim($bf_name[$p]);
                $quantity[$p] = trim($quantity[$p]);
                
            
                $y = $pdf->GetY();
                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10, 6, $s_no, 0, 0, 'L', 0);
                $name_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($size_name[$p])){
                    $pdf->SetX(20);
                    $pdf->MultiCell(45, 6,$obj->encode_decode('decrypt',$size_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(20);
                    $pdf->Cell(45, 6,' - ',0,0, 'L');
                }
                
                $qty_y = $pdf->GetY() - $product_y;
                
                $pdf->SetY($product_y);
                if(!empty($gsm_name[$p])){
                    $pdf->SetX(65);
                    $pdf->MultiCell(45, 6,$obj->encode_decode('decrypt', $gsm_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(65);
                    $pdf->MultiCell(45, 6,' - ', 0, 'C');
                }

                $unit_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($bf_name[$p])){
                    $pdf->SetX(110);
                    $pdf->MultiCell(45, 6,$obj->encode_decode('decrypt',$bf_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(110);
                    $pdf->Cell(45, 6,' - ',0, 0, 'C');
                }
                
                $contains_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($quantity[$p])){
                    $pdf->SetX(155);
                    $pdf->MultiCell(45, 6,$quantity[$p], 0, 'R');
                    $quantity_total = $total_quantity; 
                } else {
                    $pdf->SetX(155);
                    $pdf->Cell(45, 6,' - ',0, 0, 'C');
                }
                
                $total_qty_y = $pdf->GetY() - $product_y;

                $y_array = array($name_y, $contains_y,$unit_y, $total_qty_y, $qty_y);
                $product_max = max($y_array);

                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10,$product_max,'',1,0,'C');
                $pdf->SetX(20);
                $pdf->Cell(45,$product_max,'',1,0,'C');
                $pdf->SetX(65);
                $pdf->Cell(45,$product_max,'',1,0,'C');
                $pdf->SetX(110);
                $pdf->Cell(45,$product_max,'',1,0,'C');
                $pdf->SetX(155);
                $pdf->Cell(45,$product_max,'',1,1,'C');

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
            $pdf->Cell(45, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(45, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(45, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(45, 270 - $y_axis, '', 1, 1, 'C', 0);

            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-15);
            $pdf->SetX(10);
            $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);

            $pdf->SetTitle('Consumption Entry');
            $pdf->SetFont('Arial', 'B', 10);
            // $pdf->SetY(5);
            // $pdf->Cell(0, 5, 'Consumption Entry', 0, 0, 'C', 0);
            $pdf->SetFont('Arial', 'BI', 10);



            $y2 = $pdf->GetY();
            $y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetY(11);
            
            $file_name="Consumption Entry";

            include("rpt_header.php");

            if($cancelled == '1') {
                if(file_exists('../include/images/cancelled.jpg')) {
                    $pdf->SetAlpha(0.3);
                    $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                    $pdf->SetAlpha(1);
                }
            }

            $bill_to_y = $pdf->GetY();
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(0,1,'',0,1,'L',0);

            $pdf->SetX(10);
            $pdf->Cell(50,6,'Factory :  ',0,1,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(30);
            $pdf->MultiCell(75,6,$factory_name_location,0,'L',0);
            $party_y = $pdf->GetY();
            $pdf->SetFont('Arial','B',9);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(110);
            $pdf->Cell(80,8,'Consumption Entry No   ',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(145);
            $pdf->Cell(40,8,": ".$consumption_entry_number,0,1,'L',0);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(110);
            $pdf->Cell(20,8,'Date',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(145);
            $pdf->Cell(40,8,": ".$consumption_entry_date,0,1,'L',0);

            $bill_to_y2 = $pdf->GetY();
            $y_array = array($party_y,$bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(100,20,'',1,0,'L',0);
            $pdf->SetX(110);
            $pdf->Cell(90,20,'',1,1,'L',0);
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
            $pdf->Cell(45, 7, 'Reel Size', 1, 0, 'C', 1);
            $pdf->Cell(45, 7, 'GSM', 1, 0, 'C', 1);
            $pdf->Cell(45, 7, 'BF', 1, 0, 'C', 1);
            $pdf->Cell(45, 7, 'QTY (Nos)', 1, 1, 'C', 1);
            $pdf->SetTextColor(0,0,0);
            
            $pdf->SetFont('Arial', '', 8);

            $y_axis = $pdf->GetY();
            $content_height = 270 - $footer_height;

            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(45, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(45, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(45, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(45, $content_height - $y_axis, '', 1, 1);
        
            $pdf->SetY($content_height);
        }

        $max_page = max($total_pages);
        $pdf->SetY($y_axis);
        $pdf->SetX(10);

        $pdf->Cell(10, 190 + $height, '', 1, 0);
        $pdf->Cell(45, 190 + $height, '', 1, 0);
        $pdf->Cell(45, 190 + $height, '', 1, 0);
        $pdf->Cell(45, 190 + $height, '', 1, 0);
        $pdf->Cell(45, 190 + $height, '', 1, 1);
            
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(10);

        $pdf->Cell(145, 5, 'Total Qty', 1, 0, 'R', 0);
        $pdf->Cell(45, 5, $quantity_total." ", 1, 1, 'R', 0);

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

        $pdf->SetY($line_y+20);
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

        $pdf->OutPut('', $consumption_entry_number);
    }
