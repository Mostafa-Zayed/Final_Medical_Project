<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'services/view.php'?>"> Services </a> / <a href="<?=ADMIN_URL.'services/add.php'?>"> Add Services</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Service</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Service</h2>
                            </div>
                            <br> 
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // state_name: required, string, max:30
                                $input = "service_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_SERVICE_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_SERVICE_NAME_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // service_type_name
                                $input = "service_type_id";
                                $$input = (int) $$input;
                                $check_id = get_data_by_id('service_types', $$input, 'id');
                                if (empty($check_id)) {
                                    $errors[$input] = 'Invalide Service Type Data';
                                }
                                $data[$input]=  $$input;
                                // service_has_doctor
                                $input = "service_has_doctor";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Service Has Doctor Data';
                                }
                                $data[$input] = $$input;
                                // service_is_active
                                $input = "service_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                // service_type_name
                                $input = "service_type_id";
                                $$input = (int) $$input;
                                $check_id = get_data_by_id('service_types', $$input, 'id');
                                if (empty($check_id)) {
                                    $errors[$input] = 'Invalide Service Type Data';
                                }
                                $data[$input] = $$input;
                                // service_video_link
                                $input = 'service_video_link';
                                if (! empty($$input)) {
                                    if (! is_string_modified($$input)) {
                                        $errors[$input] = 'Must be String';
                                    } elseif (! is_not_more_than($$input, MAX_SERVICE_VIDEO_LINK_LENGTH)) {
                                        $errors[$input] = 'Must be less than '.MAX_SERVICE_VIDEO_LINK_LENGTH;
                                    }  elseif (! is_url($$input)) {
                                        $errors[$input] = 'Must be Link ';
                                    }
                                    $data[$input] = $$input;
                                }
                                // service_image
                                $input = 'service_image';
                                if (! empty($_FILES) && !empty($_FILES[$input]['name'])) {
                                    image_validation($_FILES,'png,jpg,jpeg',5);
                                    $data[$input] = basename($_FILES[$input]['name']);
                                }
                                if (empty($errors)) {
                                    uploade_image($_FILES, 'services');
                                    $restult = insert_into_table('services', $data);
                                    if ($restult) {
                                        unset($data);
                                        $success = '<div class="alert alert-success">Service inserted Succefuly</div>';
                                    } else {
                                        $success = '<div class="alert alert-danger">Service Not Inserted Succefuly</div>';
                                    }
                                }
                            }

                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <?php $input = "service_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Service Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Service Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "service_type_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Service Type :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <?php $rows = get_data('service_types','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option selected>Select Type</option>
                                        <?php foreach ($rows as $row): ?>
                                        <option value="<?=$row['service_type_id']?>"><?=$row['service_type_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "service_is_active"; ?>
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
                            <br>
                            <div class="row">
                            <?php $input = "service_has_doctor"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Service Has Doctor:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1" selected>Has A Doctor</option>
                                        <option value="0">Has Not A Doctor</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                                <div class="row">
                                    <?php $input = "service_image"; ?>
                                    <div class="form-group">
                                        <label for="<?=$input?>" class="col-md-2">Service Image:</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <input type="file" name="<?=$input?>" id="<?=$input?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <?php $input = "service_video_link"; ?>
                                    <div class="form-group">
                                        <label for="<?=$input?>" class="col-md-2">Service Video Link:</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <input type="url" name="<?=$input?>" id="<?=$input?>" class="form-control">
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