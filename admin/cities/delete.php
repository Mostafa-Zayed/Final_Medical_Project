<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php
$input = 'city_id';
$models = get_models($input);

if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $city_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $city_id");
    if (! empty($row)) {
        $deleted = medical_delete_one($models, "`$input` = $city_id"); 
        redirect('admin/'.$models.'/view.php');    
    } else {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>