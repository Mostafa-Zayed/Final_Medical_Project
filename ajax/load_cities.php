<?php require_once "../globals.php"; 
if (isset($_POST['state_id']) && !empty($_POST['state_id'])) {
    $state_id = (int) $_POST['state_id'];
    $id = get_data_by_id('states', $state_id, 'id');
    $id = $id[0]['state_id'];
    if (! empty($id)) {
        
        $cities = get_data('cities',"where `state_id` = $id and `city_is_active` = 1", 'id,name');
        //print_r($states);
        $output = '';
        $output .= "<option>City Name</option>";                                
        foreach ($cities as $city) {
            $output .= "<option value='".$city['city_id']."'>";
            $output .= $city['city_name']."</option>";
        }
        echo $output;
    }
}

?>