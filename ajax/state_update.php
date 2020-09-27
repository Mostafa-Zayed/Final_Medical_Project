<?php require_once "../globals.php"; ?>
<?php
decomposed_array(clean($_POST));
$data = array(
    'state_id' => $state_id
);

$updated = medical_update($models, $data, "`city_id` = $city_id");
if ($updated) {
    echo "<div class='alert alert-success'> State Updated Succfuly</div>";
} else {
    echo "<div class='alert alert-danger'> State Not Updated Succfuly</div>";
}
?>