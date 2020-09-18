<?php $pages = get_data('pages','where page_is_active = 1','name,link'); ?>
<nav id="nav-menu-container">
	<ul class="nav-menu">
		<?php foreach ($pages as $page) : ?>
			<li><a href="<?=WEBSITE_URL?><?=(! empty($page['page_link'])) ? $page['page_link'] : $page['page_name'];?>.php"><?=$page['page_name']?></a></li>
		<?php endforeach; ?>
	</ul>
</nav><!-- #nav-menu-container -->		    		