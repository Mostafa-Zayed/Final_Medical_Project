<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php
$input = 'doctor_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $doctor_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $doctor_id");
    if (empty($row)) {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div id="message"></div>
            <h4><a href="<?=ADMIN_URL?>index">Dashboard</a> / <a href="<?=ADMIN_URL.$models.'/view'?>"> Doctors </a> / <a href="<?=ADMIN_URL.$models.'/add'?>"> Update Doctor</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Doctors</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2> Edit Doctors</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // doctor_name: required, string, max:50
                                $input = "doctor_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_NAME_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_phone: string, max:20
                                $input = "doctor_phone";
                                if (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_PHONE_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_PHONE_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_address: string, max:150
                                $input = "doctor_address";
                                if (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_ADDRESS_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_ADDRESS_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_facebook: string, max:255
                                $input = 'doctor_facebook';
                                if (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_FACEBOOK_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_FACEBOOK_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_address: required, string, max:255
                                $input = "doctor_twitter";
                                if (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_TWITTER_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_TWITTER_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_address: required, string, max:30
                                $input = "doctor_instgram";
                                if (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_DOCTOR_INSTGRAM_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_DOCTOR_INSTGRAM_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                // doctor_is_show
                                $input = "doctor_is_show";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Show Data';
                                }
                                $data[$input] = $$input;
                                // doctor_is_active
                                $input = "doctor_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                // doctor_is_rating
                                $input = "doctor_is_rating";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Rating Data';
                                }
                                $data[$input] = $$input;
                                // department_name 
                                $input = "department_id";
                                if (! empty($$input)) {
                                    $$input = (int) $$input;
                                    $check_id = get_data_by_id('departments', $$input, 'id');
                                    if (empty($check_id)) {
                                        $errors[$input] = 'Invalide Department Data';
                                    }
                                    $data[$input] = $$input;
                                }
                                // doctor_image
                                $input = 'doctor_image';
                                if (! empty($_FILES) && !empty($_FILES[$input]['name'])) {
                                    image_validation($_FILES,'png,jpg,jpeg',5);
                                    $data[$input] = basename($_FILES[$input]['name']);
                                    if (isset($old_image)){
                                        $path = UPLOADS.'doctors'.DS.$old_image;
                                    }
                                }
                                if (empty($errors)) {
                                    if (isset($path) && !empty($path)) {
                                        uploade_image($_FILES, 'doctors');
                                        unlink($path);
                                    }
                                    uploade_image($_FILES, 'doctors');
                                    $restult = medical_update($models, $data, "`doctor_id` = $doctor_id");
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">Doctor Updated Succfully</div>';
                                        $row = get_one($models, '`doctor_id` = '.$doctor_id);
                                    } else {
                                    $success = '<div class="alert alert-danger">Doctor NOt Updated Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <?php $input = "doctor_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_phone"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Phone :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_address"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Address :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_facebook"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Facebook :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="link" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_twitter"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Twitter :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="link" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_instgram"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Instgram :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="link" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
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
                                        <option value="1" <?=isset($row[$input]) && $row[$input] == '1' ? 'selected' : ''?>>Visiable</option>
                                        <option value="0" <?=isset($row[$input]) && $row[$input] == '0' ? 'selected' : ''?>>Hidden</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Is active:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1" <?=isset($row[$input]) && $row[$input] == '1' ? 'selected' : ''?>>Active</option>
                                        <option value="0" <?=isset($row[$input]) && $row[$input] == '0' ? 'selected' : ''?>>Not Active</option>
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
                                <?php $departments = get_data('departments','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="" >Select Department</option>
                                        <?php foreach ($departments as $department): ?>
                                        <option value="<?=$department['department_id']?>" <?=($department[$input] == $row[$input]) ? 'selected' : ''?>><?=ucfirst($department['department_name'])?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <br>
                                <div class="row">
                                    <?php $input = "doctor_is_rating"; ?>
                                    <div class="form-group">
                                        <label for="<?=$input?>" class="col-md-2">Doctor Is Rating:</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                                <option value="1" <?=isset($row[$input]) && $row[$input] == '1' ? 'selected' : ''?>>Rating</option>
                                                <option value="0" <?=isset($row[$input]) && $row[$input] == '0' ? 'selected' : ''?>>Not Rating</option>
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
                        <?php $input = 'old_image'; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Old Image:</label>
                                <?php if (!empty($row['doctor_image'])): ?>
                                <div class='col-md-9'>
                                    <input type="hidden" name="<?=$input?>" value="<?=$row['doctor_image']?>">
                                    <img src="<?=WEBSITE_URL.'uploads'.DS.'doctors'.DS.$row['doctor_image']?>" width="70%">;
                                </div>
                                <?php else: ?>
                                <div class='col-md-9'>
                                    <div class="alert alert-warning"> No Image Yet</div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br>
                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-info" name="submit">Update </button>
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