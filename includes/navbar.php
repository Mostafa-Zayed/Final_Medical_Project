<?php $pages = get_data('pages','where page_is_active = 1','name,link'); ?>
<nav id="nav-menu-container">
	<ul class="nav-menu">
	<?php if(check_auth()): ?>
		<?php foreach ($pages as $page): ?>
			<?php if ($page['page_name'] == 'login' || $page['page_name'] == 'register'):?>
				<?php continue; ?>
			<?php endif;?>
			<li><a href="<?=WEBSITE_URL?><?=(! empty($page['page_link'])) ? $page['page_link'] : $page['page_name'];?>.php"><?=$page['page_name']?></a></li>
		<?php endforeach; ?>
			<li class="menu-has-children"><a href=''>Welcom <?=$_SESSION['user_name']?></a>
			    <ul>
			    	<li><a href="profile.php" class="genric-btn primary e-large">Profile</a></li>
					<br>
			        <li>
						<form method="post" action="logout.php">
							<input type="submit" name="logout" value="Logout" class="genric-btn primary e-large">
						</form>
					</li>
			    </ul>
			</li>	
	<?php else : ?>
		<?php foreach ($pages as $page): ?>
			<li><a href="<?=WEBSITE_URL?><?=(! empty($page['page_link'])) ? $page['page_link'] : $page['page_name'];?>.php"><?=$page['page_name']?></a></li>
		<?php endforeach; ?>
	<?php endif; ?>
	</ul>
</nav> 		    			    		

