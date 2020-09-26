<?php

if (! function_exists('create_sidebar')) 
{
    function create_sidebar(array $sidebar, $prefix): string
    {
        
        $items = '';
        foreach ($sidebar as $icon => $value) {
            $items .= "<li><a href='{$prefix}{$value}/view.php'><i class='fa fa-$icon'></i>".ucfirst($value)."</a></li>";
            
        }
        return $items;
    }
}
function decomposed_settings(array $data) 
    {
        $count = count($data);
        $resource = array();
        foreach ($data as $key => $value){
            foreach($value as $key2 => $value2){
                $key = $value['setting_name'];
                $resource[$key] = $value['setting_value'];
            }
        }
        return $resource;
    }

function get_models(string $input) 
{
    $input = substr($input,0,strrpos($input, '_'));
    $last_char = substr($input, -1);
    if ($last_char === 'y') {
        $input = rtrim($input, 'y');
        return $input .= 'ies';
    } else {
        return $input .= 's';
    }
}


function show_error_required(array $data, array $required)
{
    global $errors;
    foreach ($data as $key => $value)
    {
        if (! in_array($key, $required)) {
            unset($data[$key]);
        }
    }
    $errors = array_map('is_required', $data);
    foreach ($errors as $key => $value) {
        if (empty($value)) {
            $errors[$key] = 'required';
        } else {
            unset($errors[$key]);
        }
    }
}

// This Code For enhanced Only 
//$data = clean($_POST);
//$fields_required = ['city_name','city_is_active','state_id'];
//show_error_required($data, $fields_required);