<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pinwheel
 * @since 1.0.1
 */

get_header(); ?>

<div class="intro-banner3">
	<div class="container">
		<h2>
			
			<?php 
			echo esc_attr(get_bloginfo( 'description', 'display' ));
			 ?>
		</h2>
	</div>
</div>

 <?php do_action('pinwheel_action_breadcrumb'); ?>

<div class="cart-section-lst section-padding white-bg">
        <div class="container">
        <?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				
					<div class="section-title text-center">
		                <h2><?php single_post_title(); ?></h2>
		            </div>

            <div class="row">
			<?php
			endif;
			?>
			<div class="col-md-8  col-sm-8  blog-wrap">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			?>

               
                <?php
		                /*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;
					?>
					<div class="clearfix"></div>
					<?php

					/**
					 * Hook - nature_bliss_action_posts_navigation.
					 *
					 * @hooked: nature_bliss_custom_posts_navigation - 10
					 */
					do_action( 'pinwheel_action_posts_navigation' );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
				</div>
				<?php get_sidebar(); ?>
                
            </div>

            
        </div>
    </div>
    <!-- cart list section end -->
    <?php get_footer();?>
