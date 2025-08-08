<?php
    include("../include_user_check_and_files.php");
    include("../include/number2words.php");

    $view_material_transfer_id = "";
    if (isset($_REQUEST['view_material_transfer_id'])) {
        $view_material_transfer_id = $_REQUEST['view_material_transfer_id'];
    } else {
        header("Location: ../material_transfer.php");
        exit;
    }
    if(isset($_REQUEST['view_material_transfer_id'])) { 
        $bill_date = date('Y-m-d'); $godown_id = ""; $product_count = 0; $size_ids = array(); $gsm_ids = array(); $bf_ids = array(); $bill_number = ""; $cancelled = ""; $godown_name = "";
        $quantity = array(); $size_name = array(); $bf_name = array(); $gsm_name = array();
        $material_transfer_list = array();
        $material_transfer_list = $obj->getTableRecords($GLOBALS['material_transfer_table'], 'material_transfer_id', $view_material_transfer_id);
        if(!empty($material_transfer_list)) {
            foreach($material_transfer_list as $data) {
                if(!empty($data['bill_date']) && $data['bill_date'] != "0000-00-00") {
                    $bill_date = date('d-m-Y', strtotime($data['bill_date']));
                }
                if(!empty($data['material_transfer_number']) && $data['material_transfer_number'] != $GLOBALS['null_value']) {
                    $bill_number = $data['material_transfer_number'];
                }
                if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                    $factory_id = $data['factory_id'];
                }
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $godown_id = $data['godown_id'];
                }
                if(!empty($data['godown_name']) && $data['godown_name'] != $GLOBALS['null_value']) {
                    $godown_name = $data['godown_name'];
                }
                if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value']) {
                    $size_ids = explode(",", $data['size_id']);
                    $product_count = count($size_ids);
                }
                if(!empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value']) {
                    $gsm_ids = explode(",", $data['gsm_id']);

                }
                if(!empty($data['bf_id']) && $data['bf_id'] != $GLOBALS['null_value']) {
                    $bf_ids = explode(",", $data['bf_id']);
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
                    $cancelled = $data['cancelled'];
                }
            }
        }
        $company_name = "";
        $company_name = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_factory', '1', 'factory_name');
        if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
            $company_name = $obj->encode_decode('decrypt', $company_name);
        }
       
        $godown_list = array(); $godown_details = "";
        $godown_list = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'godown_details');
        if(!empty($godown_list)){
            $godown_details =html_entity_decode($obj->encode_decode('decrypt',$godown_list));
            $godown_details = html_entity_decode($godown_details);
            $godown_details = explode("$$$", $godown_details);
        }
        require_once('../fpdf/AlphaPDF.php');
        $pdf = new AlphaPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);
        $pdf->SetTitle('Material Transfer');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFont('Arial', 'BI', 10);

        $height = 0;
        $display = '';
        $y2 = $pdf->GetY();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(11);

        $file_name="Material Transfer";
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
        $pdf->Cell(63,4,'Godown : ',0,1,'L',0);
        $pdf->Cell(0,1,'',0,1,'L',0);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(12);
        $pdf->SetFont('Arial','',9);
        for($i=0;$i<count($godown_details);$i++)
        {
            if($godown_details[$i]!="NULL" && $godown_details[$i]!="")
            {
                $pdf->SetFont('Arial','',9);
                $pdf->SetX(15);
                if($i==0)
                {
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(65,4,html_entity_decode($godown_details[$i]),0,1,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                }
                else{
                    $godown_details[$i] = trim($godown_details[$i]);
                    $pdf->MultiCell(65,4,html_entity_decode($godown_details[$i]),0,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                }
            }
        }
        $godown_y = $pdf->GetY();
        $pdf->SetFont('Arial','B',9);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(110);
        $pdf->Cell(80,8,'Material Transfer No   ',0,0,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(142);
        $pdf->Cell(40,8,": ".$bill_number,0,1,'L',0);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetX(110);
        $pdf->Cell(20,8,'Date',0,0,'L',0);

        $pdf->SetFont('Arial','',9);
        $pdf->SetX(142);
        $pdf->Cell(40,8,": ".$bill_date,0,1,'L',0);

        $bill_to_y2 = $pdf->GetY();
        $y_array = array($godown_y,$bill_to_y2);
        $max_bill_y = max($y_array);
        $pdf->SetY($bill_to_y);
        $pdf->SetX(10);
        $pdf->Cell(100,30,'',1,0,'L',0);
        $pdf->SetX(110);
        $pdf->Cell(90,30,'',1,1,'L',0);
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
        $pdf->Cell(45, 7, 'QTY', 1, 1, 'C', 1);
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
        $total_quantity = 0;
        $quantity_total = 0;
        if (!empty($view_material_transfer_id) && !empty($size_ids)) {
            for ($p = 0; $p < count($size_ids); $p++) {
                if($pdf->GetY() >= 265){
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
                    $pdf->SetTitle('Material Transfer');
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetFont('Arial', 'BI', 10);

                    $height = 0;
                    $display = '';
                    $y2 = $pdf->GetY();
                    $y = $pdf->GetY();
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetY(11);

                    $file_name="Material Transfer";
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
                    $pdf->Cell(63,4,'Godown : ',0,1,'L',0);
                    $pdf->Cell(0,1,'',0,1,'L',0);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetX(12);
                    $pdf->SetFont('Arial','',9);
                    for($i=0;$i<count($godown_details);$i++)
                    {
                        if($godown_details[$i]!="NULL" && $godown_details[$i]!="")
                        {
                            $pdf->SetFont('Arial','',9);
                            $pdf->SetX(15);
                            if($i==0)
                            {
                                $pdf->SetFont('Arial','B',9);
                                $pdf->Cell(65,4,html_entity_decode($godown_details[$i]),0,1,'L',0);
                                $pdf->Cell(0,1,'',0,1,'L',0);
                            }
                            else{
                                $godown_details[$i] = trim($godown_details[$i]);
                                $pdf->MultiCell(65,4,html_entity_decode($godown_details[$i]),0,'L',0);
                                $pdf->Cell(0,1,'',0,1,'L',0);
                            }
                        }
                    }

                    $godown_y = $pdf->GetY();
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(110);
                    $pdf->Cell(80,8,'Material Transfer No   ',0,0,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(142);
                    $pdf->Cell(40,8,": ".$bill_number,0,1,'L',0);

                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(110);
                    $pdf->Cell(20,8,'Date',0,0,'L',0);

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(142);
                    $pdf->Cell(40,8,": ".$bill_date,0,1,'L',0);

                    $bill_to_y2 = $pdf->GetY();
                    $y_array = array($godown_y,$bill_to_y2);
                    $max_bill_y = max($y_array);
                    $pdf->SetY($bill_to_y);
                    $pdf->SetX(10);
                    $pdf->Cell(100,30,'',1,0,'L',0);
                    $pdf->SetX(110);
                    $pdf->Cell(90,30,'',1,1,'L',0);
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
                    $pdf->Cell(45, 7, 'QTY', 1, 1, 'C', 1);
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
                $pdf->SetX(12);
                $pdf->Cell(10, 6, $s_no, 0, 0, 'L', 0);

                $pdf->SetY($product_y);
                if(!empty($size_name[$p])){
                    $pdf->SetX(20);
                    $pdf->MultiCell(45, 6,$obj->encode_decode('decrypt',$size_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(20);
                    $pdf->Cell(45, 6,' - ',0,0, 'L');
                }
                $size_y =  $pdf->GetY() - $product_y;
                
                $pdf->SetY($product_y);
                if(!empty($gsm_name[$p])){
                    $pdf->SetX(65);
                    $pdf->MultiCell(45, 6,$obj->encode_decode('decrypt', $gsm_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(65);
                    $pdf->MultiCell(45, 6,' - ', 0, 'C');
                }
                $gsm_y =  $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($bf_name[$p])){
                    $pdf->SetX(110);
                    $pdf->MultiCell(45, 6,$obj->encode_decode('decrypt',$bf_name[$p]), 0, 'C');
                } else {
                    $pdf->SetX(110);
                    $pdf->Cell(45, 6,' - ',0, 0, 'C');
                }
                $bf_y =  $pdf->GetY() - $product_y;

                $pdf->SetY($product_y);
                if(!empty($quantity[$p])){
                    $pdf->SetX(155);
                    $pdf->MultiCell(45, 6,$quantity[$p], 0, 'R');
                    $quantity_total += $quantity[$p]; 
                } else {
                    $pdf->SetX(136);
                    $pdf->Cell(45, 6,' - ',0, 0, 'C');
                }
                $total_qty_y = $pdf->GetY() - $product_y;

                $y_array = array($size_y, $gsm_y, $bf_y, $total_qty_y);
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

                $pdf->SetTitle('Material Transfer');
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetFont('Arial', 'BI', 10);

                $height = 0;
                $display = '';
                $y2 = $pdf->GetY();
                $y = $pdf->GetY();
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetY(11);

                $file_name="Material Transfer";
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
                $pdf->Cell(63,4,'Godown : ',0,1,'L',0);
                $pdf->Cell(0,1,'',0,1,'L',0);
                $pdf->SetFont('Arial','B',10);
                $pdf->SetX(12);
                $pdf->SetFont('Arial','',9);
                for($i=0;$i<count($godown_details);$i++)
                {
                    if($godown_details[$i]!="NULL" && $godown_details[$i]!="")
                    {
                        $pdf->SetFont('Arial','',9);
                        $pdf->SetX(15);
                        if($i==0)
                        {
                            $pdf->SetFont('Arial','B',9);
                            $pdf->Cell(65,4,html_entity_decode($godown_details[$i]),0,1,'L',0);
                            $pdf->Cell(0,1,'',0,1,'L',0);
                        }
                        else{
                            $godown_details[$i] = trim($godown_details[$i]);
                            $pdf->MultiCell(65,4,html_entity_decode($godown_details[$i]),0,'L',0);
                            $pdf->Cell(0,1,'',0,1,'L',0);
                        }
                    }
                }

                $godown_y = $pdf->GetY();
                $pdf->SetFont('Arial','B',9);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(110);
                $pdf->Cell(80,8,'Material Transfer No   ',0,0,'L',0);

                $pdf->SetFont('Arial','',9);
                $pdf->SetX(142);
                $pdf->Cell(40,8,": ".$bill_number,0,1,'L',0);

                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(110);
                $pdf->Cell(20,8,'Date',0,0,'L',0);

                $pdf->SetFont('Arial','',9);
                $pdf->SetX(142);
                $pdf->Cell(40,8,": ".$bill_date,0,1,'L',0);

                $bill_to_y2 = $pdf->GetY();
                $y_array = array($godown_y,$bill_to_y2);
                $max_bill_y = max($y_array);
                $pdf->SetY($bill_to_y);
                $pdf->SetX(10);
                $pdf->Cell(100,30,'',1,0,'L',0);
                $pdf->SetX(110);
                $pdf->Cell(90,30,'',1,1,'L',0);
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
                $pdf->Cell(45, 7, 'QTY', 1, 1, 'C', 1);
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

            $pdf->Cell(10, 186 + $height, '', 1, 0);
            $pdf->Cell(45, 186 + $height, '', 1, 0);
            $pdf->Cell(45, 186 + $height, '', 1, 0);
            $pdf->Cell(45, 186 + $height, '', 1, 0);
            $pdf->Cell(45, 186 + $height, '', 1, 1);
                
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetX(10);

            $pdf->Cell(145, 5, 'Total Qty', 1, 0, 'R', 0);
            $pdf->Cell(0, 5, $quantity_total." ", 1, 1, 'R', 0);
            
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

            $pdf->SetFont('Arial', '', 7);
            $pdf->SetY(10);
            $pdf->SetX(10);
            $pdf->Cell(190, 270, '', 1, 0, 'C');


            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-15);
            $pdf->SetX(10);
            $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

        }



        $pdf->OutPut('', $bill_number);



    }

?>