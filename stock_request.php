<?php 
	$page_title = "Stock Request";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['stock_request_module'];
            include("permission_check.php");
        }
    }
    $add_access_error = ""; $view_access_error = "";
    if(!empty($login_staff_id)) {
        $permission_actions = array($view_action, $add_action, $edit_action, $delete_action);
        include('permission_action.php');
    }
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');
    $factory_list = array();
    $factory_list = $obj->getTableRecords($GLOBALS['factory_table'], '', '');
    $factory_count = 0;
    if(!empty($factory_list)) {
        $factory_count = count($factory_list);
    }

    $godown_list = array();
    if(!empty($login_godown_id)) {
        $godown_id = $login_godown_id;
        $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $login_godown_id, '');
    }
    else {
        $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '', '');
    }
    $godown_count = 0;
    if(!empty($godown_list)) {
        $godown_count = count($godown_list);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/stock_request.js"></script>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                        <div class="border card-box" id="table_records_cover">
                            <div class="card-header align-items-center">
                                <div class="row p-2">   
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border pb-2">
                                                <input type="date" name="filter_from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" onchange="Javascript:checkDateCheck();" placeholder="">
                                                <label>From Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border pb-2">
                                                <input type="date" name="filter_to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:checkDateCheck();" placeholder="">
                                                <label>To Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-12">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border pb-2">
                                                <select name="filter_godown_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($godown_list)) {
                                                            foreach($godown_list as $data) {
                                                                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['godown_id']; ?>" <?php if($godown_count == '1') { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['name_location']) && $data['name_location'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['name_location']);
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
                                    <div class="col-lg-2 col-md-4 col-12">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border pb-2">
                                                <select name="filter_factory_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($factory_list)) {
                                                            foreach($factory_list as $data) {
                                                                if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['factory_id']; ?>" <?php if($factory_count == '1') { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['name_location']) && $data['name_location'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['name_location']);
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
                                    <div class="col-lg-2 col-md-4 col-8 ms-auto">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search_text" id="search_text" style="height:34px;" placeholder="Search By Bill No." aria-label="Search" aria-describedby="basic-addon2">
                                            <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                        </div>
                                    </div>
                                    <?php if(empty($add_access_error)) { ?>
                                        <div class="col-lg-2 col-md-2 col-4">
                                            <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div id="table_listing_records">
                                <?php if(empty($view_access_error)) { ?>
                                    <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                    <div class="new">
                                        <ul class="new nav nav-pills my-3 justify-content-center" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-active-tab" data-bs-toggle="pill" data-bs-target="#pills-active" type="button" role="tab" aria-controls="pills-active" aria-selected="true">Active Bill</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-delivery-tab" data-bs-toggle="pill" data-bs-target="#pills-delivery" type="button" role="tab" aria-controls="pills-delivery" aria-selected="true">Converted Bill</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-cancel-tab" data-bs-toggle="pill" data-bs-target="#pills-cancel" type="button" role="tab" aria-controls="pills-cancel" aria-selected="false">Cancelled Bill</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-active" role="tabpanel" aria-labelledby="pills-active-tab" tabindex="0">
                                                <?php 
                                                    $cancelled = 0; $is_deliveried = 0;
                                                    $id = "table-active";
                                                    include("stock_request_table.php"); 
                                                ?>
                                            </div>
                                            <div class="tab-pane fade" id="pills-delivery" role="tabpanel" aria-labelledby="pills-delivery-tab" tabindex="0">
                                                <?php 
                                                    $cancelled = 0; $is_deliveried = 1;
                                                    $id = "table-delivery";
                                                    include("stock_request_table.php"); 
                                                ?>
                                            </div>
                                            <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab" tabindex="0">
                                                <?php 
                                                    $cancelled = 1; $is_deliveried = 0;
                                                    $id = "table-cancel";
                                                    include("stock_request_table.php"); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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
        jQuery("#stockrequest").addClass("active");
    });
</script>
<script>
    function initializeDataTableIfNeeded(tableId) {
        if (jQuery.fn.DataTable.isDataTable('#' + tableId)) {
            jQuery('#' + tableId).DataTable().destroy();
        }
        if (!jQuery.fn.DataTable.isDataTable('#' + tableId)) {
            jQuery('#' + tableId).DataTable({
                "processing": true,
                "serverSide": true,
                "ordering" : true,
                "searching" : false,
                "columnDefs": [
                    { "orderable": false, "targets": [0,4,6,7] }
                ],
                "ajax": {
                    "url": "stock_request_changes.php",
                    "type": "POST",
                    "data": function(d) {
                        if(jQuery('#search_text').length > 0) {
                            d.search_text = jQuery('#search_text').val();
                        }
                        if(jQuery('input[name="filter_from_date"]').length > 0) {
                            d.filter_from_date = jQuery('input[name="filter_from_date"]').val();
                        }
                        if(jQuery('input[name="filter_to_date"]').length > 0) {
                            d.filter_to_date = jQuery('input[name="filter_to_date"]').val();
                        }
                        if(jQuery('select[name="filter_godown_id"]').length > 0) {
                            d.filter_godown_id = jQuery('select[name="filter_godown_id"]').val();
                        }
                        if(jQuery('select[name="filter_factory_id"]').length > 0) {
                            d.filter_factory_id = jQuery('select[name="filter_factory_id"]').val();
                        }
                        if(jQuery('input[name="show_cancel_'+tableId+'"]').length > 0) {
                            d.cancel = jQuery('input[name="show_cancel_'+tableId+'"]').val();
                        }
                        if(jQuery('input[name="show_deliveried_'+tableId+'"]').length > 0) {
                            d.is_deliveried = jQuery('input[name="show_deliveried_'+tableId+'"]').val();
                        }
                    }
                },
                "columns": [
                    { "data": "sno", "className": "text-center" },
                    { "data": "bill_date", "className": "text-center" },
                    { "data": "stock_request_number", "className": "text-center" },
                    { "data": "godown_name", "className": "text-center" },
                    { "data": "pending_qty", "className": "text-center" },
                    { "data": "total_quantity", "className": "text-center" },
                    { "data": "view", "className": "text-center" },
                    { "data": "action", "className": "text-center" }
                ]
            });
        }
    }

    // Initial load for active tab
    jQuery(document).ready(function() {
        if(jQuery('.tab-pane.active .datatable').length > 0) {
            var initialTableId = jQuery('.tab-pane.active .datatable').attr('id');
            initializeDataTableIfNeeded(initialTableId);
        }

        // On tab change
        if(jQuery('button[data-bs-toggle="pill"]').length > 0) {
            jQuery('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
                var targetPaneId = jQuery(e.target).attr('data-bs-target'); // e.g., "#pills-draft"
                var tableId = jQuery(targetPaneId).find('.datatable').attr('id');
                initializeDataTableIfNeeded(tableId);
            });
        }

        if(jQuery('#search_text').length > 0) {
            jQuery('#search_text').on('keyup', function() {
                if(jQuery('.tab-pane.active .datatable').length > 0) {
                    jQuery('.tab-pane.active .datatable').DataTable().ajax.reload();
                }
            });
        }
        if(jQuery('input[name="filter_from_date"]').length > 0) {
            jQuery('input[name="filter_from_date"]').on('change', function() {
                if(jQuery('.tab-pane.active .datatable').length > 0) {
                    jQuery('.tab-pane.active .datatable').DataTable().ajax.reload();
                }
            });
        }
        if(jQuery('input[name="filter_to_date"]').length > 0) {
            jQuery('input[name="filter_to_date"]').on('change', function() {
                if(jQuery('.tab-pane.active .datatable').length > 0) {
                    jQuery('.tab-pane.active .datatable').DataTable().ajax.reload();
                }
            });
        }
        if(jQuery('select[name="filter_godown_id"]').length > 0) {
            jQuery('select[name="filter_godown_id"]').on('change', function() {
                if(jQuery('.tab-pane.active .datatable').length > 0) {
                    jQuery('.tab-pane.active .datatable').DataTable().ajax.reload();
                }
            });
        }
        if(jQuery('select[name="filter_factory_id"]').length > 0) {
            jQuery('select[name="filter_factory_id"]').on('change', function() {
                if(jQuery('.tab-pane.active .datatable').length > 0) {
                    jQuery('.tab-pane.active .datatable').DataTable().ajax.reload();
                }
            });
        }
    });
</script>