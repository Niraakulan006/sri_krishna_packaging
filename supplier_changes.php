<?php
	include("include_files.php");
    $login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['supplier_module'];
		}
	}
	if(isset($_REQUEST['show_supplier_id'])) { 
        $show_supplier_id = $_REQUEST['show_supplier_id'];

        $add_custom_supplier = "";
		if(isset($_REQUEST['add_custom_supplier'])) {
			$add_custom_supplier = $_REQUEST['add_custom_supplier'];
			$add_custom_supplier = trim($add_custom_supplier);
		}

      $location = "";$supplier_name = "";$mobile_number = "";
        if(!empty($show_supplier_id)){
            $supplier_list = array();
            $supplier_list = $obj->getTableRecords($GLOBALS['supplier_table'],'supplier_id',$show_supplier_id);
            if(!empty($supplier_list)){
                foreach($supplier_list as $data){
                    if(!empty($data['supplier_name']) && $data['supplier_name'] != $GLOBALS['null_value']){
                        $supplier_name = $obj->encode_decode("decrypt",$data['supplier_name']);
                        $supplier_name = html_entity_decode($supplier_name);
                    }
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']){
                        $mobile_number = $obj->encode_decode("decrypt",$data['mobile_number']);
                    }
                    if(!empty($data['location']) && $data['location'] != $GLOBALS['null_value']){
                        $location = $obj->encode_decode("decrypt",$data['location']);
                    }
                }
            }
        }
   
        ?>
        <form class="poppins pd-20" name="supplier_form" method="POST">
            <?php if(empty($add_custom_supplier)) { ?>
                <div class="card-header ">
                    <div class="row p-2">
                        <div class="col-lg-8 col-md-8 col-8 align-self-center">
                            <?php if(!empty($show_supplier_id)){ ?>
                                <div class="h5">Edit Supplier</div>
                            <?php 
                            } else{ ?>
                                <div class="h5">Add Supplier</div>
                            <?php
                            } ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-4">
                            <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('supplier.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_supplier_id)) { echo $show_supplier_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="supplier_name" name="supplier_name" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text');" placeholder="" value="<?php if(!empty($supplier_name)){echo $supplier_name;} ?>">
                            <label>Supplier Name<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="location" name="location" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text');" placeholder="" value="<?php if(!empty($location)){echo $location;} ?>">
                            <label>Location<span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'mobile_number',10,'1');"  placeholder="" value="<?php if(!empty($mobile_number)){echo $mobile_number;} ?>">
                            <label>Contact Number<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Numbers Only (only 10 digits)</div>
                    </div>
                </div>
                
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-danger" type="button"  onClick="Javascript:SaveModalContent('supplier_form', 'supplier_changes.php', 'supplier.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
     if(isset($_POST['supplier_name'])) {
     	
        $supplier_name = ""; $supplier_name_error = "";
		$mobile_number = ""; $mobile_number_error = "";
		$location = ""; $location_error = "";
		$valid_supplier = ""; $form_name = "supplier_form";
       
        if(isset($_POST['supplier_name'])){
            $supplier_name = $_POST['supplier_name'];
            if(strlen($supplier_name) > 50){
                $supplier_name_error = "Only 50 characters allowed";
            }
            else{
                $supplier_name_error = $valid->valid_name_text($supplier_name,'Supplier name','1');
            }
            if(!empty($supplier_name_error)){
                if(!empty($valid_supplier)){
                    $valid_supplier = $valid_supplier." ".$valid->error_display($form_name,'supplier_name',$supplier_name_error,'text');
                }
                else{
                    $valid_supplier = $valid->error_display($form_name,'supplier_name',$supplier_name_error,'text');
                }
            }
        }
        if(isset($_POST['location'])){
            $location = $_POST['location'];
            if(strlen($location) > 70){
                $location_error = "Only 70 characters allowed";
            }
            else{
                $location_error = $valid->valid_name_text($location,'Location','1');
            }
            if(!empty($location_error)){
                if(!empty($valid_supplier)){
                    $valid_supplier = $valid_supplier." ".$valid->error_display($form_name,'location',$location_error,'text');
                }
                else{
                    $valid_supplier = $valid->error_display($form_name,'location',$location_error,'text');
                }
            }
        }
		if(isset($_POST['mobile_number'])){
			$mobile_number = $_POST['mobile_number'];
			$mobile_number_error = $valid->valid_mobile_number($mobile_number,'mobile number','1');
			
			if(!empty($mobile_number_error)) {
				if(!empty($valid_supplier)) {
					$valid_supplier = $valid_supplier." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
				}
				else {
					$valid_supplier = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
				}
			}
		}


		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}
   
		$result = ""; $lower_case_name = "";$prev_supplier_id = ""; $supplier_error = "";	
		
		if(empty($valid_supplier)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
             $name_mobile_location = ""; $supplier_details = "";
                if(!empty($supplier_name)) {
					
                    $supplier_name = htmlentities($supplier_name, ENT_QUOTES);
                    $lower_case_name = strtolower($supplier_name);
                    $lower_case_name = htmlentities($lower_case_name, ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }

                if(!empty($supplier_name)) {
                    $name_mobile_location = $supplier_name;
                    $supplier_details = $supplier_name;
                    $supplier_name = $obj->encode_decode('encrypt', $supplier_name);
                }
				$bill_company_id = $GLOBALS['bill_company_id'];
				
				if(!empty($location)) {
					$location = htmlentities($location, ENT_QUOTES);
                    if(!empty($supplier_details)) {
                        $supplier_details = $supplier_details."$$$".$location;
                    }
                    if(!empty($name_mobile_location)) {
                        $name_mobile_location = $name_mobile_location." (".$location.")";
                        if(!empty($location)) {
                            $name_mobile_location = $name_mobile_location." - ".$location;
                        }
                       
                    }
                    $location = $obj->encode_decode('encrypt', $location);
                }
				else {
					$location = $GLOBALS['null_value'];
				}
            
                if(!empty($mobile_number)) {
                    if(!empty($supplier_details)) {
                        $supplier_details = $supplier_details."$$$".$mobile_number;
                    }
                    if(!empty($name_mobile_location)) {
                        $name_mobile_location = $name_mobile_location." (".$mobile_number.")";
                        if(!empty($location)) {
                            $name_mobile_location = $name_mobile_location." - ".$location;
                        }
                       
                    }
                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }
            
				$prev_mobile_id = "";$mobile_error = "";$error_mobile = "";
				if(!empty($mobile_number)){
					$prev_mobile_id = $obj->getTableColumnValue($GLOBALS['supplier_table'],'mobile_number',$mobile_number,'supplier_id');
					if(!empty($prev_mobile_id)){
						$error_mobile = $obj->getTableColumnValue($GLOBALS['supplier_table'],'supplier_id',$prev_mobile_id,'supplier_name');
						$error_mobile = $obj->encode_decode("decrypt",$error_mobile);
						$mobile_error = "This Mobile Number Already exists in ".$error_mobile;
					}
				}
	            if(!empty($name_mobile_location)){
					$name_mobile_location = $obj->encode_decode('encrypt',$name_mobile_location);
				}
				else{
					$name_mobile_location = $GLOBALS['null_value'];
				}
         
				if(!empty($supplier_details)){
					$supplier_details = $obj->encode_decode('encrypt',$supplier_details);
				}
				else{
					$supplier_details = $GLOBALS['null_value'];
				}
         
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
              
                $update_payment = 0;
				if(empty($edit_id)) {
					if(empty($prev_supplier_id)) {
						if(empty($prev_mobile_id)){
							$action = "";
							if(!empty($supplier_name)) {
								$action = "New supplier Created - ".$obj->encode_decode("decrypt",$supplier_name);
							}

							$null_value = $GLOBALS['null_value'];
							$columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'supplier_id', 'supplier_name','lower_case_name', 'mobile_number','location','name_mobile_location','supplier_details','deleted');
							$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$supplier_name."'", "'".$lower_case_name."'","'".$mobile_number."'","'".$location."'","'".$name_mobile_location."'","'".$supplier_details."'","'0'");
							$supplier_insert_id = $obj->InsertSQL($GLOBALS['supplier_table'], $columns, $values, 'supplier_id', '', $action);			
							if(preg_match("/^\d+$/", $supplier_insert_id)) {
								$supplier_id = "";
                                $supplier_id = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'id', $supplier_insert_id, 'supplier_id');	
                                $update_payment =1;
								$result = array('number' => '1', 'msg' => 'Supplier Successfully Created','supplier_id' => $supplier_id);
								
							}
							else {
								$result = array('number' => '2', 'msg' => $supplier_insert_id);
							}
						}
						else{
							$result = array('number' => '2', 'msg' => $mobile_error);
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $supplier_error);
					}	
				}
				else {
					if(empty($prev_supplier_id) || $prev_supplier_id == $edit_id) {
						if(empty($prev_mobile_id) || $prev_mobile_id == $edit_id){
							$getUniqueID = "";
							$getUniqueID = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $edit_id, 'id');
                            $supplier_id = $edit_id;
							if(preg_match("/^\d+$/", $getUniqueID)) {
								$action = "";
								if(!empty($supplier_name)) {
									$action = "supplier Updated.";
								}

								$columns = array(); $values = array();			
								$columns = array('creator_name', 'supplier_name', 'lower_case_name', 'mobile_number','location','name_mobile_location','supplier_details');
								$values = array( "'".$creator_name."'","'".$supplier_name."'", "'".$lower_case_name."'","'".$mobile_number."'","'".$location."'","'".$name_mobile_location."'","'".$supplier_details."'");
								$supplier_update_id = $obj->UpdateSQL($GLOBALS['supplier_table'], $getUniqueID, $columns, $values, $action);
								if(preg_match("/^\d+$/", $supplier_update_id)) {
                                         $update_payment =1;

									$result = array('number' => '1', 'msg' => 'Updated Successfully');					
								}
								else {
									$result = array('number' => '2', 'msg' => $supplier_update_id);
								}							
							}
						}
						else{
							$result = array('number' => '2', 'msg' => $mobile_error);
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $supplier_error);
					}
                }	

			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_supplier)) {
				$result = array('number' => '3', 'msg' => $valid_supplier);
			}
		}
		
		if(!empty($result)) {
			$result = json_encode($result);
		}
		echo $result; exit;
	}
    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title'];
          $search_text = "";
		if(isset($_POST['search_text'])) {
		   $search_text = $_POST['search_text'];
		}
        $total_records_list = array();
		if(!empty($GLOBALS['bill_company_id'])) {
			$total_records_list = $obj->getTableRecords($GLOBALS['supplier_table'],'','','');
		}

       if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if(strpos(strtolower($obj->encode_decode('decrypt', $val['name_mobile_location'])), $search_text) !== false) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

        $total_pages = 0;	
		$total_pages = count($total_records_list);
		
		$page_start = 0; $page_end = 0;
		if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
			if($total_pages > $page_limit) {
				if($page_number) {
					$page_start = ($page_number - 1) * $page_limit;
					$page_end = $page_start + $page_limit;
				}
			}
			else {
				$page_start = 0;
				$page_end = $page_limit;
			}
		}

		$show_records_list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $val) {
                if($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }
		
		$prefix = 0;
		if(!empty($page_number) && !empty($page_limit)) {
			$prefix = ($page_number * $page_limit) - $page_limit;
		} ?>
        
		<?php if($total_pages > $page_limit) { ?>
			<div class="pagination_cover mt-3"> 
				<?php
					include("pagination.php");
				?> 
			</div> 
		<?php }
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
                        <th>Supplier Name</th>
                        <th>Contact Number</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($show_records_list)) { 
                            foreach($show_records_list as $key => $data) {
                                $index = $key + 1;
                                if(!empty($prefix)) { $index = $index + $prefix; } 
                    ?>
                                <tr>
                                    <td class="ribbon-header" style="cursor:default;">   
                                        <?php  echo $index; ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['supplier_name'])) {
                                                $data['supplier_name'] = $obj->encode_decode('decrypt', $data['supplier_name']);
                                                echo $data['supplier_name'];
                                            }
                                        ?>
                                        <!-- <div class="w-100 py-2">
                                            Creator :
                                            <?php
                                                if(!empty($data['creator_name'])) {
                                                    $data['creator_name'] = $obj->encode_decode('decrypt', $data['creator_name']);
                                                    echo $data['creator_name'];
                                                }
                                            ?>                                        
                                        </div> -->
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['mobile_number']) && $data['mobile_number'] != "NULL") {
                                                $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                                echo $data['mobile_number'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(!empty($data['location']) && $data['location'] != "NULL") {
                                                $data['location'] = $obj->encode_decode('decrypt', $data['location']);
                                                echo $data['location'];
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $edit_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $edit_action;
                                            include('permission_action.php');
                                        }
                                        $delete_access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $delete_action;
                                            include('permission_action.php');
                                        }
                                        if(empty($edit_access_error) || empty($delete_access_error)){ ?>
                                        <div class="dropdown">
                                           <a href="#" role="button" id="dropdownMenuLink1" class="btn btn-dark show-button" class="btn btn-dark show-button poppins" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                              
                                                <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                                
                                                    <?php 
                                                       
                                                if(empty($delete_access_error)) {
                                                    $linked_count = 0;
                                                    // $linked_count = $obj->GetSupplierLinkedCount($data['supplier_id']); 
                                                    if($linked_count > 0) {
                                                    ?>                             
                                                <li><a class="dropdown-item text-secondary" href="#"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php 
                                                    }
                                                    else {
                                                ?>
                                                <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['supplier_id'])) { echo $data['supplier_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                            
                                                <?php 
                                                        }
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
                                <td colspan="6" class="text-center">Sorry! No records found</td>
                            </tr>
                    <?php 
                        } 
                    ?>
                </tbody>
            </table>              
		    <?php	
        }
	}
    
    if(isset($_REQUEST['delete_supplier_id'])) {
        $delete_supplier_id = $_REQUEST['delete_supplier_id'];
        $msg = "";
        if(!empty($delete_supplier_id)) {	
            $supplier_unique_id = "";
            $supplier_unique_id = $obj->getTableColumnValue($GLOBALS['supplier_table'], 'supplier_id', $delete_supplier_id, 'id');
            if(preg_match("/^\d+$/", $supplier_unique_id)) {
               
                $action = "";
                if(!empty($supplier_name)) {
                    $action = "supplier Deleted - ".$obj->encode_decode("decrypt",$supplier_name);
                }

                $supplier_list = array();
				$delete = 1;
				foreach($supplier_list as $data){
					if($data['id_count'] > 0){
						$delete = 0;
					}
				}
           
                $columns = array(); $values = array();						
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['supplier_table'], $supplier_unique_id, $columns, $values, $action);

            }
        }
        echo $msg;
        exit;	
    }
    ?>
