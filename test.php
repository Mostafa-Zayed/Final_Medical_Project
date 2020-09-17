<?php require_once "globals.php";
//echo get_data_by_id('countries','1','country_name');
//print_r( get_data_by_id('countries','1','country_name'));
//var_dump(getAll('countries','where country_id = 1'));
//echo column_name('countries');
 //insert_into_table('countries',['country_name' => 'test2']);
 //print_r(delete_by_id('countries','4'));
//print_r(get_columns_name('countries','mostafa,ahmed'));
//print_r(get_data('countries','','id,name,is_active'));
//echo is_belongs_to('5');
/*
session_start();

//echo $_SESSION['']
echo $_SERVER['HTTP_USER_AGENT'];
echo '<br>';
if (isset($_SESSION['HTTP_USER_AGENT'])) {
    echo 'ok';
} else {
    $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
}
echo '<br>';
echo $_SESSION['HTTP_USER_AGENT'];
*/
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


?>
