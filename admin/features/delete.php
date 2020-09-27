<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php
$input = 'feature_id';
$input_image = substr($input, 0, strpos($input,'_') + 1);
$input_image .= 'image';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $feature_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $feature_id");
    if (! empty($row)) {
        // delete from database
        $deleted = medical_delete_one($models, "`$input` = $feature_id"); 
        if ($deleted) {
            if (isset($row[$input_image]) && ! empty($row[$input_image])) {
                // if row Has image delete image form Uploade Folder  
                $image_path = $path = UPLOADS.$models.DS.$row[$input_image];
                delete_file($image_path);
            }
        }
        redirect('admin/'.$models.'/view.php');    
    } else {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>