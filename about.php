<?php require_once 'globals.php'; ?>
<?php include_once INCLUDES."header.php"; ?>
<?php $about = get_one('abouts',"`about_is_active` = '1'"); ?>
<?php //$questions = get_data('questions',"where `question_is_active` = '1'",'id,content'); ?>
<?php //$answers = get_data('answers',"where `answer_is_active` = '1'"); ?>
<?php $answers = get_data_join(['questions','answers'],'questions.question_id = answers.question_id'); ?>
<?php //var_dump($answers); ?>

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">	
    <div class="overlay overlay-bg"></div>
	<div class="container">				
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">About Us</h1>	
				<p class="text-white link-nav"><a href="<?=WEBSITE_URL?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="<?=WEBSITE_URL.'about'?>"> About Us</a></p>
			</div>	
		</div>
	</div>
</section>
<!-- End banner Area -->	
<!-- Start our-mission Area -->
<section class="our-mission-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10"><?=$about['about_heading']?></h1>
								<p><?=$about['about_slug']?></p>
							</div>
						</div>
					</div>							
                    <div class="row">
                        <div class="col-md-6 accordion-left">
                            <!-- accordion 2 start-->
                            <dl class="accordion">
							<?php foreach ($answers as $answer): ?>
								<dt><a href=""><?=$answer['question_content']?></a></dt>
                                <dd><?=$answer['answer_content']?></dd>
							<?php endforeach; ?>
                            </dl>
                            <!-- accordion 2 end-->
                        </div>
                        <div class="col-md-6 video-right justify-content-center align-items-center d-flex relative">
                        	<div class="overlay overlay-bg"></div>
							<a class="play-btn" href="<?=$about['about_video_link']?>"><img class="img-fluid mx-auto" src="<?=WEBSITE_URL.'assets/frontend/img/about/play.png'?>" alt=""></a>
                        </div>
                    </div>
				</div>	
			</section>
			<!-- End our-mission Area -->
            <!-- Start info Area -->
			<section class="info-area">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-lg-6 no-padding info-area-left">
							<img class="img-fluid" src="<?=UPLOADE_URL.'abouts/'.$about['about_image']?>" alt="">
						</div>
						<div class="col-lg-6 info-area-right">
							<h1><?=$about['about_title']?></h1>
							<p><?=$about['about_description']?></p>
						</div>
					</div>
				</div>	
			</section>
			<!-- End info Area -->	
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
		<?php $doctors = get_data('doctors', 'where doctor_is_show = 1', 'id,name'); ?>
		<?php foreach ($doctors as $doctor): ?>
		    <div class="col-lg-3 col-md-6 single-team">
		        <div class="thumb">
		            <img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/t1.jpg" alt="doctor">
		            <div class="align-items-end justify-content-center d-flex">
						<div class="social-links">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>			                        	
		                <p>inappropriate behavior</p>
		                <h4>Andy Florence</h4>		                            
		            </div>
		        </div>
		    </div>
		<?php endforeach; ?>
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
                        <?php $item = get_one('doctors','doctor_is_rating = 1'); ?>
                        <?php if (! empty($item)) : ?>
                            <?php $column = 'doctor_id'; ?>
                            <?php $id= $item['doctor_id']; ?>
                            <div class="col-lg-6 feedback-left relative d-flex justify-content-center align-items-center">
                                <div class="overlay overlay-bg"></div>
                                <a class="play-btn" href="<?=$item['doctor_video_link']?>"><img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/play-btn.png" alt=""></a>
                            </div>
                        <?php else: ?>
                            <?php $item = get_one('services','service_is_rating = 1'); ?>
                            <?php $column = 'service_id'; ?>
                            <?php $id= $item['service_id']; ?>
                            <div class="col-lg-6 feedback-left relative d-flex justify-content-center align-items-center">
                                <div class="overlay overlay-bg"></div>
                                <a class="play-btn" href="<?=$item['service_video_link']?>"><img class="img-fluid" src="<?=WEBSITE_URL?>assets/frontend/img/play-btn.png" alt=""></a>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-6 feedback-right">
                            <div class="active-review-carusel">
                                <?php $feedbacks = get_data('feedbacks',"where `feedback_is_show` = '1' and `$column` = $id"); ?>
                                <?php foreach ($feedbacks as $feedback) : ?>
                                    <div class="single-feedback-carusel">
                                        <div class="title d-flex flex-row">
                                            <h4 class="text-white pb-10"><?=ucfirst($feedback['feedback_name'])?></h4>
                                            <div class="star">
                                                <?php for($i = 0; $i < 5; $i++) : ?>
                                                <?php $checked = ($i < $feedback['feedback_rate']) ? 'checked' : '' ?>
                                                <span class="fa fa-star <?=$checked?>"></span>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <p class="text-white">
                                            <?=$feedback['feedback_content']?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
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
			<?php $brands = get_data('brands', 'where brand_is_active = 1', 'id,name,image'); ?>
			<?php foreach ($brands as $brand): ?>
		        <div class="col single-brand">
		            <a href="<?='https:www.'.$brand['brand_name'].'.com'?>"><img class="mx-auto" src="<?=WEBSITE_URL.'uploads/brands/'.$brand['brand_image']?>" alt=""></a>
		        </div>
			<?php endforeach; ?>
		    </div>
		</div>
	</div>
</section>
<!-- End brands Area -->

<?php include_once INCLUDES."footer.php"; ?>