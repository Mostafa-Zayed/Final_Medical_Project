<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index">Dashboard</a> / <a href="<?=ADMIN_URL.'feedbacks/view'?>"> Feedbacks </a> / <a href="<?=ADMIN_URL.'feedbacks/add'?>"> Add Feedbacks </a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Feedback</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Feedback</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // feedback_name: required, string, max:50
                                $input = "feedback_name";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_FEEDBACK_NAME_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_FEEDBACK_NAME_LENGTH;
                                }
                                $data[$input] = $$input;
                                // feedback_content: required, string, max:30
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
                                $$input = (int) $$input;
                                if (! is_required($$input)) {
                                    $errors[$input] = "required";
                                } elseif (! is_integer_modified($$input)) {
                                    $errors[$input] = 'Must be Integer';
                                } elseif (! is_belongs_to($$input, range(1, 5))) {
                                    $errors[$input] = 'Must be Value Between 1 To 5 ';
                                }
                                $data[$input] = $$input;

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
                                if (empty($errors)) {
                                    $restult = insert_into_table('feedbacks', $data);
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">Feedback Inserted Succfully</div>';
                                    } else {
                                        $success = '<div class="alert alert-danger">Feedback NOt Inserted Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <?php $input = "feedback_name"; ?>
                                    <div class="form-group">
                                        <label for="<?=$input?>" class="col-md-2">Feedback Name :</label> <?=getError($input); ?>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Feeedback Name" name="<?=$input?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <div class="row">
                            <?php $input = "feedback_content"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Feedback Content :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="<?=$input?>" rows="3"></textarea>
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "feedback_rate"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Feedback Rate :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <input type="number" class="form-control" max="5" min="1" id="<?=$input?>" placeholder="Enter Feeedback Rate" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                                <!--
                            <br>
                            <div class="row">
                            <?php $input = "feedback_rate_count"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Feedback Rate Count :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <input type="number" class="form-control" min="0" id="<?=$input?>" placeholder="Enter Feeedback Rate" name="<?=$input?>">
                                </div>
                            </div>
                            </div>-->
                            <br><!--
                            <div class="row">
                            <?php $input = "feedback_video_link"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Feedback Video Link :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <input type="link" class="form-control" min="0" id="<?=$input?>" placeholder="Enter Feeedback Rate" name="<?=$input?>">
                                </div>
                            </div>
                            </div>-->
                                <!--<br>
                            <div class="row">
                            <?php $input = "feedback_image"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Feedback Image:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="file" name="<?=$input?>" id="<?=$input?>">
                                </div>            
                            </div>       
                            </div>
                            <br>-->
                            <div class="row">
                            <?php $input = "feedback_is_show"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Feedback Is Show:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1">Visibale</option>
                                        <option value="0" selected>Hidden</option>
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
                                <?php $rows = get_data('services','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value='' selected>Select Service</option>
                                        <?php foreach ($rows as $row): ?>
                                        <option value="<?=$row['service_id']?>"><?=$row['service_name']?></option>
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
                                <?php $rows = get_data('doctors','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value='' selected>Select Doctor</option>
                                        <?php foreach ($rows as $row): ?>
                                        <option value="<?=$row['doctor_id']?>"><?=$row['doctor_name']?></option>
                                        <?php endforeach; ?>
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