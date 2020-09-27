<?php
// Permision For Admin
function permision_admin()
{

    if (check_auth_admin()) {
        if ($_SESSION['admin_type']) {
            $permision_type = $_SESSION['admin_type'];
            $permision_matched = password_verify('admin', $permision_type);
            if ($permision_matched){
                return true;
            } else {
                return false;
            }
        }
    }
}

function permision_super_admin()
{

    if (check_auth_admin()) {
        if ($_SESSION['admin_type']) {
            $permision_type = $_SESSION['admin_type'];
            $permision_matched = password_verify('super_admin', $permision_type);
            if ($permision_matched){
                return true;
            } else {
                return false;
            }
        }
    }
}
?>