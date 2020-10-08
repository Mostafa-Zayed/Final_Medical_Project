<?php
// Database Server 
defined('DB_SERVERNAME') || define('DB_SERVERNAME','localhost');

// Database Username
defined('DB_USERNAME') || define('DB_USERNAME','root');

// Database Password
defined('DB_PASSWORD') || define('DB_PASSWORD','');

// Database Name
defined('DB_NAME') || define('DB_NAME','medical_test');

// DIRECTORY SEPARATOR
defined('DS') || define('DS',DIRECTORY_SEPARATOR);

// ROOT PATH
defined('ROOT') || define('ROOT',__DIR__.DS);

// AUTH PATH
defined('AUTH') || define('AUTH',ROOT.'auth'.DS);

// FRONTEND ASSETS PATH
defined('WEBSITE_ASSETS') || define('WEBSITE_ASSETS',ROOT.'assets'.DS.'frontend'.DS);

// DASHBOARD ASSETS PATH
defined('DASHBOARD_ASSETS') || define('DASHBOARD_ASSETS',ROOT.'assets'.DS.'dashboard'.DS);

// ADMIN PATH
defined('ADMIN') || define('ADMIN',ROOT.'admin'.DS);

// INC FRONTEND PATH
defined('INCLUDES') || define('INCLUDES',ROOT.'includes'.DS);

// INC DASHBOARD PAHT
defined('ADMIN_INCLUDES') || define('ADMIN_INCLUDES',ADMIN.'includes'.DS);

// CORE PATH
defined('CORE') || define('CORE',ROOT.'core'.DS);

// UPLOADS PATH
defined('UPLOADS') || define('UPLOADS',ROOT.'uploads'.DS);


// WEBSITE URL LINK
defined('WEBSITE_URL') || define('WEBSITE_URL','http://'.$_SERVER['HTTP_HOST'].DS.'medical_test'.DS);

// UPLOADE_URL
defined('UPLOADE_URL') || define('UPLOADE_URL',WEBSITE_URL.'uploads/');

// ADMIDN URL LINK
defined('ADMIN_URL') || define('ADMIN_URL',WEBSITE_URL.'admin'.DS);

// IMAGES URL LINK
defined('IMAGES_URL') || define('IMAGES_URL',WEBSITE_URL.'assets/frontend/img/');

// SITE_TITLE
defined('WEBSITE_TITLE') || define('WEBSITE_TITLE','Medical');

?>