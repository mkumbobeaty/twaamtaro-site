<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pinwheel
 */

?>

	
 <footer class="white-bg-1">
        <div class="footer-top section-padding font-14">
            <div class="container">
                <div class="row">
                 <?php dynamic_sidebar( 'footer-sidebar' ); ?>
                   
                </div>
            </div>
            
        </div>
        <div class="container">
            <div class="footer-btm">
                <div class="row">
                    <div class="col-sm-6 copyright">
                        <span><?php echo esc_attr(get_theme_mod('footer_section',esc_attr_e('Copyright &copy; All rights reserved.','pinwheel'))) ?></span>
                    </div>
                    <div class="col-sm-6">
                        <div class="paypal ">
                            <?php echo  sprintf( esc_html__( 'Pinwheel by %s', 'pinwheel' ), '<a target="_blank"  href="">' . esc_html__( 'ThemeName', 'pinwheel' ) . '</a>' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->
    
    <a href="#" class="scrollToTop" title="click here for top"><i aria-hidden="true" class="fa fa-long-arrow-up"></i></a>
    <!-- Scroll Top -->
  <?php wp_footer(); ?>
</body>

</html>

