<?php require_once "../../globals.php"; ?>
<?php is_not_admin(); ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index">Dashboard<a> / <a href="<?=ADMIN_URL.'appointments/view'?>"> Appointements </a> / <a href="<?=ADMIN_URL.'appointments/add'?>"> Add Appointment</a></h4>
            <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Create Appointment</h3>
                    </div>
                    <div class="panel-body">
                            <div class="row text-center">
                                <h2>New Appointment</h2>
                            </div>
                            <br>
                            
                            <?php if (isset($_POST['submit'])) {
                                unset($_POST['submit']);
                                decomposed_array(clean($_POST));
                                $data = array();
                                // Validation
                                // appointment_name: required, string, max:50
				                $input = 'appointment_name';
				                if (! is_required($$input)) {
					                $errors[$input] = 'required';
				                } elseif (! is_string_modified($$input)) {
					                $errors[$input] = 'Must be String';
				                } elseif (! is_not_more_than($$input, MAX_APPOINTMENT_NAME_LENGTH)) {
					                $errors[$input] = 'Must be less than '.MAX_APPOINTMENT_NAME_LENGTH.' Characters';
				                }
                                $data[$input] = $$input;
                                // appointment_phone: required, string, max:20
				                $input = 'appointment_phone';
				                if (! is_required($$input)) {
					                $errors[$input] = 'required';
				                } elseif (! is_string_modified($$input)) {
					                $errors[$input] = 'Must be String';
				                } elseif (! is_not_more_than($$input, MAX_APPOINTMENT_PHONE_LENGTH)) {
					                $errors[$input] = 'Must be less than '.MAX_APPOINTMENT_PHONE_LENGTH.' Characters';
				                }
                                $data[$input] = $$input;
                                // appointment_email: required, string, max:100, email
				                $input = 'appointment_email';
				                if (! is_required($$input)) {
					                $errors[$input] = 'required';
				                } elseif (! is_string_modified($$input)) {
					                $errors[$input] = 'Must be String';
				                } elseif (! is_not_more_than($$input, MAX_APPOINTMENT_EMAIL_LENGTH)) {
					                $errors[$input] = 'Must be less than '.MAX_APPOINTMENT_EMAIL_LENGTH.' Characters';
				                } elseif (! is_email($$input)) {
					                $errors[$input] = 'Must be Email!!';
				                }
                                $data[$input] = $$input;
                                // appointment_date_birth: required
				                $input = 'appointment_date_birth';
				                if (! is_required($$input)) {
					                $errors[$input] = 'required';
				                }
                                $data[$input] = $$input;
                                // service_id: required
				                $input = 'service_id';
				                if (! is_required($$input)) {
					                $errors[$input] = 'Please Select Service ';
				                }
				                $$input = (int) $$input;
                                $check_id = get_data_by_id('services', $$input, 'id');
                                if (empty($check_id)) {
                                    $errors[$input] = 'Invalide Service Name';
				                }
                                $data[$input] = $$input;
                                // doctor_id
				                $input = 'doctor_id';
				                if (isset($$input)) {
					                $$input = (int) $$input;
					                $check_id = get_data_by_id('doctors', $$input, 'id');
                                    if (empty($check_id)) {
                                        $errors[$input] = 'Invalide Doctor Name';
					                }
					                $data[$input] = $$input;
                                }
                                // country_id: required
				                $input = 'country_id';
				                $$input = (int) $$input;
				                if (! is_required($$input)) {
					                $errors[$input] = 'Please Select Country ';
				                }
				                $check_id = get_data_by_id('countries', $$input, 'id');
                                if (empty($check_id)) {
                                    $errors[$input] = 'Invalide Country Name';
				                }
                                $data[$input] = $$input;
                                // state_id: required
				$input = 'state_id';
				$$input = (int) $$input;
				if (! is_required($$input)) {
					$errors[$input] = 'Please Select State ';
				}
				$check_id = get_data_by_id('states', $$input, 'id');
                if (empty($check_id)) {
                    $errors[$input] = 'Invalide State Name';
				}
                $data[$input] = $$input;
                // city_id: required
							$input = 'city_id';
							$$input = (int) $$input;
							if (! is_required($$input)) {
								$errors[$input] = 'Please Select City ';
							}
							$check_id = get_data_by_id('cities', $$input, 'id');
                            if (empty($check_id)) {
                                $errors[$input] = 'Invalide City Name';
							}
							$data[$input] = $$input;
							// appointment_date: required
							$input = 'appointment_date';
							if (! is_required($$input)) {
								$errors[$input] = 'required';
							}
							$data[$input] = $$input;
							// appointment_message 
							$input = 'appointment_message';
							if (isset($$input)) {
								if (! is_string_modified($$input)) {
									$errors[$input] = 'Must be String';
								}
								$data[$input] = $$input;
							}
                            if (empty($errors)) {
                                $restult = insert_into_table('appointments', $data);
                                if ($restult) {
                                    $success = '<div class="alert alert-success">Your Appointment is Sended Succfult Please Wait Us To Confirm Appointment With You</div>';
                                } else {
                                    $success = '<div class="alert alert-success">Your Appointment is NOT Sended Succfult Please Wait Us To Confirm Appointment With You</div>';
                                }
                            }
                        }
                            ?>
                            <?=(! empty($success)) ? $success : ''?>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="row">
                            <?php $input = "appointment_name"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2"> Patient Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Patient Name" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "appointment_phone"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2"> Patient Phone :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="<?=$input?>" placeholder="Enter Patient Phone" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "appointment_email"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2"> Patient Email :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="<?=$input?>" placeholder="Enter Patient Email" name="<?=$input?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "appointment_date_birth"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2"> Patient Birth Date :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <input id="text" name="appointment_date_birth" class="form-control"  placeholder="Date of Birth" type="text">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <?php $input = "service_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2"> Service Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <select class="form-control" id="services" name="<?=$input?>">
									<?php $services = get_data('services', 'where service_is_active = 1', 'name,id'); ?>
										<option value=''>Service Name</option>
										<?php foreach ($services as $service) : ?>
										<option value="<?=$service[$input]?>"><?=$service['service_name']?></option>
										<?php endforeach; ?>
									</select><?=getError($input)?>
                                </div>
                            </div>
                            </div>
							<br>		
							<div class="row">
                            <?php $input = "doctor_id"; ?>
                            <div class="form-group" id="doct">
                                <label for="<?=$input?>" class="col-md-2"> Doctor Name :</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <select class="form-control" id="doctor" name="<?=$input?>">
									<?php $doctors = get_data('doctors', 'where doctor_is_active = 1', 'name,id'); ?>
										<option value=''>Doctor Name</option>
										<?php foreach ($doctors as $doctor) : ?>
										<option value="<?=$doctor[$input]?>"><?=$doctor['doctor_name']?></option>
										<?php endforeach; ?>
									</select><?=getError($input)?>
                                </div>
                            </div>
                            </div>
							<br>
                            <div class="form-group" id="country-select">
								<?php $countries = get_data('countries', 'where country_is_active = 1', 'id,name');?>
									<select class="form-control" id="countries" name="country_id">
										<option value='' selected> Country Name</option>
										<?php foreach ($countries as $country) : ?>
										<option value="<?=$country['country_id']?>"><?=ucfirst($country['country_name'])?></option>
										<?php endforeach; ?>
									</select><?=getError('country_id')?>
								</div>	
								<div class="form-group" id="state-select">
									<select id="states" class="form-control" name="state_id">
										<option value='' selected> State Name</option>
									</select><?=getError('state_id')?>
								</div>
								<div class="form-group" id="city-select">
									<select class="form-control" id="cities" name='city_id'>
										<option value='' selected> City Name</option>
									</select><?=getError('city_id')?>
								</div>	
                            <br>
                            <div class="row">
                            <?php $input = "country_id"; ?>
                            <div class="form-group">
                                <label for="<?=$input?>" class="col-md-2">Country Name:</label> <?=getError($input); ?>
                                <div class="col-md-9">
                                <?php $rows = get_data('countries','','id,name'); ?>
                                    <select name="<?=$input?>" id="<?=$input?>" class="form-control">
                                        <option selected>Select Country</option>
                                        <?php foreach ($rows as $row): ?>
                                        <option value="<?=$row['country_id']?>"><?=$row['country_name']?></option>
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
<?php require_once INCLUDES."footer_dashboard.php"; ?>