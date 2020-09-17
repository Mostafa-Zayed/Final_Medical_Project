<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'states/add.php'?>"> Add State</a></h4>
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
                                decomposed_array($_POST);
                                $data = array();
                                // Validation
                                // state_name: required, string, max:30
                                $input = "state_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAXSTATELENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAXSTATELENGTH;
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
                                    $errors[$input] = 'Invalide Country Data';
                                }
                                if (empty($errors)) {
                                    $data = array(
                                        'state_name' => $state_name,
                                        'state_is_active' => $state_is_active,
                                        'country_id' => $country_id
                                    );
                                    $restult = insert_into_table('states', $data);
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
<?php require_once INCLUDES."footer_dashboard.php"; ?>