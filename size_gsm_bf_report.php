<?php 
	$page_title = "Size GSM BF Report";
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
    
    $factory_id = ""; $godown_id = "";
    if(isset($_POST['factory_id'])) {
        $factory_id = trim($_POST['factory_id']);
    }
    if(isset($_POST['godown_id'])) {
        $godown_id = trim($_POST['godown_id']);
    }

    $excel_name = "";
    $excel_name = "Size, GSM, BF Report";

    $factory_list = array();
    $factory_list = $obj->getTableRecords($GLOBALS['factory_table'], '', '');
    $godown_list = array();
    $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '');
    $size_list = array();
    $size_list = $obj->getTableRecords($GLOBALS['size_table'], '', '');
    $gsm_list = array();
    $gsm_list = $obj->getTableRecords($GLOBALS['gsm_table'], '', '');
    $bf_list = array();
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
                                <form name="size_gsm_bf_report_form" method="post">
                                    <div class="row mx-0">
                                        <div class="col-lg-2 col-md-4 col-6 py-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <select name="factory_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:GetLocation(this.value, '');">
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
                                                    <label>Factory</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 py-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <select name="godown_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:GetLocation('', this.value);">
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
                                                    <label>Godown</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-8 ms-auto py-2">
                                            <button class="btn btn-success float-end" style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Excel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row px-2 pb-4 justify-content-center">    
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap text-center" id="tbl_size_gsm_bf_report">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center px-0 py-0">
                                                        <div class="row mx-0 border text-center px-2 py-2">BF/GSM <i class="fa fa-arrow-right text-danger" aria-hidden="true"></i></div>
                                                        <div class="row mx-0 border text-center px-2 py-2">Size <i class="fa fa-arrow-down text-primary" aria-hidden="true"></i></div>
                                                    </th>
                                                    <?php
                                                        if(!empty($gsm_list) && !empty($bf_list)) {
                                                            foreach($gsm_list as $data) {
                                                                foreach($bf_list as $row) {
                                                                    if(!empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value'] && !empty($row['bf_id']) && $row['bf_id'] != $GLOBALS['null_value']) {
                                                                        ?>
                                                                        <th class="text-center px-2 py-2">
                                                                            <?php
                                                                                if(!empty($data['gsm_name']) && $data['gsm_name'] != $GLOBALS['null_value'] && !empty($row['bf_name']) && $row['bf_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $row['bf_name']).'/'.$obj->encode_decode('decrypt', $data['gsm_name']);
                                                                                }
                                                                            ?>
                                                                        </th>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tr>
                                                <?php
                                                    if(!empty($size_list)) {
                                                        foreach($size_list as $data) {
                                                            if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value']) {
                                                                ?>
                                                                <tr>
                                                                    <th class="text-center px-2 py-2">
                                                                        <?php
                                                                            if(!empty($data['size_name']) && $data['size_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['size_name']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <?php
                                                                        if(!empty($gsm_list) && !empty($bf_list)) {
                                                                            foreach($gsm_list as $gsm_data) {
                                                                                foreach($bf_list as $bf_data) {
                                                                                    if(!empty($gsm_data['gsm_id']) && $gsm_data['gsm_id'] != $GLOBALS['null_value'] && !empty($bf_data['bf_id']) && $bf_data['bf_id'] != $GLOBALS['null_value']) {
                                                                                        ?>
                                                                                        <td class="text-center px-2 py-2 smallfnt">
                                                                                            <?php
                                                                                                $stock_map = array(); $reel_key = "";
                                                                                                $stock_map = $obj->ShowSizeGSMBFReport($godown_id, $factory_id);
                                                                                                $reel_key = $data['size_id'].'_'.$gsm_data['gsm_id'].'_'.$bf_data['bf_id'];
                                                                                                $current_stock = $stock_map[$reel_key] ?? 0;
                                                                                                if(!empty($current_stock)) {
                                                                                                    echo $current_stock;
                                                                                                }
                                                                                            ?>
                                                                                        </td>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
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
    $(document).ready(function(){
        $("#size_gsm_bf_report").addClass("active");
        $("#report").addClass("active");
        table_listing_records_filter();
    });
</script>

<script type="text/javascript">
    function getReport() {
        if(jQuery('form[name="size_gsm_bf_report_form"]').length > 0) {
            jQuery('form[name="size_gsm_bf_report_form"]').submit();
        }
    }
    function GetLocation(factory_id, godown_id) {
        if(factory_id != '') {
            if(jQuery('select[name="godown_id"]').length > 0) {
                jQuery('select[name="godown_id"]').val('');
            }
        }
        if(godown_id != '') {
            if(jQuery('select[name="factory_id"]').length > 0) {
                jQuery('select[name="factory_id"]').val('');
            }
        }
        getReport();
    }
</script>
<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_size_gsm_bf_report');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("size_gsm_bf_report.php","_self");
    }
</script>