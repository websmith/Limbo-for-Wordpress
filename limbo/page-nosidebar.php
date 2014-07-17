<?php 
/*
Template Name: No Sidebar
*/
?>
<?php get_header(); ?>

	<div class="row">
		<div class="col-sm-12">
			<?php if(function_exists('breadcrumbs')) breadcrumbs(); ?>
		</div>
	</div>

	<div class="row">
		<section class="col-sm-12">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
		</section>
	</div>

<?php get_footer(); ?>
