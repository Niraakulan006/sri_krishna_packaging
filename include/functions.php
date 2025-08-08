<?php
	include("basic_functions.php");
	include("creation_functions.php");
	include("stock_functions.php");
	
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
		public function GetRoleLinkedCount($role_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->GetRoleLinkedCount($role_id);
			return $result;
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
		public function GetLinkedCount($delete_id, $table, $column) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$count = 0;
			$count = $create_obj->GetLinkedCount($delete_id, $table, $column);
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
		public function GetGodownLinkedCount($godown_id) {
          $create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetGodownLinkedCount($godown_id);
			return $result;
		}
		public function getInwardMaterialList($row, $rowperpage, $searchValue, $from_date, $to_date, $supplier_id, $cancelled, $order_column, $order_direction) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getInwardMaterialList($row, $rowperpage, $searchValue, $from_date, $to_date, $supplier_id, $cancelled, $order_column, $order_direction);
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

		public function getCurrentStock($table, $factory_id, $size_id, $gsm_id,$bf_id) {
			$stock_obj = "";
			$stock_obj = $this->stock_function_object();
			$stock_update = "";
			$stock_update = $stock_obj->getCurrentStock($table, $factory_id, $size_id, $gsm_id,$bf_id);
			return $stock_update;
		}

		public function getConsumptionEntryList($row, $rowperpage, $searchValue, $from_date, $to_date, $cancelled, $order_column, $order_direction) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->getConsumptionEntryList($row, $rowperpage, $searchValue, $from_date, $to_date, $cancelled, $order_column, $order_direction);
			return $result;
		}
	}
?>