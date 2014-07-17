<?php get_header(); ?>

	<div class="row">
		<section class="col-sm-8">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<h2><?php the_title(); ?></h2>
					<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
					<div class="entry">
						<?php the_content(); ?>
						<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>	
						<?php the_tags( 'Tags: ', ', ', ''); ?>
					</div>
					<?php edit_post_link('Edit this entry','','.'); ?>
				</article>
			<?php comments_template(); ?>
		<?php endwhile; endif; ?>
		</section>
	
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>