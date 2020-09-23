<?php require_once 'globals.php'; ?>
<?php include_once "includes/header.php"; ?>
<?php 
if (isset($_POST['submit'])) {
    decomposed_array($_POST);
	$data = array();
	$input = 'user_email';
    if (! is_required($$input)) {
        $errors[$input] = 'Your Email Is Required';
    }
    if (! is_email($$input)) {
        $errors[$input] = 'Invalid Email';
    }
    if (! is_not_more_than($$input, MAX_USER_EMAIL_LENGTH)) {
       $errors[$input] = 'Email Must be Less Than '.MAX_USER_EMAIL_LENGTH;
    }
    $data[$input] = $$input;
    $input = 'user_password';
   if (! is_required($$input)) {
       $errors[$input] = 'Your Password Is Required';
    }
    if (! is_string_modified($$input)) {
        $errors[$input] = 'Password Must be String';
    }
    if (! is_not_more_than($$input, MAX_USER_PASSWORD_LENGTH)) {
        $errors[$input] = 'Password Must br Less Than '.MAX_USER_PASSWORD_LENGTH;
    }
    if (! is_not_less_than($$input, MIN_USER_PASSWORD_LENGTH)) {
        $errors[$input] = 'Password Must be More Than '.MIN_USER_PASSWORD_LENGTH;
    }
	$data[$input] = $$input;
	if (empty($errors)) {
		$check = get_one('users', "`user_email` = '$user_email'");
        if (! empty($check)) {
            $password_matched = password_verify($data['user_password'], $check['user_password']);
            if ($password_matched){
				session_regenerate_id(true);
				set_session('user_name',$check['user_name']);
				set_session('user_id',$check['user_id']);
				redirect('index.php');
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
				<a href="#" class="primary-btn text-uppercase">Get Started</a>
			</div>										
		</div>
	</div>					
</section>
</br>
<div class='row'>
    <div class='col-md-6 offset-3'>
        <div class="comment-form">
            <h2>Login</h2>
            <br>
			<?=! empty($success) ? $success : ''?>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="mt-10">
					<input type="email" name="user_email" placeholder="Enter Email Address"  class="single-input-primary">
                    <span><?=getError('user_email')?></span>
				</div>
                <div class="mt-10">
					<input type="password" name="user_password" placeholder="Enter Password"  class="single-input-primary">
                    <span><?=getError('user_password')?></span>
				</div>
                <br>
                <button type="submit" class="primary-btn text-uppercase" name="submit">Login</button>
                <!--<a href="#" class="primary-btn text-uppercase">Post Comment</a>-->
            </form>
        </div>
    </div>
</div>
<br>
<br>
<?php include_once "includes/footer.php"; ?>