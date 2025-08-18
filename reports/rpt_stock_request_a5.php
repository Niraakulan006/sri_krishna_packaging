<?php
    include("../include_user_check_and_files.php");
    include("../include/number2words.php");

    $view_stock_request_id = "";
    if (isset($_REQUEST['view_stock_request_id'])) {
        $view_stock_request_id = $_REQUEST['view_stock_request_id'];
    } else {
        header("Location: ../stock_request_php");
        exit;
    }
    
    if(isset($_REQUEST['view_stock_request_id'])) { 
        $view_stock_request_id = trim($_REQUEST['view_stock_request_id']);
        $bill_date = date('Y-m-d'); $stock_request_number = ""; $supplier_id = ""; $location_type = ""; $godown_type = "";$supplier_details ="";$product_count = 0; $godown_ids = array(); $factory_ids = array(); $size_ids = array(); $gsm_ids = array(); $godown_name = array(); $factory_name = array(); $size_name = array(); $gsm_name = array();$bf_name = array(); $quantity = array(); $selected_godown_id = ""; $selected_factory_id = "";$cancelled =0;$remarks = "";
        $stock_request_list = array(); $godown_name_location = array();
        $stock_request_list = $obj->getTableRecords($GLOBALS['stock_request_table'], 'stock_request_id', $view_stock_request_id);
        if(!empty($stock_request_list)) {
            foreach($stock_request_list as $data) {
                if(!empty($data['bill_date']) && $data['bill_date'] != "0000-00-00") {
                    $bill_date = date('d-m-Y', strtotime($data['bill_date']));
                }
                if(!empty($data['stock_request_number']) && $data['stock_request_number'] != $GLOBALS['null_value']) {
                    $stock_request_number = $data['stock_request_number'];
                }
                if(!empty($data['godown_type']) && $data['godown_type'] != $GLOBALS['null_value']) {
                    $godown_type = $data['godown_type'];
                }
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $selected_godown_id = $data['godown_id'];
                    
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
                    $remarks = $obj->encode_decode('decrypt',$data['remarks']);
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
        $pdf->SetTitle('Stock Request');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);
        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        $file_name="Stock Request";
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
        $pdf->Cell(63,4,'Godown : ',0,1,'L',0);
        $pdf->Cell(0,1,'',0,1,'L',0);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(12);
        
        $pdf->SetFont('Arial','',9);
        $pdf->SetX(20);
        $pdf->MultiCell(50,4,html_entity_decode($godown_name_location),0,'L',0);
        $pdf->Cell(0,1,'',0,1,'L',0);
            
        $party_y = $pdf->GetY();
        $pdf->SetFont('Arial','B',9);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(80);
        $pdf->Cell(80,8,'Stock Request No   ',0,0,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(110);
        $pdf->Cell(40,8,": ".$stock_request_number,0,1,'L',0);

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
        $pdf->Cell(70,20,'',1,0,'L',0);
        $pdf->SetX(80);
        $pdf->Cell(58.5,20,'',1,1,'L',0);
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
        $pdf->Cell(30, 7, 'Reel Size', 1, 0, 'C', 1);
        $pdf->Cell(30, 7, 'GSM', 1, 0, 'C', 1);
        $pdf->Cell(30, 7, 'BF', 1, 0, 'C', 1);
        $pdf->Cell(28.5, 7, 'Qty (Nos)', 1, 1, 'C', 1);
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
    
        if (!empty($view_stock_request_id) && !empty($size_name)) {
            for ($p = 0; $p < count($size_name); $p++) {
                if ($pdf->GetY() >= 187) {
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
                    $pdf->SetTitle('Stock Request');
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetFont('Arial', 'BI', 10);
                    $height = 0;
                    $display = '';
                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);

                    $file_name="Stock Request";
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
                    $pdf->Cell(63,4,'Godown : ',0,1,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetX(12);
                    
                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(20);
                    $pdf->MultiCell(50,4,html_entity_decode($godown_name_location),0,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                        
                    $party_y = $pdf->GetY();
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(80);
                    $pdf->Cell(80,8,'Stock Request No   ',0,0,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(110);
                    $pdf->Cell(40,8,": ".$stock_request_number,0,1,'L',0);

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
                    $pdf->Cell(70,20,'',1,0,'L',0);
                    $pdf->SetX(80);
                    $pdf->Cell(58.5,20,'',1,1,'L',0);
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
                    $pdf->Cell(30, 7, 'Reel Size', 1, 0, 'C', 1);
                    $pdf->Cell(30, 7, 'GSM', 1, 0, 'C', 1);
                    $pdf->Cell(30, 7, 'BF', 1, 0, 'C', 1);
                    $pdf->Cell(28.5, 7, 'Qty (Nos)', 1, 1, 'C', 1);
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

                $pdf->SetY($product_y);            
                $name_y = $pdf->GetY() - $product_y;
                $pdf->SetY($product_y);
                if(!empty($size_name[$p])){
                    $pdf->SetX(20);
                    $pdf->MultiCell(30, 6,$obj->encode_decode('decrypt',$size_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(20);
                    $pdf->Cell(30, 6,' - ',0,0, 'C');
                }
                
                $qty_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($gsm_name[$p])){
                    $pdf->SetX(50);
                    $pdf->MultiCell(30, 6,$obj->encode_decode('decrypt', $gsm_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(50);
                    $pdf->MultiCell(30, 6,' - ', 0, 'C');
                }

                $unit_y = $pdf->GetY() - $product_y;
                $pdf->SetY($product_y);
                if(!empty($bf_name[$p])){
                    $pdf->SetX(80);
                    $pdf->MultiCell(30, 6,$obj->encode_decode('decrypt',$bf_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(80);
                    $pdf->Cell(30, 6,' - ',0, 0, 'C');
                }
                
                $contains_y = $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($quantity[$p])){
                    $pdf->SetX(110);
                    $pdf->MultiCell(28.5, 6,$quantity[$p], 0, 'R');
                    $quantity_total = $total_quantity; 
                } else {
                    $pdf->SetX(110);
                    $pdf->Cell(28.5, 6,' - ',0, 0, 'C');
                }
                $total_qty_y = $pdf->GetY() - $product_y;

                $y_array = array($name_y, $contains_y,$unit_y, $total_qty_y, $qty_y);
                $product_max = max($y_array);

                $pdf->SetY($product_y);
                $pdf->SetX(10);
                $pdf->Cell(10,$product_max,'',1,0,'C');
                $pdf->SetX(20);
                $pdf->Cell(30,$product_max,'',1,0,'C');
                $pdf->SetX(50);
                $pdf->Cell(30,$product_max,'',1,0,'C');
                $pdf->SetX(80);
                $pdf->Cell(30,$product_max,'',1,0,'C');
                $pdf->SetX(110);
                $pdf->Cell(28.5,$product_max,'',1,1,'C');
                

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
            $pdf->Cell(30, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(30, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(30, 190 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(28.5, 190 - $y_axis, '', 1, 1, 'C', 0);

            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(203);
            $pdf->SetX(10);
            $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);

            $pdf->SetTitle('Stock Request');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFont('Arial', 'BI', 10);
            $height = 0;
            $display = '';
            $y2 = $pdf->GetY();
            $y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetY(11);
            $file_name="Stock Request";
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
            $pdf->Cell(63,4,'Godown : ',0,1,'L',0);
            $pdf->Cell(0,1,'',0,1,'L',0);
            $pdf->SetFont('Arial','B',10);
            $pdf->SetX(12);
            
            $pdf->SetFont('Arial','',9);
            $pdf->SetX(20);
            $pdf->MultiCell(50,4,html_entity_decode($godown_name_location),0,'L',0);
            $pdf->Cell(0,1,'',0,1,'L',0);
                
            $party_y = $pdf->GetY();
            $pdf->SetFont('Arial','B',9);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(80);
            $pdf->Cell(80,8,'Stock Request No   ',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(110);
            $pdf->Cell(40,8,": ".$stock_request_number,0,1,'L',0);

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
            $pdf->Cell(70,20,'',1,0,'L',0);
            $pdf->SetX(80);
            $pdf->Cell(58.5,20,'',1,1,'L',0);
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
            $pdf->Cell(30, 7, 'Reel Size', 1, 0, 'C', 1);
            $pdf->Cell(30, 7, 'GSM', 1, 0, 'C', 1);
            $pdf->Cell(30, 7, 'BF', 1, 0, 'C', 1);
            $pdf->Cell(28.5, 7, 'Qty (Nos)', 1, 1, 'C', 1);
            $pdf->SetTextColor(0,0,0);
            
            $pdf->SetFont('Arial', '', 8);

            $y_axis = $pdf->GetY();
            $content_height = 185 - $footer_height;

            // $pdf->SetY($y_axis);
            // $pdf->SetX(10);
            // $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);
            // $pdf->Cell(30, $content_height - $y_axis, '', 1, 0);
            // $pdf->Cell(30, $content_height - $y_axis, '', 1, 0);
            // $pdf->Cell(30, $content_height - $y_axis, '', 1, 0);
            // $pdf->Cell(28.5, $content_height - $y_axis, '', 1, 1);
        
            // $pdf->SetY($content_height);
        }

        $max_page = max($total_pages);
        $pdf->SetY($y_axis);
        $pdf->SetX(10);

        $pdf->Cell(10, 115 + $height, '', 1, 0);
        $pdf->Cell(30, 115 + $height, '', 1, 0);
        $pdf->Cell(30, 115 + $height, '', 1, 0);
        $pdf->Cell(30, 115 + $height, '', 1, 0);
        $pdf->Cell(28.5, 115 + $height, '', 1, 1);

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

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetY($line_y);
        $pdf->SetX(10);
        $pdf->MultiCell(140,5,'Remarks : '.$remarks,0,'L');

        $pdf->SetFont('Arial', '', 7);
        $pdf->SetY(10);
        $pdf->SetX(10);
        $pdf->Cell(0, 190, '', 1, 0, 'C');

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(203);
        $pdf->SetX(10);
        $pdf->Cell(0,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
        $pdf->OutPut('', $stock_request_number);

    }
?>