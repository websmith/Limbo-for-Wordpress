<!DOCTYPE html>
<html>	
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.png">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-114x114.png">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/responsive.css">

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	
	<!-- Scripts -->
	<script src="<?php bloginfo('template_directory'); ?>/js/site.js"></script>

	<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

	<body <?php body_class(); ?>>
		<div class="container">
			<header>
				<div class="row">
					<div class="col-sm-3 logo">
						<a href="<?php bloginfo('wpurl'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="Logo" class="img-responsive"></a>
					</div>

					<div class="col-sm-9">           
						<nav class="navbar navbar-default" role="navigation">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex1-collapse">
									<span class="sr-only">Toggle Navigation</span>
									<span class="glyphicon glyphicon-tasks"></span>
								</button>
								<a class="navbar-brand" href="#">Menu</a>
							</div>
							<?php
								wp_nav_menu( array(
									'menu'              => 'primary',
									'theme_location'    => 'primary',
									'depth'             => 2,
									'container'         => 'div',
									'container_class'   => 'collapse navbar-collapse',
									'container_id'      => 'navbar-ex1-collapse',
									'menu_class'        => 'nav navbar-nav',
									'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									'walker'            => new wp_bootstrap_navwalker())
								);
							?>
							<div class="cl"></div>
						</nav>
					</div>

					<div class="cl"></div>
				</div>
			</header>        

			<hr>

			<section role="main" id="main">