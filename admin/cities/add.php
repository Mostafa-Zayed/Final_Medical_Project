<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard</a> / <a href="<?=ADMIN_URL.'cities/view.php'?>"> Citites </a> / <a href="<?=ADMIN_URL.'cities/add.php'?>"> Add City</a></h4>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create City</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <h2>New City</h2>
                    </div>
                    <br>
                    <?php if (isset($_POST['submit'])) {
                            unset($_POST['submit']);
                            decomposed_array(clean($_POST));
                            $data = array();
                            // Validation
                            // city_name    
                            $input = "city_name";
                            if (! is_required($$input)) {
                                $errors[$input] = 'required';
                            } elseif (! is_string_modified($$input)) {
                                $errors[$input] = 'Must be String';
                            } elseif (! is_not_more_than($$input, MAX_CITY_NAME_LENGTH)) {
                                $errors[$input] = 'Must be less than '.MAX_CITY_NAME_LENGTH;
                            } 
                            $data[$input] = $$input;
                            // city_is_active
                            $input = "city_is_active";
                            if (! is_belongs_to($$input, array(0, 1))) {
                                $errors[$input] = 'Invalid Active Data';
                            }
                            $data[$input] = $$input;
                            // state_id
                            $input = "state_id";
                            $$input = (int) $$input;
                            $check_id = get_data_by_id('states', $$input, 'id');
                            if (empty($check_id)) {
                                $errors[$input] = 'Invalide State Data';
                            }
                            $data[$input] = $$input;   
                            if (empty($errors)) {  
                                $restult = insert_into_table('cities', $data);
                                if ($restult) {
                                    $success = '<div class="alert alert-success">City Inserted Succfully</div>';
                                    } else {
                                        $success = '<div class="alert alert-danger">City NOt Inserted Succfully</div>';
                                    }
                                }
                            }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="row">
                            <?php $input = "city_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">City Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" name="<?=$input?>" class="form-control" id="<?=$input?>" placeholder="Enter City Name">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "city_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">City Is Active:</label> <?=getError($input); ?>
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
                            <?php $input = "state_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">State Name:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <?php $rows = get_data('states','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option value ='' selected>Select State</option>
                                        <?php foreach ($rows as $row): ?>
                                        <option value="<?=$row['state_id']?>"><?=$row['state_name']?></option>
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
                                    <button type="submit" class="btn btn-info" name="submit">Create City</button>
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