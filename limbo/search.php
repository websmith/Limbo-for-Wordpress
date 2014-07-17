<?php get_header(); ?>

<div class="row">
	<section class="col-sm-8 posts-list">
		<?php if (have_posts()) : ?>
		<h2>Search Results</h2>
		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			<div class="entry">
				<?php the_excerpt(); ?>
			</div>
		</div>
		<?php endwhile; ?>
		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
		<?php else : ?>
		<h2>No posts found.</h2>
		<?php endif; ?>
	</section>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
