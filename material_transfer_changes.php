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
            <div class="row justify-content-center p-3">
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
                <!-- <div class="col-lg-12">
                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-2 col-md-6 col-12 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border chargesaction">
                                    <div class="input-group">
                                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option>Select Reel Size</option>
                                            <option>120.5</option>
                                            <option>130.5</option>
                                        </select>
                                        <label>Select Reel Size</label>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border chargesaction">
                                    <div class="input-group">
                                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option>Select GSM</option>
                                            <option>120</option>
                                            <option>130</option>
                                        </select>
                                        <label>Select GSM</label>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border chargesaction">
                                    <div class="input-group">
                                        <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option>Select BF</option>
                                            <option>120.5</option>
                                            <option>130.5</option>
                                        </select>
                                        <label>Select BF</label>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" id="" name="" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" placeholder="" required="">
                                    <label>QTY</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-1 col-md-2 col-6 px-lg-1  py-2">
                            <button class="btn btn-danger py-2" style="font-size:12px; width:100%;" type="button">  Add </button>
                        </div>
                    </div>
                    <div class="row justify-content-center"> 
                        <div class="col-lg-10">
                            <div class="table-responsive text-center">
                                <table class="table nowrap cursor smallfnt table-bordered">
                                    <thead class="bg-dark smallfnt">
                                        <tr style="white-space:pre;">
                                            <th>#</th>
                                            <th>Reel Size</th>
                                            <th>GSM</th>
                                            <th>BF</th>
                                            <th>Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>120.5</td>
                                            <td>180</td>
                                            <td>50</td>
                                            <td>10</td>
                                            <td>
                                                <a class="pe-2" href="#"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 py-3 text-center">
                            <button class="btn btn-danger" type="button">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>      -->
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
<?php	}?>