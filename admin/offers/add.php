<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index">Dashboard</a> / <a href="<?=ADMIN_URL.'offers/view'?>"> Offers </a> / <a href="<?=ADMIN_URL.'offers/add'?>"> Add Offer</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Offer</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Offer</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // offer_name: required, string, max:30
                                $input = "offer_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_OFFER_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_OFFER_NAME_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // offer_description: required, string, max:30
                                $input = "offer_description";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_OFFER_DESCRIPTION_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_OFFER_DESCRIPTION_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // offer_start_date: required, string, max:30
                                $input = "offer_start_date";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_OFFER_START_DATE_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_OFFER_START_DATE_LENGTH;
                                }
                                $data[$input] = $$input;
                                // offer_end_date: required, string, max:30
                                $input = "offer_end_date";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_OFFER_END_DATE_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_OFFER_END_DATE_LENGTH;
                                }
                                $data[$input] = $$input;
                                // offer_descound
                                $input = 'offer_descound';
                                if (! empty($$input)) {
                                    $$input = (int) $$input;
                                    if (! is_integer_modified($$input)) {
                                        $errors[$input] = 'Must be Integer ';
                                    } elseif(! is_belongs_to($$input, range(0,100))) {
                                        $errors[$input] = 'Invalid Discound';
                                    }
                                    $data[$input] = $$input;
                                }
                                // offer_is_active
                                $input = "offer_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                // offer_image
                                $input = 'offer_image';
                                if (! empty($_FILES) && !empty($_FILES[$input]['name'])) {
                                    image_validation($_FILES,'png,jpg,jpeg',5);
                                    $image_name = basename($_FILES[$input]['name']);
                                    if (! is_not_more_than($image_name, MAX_OFFER_IMAGE_LENGTH)) {
                                        $errors[$input] = 'Must be less than '.MAX_OFFER_IMAGE_LENGTH;
                                    }
                                    $data[$input] = $image_name;
                                }
                                
                                if (empty($errors)) {
                                    uploade_image($_FILES, 'offers');
                                    $restult = insert_into_table('offers', $data);
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">Offer Inserted Succfully</div>';
                                    } else {
                                        $success = '<div class="alert alert-danger">Offer NOt Inserted Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <?php $input = "offer_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Offer Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Offer Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "offer_description"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Offer Description :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <textarea rows="4" name="<?=$input?>" class="form-control"></textarea>
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "offer_start_date"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Offer Start Date :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" name="<?=$input?>" class="form-control" placeholder=" Enter Start Date">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "offer_end_date"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Offer End Date :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" name="<?=$input?>" class="form-control" placeholder=" Enter End Date">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "offer_descound"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Offer Descound :</label> <?=getError($input); ?>
                                <div class="col-md-8">
                                    <input type="number" name="<?=$input?>" class="form-control" placeholder=" Enter Descount" min="0">
                                </div>
                                &nbsp; <i class="fa fa-percent" aria-hidden="true"></i>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                        <?php $input = "offer_image"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Offer Image:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="file" name="<?=$input?>" id="<?=$input?>">
                                </div>            
                            </div>       
                        </div>
                        <br>
                            <div class="row">
                            <?php $input = "offer_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Offer Is Active:</label> <?=getError($input); ?>
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