<?php require_once "../../globals.php"; ?>
<?php require_once INCLUDES."header_dashboard.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard<a> / <a href="<?=ADMIN_URL.'sliders/add.php'?>"> Add Slider</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Slider</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Slider</h2>
                            </div>
                            <br>
                            
                            <?php if (isset($_POST['submit'])) {
                                decomposed_array($_POST);
                                $data = array();
                                // Validation
                                // state_name: required, string, max:30
                                $input = "slider_heading";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                } elseif (! is_not_more_than($$input, MAXSLIDERHEADINGLENGTH)) {
                                    $errors[$input] = 'Must be less than '.MAXSLIDERHEADINGLENGTH;
                                } 
                                $data[$input] = $$input;
                                // slider_description: required, string, max:30
                                $input = "slider_description";
                                if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                                } elseif (! is_string_modified($$input)) {
                                    $errors[$input] = 'Must be String';
                                }
                                $data[$input] = $$input;
                                // slider_image: required, string, max:30
                               // $input = "slider_image";
                                /////if (! is_required($$input)) {
                                    $errors[$input] = 'required';
                               // } elseif (! is_string_modified($$input)) {
                                  
                                //$data[$input] = $$input;
                                // slider_is_active
                                $input = "slider_is_active";
                                if (! is_belongs_to($$input, array(0, 1))) {
                                    $errors[$input] = 'Invalid Active Data';
                                }
                                $data[$input] = $$input;
                                var_dump($data);
                                echo '<br>';
                                var_dump($_FILES['slider_image']);
                               /*
                                if (empty($errors)) {
                                    $data = array(
                                        'state_name' => $state_name,
                                        'state_is_active' => $state_is_active,
                                        'country_id' => $country_id
                                    );
                                    $restult = insert_into_table('states', $data);
                                    if ($restult) {
                                        echo 'Data inserted Succ';
                                    } else {
                                        echo 'Error';
                                    }
                                }*/
                            }
                            ?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <?php $input = "slider_heading"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Slider Heading :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter State Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                           <br>
                           <div class="row">
                            <?php $input = "slider_description"; ?>
                            <div class="form-group">
                                <label class="col-md-2" for="<?=$input?>">Slider Description :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <textarea class="form-control" rows="3" id="<?=$input?>" name="<?=$input?>"></textarea>
                                </div>
                            </div>
                           </div>
                            <br>
                            <div class='row'>
                            <?php $input = "slider_image"; ?>
                            <div class="form-group">
                            <label class="col-md-2" for="<?=$input?>">Slider Image :</label>
                            <div class="col-md-9">
                            <input type="file" name="<?=$input?>" id="<?=$input?>">
                            </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "slider_is_active"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">State Is Active:</label> <?=getError($input); ?>
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
<?php require_once INCLUDES."footer_dashboard.php"; ?>