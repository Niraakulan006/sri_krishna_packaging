<?php
    class Conversion_functions extends Creation_functions {
        public function ConversionUpdate($table, $bill_date, $bill_id, $bill_number, $conversion_id, $conversion_number, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id, $request_qty, $delivery_qty, $inward_qty) {
            if(!empty($bill_id) && $bill_id != $GLOBALS['null_value']) {
                if(!empty($bill_date) && $bill_date != "0000-00-00") {
                    $bill_date = date('Y-m-d', strtotime($bill_date));
                }
                if(empty($bill_number)) {
                    $bill_number = $GLOBALS['null_value'];
                }
                if(empty($conversion_id)) {
                    $conversion_id = $GLOBALS['null_value'];
                }
                if(empty($conversion_number)) {
                    $conversion_number = $GLOBALS['null_value'];
                }
                $godown_name = "";
                if(!empty($godown_id) && $godown_id != $GLOBALS['null_value']) {
                    $godown_name = $this->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'godown_name');
                }
                else {
                    $godown_id = $GLOBALS['null_value'];
                    $godown_name = $GLOBALS['null_value'];
                }
                $factory_name = "";
                if(!empty($factory_id) && $factory_id != $GLOBALS['null_value']) {
                    $factory_name = $this->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $factory_id, 'factory_name');
                }
                else {
                    $factory_id = $GLOBALS['null_value'];
                    $factory_name = $GLOBALS['null_value'];
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
                if(empty($request_qty)) {
                    $request_qty = $GLOBALS['null_value'];
                }
                if(empty($delivery_qty)) {
                    $delivery_qty = $GLOBALS['null_value'];
                }
                if(empty($inward_qty)) {
                    $inward_qty = $GLOBALS['null_value'];
                }
                $bill_type = "";
                if($table == $GLOBALS['stock_request_table']) {
                    $bill_type = "Stock Request";
                }
                else if($table == $GLOBALS['delivery_slip_table']) {
                    $bill_type = "Delivery Slip";
                }
                else if($table == $GLOBALS['inward_approval_table']) {
                    $bill_type = "Inward Approval";
                }
                $created_date_time = $GLOBALS['create_date_time_label']; $updated_date_time = $GLOBALS['create_date_time_label']; 
                $creator = $GLOBALS['creator'];
                $creator_name = $this->encode_decode('encrypt', $GLOBALS['creator_name']);

                $conversion_unique_id = ""; 
                $conversion_unique_id = $this->getConversionUniqueID($bill_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id);
                $bill_company_id = $GLOBALS['bill_company_id'];

                $conversion_update_id = "";
                if(preg_match("/^\d+$/", $conversion_unique_id)) {
                    $action = "Updated Successfully!";
                    $columns = array(); $values = array();
                    $columns = array('updated_date_time', 'creator_name', 'bill_date', 'godown_name', 'factory_name', 'size_name', 'gsm_name', 'bf_name', 'request_qty', 'delivery_qty', 'inward_qty');
                    $values = array("'".$updated_date_time."'", "'".$creator_name."'", "'".$bill_date."'", "'".$godown_name."'", "'".$factory_name."'", "'".$size_name."'", "'".$gsm_name."'", "'".$bf_name."'", "'".$request_qty."'", "'".$delivery_qty."'", "'".$inward_qty."'");
                    $conversion_update_id = $this->UpdateSQL($GLOBALS['conversion_table'], $conversion_unique_id, $columns, $values, $action);
                }
                else {
                    $action = "Inserted Successfully!";
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'updated_date_time', 'creator', 'creator_name', 'bill_company_id', 'bill_date', 'bill_type', 'bill_id', 'bill_number', 'conversion_id', 'conversion_number', 'godown_id', 'godown_name', 'factory_id', 'factory_name', 'size_id', 'size_name', 'gsm_id', 'gsm_name', 'bf_id', 'bf_name', 'request_qty', 'delivery_qty', 'inward_qty', 'deleted');
                    $values = array("'".$created_date_time."'", "'".$updated_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$bill_date."'", "'".$bill_type."'", "'".$bill_id."'", "'".$bill_number."'", "'".$conversion_id."'", "'".$conversion_number."'", "'".$godown_id."'", "'".$godown_name."'", "'".$factory_id."'", "'".$factory_name."'", "'".$size_id."'", "'".$size_name."'", "'".$gsm_id."'", "'".$gsm_name."'", "'".$bf_id."'", "'".$bf_name."'", "'".$request_qty."'", "'".$delivery_qty."'", "'".$inward_qty."'", "'0'");
                    $conversion_update_id = $this->InsertSQL($GLOBALS['conversion_table'], $columns, $values, '', '', $action);
                }
            }
        }

        public function getConversionUniqueID($bill_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id) {
            $where = ""; $select_query = ""; $list = array(); $unique_id = "";
            if(!empty($bill_id)) {
                if(!empty($where)) {
                    $where = $where." bill_id = '".$bill_id."' AND ";
                }
                else {
                    $where = " bill_id = '".$bill_id."' AND ";
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
                $select_query = "SELECT id FROM ".$GLOBALS['conversion_table']." WHERE ".$where." deleted = '0'";
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

        public function PrevConversionList($bill_id) {
            $select_query = ""; $list = array();
            $select_query = "SELECT * FROM ".$GLOBALS['conversion_table']." WHERE bill_id = '".$bill_id."' AND deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
            return $list;
        }

        public function DeleteConversionList($bill_id, $conversion_unique_ids) {
            $prev_conversion_list = array();
            $prev_conversion_list = $this->PrevConversionList($bill_id);

            if(!empty($prev_conversion_list)) {
                foreach($prev_conversion_list as $data) {
                    if(!empty($data['id'])) {
                        $conversion_update_id = "";
                        if(!empty($conversion_unique_ids)) {
                            if(!in_array($data['id'], $conversion_unique_ids)) {
                                $action = "Deleted Successfully!";
                                $columns = array(); $values = array();
                                $columns = array('deleted');
                                $values = array("'1'");
                                $conversion_update_id = $this->UpdateSQL($GLOBALS['conversion_table'], $data['id'], $columns, $values, $action);
                            }
                        }
                        else {
                            $action = "Deleted Successfully!";
                            $columns = array(); $values = array();
                            $columns = array('deleted');
                            $values = array("'1'");
                            $conversion_update_id = $this->UpdateSQL($GLOBALS['conversion_table'], $data['id'], $columns, $values, $action);
                        }
                    }
                }
            }
        }

        public function GetPrevRequestQty($bill_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id) {
            $where = ""; $select_query = ""; $list = array(); $request_qty = 0;
            if(!empty($bill_id)) {
                if(!empty($where)) {
                    $where = $where." bill_id = '".$bill_id."' AND ";
                }
                else {
                    $where = " bill_id = '".$bill_id."' AND ";
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
                $select_query = "SELECT request_qty FROM ".$GLOBALS['conversion_table']." WHERE ".$where." deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['request_qty']) && $data['request_qty'] != $GLOBALS['null_value']) {
                        $request_qty = $data['request_qty'];
                    }
                }
            }
            return $request_qty;
        }

        public function GetOtherDeliveryQty($bill_id, $conversion_id, $godown_id, $factory_id, $size_id, $gsm_id, $bf_id) {
            $where = ""; $select_query = ""; $list = array(); $delivery_qty = 0;
            if(!empty($bill_id)) {
                if(!empty($where)) {
                    $where = $where." bill_id != '".$bill_id."' AND ";
                }
                else {
                    $where = " bill_id != '".$bill_id."' AND ";
                }
            }
            if(!empty($conversion_id)) {
                if(!empty($where)) {
                    $where = $where." conversion_id = '".$conversion_id."' AND ";
                }
                else {
                    $where = " conversion_id = '".$conversion_id."' AND ";
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
                $select_query = "SELECT SUM(delivery_qty) as delivery_qty FROM ".$GLOBALS['conversion_table']." WHERE ".$where." deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['delivery_qty']) && $data['delivery_qty'] != $GLOBALS['null_value']) {
                        $delivery_qty = $data['delivery_qty'];
                    }
                }
            }
            return $delivery_qty;
        }

        public function CheckRequestDeliveried($stock_request_id) {
            $conversion_list = array();
            $conversion_list = $this->PrevConversionList($stock_request_id);
            $success = 0; $product_count = 0;
            $size_id = $this->getTableColumnValue($GLOBALS['stock_request_table'], 'stock_request_id', $stock_request_id, 'size_id');
            if(!empty($size_id) && $size_id != $GLOBALS['null_value']) {
                $product_count = count(explode(",", $size_id));
            }
            if(!empty($conversion_list)) {
                foreach($conversion_list as $data) {
                    $request_qty = 0;
                    if(!empty($data['request_qty']) && $data['request_qty'] != $GLOBALS['null_value']) {
                        $request_qty = $data['request_qty'];
                    }
                    $deliveried_qty = 0;
                    $deliveried_qty = $this->GetOtherDeliveryQty('', $stock_request_id, $data['godown_id'], $data['factory_id'], $data['size_id'], $data['gsm_id'], $data['bf_id']);
                    if($request_qty <= $deliveried_qty) {
                        $success++;
                    }
                }
            }
            $stock_request_unique_id = "";
            $stock_request_unique_id = $this->getTableColumnValue($GLOBALS['stock_request_table'], 'stock_request_id', $stock_request_id, 'id');
            if(preg_match("/^\d+$/", $stock_request_unique_id)) {
                if($success == $product_count) {
                    $columns = array(); $values = array();
                    $columns = array('is_deliveried');
                    $values = array("'1'");
                    $stock_request_update_id = $this->UpdateSQL($GLOBALS['stock_request_table'], $stock_request_unique_id, $columns, $values, '');
                }
                else {
                    $columns = array(); $values = array();
                    $columns = array('is_deliveried');
                    $values = array("'0'");
                    $stock_request_update_id = $this->UpdateSQL($GLOBALS['stock_request_table'], $stock_request_unique_id, $columns, $values, '');
                }
            }
        }
    }
?>