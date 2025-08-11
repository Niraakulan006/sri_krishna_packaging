<?php
	/*require 'mailin_sms/sms_api.php';
	$GLOBALS['mailin_sms_api_key'] = "zaG0R7cJBhkUbf54";*/

	date_default_timezone_set('Asia/Calcutta');
	$GLOBALS['create_date_time_label'] = date('Y-m-d H:i:s');
	$GLOBALS['site_name_user_prefix'] = "skp_".date("d-m-Y"); $GLOBALS['user_id'] = ""; $GLOBALS['creator'] = "";
	$GLOBALS['creator_name'] = ""; $GLOBALS['bill_company_id'] = ""; $GLOBALS['null_value'] = "NULL";

	$GLOBALS['page_number'] = 1; $GLOBALS['page_limit'] = 10; $GLOBALS['page_limit_list'] = array("10", "25", "50", "100");

	$GLOBALS['backup_folder_name'] = 'backup';
	$GLOBALS['log_backup_file'] = $GLOBALS['backup_folder_name']."/logs/".date("Y").".csv"; 

	// Factory Id
    $GLOBALS['bill_company_id'] = '4d4451774f4449774d6a55774d5449774d6a5a664d44453d';
	$GLOBALS['max_user_count'] = 10; 
	$GLOBALS['max_role_count'] = 10; 
	$GLOBALS['max_godown_count'] = 10; 
	$GLOBALS['max_factory_count'] = 1;
	$GLOBALS['max_unit_count'] = 1;
		
	// Tables
	$GLOBALS['table_prefix'] = "sri_krishna_";
	$GLOBALS['user_table'] = $GLOBALS['table_prefix'].'user';
	$GLOBALS['login_table'] = $GLOBALS['table_prefix'].'login';
	$GLOBALS['role_table'] = $GLOBALS['table_prefix'].'role';
	$GLOBALS['gsm_table'] = $GLOBALS['table_prefix']."gsm";
	$GLOBALS['unit_table'] = $GLOBALS['table_prefix']."unit";
	$GLOBALS['size_table'] = $GLOBALS['table_prefix']."size";
	$GLOBALS['godown_table'] = $GLOBALS['table_prefix']."godown";
	$GLOBALS['factory_table'] = $GLOBALS['table_prefix']."factory";
	$GLOBALS['supplier_table'] = $GLOBALS['table_prefix']."supplier";
	$GLOBALS['bf_table'] = $GLOBALS['table_prefix']."bf";
	$GLOBALS['stock_table'] = $GLOBALS['table_prefix']."stock";
	$GLOBALS['inward_material_table'] = $GLOBALS['table_prefix']."inward_material";
	$GLOBALS['material_transfer_table'] = $GLOBALS['table_prefix']."material_transfer";
	$GLOBALS['consumption_entry_table'] = $GLOBALS['table_prefix']."consumption_entry";
	$GLOBALS['stock_adjustment_table'] = $GLOBALS['table_prefix']."stock_adjustment";
	$GLOBALS['stock_request_table'] = $GLOBALS['table_prefix']."stock_request";
	$GLOBALS['delivery_slip_table'] = $GLOBALS['table_prefix']."delivery_slip";
	$GLOBALS['inward_approval_table'] = $GLOBALS['table_prefix']."inward_approval";
	$GLOBALS['conversion_table'] = $GLOBALS['table_prefix']."conversion";
	
	// Modules
	$GLOBALS['size_module'] = "Size";
	$GLOBALS['bf_module'] = "BF";
	$GLOBALS['gsm_module'] = "GSM";
	$GLOBALS['unit_module'] = "Unit";
	$GLOBALS['brand_module'] = "Brand";
	$GLOBALS['godown_module'] = "Godown";
	$GLOBALS['supplier_module'] = "Supplier";
	$GLOBALS['inward_material_module'] = "Inward Material";
	$GLOBALS['material_transfer_module'] = "Material Transfer";
	$GLOBALS['consumption_entry_module'] = "Consumption Entry";
	$GLOBALS['stock_adjustment_module'] = "Stock Adjustment";
	$GLOBALS['stock_request_module'] = "Stock Request";
	$GLOBALS['delivery_slip_module'] = "Delivery Slip";
	$GLOBALS['inward_approval_module'] = "Inward Approval";
	$GLOBALS['reports_module'] = "Reports";

	$access_pages_list = array();
	$access_pages_list[] = $GLOBALS['size_module'];
	$access_pages_list[] = $GLOBALS['bf_module'];
	$access_pages_list[] = $GLOBALS['gsm_module'];
	$access_pages_list[] = $GLOBALS['unit_module'];
	$access_pages_list[] = $GLOBALS['godown_module'];
	$access_pages_list[] = $GLOBALS['supplier_module'];
	$access_pages_list[] = $GLOBALS['inward_material_module'];
	$access_pages_list[] = $GLOBALS['material_transfer_module'];
	$access_pages_list[] = $GLOBALS['stock_request_module'];
	$access_pages_list[] = $GLOBALS['delivery_slip_module'];
	$access_pages_list[] = $GLOBALS['inward_approval_module'];
	$access_pages_list[] = $GLOBALS['consumption_entry_module'];
	$access_pages_list[] = $GLOBALS['stock_adjustment_module'];
	$access_pages_list[] = $GLOBALS['reports_module'];

	$GLOBALS['user_access_pages'] = $access_pages_list;

	$GLOBALS['Reset_to_one'] = "Reset To 1"; $GLOBALS['continue_last_number'] = "Continue from last number"; $GLOBALS['custom_number'] = "Custom Number";
	
	$GLOBALS['admin_user_type'] = "Super Admin"; $GLOBALS['staff_user_type'] = "Staff";

	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		$GLOBALS['creator'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
	}
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name'])) {
		$GLOBALS['creator_name'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_name'];
	}
	if(!empty($_SESSION['bill_company_id']) && isset($_SESSION['bill_company_id'])) {
		$GLOBALS['bill_company_id'] = $_SESSION['bill_company_id'];
	}
	$stock_action_plus = "Plus"; $stock_action_minus = "Minus";
?>