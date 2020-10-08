<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php
$input = 'feedback_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $feedback_id =  (int) $_GET[$input];    
    $row = get_one($models, "`$input` = $feedback_id");
    //pre($row);
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
            <h4><a href="<?=ADMIN_URL?>index">Dashboard</a> / <a href="<?=ADMIN_URL.$models.'/view'?>"> Feedbacks </a> / <a href="<?=ADMIN_URL.$models.'/add'?>"> Add Feedbacks </a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Feedback</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>Edit Feedback</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // state_name: required, string, max:
                                $input = "feedback_content";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_FEEDBACK_CONTENT_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_FEEDBACK_CONTENT_LENGTH;
                                } 
                                $data[$input] = $$input;
                                // feedback_rate: int, range(0,5)
                                $input = 'feedback_rate';
                                if (! empty($$input)) {
                                    $$input = (int) $$input;
                                    if (! is_integer_modified($$input)) {
                                        $errors[$input] = 'Must be Integer';
                                    } elseif (! is_belongs_to($$input, range(0, 5))) {
                                        $errors[$input] = 'Must be Value Between 0 To 5 ';
                                    }
                                    $data[$input] = $$input;
                                }
                                // feedback_rate_count
                                $input = 'feedback_rate_count';
                                if (! empty($$input)) {
                                    $$input = (int) $$input;
                                    if (! is_integer_modified($$input)) {
                                        $errors[$input] = 'Must be Integer';
                                    }
                                    $data[$input] = $$input;
                                }
                                // feedback_video_link
                                $input = 'feedback_video_link';
                                if (! empty($$input)) {
                                    if (! is_string_modified($$input)) {
                                        $errors[$input] = 'Must be String';
                                    } elseif (! is_url($$input)){
                                        $errors[$input] = 'Invalid URl';
                                    } elseif(! is_not_more_than($$input, MAX_FEEDBACK_VIDEO_LINK_LENGTH)) {
                                        $errors[$input] = 'Must be less than '.MAX_FEEDBACK_VIDEO_LINK_LENGTH;
                                    }
                                    $data[$input] = $$input;
                                }
                                // feedback_is_show
                                $input = "feedback_is_show";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Show Data';
                                }
                                $data[$input] = $$input;
                                // service_name 
                                $input = "service_id";
                                if (! empty($$input)) {
                                    $$input = (int) $$input;
                                    $check_id = get_data_by_id('services', $$input, 'id');
                                    if (empty($check_id)) {
                                        $errors[$input] = 'Invalide Service Name';
                                    }
                                    $data[$input] = $$input;
                                }
                                // doctor_name 
                                $input = "doctor_id";
                                if (! empty($$input)) {
                                    $$input = (int) $$input;
                                    $check_id = get_data_by_id('doctors', $$input, 'id');
                                    if (empty($check_id)) {
                                        $errors[$input] = 'Invalide Doctor Name';
                                    }
                                    $data[$input] = $$input;
                                }
                                // feedback_image
                                $input = 'feedback_image';
                                if (! empty($_FILES) && ! empty($_FILES[$input]['name'])) {
                                    image_validation($_FILES,'png,jpg,jpeg',5);
                                    $image_name = basename($_FILES[$input]['name']);
                                    if (! is_not_more_than($image_name, MAX_FEEDBACK_IMAGE_LENGTH)) {
                                        $errors[$input] = 'Must be less than '.MAX_FEEDBACK_IMAGE_LENGTH;
                                    }
                                    $data[$input] = $image_name;
                                    if (isset($old_image)){
                                        $path = UPLOADS.'feedbacks'.DS.$old_image;
                                    }
                                }
                                if (empty($errors)) {   
                                    if (isset($path) && !empty($path)) {
                                        uploade_image($_FILES, 'feedbacks');
                                        unlink($path);
                                    }
                                    uploade_image($_FILES, 'feedbacks');
                                    $restult = medical_update($models, $data, "`feedback_id` = $feedback_id");
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">Feedback Inserted Succfully</div>';
                                        $row = get_one($models, '`feedback_id` = '.$feedback_id);
                                    } else {
                                        $success = '<div class="alert alert-danger">Feedback NOt Inserted Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                <?php $input = "feedback_content"; ?>
                                    <div class="form-group">
                                        <label for="<?=$input?>" class="col-md-2">Feedback Content :</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="<?=$input?>" rows="3"><?=$row[$input]?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                <?php $input = "feedback_rate"; ?>
                                    <div class="form-group">
                                        <label for="<?=$input?>" class="col-md-2">Feedback Rate :</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" max="5" min="0" id="<?=$input?>" value="<?=$row[$input]?>" name="<?=$input?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                <?php $input = "feedback_rate_count"; ?>
                                    <div class="form-group">
                                        <label for="<?=$input?>" class="col-md-2">Feedback Rate Count :</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" min="0" id="<?=$input?>" value = "<?=$row[$input]?>" name="<?=$input?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <div class="row">
                            <?php $input = "feedback_video_link"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Feedback Video Link :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <input type="link" class="form-control" min="0" id="<?=$input?>" value ="<?=$row[$input]?>" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            
                            <div class="row">
                            <?php $input = "feedback_is_show"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Feedback Is Show:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1" <?=isset($row[$input]) && $row[$input] == 1 ? 'selected' : ''?>> Visibale</option>
                                        <option value="0" <?=isset($row[$input]) && $row[$input] == 0 ? 'selected' : ''?>>Hidden</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <br>
                            <div class="row">
                            <?php $input = "service_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Service Name:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <?php $services = get_data('services','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <?php foreach ($services as $service): ?>
                                        <option value="<?=$service['service_id']?>" <?=isset($row['service_id']) && $service['service_id'] == $row['service_id'] ? 'selected' : '' ?>><?=ucfirst($service['service_name'])?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "doctor_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Doctor Name:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <?php $doctors = get_data('doctors','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <?php foreach ($doctors as $doctor): ?>
                                        <option value="<?=$doctor[$input]?>" <?=isset($row[$input]) && $doctor[$input] == $row[$input] ? 'selected' : '' ?>><?=$doctor['doctor_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "feedback_image"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Feedback Image:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="file" name="<?=$input?>" id="<?=$input?>">
                                </div>            
                            </div>       
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = 'old_image'; ?>
                            
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Old Image :</label>
                                <?php if (! empty($row['feedback_image'])): ?>
                                <div class='col-md-9'>
                                    <input type="hidden" name="<?=$input?>" value="<?=$row['feedback_image']?>">
                                    <img src="<?=WEBSITE_URL.'uploads'.DS.'feedbacks'.DS.$row['feedback_image']?>" width="70%">;
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