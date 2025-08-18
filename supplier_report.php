<?php 
	$page_title = "Supplier Report";
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
    
    $supplier_id="";$from_date=""; $to_date="";
    $from_date = date('Y-m-d', strtotime('-7 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');

    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }
    if(isset($_POST['supplier_id'])) {
        $supplier_id = $_POST['supplier_id'];
    }

    $total_records_list = array();
    $total_records_list = $obj->getSupplierReport($supplier_id,$from_date,$to_date);
    
    $supplier_list =array();
    $supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'], '', '');

    $excel_name = "";
    if(!empty($from_date) && !empty($to_date) && !empty($supplier_id)){
    $excel_name = "Supplier Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";
    }else{
        $excel_name = "Supplier Report";
    }

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
                                <form name="supplier_report_form" method="post">
                                    <div class="row mx-0">
                                        <?php if(!empty($supplier_id)) { ?>
                                            <div class="col-lg-2 col-md-4 col-6 py-2">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" id="from_date" name="from_date" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" onchange="Javascript:getReport();checkDateCheck();" class="form-control shadow-none" placeholder="" required max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>From Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-6 py-2">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border">
                                                        <input type="date" id="to_date" name="to_date" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:getReport();checkDateCheck();" class="form-control shadow-none" placeholder="" required max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                                        <label>To Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-lg-2 col-md-4 col-6 py-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <select name="supplier_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                        <option value="">Select</option>
                                                        <?php
                                                            if(!empty($supplier_list)) {
                                                                foreach($supplier_list as $data) {
                                                                    if(!empty($data['supplier_id']) && $data['supplier_id'] != $GLOBALS['null_value']) {
                                                                        ?>
                                                                        <option value="<?php echo $data['supplier_id']; ?>" <?php if(!empty($supplier_id) && $supplier_id == $data['supplier_id']) { ?>selected<?php } ?>>
                                                                            <?php
                                                                                if(!empty($data['supplier_name']) && $data['supplier_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['supplier_name']);
                                                                                }
                                                                            ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Supplier</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-8 <?php if(empty($supplier_id)) { ?>ms-auto<?php } ?> py-2">
                                            <button class="btn btn-success float-end" style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Excel</button>
                                            <button class="btn btn-success float-end mx-2" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_supplier_report.php?from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&supplier_id=<?php echo $supplier_id; ?>&from=')"> <i class="fa fa-print"></i> Print </button>
                                        </div>
                                        <?php if(!empty($supplier_id)) { ?>
                                            <div class="col-lg-1 col-md-2 col-4 py-2 ms-auto">
                                                <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="window.open('supplier_report.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> Back </button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                            <div class="row px-2 pb-4 justify-content-center">    
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <?php if(empty($supplier_id)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_supplier_report">
                                                <thead style="font-size:13px!important;font-weight:bold!important;">
                                                    <tr>
                                                        <th colspan="5" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 18px;">
                                                            Supplier Report
                                                        </th>
                                                    </tr>
                                                    <tr class="text-white" style="vertical-align:middle!important;background-color:#20a0df;">
                                                        <th class="fw-bold" style="width:50px;">S.No</th>
                                                        <th class="fw-bold" style="width:700px;">Supplier</th>
                                                        <th class="fw-bold" style="width:200px;">Reel Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_stock = 0; $sno = 1;
                                                        if(!empty($total_records_list)) { 
                                                            foreach($total_records_list as $key => $data) { 
                                                                $current_stock =0; ?>
                                                                <tr onclick="Javascript:ShowStockProduct('<?php if(!empty($data['supplier_id']) && $data['supplier_id'] != $GLOBALS['null_value']) { echo $data['supplier_id']; } ?>');" style="cursor:pointer!important;">
                                                                    <th><?php echo $sno++; ?></th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['supplier_name']) && $data['supplier_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['supplier_name']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['inward_unit'])) {
                                                                                echo $data['inward_unit'];
                                                                                $current_stock += $data['inward_unit'];
                                                                            }
                                                                        
                                                                            $total_stock += $current_stock;
                                                                        ?>
                                                                    </th>  
                                                                </tr>
                                                            <?php 
                                                            } 
                                                            ?>
                                                            <tr>
                                                                <th colspan="2" class="text-end fw-bold ">Total</th>
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
                                        <?php if(!empty($supplier_id)) { ?>
                                            <table class="table table-bordered nowrap text-center smallfnt" id="tbl_supplier_report">
                                                <thead style="font-size:13px!important;font-weight:bold!important;">     
                                                    <tr>
                                                        <th colspan="8" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 16px;">
                                                            Supplier Report - <?php if(!empty($from_date)){ echo " (" .date('d-m-Y',strtotime($from_date )) ." to ". date('d-m-Y',strtotime($to_date )). ")"; }?>
                                                        </th>
                                                    </tr>
                                                    <tr class="text-white" style="vertical-align:middle!important;background-color:#20a0df;">
                                                        <th class="fw-bold">S.No</th>
                                                        <th class="fw-bold">Bill Date</th>
                                                        <th class="fw-bold">Bill No</th>
                                                        <th class="fw-bold">Location</th>
                                                        <th class="fw-bold">Size</th>
                                                        <th class="fw-bold">GSM</th>
                                                        <th class="fw-bold">BF</th>
                                                        <th class="fw-bold">Inward Qty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_stock = 0; $total_inward = 0;
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
                                                                            if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt',$data['remarks']);
                                                                            }
                                                                        ?>
                                                                        &nbsp; <a href="Javascript:BillModalContent('<?php if(!empty($data['bill_unique_id']) && $data['bill_unique_id'] != $GLOBALS['null_value']) { echo $data['bill_unique_id']; } ?>');"><i class="fa fa-info-circle"></i></a>
                                                                    </th>
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['factory_name']) && $data['factory_name']!=$GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt',$data['factory_name']);
                                                                            }
                                                                            else {
                                                                               if(!empty($data['godown_name']) && $data['godown_name']!= $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt',$data['godown_name']);
                                                                                } 
                                                                            }
                                                                        ?>
                                                                    </th>  
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['size_name']) && $data['size_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt',$data['size_name']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['gsm_name']) && $data['gsm_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt',$data['gsm_name']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['bf_name']) && $data['bf_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt',$data['bf_name']);
                                                                            }
                                                                        ?>
                                                                    </th>  
                                                                    <th>
                                                                        <?php 
                                                                            if(!empty($data['inward_unit'])) {
                                                                                echo $data['inward_unit'];
                                                                                $total_inward += $data['inward_unit'];
                                                                            }
                                                                            else{
                                                                                echo "-";
                                                                            }
                                                                        ?>
                                                                    </th>   
                                                                </tr>
                                                                <?php 
                                                            } 
                                                            ?>
                                                            <tr>
                                                                <th colspan="7" class="text-end fw-bold">Total &ensp;</th>
                                                                <th class="fw-bold"><?php echo $total_inward; ?></th>
                                                            </tr>
                                                            
                                                            <?php
                                                        } 
                                                        else {
                                                    ?>
                                                            <tr>
                                                                <td colspan="8" class="text-center fw-bold">Sorry! No records found</td>
                                                            </tr>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php } ?>    
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
        $("#supplier_report").addClass("active");
        $("#report").addClass("active");
        table_listing_records_filter();
    });
</script>

<script type="text/javascript">
    function getReport() {
        if(jQuery('form[name="supplier_report_form"]').length > 0) {
            jQuery('form[name="supplier_report_form"]').submit();
        }
    }
    function ShowStockProduct(supplier_id) {
        if(jQuery('select[name="supplier_id"]').length > 0) {
            jQuery('select[name="supplier_id"]').val(supplier_id);
        }
        getReport();
        
    }

    function BillModalContent(bill_id) {
        bill_id = bill_id.trim();

        var post_url = "dashboard_changes.php?check_login_session=1";
        jQuery.ajax({
            url: post_url,
            success: function (check_login_session) {
                if (check_login_session == 1) {
                    jQuery('#BillModal .modal-header h1').html("Inward Material Preview");

                    var a4_url = "reports/rpt_inward_material_a4.php?view_inward_material_id=" + bill_id;
                    var a5_url = "reports/rpt_inward_material_a5.php?view_inward_material_id=" + bill_id;

                    jQuery('.bill_modal_button').trigger("click");

                    var iframe = '<iframe id="billPreviewIframe" src="' + a4_url + '" width="100%" height="500px" style="border:none;"></iframe>';

                    var menu_html = `
                        <ul class="nav nav-tabs mb-2">
                            <li class="nav-item">
                                <a class="nav-link active " href="#" id="btnA4">A4 Print</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="btnA5">A5 Print</a>
                            </li>
                        </ul>
                    `;

                    jQuery('#BillModal .modal-body').html(menu_html + iframe);

                    jQuery('#btnA4').off('click').on('click', function (e) {
                        e.preventDefault();
                        jQuery('#btnA4').addClass('active');
                        jQuery('#btnA5').removeClass('active');
                        jQuery('#billPreviewIframe').attr('src', a4_url);
                    });

                    jQuery('#btnA5').off('click').on('click', function (e) {
                        e.preventDefault();
                        jQuery('#btnA5').addClass('active');
                        jQuery('#btnA4').removeClass('active');
                        jQuery('#billPreviewIframe').attr('src', a5_url);
                    });

                } else {
                    window.location.reload();
                }
            }
        });
    }

</script>

<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_supplier_report');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("supplier_report.php","_self");
    }
</script>