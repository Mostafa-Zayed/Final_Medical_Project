<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<?php
$input = 'admin_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $admin_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $admin_id");
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
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'admins/view.php'?>">Admins</a> / <a href="<?=ADMIN_URL.$models.'/edit.php?'.$input.'= '.$$input?>"> Update Admin</a></h4>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Admin</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <h2>Edit Admin</h2>
                    </div>
                    <br>
                    <?php if (isset($_POST['submit'])) {
                        unset($_POST['submit']);
                        decomposed_array(clean($_POST));
                        $data = array();
                        // Validation
                        // admin_name: required, string, max:50
                        $input = "admin_name";
                        if (! is_required($$input)) {
                            $errors[$input] = 'required';
                        } elseif (! is_string_modified($$input)) {
                            $errors[$input] = 'Must be String';
                        } elseif (! is_not_more_than($$input, MAX_ADMIN_NAME_LENGTH)) {
                            $errors[$input] = 'Must be less than '.MAX_ADMIN_NAME_LENGTH;
                        } 
                        $data[$input] = $$input;
                        // admin_email: required, string, max:100
                        $input = "admin_email";
                        if (! is_required($$input)) {
                            $errors[$input] = 'required';
                        } elseif (! is_email($$input)) {
                            $errors[$input] = 'Invalid Email';
                        } elseif (! is_not_more_than($$input, MAX_ADMIN_EMAIL_LENGTH)) {
                            $errors[$input] = 'Email Must be Less Than '.MAX_ADMIN_EMAIL_LENGTH;
                        }
                        $data[$input] = $$input;
                        // admin_password: required, string, max:255, min:8
                        $input = 'admin_password';
                        if (! empty($$input)) {
                            if (! is_required($$input)) {
                                $errors[$input] = 'required';
                            } elseif (! is_string_modified($$input)) {
                                $errors[$input] = 'Password Must be String';
                            } elseif (! is_not_more_than($$input, MAX_ADMIN_PASSWORD_LENGTH)) {
                                $errors[$input] = 'Password Must be Less Than '.MAX_ADMIN_PASSWORD_LENGTH;
                            } elseif (! is_not_less_than($$input, MIN_ADMIN_PASSWORD_LENGTH)) {
                                $errors[$input] = 'Password Must be More Than '.MIN_ADMIN_PASSWORD_LENGTH;
                            }
                            $data[$input] = password_hash($$input, PASSWORD_DEFAULT);
                        }
                        // admin_type: belongs To admin, super_admin
                        $input = "admin_type";
                        if (! is_belongs_to($$input, array('admin', 'super_admin'))) {
                            $errors[$input] = 'Invalid Type Data';
                        }
                        $data[$input] = $$input;
                        // admin_is_active
                        $input = "admin_is_active";
                        if (! is_belongs_to($$input, array(0, 1))) {
                            $errors[$input] = 'Invalid Active Data';
                        }
                        $data[$input] = $$input;
                        // admin_image
                        $input = 'admin_image';
                        if (! empty($_FILES) && ! empty($_FILES[$input]['name'])) {
                            image_validation($_FILES,'png,jpg,jpeg',5);
                            $data[$input] = basename($_FILES[$input]['name']);
                            if (isset($old_image)) {
                                $path = UPLOADS.'admins'.DS.$old_image;
                            }
                        }
                        if (empty($errors)) {
                            if (isset($path) && !empty($path)) {
                                uploade_image($_FILES, 'admins');
                                unlink($path);
                            }        
                            uploade_image($_FILES, 'admins');
                            $restult = medical_update($models, $data, "`admin_id` = $admin_id");
                            if ($restult) {
                                $success = '<div class="alert alert-success">Admin Updated Succefuly</div>';
                                $row = get_one($models, '`admin_id` = '.$admin_id);
                            } else {
                                $success = '<div class="alert alert-danger">Error : Admin Not Updated Succfuly</div>';
                            }
                        }       
                    }
                    ?>
                    <?=(! empty($success)) ? $success : ''?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                        <?php $input = "admin_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Admin Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <?php $input = "admin_email"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Admin Email :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <?php $input = "admin_password"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Admin Password :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="<?=$input?>" name="<?=$input?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <?php $input = "admin_type"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Admin Type :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="super_admin" <?=isset($row[$input]) && ($row[$input] == 'super_admin') ? 'selected' : ''?>>Super Admin</option>
                                        <option value="admin" <?=isset($row[$input]) && ($row[$input] == 'admin') ? 'selected' : ''?>>Admin</option>
                                    </select>
                                </div>            
                            </div>       
                        </div>
                        <br>
                        <div class="row">
                        <?php $input = "admin_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Admin Is Active:</label> <?=getError($input); ?>
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
                        <?php $input = "admin_image"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Admin Image:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="file" name="<?=$input?>" id="<?=$input?>">
                                </div>            
                            </div>       
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <?php $input = 'old_image'; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">ADmin Image:</label>
                                <?php if (!empty($row['admin_image'])): ?>
                                <div class='col-md-9'>
                                    <input type="hidden" name="<?=$input?>" value="<?=$row['admin_image']?>">
                                    <img src="<?=WEBSITE_URL.'uploads'.DS.'admins'.DS.$row['admin_image']?>" width="70%">;
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