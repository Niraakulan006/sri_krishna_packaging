<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['stock_request_module'];
        }
    }
	if(isset($_REQUEST['show_stock_request_id'])) { 
        $show_stock_request_id = trim($_REQUEST['show_stock_request_id']); 
        $factory_id = "";
        $factory_id = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_factory', '1', 'factory_id');
        $bill_date = date('Y-m-d'); $godown_id = ""; $product_count = 0; $size_ids = array(); $gsm_ids = array(); $bf_ids = array();
        $quantity = array(); $total_quantity = 0; $remarks = "";

        if(!empty($show_stock_request_id)) {
            $stock_request_list = array();
            $stock_request_list = $obj->getTableRecords($GLOBALS['stock_request_table'], 'stock_request_id', $show_stock_request_id);
            if(!empty($stock_request_list)) {
                foreach($stock_request_list as $data) {
                    if(!empty($data['bill_date']) && $data['bill_date'] != "0000-00-00") {
                        $bill_date = date('Y-m-d', strtotime($data['bill_date']));
                    }
                    if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                        $factory_id = $data['factory_id'];
                    }
                    if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                        $godown_id = $data['godown_id'];
                    }
                    if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value']) {
                        $size_ids = explode(",", $data['size_id']);
                        $product_count = count($size_ids);
                    }
                    if(!empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value']) {
                        $gsm_ids = explode(",", $data['gsm_id']);
                    }
                    if(!empty($data['bf_id']) && $data['bf_id'] != $GLOBALS['null_value']) {
                        $bf_ids = explode(",", $data['bf_id']);
                    }
                    if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                        $quantity = explode(",", $data['quantity']);
                    }
                    if(!empty($data['total_quantity']) && $data['total_quantity'] != $GLOBALS['null_value']) {
                        $total_quantity = $data['total_quantity'];
                    }
                    if(!empty($data['remarks']) && $data['remarks'] != $GLOBALS['null_value']) {
                        $remarks = $obj->encode_decode('decrypt', $data['remarks']);
                    }
                }
            }
        }

        $godown_list = array();
        $godown_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '');
        $godown_count = 0;
        if(!empty($godown_list)) {
            $godown_count = count($godown_list);
        }
        $factory_list = array();
        $factory_list = $obj->getTableRecords($GLOBALS['factory_table'], '', '');
        $factory_count = 0;
        if(!empty($factory_list)) {
            $factory_count = count($factory_list);
        }
        $size_list = array();
        $size_list = $obj->getTableRecords($GLOBALS['size_table'], '', '');
        $size_count = 0;
        if(!empty($size_list)) {
            $size_count = count($size_list);
        }
        $gsm_list = array();
        $gsm_list = $obj->getTableRecords($GLOBALS['gsm_table'], '', '');
        $gsm_count = 0;
        if(!empty($gsm_list)) {
            $gsm_count = count($gsm_list);
        }
        $bf_list = array();
        $bf_list = $obj->getTableRecords($GLOBALS['bf_table'], '', '');
        $bf_count = 0;
        if(!empty($bf_list)) {
            $bf_count = count($bf_list);
        }
        ?>
        <form class="poppins pd-20" name="stock_request_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_stock_request_id)) { ?>
                            <div class="h5">Edit Stock Request</div>
                        <?php } else { ?>
                            <div class="h5">Add Stock Request</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('stock_request.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-2">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_stock_request_id)) { echo $show_stock_request_id; } ?>">
                <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="bill_date" class="form-control shadow-none" placeholder="" value="<?php if(!empty($bill_date)) { echo $bill_date; } ?>">
                            <label>Date <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border" <?php if(!empty($show_stock_request_id)) { ?>style="pointer-events:none;"<?php } ?>>
                            <select name="godown_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_stock_request_id)) { ?>tabindex="1"<?php } ?>>
                                <option value="">Select Godown</option>
                                <?php
                                    if(!empty($godown_list)) {
                                        foreach($godown_list as $data) {
                                            if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['godown_id']; ?>" <?php if($godown_count == '1' || (!empty($godown_id) && $godown_id == $data['godown_id'])) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['name_location']) && $data['name_location'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['name_location']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Godown <span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-3 col-md-6 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border" <?php if(!empty($show_stock_request_id)) { ?>style="pointer-events:none;"<?php } ?>>
                            <select name="factory_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" <?php if(!empty($show_stock_request_id)) { ?>tabindex="1"<?php } ?>>
                                <option value="">Select Factory</option>
                                <?php
                                    if(!empty($factory_list)) {
                                        foreach($factory_list as $data) {
                                            if(!empty($data['factory_id']) && $data['factory_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['factory_id']; ?>" <?php if($factory_count == '1' || (!empty($factory_id) && $factory_id == $data['factory_id'])) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['name_location']) && $data['name_location'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['name_location']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Factory <span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-3 col-md-6 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="remarks" name="remarks" onkeydown="Javascript:KeyboardControls(this,'',150,'1');"><?php if(!empty($remarks)) { echo $remarks; } ?></textarea>
                            <label>Remarks <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center p-2">
                <div class="col-lg-2 col-md-4 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border" id="selected_size_id_div">
                            <select name="selected_size_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Size</option>
                                <?php
                                    if(!empty($size_list)) {
                                        foreach($size_list as $data) {
                                            if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['size_id']; ?>" <?php if($size_count == '1') { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['size_name']) && $data['size_name'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['size_name']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Reel Size <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border" id="selected_gsm_id_div">
                            <select name="selected_gsm_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select GSM</option>
                                <?php
                                    if(!empty($gsm_list)) {
                                        foreach($gsm_list as $data) {
                                            if(!empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['gsm_id']; ?>" <?php if($gsm_count == '1') { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['gsm_name']) && $data['gsm_name'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['gsm_name']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>GSM <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border" id="selected_bf_id_div">
                            <select name="selected_bf_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select BF</option>
                                <?php
                                    if(!empty($bf_list)) {
                                        foreach($bf_list as $data) {
                                            if(!empty($data['bf_id']) && $data['bf_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['bf_id']; ?>" <?php if($bf_count == '1') { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['bf_name']) && $data['bf_name'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['bf_name']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>BF <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-4 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="selected_quantity" name="selected_quantity" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:InputBoxColor(this,'text');" placeholder="">
                            <label>QTY <span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-4 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <button class="btn btn-success py-2 add_product_button" style="font-size:11px; width:120px;" type="button" onclick="Javascript:AddRequestRow();">Add To Table</button>
                    </div>
                </div>
            </div>
            <div class="row px-3 py-1">
                <div class="col-lg-6 col-md-6 col-12 px-lg-1 text-center align-content-center" id="current_stock_div">
                    <div class="form-group mb-0">
                        <span class="h4 d-none text-center fw-bold mb-0">Current Stock : <span class="current_stock_span text-danger">0</span></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 px-lg-1 text-center align-content-center" id="total_reels_div">
                    <div class="form-group mb-0">
                        <span class="h4 text-center fw-bold mb-0">Total Reels : <span class="total_reels_span text-success"><?php echo $total_quantity; ?></span></span>
                    </div>
                </div>
            </div>
            <div class="row">    
                <div class="col-lg-12 text-center">
                    <span class="table-infos infos text-danger text-center mb-3" style="font-size: 15px;"></span>
                    <div class="table-responsive text-center tableheight">
                        <input type="hidden" name="product_count" value="<?php echo $product_count; ?>">
                        <table class="table table-nowrap nowrap cursor smallfnt w-100 table-bordered product_table">
                            <thead class="bg-dark smallfnt" style="position:sticky; top:0; left:0; z-index:1000!important;">
                                <tr>
                                    <th>#</th>
                                    <th>Reel Size</th>
                                    <th>GSM</th>
                                    <th>BF</th>
                                    <th style="width:90px;">QTY</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(empty($show_stock_request_id)) { 
                                        ?>
                                        <tr class="no_data_row py-2">
                                            <th class="text-center px-2 py-2" colspan="6">No Data Found!</th>
                                        </tr>
                                        <?php 
                                    }
                                    else { 
                                        if(!empty($size_ids)) {
                                            for($i=0; $i < count($size_ids); $i++) {
                                                $inward_quantity = 0; $outward_quantity = 0; $disable = 0;
                                                /*
                                                if(!empty($godown_id)) {
                                                    $inward_quantity = $obj->getInwardUnitQty('', '', $show_stock_request_id, '', '', $godown_id, $size_ids[$i], $gsm_ids[$i], $bf_ids[$i]);
                                                    $outward_quantity = $obj->getOutwardUnitQty('', '', $show_stock_request_id, '', '', $godown_id, $size_ids[$i], $gsm_ids[$i], $bf_ids[$i]);
                                                }
                                                if($inward_quantity < $outward_quantity) {
                                                    $disable = 1;
                                                }
                                                */
                                                ?>
                                                <tr class="product_row py-2" id="product_row<?php echo $i+1; ?>">
                                                    <th class="sno text-center px-2 py-2"><?php echo $i+1; ?></th>
                                                    <th class="size_element text-center px-2 py-2">
                                                        <div class="form-group">
                                                            <div class="form-label-group in-border" <?php if($disable == '1') { ?>style="pointer-events:none;"<?php } ?>>
                                                                <select name="size_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:RequestRowCheck(this);" <?php if($disable == '1') { ?>tabindex="1"<?php } ?>>
                                                                    <?php
                                                                        if(empty($size_ids[$i])) {
                                                                            ?>
                                                                            <option value="">Select Size</option>
                                                                            <?php
                                                                        }
                                                                        if(!empty($size_list)) {
                                                                            foreach($size_list as $data) {
                                                                                if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value']) {
                                                                                    ?>
                                                                                    <option value="<?php echo $data['size_id']; ?>" <?php if(!empty($size_ids[$i]) && $size_ids[$i] == $data['size_id']) { ?>selected<?php } ?>>
                                                                                        <?php
                                                                                            if(!empty($data['size_name']) && $data['size_name'] != $GLOBALS['null_value']) {
                                                                                                echo $obj->encode_decode('decrypt', $data['size_name']);
                                                                                            }
                                                                                        ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <label>Reels Size <span class="text-danger">*</span></label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th class="gsm_element text-center px-2 py-2">
                                                        <div class="form-group">
                                                            <div class="form-label-group in-border" <?php if($disable == '1') { ?>style="pointer-events:none;"<?php } ?>>
                                                                <select name="gsm_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:RequestRowCheck(this);" <?php if($disable == '1') { ?>tabindex="1"<?php } ?>>
                                                                    <?php
                                                                        if(empty($gsm_ids[$i])) {
                                                                            ?>
                                                                            <option value="">Select GSM</option>
                                                                            <?php
                                                                        }
                                                                        if(!empty($gsm_list)) {
                                                                            foreach($gsm_list as $data) {
                                                                                if(!empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value']) {
                                                                                    ?>
                                                                                    <option value="<?php echo $data['gsm_id']; ?>" <?php if(!empty($gsm_ids[$i]) && $gsm_ids[$i] == $data['gsm_id']) { ?>selected<?php } ?>>
                                                                                        <?php
                                                                                            if(!empty($data['gsm_name']) && $data['gsm_name'] != $GLOBALS['null_value']) {
                                                                                                echo $obj->encode_decode('decrypt', $data['gsm_name']);
                                                                                            }
                                                                                        ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <label>GSM <span class="text-danger">*</span></label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th class="bf_element text-center px-2 py-2">
                                                        <div class="form-group">
                                                            <div class="form-label-group in-border" <?php if($disable == '1') { ?>style="pointer-events:none;"<?php } ?>>
                                                                <select name="bf_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:RequestRowCheck(this);" <?php if($disable == '1') { ?>tabindex="1"<?php } ?>>
                                                                    <?php   
                                                                        if(empty($bf_ids[$i])) {
                                                                            ?>
                                                                            <option value="">Select BF</option>
                                                                            <?php
                                                                        }
                                                                        if(!empty($bf_list)) {
                                                                            foreach($bf_list as $data) {
                                                                                if(!empty($data['bf_id']) && $data['bf_id'] != $GLOBALS['null_value']) {
                                                                                    ?>
                                                                                    <option value="<?php echo $data['bf_id']; ?>" <?php if(!empty($bf_ids[$i]) && $bf_ids[$i] == $data['bf_id']) { ?>selected<?php } ?>>
                                                                                        <?php
                                                                                            if(!empty($data['bf_name']) && $data['bf_name'] != $GLOBALS['null_value']) {
                                                                                                echo $obj->encode_decode('decrypt', $data['bf_name']);
                                                                                            }
                                                                                        ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <label>BF <span class="text-danger">*</span></label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th class="quantity_element text-center px-2 py-2">
                                                        <div class="form-group">
                                                            <div class="form-label-group in-border">
                                                                <input type="text" name="quantity[]" class="form-control shadow-none" style="width:90px;" onfocus="Javascript:KeyboardControls(this,'number',8,'');" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onkeyup="Javascript:RequestRowCheck(this);">
                                                            </div>
                                                        </div> 
                                                    </th>
                                                    <th class="delete_element text-center px-2 py-2">
                                                        <?php
                                                            if(empty($disable)) {
                                                                ?>
                                                                <a class="pe-2" onclick="Javascript:DeleteRequestRow('product_row', '<?php echo $i+1; ?>');" style="cursor:pointer;"><i class="fa fa-trash text-danger"></i></a>
                                                                <?php
                                                            }
                                                            else {
                                                                ?>
                                                                <a class="fw-bold text-danger" style="pointer-events:none;"><i class="fa fa-exclamation-circle text-danger"></i> Can't Delete</a>
                                                                <?php
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
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-primary" type="button" onclick="Javascript:SaveModalContent('stock_request_form', 'stock_request_changes.php', 'stock_request.php');"> Submit </button>
                </div>
            </div>
            
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
        <?php
    } 
    if(isset($_POST['edit_id'])) {
        $bill_date = ""; $bill_date_error = ""; $godown_id = ""; $godown_id_error = ""; $factory_id = ""; $factory_id_error = "";
        $size_ids = array(); $size_names = array(); $gsm_ids = array(); $gsm_names = array(); $bf_ids = array(); $bf_names = array();
        $quantity = array(); $total_quantity = 0; $stock_unique_ids = array(); $remarks = ""; $remarks_error = "";

        $edit_id = ""; $form_name = "stock_request_form"; $valid_stock_request = ""; $stock_request_error = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = trim($_POST['edit_id']);
        }
        if(isset($_POST['bill_date'])) {
            $bill_date = trim($_POST['bill_date']);
            $bill_date_error = $valid->valid_date($bill_date, 'Bill Date', 1);
            if(!empty($bill_date_error)) {
                if(!empty($valid_stock_request)) {
                    $valid_stock_request = $valid_stock_request." ".$valid->error_display($form_name, 'bill_date', $bill_date_error, 'text');
                }
                else {
                    $valid_stock_request = $valid->error_display($form_name, 'bill_date', $bill_date_error, 'text');
                }
            }
        }
        if(isset($_POST['godown_id'])) {
            $godown_id = trim($_POST['godown_id']);
            $godown_id_error = $valid->common_validation($godown_id, 'Godown', 'select');
            if(!empty($godown_id_error)) {
                if(!empty($valid_stock_request)) {
                    $valid_stock_request = $valid_stock_request." ".$valid->error_display($form_name, 'godown_id', $godown_id_error, 'select');
                }
                else {
                    $valid_stock_request = $valid->error_display($form_name, 'godown_id', $godown_id_error, 'select');
                }
            }
        }
        if(isset($_POST['factory_id'])) {
            $factory_id = trim($_POST['factory_id']);
            $factory_id_error = $valid->common_validation($factory_id, 'Factory', 'select');
            if(!empty($factory_id_error)) {
                if(!empty($valid_stock_request)) {
                    $valid_stock_request = $valid_stock_request." ".$valid->error_display($form_name, 'factory_id', $factory_id_error, 'select');
                }
                else {
                    $valid_stock_request = $valid->error_display($form_name, 'factory_id', $factory_id_error, 'select');
                }
            }
        }
        if(isset($_POST['remarks'])) {
            $remarks = trim($_POST['remarks']);
            $remarks_error = $valid->common_validation($remarks, 'Remarks', 'textarea');
            if(!empty($remarks_error)) {
                if(!empty($valid_stock_request)) {
                    $valid_stock_request = $valid_stock_request." ".$valid->error_display($form_name, 'remarks', $remarks_error, 'textarea');
                }
                else {
                    $valid_stock_request = $valid->error_display($form_name, 'remarks', $remarks_error, 'textarea');
                }
            }
        }
        if(isset($_POST['size_id'])) {
            $size_ids = $_POST['size_id'];
        }
        if(isset($_POST['gsm_id'])) {
            $gsm_ids = $_POST['gsm_id'];
        }
        if(isset($_POST['bf_id'])) {
            $bf_ids = $_POST['bf_id'];
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }
        if(!empty($size_ids)) {
            for($i=0; $i < count($size_ids); $i++) {
                if(isset($size_ids[$i])) {
                    $size_id_error = "";
                    $size_id_error = $valid->common_validation($size_ids[$i], 'Size', 'select');
                    if(!empty($size_id_error)) {
                        if(!empty($valid_stock_request)) {
                            $valid_stock_request = $valid_stock_request." ".$valid->row_error_display($form_name, 'size_id[]', $size_id_error, 'select', 'product_row', ($i+1));
                        }
                        else {
                            $valid_stock_request = $valid->row_error_display($form_name, 'size_id[]', $size_id_error, 'select', 'product_row', ($i+1));
                        }
                    }
                }
                if(isset($gsm_ids[$i])) {
                    $gsm_id_error = "";
                    $gsm_id_error = $valid->common_validation($gsm_ids[$i], 'GSM', 'select');
                    if(!empty($gsm_id_error)) {
                        if(!empty($valid_stock_request)) {
                            $valid_stock_request = $valid_stock_request." ".$valid->row_error_display($form_name, 'gsm_id[]', $gsm_id_error, 'select', 'product_row', ($i+1));
                        }
                        else {
                            $valid_stock_request = $valid->row_error_display($form_name, 'gsm_id[]', $gsm_id_error, 'select', 'product_row', ($i+1));
                        }
                    }
                }
                if(isset($bf_ids[$i])) {
                    $bf_id_error = "";
                    $bf_id_error = $valid->common_validation($bf_ids[$i], 'BF', 'select');
                    if(!empty($bf_id_error)) {
                        if(!empty($valid_stock_request)) {
                            $valid_stock_request = $valid_stock_request." ".$valid->row_error_display($form_name, 'bf_id[]', $bf_id_error, 'select', 'product_row', ($i+1));
                        }
                        else {
                            $valid_stock_request = $valid->row_error_display($form_name, 'bf_id[]', $bf_id_error, 'select', 'product_row', ($i+1));
                        }
                    }
                }
                if(isset($quantity[$i])) {
                    $quantity_error = "";
                    $quantity_error = $valid->valid_number($quantity[$i], 'Qty', 1);
                    if(!empty($quantity_error)) {
                        if(!empty($valid_stock_request)) {
                            $valid_stock_request = $valid_stock_request." ".$valid->row_error_display($form_name, 'quantity[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                        else {
                            $valid_stock_request = $valid->row_error_display($form_name, 'quantity[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                    }
                }
                if(empty($valid_stock_request)) {
                    for($j=$i+1; $j < count($size_ids); $j++) {
                        $combination_error_1 = ""; $combination_error_2 = "";
                        if($size_ids[$i] == $size_ids[$j] && $gsm_ids[$i] == $gsm_ids[$j] && $bf_ids[$i] == $bf_ids[$j]) {
                            $combination_error_1 = "Same Combination in ".($j + 1);
                            $combination_error_2 = "Same Combination in ".($i + 1);
                        }
                        if(!empty($combination_error_1)) {
                            if(!empty($valid_stock_request)) {
                                $valid_stock_request = $valid_stock_request." ".$valid->row_error_display($form_name, 'size_id[]', $combination_error_1, 'select', 'product_row', ($i+1));
                            }
                            else {
                                $valid_stock_request = $valid->row_error_display($form_name, 'size_id[]', $combination_error_1, 'select', 'product_row', ($i+1));
                            }
                        }
                        if(!empty($combination_error_2)) {
                            if(!empty($valid_stock_request)) {
                                $valid_stock_request = $valid_stock_request." ".$valid->row_error_display($form_name, 'size_id[]', $combination_error_2, 'select', 'product_row', ($j+1));
                            }
                            else {
                                $valid_stock_request = $valid->row_error_display($form_name, 'size_id[]', $combination_error_2, 'select', 'product_row', ($j+1));
                            }
                            break;
                        }
                    }
                    if(empty($valid_stock_request)) {
                        $size_name = "";
                        $size_name = $obj->getTableColumnValue($GLOBALS['size_table'], 'size_id', $size_ids[$i], 'size_name');
                        $size_names[$i] = $size_name;

                        $gsm_name = "";
                        $gsm_name = $obj->getTableColumnValue($GLOBALS['gsm_table'], 'gsm_id', $gsm_ids[$i], 'gsm_name');
                        $gsm_names[$i] = $gsm_name;
                        
                        $bf_name = "";
                        $bf_name = $obj->getTableColumnValue($GLOBALS['bf_table'], 'bf_id', $bf_ids[$i], 'bf_name');
                        $bf_names[$i] = $bf_name;

                        $total_quantity += $quantity[$i];
                    }
                }
            }
        }
        else {
            $stock_request_error = "Add Materials";
        }
        $result = "";
        if(empty($valid_stock_request) && empty($stock_request_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) { 
                /*
                if(!empty($edit_id)) {
                    $stock_delete_update = $obj->DeletePrevList($edit_id, $stock_unique_ids);
                }
                */
                if(!empty($bill_date)) {
                    $bill_date = date('Y-m-d', strtotime($bill_date));
                }
                $godown_name = ""; $godown_name_location = "";
                if(!empty($godown_id)) {
                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'godown_name');
                    $godown_name_location = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $godown_id, 'name_location');
                }
                else {
                    $godown_id = $GLOBALS['null_value'];
                    $godown_name = $GLOBALS['null_value'];
                    $godown_name_location = $GLOBALS['null_value'];
                }
                $factory_name = ""; $factory_name_location = "";
                if(!empty($factory_id)) {
                    $factory_name = $obj->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $factory_id, 'factory_name');
                    $factory_name_location = $obj->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $factory_id, 'name_location');
                }
                else {
                    $factory_id = $GLOBALS['null_value'];
                    $factory_name = $GLOBALS['null_value'];
                    $factory_name_location = $GLOBALS['null_value'];
                }
                if(!empty($remarks)) {
                    $remarks = $obj->encode_decode('encrypt', $remarks);
                }
                else {
                    $remarks = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($size_ids, fn($value) => $value !== ""))) {
                    $size_ids = implode(",", $size_ids);
                }
                else {
                    $size_ids = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($size_names, fn($value) => $value !== ""))) {
                    $size_names = implode(",", $size_names);
                }
                else {
                    $size_names = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($gsm_ids, fn($value) => $value !== ""))) {
                    $gsm_ids = implode(",", $gsm_ids);
                }
                else {
                    $gsm_ids = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($gsm_names, fn($value) => $value !== ""))) {
                    $gsm_names = implode(",", $gsm_names);
                }
                else {
                    $gsm_names = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($bf_ids, fn($value) => $value !== ""))) {
                    $bf_ids = implode(",", $bf_ids);
                }
                else {
                    $bf_ids = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($bf_names, fn($value) => $value !== ""))) {
                    $bf_names = implode(",", $bf_names);
                }
                else {
                    $bf_names = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($quantity, fn($value) => $value !== ""))) {
                    $quantity = implode(",", $quantity);
                }
                else {
                    $quantity = $GLOBALS['null_value'];
                }
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $updated_date_time = $GLOBALS['create_date_time_label'];
                $bill_company_id = $GLOBALS['bill_company_id'];
                $bill_company_name = ""; $bill_company_details = "";
                if(!empty($bill_company_id)) {
                    $bill_company_name = $obj->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $bill_company_id, 'factory_name');
                    $bill_company_details = $obj->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $bill_company_id, 'factory_details');
                }
                else {
                    $bill_company_id = $GLOBALS['null_value'];
                    $bill_company_name = $GLOBALS['null_value'];
                    $bill_company_details = $GLOBALS['null_value'];
                }
                $update_stock = 0; $stock_request_id = ""; $stock_request_number = "";
                if(empty($edit_id)) {
                    $action = "";
                    $action = "New Stock Request Created.";

                    $null_value = $GLOBALS['null_value'];
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'updated_date_time', 'creator', 'creator_name', 'bill_company_id', 'bill_company_name', 'bill_company_details', 'stock_request_id', 'stock_request_number', 'bill_date', 'godown_id', 'godown_name', 'godown_name_location', 'factory_id', 'factory_name', 'factory_name_location', 'remarks', 'size_id', 'size_name', 'gsm_id', 'gsm_name', 'bf_id', 'bf_name', 'quantity', 'total_quantity', 'cancelled', 'deleted');
                    $values = array("'".$created_date_time."'", "'".$updated_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$bill_company_name."'", "'".$bill_company_details."'", "'".$null_value."'", "'".$null_value."'", "'".$bill_date."'", "'".$godown_id."'", "'".$godown_name."'", "'".$godown_name_location."'", "'".$factory_id."'", "'".$factory_name."'", "'".$factory_name_location."'", "'".$remarks."'", "'".$size_ids."'", "'".$size_names."'", "'".$gsm_ids."'", "'".$gsm_names."'", "'".$bf_ids."'", "'".$bf_names."'", "'".$quantity."'", "'".$total_quantity."'", "'0'", "'0'");

                    $stock_request_insert_id = $obj->InsertSQL($GLOBALS['stock_request_table'], $columns, $values,'stock_request_id', 'stock_request_number', $action);

                    if(preg_match("/^\d+$/", $stock_request_insert_id)) {
                        $update_stock = 1;
                        $stock_request_id = $obj->getTableColumnValue($GLOBALS['stock_request_table'], 'id', $stock_request_insert_id, 'stock_request_id');
                        $stock_request_number = $obj->getTableColumnValue($GLOBALS['stock_request_table'], 'id', $stock_request_insert_id, 'stock_request_number');
                        $result = array('number' => '1', 'msg' => 'Stock Requested Successfully');
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $stock_request_insert_id);
                    }
                }
                else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['stock_request_table'], 'stock_request_id', $edit_id, 'id');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        $action = "Stock Request Updated.";

                        $columns = array(); $values = array();		
                        $columns = array('updated_date_time', 'creator_name', 'bill_company_name', 'bill_company_details', 'bill_date', 'godown_id', 'godown_name', 'godown_name_location', 'factory_id', 'factory_name', 'factory_name_location', 'remarks', 'size_id', 'size_name', 'gsm_id', 'gsm_name', 'bf_id', 'bf_name', 'quantity', 'total_quantity');
                        $values = array("'".$updated_date_time."'", "'".$creator_name."'", "'".$bill_company_name."'", "'".$bill_company_details."'", "'".$bill_date."'", "'".$godown_id."'", "'".$godown_name."'", "'".$godown_name_location."'", "'".$factory_id."'", "'".$factory_name."'", "'".$factory_name_location."'", "'".$remarks."'", "'".$size_ids."'", "'".$size_names."'", "'".$gsm_ids."'", "'".$gsm_names."'", "'".$bf_ids."'", "'".$bf_names."'", "'".$quantity."'", "'".$total_quantity."'");

                        $stock_request_update_id = $obj->UpdateSQL($GLOBALS['stock_request_table'], $getUniqueID, $columns, $values, $action);

                        if(preg_match("/^\d+$/", $stock_request_update_id)) {
                            $update_stock = 1;
                            $stock_request_id = $edit_id;
                            $stock_request_number = $obj->getTableColumnValue($GLOBALS['stock_request_table'], 'stock_request_id', $stock_request_id, 'stock_request_number');
                            $result = array('number' => '1', 'msg' => 'Updated Successfully');
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $stock_request_update_id);
                        }							
                    }
                }
                /*
                if($update_stock == '1' && !empty($stock_request_id) && !empty($stock_request_number)) {
                    if(!empty($size_ids) && $size_ids != $GLOBALS['null_value']) {
                        $size_ids = explode(",", $size_ids);
                    }
                    else {
                        $size_ids = array();
                    }
                    if(!empty($gsm_ids) && $gsm_ids != $GLOBALS['null_value']) {
                        $gsm_ids = explode(",", $gsm_ids);
                    }
                    else {
                        $gsm_ids = array();
                    }
                    if(!empty($bf_ids) && $bf_ids != $GLOBALS['null_value']) {
                        $bf_ids = explode(",", $bf_ids);
                    }
                    else {
                        $bf_ids = array();
                    }
                    if(!empty($quantity) && $quantity != $GLOBALS['null_value']) {
                        $quantity = explode(",", $quantity);
                    }
                    else {
                        $quantity = array();
                    }
                    if(!empty($size_ids)) {
                        $remarks = "";
                        $remarks = $obj->encode_decode('encrypt', $stock_request_number);
                        for($i=0; $i < count($size_ids); $i++) {
                            if(!empty($factory_id)) {
                                $stock_update = $obj->StockUpdate($GLOBALS['stock_request_table'], 'Out', '', $stock_request_id, $stock_request_number, $remarks, $bill_date, $factory_id, '', $size_ids[$i], $gsm_ids[$i], $bf_ids[$i], $quantity[$i]);
                            }
                            if(!empty($godown_id)) {
                                $stock_update = $obj->StockUpdate($GLOBALS['stock_request_table'], 'In', '', $stock_request_id, $stock_request_number, $remarks, $bill_date, '', $godown_id, $size_ids[$i], $gsm_ids[$i], $bf_ids[$i], $quantity[$i]);
                            }
                        }
                    }
                }
                */
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_stock_request)) {
                $result = array('number' => '3', 'msg' => $valid_stock_request);
            }
            else if(!empty($stock_request_error)) {
                $result = array('number' => '2', 'msg' => $stock_request_error);
            }
        }
        
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    }
    if(isset($_POST['draw'])){
        $draw = trim($_POST['draw']);

        $searchValue = ""; $filter_from_date = ""; $filter_to_date = ""; $filter_factory_id = ""; $filter_godown_id = 0; $cancelled = 0;
        if(isset($_POST['start'])) {
            $row = trim($_POST['start']);
        }
        if(isset($_POST['length'])) {
            $rowperpage = trim($_POST['length']);
        }
        if(isset($_POST['search_text'])) {
            $searchValue = trim($_POST['search_text']);
        }
        if(isset($_POST['filter_from_date'])) {
            $filter_from_date = trim($_POST['filter_from_date']);
        }
        if(isset($_POST['filter_to_date'])) {
            $filter_to_date = trim($_POST['filter_to_date']);
        }
        if(isset($_POST['filter_godown_id'])) {
            $filter_godown_id = trim($_POST['filter_godown_id']);
        }
        if(isset($_POST['filter_factory_id'])) {
            $filter_factory_id = trim($_POST['filter_factory_id']);
        }
        if(isset($_POST['cancel'])) {
            $cancelled = trim($_POST['cancel']);
        }
        $page_title = "Stock Request";
        $order_column = "";
        $order_column_index = "";
        $order_direction = "";

        if(isset($_POST['order'][0]['column'])) {
            $order_column_index = intval($_POST['order'][0]['column']);
        }
        if(isset($_POST['order'][0]['dir'])) {
            $order_direction = $_POST['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';
        }
        $columns = [
            0 => '',
            1 => 'bill_date',
            2 => 'stock_request_number',
            3 => 'godown_name',
            4 => 'total_quantity',
            5 => '',
            6 => '',
        ];
        if(!empty($order_column_index) && isset($columns[$order_column_index])) {
            $order_column = $columns[$order_column_index];
        }

        $totalRecords = 0;
        $totalRecords = count($obj->getStockRequestList($row, $rowperpage, $searchValue, $filter_from_date, $filter_to_date, $filter_factory_id, $filter_godown_id, $cancelled, $order_column, $order_direction));
        $filteredRecords = count($obj->getStockRequestList('', '', $searchValue, $filter_from_date, $filter_to_date, $filter_factory_id, $filter_godown_id, $cancelled, $order_column, $order_direction));

        $data = [];

        $StockRequestList = $obj->getStockRequestList($row, $rowperpage, $searchValue, $filter_from_date, $filter_to_date, $filter_factory_id, $filter_godown_id, $cancelled, $order_column, $order_direction);
        
        $sno = $row + 1;
        foreach ($StockRequestList as $val) {
            $bill_date = ""; $stock_request_number = ""; $godown_name = ""; $total_quantity = 0;
            if(!empty($val['bill_date']) && $val['bill_date'] != "0000-00-00") {
                $bill_date = date('d-m-Y', strtotime($val['bill_date']));
            }
            if(!empty($val['stock_request_number']) && $val['stock_request_number'] != $GLOBALS['null_value']) {
                $stock_request_number = $val['stock_request_number'];
            }
            if(!empty($val['godown_name']) && $val['godown_name'] != $GLOBALS['null_value']){
                $godown_name = $obj->encode_decode('decrypt', $val['godown_name']);
            }
            if(!empty($val['total_quantity']) && $val['total_quantity'] != $GLOBALS['null_value']){
                $total_quantity = $val['total_quantity'];
            }
            $material_view = '<a href="Javascript:ViewBillContent('.'\''.$GLOBALS['stock_request_table'].'\''.', '.'\''.$val['stock_request_id'].'\''.');"><i class="fa fa-eye"></i></a>';
            $action = ""; $edit_option = ""; $delete_option = ""; $print_option = ""; $a5_print_option = ""; $delivery_slip = "";
            $access_error = "";
            if(!empty($login_staff_id)) {
                $permission_action = $edit_action;
                include('permission_action.php');
            }
            if(empty($access_error) && empty($val['cancelled'])) {
                $edit_option = '<li><a class="dropdown-item" href="Javascript:ShowModalContent('.'\''.$page_title.'\''.', '.'\''.$val['stock_request_id'].'\''.');"><i class="fa fa-pencil"></i>&nbsp; Edit</a></li>';
            }
            $access_error = "";
            if(!empty($login_staff_id)) {
                $permission_action = $delete_action;
                include('permission_action.php');
            }
            if(empty($access_error) && empty($val['cancelled'])) {
                $delete_option = '<li><a class="dropdown-item" href="Javascript:DeleteModalContent('.'\''.$page_title.'\''.', '.'\''.$val['stock_request_id'].'\''.');"><i class="fa fa-ban"></i>&nbsp; Cancel</a></li>';
            }
            $print_option = '<li><a class="dropdown-item" target="_blank" href="reports/rpt_stock_request_a4.php?view_stock_request_id=' . $val['stock_request_id'] . '"><i class="fa fa-print"></i>&nbsp; A4 Print</a></li>';

            $a5_print_option = '<li><a class="dropdown-item" target="_blank" href="reports/rpt_stock_request_a5.php?view_stock_request_id=' . $val['stock_request_id'] . '"><i class="fa fa-print"></i>&nbsp; A5 Print</a></li>';

            if(empty($val['cancelled'])) {
                $delivery_slip = '<li><a class="dropdown-item" href="Javascript:ShowStockRequestConversion('.'\''.$val['stock_request_id'].'\''.');"><i class="fa fa-share"></i>&nbsp; Delivery Slip</a></li>';
            }
            
            $action = '<div class="dropdown">
                            <a href="#" role="button" class="btn btn-dark py-1 px-2" id="dropdownMenuLink'.$val['stock_request_id'].'" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink'.$val['stock_request_id'].'">
                                '.$print_option.$a5_print_option.$delivery_slip.$edit_option.$delete_option.'
                            </ul>
                        </div>';
            $data[] = [
                "sno" => $sno++,
                "bill_date" => $bill_date,
                "stock_request_number" => $stock_request_number,
                "godown_name" => $godown_name,
                "total_quantity" => $total_quantity,
                "view" => $material_view,
                "action" => $action
            ];
        }

        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ];

        echo json_encode($response);
    }
    if(isset($_REQUEST['delete_stock_request_id'])) {
        $delete_stock_request_id = trim($_REQUEST['delete_stock_request_id']);
        $msg = "";
        if(!empty($delete_stock_request_id)) {	
            $stock_request_unique_id = "";
            $stock_request_unique_id = $obj->getTableColumnValue($GLOBALS['stock_request_table'], 'stock_request_id', $delete_stock_request_id, 'id');
        
            if(preg_match("/^\d+$/", $stock_request_unique_id)) {
                $stock_request_number = "";
                $stock_request_number = $obj->getTableColumnValue($GLOBALS['stock_request_table'], 'stock_request_id', $delete_stock_request_id, 'stock_request_number');
            
                $action = "";
                if(!empty($stock_request_number)) {
                    $action = "Stock Request Cancelled. Bill No. - ".$stock_request_number;
                }
                // $stock_delete = 0;
                // $stock_delete = $obj->DeleteBillStock($GLOBALS['stock_request_table'], $delete_stock_request_id);
                // if($stock_delete == '1') {
                    $columns = array(); $values = array();
                    $columns = array('cancelled');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['stock_request_table'], $stock_request_unique_id, $columns, $values, $action);
                // }
                // else {
                //     $msg = "Can't Cancel. Stock goes to negative!";
                // }
            }
            else {
                $msg = "Invalid Request";
            }
        }
        else {
            $msg = "Empty Request";
        }
        echo $msg;
        exit;	
    }
    if(isset($_REQUEST['product_row_index'])) {
        $product_row_index = trim($_REQUEST['product_row_index']);

        $godown_id = "";
        if(isset($_REQUEST['godown_id'])) {
            $godown_id = trim($_REQUEST['godown_id']);
        }
        $factory_id = "";
        if(isset($_REQUEST['factory_id'])) {
            $factory_id = trim($_REQUEST['factory_id']);
        }
        $size_id = "";
        if(isset($_REQUEST['selected_size_id'])) {
            $size_id = trim($_REQUEST['selected_size_id']);
        }
        $gsm_id = "";
        if(isset($_REQUEST['selected_gsm_id'])) {
            $gsm_id = trim($_REQUEST['selected_gsm_id']);
        }
        $bf_id = "";
        if(isset($_REQUEST['selected_bf_id'])) {
            $bf_id = trim($_REQUEST['selected_bf_id']);
        }
        $quantity = "";
        if(isset($_REQUEST['selected_quantity'])) {
            $quantity = trim($_REQUEST['selected_quantity']);
        }
        $size_list = array();
        $size_list = $obj->getTableRecords($GLOBALS['size_table'], '', '');
        $gsm_list = array();
        $gsm_list = $obj->getTableRecords($GLOBALS['gsm_table'], '', '');
        $bf_list = array();
        $bf_list = $obj->getTableRecords($GLOBALS['bf_table'], '', '');
        ?>
        <tr class="product_row py-2" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
            <th class="sno text-center px-2 py-2"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></th>
            <th class="size_element text-center px-2 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select name="size_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:RequestRowCheck(this);">
                            <?php
                                if(!empty($size_list)) {
                                    foreach($size_list as $data) {
                                        if(!empty($data['size_id']) && $data['size_id'] != $GLOBALS['null_value']) {
                                            ?>
                                            <option value="<?php echo $data['size_id']; ?>" <?php if(!empty($size_id) && $size_id == $data['size_id']) { ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($data['size_name']) && $data['size_name'] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $data['size_name']);
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                        </select>
                        <label>Reels Size <span class="text-danger">*</span></label>
                    </div>
                </div>
            </th>
            <th class="gsm_element text-center px-2 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select name="gsm_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:RequestRowCheck(this);">
                            <?php
                                if(!empty($gsm_list)) {
                                    foreach($gsm_list as $data) {
                                        if(!empty($data['gsm_id']) && $data['gsm_id'] != $GLOBALS['null_value']) {
                                            ?>
                                            <option value="<?php echo $data['gsm_id']; ?>" <?php if(!empty($gsm_id) && $gsm_id == $data['gsm_id']) { ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($data['gsm_name']) && $data['gsm_name'] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $data['gsm_name']);
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                        </select>
                        <label>GSM <span class="text-danger">*</span></label>
                    </div>
                </div>
            </th>
            <th class="bf_element text-center px-2 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select name="bf_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:RequestRowCheck(this);">
                            <?php   
                                if(!empty($bf_list)) {
                                    foreach($bf_list as $data) {
                                        if(!empty($data['bf_id']) && $data['bf_id'] != $GLOBALS['null_value']) {
                                            ?>
                                            <option value="<?php echo $data['bf_id']; ?>" <?php if(!empty($bf_id) && $bf_id == $data['bf_id']) { ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($data['bf_name']) && $data['bf_name'] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $data['bf_name']);
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                        </select>
                        <label>BF <span class="text-danger">*</span></label>
                    </div>
                </div>
            </th>
            <th class="quantity_element text-center px-2 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <input type="text" name="quantity[]" class="form-control shadow-none" style="width:90px;" onfocus="Javascript:KeyboardControls(this,'number',8,'');" value="<?php if(!empty($quantity)) { echo $quantity; } ?>" onkeyup="Javascript:RequestRowCheck(this);">
                    </div>
                </div> 
            </th>
            <th class="delete_element text-center px-2 py-2">
                <a class="pe-2" onclick="Javascript:DeleteRequestRow('product_row', '<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');" style="cursor:pointer;"><i class="fa fa-trash text-danger"></i></a>
            </th>
            <script type="text/javascript">
                if(jQuery('#product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>').find('select').length > 0) {
                    jQuery('#product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>').find('select').select2();
                }
            </script>
        </tr>
        <?php
    }
?>