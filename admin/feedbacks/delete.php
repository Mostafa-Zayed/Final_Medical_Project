<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php
$input = 'feedback_id';
$input_image = substr($input, 0, strpos($input,'_') + 1);
$input_image .= 'image';
$models = get_models($input);

if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $feedback_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $feedback_id");
    if (! empty($row)) {
        // delete from database
        $deleted = medical_delete_one($models, "`$input` = $feedback_id");
        if (isset($row[$input_image]) && ! empty($row[$input_image])) {
            // if row Has image delete image form Uploade Folder  
            $image_path = $path = UPLOADS.$models.DS.$row[$input_image];
            delete_file($image_path);
        } 
        redirect('admin/'.$models.'/view.php');    
    } else {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>