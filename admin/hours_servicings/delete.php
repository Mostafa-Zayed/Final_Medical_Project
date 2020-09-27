<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<?php
$input = 'hours_servicing_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $hours_servicing_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $hours_servicing_id");
    if (! empty($row)) {
        $deleted = medical_delete_one($models, "`$input` = $hours_servicing_id"); 
        redirect('admin/'.$models.'/view.php');    
    } else {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>