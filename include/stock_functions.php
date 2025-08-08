<?php 
    class Stock_functions extends Creation_functions {
        public function getStockUniqueID($bill_unique_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id) {
            $where = ""; $select_query = ""; $list = array(); $unique_id = "";
            if(!empty($bill_unique_id)) {
                if(!empty($where)) {
                    $where = $where." bill_unique_id = '".$bill_unique_id."' AND ";
                }
                else {
                    $where = " bill_unique_id = '".$bill_unique_id."' AND ";
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
            if(!empty($size_id)) {
                if(!empty($where)) {
                    $where = $where." size_id = '".$size_id."' AND ";
                }
                else {
                    $where = " size_id = '".$size_id."' AND ";
                }
            }
            if(!empty($gsm_id)) {
                if(!empty($where)) {
                    $where = $where." gsm_id = '".$gsm_id."' AND ";
                }
                else {
                    $where = " gsm_id = '".$gsm_id."' AND ";
                }
            }
            if(!empty($bf_id)) {
                if(!empty($where)) {
                    $where = $where." bf_id = '".$bf_id."' AND ";
                }
                else {
                    $where = " bf_id = '".$bf_id."' AND ";
                }
            }
            if(!empty($where)) {
                $select_query = "SELECT id FROM ".$GLOBALS['stock_table']." WHERE ".$where." deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $unique_id = $data['id'];
                    }
                }
            }
            return $unique_id;
        }
        
        public function getInwardUnitQty($from_date, $to_date, $bill_unique_id, $supplier_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id) {
            $where = ""; $select_query = ""; $list = array(); $inward_unit = 0;
            if(!empty($from_date) && $from_date != "0000-00-00") {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." stock_date >= '".$from_date."' AND ";
				}
				else {
					$where = "stock_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date) && $to_date != "0000-00-00") {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." stock_date <= '".$to_date."' AND ";
				}
				else {
					$where = "stock_date <= '".$to_date."' AND ";
				}
			}
            if(!empty($bill_unique_id)) {
                if(!empty($where)) {
                    $where = $where." bill_unique_id != '".$bill_unique_id."' AND ";
                }
                else {
                    $where = " bill_unique_id != '".$bill_unique_id."' AND ";
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
            if(!empty($size_id)) {
                if(!empty($where)) {
                    $where = $where." size_id = '".$size_id."' AND ";
                }
                else {
                    $where = " size_id = '".$size_id."' AND ";
                }
            }
            if(!empty($gsm_id)) {
                if(!empty($where)) {
                    $where = $where." gsm_id = '".$gsm_id."' AND ";
                }
                else {
                    $where = " gsm_id = '".$gsm_id."' AND ";
                }
            }
            if(!empty($bf_id)) {
                if(!empty($where)) {
                    $where = $where." bf_id = '".$bf_id."' AND ";
                }
                else {
                    $where = " bf_id = '".$bf_id."' AND ";
                }
            }
            
            if(!empty($where)) {
                $select_query = "SELECT SUM(inward_unit) as inward_unit FROM ".$GLOBALS['stock_table']." WHERE ".$where." deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['inward_unit']) && $data['inward_unit'] != $GLOBALS['null_value']) {
                        $inward_unit = $data['inward_unit'];
                    }
                }
            }
            return $inward_unit;
        }

        public function getOutwardUnitQty($from_date, $to_date, $bill_unique_id, $supplier_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id) {
            $where = ""; $select_query = ""; $list = array(); $outward_unit = 0;
            if(!empty($from_date) && $from_date != "0000-00-00") {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." stock_date >= '".$from_date."' AND ";
				}
				else {
					$where = "stock_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date) && $to_date != "0000-00-00") {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." stock_date <= '".$to_date."' AND ";
				}
				else {
					$where = "stock_date <= '".$to_date."' AND ";
				}
			}
            if(!empty($bill_unique_id)) {
                if(!empty($where)) {
                    $where = $where." bill_unique_id != '".$bill_unique_id."' AND ";
                }
                else {
                    $where = " bill_unique_id != '".$bill_unique_id."' AND ";
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
            if(!empty($size_id)) {
                if(!empty($where)) {
                    $where = $where." size_id = '".$size_id."' AND ";
                }
                else {
                    $where = " size_id = '".$size_id."' AND ";
                }
            }
            if(!empty($gsm_id)) {
                if(!empty($where)) {
                    $where = $where." gsm_id = '".$gsm_id."' AND ";
                }
                else {
                    $where = " gsm_id = '".$gsm_id."' AND ";
                }
            }
            if(!empty($bf_id)) {
                if(!empty($where)) {
                    $where = $where." bf_id = '".$bf_id."' AND ";
                }
                else {
                    $where = " bf_id = '".$bf_id."' AND ";
                }
            }
            
            if(!empty($where)) {
                $select_query = "SELECT SUM(outward_unit) as outward_unit FROM ".$GLOBALS['stock_table']." WHERE ".$where." deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                        $outward_unit = $data['outward_unit'];
                    }
                }
            }
            return $outward_unit;
        }

        public function PrevStockList($bill_unique_id) {
            $select_query = ""; $list = array();
            $select_query = "SELECT * FROM ".$GLOBALS['stock_table']." WHERE bill_unique_id = '".$bill_unique_id."' AND deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
            return $list;
        }

        public function StockUpdate($page_table, $in_out_type, $supplier_id, $bill_unique_id, $bill_unique_number, $remarks, $stock_date, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id, $quantity) {
            $supplier_name = "";
            if(!empty($supplier_id) && $supplier_id != $GLOBALS['null_value']) {
                $supplier_name = $this->getTableColumnvalue($GLOBALS['supplier_table'], 'supplier_id', $supplier_id, 'supplier_name');
            }
            else {
                $supplier_id = $GLOBALS['null_value'];
                $supplier_name = $GLOBALS['null_value'];
            }
            if(empty($bill_unique_number)) {
                $bill_unique_number = $GLOBALS['null_value'];
            }
            if(empty($stock_date) || $stock_date == "0000-00-00"){
                $stock_date = date('Y-m-d');
            }
            $factory_name = "";
            if(!empty($factory_id) && $factory_id != $GLOBALS['null_value']) {
                $factory_name = $this->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $factory_id, 'factory_name');
            }
            else {
                $factory_id = $GLOBALS['null_value'];
                $factory_name = $GLOBALS['null_value'];
            }
            $godown_name = "";
            if(!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
                $godown_name = $this->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'godown_name');
            }
            else {
                $godown_id = $GLOBALS['null_value'];
                $godown_name = $GLOBALS['null_value'];
            }
            $size_name = "";
            if(!empty($size_id) && $size_id != $GLOBALS['null_value']) {
                $size_name = $this->getTableColumnValue($GLOBALS['size_table'], 'size_id', $size_id, 'size_name');
            }
            else {
                $size_id = $GLOBALS['null_value'];
                $size_name = $GLOBALS['null_value'];
            }
            $gsm_name = "";
            if(!empty($gsm_id) && $gsm_id != $GLOBALS['null_value']) {
                $gsm_name = $this->getTableColumnValue($GLOBALS['gsm_table'], 'gsm_id', $gsm_id, 'gsm_name');
            }
            else {
                $gsm_id = $GLOBALS['null_value'];
                $gsm_name = $GLOBALS['null_value'];
            }
            $bf_name = "";
            if(!empty($bf_id) && $bf_id != $GLOBALS['null_value']) {
                $bf_name = $this->getTableColumnValue($GLOBALS['bf_table'], 'bf_id', $bf_id, 'bf_name');
            }
            else {
                $bf_id = $GLOBALS['null_value'];
                $bf_name = $GLOBALS['null_value'];
            }
            
            $created_date_time = $GLOBALS['create_date_time_label']; $updated_date_time = $GLOBALS['create_date_time_label']; 
            $creator = $GLOBALS['creator'];
            $creator_name = $this->encode_decode('encrypt', $GLOBALS['creator_name']);
        
            $inward_unit = 0; $outward_unit = 0; $stock_action = ""; 
            if($in_out_type == "In") {
                $inward_unit = $quantity;
                $stock_action = $GLOBALS['stock_action_plus'];
            }
            else if($in_out_type == "Out") {
                $outward_unit = $quantity;
                $stock_action = $GLOBALS['stock_action_minus'];
            }
            
            $stock_type = "";
            if($page_table == $GLOBALS['inward_material_table']) {
                $stock_type = "Inward Material";
            }
            else if($page_table == $GLOBALS['material_transfer_table']) {
                $stock_type = "Material Transfer";
            }
            else if($page_table == $GLOBALS['consumption_entry_table']) {
                $stock_type = "Consumption Entry";
            }
            
            $stock_unique_id = ""; 
            $stock_unique_id = $this->getStockUniqueID($bill_unique_id, $factory_id, $godown_id, $size_id, $gsm_id, $bf_id);
            $bill_company_id = $GLOBALS['bill_company_id'];
    
            //Stock table
            $stock_update_id = "";
            if(preg_match("/^\d+$/", $stock_unique_id)) {
                $action = "Updated Successfully!";
                $columns = array(); $values = array();
                $columns = array('updated_date_time', 'creator_name', 'stock_date', 'supplier_id', 'supplier_name', 'factory_name', 'godown_name', 'size_name', 'gsm_name', 'bf_name', 'inward_unit', 'outward_unit', 'remarks');
                $values = array("'".$updated_date_time."'", "'".$creator_name."'", "'".$stock_date."'", "'".$supplier_id."'", "'".$supplier_name."'", "'".$factory_name."'", "'".$godown_name."'", "'".$size_name."'", "'".$gsm_name."'", "'".$bf_name."'", "'".$inward_unit."'", "'".$outward_unit."'", "'".$remarks."'");
                $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $stock_unique_id, $columns, $values, $action);
            }
            else {
                $action = "Inserted Successfully!";
                $columns = array(); $values = array();
                $columns = array('created_date_time', 'updated_date_time', 'creator', 'creator_name', 'bill_company_id', 'stock_date', 'supplier_id', 'supplier_name', 'factory_id', 'factory_name', 'godown_id', 'godown_name', 'size_id', 'size_name', 'gsm_id', 'gsm_name', 'bf_id', 'bf_name', 'inward_unit', 'outward_unit', 'stock_type', 'stock_action', 'bill_unique_id', 'bill_unique_number', 'remarks', 'deleted');
                $values = array("'".$created_date_time."'", "'".$updated_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$stock_date."'", "'".$supplier_id."'", "'".$supplier_name."'", "'".$factory_id."'", "'".$factory_name."'", "'".$godown_id."'", "'".$godown_name."'", "'".$size_id."'", "'".$size_name."'", "'".$gsm_id."'", "'".$gsm_name."'", "'".$bf_id."'", "'".$bf_name."'", "'".$inward_unit."'", "'".$outward_unit."'", "'".$stock_type."'", "'".$stock_action."'", "'".$bill_unique_id."'", "'".$bill_unique_number."'", "'".$remarks."'", "'0'");
                $stock_update_id = $this->InsertSQL($GLOBALS['stock_table'], $columns, $values, '', '', $action);
            }
        }
        
        public function DeleteBillStock($table, $bill_id) {
            /* Use Only if Inward exists in the Screen */
            $can_delete = 1;
            if($table == $GLOBALS['inward_material_table'] || $table == $GLOBALS['material_transfer_table']) {
                $bill_id_field = ""; 
                if($table == $GLOBALS['inward_material_table']) {
                    $bill_id_field = "inward_material_id";
                }
                else if($table == $GLOBALS['material_transfer_table']) {
                    $bill_id_field = "material_transfer_id";
                }
                $bill_list = array(); 
                $bill_list = $this->getTableRecords($table, $bill_id_field, $bill_id, '');

                $location_type = "";
                $factory_ids = array(); $godown_ids = array(); $size_ids = array(); $gsm_ids = array(); $bf_ids = array();
                if(!empty($bill_list)) {
                    foreach($bill_list as $data) {
                        if($table == $GLOBALS['inward_material_table']) {
                            if(!empty($data['location_type']) && $data['location_type'] != $GLOBALS['null_value']) {
                                $location_type = $data['location_type'];
                            }
                            if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                                $factory_ids = $data['factory_id'];
                                $factory_ids = explode(",", $factory_ids);
                            }
                        }
                        if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                            $godown_ids = $data['godown_id'];
                            $godown_ids = explode(",", $godown_ids);
                        }
                        if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value']) {
                            $size_ids = $data['size_id'];
                            $size_ids = explode(",", $size_ids);
                        }
                        if(!empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value']) {
                            $gsm_ids = $data['gsm_id'];
                            $gsm_ids = explode(",", $gsm_ids);
                        }
                        if(!empty($data['bf_id']) && $data['bf_id'] != $GLOBALS['null_value']) {
                            $bf_ids = $data['bf_id'];
                            $bf_ids = explode(",", $bf_ids);
                        }
                    }
                }
                if(!empty($size_ids)) {
                    for($i=0; $i < count($size_ids); $i++) {
                        if(!empty($size_ids[$i])) {
                            $inward_quantity = 0; $outward_quantity = 0;
                            if($table == $GLOBALS['material_transfer_table']) {
                                $location_type = 1;
                                $godown_ids[$i] = $godown_ids[0];
                            }
                            if($location_type == '1') {
                                $inward_quantity = $this->getInwardUnitQty('', '', $bill_id, '', '', $godown_ids[$i], $size_ids[$i], $gsm_ids[$i], $bf_ids[$i]);
                                $outward_quantity = $this->getOutwardUnitQty('', '', $bill_id, '', '', $godown_ids[$i], $size_ids[$i], $gsm_ids[$i], $bf_ids[$i]);
                            }
                            else if($location_type == '2') {
                                $inward_quantity = $this->getInwardUnitQty('', '', $bill_id, '', $factory_ids[$i], '', $size_ids[$i], $gsm_ids[$i], $bf_ids[$i]);
                                $outward_quantity = $this->getOutwardUnitQty('', '', $bill_id, '', $factory_ids[$i], '', $size_ids[$i], $gsm_ids[$i], $bf_ids[$i]);
                            }

                            if($inward_quantity < $outward_quantity) {
                                $can_delete = 0;
                            }
                        }
                    }
                }
            }
            $stock_delete = 0;
            if($can_delete == '1') {
                $stock_delete = $this->DeletePrevList($bill_id, '');
            }
            return $can_delete;
        }

        public function DeletePrevList($bill_id, $stock_unique_ids) {
            $prev_stock_list = array();
            $prev_stock_list = $this->PrevStockList($bill_id);

            if(!empty($prev_stock_list)) {
                foreach($prev_stock_list as $data) {
                    if(!empty($data['id'])) {
                        $stock_update_id = "";
                        if(!empty($stock_unique_ids)) {
                            if(!in_array($data['id'], $stock_unique_ids)) {
                                $action = "Deleted Successfully!";
                                $columns = array(); $values = array();
                                $columns = array('deleted');
                                $values = array("'1'");
                                $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $data['id'], $columns, $values, $action);
                            }
                        }
                        else {
                            $action = "Deleted Successfully!";
                            $columns = array(); $values = array();
                            $columns = array('deleted');
                            $values = array("'1'");
                            $stock_update_id = $this->UpdateSQL($GLOBALS['stock_table'], $data['id'], $columns, $values, $action);
                        }
                    }
                }
            }
        }

        public function GetCurrentStockByMaterial($material, $bill_id, $godown_id, $factory_id) {
            /* Use any one factory_id or godown_id */
			$select_query = ""; $list = array(); $table_name = ""; $material_list = array();
			if(!empty($material)) {
				$table_name = $GLOBALS[$material.'_table'];
			}
			$select_query = "SELECT * FROM ".$table_name." WHERE deleted = '0'";
			$list = $this->getQueryRecords('', $select_query);
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data[$material.'_id']) && $data[$material.'_id'] != $GLOBALS['null_value']) {
						$field_id = "";
						$field_id = $data[$material.'_id'];
						$inward_quantity = 0; $outward_quantity = 0; $current_stock = 0;
						if($material == 'size') {
							$inward_quantity = $this->getInwardUnitQty('', '', $bill_id, '', $factory_id, $godown_id, $field_id, '', '');
							$outward_quantity = $this->getOutwardUnitQty('', '', $bill_id, '', $factory_id, $godown_id, $field_id, '', '');
						}
						else if($material == 'gsm') {
							$inward_quantity = $this->getInwardUnitQty('', '', $bill_id, '', $factory_id, $godown_id, '', $field_id, '');
							$outward_quantity = $this->getOutwardUnitQty('', '', $bill_id, '', $factory_id, $godown_id, '', $field_id, '');
						}
						else if($material == 'bf') {
							$inward_quantity = $this->getInwardUnitQty('', '', $bill_id, '', $factory_id, $godown_id, '', '', $field_id);
							$outward_quantity = $this->getOutwardUnitQty('', '', $bill_id, '', $factory_id, $godown_id, '', '', $field_id);
						}
						$current_stock = $inward_quantity - $outward_quantity;
						if($current_stock > 0) {
							$material_list[] = $data;
						}
					}
				}
			}
			return $material_list;
		}
        public function getCurrentStock($table, $factory_id, $size_id, $gsm_id,$bf_id){
            $where = "";$select_query = "";$list = array();
            $current_stock = 0;$inward =0;$outward=0;

            if (!empty($factory_id) && $factory_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " factory_id = '" . $factory_id . "' AND ";
                } else {
                    $where = " factory_id = '" . $factory_id . "' AND ";
                }
            }
            if (!empty($size_id) && $size_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " size_id = '" . $size_id . "' AND ";
                } else {
                    $where = " size_id = '" . $size_id . "' AND ";
                }
            }
            if (!empty($gsm_id)) {
                if (!empty($where)) {
                    $where = $where . " gsm_id = '" . $gsm_id . "' AND ";
                } else {
                    $where = " gsm_id = '" . $gsm_id . "' AND ";
                }
            }
            if (!empty($bf_id)) {
                if (!empty($where)) {
                    $where = $where . " bf_id = '" . $bf_id . "' AND ";
                } else {
                    $where = " bf_id = '" . $bf_id . "' AND ";
                }
            }
            if (!empty($table)) {
                if ($table == $GLOBALS['stock_table']) {
                    $select_query = "SELECT SUM(inward_unit) as inward_unit,SUM(outward_unit) as outward_unit FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " deleted = '0'";
                }
            }
            if (!empty($select_query)) {
                $list = $this->getQueryRecords('', $select_query);
            }
            if (!empty($list)) {
                foreach ($list as $data) {
                    if (!empty($data['inward_unit']) && $data['inward_unit'] != $GLOBALS['null_value']) {
                        $inward = $data['inward_unit'];
                    }
                    if (!empty($data['outward_unit']) && $data['outward_unit'] != $GLOBALS['null_value']) {
                        $outward = $data['outward_unit'];
                    }
                }
            }
            $current_stock = $inward - $outward;
            return $current_stock;
        }
    }
?>