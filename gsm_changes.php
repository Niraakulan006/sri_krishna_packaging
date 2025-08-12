<?php
    include("include_files.php");
    $permission_module = $GLOBALS['gsm_module'];
    include("include_module_action.php");

	if(isset($_REQUEST['show_gsm_id'])) { 
        $show_gsm_id = "";
        $show_gsm_id = $_REQUEST['show_gsm_id'];
    
        $gsm_name = "";
        if(!empty($show_gsm_id)) {
            $gsm_list = array();
            $gsm_list = $obj->getTableRecords($GLOBALS['gsm_table'], 'gsm_id', $show_gsm_id);
            if(!empty($gsm_list)) {
                foreach ($gsm_list as $data) {
                    if(!empty($data['gsm_name'])) {
                        $gsm_name = $obj->encode_decode('decrypt', $data['gsm_name']);
                    }
                }
            }
        } 
        ?>
        <form class="poppins pd-20 redirection_form" name="gsm_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_gsm_id)){ ?>
                            <div class="h5">Edit GSM</div>
                        <?php 
                        } else{ ?>
                            <div class="h5">Add GSM</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('gsm.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id"value="<?php if(!empty($show_gsm_id)) {  echo $show_gsm_id; } ?>">
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" class="form-control shadow-none" placeholder=""  id="gsm_name" name="gsm_name" value="<?php if(!empty($gsm_name)) { echo $gsm_name; } ?>" onkeydown="Javascript:KeyboardControls(this,'number',3,'');" onkeyup="Javascript:InputBoxColor(this,'text');" required="">
                                <label>GSM<span class="text-danger">*</span></label>
                                <?php if(empty($show_gsm_id)) { ?>                                
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" onclick="Javascript:addCreationDetails('gsm', 3);"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="new_smallfnt">Contains Number Only</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center"> 
                <?php if(empty($show_gsm_id)) { ?>
                <div class="col-lg-6">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="gsm_count" value="0">                        
                        <table class="table nowrap cursor smallfnt w-100 table-bordered added_gsm_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>GSM Value</th>
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
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent('gsm_form', 'gsm_changes.php', 'gsm.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    jQuery('#gsm_name').on("keypress", function(e) {
                        if(e.keyCode == 13) {
                            addCreationDetails('gsm', 3);
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
        $gsm_name = array(); $gsm_name_error = ""; 
        $valid_gsm = ""; $form_name = "gsm_form"; $gsm_error = "";
        $single_gsm_name = ""; $prev_gsm_id = "";
    
        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(!empty($edit_id)) {
            if(isset($_POST['gsm_name'])) {
                $single_gsm_name = $_POST['gsm_name'];
                $single_gsm_name = trim($single_gsm_name);
                $gsm_name_error = $valid->valid_number($single_gsm_name, "GSM Name", "1");
            }
            if(!empty($gsm_name_error)) {
                $valid_gsm = $valid->error_display($form_name, "gsm_name", $gsm_name_error, 'text');
            }
            else {
                $single_gsm_name = $obj->encode_decode("encrypt", $single_gsm_name);
                if(!empty($single_gsm_name)) {
                    $prev_gsm_id = $obj->CheckGSMAlreadyExists($GLOBALS['bill_company_id'], $single_gsm_name);
                    if(!empty($prev_gsm_id)) {
                        if($prev_gsm_id != $edit_id) {
                            $gsm_error = "This GSM - " . $obj->encode_decode("decrypt", $single_gsm_name) . " is already exist";
                        }
                    }
                }
            }
        }
    
        if(empty($edit_id)) {
            if(isset($_POST['gsm_names'])) {
                $gsm_name = $_POST['gsm_names'];
            }
            $inputbox_gsm_name = "";
            $inputbox_gsm_name = $_POST['gsm_name'];
    
            if(!empty($inputbox_gsm_name) && empty($gsm_name)) {
                $gsm_add_error = "Click Add Button to Append GSM";
                if(!empty($gsm_add_error)) {
                    $valid_gsm = $valid->error_display($form_name, "gsm_name", $gsm_add_error, 'text');
                }
            } else if(empty($inputbox_gsm_name) && empty($gsm_name)) {
                $gsm_add_error = "Enter GSM Value";
                if(!empty($gsm_add_error)) {
                    $valid_gsm = $valid->error_display($form_name, "gsm_name", $gsm_add_error, 'text');
                }
            } else if(!empty($inputbox_gsm_name)) {
                $gsm_add_error = "Click Add Button to Append GSM";
                if(!empty($gsm_add_error)) {
                    $valid_gsm = $valid->error_display($form_name, "gsm_name", $gsm_add_error, 'text');
                }
            }
            if(!empty($gsm_name)) {
                for ($p = 0; $p < count($gsm_name); $p++) {
                    $gsm_name_error = $valid->valid_number($gsm_name[$p], "Invalid GSM Value - ". $gsm_name[$p], "0");
                    if(!empty($gsm_name_error)) {
                        $gsm_name_error = "Invalid GSM Value - " . $gsm_name[$p];
                    }
                    else {
                        $gsm_name[$p] = $obj->encode_decode('encrypt', $gsm_name[$p]);
                    }
    
                    if(!empty($gsm_name_error)) {
                        if(!empty($valid_gsm)) {
                            $valid_gsm = $valid_gsm." ".$valid->error_display($form_name, "gsm_name", $gsm_name_error, 'text');
                        }
                        else {
                            $valid_gsm = $valid->error_display($form_name, "gsm_name", $gsm_name_error, 'text');
                        }
                    }
                }
            }
        }
    
        $result = "";
        if(empty($valid_gsm) && empty($gsm_name_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
            $bill_company_id = $GLOBALS['bill_company_id'];
            
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                for ($i = 0; $i < count($gsm_name); $i++) {
                    if(!empty($gsm_name[$i])) {
                        $prev_gsm_id = $obj->CheckGSMAlreadyExists($bill_company_id, $gsm_name[$i]);
                        if(!empty($prev_gsm_id)) {
                            $gsm_error = "This GSM - " . $obj->encode_decode("decrypt", $gsm_name[$i]) . " is already exist";
                        }
                    }
                }
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
    
                if(empty($gsm_error)) {
                    if(empty($edit_id)) {
                        $action = array();
                        for ($p = 0; $p < count($gsm_name); $p++) {
                            if(empty($prev_gsm_id)) {
                                if(empty($add_access_error)) {
                                    if(!empty($gsm_name[$p])) {
                                        $action[$p] = "New GSM Created. Name - " . $obj->encode_decode('decrypt', $gsm_name[$p]);
                                    }
        
                                    $null_value = $GLOBALS['null_value'];
                                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'gsm_id', 'gsm_name', 'deleted');
                                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$gsm_name[$p]."'",  "'0'");
        
                                    $gsm_insert_id = $obj->InsertSQL($GLOBALS['gsm_table'], $columns, $values, 'gsm_id', '', $action[$p]);		
                                    if(preg_match("/^\d+$/", $gsm_insert_id)) {								
                                        $result = array('number' => '1', 'msg' => 'GSM Successfully Created');						
                                    }
                                    else {
                                        $result = array('number' => '2', 'msg' => $gsm_insert_id);
                                    }
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $add_access_error);
                                }
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $gsm_error);
                            }
                        }
                    } 
                    else if(!empty($edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['gsm_table'], 'gsm_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            if(empty($edit_access_error)) {
                                $action = "";
                                if(!empty($single_gsm_name)) {
                                    $action = "GSM Updated. Name - " . $obj->encode_decode('decrypt', $single_gsm_name);
                                }
        
                                $columns = array(); $values = array();
                                $columns = array('creator_name', 'gsm_name');
                                $values = array("'".$creator_name."'", "'".$single_gsm_name."'");
                                $gsm_update_id = $obj->UpdateSQL($GLOBALS['gsm_table'], $getUniqueID, $columns, $values, $action);
                                if(preg_match("/^\d+$/", $gsm_update_id)) {
                                    $result = array('number' => '1', 'msg' => 'Updated Successfully');
                                } 
                                else {
                                    $result = array('number' => '2', 'msg' => $gsm_update_id);
                                }
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $edit_access_error);
                            }
                        }
                    }
                } 
                else {
                    $result = array('number' => '2', 'msg' => $gsm_error);
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_gsm)) {
                $result = array('number' => '3', 'msg' => $valid_gsm);
            }
            if(!empty($gsm_name_error)) {
                $result = array('number' => '2', 'msg' => $gsm_name_error);		
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
        $total_records_list = $obj->getTableRecords($GLOBALS['gsm_table'], '', '');
    
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['gsm_name']))), $search_text) !== false)) {
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
        if(empty($view_access_error)) { 
            ?>
           
            <table class="table nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <tr>
                        <th>S.No</th>
                        <th>GSM Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($show_records_list)) {
                            $count_gsm = 0;
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
                                            $gsm_name = "";
                                            if(!empty($list['gsm_name'])) {
                                                $gsm_name = $list['gsm_name'];
                                                $gsm_name = $obj->encode_decode('decrypt', $gsm_name);
                                                echo $gsm_name;
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $linked_count = 0;
                                        $linked_count = $obj->GetLinkedCount($GLOBALS['gsm_table'], $list['gsm_id']);
                                        if (empty($edit_access_error) || (empty($delete_access_error) && empty($linked_count))) { ?>
                                            <div class="dropdown">
                                                <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <?php 
                                                        if(empty($edit_access_error)) { 
                                                            ?>
                                                            <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['gsm_id'])) { echo $list['gsm_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                            <?php 
                                                        } 
                                                        if(empty($delete_access_error) && empty($linked_count)) {
                                                            ?>
                                                            <li><a class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['gsm_id'])) { echo $list['gsm_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                            <?php 
                                                        } 
                                                    ?>
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
    if(isset($_REQUEST['gsm_row_index'])) {
        $gsm_row_index = $_REQUEST['gsm_row_index'];
        $selected_gsm_name = $_REQUEST['selected_gsm_name'];
        ?>
        <tr class="gsm_row" id="gsm_row<?php if(!empty($gsm_row_index)) { echo $gsm_row_index; } ?>">
            <td class="text-center sno"><?php if(!empty($gsm_row_index)) { echo $gsm_row_index; } ?></td>
            <td class="text-center">
                <?php
                    if(!empty($selected_gsm_name)) {
                        $selected_gsm_name = str_replace("@@@", "&", $selected_gsm_name);
                        echo $selected_gsm_name;
                    }    
                ?>
                <input type="hidden" name="gsm_names[]" value="<?php if(!empty($selected_gsm_name)) { echo $selected_gsm_name; } ?>">
            </td>
            <td class="text-center product_pad">
                <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('gsm', '<?php if(!empty($gsm_row_index)) { echo $gsm_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        <?php
    }    
    if(isset($_REQUEST['delete_gsm_id'])) {
        $delete_gsm_id = $_REQUEST['delete_gsm_id'];
        $msg = "";
        if(!empty($delete_gsm_id)) {
            $gsm_unique_id = "";
            $gsm_unique_id = $obj->getTableColumnValue($GLOBALS['gsm_table'], 'gsm_id', $delete_gsm_id, 'id');
            if(preg_match("/^\d+$/", $gsm_unique_id)) {
                $gsm_name = "";
                $gsm_name = $obj->getTableColumnValue($GLOBALS['gsm_table'], 'gsm_id', $delete_gsm_id, 'gsm_name');
    
                $action = "";
                if(!empty($gsm_name)) {
                    $action = "GSM Deleted. Value - " . $obj->encode_decode('decrypt', $gsm_name);
                }
                if(empty($delete_access_error)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['gsm_table'], $gsm_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = $delete_access_error;
                }
            }
        }
        echo $msg;
        exit;
    }    
    ?>