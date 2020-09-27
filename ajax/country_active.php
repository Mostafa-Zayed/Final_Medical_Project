<?php require_once "../globals.php"; ?>
<?php
decomposed_array(clean($_POST));
$data = array(
    'country_id' => $country_id
);

$updated = medical_update($models, $data, "`state_id` = $state_id");
if ($updated) {
    echo "<div class='alert alert-success'> Country Updated Succfuly</div>";
} else {
    echo "<div class='alert alert-danger'> Country Not Updated Succfuly</div>";
}
?>