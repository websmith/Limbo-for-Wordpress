<?php	
	// Add RSS links to <head> section
	 add_theme_support( 'automatic-feed-links' );

	// Include Twitter Bootstrap
	if (!is_admin()) {

		// Load CSS
		add_action('wp_enqueue_scripts', 'twbs_load_styles', 11);
		function twbs_load_styles() {
			// Bootstrap
			wp_register_style('bootstrap-styles', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css', array(), null, 'all');
			wp_enqueue_style('bootstrap-styles');
			// Theme Styles
			wp_register_style('theme-styles', get_stylesheet_uri(), array(), null, 'all');
			wp_enqueue_style('theme-styles');
			// Font Awesome
			wp_register_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css', array(), null, 'all');
			wp_enqueue_style('font-awesome');
		}

		// Load Javascript
		add_action('wp_enqueue_scripts', 'twbs_load_scripts', 12);
		function twbs_load_scripts() {
			// jQuery
			wp_deregister_script('jquery');
			wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', array(), null, false);
			wp_enqueue_script('jquery');
			// Bootstrap
			wp_register_script('bootstrap-scripts', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array('jquery'), null, true);
			wp_enqueue_script('bootstrap-scripts');
		}

	}


	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }


	//Custom site title
	add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
	function baw_hack_wp_title_for_home( $title )
	{
		if( empty( $title ) && ( is_home() || is_front_page() ) ) {
			return __( 'Home', 'theme_domain' ) . ' | ' . get_bloginfo( 'description' );
		}
		return $title;
	}


	// Register Custom Navigation Walker
	require_once('wp_bootstrap_navwalker.php');

	register_nav_menus(array(
		'primary' => __('Top primary menu'), 
		'sidebar' => __('Sidebar Menu')
	));


	/**
	 * Bootstrap Pagination
	 * use the paging() function to add pagination to any blog list page
	*/
	function paging() {
		global $wp_query;

		$total_pages = $wp_query->max_num_pages;

		if ($total_pages > 1){
			$current_page = max(1, get_query_var('paged'));
			$count = 0;
			$previous_page = $current_page - 1;
			$next_page = $current_page + 1;
			echo '<ul class="pagination">';
			if($total_pages > 3) { 
				if($current_page > 1) echo '<li class="previous"><a href="' . get_bloginfo('url') . '/page/' . $previous_page . '/">&laquo;</a></li>' ;
			}
			while($count < $total_pages) {
				 $count = $count + 1;  
				 if($count == $current_page) echo '<li class="active"><a href="' . get_bloginfo('url') . '/page/' . $count . '/">' . $count . '</a></li>' ;
				 else echo '<li class="inactive"><a href="' . get_bloginfo('url') . '/page/' . $count . '/">' . $count . '</a></li>' ;
			}
			if($total_pages > 3) {
				if($current_page < $total_pages) echo '<li class="next"><a href="' . get_bloginfo('url') . '/page/' . $next_page . '/">&raquo;</i></a></li>';
			}

			echo '</ul>';
		}
	}


	/**
	 * Add breadcrumbs functionality
	 */
	function breadcrumbs() {
		$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter = ''; // delimiter between crumbs
		$home = 'Home'; // text for the 'Home' link
		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before = '<li class="active"><span class="current">'; // tag before the current crumb
		$after = '</span></li>'; // tag after the current crumb

		global $post;
		$homeLink = get_bloginfo('url');

		if (is_home() || is_front_page()) {

			if ($showOnHome == 1) echo '<ul class="breadcrumb"><li><a href="' . $homeLink . '">' . $home . '</a></li></ul>';

		} else {

			echo '<ul class="breadcrumb"><li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
				echo $before . '' . single_cat_title('', false) . '' . $after;

			} elseif ( is_search() ) {
				echo $before . 'Search results for "' . get_search_query() . '"' . $after;

			} elseif ( is_day() ) {
				echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
				echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li> ';
				echo $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {
				echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
				echo $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
					if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
					echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				echo $before . $post_type->labels->singular_name . $after;

			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
				echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
				if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo $before . get_the_title() . $after;

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . '</li> ';
				}
				if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

			} elseif ( is_tag() ) {
				echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . 'Articles posted by ' . $userdata->display_name . $after;

			} elseif ( is_404() ) {
				echo $before . 'Error 404' . $after;
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page') . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}

			echo '</ul>';
		}
	}


	// Add Class to Comment Reply Link
	add_filter('comment_reply_link', 'twbs_reply_link_class');
	function twbs_reply_link_class($class){
		$class = str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-default btn-xs", $class);
		return $class;
	}


	// Add Class to Gravatar
	add_filter('get_avatar', 'twbs_avatar_class');
	function twbs_avatar_class($class) {
		$class = str_replace("class='avatar", "class='avatar img-circle media-object", $class);
		return $class;
	}


	// Customize Comment Output
	function twbs_comment_format($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; 
	?>
		<li <?php comment_class('media well'); ?> id="comment-<?php comment_ID(); ?> ">
			<article>
				<div class="comment-meta pull-left">
					<?php echo get_avatar( $comment, 96 ); ?>
					<p class="text-center comment-author"><?php comment_author_link(); ?></p>
				</div> <!-- .comment-meta -->
				<div class="comment-content media-body">
					<p class="comment-date text-right text-muted pull-right"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?> &nbsp;<a class="comment-permalink" href="<?php echo htmlspecialchars (get_comment_link( $comment->comment_ID )) ?>" title="Comment Permalink"><i class="icon-link"></i></a></p>
					<?php 
						if ($comment->comment_approved == '0') { // Awaiting Moderation ?>
						<em><?php _e('Your comment is awaiting moderation.') ?></em>
					<?php } ?>
					<?php comment_text(); ?>
					<div class="reply pull-right">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="icon-reply"></i>&nbsp; Reply' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
				</div> <!-- .comment-content -->
			</article>
		</li>
	<?php 
	}

?>