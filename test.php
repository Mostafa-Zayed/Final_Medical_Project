<?php require_once "globals.php";

$rows = get_table_count_where('appointments',"DATE(appointment_is_created_at) = CURDATE()");
echo $rows;
//pre($rows);
	
?>

