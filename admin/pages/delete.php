<?php require_once "../../globals.php"; ?>
<?php
$input = 'page_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $page_id = $_GET[$input];
    $page_id = (int) $page_id;
    $row = get_one('pages',"`page_id` = $page_id");
    if (! empty($row)) {
        $deleted = medical_delete_one('pages', '`page_id` = '.$page_id); 
        redirect('admin/'.$models.'/view.php');    
    } else {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>