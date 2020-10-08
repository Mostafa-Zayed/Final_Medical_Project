<?php require_once "../../globals.php"; ?>
<?php is_not_admin();?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'answers/view.php'?>"> Answers </a> / <a href="<?=ADMIN_URL.'answers/add'?>"> Add Answer </a></h4>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Answer </h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <h2> New Answer </h2>
                    </div>
                    <br>
                    <?php if (isset($_POST['submit'])) {
                        unset($_POST['submit']);
                        decomposed_array(clean($_POST));
                        $data = array();
                        // Validation
                        // answer_content: required, string, max:500
                        $input = "answer_content";
                        if (! is_required($$input)) {
                            $errors[$input] = 'required';
                        } elseif (! is_string_modified($$input)) {
                            $errors[$inSput] = 'Must be String';
                        } elseif (! is_not_more_than($$input, MAX_ANSWER_CONTENT_LENGTH)) {
                            $errors[$input] = 'Must be less than '.MAX_ANSWER_CONTNT_LENGTH;
                        } 
                        $data[$input] = $$input;
                        // question_id 
                        $input = "question_id";
                        $$input = (int) $$input;
                        $check_id = get_data_by_id('questions', $$input, 'id');
                        if (empty($check_id)) {
                            $errors[$input] = 'Invalid Question Data';
                        }
                        $data[$input] = $$input;
                        // answer_is_active
                        $input = "answer_is_active";
                        if (! is_belongs_to($$input, array(0, 1))) {
                            $errors[$input] = 'Invalid Active Data';
                        }
                        $data[$input] = $$input;
                        if (empty($errors)) {
                            $restult = insert_into_table('answers', $data);
                            if ($restult) {
                                $success = '<div class="alert alert-success">Answer Inserted Succfully</div>';
                            } else {
                                $success = '<div class="alert alert-danger">Answer NOt Inserted Succfully</div>';
                            }
                        }
                    }
                    ?>
                    <?=(! empty($success)) ? $success : ''?>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                        <div class="row">
                            <?php $input = "answer_content"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Answer Content :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="<?=$input?>" name="<?=$input?>"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <?php $input = "question_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Question Content :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <?php $rows = get_data('questions','','id,content'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option selected>Select Question</option>
                                        <?php foreach ($rows as $row): ?>
                                        <option value="<?=$row['question_id']?>"><?=$row['question_content']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>            
                            </div>       
                            </div>
                        <br>
                        <div class="row">
                        <?php $input = "answer_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Answer Is Active:</label> <?=getError($input); ?>
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
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-info" name="submit">Create Answer</button>
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