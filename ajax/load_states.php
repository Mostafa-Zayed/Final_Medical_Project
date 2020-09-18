<?php require_once "../globals.php"; 
if (isset($_POST['country_id']) && !empty($_POST['country_id'])) {
    $coutry_id = (int) $_POST['country_id'];
    $id = get_data_by_id('countries', $coutry_id, 'id');
    $id = $id[0]['country_id'];
    if (! empty($id)) {
        
        $states = get_data('states',"where `country_id` = $id and `state_is_active` = 1", 'id,name');
        //print_r($states);
        $output = '';
        $output .= "<option>State Name</option>";                                
        foreach ($states as $state) {
            $output .= "<option value='".$state['state_id']."'>";
            $output .= $state['state_name']."</option>";
        }
        echo $output;
    }
}

?>