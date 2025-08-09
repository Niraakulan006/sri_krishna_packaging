<?php
    include("include_files.php");

    if(isset($_REQUEST['view_table'])) {
        $table = trim($_REQUEST['view_table']);

        $bill_id = "";
        if(isset($_REQUEST['view_bill_id'])) {
            $bill_id = trim($_REQUEST['view_bill_id']);
        }
        $field_id = "";
        if($table == $GLOBALS['inward_material_table']) {
            $field_id = "inward_material_id";
        }
        else if($table == $GLOBALS['material_transfer_table']) {
            $field_id = "material_transfer_id";
        }
        else if($table == $GLOBALS['stock_request_table']) {
            $field_id = "stock_request_id";
        }
        else if($table == $GLOBALS['delivery_slip_table']) {
            $field_id = "delivery_slip_id";
        }
        else if($table == $GLOBALS['inward_approval_table']) {
            $field_id = "inward_approval_id";
        }
        else if($table == $GLOBALS['consumption_entry_table']) {
            $field_id = "consumption_entry_id";
        }
        $bill_details = array();
        $bill_details = $obj->getTableRecords($table, $field_id, $bill_id);

        $location_type = ""; $location_names = array(); $size_names = array(); $gsm_names = array(); $bf_names = array(); $quantity = array();
        $total_quantity = 0; $bill_number = "";
        if(!empty($bill_details)) {
            foreach($bill_details as $data) {
                if($table == $GLOBALS['inward_material_table'] || $table == $GLOBALS['stock_adjustment_table']) {
                    if(!empty($data['location_type']) && $data['location_type'] != $GLOBALS['null_value']) {
                        $location_type = $data['location_type'];
                    }
                    if($location_type == '1') {
                        if(!empty($data['godown_name']) && $data['godown_name'] != $GLOBALS['null_value']) {
                            $location_names = explode(",", $data['godown_name']);
                        }
                    }
                    else if($location_type == '2') {
                        if(!empty($data['factory_name']) && $data['factory_name'] != $GLOBALS['null_value']) {
                            $location_names = explode(",", $data['factory_name']);
                        }
                    }
                }
                if($table == $GLOBALS['inward_material_table']) {
                    if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']) {
                        $bill_number = $obj->encode_decode('decrypt', $data['bill_number']);
                    }
                }
                if($table == $GLOBALS['material_transfer_table']) {
                    if(!empty($data['material_transfer_number']) && $data['material_transfer_number'] != $GLOBALS['null_value']) {
                        $bill_number = $data['material_transfer_number'];
                    }
                }
                if($table == $GLOBALS['stock_request_table']) {
                    if(!empty($data['stock_request_number']) && $data['stock_request_number'] != $GLOBALS['null_value']) {
                        $bill_number = $data['stock_request_number'];
                    }
                }
                if($table == $GLOBALS['delivery_slip_table']) {
                    if(!empty($data['delivery_slip_number']) && $data['delivery_slip_number'] != $GLOBALS['null_value']) {
                        $bill_number = $data['delivery_slip_number'];
                    }
                }
                if($table == $GLOBALS['inward_approval_table']) {
                    if(!empty($data['inward_approval_number']) && $data['inward_approval_number'] != $GLOBALS['null_value']) {
                        $bill_number = $data['inward_approval_number'];
                    }
                }
                if($table == $GLOBALS['stock_adjustment_table']) {
                    if(!empty($data['stock_adjustment_number']) && $data['stock_adjustment_number'] != $GLOBALS['null_value']) {
                        $bill_number = $data['stock_adjustment_number'];
                    }
                }
                if($table == $GLOBALS['consumption_entry_table']) {
                    if(!empty($data['consumption_entry_number']) && $data['consumption_entry_number'] != $GLOBALS['null_value']) {
                        $bill_number = $data['consumption_entry_number'];
                    }
                }
                if(!empty($data['size_name']) && $data['size_name'] != $GLOBALS['null_value']) {
                    $size_names = explode(",", $data['size_name']);
                }
                if(!empty($data['gsm_name']) && $data['gsm_name'] != $GLOBALS['null_value']) {
                    $gsm_names = explode(",", $data['gsm_name']);
                }
                if(!empty($data['bf_name']) && $data['bf_name'] != $GLOBALS['null_value']) {
                    $bf_names = explode(",", $data['bf_name']);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity = explode(",", $data['quantity']);
                }
                if(!empty($data['total_quantity']) && $data['total_quantity'] != $GLOBALS['null_value']) {
                    $total_quantity = $data['total_quantity'];
                }
            }
        }
        ?>
        <div class="row mx-0">
            <div class="col-12 table-responsive text-center" style="height:400px !important; overflow-y:scroll !important;">
                <?php
                    if(!empty($total_quantity)) {
                        ?>
                        <span class="text-center py-2 fw-bold h5">Total Reels Count : <span class="text-primary"><?php echo $total_quantity; ?></span></span>
                        <?php
                    }
                ?>
                <table class="table table-bordered nowrap cursor smallfnt w-100 view_table border">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center px-2 py-2">S.No</th>
                            <?php if($table == $GLOBALS['inward_material_table']) { ?>
                                <th class="text-center px-2 py-2">Location</th>
                            <?php } ?>
                            <th class="text-center px-2 py-2">Reel Size</th>
                            <th class="text-center px-2 py-2">GSM</th>
                            <th class="text-center px-2 py-2">BF</th>
                            <th class="text-center px-2 py-2">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($bill_details)) {
                                ?>
                                <tr class="no_data_row py-2">
                                    <th class="text-center px-2 py-2" colspan="6">No Data Found!</th>
                                </tr>
                                <?php
                            }
                            else {
                                $sno = 1;
                                if(!empty($size_names)) {
                                    for($i=0; $i < count($size_names); $i++) {
                                        ?>
                                        <tr class="product_row">
                                            <th class="text-center px-2 py-2"><?php echo $sno++; ?></th>
                                            <?php if($table == $GLOBALS['inward_material_table']) { ?>
                                                <th class="text-center px-2 py-2">
                                                    <?php
                                                        if(!empty($location_names[$i]) && $location_names[$i] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $location_names[$i]);
                                                        }
                                                    ?>
                                                </th>
                                            <?php } ?>
                                            <th class="text-center px-2 py-2">
                                                <?php
                                                    if(!empty($size_names[$i]) && $size_names[$i] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $size_names[$i]);
                                                    }
                                                ?>
                                            </th>
                                            <th class="text-center px-2 py-2">
                                                <?php
                                                    if(!empty($gsm_names[$i]) && $gsm_names[$i] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $gsm_names[$i]);
                                                    }
                                                ?>
                                            </th>
                                            <th class="text-center px-2 py-2">
                                                <?php
                                                    if(!empty($bf_names[$i]) && $bf_names[$i] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $bf_names[$i]);
                                                    }
                                                ?>
                                            </th>
                                            <th class="text-center px-2 py-2">
                                                <?php
                                                    if(!empty($quantity[$i]) && $quantity[$i] != $GLOBALS['null_value']) {
                                                        echo $quantity[$i];
                                                    }
                                                ?>
                                            </th>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        echo "$$$"."Reels in this Bill - ".$bill_number;
    }
?>