<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'brands/view.php'?>"> Brands </a> / <a href="<?=ADMIN_URL.'brands/add.php'?>"> Add Brand</a></h4>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Brand</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <h2>New Brand</h2>
                    </div>
                    <br>
                    <?php if (isset($_POST['submit'])) {
                        unset($_POST['submit']);
                        //pre($_POST);
                        decomposed_array(clean($_POST));
                        $data = array();
                        // Validation
                        // brand_name: required, string, max:50
                        $input = "brand_name";
                        if (! is_required($$input)) {
                            $errors[$input] = 'required';
                        } elseif (! is_string_modified($$input)) {
                            $errors[$input] = 'Must be String';
                        } elseif (! is_not_more_than($$input, MAX_BRAND_NAME_LENGTH)) {
                            $errors[$input] = 'Must be less than '.MAX_BRAND_NAME_LENGTH;
                        } 
                        $data[$input] = $$input;
                        // brand_description: string, max:255
                        $input = "brand_description";
                        if (! empty($$input)) {
                            if (! is_string_modified($$input)) {
                                $errors[$input] = 'Must be String';
                            } elseif (! is_not_more_than($$input, MAX_BRAND_DESCRIPTION_LENGTH)) {
                                $errors[$input] = 'Must be less than '.MAX_BRAND_DESCRIPTION_LENGTH;
                            }
                            $data[$input] = $$input;
                        }
                        // brand_is_active
                        $input = "brand_is_active";
                        if (! is_belongs_to($$input, array(0, 1))) {
                            $errors[$input] = 'Invalid Active Data';
                        }
                        $data[$input] = $$input;
                        // brand_image
                        $input = 'brand_image';
                        if (! empty($_FILES) && !empty($_FILES[$input]['name'])) {
                            image_validation($_FILES,'png,jpg,jpeg',5);
                            $data[$input] = basename($_FILES[$input]['name']);
                        }
                        if (empty($errors)) {
                            uploade_image($_FILES, 'brands');
                            $restult = insert_into_table('brands', $data);
                            if ($restult) {
                                $success = '<div class="alert alert-success">Brand Inserted Succfully</div>';
                                } else {
                                $success = '<div class="alert alert-danger">Brand NOt Inserted Succfully</div>';
                            }
                        }
                    }
                    ?>
                    <?=(! empty($success)) ? $success : ''?>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <?php $input = "brand_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Brand Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Brand Name" name="<?=$input?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <?php $input = "brand_description"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Brand Description :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="<?=$input?>" name="<?=$input?>"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <?php $input = "brand_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Brand Is Active:</label> <?=getError($input); ?>
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
                            <?php $input = "brand_image"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Brand Image:</label> <?=getError($input); ?>
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