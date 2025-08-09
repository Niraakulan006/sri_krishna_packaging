<?php 
	$page_title = "Stock Adjustment";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
        <?php include "link_style_script.php"; ?>
        <script type="text/javascript" src="include/js/stock_adjustment.js"></script>
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
                                    <form name="table_listing_form" method="post">
                                        <div class="row justify-content-end p-2">
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <div class="form-group pb-1">
                                                    <div class="form-label-group in-border pb-1">
                                                        <input type="date" name="filter_from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" onchange="Javascript:checkDateCheck();" placeholder="">
                                                        <label>From Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-6">
                                                <div class="form-group pb-1">
                                                    <div class="form-label-group in-border pb-1">
                                                        <input type="date" name="filter_to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:checkDateCheck();" placeholder="">
                                                        <label>To Date</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search_text" id="search_text" style="height:34px;" placeholder="Search By Bill No." aria-label="Search" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-4">
                                                <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        
                                <div id="table_listing_records">
                                    <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                    <div class="new">
                                        <ul class="new nav nav-pills my-3 justify-content-center" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-active-tab" data-bs-toggle="pill" data-bs-target="#pills-active" type="button" role="tab" aria-controls="pills-active" aria-selected="true">Active Bill</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-cancel-tab" data-bs-toggle="pill" data-bs-target="#pills-cancel" type="button" role="tab" aria-controls="pills-cancel" aria-selected="false">Cancelled Bill</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-active" role="tabpanel" aria-labelledby="pills-active-tab" tabindex="0">
                                                <?php 
                                                    $cancelled = 0;
                                                    $id = "table-active";
                                                    include("stock_adjustment_table.php"); 
                                                ?>
                                            </div>
                                            <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab" tabindex="0">
                                                <?php 
                                                    $cancelled = 1;
                                                    $id = "table-cancel";
                                                    include("stock_adjustment_table.php"); 
                                                ?>
                                            </div>
                                        </div>
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
        $("#stockadjustment").addClass("active");
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
                    { "orderable": false, "targets": [0,4,5] }
                ],
                "ajax": {
                    "url": "stock_adjustment_changes.php",
                    "type": "POST",
                    "data": function(d) {
                        if(jQuery('input[name="show_cancel_'+tableId+'"]').length > 0) {
                            d.cancel = jQuery('input[name="show_cancel_'+tableId+'"]').val();
                        }
                        if(jQuery('#search_text').length > 0) {
                            d.search_text = jQuery('#search_text').val();
                        }
                        if(jQuery('input[name="filter_from_date"]').length > 0) {
                            d.filter_from_date = jQuery('input[name="filter_from_date"]').val();
                        }
                        if(jQuery('input[name="filter_to_date"]').length > 0) {
                            d.filter_to_date = jQuery('input[name="filter_to_date"]').val();
                        }
                    }
                },
                "columns": [
                    { "data": "sno", "className": "text-center" },
                    { "data": "stock_adjustment_date", "className": "text-center" },
                    { "data": "stock_adjustment_number", "className": "text-center" },
                    { "data": "total_quantity", "className": "text-center" },
                    { "data": "view", "className": "text-center" },
                    { "data": "action", "className": "text-center" }
                ]
            });
        }
    }

    // Initial load for active tab
    $(document).ready(function() {
        var initialTableId = jQuery('.tab-pane.active .datatable').attr('id');
        initializeDataTableIfNeeded(initialTableId);

        // On tab change
        jQuery('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
            var targetPaneId = jQuery(e.target).attr('data-bs-target'); // e.g., "#pills-draft"
            var tableId = jQuery(targetPaneId).find('.datatable').attr('id');
            initializeDataTableIfNeeded(tableId);
        });

        if(jQuery('#search_text').length > 0) {
            jQuery('#search_text').on('keyup', function() {
                jQuery('.tab-pane.active .datatable').DataTable().ajax.reload();
            });
        }
        if(jQuery('input[name="filter_from_date"]').length > 0) {
            jQuery('input[name="filter_from_date"]').on('change', function() {
                jQuery('.tab-pane.active .datatable').DataTable().ajax.reload();
            });
        }
        if(jQuery('input[name="filter_to_date"]').length > 0) {
            jQuery('input[name="filter_to_date"]').on('change', function() {
                jQuery('.tab-pane.active .datatable').DataTable().ajax.reload();
            });
        }
    });
</script>