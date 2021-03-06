<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'countries/view.php'?>"> Countries </a> / <a href="<?=ADMIN_URL.'countries/add.php'?>"> Add Country</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Country</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Country</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
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
                                    $restult = insert_into_table('countries', $data);
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">Admin Inserted Succfully</div>';
                                } else {
                                    $success = '<div class="alert alert-danger">Admin NOt Inserted Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="row">
                            <div class="form-group">
                                <label for="country_name" class="col-md-2">Country Name :</label> <?=getError('country_name'); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="country_name" placeholder="Enter Country Name" name="country_name">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <div class="form-group">
                                <label for="country_is_active" class="col-md-2">Country Is Active:</label> <?=getError('country_is_active'); ?>
                                <div class="col-md-9">
                                    <select name="country_is_active" id="country" class="form-control">
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