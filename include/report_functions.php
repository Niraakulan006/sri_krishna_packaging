<?php 
    class Report_functions extends Creation_functions {
       
        public function getCurrentStockList($location_type,$factory_id, $godown_id,$size_id,$gsm_id,$bf_id,$from_date,$to_date){
            $where = "";$select_query = "";$list = array();
            $current_stock = 0;$inward =0;$outward=0;
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
            if (!empty($factory_id) && $factory_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " factory_id = '" . $factory_id . "' AND ";
                } else {
                    $where = " factory_id = '" . $factory_id . "' AND ";
                }
            }
            if (!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " godown_id = '" . $godown_id . "' AND ";
                } else {
                    $where = " godown_id = '" . $godown_id . "' AND ";
                }
            }
            if (!empty($size_id) && $size_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " size_id = '" . $size_id . "' AND ";
                } else {
                    $where = " size_id = '" . $size_id . "' AND ";
                }
            }
            if (!empty($gsm_id) && $gsm_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " gsm_id = '" . $gsm_id . "' AND ";
                } else {
                    $where = " gsm_id = '" . $gsm_id . "' AND ";
                }
            }
            if (!empty($bf_id) && $bf_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " bf_id = '" . $bf_id . "' AND ";
                } else {
                    $where = " bf_id = '" . $bf_id . "' AND ";
                }
            }
            if (!empty($where)) {
                if(!empty($size_id) || !empty($gsm_id) || !empty($bf_id)){
                    $select_query = "SELECT * FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " deleted = '0'";
                }else{
                    $select_query = "SELECT *,SUM(inward_unit) AS inward_unit,SUM(outward_unit) AS outward_unit FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " deleted = '0' GROUP BY size_id, gsm_id, bf_id";
                }
                
            }else{
               
                if($location_type =='1'){
                    $select_query = "SELECT factory_id,godown_id,factory_name,godown_name,SUM(inward_unit) AS inward_unit,SUM(outward_unit) AS outward_unit FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " factory_id !='NULL' AND deleted = '0'
                    GROUP BY factory_id, godown_id, factory_name, godown_name ";
                }else if($location_type =='2'){
                    $select_query = "SELECT factory_id,godown_id,factory_name,godown_name,SUM(inward_unit) AS inward_unit,SUM(outward_unit) AS outward_unit FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " godown_id !='NULL' AND deleted = '0'
                    GROUP BY factory_id, godown_id, factory_name, godown_name";
                }else{
                    $select_query = "SELECT factory_id,godown_id,factory_name,godown_name,SUM(inward_unit) AS inward_unit,SUM(outward_unit) AS outward_unit
                    FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " deleted = '0'
                    GROUP BY factory_id, godown_id, factory_name, godown_name";
                }
                
            }
            if (!empty($select_query)) {
                $list = $this->getQueryRecords('', $select_query);
            }

            return $list;
        
        } 

        public function getConsumptionStockReport($from_date,$to_date,$size_id,$gsm_id,$bf_id){
            $where = "";$select_query = "";$list = array();
            $current_stock = 0;$inward =0;$outward=0;
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
            if (!empty($where)) {    
                $select_query = "SELECT * FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " stock_type ='Consumption Entry' AND deleted = '0'";
            }else{
                $select_query = "SELECT *,SUM(inward_unit) AS inward_unit,SUM(outward_unit) AS outward_unit FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " stock_type ='Consumption Entry' AND deleted = '0' GROUP BY size_id,gsm_id,bf_id";
            }
            if (!empty($select_query)) {
                $list = $this->getQueryRecords('', $select_query);
            }

            return $list;
        
        } 

        public function getSupplierReport($supplier_id,$from_date,$to_date){
            $where = "";$select_query = "";$list = array();
            $current_stock = 0;$inward =0;$outward=0;
            
            if (!empty($supplier_id) && $supplier_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " supplier_id = '" . $supplier_id . "' AND ";
                } else {
                    $where = " supplier_id = '" . $supplier_id . "' AND ";
                }
            }
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
            if (!empty($supplier_id)) {    
               $select_query = "SELECT * FROM " . $GLOBALS['stock_table'] . " WHERE " . $where . " stock_type ='Inward Material' AND deleted = '0'";
            }else{
             $select_query = "SELECT *,SUM(inward_unit) AS inward_unit FROM " . $GLOBALS['stock_table'] . " WHERE  stock_type ='Inward Material' AND deleted = '0' GROUP BY supplier_id";
            }
            if (!empty($select_query)) {
                $list = $this->getQueryRecords('', $select_query);
            }

            return $list;
        
        } 

    }
?>