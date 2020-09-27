<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php
$input = 'admin_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $admin_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $admin_id");
    if (! empty($row)) {
        $image_path = $path = UPLOADS.'admins'.DS.$row['admin_image'];
        $deleted = medical_delete_one($models, "`$input` = $admin_id"); 
        unlink($image_path);
        redirect('admin/'.$models.'/view.php');    
    } else {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>