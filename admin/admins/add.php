<?php require_once "../../globals.php"; ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'admins/view.php'?>">Admins</a> / <a href="<?=ADMIN_URL.'admins/add.php'?>"> Add Admin</a></h4>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Admin</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <h2>New Admin</h2>
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
                            $errors[$inSput] = 'Must be String';
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
                        // admin_password: required, string, max:255
                        $input = 'admin_password';
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
                        // admin_is_active: belongs To 0, 1
                        $input = "admin_is_active";
                        if (! is_belongs_to($$input, array(0, 1))) {
                            $errors[$input] = 'Invalid Active Data';
                        }
                        $data[$input] = $$input;
                        // admin_type belongs To admin, super_admin
                        $input = "admin_type";
                        if (! is_belongs_to($$input, array('admin', 'super_admin'))) {
                            $errors[$input] = 'Invalid Admin Type Data';
                        }
                        $data[$input] = $$input;
                        // admin_image: Check image extensions and size max:255
                        $input = 'admin_image';
                        if (! empty($_FILES) && !empty($_FILES[$input]['name'])) {
                            image_validation($_FILES,'png,jpg,jpeg',5);
                            $data[$input] = basename($_FILES[$input]['name']);
                        }
                        if (empty($errors)) {
                            $check = get_data('admins', "where `admin_email` = '$admin_email'", 'email', 1);
                            if (empty($check)) {
                                uploade_image($_FILES, 'admins');
                                $restult = insert_into_table('admins', $data);
                                if ($restult) {
                                    $success = '<div class="alert alert-success">Admin Inserted Succfully</div>';
                                } else {
                                    $success = '<div class="alert alert-danger">Admin NOt Inserted Succfully</div>';
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
                            <?php $input = "admin_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Admin Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Admin Name" name="<?=$input?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <?php $input = "admin_email"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Admin Email :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <input type="email" class="form-control" id="<?=$input?>" placeholder="Enter Admin Email" name="<?=$input?>">
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
                                        <option value="super_admin">Super Admin</option>
                                        <option value="admin" selected>Admin</option>
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
                                        <option value="1" selected>Active</option>
                                        <option value="0">Not Active</option>
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
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-info" name="submit">Create Admin</button>
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