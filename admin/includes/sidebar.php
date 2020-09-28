<ul class="nav navbar-nav side-nav">
    <li class="active"><a href="<?=ADMIN_URL.'index.php'?>"><i class="fa fa-home" aria-hidden="true"></i> &nbsp; 
 Dashboard</a></li>
    <?php //permision here ?>
    <li><a href="<?=ADMIN_URL.'users/view.php';?>"><i class="fa fa-users" aria-hidden="true"></i> &nbsp;
 Users</a></li>
    <?php //permision here ?>    
    <?php //if (permision_super_admin()): ?>
    <li><a href="<?=ADMIN_URL.'admins/view.php';?>"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;
 Admins</a></li>
    <?php //endif; ?>
    <?php //permision here ?>
    <li><a href="<?=ADMIN_URL.'pages/view.php';?>"><i class="fa fa-file" aria-hidden="true"></i> &nbsp;
 Pages</a></li>
    <?php //permision here ?>
    <li><a href="<?=ADMIN_URL.'departments/view.php'?>"><i class="fa fa-list-ol"></i> &nbsp; Departments</a></li>
    <?php //permision here ?>
    <li><a href="<?=ADMIN_URL.'service_types/view.php';?>"><i class="fa fa-server" aria-hidden="true"></i> &nbsp;
 Servie Types</a></li>
    <?php //permision here ?>
    <li><a href="<?=ADMIN_URL.'services/view.php';?>"><i class="fa fa-sun-o" aria-hidden="true"></i> &nbsp;
 Services</a></li>
    <?php //permision here ?>
    <li><a href="<?=ADMIN_URL.'doctors/view.php';?>"><i class="fa fa-user-md" aria-hidden="true"></i> &nbsp;
 Doctors</a></li>
    <?php //permision here ?>
    <li><a href="<?=ADMIN_URL.'appointments/view.php';?>"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;
 Appointments</a></li>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <?php //permision here ?>
    <li><a href="<?=ADMIN_URL.'countries/view.php';?>"><i class="fa fa-globe" aria-hidden="true"></i> &nbsp; 
 Countries</a></li>
    <li><a href="<?=ADMIN_URL.'states/view.php';?>"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; 
 States</a></li>
    <li><a href="<?=ADMIN_URL.'cities/view.php';?>"><i class="fa fa-location-arrow"></i> &nbsp; Cities</a></li>
    
    
    <li><a href="<?=ADMIN_URL.'brands/view.php';?>"><i class="fa fa-heartbeat" aria-hidden="true"></i> &nbsp; 
 Brands</a></li>
    
    
    <li><a href="<?=ADMIN_URL.'sliders/view.php';?>"><i class="fa fa-globe"></i> Sliders</a></li>
    
    
    <li><a href="<?=ADMIN_URL.'hours_servicings/view.php';?>"><i class="fa fa-globe"></i> Servicing Hours</a></li>
    <li><a href="<?=ADMIN_URL.'offers/view.php';?>"><i class="fa fa-globe"></i> Offers</a></li>
    <li><a href="<?=ADMIN_URL.'features/view.php';?>"><i class="fa fa-globe"></i> Features</a></li>
    <li><a href="<?=ADMIN_URL.'feedbacks/view.php';?>"><i class="fa fa-globe"></i> Feedbacks</a></li>
    <li><a href="<?=ADMIN_URL.'messages/view.php';?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;
 Messages</a></li>
    <li><a href="<?=ADMIN_URL.'settings/view.php';?>"><i class="fa fa-cog" aria-hidden="true"></i> &nbsp; 
 Settings</a></li>
    <li><a href="<?=ADMIN_URL.'settings/view.php';?>"><i class="fa fa-globe"></i> Settings</a></li>
</ul>