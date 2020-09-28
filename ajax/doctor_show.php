<?php require_once "../globals.php"; ?>
<?php
decomposed_array($_POST);

$column = get_column_name($models);
$column =  $column.'_id';

$column_active = get_column_name($models);
$column_active .= '_is_show';

$data = array(
    $column_active => $active
);

$updated = medical_update($models, $data, "`$column` = $id");
if ($updated) {
    echo "<div class='alert alert-success'> Show  Updated Succfuly</div>";
} else {
    echo "<div class='alert alert-danger'> show Not Updated Succfuly</div>";
}
?>