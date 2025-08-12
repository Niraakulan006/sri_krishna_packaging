<?php    
    include("include_files.php");
    $permission_module = $GLOBALS['size_module'];
    include("include_module_action.php");
    
	if(isset($_REQUEST['show_size_id'])) { 
        $show_size_id = "";
        $show_size_id = $_REQUEST['show_size_id'];
    
        $size_name = "";
        if(!empty($show_size_id)) {
            $size_list = array();
            $size_list = $obj->getTableRecords($GLOBALS['size_table'], 'size_id', $show_size_id);
            if(!empty($size_list)) {
                foreach ($size_list as $data) {
                    if(!empty($data['size_name'])) {
                        $size_name = $obj->encode_decode('decrypt', $data['size_name']);
                    }
                }
            }
        } 
        ?>
        <form class="poppins pd-20 redirection_form" name="size_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_size_id)){ ?>
                            <div class="h5">Edit Size</div>
                        <?php 
                        } else{ ?>
                            <div class="h5">Add Size</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('size.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_size_id)) {  echo $show_size_id; } ?>">
                <div class="col-lg-3 col-md-6 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" class="form-control shadow-none" placeholder=""  id="size_name" name="size_name" value="<?php if(!empty($size_name)) { echo $size_name; } ?>" onkeydown="Javascript:KeyboardControls(this,'number',15,'');" onkeyup="Javascript:InputBoxColor(this,'text');" required="">
                                <label>Size<span class="text-danger">*</span></label>
                                <?php if(empty($show_size_id)) { ?>                                
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" onclick="Javascript:addCreationDetails('size', 15);"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="new_smallfnt">Contains Number & Decimals</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center"> 
                <?php if(empty($show_size_id)) { ?>
                <div class="col-lg-6">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="size_count" value="0">                        
                        <table class="table nowrap cursor smallfnt w-100 table-bordered added_size_table">
                            <thead class="bg-dark smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Size Value</th>
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
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent('size_form', 'size_changes.php', 'size.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    jQuery('#size_name').on("keypress", function(e) {
                        if(e.keyCode == 13) {
                            addCreationDetails('size', 15);
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
        $size_name = array(); $size_name_error = ""; 
        $valid_size = ""; $form_name = "size_form"; $size_error = "";
        $single_size_name = ""; $prev_size_id = "";
    
        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(!empty($edit_id)) {
            if(isset($_POST['size_name'])) {
                $single_size_name = $_POST['size_name'];
                $single_size_name = trim($single_size_name);
                $size_name_error = $valid->valid_price($single_size_name, "Size Name", "1");
            }
            if(!empty($size_name_error)) {
                $valid_size = $valid->error_display($form_name, "size_name", $size_name_error, 'text');
            }
            else {
                $single_size_name = $obj->encode_decode("encrypt", $single_size_name);
                if(!empty($single_size_name)) {
                    $prev_size_id = $obj->CheckSizeAlreadyExists($GLOBALS['bill_company_id'], $single_size_name);
                    if(!empty($prev_size_id)) {
                        if($prev_size_id != $edit_id) {
                            $size_error = "This Size - " . $obj->encode_decode("decrypt", $single_size_name) . " is already exist";
                        }
                    }
                }
            }
        }
    
        if(empty($edit_id)) {
            if(isset($_POST['size_names'])) {
                $size_name = $_POST['size_names'];
            }
            $inputbox_size_name = "";
            $inputbox_size_name = $_POST['size_name'];
    
            if(!empty($inputbox_size_name) && empty($size_name)) {
                $size_add_error = "Click Add Button to Append Size";
                if(!empty($size_add_error)) {
                    $valid_size = $valid->error_display($form_name, "size_name", $size_add_error, 'text');
                }
            } else if(empty($inputbox_size_name) && empty($size_name)) {
                $size_add_error = "Enter Size Value";
                if(!empty($size_add_error)) {
                    $valid_size = $valid->error_display($form_name, "size_name", $size_add_error, 'text');
                }
            } else if(!empty($inputbox_size_name)) {
                $size_add_error = "Click Add Button to Append Size";
                if(!empty($size_add_error)) {
                    $valid_size = $valid->error_display($form_name, "size_name", $size_add_error, 'text');
                }
            }
            if(!empty($size_name)) {
                for ($p = 0; $p < count($size_name); $p++) {
                    $size_name_error = $valid->valid_price($size_name[$p], "Invalid Size Value - ". $size_name[$p], "0");
                    if(!empty($size_name_error)) {
                        $size_name_error = "Invalid Size Value - " . $size_name[$p];
                    }
                    else {
                        $size_name[$p] = $obj->encode_decode('encrypt', $size_name[$p]);
                    }
    
                    if(!empty($size_name_error)) {
                        if(!empty($valid_size)) {
                            $valid_size = $valid_size." ".$valid->error_display($form_name, "size_name", $size_name_error, 'text');
                        }
                        else {
                            $valid_size = $valid->error_display($form_name, "size_name", $size_name_error, 'text');
                        }
                    }
                }
            }
        }
    
        $result = "";
        if(empty($valid_size) && empty($size_name_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
            $bill_company_id = $GLOBALS['bill_company_id'];
            
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                for ($i = 0; $i < count($size_name); $i++) {
                    if(!empty($size_name[$i])) {
                        $prev_size_id = $obj->CheckSizeAlreadyExists($bill_company_id, $size_name[$i]);
                        if(!empty($prev_size_id)) {
                            $size_error = "This Size - " . $obj->encode_decode("decrypt", $size_name[$i]) . " is already exist";
                        }
                    }
                }
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
    
                if(empty($size_error)) {
                    if(empty($edit_id)) {
                        $action = array();
                        for ($p = 0; $p < count($size_name); $p++) {
                            if(empty($prev_size_id)) {
                                if(empty($add_access_error)) {
                                    if(!empty($size_name[$p])) {
                                        $action[$p] = "New Size Created. Name - " . $obj->encode_decode('decrypt', $size_name[$p]);
                                    }
        
                                    $null_value = $GLOBALS['null_value'];
                                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'size_id', 'size_name', 'deleted');
                                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$size_name[$p]."'",  "'0'");
        
                                    $size_insert_id = $obj->InsertSQL($GLOBALS['size_table'], $columns, $values, 'size_id', '', $action[$p]);		
                                    if(preg_match("/^\d+$/", $size_insert_id)) {								
                                        $result = array('number' => '1', 'msg' => 'Size Successfully Created');						
                                    }
                                    else {
                                        $result = array('number' => '2', 'msg' => $size_insert_id);
                                    }
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $add_access_error);
                                }
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $size_error);
                            }
                        }
                    } 
                    else if(!empty($edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['size_table'], 'size_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            if(empty($edit_access_error)) {
                                $action = "";
                                if(!empty($single_size_name)) {
                                    $action = "Size Updated. Name - " . $obj->encode_decode('decrypt', $single_size_name);
                                }
                            
                                $columns = array(); $values = array();
                                $columns = array('creator_name', 'size_name');
                                $values = array("'".$creator_name."'", "'".$single_size_name."'");
                                $size_update_id = $obj->UpdateSQL($GLOBALS['size_table'], $getUniqueID, $columns, $values, $action);
                                if(preg_match("/^\d+$/", $size_update_id)) {
                                    $result = array('number' => '1', 'msg' => 'Updated Successfully');
                                } 
                                else {
                                    $result = array('number' => '2', 'msg' => $size_update_id);
                                }
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $edit_access_error);
                            }
                        }
                    }
                } 
                else {
                    $result = array('number' => '2', 'msg' => $size_error);
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_size)) {
                $result = array('number' => '3', 'msg' => $valid_size);
            }
            if(!empty($size_name_error)) {
                $result = array('number' => '2', 'msg' => $size_name_error);		
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
        $total_records_list = $obj->getTableRecords($GLOBALS['size_table'], '', '');
    
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['size_name']))), $search_text) !== false)) {
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
                        <th>Size Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($show_records_list)) {
                            $count_size = 0;
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
                                            $size_name = "";
                                            if(!empty($list['size_name'])) {
                                                $size_name = $list['size_name'];
                                                $size_name = $obj->encode_decode('decrypt', $size_name);
                                                echo $size_name;
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $linked_count = 0;
                                        $linked_count = $obj->GetLinkedCount($GLOBALS['size_table'], $list['size_id']);
                                        if(empty($edit_access_error) || (empty($delete_access_error) && empty($linked_count))) { ?>
                                            <div class="dropdown">
                                                <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <?php 
                                                        if(empty($edit_access_error)) { 
                                                            ?>
                                                            <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['size_id'])) { echo $list['size_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; Edit</a></li>
                                                            <?php 
                                                        } 
                                                        if(empty($delete_access_error) && empty($linked_count)) {
                                                            ?>
                                                            <li><a class="dropdown-item" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['size_id'])) { echo $list['size_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
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
    if(isset($_REQUEST['size_row_index'])) {
        $size_row_index = $_REQUEST['size_row_index'];
        $selected_size_name = $_REQUEST['selected_size_name'];
        ?>
        <tr class="size_row" id="size_row<?php if(!empty($size_row_index)) { echo $size_row_index; } ?>">
            <td class="text-center sno"><?php if(!empty($size_row_index)) { echo $size_row_index; } ?></td>
            <td class="text-center">
                <?php
                    if(!empty($selected_size_name)) {
                        $selected_size_name = str_replace("@@@", "&", $selected_size_name);
                        echo $selected_size_name;
                    }    
                ?>
                <input type="hidden" name="size_names[]" value="<?php if(!empty($selected_size_name)) { echo $selected_size_name; } ?>">
            </td>
            <td class="text-center product_pad">
                <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('size', '<?php if(!empty($size_row_index)) { echo $size_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        <?php
    }    
    if(isset($_REQUEST['delete_size_id'])) {
        $delete_size_id = $_REQUEST['delete_size_id'];
        $msg = "";
        if(!empty($delete_size_id)) {
            $size_unique_id = "";
            $size_unique_id = $obj->getTableColumnValue($GLOBALS['size_table'], 'size_id', $delete_size_id, 'id');
            if(preg_match("/^\d+$/", $size_unique_id)) {
                $size_name = "";
                $size_name = $obj->getTableColumnValue($GLOBALS['size_table'], 'size_id', $delete_size_id, 'size_name');
    
                $action = "";
                if(!empty($size_name)) {
                    $action = "Size Deleted. Value - " . $obj->encode_decode('decrypt', $size_name);
                }
                if(empty($delete_access_error)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['size_table'], $size_unique_id, $columns, $values, $action);
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