<?php require_once "../globals.php"; 
if (isset($_POST['service_id']) && !empty($_POST['service_id'])) {

    $service_id = (int) $_POST['service_id'];
    $id = get_data('services',"where `service_id` = $service_id", 'has_doctor');
    $id = $id[0]['service_has_doctor'];
    if (! empty($id)) {
        echo $id;
    }
}

?>