<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'abouts/add.php'?>"> Add About</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create About</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New About</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // state_name: required, string, max:30
                                $input = "about_heading";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_ABOUT_HEADING_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_ABOUT_HEADING_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // state_name: required, string, max:30
                                $input = "about_slug";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_ABOUT_SLUG_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_ABOUT_SLUG_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // state_name: required, string, max:30
                                $input = "about_title";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_ABOUT_TITLE_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_ABOUT_TITLE_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // state_name: required, string, max:30
                                $input = "about_description";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_ABOUT_DESCRIPTION_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_ABOUT_DESCRIPTION_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // state_name: required, string, max:30
                                $input = "about_video_link";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_ABOUT_VIDEO_LINK_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_ABOUT_VIDEO_LINK_LENGTH;
                                } elseif (! is_url($$input)) {
                                    $errors[$input] = 'Must be Link ';
                                }
                                $data[$input] = $$input;
                                // doctor_image
                                $input = 'about_image';
                                if (! empty($_FILES) && !empty($_FILES[$input]['name'])) {
                                    image_validation($_FILES,'png,jpg,jpeg',5);
                                    $data[$input] = basename($_FILES[$input]['name']);
                                }
                                // state_is_active
                                $input = "about_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'About Active Data';
                                }
                                $data[$input] = $$input;
                                pre($errors);
                                pre($data);
                                if (empty($errors)) {
                                    uploade_image($_FILES, 'abouts');
                                    $restult = insert_into_table('abouts', $data);
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">About Inserted Succfully</div>';
                                    } else {
                                        $success = '<div class="alert alert-danger">About NOt Inserted Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <?php $input = "about_heading"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">About Heading :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "about_slug"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">About Slug :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "about_title"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">About Title :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "about_description"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">About Description :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="<?=$input?>" name="<?=$input?>" rows="3"></textarea>
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                                    <?php $input = "about_video_link"; ?>
                                    <div class="form-group">
                                        <label for="<?=$input?>" class="col-md-2">About Video Link:</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <input type="url" name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                
                            <div class="row">
                            <?php $input = "about_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">About Is Active:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0" selected>Not Active</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <br>
                            <div class="row">
                            <?php $input = "about_image"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">About Image:</label> <?=getError($input); ?>
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
<?php require_once ADMIN_INCLUDES."footer.php"; ?>