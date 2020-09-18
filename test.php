<?php require_once "globals.php";
//$service_hours = get_data('hours_servicings','where hours_servicing_is_active = 1','day,time');
//echo $service_hours;
//set_session('name','mostafa');

/*
$types = '    jpg   ,    png    ,      jpeg';

$data = explode(',', $types);
foreach($data as $key => $value) {
    $data[$key] = trim($value, ' ');
}
var_dump($data);
$filecheck = "test.jpg ";
$text = strtolower(substr($filecheck, strrpos($filecheck, '.') + 1));
echo $ext;
if (in_array($text, $data)) {
    echo 'ok';
}
*/
$service_id = 1;
$id = get_data('services',"where `service_id` = $service_id", 'has_doctor');
print_r($id);

?>
