<?php require_once 'globals.php'; ?>
<?php include_once INCLUDES."header.php"; ?>
<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Features				
							</h1>	
							<p class="text-white link-nav"><a href="<?=WEBSITE_URL?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="<?=WEBSITE_URL.'features'?>"> Features</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->

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
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
				<div class="service-wrap row">
				<?php $offers = get_data('offers','where `offer_is_active` = 1','*',2); ?>
				<?php foreach ($offers as $offer) : ?>
					<div class="col-lg-6 col-md-6">
						<div class="single-service">
							<div class="thumb">
								<img class="img-fluid" src="<?=UPLOADE_URL.'offers/'.$offer['offer_image']?>" alt="">		
							</div>
							<a href="<?=WEBSITE_URL?>">
								<h4 class="text-white"><?=ucfirst($offer['offer_name'])?></h4>
							</a>	
							<p><?=$offer['offer_description']?></p>
						</div>
					</div>
				<?php endforeach; ?>
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
					<a class="viewall-btn" href="<?=WEBSITE_URL.'departments'?>">View all Department</a>			
				</div>	
			</div>
		</div>
	</div>	
</section>
<!-- End offered-service Area -->

<!-- Start feedback Area -->
<section class="feedback-area section-gap relative">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 pb-60 header-text text-center">
				<h1 class="mb-10 text-white">Enjoy our Client’s Feedback</h1>
				<p class="text-white">Who are in extremely love with eco friendly system..</p>
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
            	<?php $feedbacks = get_data('feedbacks',"where `feedback_is_show` = '1' and `$column` = '$id'"); ?>	
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
                    	<p class="text-white"><?=$feedback['feedback_content']?></p>
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