<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'states/view.php'?>">States</a> / <a href="<?=ADMIN_URL.'states/add.php'?>"> Add State</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create State</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New State</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // state_name: required, string, max:30
                                $input = "state_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_STATE_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_STATE_NAME_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // state_is_active
                                $input = "state_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                // country_name 
                                $input = "country_id";
                                $$input = (int) $$input;
                                $check_id = get_data_by_id('countries', $$input, 'id');
                                if (empty($check_id)) {
                                    $errors[$input] = 'Invalid Country Data';
                                }
                                $data[$input] = $$input;
                                if (empty($errors)) {
                                    $restult = insert_into_table('states', $data);
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">State Inserted Succfully</div>';
                                    } else {
                                        $success = '<div class="alert alert-danger">State NOt Inserted Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="row">
                            <?php $input = "state_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">State Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "state_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">State Is Active:</label> <?=getError($input); ?>
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
                            <?php $input = "country_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Country Name:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <?php $rows = get_data('countries','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option selected>Select Country</option>
                                        <?php foreach ($rows as $row): ?>
                                        <option value="<?=$row['country_id']?>"><?=$row['country_name']?></option>
                                        <?php endforeach; ?>
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
<?php require_once ADMIN_INCLUDES."footer.php"; ?>