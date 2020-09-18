<?php require_once 'globals.php'; ?>
<?php include_once "includes/header.php"; ?>
<!-- start banner Area -->
<section class="banner-area relative" id="home">
	<div class="overlay overlay-bg"></div>	
	<div class="container">
		<div class="row fullscreen d-flex align-items-center justify-content-center">
			<div class="banner-content col-lg-8 col-md-12">
				<h1>We Care for Your HealthEvery Moment</h1>
				<p class="pt-10 pb-10 text-white">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.
							</p>
							<a href="#" class="primary-btn text-uppercase">Get Started</a>
						</div>										
					</div>
				</div>					
			</section>
			<!-- End banner Area -->

			<!-- Start appointment Area -->
			<section class="appointment-area">			
				<div class="container">
					<div class="row justify-content-between align-items-center pb-120 appointment-wrap">
						<div class="col-lg-5 col-md-6 appointment-left">
							<h1>
								Servicing Hours
							</h1>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.
							</p>
							<ul class="time-list">
								<?php $service_hours = get_data('hours_servicings','where hours_servicing_is_active = 1','day,time');?>
								<?php foreach ($service_hours as $item) : ?>
									<li class="d-flex justify-content-between">
										<span><?=$item['hours_servicing_day']?></span>
										<span><?=$item['hours_servicing_time']?></span>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<?php if (isset($_POST['send'])) {
							//echo '<pre>';
							//print_r($_POST);
							//echo '</pre>';
							decomposed_array($_POST);
							//print_r($_POST);
							// Validation
							// appointment_name: required, string, max:50
							$input = 'appointment_name';
							if (! is_required($$input)) {
								$errors[$input] = 'required';
							} elseif (! is_string_modified($$input)) {
								$errors[$input] = 'Must be String';
							} elseif (! is_not_more_than($$input, MAXAPPOINTMENT_NAMELENGTH)) {
								$errors[$input] = 'Must be less than '.MAXAPPOINTMENT_NAMELENGTH.' Characters';
							}
							// appointment_phone: required, string, max:20
							$input = 'appointment_phone';
							if (! is_required($$input)) {
								$errors[$input] = 'required';
							} elseif (! is_string_modified($$input)) {
								$errors[$input] = 'Must be String';
							} elseif (! is_not_more_than($$input, MAXAPPOINTMENT_PHONELENGTH)) {
								$errors[$input] = 'Must be less than '.MAXAPPOINTMENT_PHONELENGTH.' Characters';
							}
							// appointment_email: required, string, max:100, email
							$input = 'appointment_email';
							if (! is_required($$input)) {
								$errors[$input] = 'required';
							} elseif (! is_string_modified($$input)) {
								$errors[$input] = 'Must be String';
							} elseif (! is_not_more_than($$input, MAXAPPOINTMENT_EMAIL_LENGTH)) {
								$errors[$input] = 'Must be less than '.MAXAPPOINTMENT_EMAIL_LENGTH.' Characters';
							} elseif (! is_email($$input)) {
								$errors[$input] = 'Must be Email!!';
							}
							// appointment_date_birth: required
							$input = 'appointment_date_birth';
							if (! is_required($$input)) {
								$errors[$input] = 'required';
							}
							// service_id: required
							$input = 'service_id';
							if (! is_required($$input)) {
								$errors[$input] = 'Please Select Service ';
							}
                            $check_id = get_data_by_id('services', $$input, 'id');
                            if (empty($check_id)) {
                                $errors[$input] = 'Invalide Country Data';
							}
							// country_id: required
							$input = 'country_id';
							if (! is_required($$input)) {
								$errors[$input] = 'Please Select Country ';
							}
							$check_id = get_data_by_id('countries', $$input, 'id');
                            if (empty($check_id)) {
                                $errors[$input] = 'Invalide Country Data';
                            }
							// state_id: required
							$input = 'state_id';
							if (! is_required($$input)) {
								$errors[$input] = 'Please Select State ';
							}
							$check_id = get_data_by_id('states', $$input, 'id');
                            if (empty($check_id)) {
                                $errors[$input] = 'Invalide Country Data';
                            }
							// city_id: required
							$input = 'city_id';
							if (! is_required($$input)) {
								$errors[$input] = 'Please Select City ';
							}
							$check_id = get_data_by_id('cities', $$input, 'id');
                            if (empty($check_id)) {
                                $errors[$input] = 'Invalide Country Data';
                            }
							//echo '<pre>';
							//print_r($errors);
							//echo '</pre>';
						}
						?>
						<div class="col-lg-6 col-md-6 appointment-right pt-60 pb-60" id="appointment">
							<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
								<h3 class="pb-20 text-center mb-30">Book an Appointment</h3>
								<div class="form-group">		
									<input type="text" class="form-control" name="appointment_name" placeholder = 'Patient Name' ><?=getError('appointment_name')?>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="appointment_phone" placeholder = 'Phone' ><?=getError('appointment_phone');?>
								</div>
								<div class="form-group">
									<input type="email" class="form-control" name="appointment_email" placeholder = 'Email Address' ><?=getError('appointment_email')?>
								</div>
								<div class="form-group">
									<input id="datepicker1" name="appointment_date_birth" class="dates form-control"  placeholder="Date of Birth" type="text"><?=getError('appointment_date_birth')?>
								</div>
								<div class="form-group">
									<select class="form-control" id="services" name="service_id">
									<?php $services = get_data('services', 'where service_is_active = 1', 'name,id'); ?>
										<option value=''>Service Name</option>
										<?php foreach ($services as $service) : ?>
										<option value="<?=$service['service_id']?>"><?=$service['service_name']?></option>
										<?php endforeach; ?>
									</select><?=getError('service_id')?>
								</div>
								<div class="form-group" id="doct">
									<select class="form-control" id="doctors" name="doctor_id">
									<?php $doctors = get_data('doctors', 'where doctor_is_active = 1', 'name,id'); ?>
										<option value=''>Doctor Name</option>
										<?php foreach ($doctors as $doctor) : ?>
										<option value="<?=$doctor['doctor_id']?>"><?=ucfirst($doctor['doctor_name'])?></option>
										<?php endforeach; ?>
									</select><?=getError('doctor_id')?>
								</div>	
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
								<div class="form-group">
									<input id="datepicker2" class="dates form-control"  placeholder="appointment Date" type="text" name="appoiontment_date">  
								</div>
								<textarea name="appoiontment_messege" class="form-control" rows="5" placeholder = 'Messege'></textarea> 
								<br>
								<div class="form-group">
									<button class="primary-btn text-uppercase" type="submit" name="send">Confirm Booking</button>
								</div>
							</form>
						</div>
					</div>
				</div>	
			</section>
			<!-- End appointment Area -->

			<!-- Start facilities Area -->
			<section class="facilities-area section-gap">
				<div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-70 col-lg-7">
		                    <div class="title text-center">
		                        <h1 class="mb-10">Our Latest Facilities</h1>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua. </p>
		                    </div>
		                </div>
		            </div>
					<div class="row">
					<?php $features = get_data('features', 'where feature_is_active = 1', 'name,icon,description'); ?>
					<?php foreach ($features as $feature) : ?>
						<div class="col-lg-3 col-md-6">
							<div class="single-facilities">
								<span class="<?=$feature['feature_icon']?>"></span>
								<a href="#"><h4><?=$feature['feature_name']?></h4></a>
								<p><?=$feature['feature_description']?></p>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>	
			</section>
			<!-- End facilities Area -->
		
			<!-- Start offered-service Area -->
			<section class="offered-service-area section-gap">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-8 offered-left">
							<h1 class="text-white">Our Offered Services</h1>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.
							</p>
							<div class="service-wrap row">
								<div class="col-lg-6 col-md-6">
									<div class="single-service">
										<div class="thumb">
											<img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/s1.jpg" alt="">		
										</div>
										<a href="#">
											<h4 class="text-white">Cardiac Treatment</h4>
										</a>	
										<p>
											inappropriate behavior Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										</p>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="single-service">
										<div class="thumb">
											<img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/s2.jpg" alt="">		
										</div>
										<a href="#">
											<h4 class="text-white">Routine Checkup</h4>
										</a>	
										<p>
											inappropriate behavior Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										</p>
									</div>
								</div>								
							</div>
						</div>
						<div class="col-lg-4">
							<div class="offered-right relative">
								<div class="overlay overlay-bg"></div>
								<h3 class="relative text-white">Departments</h3>
								<ul class="relative dep-list">
									<?php $departments = get_data('departments', 'where department_is_active = 1', 'id,name', '7'); ?>
									<?php foreach ($departments as $department) : ?>
										<li><a href="<?=WEBSITE_URL.'?department='.$department['department_id']?>"><?=$department['department_name']?></a></li>
									<?php endforeach; ?>
								</ul>
								<a class="viewall-btn" href="#">View all Department</a>			
							</div>	
						</div>
					</div>
				</div>	
			</section>
			<!-- End offered-service Area -->
		
			<!-- Start team Area -->
		    <section class="team-area section-gap">
		        <div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-70 col-lg-7">
		                    <div class="title text-center">
		                        <h1 class="mb-10">Our Consultants</h1>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
		                    </div>
		                </div>
		            </div>
		            <div class="row justify-content-center d-flex align-items-center">
		                <div class="col-lg-3 col-md-6 single-team">
		                    <div class="thumb">
		                        <img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/t1.jpg" alt="">
		                        <div class="align-items-end justify-content-center d-flex">
									<div class="social-links">
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-dribbble"></i></a>
										<a href="#"><i class="fa fa-behance"></i></a>
									</div>			                        	
		                            <p>
		                            	inappropriate behavior
		                            </p>
		                            <h4>Andy Florence</h4>		                            
		                        </div>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6 single-team">
		                    <div class="thumb">
		                        <img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/t2.jpg" alt="">
		                        <div class="align-items-end justify-content-center d-flex">
									<div class="social-links">
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-dribbble"></i></a>
										<a href="#"><i class="fa fa-behance"></i></a>
									</div>			                        	
		                            <p>
		                            	inappropriate behavior
		                            </p>
		                            <h4>Andy Florence</h4>		                            
		                        </div>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6 single-team">
		                    <div class="thumb">
		                        <img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/t3.jpg" alt="">
		                        <div class="align-items-end justify-content-center d-flex">
									<div class="social-links">
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-dribbble"></i></a>
										<a href="#"><i class="fa fa-behance"></i></a>
									</div>			                        	
		                            <p>
		                            	inappropriate behavior
		                            </p>
		                            <h4>Andy Florence</h4>		                            
		                        </div>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6 single-team">
		                    <div class="thumb">
		                        <img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/t4.jpg" alt="">
		                        <div class="align-items-end justify-content-center d-flex">
									<div class="social-links">
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-dribbble"></i></a>
										<a href="#"><i class="fa fa-behance"></i></a>
									</div>			                        	
		                            <p>
		                            	inappropriate behavior
		                            </p>
		                            <h4>Andy Florence</h4>		                            
		                        </div>
		                    </div>
		                </div>		                		                		                
		            </div>
		        </div>
		    </section>
		    <!-- End team Area -->				
						
			<!-- Start feedback Area -->
			<section class="feedback-area section-gap relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-12 pb-60 header-text text-center">
							<h1 class="mb-10 text-white">Enjoy our Client’s Feedback</h1>
							<p class="text-white">
								Who are in extremely love with eco friendly system..
							</p>
						</div>
					</div>			
					<div class="row feedback-contents justify-content-center align-items-center">
						<div class="col-lg-6 feedback-left relative d-flex justify-content-center align-items-center">
							<div class="overlay overlay-bg"></div>
							<a class="play-btn" href="https://www.youtube.com/watch?v=ARA0AxrnHdM"><img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/play-btn.png" alt=""></a>
						</div>
						<div class="col-lg-6 feedback-right">
							<div class="active-review-carusel">
								<div class="single-feedback-carusel">
									<img src="<?=WEBSITE_URL?>assets/frontend/img/r1.png" alt="">
									<div class="title d-flex flex-row">
										<h4 class="text-white pb-10">Fannie Rowe</h4>
										<div class="star">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>								
										</div>										
									</div>
									<p class="text-white">
										Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
									</p>
								</div>
								<div class="single-feedback-carusel">
									<img src="<?=WEBSITE_URL?>assets/frontend/img/r1.png" alt="">
									<div class="title d-flex flex-row">
										<h4 class="text-white pb-10">Fannie Rowe</h4>
										<div class="star">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>								
										</div>										
									</div>
									<p class="text-white">
										Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
									</p>
								</div>
								<div class="single-feedback-carusel">
									<img src="<?=WEBSITE_URL?>assets/frontend/img/r1.png" alt="">
									<div class="title d-flex flex-row">
										<h4 class="text-white pb-10">Fannie Rowe</h4>
										<div class="star">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked	"></span>								
										</div>										
									</div>
									<p class="text-white">
										Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
									</p>
								</div>																
							</div>
						</div>
					</div>
				</div>	
			</section>
			<!-- End feedback Area -->	

		    <!-- Start brands Area -->
		    <section class="brands-area">
		        <div class="container">
		            <div class="brand-wrap section-gap">
		                <div class="row align-items-center active-brand-carusel justify-content-start no-gutters">
		                    <div class="col single-brand">
		                        <a href="#"><img class="mx-auto" src="<?=WEBSITE_URL?>assets/frontend/img/l1.png" alt=""></a>
		                    </div>
		                    <div class="col single-brand">
		                        <a href="#"><img class="mx-auto" src="<?=WEBSITE_URL?>assets/frontend/img/l2.png" alt=""></a>
		                    </div>
		                    <div class="col single-brand">
		                        <a href="#"><img class="mx-auto" src="<?=WEBSITE_URL?>assets/frontend/img/l3.png" alt=""></a>
		                    </div>
		                    <div class="col single-brand">
		                        <a href="#"><img class="mx-auto" src="<?=WEBSITE_URL?>assets/frontend/img/l4.png" alt=""></a>
		                    </div>
		                    <div class="col single-brand">
		                        <a href="#"><img class="mx-auto" src="<?=WEBSITE_URL?>assets/frontend/img/l5.png" alt=""></a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </section>
		    <!-- End brands Area -->
			<?php include_once "includes/footer.php"; ?>