<?php
	include("basic_functions.php");
	include("creation_functions.php");
	include("stock_functions.php");
	include("conversion_functions.php");
	include("report_functions.php");
	include("barcode/vendor/autoload.php");
	
	class billing extends Basic_Functions {
		
		// Basic Functions
		public function getProjectTitle() {
			$string = parent::getProjectTitle();
			return $string;
		}
		public function encode_decode($action, $string) {
			$string = parent::encode_decode($action, $string);
			return $string;
		}		
		public function InsertSQL($table, $columns, $values, $custom_id, $unique_number, $action) {
			$last_insert_id = "";		
			$last_insert_id = parent::InsertSQL($table, $columns, $values, $custom_id, $unique_number, $action);
			return $last_insert_id;
		}	
		public function UpdateSQL($table, $update_id, $columns, $values, $action) {
			$msg = "";		
			$msg = parent::UpdateSQL($table, $update_id, $columns, $values, $action);
			return $msg;
		}
		public function getTableColumnValue($table, $column, $value, $return_value) {
			$result = "";
			$result = parent::getTableColumnValue($table, $column, $value, $return_value);
			return $result;
		}
		public function getTableRecords($table, $column, $value) {
			$result = "";		
			$result = parent::getTableRecords($table, $column, $value);
			return $result;
		}
		public function daily_db_backup() {
			$result = "";		
			$result = parent::daily_db_backup();
			return $result;
		}
		public function image_directory() {
			$target_dir = "";		
			$target_dir = parent::image_directory();
			return $target_dir;
		}
		public function barcode_directory() {
			$target_dir = "";		
			$target_dir = parent::barcode_directory();
			return $target_dir;
		}
		public function CreateBarcode($size_name, $gsm_name, $bf_name, $supplier_id,$size_id, $gsm_id, $bf_id) {
			$res = "";		
			$res = parent::CreateBarcode($size_name, $gsm_name, $bf_name, $supplier_id,$size_id, $gsm_id, $bf_id);
			return $res;
		}
		public function temp_image_directory() {
			$temp_dir = "";		
			$temp_dir = parent::temp_image_directory();
			return $temp_dir;
		}
		public function clear_temp_image_directory() {
			$res = "";		
			$res = parent::clear_temp_image_directory();
			return $res;
		}
		public function check_user_id_ip_address() {
			$check_login_id = "";			
			$check_login_id = parent::check_user_id_ip_address();			
			return $check_login_id;	
		}
		public function checkUser() {
			$login_user_id = "";			
			$login_user_id = parent::checkUser();			
			return $login_user_id;	
		}
		public function getDailyReport($from_date, $to_date) {
			$list = array();
			$list = parent::getDailyReport($from_date, $to_date);
			return $list;
		}
		public function send_mobile_details($phone_number, $msg) {
			$res = "";
			$res = parent::send_mobile_details($phone_number, $msg);
			return true;
		}		
		public function automate_number($table, $column) {
			$next_number = "";
			$next_number = parent::automate_number($table, $column);
			return $next_number;
		}	
		public function CompanyCount() {
			$list = 0;
			$list = parent::CompanyCount();
			return $list;
		}
		public function getOtherCityList($district) {
			$list = array();
			$list = parent::getOtherCityList($district);
			return $list;
		}
		public function CheckRoleAccessPage($role_id,$permission_page) {
			$access = "";
			$access = parent::CheckRoleAccessPage($role_id,$permission_page);
			return $access;
		}
		public function getAllRecords($table, $column, $value) {
			$list = array();
			$list = parent::getAllRecords($table, $column,$value);
			return $list;
		}

		// Creation Functions
		public function creation_function_object() {
			$create_obj = "";		
			$create_obj = new Creation_functions();
			return $create_obj;
		}
		public function CheckUnitAlreadyExists($company_id, $unit_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckUnitAlreadyExists($company_id, $unit_name);
			return $result;
		}	
		public function CheckGSMAlreadyExists($company_id, $gsm) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckGSMAlreadyExists($company_id, $gsm);
			return $result;
		}
		public function CheckGodownAlreadyExists($company_id, $godown_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckGodownAlreadyExists($company_id, $godown_name);
			return $result;
		}
		public function GetLinkedCount($table, $creation_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$count = 0;
			$count = $create_obj->GetLinkedCount($table, $creation_id);
			return $count;
		}	
		public function CheckSizeAlreadyExists($company_id, $size) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckSizeAlreadyExists($company_id, $size);
			return $result;
		}	
		public function CheckBFAlreadyExists($company_id, $bf) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckBFAlreadyExists($company_id, $bf);
			return $result;
		}
		public function CheckGodownAlreadyExist($lowercase_name_location) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckGodownAlreadyExist($lowercase_name_location);
			return $result;
		}
		public function getInwardMaterialList($row, $rowperpage, $searchValue, $from_date, $to_date, $supplier_id, $cancelled, $login_godown_id, $order_column, $order_direction) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getInwardMaterialList($row, $rowperpage, $searchValue, $from_date, $to_date, $supplier_id, $cancelled, $login_godown_id, $order_column, $order_direction);
			return $result;
		}
		public function getMaterialTransferList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $order_column, $order_direction) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getMaterialTransferList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $order_column, $order_direction);
			return $result;
		}
		public function getConsumptionEntryList($row, $rowperpage, $searchValue, $from_date, $to_date, $cancelled, $order_column, $order_direction) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getConsumptionEntryList($row, $rowperpage, $searchValue, $from_date, $to_date, $cancelled, $order_column, $order_direction);
			return $result;
		}
		public function getStockAdjustmentList($row, $rowperpage, $searchValue, $from_date, $to_date, $cancelled, $login_godown_id, $order_column, $order_direction) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getStockAdjustmentList($row, $rowperpage, $searchValue, $from_date, $to_date, $cancelled, $login_godown_id, $order_column, $order_direction);
			return $result;
		}
		public function CreateCustomMaterial($material, $material_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CreateCustomMaterial($material, $material_id);
			return $result;
		}
		public function getStockRequestList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $is_deliveried, $order_column, $order_direction) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getStockRequestList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $is_deliveried, $order_column, $order_direction);
			return $result;
		}
		public function getDeliverySlipList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $is_approved, $order_column, $order_direction) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getDeliverySlipList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $is_approved, $order_column, $order_direction);
			return $result;
		}
		public function getInwardApprovalList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $order_column, $order_direction) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getInwardApprovalList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $order_column, $order_direction);
			return $result;
		}
		public function MonthwiseChart() {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->MonthwiseChart();
			return $result;
		}
		public function LocationVariationChart() {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->LocationVariationChart();
			return $result;
		}
		public function getStockPercentage() {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getStockPercentage();
			return $result;
		}

		// Stock Functions
		public function stock_function_object() {
			$stock_obj = "";		
			$stock_obj = new Stock_functions();
			return $stock_obj;
		}
		public function getStockUniqueID($bill_unique_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->getStockUniqueID($bill_unique_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id);
			return $stock_update;
		}
		public function getInwardUnitQty($from_date, $to_date, $bill_unique_id, $supplier_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->getInwardUnitQty($from_date, $to_date, $bill_unique_id, $supplier_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id);
			return $stock_update;
		}
		public function getOutwardUnitQty($from_date, $to_date, $bill_unique_id, $supplier_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->getOutwardUnitQty($from_date, $to_date, $bill_unique_id, $supplier_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id);
			return $stock_update;
		}
		public function PrevStockList($bill_unique_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->PrevStockList($bill_unique_id);
			return $stock_update;
		}
		public function StockUpdate($page_table, $in_out_type, $supplier_id, $bill_unique_id, $bill_unique_number, $remarks, $stock_date, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id, $quantity){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->StockUpdate($page_table, $in_out_type, $supplier_id, $bill_unique_id, $bill_unique_number, $remarks, $stock_date, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id, $quantity);
			return $stock_update;
		}
		public function DeleteBillStock($table, $bill_id){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->DeleteBillStock($table, $bill_id);
			return $stock_update;
		}
		public function DeletePrevList($bill_id, $stock_unique_ids){
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = 0;
			$stock_update = $stock_obj->DeletePrevList($bill_id, $stock_unique_ids);
			return $stock_update;
		}
		public function GetCurrentStockByMaterial($material, $bill_id, $godown_id, $factory_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$result = "";
			$result = $stock_obj->GetCurrentStockByMaterial($material, $bill_id, $godown_id, $factory_id);
			return $result;
		}
		public function ShowCurrentStock($godown_id, $factory_id, $size_id, $gsm_id, $bf_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = "";
			$stock_update = $stock_obj->ShowCurrentStock($godown_id, $factory_id, $size_id, $gsm_id, $bf_id);
			return $stock_update;
		}

		// Conversion Functions
		public function conversion_function_object() {
			$conversion_obj = "";		
			$conversion_obj = new Conversion_functions();
			return $conversion_obj;
		}
		public function ConversionUpdate($table, $bill_date, $bill_id, $bill_number, $conversion_id, $conversion_number, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id, $request_qty, $delivery_qty, $inward_qty) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->ConversionUpdate($table, $bill_date, $bill_id, $bill_number, $conversion_id, $conversion_number, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id, $request_qty, $delivery_qty, $inward_qty);
			return $conversion_update;
		}
		public function getConversionUniqueID($bill_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->getConversionUniqueID($bill_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id);
			return $conversion_update;
		}
		public function PrevConversionList($bill_id) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->PrevConversionList($bill_id);
			return $conversion_update;
		}
		public function DeleteConversionList($bill_id, $conversion_unique_ids) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->DeleteConversionList($bill_id, $conversion_unique_ids);
			return $conversion_update;
		}
		public function GetPrevRequestQty($bill_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->GetPrevRequestQty($bill_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id);
			return $conversion_update;
		}
		public function GetOtherDeliveryQty($bill_id, $conversion_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->GetOtherDeliveryQty($bill_id, $conversion_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id);
			return $conversion_update;
		}
		public function CheckRequestDeliveried($stock_request_id) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->CheckRequestDeliveried($stock_request_id);
			return $conversion_update;
		}
		public function GetPrevDeliveryQty($bill_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->GetPrevDeliveryQty($bill_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id);
			return $conversion_update;
		}
		public function GetOtherInwardQty($bill_id, $conversion_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->GetOtherInwardQty($bill_id, $conversion_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id);
			return $conversion_update;
		}
		public function CheckDeliveryApproved($delivery_slip_id) {
			$conversion_obj = "";
			$conversion_obj = $this->conversion_function_object();
			$conversion_update = "";
			$conversion_update = $conversion_obj->CheckDeliveryApproved($delivery_slip_id);
			return $conversion_update;
		}

		// Report Functions
		public function report_function_object() {
			$report_obj = "";		
			$report_obj = new report_functions();
			return $report_obj;
		}
		public function getCurrentStockList($location_type,$factory_id, $godown_id,$size_id,$gsm_id,$bf_id,$from_date,$to_date) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$report_update = "";
			$report_update = $report_obj->getCurrentStockList($location_type,$factory_id, $godown_id,$size_id,$gsm_id,$bf_id,$from_date,$to_date);
			return $report_update;
		}
		public function getConsumptionStockReport($from_date,$to_date,$size_id,$gsm_id,$bf_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$report_update = "";
			$report_update = $report_obj->getConsumptionStockReport($from_date,$to_date,$size_id,$gsm_id,$bf_id);
			return $report_update;
		}
		public function getSupplierReport($supplier_id, $from_date, $to_date, $login_godown_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$report_update = "";
			$report_update = $report_obj->getSupplierReport($supplier_id, $from_date, $to_date, $login_godown_id);
			return $report_update;
		}
	}
?>