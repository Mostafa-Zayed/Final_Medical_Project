<?php require_once "globals.php";

$_POST['name'] = 'mostafa';
$_POST['age'] = 33;

$data = clean($_POST);
pre($data);
//echo array_key_exists('name',$_POST);
$required = ['name'];
show_error_required($data, $required);
/*
foreach ($data as $key => $value) {
	$errors = array_map('is_required', $data);
}
foreach ($errors as $key => $error) {
	if (empty($error)) {
		$errors[$key] = ucfirst($key) .' Is required';
	} else {
		unset($errors[$key]);
	}
}
pre($errors);
*/
?>

