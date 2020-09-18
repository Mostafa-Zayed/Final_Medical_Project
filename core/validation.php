<?php
// Array Of Errors
$errors = array();
$fixed = array();
$length_constants['country_name'] = 30;
$length_constants['state_name'] = 30;
$length_constants['email'] = 100;
$length_constants['password'] = 255;
$length_constants['city_name'] = 100;
$length_constants['pagename'] = 50;
$length_constants['sliderheading'] = 60;
$length_constants['appointment_name'] = 50;
$length_constants['appointment_phone'] = 20;
$length_constants['appointment_email_'] = 100;
//$length_constants['country'] = 30;
//$length_constants['country'] = 30;

foreach ($length_constants as $key => $value) {
	defined(strtoupper('max_'.$key.'_length')) || define(strtoupper('max_'.$key.'_length'), $value);
}
//echo MAX_STATE_NAME_LENGTH;
// Constant Of MaxEmaillength
//defined('MAXEMAILLENGTH') || define('MAXEMAILLENGTH',100);

// Constant Of MaxPasswordLength
//defined('MAXPASSWORDLENGTH') || define('MAXPASSWORDLENGTH',255);

// Constant Of MaxCityNameLength
//defined('MAXCITYNAMELENGTH') || define('MAXCITYNAMELENGTH',100);

// Constant Of MaxORDERNameLength
//defined('MAXORDERNAMELENGTH') || define('MAXORDERNAMELENGTH',255);

// Constant Of MaxPhoneLength
//defined('MAXPHONELENGTH') || define('MAXPHONELENGTH',20);

// Constant Of MaxCountrylength
//defined('MAXCOUNTRYLENGTH') || define('MAXEMAILLENGTH',30);

/**
* This Function To Check if The Value Email Or Not
*
* @param String $vlaue
* @return bool 
*/
function is_email(string $value): bool 
{
	return filter_var($value,FILTER_VALIDATE_EMAIL);
}

/**
* This Function To Check if The Value is String
* 
* @param mixed $vlaue
* @return bool
*/
function is_string_modified($value): bool
{
	return is_string($value);
}

/**
* This Function To Check if The Value Required and Not empty
*
* @param mixed $value
* @return bool
*/
function is_required($value): bool
{
	return !empty($value);
}

/**
 * This Function To Check if The Value Less Than MaxLength
 * 
 * @param string $value
 * @return bool
 */
function is_not_more_than(string $value, int $maxlength): bool
{
	return strlen($value) <= $maxlength;
}

/**
 * This Function Check if The Value Integer Or Not 
 * 
 * @param int $value
 * @return boll
 */
function is_integer_modified($value)
{
	return is_int($value);
}
/**
 * This Function Get Error By Key
 * 
 * @param string $key
 * @return string 
 */
function getError(string $key) 
{
	global $errors;
	return isset($errors[$key]) ? '<span class="alert-danger"> ( '.$errors[$key].' ) </span>' : false;
}

/**
 * This Function Check Is Value In Array
 * 
 * @param int $value
 * @return bool
 */
function is_belongs_to($value, array $data): bool
{
	return in_array($value, $data);
}

function image_validation(array $resource, string $mimes, int $file_max_size)
{
    $file_name = basename($resource['imagefile']['name']);
    $extension = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
    $types = explode( ',', $mimes);
    foreach($types as $key => $value) {
        $types[$key] = trim($value, ' ');
    }
    if(! in_array($extension, $types) && $resource['imagefile']['type'] !== 'image/'.$extension) {
        $errors['type'] = 'type error';
    }
    $file_size = ($file_max_size * 1024) * 1024 ;
    if ($resource['imagefile']['size'] > $file_size) {
        $errors['file_size'] = 'size eerror';
    }
    
}   
?>