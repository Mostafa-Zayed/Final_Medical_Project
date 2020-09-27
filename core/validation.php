<?php
// Varaible Success Message 
$success = '';
// Array Of Errors
$errors = array();
// Array Of Length Constans
$fixed = array();
// User
$length_constants['user_name'] = 100;
$length_constants['user_email'] = 100;
$length_constants['user_password'] = 255;
$length_constants['user_age'] = 3;
$length_constants['user_phone'] = 20;
// Admin
$length_constants['admin_name'] = 50;
$length_constants['admin_email'] = 100;
$length_constants['admin_password'] = 255;
$length_constants['admin_image'] = 255;
// 
$length_constants['service_type_name'] = 100;
//
$length_constants['country_name'] = 30;
$length_constants['state_name'] = 30;
$length_constants['email'] = 100;
$length_constants['password'] = 255;
$length_constants['city_name'] = 100;
$length_constants['page_name'] = 20;
$length_constants['page_link'] = 20;

$length_constants['department_name'] = 50;
$length_constants['brand_name'] = 20;
$length_constants['feature_name'] = 50;
$length_constants['feature_icon'] = 50;
$length_constants['doctor_name'] = 50;
$length_constants['doctor_phone'] = 20;
$length_constants['doctor_address'] = 150;
$length_constants['doctor_facebook'] = 255;
$length_constants['doctor_twitter'] = 255;
$length_constants['doctor_instgram'] = 255;
$length_constants['hours_servicing_day'] = 50;
$length_constants['hours_servicing_time'] = 50;
$length_constants['service_name'] = 100;
$length_constants['sliderheading'] = 60;
$length_constants['appointment_name'] = 50;
$length_constants['appointment_phone'] = 20;
$length_constants['appointment_email'] = 100;

// Settings Constants
$length_constants['setting_name'] = 100;
$length_constants['setting_type'] = 100;
$length_constants['setting_value'] = 255;
//$length_constants['user_email'] = 100;


foreach ($length_constants as $key => $value) {
	defined(strtoupper('max_'.$key.'_length')) || define(strtoupper('max_'.$key.'_length'), $value);
}
$min_length_constants['user_password'] = 8;
$min_length_constants['admin_password'] = 8;
//$min_length_constants['user_name'] 
foreach ($min_length_constants as $key => $value) {
	defined(strtoupper('min_'.$key.'_length')) || define(strtoupper('min_'.$key.'_length'), $value);
}


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

function is_not_less_than(string $value, int $minlength): bool
{
    return strlen($value) >= $minlength;
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
    global $errors;
    global $input;
    $file_name = basename($resource[$input]['name']);
    $extension = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
    $types = explode( ',', $mimes);
    foreach($types as $key => $value) {
        $types[$key] = trim($value, ' ');
    }
    if(! in_array($extension, $types) && $resource[$input]['type'] !== 'image/'.$extension) {
        $errors['file_type'] = '<b color="red">Error : </b>Type Of Image Not Allow ';
    }
    $file_size = ($file_max_size * 1024) * 1024 ;
    if ($resource[$input]['size'] > $file_size) {
        $errors['file_size'] = '<b> Error : </b> Image Size Must Less Than '.$file_max_size.' Mb';
    }
    
}   

function uploade_image(array $resource, string $uploade_dir)
{
    global $errors;
    global $input;
    if (! isset($errors['file_type']) && ! isset($errors['file_size'])) {
        $tmp_image = $resource[$input]['tmp_name'];
        $image_name = basename($resource[$input]['name']);
        $uploade_dir = 'uploads'.DS.$uploade_dir.DS;
        if (move_uploaded_file($tmp_image, ROOT.$uploade_dir.$image_name)) {
            return 'Image Uploaded Succefuly';
        } else {
            $errors['image'] = 'Image Not Uploaded Succfuly';
        }
    } else {
        return '<br>Erro : </br> Image Not Uploaded Succefuly';
    }
}

function clean($resource)
{
    if (is_array($resource)) {
        foreach ($resource as $key => $value) {
            unset($resource[$key]);
            $data[trim(htmlspecialchars($key))] = trim(htmlspecialchars($value));
        }
    } else {
        $data = trim(htmlspecialchars($resource));
    }
    return $data;
}
function pre(array $data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
?>