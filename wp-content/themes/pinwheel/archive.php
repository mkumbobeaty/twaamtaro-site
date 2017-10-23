<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pinwheel
 */



get_header(); ?>
 
<div class="intro-banner">
	<div class="container">
	<?php
	the_archive_title( '<h2 class="page-title">', '</h2>' );
	the_archive_description( '<div class="archive-description">', '</div>' );
	?>
	</div>
</div>
<?php do_action('pinwheel_action_breadcrumb'); ?>

<div class="cart-section-lst section-padding white-bg">
        <div class="container">
        <?php
        $sidebar = esc_attr(get_theme_mod('category_sidebar_position','right'));
        if($sidebar=="none"):
        	$class = "col-md-12  col-sm-12 ";
        else:
        	$class = "col-md-8  col-sm-8 ";
        endif;

		if ( have_posts() ) :
		?>		

	
			

            <div class="row">
            <?php
            	if($sidebar=="left"):
            		get_sidebar();
            	endif;
             ?>
            <div class=" <?php echo esc_attr($class); ?> blog-wrap">
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
				 <?php
            	if($sidebar=="right"):
            		get_sidebar();
            	endif;
             ?>

                
            </div>

            
        </div>
    </div>
    <!-- cart list section end -->
    <?php get_footer();?>
