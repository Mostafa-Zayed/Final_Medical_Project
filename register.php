<?php require_once 'globals.php'; ?>
<?php include_once "includes/header.php"; ?>
<?php if (isset($_POST['submit'])) {
    decomposed_array($_POST);
    $data = array();
    $input = 'user_name';
    if (! is_required($$input)) {
        $errors[$input] = 'Your Name Is Required';
    }
    if (! is_string_modified($$input)) {
        $errors[$input] = 'Name Must be String';
    }
    if (! is_not_more_than($$input, MAX_USER_NAME_LENGTH)) {
        $errors[$input] = 'Name Must br Less Than '.MAX_USER_NAME_LENGTH;
    }
    $data[$input] = $$input;
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
    $input = 'confirm_password';
    if (! is_required($$input)) {
       $errors[$input] = 'Your '.ucfirst($input).' Is Required';
    }
    if (! is_string_modified($$input)) {
        $errors[$input] = ucfirst($input).' Must be String';
    }
    if (! is_not_more_than($$input, MAX_USER_PASSWORD_LENGTH)) {
        $errors[$input] = ucfirst($input). ' Must br Less Than '.MAX_USER_PASSWORD_LENGTH;
    }
    $data[$input] = $$input;
    $input = 'user_age';
    if (isset($$input)) {
        $$input = (int) $$input;
        if (! is_integer_modified($$input)) {
            $errors[$input] = 'Age Must be Number';
        }
        if (! is_not_more_than($$input, MAX_USER_AGE_LENGTH)) {
            $errors[$input] = 'Age Must be Less Than '.MAX_USER_AGE_LENGTH;
        }   
    }
    $input = 'user_phone';
     if (isset($$input)) {
        if (! is_not_more_than($$input, MAX_USER_PHONE_LENGTH)) {
            $errors[$input] = 'Phone Must be Less Than '.MAX_USER_PHONE_LENGTH;
        }   
        $data[$input] = $$input;
    }
    $input = 'user_gender';
    if (! is_required($$input)) {
        $errors[$input] = 'Your Gender Is Required';
    }
    if (! is_string_modified($$input)) {
        $errors[$input] = 'Gender Must be String';
    }
    if (! is_belongs_to($$input, array('male','female'))) {
        $errors[$input] = 'Invalid Gender Value';
    }
    $data[$input] = $$input;
    if ($user_password !== $confirm_password) {
        $errors['user_password'] = 'Passowrd Not Matched';
    }
    if (empty($errors)) {
        unset($data['confirm_password']);
        $check = get_data('users', "where `user_email` = '$user_email'", 'email', 1);
        if (empty($check)) {
            $data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);
            $restult = insert_into_table('users', $data);
            if ($restult) {
                session_regenerate_id(true);
                $success = '<div class="alert alert-success">Your Are Registerd Succefully Go To Login Page</div>';
                //redirect('login.php');
            } else {
                $success = '<div class="alert alert-danger"><b> Error : </b> Can Not Register </div>';
            }
        } else {
            $success = '<div class="alert alert-danger"><b> Error : </b> Email already exists!!! </div>';
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
            <h2>Register</h2>
            <br>
            <?=! empty($success) ? $success : ''?>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <div class="mt-10">
					<input type="text" name="user_name" placeholder="Enter Name"  class="single-input-primary">
                    <span><?=getError('user_name')?></span>
				</div>
                <div class="mt-10">
					<input type="email" name="user_email" placeholder="Enter Email Address"  class="single-input-primary" id="email_input">
                    <span id='email_error'><?=getError('user_email')?></span>
				</div>
                <div class="mt-10">
					<input type="password" name="user_password" placeholder="Enter Password"  class="single-input-primary">
                    <span><?=getError('user_password')?></span>
				</div>
                <div class="mt-10">
					<input type="password" name="confirm_password" placeholder="Confirm Password"  class="single-input-primary">
                    <span><?=getError('confirm_password')?></span>
				</div>
                <div class="mt-10">
                <input type="number" name="user_age" placeholder="Enter Your Age"  class="single-input-primary">
                    <span><?=getError('user_age')?></span>
				</div>
                <br>
                <div class="mt-10">
					<input type="text" name="user_phone" placeholder="Enter phone"  class="single-input-primary">
                    <span><?=getError('user_phone')?></span>
				</div>
                <br>
                <div class='form-group mb-5'>
                    <div class="default-select" id="default-select">
					    <select class='form-control' name='user_gender'>
							<option value=''>Select Gender :</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
                        <span><?=getError('user_gender')?>
					</div>
                </div>
                <button type="submit" class="primary-btn text-uppercase mt-5" name='submit'>Register</button>
            </form>
        </div>
    </div>
</div>
<br>
<br>
<?php include_once "includes/footer.php"; ?>