<?php require_once "../globals.php"; ?>
<?php
if (isset($_POST['setting_id']) && isset($_POST['setting_value'])) {
    $setting_id = array_shift($_POST);
    $setting_id = prepare_input($setting_id);
    $data = array();
    foreach ($_POST as $key => $value) {
        $data[$key] = prepare_input($value);
    }
    $updated = medical_update('settings', $data, "`setting_id` = $setting_id");
}

?>