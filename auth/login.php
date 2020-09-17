<?php require_once "../config/config.php"; ?>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?=WEBSITE_URL.'assets/frontend/css/bootstrap.css'?>">

<title>Login</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-6 mx-auto my-5">
            <div class="card ">
                <div class="card-header">
                    <h3 class="text-center">Login</h3>
                    <?php
                    
                    if (isset($_POST['submit']) && !empty($_POST['submit'])) {
                        foreach ($_POST as $key => $value) {
                            $$key = prepare_input($value);
                        }
                        echo $email;
                    }
                    ?>
                    <div>
                        <form class="border p-5 my-3 " method="POST" action="login.php">
                            <div class="form-group">
                                <label for="email"  class="text-dark">Email</label>
                                <input type="email" name="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password"  class="text-dark ">Password</label>
                                <input type="password" name="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block" value="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo URL.'asset/frontend/js/jquery-3.5.1.slim.min.js'?>"></script>
<script src="<?php echo URL.'asset/frontend/js/bootstrap.js'?>"></script>
</body>
</html>
