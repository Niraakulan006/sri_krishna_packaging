<?php 
    class Creation_functions extends Basic_Functions {
        public function CheckUnitAlreadyExists($company_id, $unit_name) {
			$list = array(); $select_query = ""; $unit_id = ""; $where = "";
			// if(!empty($company_id)) {
			// 	$where = " bill_company_id = '".$company_id."' AND ";
			// }
			if(!empty($unit_name)) {
				$select_query = "SELECT unit_id FROM ".$GLOBALS['unit_table']." WHERE ".$where." lower_case_name = '".$unit_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['unit_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['unit_id'])) {
							$unit_id = $data['unit_id'];
						}
					}
				}
			}
			return $unit_id;
		}    
        public function CheckGSMAlreadyExists($company_id, $gsm) {
			$list = array(); $select_query = ""; $gsm_id = ""; $where = "";
			// if(!empty($company_id)) {
			// 	$where = " bill_company_id = '".$company_id."' AND ";
			// }
			if(!empty($gsm)) {
				$select_query = "SELECT gsm_id FROM ".$GLOBALS['gsm_table']." WHERE ".$where." gsm_name = '".$gsm."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['gsm_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['gsm_id'])) {
							$gsm_id = $data['gsm_id'];
						}
					}
				}
			}
			return $gsm_id;
		} 
        public function CheckGodownAlreadyExists($company_id, $godown_name) {
			$list = array(); $select_query = ""; $godown_id = ""; $where = "";
			if(!empty($bill_company_id)) {
				$where = " bill_company_id = '".$company_id."' AND ";
			}
			if(!empty($godown_name)) {
				$select_query = "SELECT godown_id FROM ".$GLOBALS['godown_table']." WHERE ".$where." lower_case_name = '".$godown_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['godown_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['godown_id'])) {
							$godown_id = $data['godown_id'];
						}
					}
				}
			}
			return $godown_id;
		} 
		public function CheckSizeAlreadyExists($company_id, $size) {
			$list = array(); $select_query = ""; $size_id = ""; $where = "";
			// if(!empty($company_id)) {
			// 	$where = " bill_company_id = '".$company_id."' AND ";
			// }
			if(!empty($size)) {
				$select_query = "SELECT size_id FROM ".$GLOBALS['size_table']." WHERE ".$where." size_name = '".$size."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['size_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['size_id'])) {
							$size_id = $data['size_id'];
						}
					}
				}
			}
			return $size_id;
		}
		public function CheckBFAlreadyExists($company_id, $bf) {
			$list = array(); $select_query = ""; $bf_id = ""; $where = "";
			// if(!empty($company_id)) {
			// 	$where = " bill_company_id = '".$company_id."' AND ";
			// }
			if(!empty($bf)) {
				$select_query = "SELECT bf_id FROM ".$GLOBALS['bf_table']." WHERE ".$where." bf_name = '".$bf."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['bf_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['bf_id'])) {
							$bf_id = $data['bf_id'];
						}
					}
				}
			}
			return $bf_id;
		}
		public function CheckGodownAlreadyExist($lowercase_name_location) {
			$list = array(); $select_query = ""; $godown_id = ""; $where = "";
		
			if(!empty($lowercase_name_location)) {
				$select_query = "SELECT godown_id FROM ".$GLOBALS['godown_table']." WHERE ".$where." lowercase_name_location = '".$lowercase_name_location."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['godown_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['godown_id'])) {
							$godown_id = $data['godown_id'];
						}
					}
				}
			}
			return $godown_id;
		}
        public function GetLinkedCount($table, $creation_id) {
			$list = array(); $select_query = ""; $where = ""; $count = 0;
			$linked_tables = array(); $linked_query = ""; $field_id = ""; $cancelled_where = "";
			if($table == $GLOBALS['role_table']) {
				$linked_tables = array($GLOBALS['user_table'], $GLOBALS['godown_table']);
				$field_id = "role_id";
			}
			else if($table == $GLOBALS['size_table'] || $table == $GLOBALS['gsm_table'] || $table == $GLOBALS['bf_table']) {
				$linked_tables = array($GLOBALS['inward_material_table'], $GLOBALS['material_transfer_table'], $GLOBALS['stock_adjustment_table'], $GLOBALS['stock_request_table'], $GLOBALS['delivery_slip_table'], $GLOBALS['inward_approval_table'], $GLOBALS['consumption_entry_table']);
				if($table == $GLOBALS['size_table']) {
					$field_id = "size_id";
				}
				else if($table == $GLOBALS['gsm_table']) {
					$field_id = "gsm_id";
				}
				else if($table == $GLOBALS['bf_table']) {
					$field_id = "bf_id";
				}
				$cancelled_where = " AND cancelled = '0'";
			}
			else if($table == $GLOBALS['godown_table']) {
				$linked_tables = array($GLOBALS['inward_material_table'], $GLOBALS['material_transfer_table'], $GLOBALS['stock_adjustment_table'], $GLOBALS['stock_request_table'], $GLOBALS['delivery_slip_table'], $GLOBALS['inward_approval_table']);
				$field_id = "godown_id";
				$cancelled_where = " AND cancelled = '0'";
			}
			else if($table == $GLOBALS['supplier_table']) {
				$linked_tables = array($GLOBALS['inward_material_table']);
				$field_id = "supplier_id";
				$cancelled_where = " AND cancelled = '0'";
			}
			if(!empty($linked_tables)) {
				for($i=0; $i < count($linked_tables); $i++) {
					if(!empty($linked_query)) {
						$linked_query = $linked_query." UNION ALL (SELECT COUNT(id) as id_count FROM ".$linked_tables[$i]." WHERE FIND_IN_SET('".$creation_id."', ".$field_id.") ".$cancelled_where." AND deleted = '0')";
					}
					else {
						$linked_query = "(SELECT COUNT(id) as id_count FROM ".$linked_tables[$i]." WHERE FIND_IN_SET('".$creation_id."', ".$field_id.") ".$cancelled_where." AND deleted = '0')";
					}
				}
			}
			if(!empty($linked_query)) {
				$select_query = "SELECT id_count FROM (".$linked_query.") as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function getInwardMaterialList($row, $rowperpage, $searchValue, $from_date, $to_date, $supplier_id, $cancelled, $order_column, $order_direction) {
			$select_query = ""; $list = array(); $where = ""; $order_by_query = "";
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." bill_date >= '".$from_date."' AND ";
				}
				else {
					$where = " bill_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." bill_date <= '".$to_date."' AND ";
				}
				else {
					$where = " bill_date <= '".$to_date."' AND ";
				}
			}
			if(!empty($supplier_id)) {
				if(!empty($where)) {
					$where = $where." supplier_id = '".$supplier_id."' AND ";
				}
				else {
					$where = " supplier_id = '".$supplier_id."' AND ";
				}
			}
			if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." (CAST(FROM_BASE64(UNHEX(bill_number)) AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " (CAST(FROM_BASE64(UNHEX(bill_number)) AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
			}
			if(!empty($order_column) && !empty($order_direction)) {
				if ($order_column == 'bill_number' || $order_column == 'supplier_name') {
					$order_by_query = "ORDER BY CAST(FROM_BASE64(UNHEX(".$order_column.")) AS CHAR) ".$order_direction;
				} 
				else {
					$order_by_query = "ORDER BY ".$order_column." ".$order_direction;
				}
			}
			else {
				$order_by_query = "ORDER BY id DESC";
			}

			if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['inward_material_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['inward_material_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['inward_material_table'], $select_query);
			return $list;
		}
		public function getMaterialTransferList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $order_column, $order_direction) {
			$select_query = ""; $list = array(); $where = ""; $order_by_query = "";
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." bill_date >= '".$from_date."' AND ";
				}
				else {
					$where = " bill_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." bill_date <= '".$to_date."' AND ";
				}
				else {
					$where = " bill_date <= '".$to_date."' AND ";
				}
			}
			if(!empty($factory_id)) {
				if(!empty($where)) {
					$where = $where." factory_id = '".$factory_id."' AND ";
				}
				else {
					$where = " factory_id = '".$factory_id."' AND ";
				}
			}
			if(!empty($godown_id)) {
				if(!empty($where)) {
					$where = $where." godown_id = '".$godown_id."' AND ";
				}
				else {
					$where = " godown_id = '".$godown_id."' AND ";
				}
			}
			if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." (CAST(material_transfer_number AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " (CAST(material_transfer_number AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
			}
			if(!empty($order_column) && !empty($order_direction)) {
				if ($order_column == 'godown_name') {
					$order_by_query = "ORDER BY CAST(FROM_BASE64(UNHEX(".$order_column.")) AS CHAR) ".$order_direction;
				} 
				else {
					$order_by_query = "ORDER BY ".$order_column." ".$order_direction;
				}
			}
			else {
				$order_by_query = "ORDER BY id DESC";
			}

			if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['material_transfer_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['material_transfer_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['material_transfer_table'], $select_query);
			return $list;
		}
		public function getStockRequestList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $is_deliveried, $order_column, $order_direction) {
			$select_query = ""; $list = array(); $where = ""; $order_by_query = "";
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." bill_date >= '".$from_date."' AND ";
				}
				else {
					$where = " bill_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." bill_date <= '".$to_date."' AND ";
				}
				else {
					$where = " bill_date <= '".$to_date."' AND ";
				}
			}
			if(!empty($factory_id)) {
				if(!empty($where)) {
					$where = $where." factory_id = '".$factory_id."' AND ";
				}
				else {
					$where = " factory_id = '".$factory_id."' AND ";
				}
			}
			if(!empty($godown_id)) {
				if(!empty($where)) {
					$where = $where." godown_id = '".$godown_id."' AND ";
				}
				else {
					$where = " godown_id = '".$godown_id."' AND ";
				}
			}
			if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." (CAST(stock_request_number AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " (CAST(stock_request_number AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
			}
			if(!empty($order_column) && !empty($order_direction)) {
				if ($order_column == 'godown_name') {
					$order_by_query = "ORDER BY CAST(FROM_BASE64(UNHEX(".$order_column.")) AS CHAR) ".$order_direction;
				} 
				else {
					$order_by_query = "ORDER BY ".$order_column." ".$order_direction;
				}
			}
			else {
				$order_by_query = "ORDER BY id DESC";
			}

			if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['stock_request_table']."
							WHERE ".$where." is_deliveried = '".$is_deliveried."' AND cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['stock_request_table']."
							WHERE ".$where." is_deliveried = '".$is_deliveried."' AND cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['stock_request_table'], $select_query);
			return $list;
		}
		public function getDeliverySlipList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $is_approved, $order_column, $order_direction) {
			$select_query = ""; $list = array(); $where = ""; $order_by_query = "";
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." bill_date >= '".$from_date."' AND ";
				}
				else {
					$where = " bill_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." bill_date <= '".$to_date."' AND ";
				}
				else {
					$where = " bill_date <= '".$to_date."' AND ";
				}
			}
			if(!empty($factory_id)) {
				if(!empty($where)) {
					$where = $where." factory_id = '".$factory_id."' AND ";
				}
				else {
					$where = " factory_id = '".$factory_id."' AND ";
				}
			}
			if(!empty($godown_id)) {
				if(!empty($where)) {
					$where = $where." godown_id = '".$godown_id."' AND ";
				}
				else {
					$where = " godown_id = '".$godown_id."' AND ";
				}
			}
			if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." (CAST(delivery_slip_number AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " (CAST(delivery_slip_number AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
			}
			if(!empty($order_column) && !empty($order_direction)) {
				if ($order_column == 'godown_name') {
					$order_by_query = "ORDER BY CAST(FROM_BASE64(UNHEX(".$order_column.")) AS CHAR) ".$order_direction;
				} 
				else {
					$order_by_query = "ORDER BY ".$order_column." ".$order_direction;
				}
			}
			else {
				$order_by_query = "ORDER BY id DESC";
			}

			if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['delivery_slip_table']."
							WHERE ".$where." is_approved = '".$is_approved."' AND cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['delivery_slip_table']."
							WHERE ".$where." is_approved = '".$is_approved."' AND cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['delivery_slip_table'], $select_query);
			return $list;
		}
		public function getInwardApprovalList($row, $rowperpage, $searchValue, $from_date, $to_date, $factory_id, $godown_id, $cancelled, $order_column, $order_direction) {
			$select_query = ""; $list = array(); $where = ""; $order_by_query = "";
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." bill_date >= '".$from_date."' AND ";
				}
				else {
					$where = " bill_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." bill_date <= '".$to_date."' AND ";
				}
				else {
					$where = " bill_date <= '".$to_date."' AND ";
				}
			}
			if(!empty($factory_id)) {
				if(!empty($where)) {
					$where = $where." factory_id = '".$factory_id."' AND ";
				}
				else {
					$where = " factory_id = '".$factory_id."' AND ";
				}
			}
			if(!empty($godown_id)) {
				if(!empty($where)) {
					$where = $where." godown_id = '".$godown_id."' AND ";
				}
				else {
					$where = " godown_id = '".$godown_id."' AND ";
				}
			}
			if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." (CAST(inward_approval_number AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " (CAST(inward_approval_number AS CHAR) LIKE '%".$searchValue."%') AND ";
				}
			}
			if(!empty($order_column) && !empty($order_direction)) {
				if ($order_column == 'godown_name') {
					$order_by_query = "ORDER BY CAST(FROM_BASE64(UNHEX(".$order_column.")) AS CHAR) ".$order_direction;
				} 
				else {
					$order_by_query = "ORDER BY ".$order_column." ".$order_direction;
				}
			}
			else {
				$order_by_query = "ORDER BY id DESC";
			}

			if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['inward_approval_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['inward_approval_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['inward_approval_table'], $select_query);
			return $list;
		}
		public function getConsumptionEntryList($row, $rowperpage, $searchValue, $from_date, $to_date, $cancelled, $order_column, $order_direction) {
			$select_query = ""; $list = array(); $where = ""; $order_by_query = "";
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." consumption_entry_date >= '".$from_date."' AND ";
				}
				else {
					$where = " consumption_entry_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." consumption_entry_date <= '".$to_date."' AND ";
				}
				else {
					$where = " consumption_entry_date <= '".$to_date."' AND ";
				}
			}
			if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." ((consumption_entry_number) LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " ((consumption_entry_number) LIKE '%".$searchValue."%') AND ";
				}
			}
			if(!empty($order_column) && !empty($order_direction)) {
				
				$order_by_query = "ORDER BY ".$order_column." ".$order_direction;
				
			}
			else {
				$order_by_query = "ORDER BY id DESC";
			}

			if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['consumption_entry_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['consumption_entry_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['consumption_entry_table'], $select_query);
			return $list;
		}
		public function getStockAdjustmentList($row, $rowperpage, $searchValue, $from_date, $to_date, $cancelled, $order_column, $order_direction) {
			$select_query = ""; $list = array(); $where = ""; $order_by_query = "";
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." stock_adjustment_date >= '".$from_date."' AND ";
				}
				else {
					$where = " stock_adjustment_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." stock_adjustment_date <= '".$to_date."' AND ";
				}
				else {
					$where = " stock_adjustment_date <= '".$to_date."' AND ";
				}
			}
			
			if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." ((stock_adjustment_number) LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " ((stock_adjustment_number) LIKE '%".$searchValue."%') AND ";
				}
			}
			if(!empty($order_column) && !empty($order_direction)) {
				$order_by_query = "ORDER BY ".$order_column." ".$order_direction;
			}
			else {
				$order_by_query = "ORDER BY id DESC";
			}

			if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['stock_adjustment_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['stock_adjustment_table']."
							WHERE ".$where." cancelled = '".$cancelled."' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['stock_adjustment_table'], $select_query);
			return $list;
		}
		public function CreateCustomMaterial($material, $material_id) {
			$new_created_id = "";
			$created_date_time = $GLOBALS['create_date_time_label'];
			$creator = $GLOBALS['creator'];
			$creator_name = $this->encode_decode('encrypt', $GLOBALS['creator_name']);
			$bill_company_id = $GLOBALS['bill_company_id'];
			$null_value = $GLOBALS['null_value'];
			$table = ""; $field_id = ""; $field_name = ""; $action = "";
			if($material == "size") {
				$table = $GLOBALS['size_table'];
				$field_id = "size_id";
				$field_name = "size_name";
				$action = "New Custom Size Created. Size - ".$this->encode_decode('decrypt', $material_id);
			}
			else if($material == "gsm") {
				$table = $GLOBALS['gsm_table'];
				$field_id = "gsm_id";
				$field_name = "gsm_name";
				$action = "New Custom GSM Created. GSM - ".$this->encode_decode('decrypt', $material_id);
			}
			else if($material == "bf") {
				$table = $GLOBALS['bf_table'];
				$field_id = "bf_id";
				$field_name = "bf_name";
				$action = "New Custom BF Created. BF - ".$this->encode_decode('decrypt', $material_id);
			}
			$columns = array(); $values = array();
			$columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', $field_id, $field_name, 'deleted');
			$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$material_id."'",  "'0'");

			$material_insert_id = $this->InsertSQL($table, $columns, $values, $field_id, '', $action);		
			if(preg_match("/^\d+$/", $material_insert_id)) {								
				$new_created_id = $this->getTableColumnValue($table, 'id', $material_insert_id, $field_id);
			}
			return $new_created_id;
		}
		public function MonthwiseChart() {
			$select_query = ""; $list = array(); $inward_data = array_fill(1, 12, 0); $outward_data = array_fill(1, 12, 0);
			$select_query = "SELECT MONTH(stock_date) as month, SUM(inward_unit) as inward, SUM(outward_unit) as outward FROM ".$GLOBALS['stock_table']." WHERE deleted = '0' GROUP BY MONTH(stock_date)";
			$list = $this->getQueryRecords('', $select_query);
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['inward']) && $data['inward'] != $GLOBALS['null_value']) {
						$inward_data[(int)$data['month']] = (int)$data['inward'];
					}
					if(!empty($data['outward']) && $data['outward'] != $GLOBALS['null_value']) {
						$outward_data[(int)$data['month']] = (int)$data['outward'];
					}
				}
			}
			return json_encode([
						"inward" => array_values($inward_data),
						"outward" => array_values($outward_data)
					]);
		}
		public function LocationVariationChart() {
			$distinct_query = ""; $distinct_list = array(); $variations = array();
			$distinct_query = "SELECT DISTINCT size_id, gsm_id, bf_id FROM ".$GLOBALS['stock_table']." WHERE deleted = '0' ORDER BY size_id, gsm_id, bf_id";
			$distinct_list = $this->getQueryRecords('', $distinct_query);
			if(!empty($distinct_list)) {
				foreach($distinct_list as $data) {
					if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value'] && !empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value'] && !empty($data['bf_id']) && $data['bf_id'] != $GLOBALS['null_value']) {
						$label = ""; $size_name = ""; $gsm_name = ""; $bf_name = ""; $size_value = ""; $gsm_value = ""; $bf_value = "";
						$size_name = $this->getTableColumnValue($GLOBALS['size_table'], 'size_id', $data['size_id'], 'size_name');
						if(!empty($size_name) && $size_name != $GLOBALS['null_value']) {
							$size_value = $this->encode_decode('decrypt', $size_name);
						}
						$gsm_name = $this->getTableColumnValue($GLOBALS['gsm_table'], 'gsm_id', $data['gsm_id'], 'gsm_name');
						if(!empty($gsm_name) && $gsm_name != $GLOBALS['null_value']) {
							$gsm_value = $this->encode_decode('decrypt', $gsm_name);
						}
						$bf_name = $this->getTableColumnValue($GLOBALS['bf_table'], 'bf_id', $data['bf_id'], 'bf_name');
						if(!empty($bf_name) && $bf_name != $GLOBALS['null_value']) {
							$bf_value = $this->encode_decode('decrypt', $bf_name);
						}
						$label = "Size : ".$size_value."/ GSM : ".$gsm_value."/ BF : ".$bf_value;
						$variations[] = [
											'label' => $label,
											'size_id' => $data['size_id'],
											'gsm_id' => $data['gsm_id'],
											'bf_id' => $data['bf_id']
										];
					}
				}
			}
			$datasets = array(); $locations = array();

			$factory_list = array();
			$factory_list = $this->getTableRecords($GLOBALS['factory_table'], '', '');
			if(!empty($factory_list)) {
				foreach($factory_list as $data) {
					if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
						$locations[] = html_entity_decode($this->encode_decode('decrypt', $data['factory_name']));
					}
				}
			}
			$godown_list = array();
			$godown_list = $this->getTableRecords($GLOBALS['godown_table'], '', '');
			if(!empty($godown_list)) {
				foreach($godown_list as $data) {
					if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
						$locations[] = html_entity_decode($this->encode_decode('decrypt', $data['godown_name']));
					}
				}
			}
			if(!empty($variations)) {
				foreach($variations as $data) {
					$row = array();
					if(!empty($factory_list)) {
						foreach($factory_list as $list) {
							if(!empty($list['factory_id']) && $list['factory_id'] != $GLOBALS['null_value']) {
								$factory_query = ""; $factory_array = array(); $inward = 0; $outward = 0; $current_stock = 0;
								$factory_query = "SELECT SUM(inward_unit) as inward, SUM(outward_unit) as outward FROM ".$GLOBALS['stock_table']." WHERE factory_id = '".$list['factory_id']."' AND size_id = '".$data['size_id']."' AND gsm_id = '".$data['gsm_id']."' AND bf_id = '".$data['bf_id']."' AND deleted = '0'";
								$factory_array = $this->getQueryRecords('', $factory_query);
								if(!empty($factory_array)) {
									foreach($factory_array as $val) {
										if(!empty($val['inward']) && $val['inward'] != $GLOBALS['null_value']) {
											$inward = (int)$val['inward'];
										}
										if(!empty($val['outward']) && $val['outward'] != $GLOBALS['null_value']) {
											$outward = (int)$val['outward'];
										}
									}
								}
								$current_stock = $inward - $outward;
								$row[] = (int)($current_stock ?? 0);
							}
						}
					}
					if(!empty($godown_list)) {
						foreach($godown_list as $list) {
							if(!empty($list['godown_id']) && $list['godown_id'] != $GLOBALS['null_value']) {
								$godown_query = ""; $godown_array = array(); $inward = 0; $outward = 0; $current_stock = 0;
								$godown_query = "SELECT SUM(inward_unit) as inward, SUM(outward_unit) as outward FROM ".$GLOBALS['stock_table']." WHERE godown_id = '".$list['godown_id']."' AND size_id = '".$data['size_id']."' AND gsm_id = '".$data['gsm_id']."' AND bf_id = '".$data['bf_id']."' AND deleted = '0'";
								$godown_array = $this->getQueryRecords('', $godown_query);
								if(!empty($godown_array)) {
									foreach($godown_array as $val) {
										if(!empty($val['inward']) && $val['inward'] != $GLOBALS['null_value']) {
											$inward = (int)$val['inward'];
										}
										if(!empty($val['outward']) && $val['outward'] != $GLOBALS['null_value']) {
											$outward = (int)$val['outward'];
										}
									}
								}
								$current_stock = $inward - $outward;
								$row[] = (int)($current_stock ?? 0);
							}
						}
					}
					$datasets[] = [
						'label' => $data['label'],
						'data' => $row,
						'backgroundColor' => sprintf('hsl(%d, 70%%, 50%%)', rand(0, 360))
					];
				}
			}
			return json_encode([
						'locations' => $locations,
						'datasets' => $datasets
					]);
		}
    }
?>