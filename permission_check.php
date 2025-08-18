<?php
    if(!empty($login_staff_id) && !empty($permission_module)) {
        $check_role_id = "";
        $check_role_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $login_staff_id, 'role_id');
        $access_page_permission = 0;					
        $access_page_permission = $obj->CheckRoleAccessPage($check_role_id, $permission_module);
        if(empty($access_page_permission)) {
            header("Location:dashboard.php");
            exit;
        }
        // else if($GLOBALS['user_type'] == $GLOBALS['godown_user_type']) {
        //     if( $permission_module == $GLOBALS['consumption_entry_module'] || $permission_module == $GLOBALS['delivery_slip_module']) {
        //         header("Location:dashboard.php");
        //         exit;
        //     }
        // }
    }
?>