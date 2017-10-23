<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Pinwheel
 */

get_header();?>


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
    		$sidebar = esc_attr(get_theme_mod('single_post_sidebar_position','right'));
	        if($sidebar=="none"):
	        	$class = "col-md-12  col-sm-12 ";
	        else:
	        	$class = "col-md-8  col-sm-8 ";
	        endif;

	        if($sidebar=="left"):
            		get_sidebar();
            endif;
    	?>
    		<div class="<?php echo esc_attr($class); ?> blog-wrap">
			<?php

			if ( have_posts() ) : the_post();


				 get_template_part( 'template-parts/content', 'single' ); 
				

			 endif; ?>
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
?>
