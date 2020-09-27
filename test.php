<?php require_once "globals.php";
$city_id = 1;
$data = array('appointments','cities');
echo get_data_join($data, "appointments.city_id = $city_id");
?>

