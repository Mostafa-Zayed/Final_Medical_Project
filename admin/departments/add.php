<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'departments/view.php'?>"> Departments </a> / <a href="<?=ADMIN_URL.'departments/add.php'?>"> Add Department</a></h4>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Department</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <h2>New Department</h2>
                    </div>
                    <br>
                    <?php if (isset($_POST['submit'])) {
                        unset($_POST['submit']);
                        decomposed_array(clean($_POST));
                        $data = array();
                        // Validation
                        // department_name: required, string, max:50
                        $input = "department_name";
                        if (! is_required($$input)) {
                            $errors[$input] = 'required';
                        } elseif (! is_string_modified($$input)) {
                            $errors[$input] = 'Must be String';
                        } elseif (! is_not_more_than($$input, MAX_DEPARTMENT_NAME_LENGTH)) {
                            $errors[$input] = 'Must be less than '.MAX_DEPARTMENT_NAME_LENGTH;
                        } 
                        $data[$input] = $$input;
                        // department_description: required, string, max:500
                        $input = "department_description";
                        if (! is_required($$input)) {
                            $errors[$input] = 'required';
                        } elseif (! is_string_modified($$input)) {
                            $errors[$input] = 'Must be String';
                        } elseif (! is_not_more_than($$input, MAX_DEPARTMENT_DESCRIPTION_LENGTH)) {
                            $errors[$input] = 'Must be less than '.Max_DEPARTMENT_DESCRIPTION_LENGTH;
                        }
                        $data[$input] = $$input;
                        // department_is_active
                        $input = "department_is_active";
                        if (! is_belongs_to($$input, array(0, 1))) {
                            $errors[$input] = 'Invalid Active Data';
                        }
                        $data[$input] = $$input;
                        // department_image
                        $input = 'department_image';
                        if (! empty($_FILES) && ! empty($_FILES[$input]['name'])) {
                            image_validation($_FILES,'png,jpg,jpeg',5);
                            $data[$input] = basename($_FILES[$input]['name']);
                        }
                        if (empty($errors)) {
                            uploade_image($_FILES, 'departments');
                            $restult = insert_into_table('departments', $data);
                            if ($restult) {
                                $success = '<div class="alert alert-success">Department Inserted Succfully</div>';
                                } else {
                                    $success = '<div class="alert alert-danger">Department NOt Inserted Succfully</div>';
                            }
                        }
                    }
                    ?>
                    <?=(! empty($success)) ? $success : ''?>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <?php $input = "department_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Department Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Department Name" name="<?=$input?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <?php $input = "department_description"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Department Description :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="<?=$input?>" name="<?=$input?>"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <?php $input = "department_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Department Is Active:</label> <?=getError($input); ?>
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
                            <?php $input = "department_image"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Department Image:</label> <?=getError($input); ?>
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
<?php require_once ADMIN_INCLUDES."footer.php"; ?>