<?php
	include("include_files.php");
    $login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['factory_module'];
		}
	}
	if(isset($_REQUEST['show_factory_id'])) { 
        $show_factory_id = $_REQUEST['show_factory_id'];

        $location = "";$factory_name = "";
        if(!empty($show_factory_id)){
            $factory_list = array();
            $factory_list = $obj->getTableRecords($GLOBALS['factory_table'],'factory_id',$show_factory_id);
            if(!empty($factory_list)){
                foreach($factory_list as $data){
                    if(!empty($data['factory_name']) && $data['factory_name'] != $GLOBALS['null_value']){
                        $factory_name = $obj->encode_decode("decrypt",$data['factory_name']);
                        $factory_name = html_entity_decode($factory_name);
                    }
                    if(!empty($data['location']) && $data['location'] != $GLOBALS['null_value']){
                        $location = $obj->encode_decode("decrypt",$data['location']);
                    }
                }
            }
        }
   
        ?>
        <form class="poppins pd-20 redirection_form" name="factory_form" method="POST">
			<div class="card-header ">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
                        <?php if(!empty($show_factory_id)){ ?>
                            <div class="h5">Factory Details</div>
                        <?php 
                        } else{ ?>
                            <div class="h5"> Factory </div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<!-- <button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('factory.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button> -->
					</div>
				</div>
			</div>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_factory_id)) { echo $show_factory_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="factory_name" name="factory_name" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text');" placeholder="" value="<?php if(!empty($factory_name)){echo $factory_name;} ?>">
                            <label>Factory Name<span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" name="location" placeholder="Enter location" rows="3" ><?php if(!empty($location)){echo $location;} ?></textarea>
                            <label>Location<span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
     
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-danger" type="button"  onClick="Javascript:SaveModalContent('factory_form', 'factory_changes.php', 'factory.php');">
                        Submit
                    </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
     if(isset($_POST['factory_name'])) {
     	
        $factory_name = ""; $factory_name_error = "";
		$location = ""; $location_error = "";
		$valid_factory = ""; $form_name = "factory_form";
       
        if(isset($_POST['factory_name'])){
            $factory_name = $_POST['factory_name'];
            if(strlen($factory_name) > 50){
                $factory_name_error = "Only 50 characters allowed";
            }
            else{
                $factory_name_error = $valid->valid_name_text($factory_name,'Factory name','1');
            }
            if(!empty($factory_name_error)){
                if(!empty($valid_factory)){
                    $valid_factory = $valid_factory." ".$valid->error_display($form_name,'factory_name',$factory_name_error,'text');
                }
                else{
                    $valid_factory = $valid->error_display($form_name,'factory_name',$factory_name_error,'text');
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
                if(!empty($valid_factory)){
                    $valid_factory = $valid_factory." ".$valid->error_display($form_name,'location',$location_error,'textarea');
                }
                else{
                    $valid_factory = $valid->error_display($form_name,'location',$location_error,'textarea');
                }
            }
        }

		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}
   
		$result = ""; $lower_case_name = "";$prev_factory_id = ""; $factory_error = "";	
		
		if(empty($valid_factory)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
             $name_location = ""; $factory_details = "";
                if(!empty($factory_name)) {
                    $factory_name = htmlentities($factory_name, ENT_QUOTES);
                    $lower_case_name = strtolower($factory_name);
                    $lower_case_name = htmlentities($lower_case_name, ENT_QUOTES);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }

                if(!empty($factory_name)) {
                    $name_location = $factory_name;
                    $factory_details = $factory_name;
                    $factory_name = $obj->encode_decode('encrypt', $factory_name);
                }
				if(!empty($location)) {
					$location = htmlentities($location, ENT_QUOTES);
                    if(!empty($factory_details)) {
                        $factory_details = $factory_details."$$$".$location;
                    }
                    if(!empty($name_location)) {
                        $name_location = $name_location." (".$location.")";
                        if(!empty($location)) {
                            $name_location = $name_location." - ".$location;
                        }
                       
                    }
                    $location = $obj->encode_decode('encrypt', $location);
                }
				else {
					$location = $GLOBALS['null_value'];
				}
            
				$prev_name_location_id = "";$name_location_error = "";$error_name_location = "";
				if(!empty($name_location)){
					$prev_name_location_id = $obj->getTableColumnValue($GLOBALS['factory_table'],'name_location',$name_location,'factory_id');
					if(!empty($prev_name_location_id)){
						$error_name_location = $obj->getTableColumnValue($GLOBALS['factory_table'],'factory_id',$prev_name_location_id,'factory_name');
						$error_name_location = $obj->encode_decode("decrypt",$error_name_location);
						$name_location_error = "This Factory name location Already exists";
					}
				}
	            if(!empty($name_location)){
					$name_location = $obj->encode_decode('encrypt',$name_location);
				}
				else{
					$name_location = $GLOBALS['null_value'];
				}
         
				if(!empty($factory_details)){
					$factory_details = $obj->encode_decode('encrypt',$factory_details);
				}
				else{
					$factory_details = $GLOBALS['null_value'];
				}
         
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
              
				if(empty($edit_id)) {
					if(empty($prev_factory_id)) {
						if(empty($prev_name_location_id)){
							$action = "";
							if(!empty($factory_name)) {
								$action = "New factory Created - ".$obj->encode_decode("decrypt",$factory_name);
							}
                            $check_factory = array(); $factory_count = 0;
                            $check_factory = $obj->getTableRecords($GLOBALS['factory_table'], '','');
                            if(!empty($check_factory)) {
                                $factory_count = count($check_factory);
                            }

                            $primary_factory = 0;
                            if(empty($factory_count)) {
                                $primary_factory = 1;
                            }
							$null_value = $GLOBALS['null_value'];
							$columns = array('created_date_time', 'creator', 'creator_name', 'factory_id', 'factory_name','lower_case_name', 'location','name_location','factory_details', 'primary_factory','deleted');
							$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$factory_name."'", "'".$lower_case_name."'","'".$location."'","'".$name_location."'","'".$factory_details."'","'".$primary_factory."'","'0'");
							$factory_insert_id = $obj->InsertSQL($GLOBALS['factory_table'], $columns, $values, 'factory_id', '', $action);			
							if(preg_match("/^\d+$/", $factory_insert_id)) {
								$factory_id = "";
                                $factory_id = $obj->getTableColumnValue($GLOBALS['factory_table'], 'id', $factory_insert_id, 'factory_id');	
                                if(empty($factory_count) && !empty($factory_id)) {
                                    $_SESSION[$GLOBALS['site_name_user_prefix'].'_bill_company_id'] = $factory_id;
                                }
								$result = array('number' => '1', 'msg' => 'Factory Successfully Created', 'factory_id' => $factory_id);
							}
							else {
								$result = array('number' => '2', 'msg' => $factory_insert_id);
							}
						}
						else{
							$result = array('number' => '2', 'msg' => $error_name_location);
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $factory_error);
					}	
				}
				else {
					if(empty($prev_factory_id) || $prev_factory_id == $edit_id) {
						if(empty($prev_name_location_id) || $prev_name_location_id == $edit_id){
							$getUniqueID = "";
							$getUniqueID = $obj->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $edit_id, 'id');
                            $factory_id = $edit_id;
							if(preg_match("/^\d+$/", $getUniqueID)) {
								$action = "";
								if(!empty($factory_name)) {
									$action = "factory Updated.";
								}

								$columns = array(); $values = array();			
								$columns = array('creator_name', 'factory_name', 'lower_case_name', 'location','name_location','factory_details');
								$values = array( "'".$creator_name."'","'".$factory_name."'", "'".$lower_case_name."'", "'".$location."'","'".$name_location."'","'".$factory_details."'");
								$factory_update_id = $obj->UpdateSQL($GLOBALS['factory_table'], $getUniqueID, $columns, $values, $action);
								if(preg_match("/^\d+$/", $factory_update_id)) {
									$result = array('number' => '1', 'msg' => 'Updated Successfully', 'factory_id' => $factory_id);					
								}
								else {
									$result = array('number' => '2', 'msg' => $factory_update_id);
								}							
							}
						}
						else{
							$result = array('number' => '2', 'msg' => $error_name_location);
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $factory_error);
					}
                }	

			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_factory)) {
				$result = array('number' => '3', 'msg' => $valid_factory);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['factory_table'],'','');

       if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if(strpos(strtolower($obj->encode_decode('decrypt', $val['name_location'])), $search_text) !== false) {
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
                        <th>Factory Name</th>
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
                                            if(!empty($data['factory_name'])) {
                                                $data['factory_name'] = $obj->encode_decode('decrypt', $data['factory_name']);
                                                echo $data['factory_name'];
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
                                              
                                                <li><a class="dropdown-item" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['factory_id'])) { echo $data['factory_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;Edit</a></li>
                                                
                                                    <?php 
                                                       /*
                                                if(empty($delete_access_error)) {
                                                    $linked_count = 0;
                                                    // $linked_count = $obj->GetFactoryLinkedCount($data['factory_id']); 
                                                    if($linked_count > 0) {
                                                    ?>                             
                                                <li><a class="dropdown-item text-secondary" href="#"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                <?php 
                                                    }
                                                    else {
                                                ?>
                                                <li><a class="dropdown-item" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['factory_id'])) { echo $data['factory_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; Delete</a></li>
                                                            
                                                <?php 
                                                        }
                                                    } */
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
    
    if(isset($_REQUEST['delete_factory_id'])) {
        $delete_factory_id = $_REQUEST['delete_factory_id'];
        $msg = "";
        if(!empty($delete_factory_id)) {	
            $factory_unique_id = "";
            $factory_unique_id = $obj->getTableColumnValue($GLOBALS['factory_table'], 'factory_id', $delete_factory_id, 'id');
            if(preg_match("/^\d+$/", $factory_unique_id)) {
               
                $action = "";
                if(!empty($factory_name)) {
                    $action = "factory Deleted - ".$obj->encode_decode("decrypt",$factory_name);
                }

                $factory_list = array();
				$delete = 1;
				foreach($factory_list as $data){
					if($data['id_count'] > 0){
						$delete = 0;
					}
				}
           
                $columns = array(); $values = array();						
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['factory_table'], $factory_unique_id, $columns, $values, $action);

            }
        }
        echo $msg;
        exit;	
    }
    ?>
