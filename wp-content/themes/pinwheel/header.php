<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pinwheel
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header id="header" class="header-fixed">
       
        <!-- top header -->

        <div class="navbar navbar-default navbar-fixed-top">             
            <div class=" container-fluid gtl-container gtl-clearfix">
                    <div class="gtl-site-branding">
                        <?php 
                        if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
                            the_custom_logo();
                        else : 
                            ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                           
                            <p class="site-description"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'description' ); ?></a></p>
                        <?php endif; ?>
                    </div><!-- .site-branding -->

                    <nav id="gtl-site-navigation" class="gtl-main-navigation">
                        <div class="toggle-bar"><span></span></div>
                         <?php 
                            wp_nav_menu( array( 
                                'theme_location' => 'primary', 
                                'menu_class'     => 'gtl-menu',
                                'container'      => 'div',
                                'container_class'=> 'gtl-menu',
                                'items_wrap'     => '<ul id="%1$s">%3$s</ul>',
                                'walker'         => '',
                                'fallback_cb'    => 'wp_page_menu',

                            ) ); 
                        ?>
                    </nav><!-- #ht-site-navigation -->


                </div>
        </div>
        <!-- Main header -->
    </header>
    <!-- Header -->

   
