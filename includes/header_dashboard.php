
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" type="text/css" href="<?=WEBSITE_URL;?>assets/dashboard/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=WEBSITE_URL;?>/assets/dashboard/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=WEBSITE_URL;?>/assets/dashboard/css/local.css" />

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php require_once "sidebar.php"; ?>
                <?php require_once "navbar_dashboard.php"; ?>
            </div>
        </nav>
