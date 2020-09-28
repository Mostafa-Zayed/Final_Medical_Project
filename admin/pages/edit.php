<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<?php
$input = 'page_id';
$models = get_models($input);
if (isset($_GET[$input]) && ! empty($_GET[$input]) && is_numeric($_GET[$input])) {
    $page_id = $_GET[$input];
    $page_id = (int) $page_id;
    $row = get_one($models, "`$input` = $page_id");
    if (empty($row)) {
        abort();
    }
} else {
    redirect('admin/'.$models.'/view.php');
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.$models.'/view.php'?>"> Pages </a> / <a href="<?=ADMIN_URL.$models.'/edit.php?page_id='.$page_id?>"> Update Page</a></h4>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Update Page</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <h2>Update Page</h2>
                    </div>
                    <br>
                    <?php if (isset($_POST['submit'])) {
                        unset($_POST['submit']);
                        decomposed_array(clean($_POST));
                        $data = array();
                        // Validation
                        // page_name: required, string, max:30
                        $input = "page_name";
                        if (! is_required($$input)) {
                            $errors[$input] = 'required';
                        } elseif (! is_string_modified($$input)) {
                            $errors[$input] = 'Must be String';
                        } elseif (! is_not_more_than($$input, MAX_PAGE_NAME_LENGTH)) {
                            $errors[$input] = 'Must be less than '.MAX_PAGE_NAME_LENGTH.' Characters';
                        } 
                        $data[$input] = $$input;
                        // page_link: required, string, max:30
                        $input = "page_link";
                        if (! is_required($$input)) {
                            $errors[$input] = 'required';
                        } elseif (! is_string_modified($$input)) {
                            $errors[$input] = 'Must be String';
                        } elseif (! is_not_more_than($$input, MAX_PAGE_LINK_LENGTH)) {
                            $errors[$input] = 'Must be less than '.MAX_PAGE_LINK_LENGTH.' Characters';
                        } 
                        $data[$input] = $$input;
                        // state_is_active
                        $input = "page_is_active";
                        if (! is_belongs_to($$input, array(0, 1))) {
                            $errors[$input] = 'Invalid Active Data';
                        }
                        $data[$input] = $$input;        
                        if (empty($errors)) {
                            $restult = medical_update('pages', $data, "`page_id` = $page_id");
                            if ($restult) {
                                $success = '<div class="alert alert-success">Page Updated Succefuly</div>';
                                $row = get_one('pages', '`page_id` = '.$page_id);
                            } else {
                                $success = '<div class="alert alert-danger">Error : Page Not Updated Succfuly</div>';
                            }
                        }   
                    }
                    ?>
                        <?=(! empty($success)) ? $success : ''?>
                        <form action="" method="post">
                            <div class="row">
                                <?php $input = "page_name"; ?>
                                <div class="form-group">
                                    <label for="<?=$input?>" class="col-md-2">Page Name :</label> <?=getError($input); ?>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Page Name" name="<?=$input?>" value="<?=(isset($row[$input])? $row[$input] : '')?>">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "page_link"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Page Link :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Page link" name="<?=$input?>" value="<?=(isset($row[$input])? $row[$input] : '')?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "page_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Page Is Active:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value="1" <?=isset($row[$input]) && $row[$input] == '1' ? 'selected' : ''?>>Active</option>
                                        <option value="0" <?=isset($row[$input]) && $row[$input] == '0' ? 'selected' : ''?>>Not Active</option>
                                    </select>
                                </div>            
                            </div>       
                            </div>      
                            </div>
                            <br>
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