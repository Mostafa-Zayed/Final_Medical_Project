<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'hours_servicings/add.php'?>"> Add Hours Servicing</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Hour Servicing</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Hour Servicing</h2>
                            </div>
                            <br>
                            
                            <?php if (isset($_POST['submit'])) {
                                decomposed_array($_POST);
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
                                    $restult = insert_into_table('hours_servicings', $data);
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">HOurs Servicong inserted Succefuly</div>';
                                    } else {
                                        $success = '<div class="alert alert-danger">Page HOurs Servicing Succefuly</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="row">
                            <?php $input = "hours_servicing_day"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Hours Servicing Day :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter HOurs Servicing Day" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "hours_servicing_time"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Hours Servicing Time :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter HOurs Servicing Time" name="<?=$input?>">
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
                                        <option value="1" selected>Active</option>
                                        <option value="0">Not Active</option>
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