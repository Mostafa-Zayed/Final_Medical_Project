<?php require_once 'config.php'; 

$files = glob(CORE."*.php");
foreach ($files as $file) {
    require_once $file;
}
ob_start();
check_session();

?>

