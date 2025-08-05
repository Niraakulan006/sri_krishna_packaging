<?php
include("include_files.php");
$login_staff_id = "";
if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
    if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
        $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
        $permission_module = $GLOBALS['bf_module'];
    }
}
	if(isset($_REQUEST['show_bf_id'])) { 
        $show_bf_id = "";
        $show_bf_id = $_REQUEST['show_bf_id'];
    
        $bf_name = "";
        if(!empty($show_bf_id)) {
            $bf_list = array();
            $bf_list = $obj->getTableRecords($GLOBALS['bf_table'], 'bf_id', $show_bf_id, '');
            if(!empty($bf_list)) {
                foreach ($bf_list as $data) {
                    if(!empty($data['bf_name'])) {
                        $bf_name = $obj->encode_decode('decrypt', $data['bf_name']);
                    }
                }
            }
        } 
    ?>
        <form class="poppins pd-20 redirection_form" name="bf_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_bf_id)){ ?>
                            <div class="h5">Edit BF</div>
                        <?php 
                        } else{ ?>
                            <div class="h5">Add BF</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('bf.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id"value="<?php if(!empty($show_bf_id)) {  echo $show_bf_id; } ?>">
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" class="form-control shadow-none" placeholder=""  id="bf_name" name="bf_name" value="<?php if(!empty($bf_name)) { echo $bf_name; } ?>" onkeydown="Javascript:KeyboardControls(this,'number',15,'');" onkeyup="Javascript:InputBoxColor(this,'text');" required="">
                                <label>BF<span class="text-danger">*</span></label>
                                <?php if(empty($show_bf_id)) { ?>                                
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" onclick="Javascript:addCreationDetails('bf', 15);"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="new_smallfnt">Contains Number & Decimals</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center"> 
                <?php if(empty($show_bf_id)) { ?>
                <div class="col-lg-6">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="bf_count" value="0">                        
                        <table class="table nowrap cursor smallfnt w-100 table-bordered added_bf_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>BF Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody> 
                        </table>
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent('bf_form', 'bf_changes.php', 'bf.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    jQuery('#bf_name').on("keypress", function(e) {
                        if(e.keyCode == 13) {
                            addCreationDetails('bf', 15);
                            return false;
                        }
                    });
                });
            </script>            
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
    if(isset($_POST['edit_id'])) {
        $bf_name = array(); $bf_name_error = ""; 
        $valid_bf = ""; $form_name = "bf_form"; $bf_error = "";
        $single_bf_name = ""; $prev_bf_id = "";
    
        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(!empty($edit_id)) {
            if(isset($_POST['bf_name'])) {
                $single_bf_name = $_POST['bf_name'];
                $single_bf_name = trim($single_bf_name);
                $bf_name_error = $valid->valid_price($single_bf_name, "BF Name", "1");
            }
            if(!empty($bf_name_error)) {
                $valid_bf = $valid->error_display($form_name, "bf_name", $bf_name_error, 'text');
            }
            else {
                $single_bf_name = $obj->encode_decode("encrypt", $single_bf_name);
                if(!empty($single_bf_name)) {
                    $prev_bf_id = $obj->CheckBFAlreadyExists($GLOBALS['bill_company_id'], $single_bf_name);
                    if(!empty($prev_bf_id)) {
                        if($prev_bf_id != $edit_id) {
                            $bf_error = "This BF - " . $obj->encode_decode("decrypt", $single_bf_name) . " is already exist";
                        }
                    }
                }
            }
        }
    
        if(empty($edit_id)) {
            if(isset($_POST['bf_names'])) {
                $bf_name = $_POST['bf_names'];
            }
            $inputbox_bf_name = "";
            $inputbox_bf_name = $_POST['bf_name'];
    
            if(!empty($inputbox_bf_name) && empty($bf_name)) {
                $bf_add_error = "Click Add Button to Append BF";
                if(!empty($bf_add_error)) {
                    $valid_bf = $valid->error_display($form_name, "bf_name", $bf_add_error, 'text');
                }
            } else if(empty($inputbox_bf_name) && empty($bf_name)) {
                $bf_add_error = "Enter BF Value";
                if(!empty($bf_add_error)) {
                    $valid_bf = $valid->error_display($form_name, "bf_name", $bf_add_error, 'text');
                }
            } else if(!empty($inputbox_bf_name)) {
                $bf_add_error = "Click Add Button to Append BF";
                if(!empty($bf_add_error)) {
                    $valid_bf = $valid->error_display($form_name, "bf_name", $bf_add_error, 'text');
                }
            }
            if(!empty($bf_name)) {
                for ($p = 0; $p < count($bf_name); $p++) {
                    $bf_name_error = $valid->valid_price($bf_name[$p], "Invalid BF Value - ". $bf_name[$p], "0");
                    if(!empty($bf_name_error)) {
                        $bf_name_error = "Invalid BF Value - " . $bf_name[$p];
                    }
                    else {
                        $bf_name[$p] = $obj->encode_decode('encrypt', $bf_name[$p]);
                    }
    
                    if(!empty($bf_name_error)) {
                        if(!empty($valid_bf)) {
                            $valid_bf = $valid_bf." ".$valid->error_display($form_name, "bf_name", $bf_name_error, 'text');
                        }
                        else {
                            $valid_bf = $valid->error_display($form_name, "bf_name", $bf_name_error, 'text');
                        }
                    }
                }
            }
        }
    
        $result = "";
        if(empty($valid_bf) && empty($bf_name_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
            $bill_company_id = $GLOBALS['bill_company_id'];
            
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                for ($i = 0; $i < count($bf_name); $i++) {
                    if(!empty($bf_name[$i])) {
                        $prev_bf_id = $obj->CheckBFAlreadyExists($bill_company_id, $bf_name[$i]);
                        if(!empty($prev_bf_id)) {
                            $bf_error = "This BF - " . $obj->encode_decode("decrypt", $bf_name[$i]) . " is already exist";
                        }
                    }
                }
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
    
                if(empty($bf_error)) {
                    if(empty($edit_id)) {
                        $action = array();
                        for ($p = 0; $p < count($bf_name); $p++) {
                            if(empty($prev_bf_id)) {
                                if(!empty($bf_name[$p])) {
                                    $action[$p] = "New BF Created. Name - " . $obj->encode_decode('decrypt', $bf_name[$p]);
                                }
    
                                $null_value = $GLOBALS['null_value'];
                                $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'bf_id', 'bf_name', 'deleted');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$bf_name[$p]."'",  "'0'");
    
                                $bf_insert_id = $obj->InsertSQL($GLOBALS['bf_table'], $columns, $values, 'bf_id', '', $action[$p]);		
                                if(preg_match("/^\d+$/", $bf_insert_id)) {								
                                    $result = array('number' => '1', 'msg' => 'BF Successfully Created');						
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $bf_insert_id);
                                }
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $bf_error);
                            }
                        }
                    } 
                    else if(!empty($edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['bf_table'], 'bf_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($single_bf_name)) {
                                $action = "BF Updated. Name - " . $obj->encode_decode('decrypt', $single_bf_name);
                            }
    
                            $columns = array(); $values = array();
                            $columns = array('creator_name', 'bf_name');
                            $values = array("'".$creator_name."'", "'".$single_bf_name."'");
                            $bf_update_id = $obj->UpdateSQL($GLOBALS['bf_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $bf_update_id)) {
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $bf_update_id);
                            }
                        }
                    }
                } 
                else {
                    $result = array('number' => '2', 'msg' => $bf_error);
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_bf)) {
                $result = array('number' => '3', 'msg' => $valid_bf);
            }
            if(!empty($bf_name_error)) {
                $result = array('number' => '2', 'msg' => $bf_name_error);		
            }
        }
    
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result;
        exit;
    }    
    if(isset($_POST['page_number'])) {
        $page_number = $_POST['page_number'];
        $page_limit = $_POST['page_limit'];
        $page_title = $_POST['page_title'];
    
        $search_text = "";
        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
            $search_text = trim($search_text);
        }
    
        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['bf_table'], '', '','');
    
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['bf_name']))), $search_text) !== false)) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }
    
        $total_pages = 0;
        $total_pages = count($total_records_list);
    
        $page_start = 0;
        $page_end = 0;
        if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
            if($total_pages > $page_limit) {
                if($page_number) {
                    $page_start = ($page_number - 1) * $page_limit;
                    $page_end = $page_start + $page_limit;
                }
            } else {
                $page_start = 0;
                $page_end = $page_limit;
            }
        }
    
        $show_records_list = array();
        if(!empty($total_records_list)) {
            foreach ($total_records_list as $key => $val) {
                if($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }
    
        $prefix = 0;
        if(!empty($page_number) && !empty($page_limit)) {
            $prefix = ($page_number * $page_limit) - $page_limit;
        }
        if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3">
                <?php
                include("pagination.php");
                ?>
            </div>
            <?php 
        } 
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) { 
            ?>
           
            <table class="table nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <tr>
                        <th>S.No</th>
                        <th>BF Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($show_records_list)) {
                            $count_bf = 0;
                            foreach ($show_records_list as $key => $list) {
                                $index = $key + 1;
    
                                if(!empty($prefix)) {
                                    $index = $index + $prefix;
                                } 
                                ?>
                                <tr style="cursor:default;">
                                    <td><?php echo $index; ?></td>
    
                                    <td class="text-center">
                                        <?php
                                            $bf_name = "";
                                            if(!empty($list['bf_name'])) {
                                                $bf_name = $list['bf_name'];
                                                $bf_name = $obj->encode_decode('decrypt', $bf_name);
                                                echo $bf_name;
                                            }
                                        ?>
                                    </td>
                        <td>
                            <?php $edit_access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $edit_action;
                                        include('permission_action.php');
                                    }
                                    $delete_access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $delete_action;
                                        include('permission_action.php');
                                    }
                            ?>
                        <?php if (empty($edit_access_error) || empty($delete_access_error)) { ?>
                            <div class="dropdown">
                                <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <?php if(empty($edit_access_error)) { 
                                        ?>
                                    <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['bf_id'])) { echo $list['bf_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                    <?php } 
                                    
                                    if(empty($delete_access_error)) {
                                        $linked_count = 0;
                                        // $linked_count = $obj->GetLinkedCount($list['bf_id'], $GLOBALS['inward_material_table'], 'bf_id');
                                        if(!empty($linked_count)) { ?>
                                            <li><a class="dropdown-item text-secondary"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                        <?php 
                                        } else {  ?>
                                            <li><a class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['bf_id'])) { echo $list['bf_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                        <?php } 
                                            } ?>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } 
                        else {
                            ?>
                            <tr>
                                <td colspan="3" class="text-center">Sorry! No records found</td>
                            </tr>
                            <?php 
                        }  
                    ?>
                </tbody>
            </table>
            <?php
        }
    }    
    if(isset($_REQUEST['bf_row_index'])) {
        $bf_row_index = $_REQUEST['bf_row_index'];
        $selected_bf_name = $_REQUEST['selected_bf_name'];
        ?>
        <tr class="bf_row" id="bf_row<?php if(!empty($bf_row_index)) { echo $bf_row_index; } ?>">
            <td class="text-center sno"><?php if(!empty($bf_row_index)) { echo $bf_row_index; } ?></td>
            <td class="text-center">
                <?php
                    if(!empty($selected_bf_name)) {
                        $selected_bf_name = str_replace("@@@", "&", $selected_bf_name);
                        echo $selected_bf_name;
                    }    
                ?>
                <input type="hidden" name="bf_names[]" value="<?php if(!empty($selected_bf_name)) { echo $selected_bf_name; } ?>">
            </td>
            <td class="text-center product_pad">
                <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('bf', '<?php if(!empty($bf_row_index)) { echo $bf_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        <?php
    }    
    if(isset($_REQUEST['delete_bf_id'])) {
        $delete_bf_id = $_REQUEST['delete_bf_id'];
        $msg = "";
        if(!empty($delete_bf_id)) {
            $bf_unique_id = "";
            $bf_unique_id = $obj->getTableColumnValue($GLOBALS['bf_table'], 'bf_id', $delete_bf_id, 'id');
            if(preg_match("/^\d+$/", $bf_unique_id)) {
                $bf_name = "";
                $bf_name = $obj->getTableColumnValue($GLOBALS['bf_table'], 'bf_id', $delete_bf_id, 'bf_name');
    
                $action = "";
                if(!empty($bf_name)) {
                    $action = "BF Deleted. Value - " . $obj->encode_decode('decrypt', $bf_name);
                }
                $linked_count = 0;
                // $linked_count = $obj->GetbfLinkedCount($delete_bf_id);
                // if(empty($linked_count)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['bf_table'], $bf_unique_id, $columns, $values, $action);
                // }
                // else {
                //     $msg = "This bf is associated with other screens";
                // }
            }
        }
        echo $msg;
        exit;
    }    
    ?>