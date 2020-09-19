<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'service_types/add.php'?>"> Add Service Type</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Service Type</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Service Type</h2>
                            </div>
                            <br>
                            
                            <?php if (isset($_POST['submit'])) {
                                decomposed_array($_POST);
                                $data = array();
                                // Validation
                                // service_type_name: required, string, max:30
                                $input = "service_type_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_SERVICE_TYPE_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_SERVICE_TYPE_NAME_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // service_type_is_active
                                $input = "service_type_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                
                                if (empty($errors)) {
                                    $restult = insert_into_table('service_types', $data);
                                    if ($restult) {
                                        echo '<div class="alert alert-success">Data inserted Succ</div>';
                                    } else {
                                        echo 'Error';
                                    }
                                }
                            }
                            ?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="row">
                            <?php $input = "service_type_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Service Type Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Type Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "service_type_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Service Is Active:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                </div>            
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