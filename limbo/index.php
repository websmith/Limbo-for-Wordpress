<?php get_header(); ?>

	<div class="row">
		<section class="col-sm-8 posts-list">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?> </a>
				<div class="entry article-wrap">
					<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>						
					<?php the_excerpt(); ?>
				</div>
			</article>
			<?php endwhile; ?>
			<div class="cl"></div>
			<?php paging(); ?>
			<?php else : ?>
			<h2>Not Found</h2>
			<?php endif; ?>

			<div class="cl"></div>
		</section>

	<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>