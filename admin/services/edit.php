<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<?php
$input = 'service_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $service_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $service_id");
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
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.$models.'/edit.php?'.$input.'= '.$$input?>"> Update Service</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Service</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>Edit Service</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                decomposed_array($_POST);
                                $data = array();
                                // Validation
                                // state_name: required, string, max:30
                                $input = "service_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_SERVICE_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_SERVICE_NAME_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // service_type_name
                                $input = "service_type_id";
                                $$input = (int) $$input;
                                $check_id = get_data_by_id('service_types', $$input, 'id');
                                if (empty($check_id)) {
                                    $errors[$input] = 'Invalide Service Type Data';
                                }
                                $data[$input]=  $$input;
                                // service_has_doctor
                                $input = "service_has_doctor";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Service Has Doctor Data';
                                }
                                $data[$input] = $$input;
                                // service_is_active
                                $input = "service_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                // service_type_name
                                $input = "service_type_id";
                                $$input = (int) $$input;
                                $check_id = get_data_by_id('service_types', $$input, 'id');
                                if (empty($check_id)) {
                                    $errors[$input] = 'Invalide Service Type Data';
                                }
                                $data[$input] = $$input;
                                if (empty($errors)) {
                                    $restult = medical_update($models, $data, "`service_id` = $service_id");
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">Service Updated Succefuly</div>';
                                        $row = get_one($models, '`service_id` = '.$service_id);
                                    } else {
                                        $success = '<div class="alert alert-danger">Error : Service Not Updated Succfuly</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="" method="post">
                                <div class="row">
                                <?php $input = "service_name"; ?>
                                    <div class="form-group">
                                        <label for="<?=$input?>" class="col-md-2">Service Name :</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Service Name" name="<?=$input?>" value="<?=$row['service_name']?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                <?php $input = "service_type_id"; ?>
                                <div class="form-group">
                                    <label for="<?=$input?>" class="col-md-2">Service Type :</label> <?=getError($input); ?>
                                    <div class="col-md-9">
                                    <?php $rows = get_data('service_types','','id,name'); ?>
                                        <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value=''>Select Type</option>
                                        <?php foreach ($rows as $trow): ?>
                                        <option value="<?=$trow[$input]?>" <?=$trow[$input] === $row[$input] ? 'selected' : ''?>><?=$trow['service_type_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "service_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Service Is Active:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1" <?=isset($row[$input]) && $row[$input] == '1' ? 'selected' : ''?>>Active</option>
                                        <option value="0" <?=isset($row[$input]) && $row[$input] == '0' ? 'selected' : ''?>>Not Active</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "service_has_doctor"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Service Has Doctor:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1" <?=isset($row[$input]) && $row[$input] == '1' ? 'selected' : ''?>>Has A Doctor</option>
                                        <option value="0" <?=isset($row[$input]) && $row[$input] == '0' ? 'selected' : ''?>>Has Not A Doctor</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-info" name="submit">Update</button>
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