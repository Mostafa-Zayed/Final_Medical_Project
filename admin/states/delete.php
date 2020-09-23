<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php
$input = 'state_id';
$models = get_models($input);

if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $state_id =  (int) $_GET[$input];    
    echo $state_id;
    $row = get_one($models, "`$input` = $state_id");
    if (! empty($row)) {
        $deleted = medical_delete_one($models, "`$input` = $state_id"); 
        redirect('admin/'.$models.'/view.php');    
    } else {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>