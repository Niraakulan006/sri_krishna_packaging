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
        public function GetRoleLinkedCount($role_id) {
			$list = array(); $select_query = ""; $count = 0;
			if(!empty($role_id)) {
				$select_query = "SELECT id_count FROM ((SELECT count(id) as id_count FROM ".$GLOBALS['user_table']." WHERE FIND_IN_SET('".$role_id."', role_id) AND deleted = '0')) as g";
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
        public function GetLinkedCount($id, $table, $field_id) {
			$list = array(); $select_query = ""; $where = ""; $count = 0;
			if(!empty($id) && !empty($table) && !empty($field_id)) {
				$where = $field_id." = '".$id."' AND";
				$select_query = "SELECT id_count FROM 
									((SELECT COUNT(id) as id_count FROM ".$table." WHERE ".$where." deleted = '0')
									)
								as g";
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
		public function GetGodownLinkedCount($godown_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($godown_id)) {
				$where = " FIND_IN_SET('".$godown_id."', godown_id) AND ";
				$mt_where = " (FIND_IN_SET('".$godown_id."', from_location) OR FIND_IN_SET('".$godown_id."', to_location)) AND ";
				$pt_where = " FIND_IN_SET('".$godown_id."', location_id) AND ";

				// $select_query = "SELECT id_count FROM 
				// 					((SELECT count(id) as id_count FROM ".$GLOBALS['consumption_entry_table']." WHERE ".$where." cancelled = '0')
				// 					UNION ALL
				// 					(SELECT count(id) as id_count FROM ".$GLOBALS['purchase_entry_table']." WHERE ".$pt_where." cancelled = '0')
				// 					UNION ALL
				// 					(SELECT count(id) as id_count FROM ".$GLOBALS['material_transfer_table']." WHERE ".$mt_where." cancelled = '0')
				// 					UNION ALL
				// 					(SELECT count(id) as id_count FROM ".$GLOBALS['stock_adjustment_table']." WHERE ".$pt_where." cancelled = '0')
				// 					UNION ALL
				// 					(SELECT count(id) as id_count FROM ".$GLOBALS['godown_table']." WHERE ".$where." factory_id != '".$GLOBALS['null_value']."' AND deleted = '0')
				// 					UNION ALL
				// 					(SELECT count(id) as id_count FROM ".$GLOBALS['product_table']." WHERE ".$pt_where." deleted = '0'))
				// 				as g";
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
    }
    ?>