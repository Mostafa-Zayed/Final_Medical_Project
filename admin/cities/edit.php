<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php
$input = 'city_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $city_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $city_id");
    if (empty($row)) {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.$models.'/edit.php?'.$input.'='.$$input?>"> Update City</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit City</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>Edit City</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                decomposed_array($_POST);
                                $data = array();
                                // Validation
                                // city_name: required, string, max:30
                                $input = 'city_name';
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_CITY_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_CITY_NAME_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                $input = 'city_is_active';
                                if (! is_belongs_to($$input, array(0,1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                // state_name 
                                $input = "state_id";
                                $$input = (int) $$input;
                                $check_id = get_data_by_id('states', $$input, 'id');
                                if (empty($check_id)) {
                                    $errors[$input] = 'Invalide state Data';
                                }
                                $data[$input] = $$input;
                                if (empty($errors)) {
                                    //pre($data);
                                    
                                    $restult = medical_update($models, $data, "`city_id` = $city_id");
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">City Updated Succefuly</div>';
                                        $row = get_one($models, '`city_id` = '.$city_id);
                                    } else {
                                        $success = '<div class="alert alert-danger">Error : City Not Updated Succfuly</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="" method="post">
                            <div class="row">
                            <?php $input = "city_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">City Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter City Name" name="<?=$input?>" value="<?=(isset($row[$input])? $row[$input] : '')?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "city_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">City Is Active:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="city" class="form-control">
                                        <option value="1" <?=isset($row[$input]) && $row[$input] == '1' ? 'selected' : ''?>>Active</option>
                                        <option value="0" <?=isset($row[$input]) && $row[$input] == '0' ? 'selected' : ''?>>Not Active</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <br>
                            <div class="row">
                            <?php $input = "state_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">State Name:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <?php $rows = get_data('states','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value = ''>Select State</option>
                                        <?php foreach ($rows as $crow): ?>
                                        <option value="<?=$crow[$input]?>" <?=$crow[$input] === $row[$input] ? 'selected' : ''?>><?=$crow['state_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-info" name="submit"> Update</button>
                                </div>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            
        </div>
    </div>
</div>
<?php require_once INCLUDES."footer_dashboard.php"; ?>