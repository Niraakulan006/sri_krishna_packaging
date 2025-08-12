<?php
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
        }
    }
    $view_access_error = ""; $add_access_error = ""; $edit_access_error = ""; $delete_access_error = "";
    if(!empty($login_staff_id)) {
        if($permission_module == $GLOBALS['unit_module'] || $permission_module == $GLOBALS['reports_module']) {
            $permission_actions = array($view_action);
        }
        else if($permission_module == $GLOBALS['delivery_slip_module'] || $permission_module == $GLOBALS['inward_approval_module']) {
            $permission_actions = array($view_action, $edit_action, $delete_action);
        }
        else {
            $permission_actions = array($view_action, $add_action, $edit_action, $delete_action);
        }
        include('permission_action.php');
    }
?>