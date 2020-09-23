<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php
if (isset($_GET['page_id']) && ! empty($_GET['page_id']) && is_numeric($_GET['page_id'])) {
    $page_id = $_GET['page_id'];
    $page_id = (int) $page_id;
    $row = get_one('pages',"`page_id` = $page_id");
    if (! empty($row)) {
        $deleted = medical_delete_one('pages', '`page_id` = '.$page_id); 
        //$_GET['success'] = '<div class="alert alert-success">Page Updated Succefuly</div>';
        redirect('admin/pages/view.php');    
    } else {
        abort();
    }
} else {
    redirect('admin/pages/view.php');
}
?>