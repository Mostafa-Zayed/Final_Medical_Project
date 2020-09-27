<?php require_once '../../globals.php'; ?>
<?php include_once INCLUDES."header.php"; ?>
<?php
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    decomposed_array(clean($_POST));
    $data = array();
    // admin_email
	$input = 'admin_email';
    if (! is_required($$input)) {
        $errors[$input] = 'Your Email Is Required';
    }
    if (! is_email($$input)) {
        $errors[$input] = 'Invalid Email';
    }
    if (! is_not_more_than($$input, MAX_ADMIN_EMAIL_LENGTH)) {
       $errors[$input] = 'Email Must be Less Than '.MAX_ADMIN_EMAIL_LENGTH;
    }
    $data[$input] = $$input;
    // admin_password
    $input = 'admin_password';
   if (! is_required($$input)) {
       $errors[$input] = 'Your Password Is Required';
    }
    if (! is_string_modified($$input)) {
        $errors[$input] = 'Password Must be String';
    }
    if (! is_not_more_than($$input, MAX_ADMIN_PASSWORD_LENGTH)) {
        $errors[$input] = 'Password Must br Less Than '.MAX_ADMIN_PASSWORD_LENGTH;
    }
    if (! is_not_less_than($$input, MIN_ADMIN_PASSWORD_LENGTH)) {
        $errors[$input] = 'Password Must be More Than '.MIN_ADMIN_PASSWORD_LENGTH;
    }
	$data[$input] = $$input;
	if (empty($errors)) {
		$check = get_one('admins', "`admin_email` = '$admin_email'");
        if (! empty($check)) {
            $password_matched = password_verify($data['admin_password'], $check['admin_password']);
            if ($password_matched){
				session_regenerate_id(true);
				set_session('admin_name', $check['admin_name']);
                set_session('admin_id', $check['admin_id']);
                set_session('admin_type', password_hash($check['admin_type'], PASSWORD_DEFAULT));
				redirect('admin/index.php');
			} else {
				$success = '<div class="alert alert-danger"> Error pass: </div>';
			}
    	} else {
			$success = '<div class="alert alert-danger"> Error: </div>';
		}
	}
}
?>

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
				<a href="<?=WEBSITE_URL?>" class="primary-btn text-uppercase">Get Started</a>
			</div>										
		</div>
	</div>					
</section>
<!-- End banner Area -->
<div class='row'>
    <div class='col-md-6 offset-3'>
        <div class="comment-form">
            <h2>Login</h2>
            <br>
			<?=! empty($success) ? $success : ''?>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="mt-10">
					<input type="email" name="admin_email" placeholder="Enter Email Address"  class="single-input-primary">
                    <span><?=getError('admin_email')?></span>
				</div>
                <div class="mt-10">
					<input type="password" name="admin_password" placeholder="Enter Password"  class="single-input-primary">
                    <span><?=getError('admin_password')?></span>
				</div>
                <br>
                <button type="submit" class="primary-btn text-uppercase" name="submit">Login</button>
                <!--<a href="#" class="primary-btn text-uppercase">Post Comment</a>-->
            </form>
        </div>
    </div>
</div>
<?php include_once INCLUDES."footer.php"; ?>


