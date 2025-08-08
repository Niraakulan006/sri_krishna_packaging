<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['material_transfer_module'];
        }
    }
	if(isset($_REQUEST['show_material_transfer_id'])) { 
        $show_material_transfer_id = trim($_REQUEST['show_material_transfer_id']); 
        $factory_id = "";
        $factory_id = $obj->getTableColumnValue($GLOBALS['factory_table'], 'primary_factory', '1', 'factory_id');
        $product_count = 0;

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
        $size_list = $obj->GetCurrentStockByMaterial('size', $show_material_transfer_id, '', $factory_id);
        $size_count = 0;
        if(!empty($size_list)) {
            $size_count = count($size_list);
        }
        $gsm_list = array();
        $gsm_list = $obj->GetCurrentStockByMaterial('gsm', $show_material_transfer_id, '', $factory_id);
        $gsm_count = 0;
        if(!empty($gsm_list)) {
            $gsm_count = count($gsm_list);
        }
        $bf_list = array();
        $bf_list = $obj->GetCurrentStockByMaterial('bf', $show_material_transfer_id, '', $factory_id);
        $bf_count = 0;
        if(!empty($bf_list)) {
            $bf_count = count($bf_list);
        }
        ?>
        <form class="poppins pd-20" name="material_transfer_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_material_transfer_id)) { ?>
                            <div class="h5">Edit Material Transfer</div>
                        <?php } else { ?>
                            <div class="h5">Add Material Transfer</div>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('material_transfer.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-2">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_material_transfer_id)) { echo $show_material_transfer_id; } ?>">
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
                        <div class="form-label-group in-border">
                            <select name="factory_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
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
                            <select name="godown_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
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
                        <button class="btn btn-success py-2 add_product_button" style="font-size:11px; width:120px;" type="button" onclick="Javascript:AddTransferRow();">Add To Table</button>
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
                                    if(empty($show_material_transfer_id)) { 
                                        ?>
                                        <tr class="no_data_row py-2">
                                            <th class="text-center px-2 py-2" colspan="6">No Data Found!</th>
                                        </tr>
                                        <?php 
                                    } 
                                    else { 
                                        if(!empty($size_ids)) {
                                            for($i=0; $i < count($size_ids); $i++) {
                                                ?>
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
                    <button class="btn btn-primary" type="button" onclick="Javascript:SaveModalContent('material_transfer_form', 'material_transfer_changes.php', 'material_transfer.php');"> Submit </button>
                </div>
            </div>
            
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
	<?php
    } 
    if(isset($_POST['page_number'])) {
        $page_number = $_POST['page_number'];
        $page_limit = $_POST['page_limit'];
        $page_title = $_POST['page_title']; ?>
    
        <table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>From Godown</th>
                    <th>To Godown</th>
                    <th>QTY</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Godown 1</td>
                    <td>Godown 2</td>
                    <td>50</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" class="btn btn-dark py-1 px-1" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <li><a class="dropdown-item" href="#">View</a></li>
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div> 
                    </td>
                </tr>
            </tbody>
        </table>                
        <?php 
    }
    if(isset($_REQUEST['product_row_index'])) {
        $product_row_index = trim($_REQUEST['product_row_index']);

        $material_transfer_id = "";
        if(isset($_REQUEST['material_edit_id'])) {
            $material_transfer_id = trim($_REQUEST['material_edit_id']);
        }
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
        $size_list = $obj->GetCurrentStockByMaterial('size', $material_transfer_id, '', $factory_id);
        $gsm_list = array();
        $gsm_list = $obj->GetCurrentStockByMaterial('gsm', $material_transfer_id, '', $factory_id);
        $bf_list = array();
        $bf_list = $obj->GetCurrentStockByMaterial('bf', $material_transfer_id, '', $factory_id);

        ?>
        <tr class="product_row py-2" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
            <th class="sno text-center px-2 py-2"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></th>
            <th class="size_element text-center px-2 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select name="size_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:TransferRowCheck(this);">
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
                        <select name="gsm_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:TransferRowCheck(this);">
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
                        <select name="bf_id[]" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:TransferRowCheck(this);">
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
                        <input type="text" name="quantity[]" class="form-control shadow-none" style="width:90px;" onfocus="Javascript:KeyboardControls(this,'number',8,'');" value="<?php if(!empty($quantity)) { echo $quantity; } ?>" onkeyup="Javascript:TransferRowCheck(this);">
                    </div>
                </div> 
            </th>
            <th class="delete_element text-center px-2 py-2">
                <a class="pe-2" onclick="Javascript:DeleteTransferRow('product_row', '<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');" style="cursor:pointer;"><i class="fa fa-trash text-danger"></i></a>
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