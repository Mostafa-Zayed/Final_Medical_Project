<?php require_once "../../globals.php"; ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'users/view.php'?>">Users</a> / <a href="<?=ADMIN_URL.'users/add.php'?>"> Add User</a></h4>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create User</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <h2>New User</h2>
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
                        // user_password: required, string, max:255
                        $input = 'user_password';
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
                        // user_phone: required, string, max:20
                        $input = "user_phone";
                        if (! empty($$input)) {
                            if (! is_string_modified($$input)) {
                                $errors[$input] = 'Phone Must be String';
                            } elseif (! is_not_more_than($$input, MAX_USER_PHONE_LENGTH)) {
                                $errors[$input] = 'Phone Must be less than '.MAX_USER_PHONE_LENGTH;
                            } 
                            $data[$input] = $$input;
                        }
                        // user_age: string, max:2
                        $input = "user_age";
                        if (! empty($$input)) {
                            if (! is_string_modified($$input)) {
                                $errors[$input] = 'Must be String';
                            } elseif (! is_not_more_than($$input, MAX_USER_AGE_LENGTH)) {
                                $errors[$input] = 'Must be less than '.MAX_USER_AGE_LENGTH;
                            } 
                            $data[$input] = $$input;
                        }
                        // user_gender: belongs to Male Or Female
                        $input = "user_gender";
                        if (! is_belongs_to($$input, array('male','female'))) {
                            $errors[$input] = 'Invalid Gender';
                        }
                        $data[$input] = $$input;
                        // user_is_active: belong to 0,1
                        $input = "user_is_active";
                        if (! is_belongs_to($$input, array(0, 1))) {
                            $errors[$input] = 'Invalid Active Data';
                        }
                        $data[$input] = $$input;
                        // user_image: check image type extensions and size
                        $input = 'user_image';
                        if (! empty($_FILES) && !empty($_FILES[$input]['name'])) {
                            image_validation($_FILES,'png,jpg,jpeg',5);
                            $data[$input] = basename($_FILES[$input]['name']);
                        }
                        if (empty($errors)) {
                            $check = get_data('users', "where `user_email` = '$user_email'", 'email', 1);
                            if (empty($check)){
                                uploade_image($_FILES, 'users');
                                $restult = insert_into_table('users', $data);
                                if ($restult) {
                                    $success = '<div class="alert alert-success">User Inserted Succfully</div>';
                                } else {
                                    $success = '<div class="alert alert-danger">User NOt Inserted Succfully</div>';
                                }
                            } else {
                                $success = '<div class="alert alert-danger">Sorry Email Exists!!!</div>';
                            }   
                        }
                    }
                    ?>
                    <?=(! empty($success)) ? $success : ''?>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                        <?php $input = "user_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">User Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter User Name" name="<?=$input?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <?php $input = "user_email"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">User Email :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="<?=$input?>" placeholder="Enter User Email" name="<?=$input?>">
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
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter User Phone" name="<?=$input?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <?php $input = "user_age"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">User Age :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter User Age" name="<?=$input?>">
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
                                        <option value='' selected>Select Gender</option>
                                        <option value="male" >Male</option>
                                        <option value="female">Female</option>
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
                                        <option value="1" selected>Active</option>
                                        <option value="0">Not Active</option>
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
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-info" name="submit">Create User</button>
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