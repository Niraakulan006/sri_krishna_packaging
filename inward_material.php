<?php 
	$page_title = "Inward Material";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');
    $supplier_list = array();
    $supplier_list = $obj->
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php include "link_style_script.php"; ?>
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
                                                <input type="date" name="from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" onchange="Javascript:checkDateCheck();" placeholder="">
                                                <label>From Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border pb-2">
                                                <input type="date" name="to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:checkDateCheck();" placeholder="">
                                                <label>To Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-6 ms-auto">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search_text" id="search_text" style="height:34px;" placeholder="Search By Bill No." aria-label="Search" aria-describedby="basic-addon2">
                                            <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-4">
                                        <button class="btn btn-danger float-end" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                    </div>
                                </div>
                            </div>
                            <div id="table_listing_records" class="table-responsive">
                                <table id="datatable" class="table nowrap cursor text-center smallfnt table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date & Bill No</th>
                                            <th>Supplier</th>
                                            <th>Location</th>
                                            <th>Reel Size</th>
                                            <th>GSM</th>
                                            <th>QTY</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
        jQuery("#inwardmaterial").addClass("active");

        if(jQuery('#datatable').length > 0) {
            var table = jQuery('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering" : true,
                "searching" : false,
                "columnDefs": [
                    { "orderable": false, "targets": [0,7] }
                ],
                "ajax": {
                    "url": "inward_material_changes.php",
                    "type": "POST",
                    "data": function(d) {
                        if(jQuery('#search_text').length > 0) {
                            d.search_text = jQuery('#search_text').val();
                        }
                        if(jQuery('input[name="from_date"]').length > 0) {
                            d.from_date = jQuery('input[name="from_date"]').val();
                        }
                        if(jQuery('input[name="to_date"]').length > 0) {
                            d.to_date = jQuery('input[name="to_date"]').val();
                        }
                        if(jQuery('select[name="filter_client_id"]').length > 0) {
                            d.filter_client_id = jQuery('select[name="filter_client_id"]').val();
                        }
                    }
                },
                "columns": [
                    { "data": "sno", "className": "text-center" },
                    { "data": "quotation_number", "className": "text-center" },
                    { "data": "quotation_date", "className": "text-center" },
                    { "data": "company_name", "className": "text-center" },
                    { "data": "bill_total", "className": "text-center" },
                    { "data": "action", "className": "text-center" }
                ]
            });

            if(jQuery('#search_text').length > 0) {
                jQuery('#search_text').on('keyup', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('input[name="from_date"]').length > 0) {
                jQuery('input[name="from_date"]').on('change', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('input[name="to_date"]').length > 0) {
                jQuery('input[name="to_date"]').on('change', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('select[name="filter_client_id"]').length > 0) {
                jQuery('select[name="filter_client_id"]').on('change', function() {
                    table.ajax.reload();
                });
            }
        }
    });
</script>