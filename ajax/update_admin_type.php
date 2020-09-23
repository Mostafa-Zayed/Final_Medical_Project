<?php require_once "../globals.php"; ?>
<?php
//pre($_POST);
if (isset($_POST['admin_type'])) {
   
    $admin_id = array_shift($_POST);
    $admin_id = prepare_input($admin_id);
    $data['admin_type'] = prepare_input($_POST['admin_type']);
    $updated = medical_update('admins', $data, "`admin_id` = $admin_id");
    if ($updated) {
        echo "<div class='alert alert-success'>Admin Updated Succfuly</div";
    } else {
        echo "<div class='alert alert-danger'>Admin Not Updated Succfuly</div";
    }
}
?>