<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'countries/add.php'?>"> Add Countries</a></h4>
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
                                decomposed_array($_POST);
                                // Validation
                                // country_name: required, string, max:30
                                if (! is_required($country_name)) {
                                    $errors['country_name'] = 'required';
                                } elseif (! is_string_modified($country_name)) {
                                    $errors['country_name'] = 'Must be String';
                                } elseif (! is_not_more_than($country_name, MAXCOUNTRYLENGTH)) {
                                    $errors['country_name'] = 'Must be less than '.MAXCOUNTRYLENGTH;
                                } elseif (! is_belongs_to($country_is_active)) {
                                    $errors['country_is_active'] = 'Invalid Active Data';
                                }
                                if (empty($errors)) {
                                    $data = array(
                                        'country_name' => $country_name,
                                        'country_is_active' => $country_is_active
                                    );
                                    $restult = insert_into_table('countries', $data);
                                    if ($restult) {
                                        echo 'Data inserted Succ';
                                    } else {
                                        echo 'Error';
                                    }
                                }
                            }
                            ?>
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