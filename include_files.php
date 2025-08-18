<?php
    session_start();
      
    include("include/label.php");
    include("include/functions.php");
    include("include/validation.php");
    
    $obj = new billing();
    $valid = new validation();
    
    $view_action = $obj->encode_decode('encrypt', 'View'); $add_action = $obj->encode_decode('encrypt', 'Add');
    $edit_action = $obj->encode_decode('encrypt', 'Edit'); $delete_action = $obj->encode_decode('encrypt', 'Delete');
    
    $project_title = "";
    $project_title = $obj->getProjectTitle();

    $login_godown_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] == $GLOBALS['godown_user_type']) {
            $login_godown_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
        }
    }
    $list = array();  $login_godown_id = "";
    if(!empty($login_godown_staff_id)) {
        $list = $obj->getTableRecords($GLOBALS['user_table'], 'user_id', $login_godown_staff_id);
        if(!empty($list)) {
            foreach($list as $data) {
                if(!empty($data['godown_id']) && $data['godown_id'] != $GLOBALS['null_value']) {
                    $login_godown_id = $data['godown_id'];
                }
            }
        }
    }
?>