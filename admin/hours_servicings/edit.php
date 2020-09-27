<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<?php
$input = 'hours_servicing_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $hours_servicing_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $hours_servicing_id");
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
            <h4><a href="<?=ADMIN_URL?>index">Dashboard</a> / <a href="<?=ADMIN_URL.$models.'/edit.php?'.$input.'= '.$$input?>"> Update Hours Servicing</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit HOurs Servicing</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>Edit Hours Servicing</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // hours_servicing_day: required, string, max:30
                                $input = "hours_servicing_day";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_HOURS_SERVICING_DAY_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_HOURS_SERVICING_DAY_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // hours_servicing_time: required, string, max:30
                                $input = "hours_servicing_time";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_HOURS_SERVICING_TIME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_HOURS_SERVICING_TIME_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // hours_servicing_is_active
                                $input = "hours_servicing_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                if (empty($errors)) {
                                    $restult = medical_update($models, $data, "`hours_servicing_id` = $hours_servicing_id");
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">HOurs Servicing Updated Succefuly</div>';
                                        $row = get_one($models, '`hours_servicing_id` = '.$hours_servicing_id);
                                    } else {
                                        $success = '<div class="alert alert-danger">Error : Hours Servicing Not Updated Succfuly</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="" method="post">
                            <div class="row">
                                <?php $input = "hours_servicing_day"; ?>
                                <div class="form-group">
                                    <label for="<?=$input?>" class="col-md-2">Hours Servicing Day :</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Hours Servicing Day" name="<?=$input?>" value="<?=$row['hours_servicing_day']?>">
                                        </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <?php $input = "hours_servicing_time"; ?>
                                <div class="form-group">
                                    <label for="<?=$input?>" class="col-md-2">Hours Servicing Time :</label> <?=getError($input); ?>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter HOurs Servicing Time" name="<?=$input?>" value="<?=$row['hours_servicing_time']?>">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <?php $input = "hours_servicing_is_active"; ?>
                                <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Hours Servicing Is Active:</label> <?=getError($input); ?>
                                    <div class="col-md-9">
                                        <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                            <option value="1" <?=isset($row[$input]) && $row[$input] == '1' ? 'selected' : ''?>>Active</option>
                                            <option value="0" <?=isset($row[$input]) && $row[$input] == '0' ? 'selected' : ''?>>Not Active</option>
                                        </select>
                                    </div>            
                                </div>       
                            </div>
                            <br>
                            
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
<?php require_once ADMIN_INCLUDES."footer.php"; ?>