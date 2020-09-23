<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php
$input = 'doctor_id';
$models = get_models($input);

if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $doctor_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $doctor_id");
    if (! empty($row)) {
        $deleted = medical_delete_one($models, "`$input` = $doctor_id"); 
        redirect('admin/'.$models.'/view.php');    
    } else {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>