<?php
function check_auth(): bool
{
    return isset($_SESSION['user_id']) && ! empty($_SESSION['user_id']);
}
?>