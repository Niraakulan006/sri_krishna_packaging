<?php 
	$page_title = "Current Stock Report";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }
    
    $product_id = ""; $factory_id = ""; $godown_id = ""; $location_type = "";$size_id="";$gsm_id="";$bf_id="";$from_date=""; $to_date="";
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');

    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }
    if(isset($_POST['location_type'])) {
        $location_type = $_POST['location_type'];
    }
    if(isset($_POST['factory_id'])) {
        $factory_id = $_POST['factory_id'];
    }
    if(isset($_POST['godown_id'])) {
        $godown_id = $_POST['godown_id'];
    }
    if(isset($_POST['size_id'])) {
        $size_id = $_POST['size_id'];
    }
    if(isset($_POST['gsm_id'])) {
        $gsm_id = $_POST['gsm_id'];
    }
    if(isset($_POST['bf_id'])) {
        $bf_id = $_POST['bf_id'];
    }

    $total_records_list = array();
    $factory_list = array();$godown_list = array();
    $factory_list = $obj->getTableRecords($GLOBALS['factory_table'], '', '');
    $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '');
    if($location_type =='1'){
       
        if(!empty($factory_id)){
            if(!empty($size_id) || !empty($gsm_id) || !empty($bf_id)){
                $total_records_list = $obj->getCurrentStockList('1',$factory_id,'',$size_id,$gsm_id,$bf_id,$from_date,$to_date);
            }else{
                $total_records_list = $obj->getCurrentStockList('1',$factory_id,'','','','','','');
            }
            
        }else{
            $total_records_list = $obj->getCurrentStockList('1','','','','','','','');
        }
        
    }else if($location_type =='2'){
       
        if(!empty($godown_id)){
            if(!empty($size_id) || !empty($gsm_id) || !empty($bf_id)){
                $total_records_list = $obj->getCurrentStockList('2','',$godown_id,$size_id,$gsm_id,$bf_id,$from_date,$to_date);
            }else{
                 $total_records_list = $obj->getCurrentStockList('2','',$godown_id,'','','','','');
            }
        }else{
            $total_records_list = $obj->getCurrentStockList('2','','','','','','','');
        }
    }else{
        $total_records_list = $obj->getCurrentStockList('','','','','','','','');
    }

    $size_list =array(); $gsm_list =array(); $bf_list =array();
    $size_list = $obj->getTableRecords($GLOBALS['size_table'], '', '');
    $gsm_list = $obj->getTableRecords($GLOBALS['gsm_table'], '', '');
    $bf_list = $obj->getTableRecords($GLOBALS['bf_table'], '', '');


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                        <div class="border card-box" id="table_records_cover">
                            <div class="card-header align-products-center">
                                <form name="stock_report_form" method="post">
                                    <div class="row justify-content py-2 px-2 mt-3">
                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <select name="location_type" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                        <option value="">Select</option>
                                                        <option value="1" <?php if($location_type =='1'){ ?> selected <?php  } ?>>Factory</option>
                                                        <option value="2" <?php if($location_type =='2'){ ?> selected <?php  } ?>>Godown</option>
                                                    </select>
                                                    <label>Location Type</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 col-md-4 col-6 <?php if(empty($factory_id)){ ?> d-none <?php } ?> " id="factory_list">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <select name="factory_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                        <option value="">Select</option>
                                                        <?php
                                                            if(!empty($factory_list)) {
                                                                foreach($factory_list as $data) {
                                                                    if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                                                                        ?>
                                                                        <option value="<?php echo $data['factory_id']; ?>" <?php if(!empty($factory_id) && $factory_id == $data['factory_id']) { ?>selected<?php } ?>>
                                                                            <?php
                                                                                if(!empty($data['factory_name']) && $data['factory_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['factory_name']);
                                                                                }
                                                                            ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Location</label>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-2 col-md-4 col-6 <?php if(empty($godown_id)){ ?> d-none <?php } ?> " id="godown_list">
                                            <div class="form-group mb-1">
                                                <div class="form-label-group in-border pb-2">
                                                    <select name="godown_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                        <option value="">Select</option>
                                                        <?php
                                                            if(!empty($godown_list)) {
                                                                foreach($godown_list as $data) {
                                                                    if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                                                                        ?>
                                                                        <option value="<?php echo $data['godown_id']; ?>" <?php if(!empty($godown_id) && $godown_id == $data['godown_id']) { ?>selected<?php } ?>>
                                                                            <?php
                                                                                if(!empty($data['godown_name']) && $data['godown_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['godown_name']);
                                                                                }
                                                                            ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Location</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php if(!empty($factory_id) || !empty($godown_id)){ ?>
                                            <div class="col-lg-2 col-md-4 col-6">
                                                <div class="form-group mb-1">
                                                    <div class="form-label-group in-border pb-2">
                                                        <select name="size_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                            <option value="">Select</option>
                                                            <?php
                                                                if(!empty($size_list)) {
                                                                    foreach($size_list as $data) {
                                                                        if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value']) {
                                                                            ?>
                                                                            <option value="<?php echo $data['size_id']; ?>" <?php if(!empty($size_id) && $size_id == $data['size_id']) { ?>selected<?php } ?>>
                                                                                <?php
                                                                                    if(!empty($data['size_name']) && $data['size_name'] != $GLOBALS['null_value']) {
                                                                                        echo $obj->encode_decode('decrypt', $data['size_name']);
                                                                                    }
                                                                                ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                        <label>Size</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-6">
                                                <div class="form-group mb-1">
                                                    <div class="form-label-group in-border pb-2">
                                                        <select name="gsm_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                            <option value="">Select</option>
                                                            <?php
                                                                if(!empty($gsm_list)) {
                                                                    foreach($gsm_list as $data) {
                                                                        if(!empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value']) {
                                                                            ?>
                                                                            <option value="<?php echo $data['gsm_id']; ?>" <?php if(!empty($gsm_id) && $gsm_id == $data['gsm_id']) { ?>selected<?php } ?>>
                                                                                <?php
                                                                                    if(!empty($data['gsm_name']) && $data['gsm_name'] != $GLOBALS['null_value']) {
                                                                                        echo $obj->encode_decode('decrypt', $data['gsm_name']);
                                                                                    }
                                                                                ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                        <label>GSM</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-6">
                                                <div class="form-group mb-1">
                                                    <div class="form-label-group in-border pb-2">
                                                        <select name="bf_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                            <option value="">Select</option>
                                                            <?php
                                                                if(!empty($bf_list)) {
                                                                    foreach($bf_list as $data) {
                                                                        if(!empty($data['bf_id']) && $data['bf_id'] != $GLOBALS['null_value']) {
                                                                            ?>
                                                                            <option value="<?php echo $data['bf_id']; ?>" <?php if(!empty($bf_id) && $bf_id == $data['bf_id']) { ?>selected<?php } ?>>
                                                                                <?php
                                                                                    if(!empty($data['bf_name']) && $data['bf_name'] != $GLOBALS['null_value']) {
                                                                                        echo $obj->encode_decode('decrypt', $data['bf_name']);
                                                                                    }
                                                                                ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                        <label>BF</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-6">
                                                <div class="form-group mb-1">
                                                    <div class="form-label-group in-border pb-2">
                                                        <input type="date" id="from_date" name="from_date" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" onchange="Javascript:getReport();checkDateCheck();" class="form-control shadow-none" placeholder="" required max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>From Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-6">
                                                <div class="form-group mb-1">
                                                    <div class="form-label-group in-border pb-2">
                                                        <input type="date" id="to_date" name="to_date" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:getReport();checkDateCheck();" class="form-control shadow-none" placeholder="" required max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>To Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>

                                        <div class="col-lg-4 col-md-3 col-9">
                                            <?php if(!empty($godown_id) || !empty($factory_id)) { ?>
                                            <div class="col-lg-4 col-md-3 col-3">
                                                <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="window.open('current_stock_report.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> Back </button>
                                            </div>
                                            <?php } ?>
                                            <button class="btn btn-success float-end mx-2" style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Excel</button>
                                            

                                            <button class="btn btn-success float-end mx-2" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_current_stock_report.php?from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&location_type=<?php echo $location_type; ?>&factory_id=<?php echo $factory_id; ?>&godown_id=<?php echo $godown_id; ?>&size_id=<?php echo $size_id; ?>&gsm_id=<?php echo $gsm_id; ?>&bf_id=<?php echo $bf_id; ?>&from=')"> <i class="fa fa-print"></i> Print </button>
                                         
                                        
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row px-2 pb-4 justify-content-center">    
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <?php if(empty($factory_id) && empty($godown_id)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_stock_report">
                                                <thead class="bg-ligt" style="font-size:13px!important;font-weight:bold!important;">
                                                    <tr class="bg-primary">
                                                        <th colspan="3" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 18px;">
                                                            Current Stock Report 
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-primary" style="vertical-align:middle!important;">
                                                        <th class="fw-bold">S.No</th>
                                                        <th class="fw-bold">Location</th>
                                                        <th class="fw-bold">Current Stock</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_stock = 0; $sno = 1;
                                                        if(!empty($total_records_list)) { 
                                                            foreach($total_records_list as $key => $data) {
                                                                // $inward_unit = 0; $outward_unit = 0;
                                                                // $inward_unit = $obj->getInwardUnitQty('', '', '', '', $data['factory_id'], $data['godown_id'], '', '', '');
                                                               
                                                                // $outward_unit = $obj->getoutwardUnitQty('', '', '', '', $data['factory_id'], $data['godown_id'], '', '', '');
                                                               
                                                                $current_stock = 0; 
                                                                // $current_stock = $inward_unit - $outward_unit;
                                                                // $current_stock = number_format($current_stock, 2);

                                                                ?>
                                                                <tr>
                                                                    <th><?php echo $sno++; ?></th>
                                                                    <th onclick="Javascript:ShowStockProduct('<?php if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) { echo $data['factory_id']; } ?>','<?php if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) { echo $data['godown_id']; } ?>','','','');" style="cursor:pointer!important;">
                                                                        <?php
                                                                           
                                                                            if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['factory_name']);
                                                                            }else if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['godown_name']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                           
                                                                            if(!empty($data['inward_unit']) || !empty($data['outward_unit'])) {
                                                                                echo $data['inward_unit'] - $data['outward_unit'];
                                                                                $current_stock += $data['inward_unit'] - $data['outward_unit'];
                                                                            }
                                                                        
                                                                            $total_stock += $current_stock;
                                                                        ?>
                                                                    </th>  
                                                                </tr>
                                                            <?php 
                                                            } 
                                                            ?>
                                                            <tr class="bg-light">
                                                                <th colspan="2" class="text-end fw-bold">Total</th>
                                                                <th class="fw-bold"><?php echo $total_stock; ?></th>
                                                            </tr>
                                                            <?php
                                                        }  
                                                        else {
                                                    ?>
                                                            <tr>
                                                                <td colspan="3" class="text-center fw-bold">Sorry! No records found</td>
                                                            </tr>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php }  ?>
                                        <?php if(!empty($size_id) || !empty($gsm_id) || !empty($bf_id) && !empty($location_type)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_stock_report">
                                                <thead style="font-size:13px!important;font-weight:bold!important;">     
                                                    <tr class="bg-success">
                                                        <th colspan="7" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 16px;">
                                                            Current Stock Report 
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-success">
                                                        <th colspan="7" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 14px;">
                                                            <?php 
                                                            if(!empty($factory_id)){
                                                                $factory_name ="";
                                                                $factory_name = $obj->getTableColumnValue($GLOBALS['factory_table'],'factory_id',$factory_id,'factory_name');
                                                                echo "Factory - ".$obj->encode_decode('decrypt',$factory_name);
                                                            }
                                                            if(!empty($godown_id)){
                                                                $godown_name ="";
                                                                $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'godown_name');
                                                                echo " Godown -".$obj->encode_decode('decrypt',$godown_name);
                                                            } ?>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-success" style="vertical-align:middle!important;">
                                                        <th class="fw-bold">S.No</th>
                                                        <th class="fw-bold">Bill Date</th>
                                                        <th class="fw-bold">Bill No</th>
                                                        <th class="fw-bold">Bill Type</th>
                                                        <th class="fw-bold">Remarks</th>
                                                        <th class="fw-bold">Inward</th>
                                                        <th class="fw-bold">Outward</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_stock =0;$total_inward =0;$total_outward =0;
                                                        if(!empty($total_records_list)) { 
                                                            foreach($total_records_list as $key => $data) { ?>
                                                                <tr >
                                                                    <th><?php echo $key+1; ?></th>
                                                                     <th>
                                                                        <?php 
                                                                            if(!empty($data['stock_date'])) {
                                                                                echo date('d-m-Y', strtotime($data['stock_date']));
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['bill_unique_number'])) {
                                                                                echo $data['bill_unique_number'];
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['stock_type'])) {
                                                                                echo $data['stock_type'];
                                                                            }
                                                                        ?>
                                                                    </th>  
                                                                    <th>
                                                                        <?php 
                                                                        if($data['stock_type'] =='Inward Material'){
                                                                            if(!empty($data['remarks'])) {
                                                                                echo $obj->encode_decode('decrypt',$data['remarks']);
                                                                            }
                                                                        }else{
                                                                            if(!empty($data['remarks'])) {
                                                                                echo $data['remarks'];
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </th>  
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['inward_unit'])) {
                                                                                echo $data['inward_unit'];
                                                                                $total_inward += $data['inward_unit'];
                                                                            }else{
                                                                                echo "-";
                                                                            }
                                                                        ?>
                                                                    </th>  
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['outward_unit'])) {
                                                                                echo $data['outward_unit'];
                                                                                $total_outward += $data['outward_unit'];
                                                                            }else{
                                                                                echo "-";
                                                                            }
                                                                        ?>
                                                                    </th>   
                                                                </tr>
                                                                <?php 
                                                            } 
                                                            ?>
                                                            <tr class="bg-light">
                                                                <th colspan="5" class="text-end fw-bold">Total &ensp;</th>
                                                                <th class="fw-bold"><?php echo $total_inward; ?></th>
                                                                <th class="fw-bold"><?php echo $total_outward; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="5" class="text-end fw-bold">Current Stock &ensp;</th>
                                                                <th colspan="4" class="fw-bold"><?php echo $total_inward - $total_outward; ?></th>
                                                                
                                                            </tr>
                                                            <?php
                                                        } 
                                                        else {
                                                    ?>
                                                            <tr>
                                                                <td colspan="7" class="text-center fw-bold">Sorry! No records found</td>
                                                            </tr>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php } else if(!empty($factory_id) || !empty($godown_id) && empty($size_id) && empty($gsm_id) && empty($bf_id) && !empty($location_type)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_stock_report">
                                                <thead style="font-size:13px!important;font-weight:bold!important;">     
                                                    <tr class="bg-success">
                                                        <th colspan="5" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 16px;">
                                                            Current Stock Report 
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-success">
                                                        <th colspan="5" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 14px;">
                                                            <?php 
                                                            if(!empty($factory_id)){
                                                                $factory_name ="";
                                                                $factory_name = $obj->getTableColumnValue($GLOBALS['factory_table'],'factory_id',$factory_id,'factory_name');
                                                                echo "Factory - ".$obj->encode_decode('decrypt',$factory_name);
                                                            }
                                                            if(!empty($godown_id)){
                                                                $godown_name ="";
                                                                $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'godown_name');
                                                                echo " Godown -".$obj->encode_decode('decrypt',$godown_name);
                                                            } ?>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-success" style="vertical-align:middle!important;">
                                                        <th class="fw-bold">S.No</th>
                                                        <th class="fw-bold">Size</th>
                                                        <th class="fw-bold">GSM</th>
                                                        <th class="fw-bold">BF</th>
                                                        <th class="fw-bold">Reel Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_stock =0;
                                                        if(!empty($total_records_list)) { 
                                                            foreach($total_records_list as $key => $data) {
                                                                $current_stock =0;
                                                            ?>
                                                                <tr onclick="Javascript:ShowStockProduct('<?php if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) { echo $data['factory_id']; } ?>','<?php if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) { echo $data['godown_id']; } ?>','<?php if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value']) { echo $data['size_id']; } ?>','<?php if(!empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value']) { echo $data['gsm_id']; } ?>','<?php if(!empty($data['bf_id']) && $data['bf_id'] != $GLOBALS['null_value']) { echo $data['bf_id']; } ?>');" style="cursor:pointer!important;">
                                                                    <th><?php echo $key+1; ?></th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['size_name'])) {
                                                                                echo $obj->encode_decode('decrypt',$data['size_name']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['gsm_name'])) {
                                                                                echo $obj->encode_decode('decrypt',$data['gsm_name']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['bf_name'])) {
                                                                                echo $obj->encode_decode('decrypt',$data['bf_name']);
                                                                            }
                                                                        ?>
                                                                    </th>  
                                                                    <th>
                                                                        <?php
                                                                           
                                                                            if(!empty($data['inward_unit']) || !empty($data['outward_unit'])) {
                                                                                echo $data['inward_unit'] - $data['outward_unit'];
                                                                                $current_stock += $data['inward_unit'] - $data['outward_unit'];
                                                                            }
                                                                        
                                                                            $total_stock += $current_stock;
                                                                        ?>
                                                                    </th>  
                                                                </tr>
                                                                <?php 
                                                            } 
                                                            ?>
                                                            <tr class="bg-light">
                                                                <th colspan="4" class="text-end fw-bold">Total &ensp;</th>
                                                                <th class="fw-bold"><?php echo $total_stock; ?></th>
                                                            </tr>
                                                            <?php
                                                        } 
                                                        else {
                                                    ?>
                                                            <tr>
                                                                <td colspan="5" class="text-center">Sorry! No records found</td>
                                                            </tr>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php }?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    jQuery(document).ready(function(){
        jQuery('.add_update_form_content').find('select').select2();
    });
</script>
<script>
    $(document).ready(function(){
        $("#stock_report").addClass("active");
        $("#report").addClass("active");
        table_listing_records_filter();
    });
</script>

<script type="text/javascript">
    function getReport() {
        if(jQuery('form[name="stock_report_form"]').length > 0) {
            jQuery('form[name="stock_report_form"]').submit();
        }
    }
    function ShowStockProduct(factory_id,godown_id,size_id,gsm_id,bf_id) {

        // alert(factory_id+"/"+godown_id+"/"+size_id+"/"+gsm_id+"/"+bf_id)
        
        if(factory_id !=''){
            if(jQuery('select[name="factory_id"]').length > 0) {
                jQuery('select[name="factory_id"]').val(factory_id);
            }

            if(jQuery('#factory_list').length > 0) {
                jQuery('#factory_list').removeClass('d-none');
            }
        
            if(jQuery('select[name="location_type"]').length > 0) {
                jQuery('select[name="location_type"]').val('1');
            }
           
        }

        if(godown_id !=''){
            if(jQuery('select[name="location_type"]').length > 0) {
                jQuery('select[name="location_type"]').val('2');
            }

            if(jQuery('#godown_list').length > 0) {
                jQuery('#godown_list').removeClass('d-none');
            }
        
            if(jQuery('select[name="godown_id"]').length > 0) {
                jQuery('select[name="godown_id"]').val(godown_id);
            }
            
        }

        if(jQuery('select[name="size_id"]').length > 0) {
            jQuery('select[name="size_id"]').val(size_id);
        }
        if(jQuery('select[name="gsm_id"]').length > 0) {
            jQuery('select[name="gsm_id"]').val(gsm_id);
        }
        if(jQuery('select[name="bf_id"]').length > 0) {
            jQuery('select[name="bf_id"]').val(bf_id);
        }

        getReport();

        
    }
</script>

<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_stock_report');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('current_stock_report.' + (type || 'xlsx')));
        window.open("current_stock_report.php","_self");
    }
</script>