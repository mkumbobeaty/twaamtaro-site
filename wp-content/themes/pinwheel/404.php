<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Pinwheel
 */

get_header(); ?>

<div class="intro-banner">
	<div class="container">
		<h2>
			<?php esc_html_e('404 Error','pinwheel') ?>
		</h2>
	</div>
</div>

<?php do_action('pinwheel_action_breadcrumb'); ?>


<div class="cart-section-lst section-padding white-bg">
        <div class="container error-404">
        
			
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'pinwheel' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try search using search form below.', 'pinwheel' ); ?></p>

					<?php
						get_search_form();
					 ?>  

					 <?php
					wp_nav_menu( array(
						'theme_location' => 'notfound',
						'depth'          => 1,
						'fallback_cb'    => false,
						'container'      => 'div',
						'container_id'   => 'quick-links-404',
						)
					);
					?>              
           		 </div>
        
        </div>
    </div>
    <!-- cart list section end -->
<?php get_footer();?>

