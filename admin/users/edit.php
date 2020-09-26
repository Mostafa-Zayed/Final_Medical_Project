<?php require_once "../../globals.php"; ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<?php
$input = 'user_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $user_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $user_id");
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
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'users/view.php'?>">Users</a> /<a href="<?=ADMIN_URL.$models.'/edit.php?'.$input.'= '.$$input?>"> Update User</a></h4>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit User</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <h2>Edit User</h2>
                    </div>
                    <br>
                    <?php if (isset($_POST['submit'])) {
                    unset($_POST['submit']);
                    decomposed_array(clean($_POST));
                    $data = array();
                    // Validation
                    // user_name: required, string, max:100
                    $input = "user_name";
                    if (! is_required($$input)) {
                        $errors[$input] = 'required';
                    } elseif (! is_string_modified($$input)) {
                        $errors[$input] = 'Must be String';
                    } elseif (! is_not_more_than($$input, MAX_USER_NAME_LENGTH)) {
                        $errors[$input] = 'Must be less than '.MAX_USER_NAME_LENGTH;
                    } 
                    $data[$input] = $$input;
                    // user_email: required, string, max:100
                    $input = "user_email";
                    if (! is_required($$input)) {
                        $errors[$input] = 'required';
                    } elseif (! is_email($$input)) {
                        $errors[$input] = 'Invalid Email';
                    } elseif (! is_not_more_than($$input, MAX_USER_EMAIL_LENGTH)) {
                        $errors[$input] = 'Email Must be Less Than '.MAX_USER_EMAIL_LENGTH;
                    }
                    $data[$input] = $$input;
                    // user_password
                    $input = 'user_password';
                    if (! empty($$input)) {
                        if (! is_required($$input)) {
                            $errors[$input] = 'required';
                        } elseif (! is_string_modified($$input)) {
                            $errors[$input] = 'Password Must be String';
                        } elseif (! is_not_more_than($$input, MAX_USER_PASSWORD_LENGTH)) {
                            $errors[$input] = 'Password Must be Less Than '.MAX_USER_PASSWORD_LENGTH;
                        } elseif (! is_not_less_than($$input, MIN_USER_PASSWORD_LENGTH)) {
                            $errors[$input] = 'Password Must be More Than '.MIN_USER_PASSWORD_LENGTH;
                        }
                        $data[$input] = password_hash($$input, PASSWORD_DEFAULT);
                    }
                    // user:phone
                    $input = "user_phone";
                    if (! empty($$input)) {
                        if (! is_string_modified($$input)) {
                            $errors[$input] = 'Must be String';
                        } elseif (! is_not_more_than($$input, MAX_USER_PHONE_LENGTH)) {
                            $errors[$input] = 'Must be less than '.MAX_USER_PHONE_LENGTH;
                        } 
                        $data[$input] = $$input;
                    }
                    // user_age: required, string, max:30
                    $input = "user_age";
                    if (! empty($$input)) {
                        if (! is_string_modified($$input)) {
                            $errors[$input] = 'Must be String';
                        } elseif (! is_not_more_than($$input, MAX_USER_AGE_LENGTH)) {
                            $errors[$input] = 'Must be less than '.MAX_USER_AGE_LENGTH;
                        } 
                        $data[$input] = $$input;
                    }
                    // user_gender
                    $input = "user_gender";
                    if (! is_belongs_to($$input, array('male','female'))) {
                        $errors[$input] = 'Invalid Gender';
                    }
                    $data[$input] = $$input;
                    // user_is_active
                    $input = "user_is_active";
                    if (! is_belongs_to($$input, array(0, 1))) {
                        $errors[$input] = 'Invalid Active Data';
                    }
                    $data[$input] = $$input;
                    // user_image
                    $input = 'user_image';
                    if (! empty($_FILES) && ! empty($_FILES[$input]['name'])) {
                        image_validation($_FILES,'png,jpg,jpeg',5);
                        $data[$input] = basename($_FILES[$input]['name']);
                        if (isset($old_image)){
                            $path = UPLOADS.'users'.DS.$old_image;
                        }
                    }
                    if (empty($errors)) {
                        if (isset($path) && !empty($path)) {
                            uploade_image($_FILES, 'users');
                            unlink($path);
                        }
                        $restult = medical_update($models, $data, "`user_id` = $user_id");
                        if ($restult) {
                            $success = '<div class="alert alert-success">User Updated Succefuly</div>';
                            $row = get_one($models, '`user_id` = '.$user_id);
                        } else {
                            $success = '<div class="alert alert-danger">Error : User Not Updated Succfuly</div>';
                        }
                    } 
                }
                ?>
                <?=(! empty($success)) ? $success : ''?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <?php $input = "user_name"; ?>
                        <div class="form-group">
                            <label for="<?=$input?>" class="col-md-2">User Name :</label> <?=getError($input); ?>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                            </div>
                        </div>
                    </div>
                    <br>        
                    <div class="row">
                    <?php $input = "user_email"; ?>
                        <div class="form-group">
                            <label for="<?=$input?>" class="col-md-2">User Email :</label> <?=getError($input); ?>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <?php $input = "user_password"; ?>
                        <div class="form-group">
                            <label for="<?=$input?>" class="col-md-2">User Password :</label> <?=getError($input); ?>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="<?=$input?>" name="<?=$input?>">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <?php $input = "user_phone"; ?>
                        <div class="form-group">
                            <label for="<?=$input?>" class="col-md-2">User Phone :</label> <?=getError($input); ?>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <?php $input = "user_age"; ?>
                        <div class="form-group">
                            <label for="<?=$input?>" class="col-md-2">User Age :</label> <?=getError($input); ?>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <?php $input = "user_gender"; ?>
                        <div class="form-group">
                            <label for="<?=$input?>" class="col-md-2">User Gender :</label> <?=getError($input); ?>
                            <div class="col-md-9">
                                <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                    <option value="male" <?=isset($row[$input]) && ($row[$input] == 'male') ? 'selected' : ''?>>Male</option>
                                    <option value="female" <?=isset($row[$input]) && ($row[$input] == 'female') ? 'selected' : ''?>>Female</option>
                                    </select>
                                </div>            
                            </div>       
                        </div>
                        <br>
                        <br>
                        <div class="row">
                        <?php $input = "user_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">User Is Active:</label> <?=getError($input); ?>
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
                        <?php $input = "user_image"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">User Image:</label> <?=getError($input); ?>
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
                                <?php if (!empty($row['user_image'])): ?>
                                <div class='col-md-9'>
                                    <input type="hidden" name="<?=$input?>" value="<?=$row['user_image']?>">
                                    <img src="<?=WEBSITE_URL.'uploads'.DS.'users'.DS.$row['user_image']?>" width="70%">;
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