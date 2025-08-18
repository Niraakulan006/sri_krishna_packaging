<?php
    include("../include_user_check_and_files.php");
    include("../include/number2words.php");

    $view_inward_material_id = "";
    if (isset($_REQUEST['view_inward_material_id'])) {
        $view_inward_material_id = $_REQUEST['view_inward_material_id'];
    } else {
        header("Location: ../inward_material.php");
        exit;
    }
    
    if(isset($_REQUEST['view_inward_material_id'])) { 
        $view_inward_material_id = trim($_REQUEST['view_inward_material_id']);
        $bill_date = date('Y-m-d'); $bill_number = ""; $supplier_id = ""; $location_type = ""; $godown_type = "";$supplier_details ="";$product_count = 0; $godown_ids = array(); $factory_ids = array(); $size_ids = array(); $gsm_ids = array(); $godown_name = array(); $factory_name = array(); $size_name = array(); $gsm_name = array();$bf_name = array(); $quantity = array(); $selected_godown_id = ""; $selected_factory_id = "";$cancelled =0;
        $inward_material_list = array();
        $inward_material_list = $obj->getTableRecords($GLOBALS['inward_material_table'], 'inward_material_id', $view_inward_material_id);
        if(!empty($inward_material_list)) {
            foreach($inward_material_list as $data) {
                if(!empty($data['bill_date']) && $data['bill_date'] != "0000-00-00") {
                    $bill_date = date('d-m-Y', strtotime($data['bill_date']));
                }
                if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']) {
                    $bill_number = $obj->encode_decode('decrypt', $data['bill_number']);
                }
                if(!empty($data['supplier_id']) && $data['supplier_id'] != $GLOBALS['null_value']) {
                    $supplier_id = $data['supplier_id'];
                }
                if(!empty($data['supplier_details']) && $data['supplier_details'] != $GLOBALS['null_value']) {
                    $supplier_details = $obj->encode_decode('decrypt', $data['supplier_details']);
                    $supplier_details = explode("$$$", $supplier_details);
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
                if(!empty($data['cancelled']) && $data['cancelled'] != $GLOBALS['null_value']) {
                    $cancelled =$data['cancelled'];
                }
                if(!empty($data['total_quantity']) && $data['total_quantity'] != $GLOBALS['null_value']) {
                    $total_quantity = $data['total_quantity'];
                }
            }
        }

        $company_name = "";
        $company_name = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_factory', '1', 'factory_name');
        if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
            $company_name = $obj->encode_decode('decrypt', $company_name);
        }

        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P', 'mm', 'A5');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Inward Materials');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);
        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        $file_name="Inward Materials";
        $pdf->SetTitle($file_name);
        $pdf->SetFont('Arial','B',9);

        $company_list = array(); $company_details = "";
        $company_list = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_factory', '1', 'factory_details');
        if(!empty($company_list)){
            $company_details =html_entity_decode($obj->encode_decode('decrypt',$company_list));
            $company_details = html_entity_decode($company_details);
            $company_details = explode("$$$", $company_details);
        }

        $bill_company_id = $GLOBALS['bill_company_id'];
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,$file_name,1,1,'C',0);
        $y = $pdf->GetY(); 
        $pdf->SetFont('Arial','B',8);
    
        $pdf->SetY($y);
        $pdf->SetX(50);

        if (!empty($company_details)) {
            for ($i = 0; $i < count($company_details); $i++) {
                $company_details[$i] = trim($company_details[$i]);
                if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                    
                    $company_details[$i] = str_replace("<br>"," ",$company_details[$i]);
                    if ($i === 0) {  // Corrected comparison
                        $pdf->SetFont('Arial', 'B', 11);
                        $pdf->MultiCell(50, 7, html_entity_decode($company_details[$i]), 0, 'C');
                        $rt = $pdf->gety();
                    } elseif (strpos($company_details[$i], "GST") !== false) {
                        $pdf->sety($y);
                        $pdf->setx(104);
                        $pdf->SetFont('Arial', 'B', 8);
                        $pdf->Cell(35, 5, html_entity_decode($company_details[$i]), 0, 1, 'R', 0);
                    } else {
                        $pdf->SetFont('Arial', '', 8);
                        // $pdf->sety($rt);
                        $pdf->SetX(50);
                        $pdf->MultiCell(50, 4, html_entity_decode($company_details[$i]), 0, 'C');
                        $end_y =$pdf->GetY();
                    }
                }
            }
        }
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(0,($end_y - 10),'',1,1,'C');
        $header_end = $pdf->GetY();
        $pdf->SetY($header_end);
        
        if($cancelled == '1') {
            if(file_exists('../include/images/cancelled.jpg')) {
                $pdf->SetAlpha(0.3);
                $pdf->Image('../include/images/cancelled.jpg',45,85,55,55);
                $pdf->SetAlpha(1);
            }
        }
        $bill_to_y = $pdf->GetY();
        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(10);
        $pdf->Cell(0,1,'',0,1,'L',0);
        $pdf->Cell(63,4,'Supplier : ',0,1,'L',0);
        $pdf->Cell(0,1,'',0,1,'L',0);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(12);
        for($i=0;$i<count($supplier_details);$i++)
        {
            if($supplier_details[$i]!="NULL" && $supplier_details[$i]!="")
            {
                $pdf->SetFont('Arial','',9);
                $pdf->SetX(15);
                if($i==0)
                {
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(65,4,html_entity_decode($supplier_details[$i]),0,1,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                }
                else{
                    $supplier_details[$i] = trim($supplier_details[$i]);
                    $pdf->MultiCell(65,4,html_entity_decode($supplier_details[$i]),0,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                }
            }
        }

        $party_y = $pdf->GetY();
        $pdf->SetFont('Arial','B',9);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(80);
        $pdf->Cell(80,8,'Inward Material No   ',0,0,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(110);
        $pdf->Cell(40,8,": ".$bill_number,0,1,'L',0);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(80);
        $pdf->Cell(20,8,'Date',0,0,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(110);
        $pdf->Cell(40,8,": ".$bill_date,0,1,'L',0);

        $bill_to_y2 = $pdf->GetY();
        $y_array = array($party_y,$bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(70,30,'',1,0,'L',0);
        $pdf->SetX(80);
        $pdf->Cell(58.5,30,'',1,1,'L',0);
        $bill_to_y1 = $pdf->GetY();
        $pdf->SetY($bill_to_y);
        $bill_to_y2 = $pdf->GetY();
        $y_array = array($bill_to_y1,$bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(70,($max_bill_y - $bill_to_y),'',1,1,'L',0);
        // $pdf->SetX(80);
        // $pdf->Cell(70,($max_bill_y - $bill_to_y),'',1,1,'L',0);

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
        $pdf->Cell(35, 7, 'Location', 1, 0, 'C', 1);
        $pdf->Cell(15, 7, 'Reel Size', 1, 0, 'C', 1);
        $pdf->Cell(20, 7, 'GSM', 1, 0, 'C', 1);
        $pdf->Cell(20, 7, 'BF', 1, 0, 'C', 1);
        $pdf->Cell(0, 7, 'Qty (Nos)', 1, 1, 'C', 1);
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

        if (!empty($view_inward_material_id) && !empty($godown_ids)) {
            for ($p = 0; $p < count($godown_ids); $p++) {
                if ($pdf->GetY() >= 195) {
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 9);
                    $next_page = $pdf->PageNo() + 1;
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(203);
                    $pdf->SetX(10);
                    $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                    $page_number += 1;
                    $total_pages[] = $page_number;
                    $last_count = $p + 1;
                    $pdf->SetTitle('Inward Material');
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetFont('Arial', 'BI', 10);
                    $height = 0;
                    $display = '';
                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);

                    $file_name="Inward Material";
                    $pdf->SetTitle($file_name);
                    $pdf->SetFont('Arial','B',9);

                    $company_list = array(); $company_details = "";
                    $company_list = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_factory', '1', 'factory_details');
                    if(!empty($company_list)){
                        $company_details =html_entity_decode($obj->encode_decode('decrypt',$company_list));
                        $company_details = html_entity_decode($company_details);
                        $company_details = explode("$$$", $company_details);
                    }

                    $bill_company_id = $GLOBALS['bill_company_id'];
                    $pdf->SetY(10);
                    $pdf->SetX(10);
                    $pdf->SetFont('Arial','B',10);

                    $pdf->Cell(0,7,$file_name,1,1,'C',0);
                    $y = $pdf->GetY(); 
                    $pdf->SetFont('Arial','B',8);
                    
                    $pdf->SetY($y);
                    $pdf->SetX(50);
                    if (!empty($company_details)) {
                        for ($i = 0; $i < count($company_details); $i++) {
                            $company_details[$i] = trim($company_details[$i]);
                            if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                                
                                $company_details[$i] = str_replace("<br>"," ",$company_details[$i]);
                                if ($i === 0) {  // Corrected comparison
                                    $pdf->SetFont('Arial', 'B', 11);
                                    $pdf->MultiCell(50, 7, html_entity_decode($company_details[$i]), 0, 'C');
                                    $rt = $pdf->gety();
                                } elseif (strpos($company_details[$i], "GST") !== false) {
                                    $pdf->sety($y);
                                    $pdf->setx(104);
                                    $pdf->SetFont('Arial', 'B', 8);
                                    $pdf->Cell(35, 5, html_entity_decode($company_details[$i]), 0, 1, 'R', 0);
                                } else {
                                    $pdf->SetFont('Arial', '', 8);
                                    // $pdf->sety($rt);
                                    $pdf->SetX(50);
                                    $pdf->MultiCell(50, 4, html_entity_decode($company_details[$i]), 0, 'C');
                                    $end_y =$pdf->GetY();
                                }
                            }
                        }
                    }
                    $pdf->SetY(10);
                    $pdf->SetX(10);
                    $pdf->Cell(0,($end_y - 10),'',1,1,'C');
                    $header_end = $pdf->GetY();
                    $pdf->SetY($header_end);
                    
                    if($cancelled == '1') {
                        if(file_exists('../include/images/cancelled.jpg')) {
                            $pdf->SetAlpha(0.3);
                            $pdf->Image('../include/images/cancelled.jpg',45,85,55,55);
                            $pdf->SetAlpha(1);
                        }
                    }
                    $bill_to_y = $pdf->GetY();
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(10);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                    $pdf->Cell(63,4,'Supplier : ',0,1,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetX(12);
                    for($i=0;$i<count($supplier_details);$i++)
                    {
                        if($supplier_details[$i]!="NULL" && $supplier_details[$i]!="")
                        {
                            $pdf->SetFont('Arial','',9);
                            $pdf->SetX(15);
                            if($i==0)
                            {
                                $pdf->SetFont('Arial','B',9);
                                $pdf->Cell(65,4,html_entity_decode($supplier_details[$i]),0,1,'L',0);
                                $pdf->Cell(0,1,'',0,1,'L',0);
                            }
                            else{
                                $supplier_details[$i] = trim($supplier_details[$i]);
                                $pdf->MultiCell(65,4,html_entity_decode($supplier_details[$i]),0,'L',0);
                                $pdf->Cell(0,1,'',0,1,'L',0);
                            }
                        }
                    }

                    $party_y = $pdf->GetY();
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(80);
                    $pdf->Cell(80,8,'Inward Material No   ',0,0,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(110);
                    $pdf->Cell(40,8,": ".$bill_number,0,1,'L',0);

                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(80);
                    $pdf->Cell(20,8,'Date',0,0,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(110);
                    $pdf->Cell(40,8,": ".$bill_date,0,1,'L',0);

                    $bill_to_y2 = $pdf->GetY();
                    $y_array = array($party_y,$bill_to_y2);
                    $max_bill_y = max($y_array);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(70,30,'',1,0,'L',0);
                    $pdf->SetX(80);
                    $pdf->Cell(58.5,30,'',1,1,'L',0);
                    $bill_to_y1 = $pdf->GetY();
                    $pdf->SetY($bill_to_y);
                    $bill_to_y2 = $pdf->GetY();
                    $y_array = array($bill_to_y1,$bill_to_y2);
                    $max_bill_y = max($y_array);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(70,($max_bill_y - $bill_to_y),'',1,1,'L',0);
                    // $pdf->SetX(80);
                    // $pdf->Cell(70,($max_bill_y - $bill_to_y),'',1,1,'L',0);

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
                    $pdf->Cell(35, 7, 'Location', 1, 0, 'C', 1);
                    $pdf->Cell(15, 7, 'Reel Size', 1, 0, 'C', 1);
                    $pdf->Cell(20, 7, 'GSM', 1, 0, 'C', 1);
                    $pdf->Cell(20, 7, 'BF', 1, 0, 'C', 1);
                    $pdf->Cell(0, 7, 'Qty (Nos)', 1, 1, 'C', 1);
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
            
                $y = $pdf->GetY();
                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10, 6, $s_no, 0, 0, 'L', 0);

                $pdf->SetY($product_y);
                if(!empty($godown_name[$p])){
                    $pdf->SetX(20);
                    $pdf->MultiCell(35, 6, html_entity_decode($obj->encode_decode("decrypt", $godown_name[$p])), 0, 'L');
                }else if(!empty($factory_name[$p])){
                    $pdf->SetX(20);
                    $pdf->MultiCell(35, 6, html_entity_decode($obj->encode_decode("decrypt", $factory_name[$p])), 0, 'L');
                } else {
                    $pdf->SetX(20);
                    $pdf->Cell(60, 6,' - ',0,0, 'C');
                }
            
                $name_y = $pdf->GetY() - $product_y;
                $pdf->SetY($product_y);
                if(!empty($size_name[$p])){
                    $pdf->SetX(55);
                    $pdf->MultiCell(15, 6,$obj->encode_decode('decrypt',$size_name[$p]), 0, 'R');
                } else {
                    $pdf->SetX(55);
                    $pdf->Cell(15, 6,' - ',0,0, 'C');
                }
                
                $qty_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($gsm_name[$p])){
                    $pdf->SetX(70);
                    $pdf->MultiCell(20, 6,$obj->encode_decode('decrypt', $gsm_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(70);
                    $pdf->MultiCell(20, 6,' - ', 0, 'C');
                }

                $unit_y = $pdf->GetY() - $product_y;
                $pdf->SetY($product_y);
                if(!empty($bf_name[$p])){
                    $pdf->SetX(90);
                    $pdf->MultiCell(20, 6,$obj->encode_decode('decrypt',$bf_name[$p]), 0, 'R');
                } else {
                    $pdf->SetX(90);
                    $pdf->Cell(20, 6,' - ',0, 0, 'C');
                }
                
                $contains_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($quantity[$p])){
                    $pdf->SetX(117);
                    $pdf->MultiCell(20, 6,$quantity[$p], 0, 'R');
                    $quantity_total = $total_quantity; 
                } else {
                    $pdf->SetX(117);
                    $pdf->Cell(20, 6,' - ',0, 0, 'C');
                }
                $total_qty_y = $pdf->GetY() - $product_y;

                $y_array = array($name_y, $contains_y,$unit_y, $total_qty_y, $qty_y);
                $product_max = max($y_array);

                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10,$product_max,'',1,0,'C');
                $pdf->SetX(20);
                $pdf->Cell(35,$product_max,'',1,0,'C');
                $pdf->SetX(55);
                $pdf->Cell(15,$product_max,'',1,0,'C');
                $pdf->SetX(70);
                $pdf->Cell(20,$product_max,'',1,0,'C');
                $pdf->SetX(90);
                $pdf->Cell(20,$product_max,'',1,0,'C');
                $pdf->SetX(110);
                $pdf->Cell(0,$product_max,'',1,1,'C');

                $product_y += $product_max;
                $s_no++;
            }

        }

        $end_y = $pdf->GetY();
        $last_page_count = $s_no - $last_count;

        if (($footer_height + $end_y) > 195) {
            $y = $pdf->GetY();
            $pdf->SetY($y_axis);
            $pdf->SetX(10);
        
            $pdf->Cell(10, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(35, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(15, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(0, 190 - $y_axis, '', 1, 1, 'C', 0);

            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(203);
            $pdf->SetX(10);
            $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);

            $pdf->SetTitle('Inward Material');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFont('Arial', 'BI', 10);
            $height = 0;
            $display = '';
            $y2 = $pdf->GetY();
            $y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetY(11);
            $file_name="Inward Material";
            $pdf->SetTitle($file_name);
            $pdf->SetFont('Arial','B',9);

            $company_list = array(); $company_details = "";
            $company_list = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_factory', '1', 'factory_details');
            if(!empty($company_list)){
                $company_details =html_entity_decode($obj->encode_decode('decrypt',$company_list));
                $company_details = html_entity_decode($company_details);
                $company_details = explode("$$$", $company_details);
            }

            $bill_company_id = $GLOBALS['bill_company_id'];
            $pdf->SetY(10);
            $pdf->SetX(10);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,7,$file_name,1,1,'C',0);
            $y = $pdf->GetY(); 
            $pdf->SetFont('Arial','B',8);
            
            $pdf->SetY($y);
            $pdf->SetX(50);

            if (!empty($company_details)) {
                for ($i = 0; $i < count($company_details); $i++) {
                    $company_details[$i] = trim($company_details[$i]);
                    if (!empty($company_details[$i]) && $company_details[$i] != $GLOBALS['null_value']) {
                        
                        $company_details[$i] = str_replace("<br>"," ",$company_details[$i]);
                        if ($i === 0) {  // Corrected comparison
                            $pdf->SetFont('Arial', 'B', 11);
                            $pdf->MultiCell(50, 7, html_entity_decode($company_details[$i]), 0, 'C');
                            $rt = $pdf->gety();
                        } elseif (strpos($company_details[$i], "GST") !== false) {
                            $pdf->sety($y);
                            $pdf->setx(104);
                            $pdf->SetFont('Arial', 'B', 8);
                            $pdf->Cell(35, 5, html_entity_decode($company_details[$i]), 0, 1, 'R', 0);
                        } else {
                            $pdf->SetFont('Arial', '', 8);
                            // $pdf->sety($rt);
                            $pdf->SetX(50);
                            $pdf->MultiCell(50, 4, html_entity_decode($company_details[$i]), 0, 'C');
                            $end_y =$pdf->GetY();
                        }
                    }
                }
            }
            $pdf->SetY(10);
            $pdf->SetX(10);
            $pdf->Cell(0,($end_y - 10),'',1,1,'C');
            $header_end = $pdf->GetY();
            $pdf->SetY($header_end);
            
            if($cancelled == '1') {
                if(file_exists('../include/images/cancelled.jpg')) {
                    $pdf->SetAlpha(0.3);
                    $pdf->Image('../include/images/cancelled.jpg',45,85,55,55);
                    $pdf->SetAlpha(1);
                }
            }
            $bill_to_y = $pdf->GetY();
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(0,1,'',0,1,'L',0);
            $pdf->Cell(63,4,'Supplier : ',0,1,'L',0);
            $pdf->Cell(0,1,'',0,1,'L',0);
            $pdf->SetFont('Arial','B',10);
            $pdf->SetX(12);
            for($i=0;$i<count($supplier_details);$i++)
            {
                if($supplier_details[$i]!="NULL" && $supplier_details[$i]!="")
                {
                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(15);
                    if($i==0)
                    {
                        $pdf->SetFont('Arial','B',9);
                        $pdf->Cell(65,4,html_entity_decode($supplier_details[$i]),0,1,'L',0);
                        $pdf->Cell(0,1,'',0,1,'L',0);
                    }
                    else{
                        $supplier_details[$i] = trim($supplier_details[$i]);
                        $pdf->MultiCell(65,4,html_entity_decode($supplier_details[$i]),0,'L',0);
                        $pdf->Cell(0,1,'',0,1,'L',0);
                    }
                }
            }

            $party_y = $pdf->GetY();
            $pdf->SetFont('Arial','B',9);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(80);
            $pdf->Cell(80,8,'Inward Material No   ',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(110);
            $pdf->Cell(40,8,": ".$bill_number,0,1,'L',0);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(80);
            $pdf->Cell(20,8,'Date',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(110);
            $pdf->Cell(40,8,": ".$bill_date,0,1,'L',0);

            $bill_to_y2 = $pdf->GetY();
            $y_array = array($party_y,$bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(70,30,'',1,0,'L',0);
            $pdf->SetX(80);
            $pdf->Cell(58.5,30,'',1,1,'L',0);
            $bill_to_y1 = $pdf->GetY();
            $pdf->SetY($bill_to_y);
            $bill_to_y2 = $pdf->GetY();
            $y_array = array($bill_to_y1,$bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(70,($max_bill_y - $bill_to_y),'',1,1,'L',0);
            // $pdf->SetX(80);
            // $pdf->Cell(70,($max_bill_y - $bill_to_y),'',1,1,'L',0);

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
            $pdf->Cell(35, 7, 'Location', 1, 0, 'C', 1);
            $pdf->Cell(15, 7, 'Reel Size', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'GSM', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'BF', 1, 0, 'C', 1);
            $pdf->Cell(0, 7, 'Qty (Nos)', 1, 1, 'C', 1);
            $pdf->SetTextColor(0,0,0);
            
            $pdf->SetFont('Arial', '', 8);

            $y_axis = $pdf->GetY();
            $content_height = 185 - $footer_height;

            $pdf->SetY($y_axis);
            $pdf->SetX(10);
            $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(35, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(15, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
            $pdf->Cell(0, $content_height - $y_axis, '', 1, 1);
        
            $pdf->SetY($content_height);
        }

        $max_page = max($total_pages);
        $pdf->SetY($y_axis);
        $pdf->SetX(10);

        $pdf->Cell(10, 100 + $height, '', 1, 0);
        $pdf->Cell(35, 100 + $height, '', 1, 0);
        $pdf->Cell(15, 100 + $height, '', 1, 0);
        $pdf->Cell(20, 100 + $height, '', 1, 0);
        $pdf->Cell(20, 100 + $height, '', 1, 0);
        $pdf->Cell(0, 100 + $height, '', 1, 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(10);
        $pdf->Cell(100, 5, 'Total Qty', 1, 0, 'R', 0);
        $pdf->Cell(0, 5, $quantity_total." ", 1, 1, 'R', 0);

        $line_y = $pdf->GetY();

        $pdf->SetFont('Arial', 'BU', 8);
        $pdf->SetX(10);
        $pdf->SetY($line_y);
        $pdf->SetX(30);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetY($line_y+2);
        $pdf->SetX(95);
        $pdf->MultiCell(40, 5,html_entity_decode($company_name), 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);

        $pdf->SetY($line_y+19);
        $pdf->SetX(100);
        $pdf->Cell(60, 5, 'Authorized Signatory', 0, 1, 'L', 0);

        $pdf->SetFont('Arial', '', 7);
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(0, 190, '', 1, 0, 'C');

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(203);
        $pdf->SetX(10);
        $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
        $pdf->OutPut('', $bill_number);

    }
?>