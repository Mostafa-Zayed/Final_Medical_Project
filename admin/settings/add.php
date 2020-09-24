<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'settings/add.php'?>"> Add Setting</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Setting</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Setting</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                decomposed_array($_POST);
                                $data = array();
                                // Validation
                                // setting_name: required, string, max:30
                                $input = "setting_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_SETTING_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_SETTING_NAME_LENGTH;
                                } 
                                $data[$input] = $$input;
                                $input = "setting_type";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_SETTING_TYPE_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_SETTING_TYPE_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // setting_is_active
                                $input = "setting_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                if (empty($errors)) {
                                    $restult = insert_into_table('settings', $data);
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">Setting Inserted Succfully</div>';
                                    } else {
                                        $success = '<div class="alert alert-danger">Setting NOt Inserted Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="row">
                            <?php $input = "setting_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">State Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Setting Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "setting_type"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Setting Type :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                    <option value='' selected>Select Type Field</option>
                                    <option value="text">Text Field</option>
                                    <option value="password">Password Field</option>
                                    <option value="email">Email Field</option>
                                    <option value="textarea">Textarea Field</option>
                                    <option value="link">Link Field</option>
                                    <option value="number">Number Field</option>
                                </select>
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "setting_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Setting Is Active:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
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