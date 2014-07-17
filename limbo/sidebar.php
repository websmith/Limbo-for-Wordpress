<aside class="col-sm-4">
	<div class="well">
        <?php the_title('<h3>', '</h3>'); ?>
        <hr>
		<?php
			wp_nav_menu( array(
				'menu'              => 'side',
				'theme_location'    => 'side',
				'depth'             => 2,
				'container'         => 'nav',
				'menu_class'        => 'nav nav-pills nav-stacked',
				'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				'walker'            => new wp_bootstrap_navwalker())
			);
		?>
        <hr>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

		<?php endif; ?>
    </div>
</aside>