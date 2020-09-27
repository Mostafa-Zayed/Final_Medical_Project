<?php
function check_auth(): bool
{
    return isset($_SESSION['user_id']) && ! empty($_SESSION['user_id']);
}

function check_auth_admin(): bool
{
    return isset($_SESSION['admin_id']) && ! empty($_SESSION['admin_id']);
}

function is_not_admin()
{
    if (! check_auth_admin()) {
        redirect('index.php');
    }
}
?>