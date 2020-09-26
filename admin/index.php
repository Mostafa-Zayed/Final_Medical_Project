<?php require_once "../globals.php"; ?>
<?php require_once ADMIN_INCLUDES."header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4><a href="<?=ADMIN_URL?>index.php">Dashboard </a>/ Home Page</h4>
            <br>
            <div class="col-lg-3">
            <?php $users = get_table_count('users'); ?>
                <div class="panel panel-default ">
                    <div class="panel-body alert-info">
                        <div class="col-xs-5">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-5 text-right">
                            <p class="alerts-heading"><?=$users?></p>
                            <h5 class="alerts-text">Users</h5>  
                        </div>
                        <div class="col-xs-5">
                            <a href="<?=ADMIN_URL.'users/view.php'?>" class="btn btn-primary btn-lg">Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <?php //$admins = get_table_count('admins'); ?>
                <div class="panel panel-default ">
                    <div class="panel-body alert-info">
                        <div class="col-xs-5">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-5 text-right">
                            <p class="alerts-heading"><?='test'?></p>
                            <h5 class="alerts-text">Admins</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <?php $appointments = get_table_count('appointments'); ?>
                <div class="panel panel-default ">
                    <div class="panel-body alert-info">
                        <div class="col-xs-5">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-5 text-right">
                            <p class="alerts-heading"><?=$appointments?></p>
                            <h5 class="alerts-text">Appointments</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-default ">
                    <div class="panel-body alert-info">
                        <div class="col-xs-5">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-5 text-right">
                            <p class="alerts-heading">343</p>
                            <h5 class="alerts-text">Users</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once ADMIN_INCLUDES."footer.php"; ?>