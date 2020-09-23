<?php require_once "../globals.php"; ?>
<?php
if (!empty($_POST['user_email'])) {
    $email = prepare_input($_POST['user_email']);
    
    $check = get_data('users', "where `user_email` = '$email'", 'email', 1);
    if(empty($check)){
        echo '0';
    } else {
        //echo 'Sorry Email Is Exists!!';
        echo '1';
    }
}
?>