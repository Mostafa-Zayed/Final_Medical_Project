<?php require_once "../globals.php"; ?>
<?php is_not_admin(); ?>
<?php
decomposed_array(clean($_POST));
$data = array(
    'department_id' => $department_id
);

$updated = medical_update($models, $data, "`doctor_id` = $doctor_id");
if ($updated) {
    echo "<div class='alert alert-success'> Department Updated Succfuly</div>";
} else {
    echo "<div class='alert alert-danger'> Department Not Updated Succfuly</div>";
}
?>