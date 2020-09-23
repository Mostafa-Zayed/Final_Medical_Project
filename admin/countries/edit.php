<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php
$input = 'country_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $country_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $country_id");
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
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'countries/edit.php?'.$input.'= '.$$input?>"> Update Country</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Country</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>Edit Country</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                decomposed_array($_POST);
                                $data = array();
                                // Validation
                                // country_name: required, string, max:30
                                $input = 'country_name';
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_COUNTRY_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_COUNTRY_NAME_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                $input = 'country_is_active';
                                if (! is_belongs_to($$input, array(0,1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                if (empty($errors)) {
                                    $restult = medical_update($models, $data, "`country_id` = $country_id");
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">Country Updated Succefuly</div>';
                                        $row = get_one($models, '`country_id` = '.$country_id);
                                    } else {
                                        $success = '<div class="alert alert-danger">Error : Country Not Updated Succfuly</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="" method="post">
                            <div class="row">
                            <?php $input = "country_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Country Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Country Name" name="<?=$input?>" value="<?=(isset($row[$input])? $row[$input] : '')?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "country_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Country Is Active:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="country" class="form-control">
                                        <option value="1" <?=isset($row[$input]) && $row[$input] == '1' ? 'selected' : ''?>>Active</option>
                                        <option value="0" <?=isset($row[$input]) && $row[$input] == '0' ? 'selected' : ''?>>Not Active</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-info" name="submit">Create</button>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            
        </div>
    </div>
</div>
<?php require_once INCLUDES."footer_dashboard.php"; ?>