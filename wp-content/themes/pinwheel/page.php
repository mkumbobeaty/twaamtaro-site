<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pinwheel
 */

get_header(); ?>

<div class="intro-banner">
	<div class="container">
		<h2>
			<?php single_post_title(); ?>
		</h2>
	</div>
</div>

<?php do_action('pinwheel_action_breadcrumb'); ?>
<div class="cart-section-lst section-padding white-bg">
    <div class="container">
    	<div class="row">
    	<?php 
    		$sidebar = esc_attr(get_theme_mod('single_page_sidebar_position','right'));
	        if($sidebar=="none"):
	        	$class = "col-md-12  col-sm-12 ";
	        else:
	        	$class = "col-md-8  col-sm-8 ";
	        endif;

	        if($sidebar=="left"):
            		get_sidebar();
            endif;
    	?>

		<div class="<?php echo esc_attr($class); ?>  blog-wrap">
			<?php			
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			</div>
			<?php
			if($sidebar=="right"):
            		get_sidebar();
            endif;
			 ?>
			</div>
		</div>
	</div>
<?php
get_footer();
