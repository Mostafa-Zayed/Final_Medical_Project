<ul class="nav navbar-nav navbar-right navbar-user">
    <li class="dropdown messages-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">2</span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li class="dropdown-header">2 New Messages</li>
            <li class="message-preview">
                <a href="#">
                    <span class="avatar"><i class="fa fa-bell"></i></span>
                    <span class="message">Security alert</span>
                </a>
            </li>
            <li class="divider"></li>
            <li class="message-preview">
                <a href="#">
                    <span class="avatar"><i class="fa fa-bell"></i></span>
                    <span class="message">Security alert</span>
                </a>
            </li>
            <li class="divider"></li>
            <li><a href="#">Go to Inbox <span class="badge">2</span></a></li>
        </ul>
    </li>
    <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Steve Miller<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
            <li class="divider"></li>
            <form id="my_form" method="post" action="<?=WEBSITE_URL.'logout.php'?>" style="inline;">
                <li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-power-off"></i> &nbsp;<input type="submit" name='logout' value="Logout" class="btn btn-primary"></li>        
            </form>
        </ul>
    </li>
</ul>