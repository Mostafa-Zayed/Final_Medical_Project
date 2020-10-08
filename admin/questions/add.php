<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'questions/view.php'?>"> Questions </a> / <a href="<?=ADMIN_URL.'questions/add'?>"> Add Question </a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Question</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Question</h2>
                            </div>
                            <br>
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // question_content: required, string, max:255
                                $input = 'question_content';
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAX_QUESTION_CONTENT_LENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAX_QUESTION_CONTENT_LENGTH.' Characters';
                                } 
                                $data[$input] = $$input;
                                $input = 'question_is_active';
                                if (! is_belongs_to($$input, array(0,1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                if (empty($errors)) {
                                    $restult = insert_into_table('questions', $data);
                                    if ($restult) {
                                        $success = '<div class="alert alert-success">Question Inserted Succfully</div>';
                                } else {
                                    $success = '<div class="alert alert-danger">Question NOt Inserted Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <?php $input = 'question_content'; ?>
                            <div class="row">
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2"> Question Content :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" name ="<?=$input?>" placeholder="Enter Question Content">
                                </div>
                            </div>
                            </div>
                            <br>
                            <?php $input = 'question_is_active'; ?>
                            <div class="row">
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Question Is Active:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0" selected>Not Active</option>
                                    </select>
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