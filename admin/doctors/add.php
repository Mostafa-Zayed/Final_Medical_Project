<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'doctors/add.php'?>"> Add Doctor</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Doctors</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Doctors</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                decomposed_array($_POST);
                                $data = array();
                                // Validation
                                // doctor_name: required, string, max:30
                                $input = "doctor_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_NAME_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_phone: required, string, max:30
                                $input = "doctor_phone";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_PHONE_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_PHONE_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_address: required, string, max:30
                                $input = "doctor_address";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_ADDRESS_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_ADDRESS_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_facebook: required, string, max:30
                                $input = "doctor_facebook";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_FACEBOOK_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_FACEBOOK_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_address: required, string, max:30
                                $input = "doctor_twitter";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_TWITTER_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_TWITTER_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_address: required, string, max:30
                                $input = "doctor_instgram";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_INSTGRAM_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_INSTGRAM_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_is_active
                                $input = "doctor_is_show";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                // department_name 
                                $input = "department_id";
                                $$input = (int) $$input;
                                $check_id = get_data_by_id('departments', $$input, 'id');
                                if (empty($check_id)) {
                                    $errors[$input] = 'Invalide Department Data';
                                }
                                $data[$input] = $$input;
                                if (! empty($_FILES)) {
                                    $input = 'doctor_image';
                                    image_validation($_FILES,'png,jpg,jpeg',5);
                                    //$data[$input] = ROOT.'uploads'.DS.'departments'.DS.$_FILES[$input]['name'];
                                    $data[$input] = basename($_FILES[$input]['name']);
                                }
                                echo '<pre>';
                                print_r($data);
                                echo '</pre>';
                                if (empty($errors)) {
                                    uploade_image($_FILES, 'doctors');
                                    $restult = insert_into_table('doctors', $data);
                                    if ($restult) {
                                        echo '<div class="alert alert-success">Data inserted Succ</div>';
                                    } else {
                                        echo 'Error';
                                    }
                                }
                            }
                            ?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <?php $input = "doctor_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_phone"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Phone :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_address"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Address :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_facebook"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Facebook :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_twitter"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Twitter :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_instgram"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Instgram :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_is_show"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Is Show:</label> <?=getError($input); ?>
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
                            <?php $input = "department_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Department Name:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <?php $rows = get_data('departments','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="" selected>Select Department</option>
                                        <?php foreach ($rows as $row): ?>
                                        <option value="<?=$row['department_id']?>"><?=$row['department_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_image"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Image:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="file" name="<?=$input?>" id="<?=$input?>">
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