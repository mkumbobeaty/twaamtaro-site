<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Pinwheel
 */

if ( ! function_exists( 'pinwheel_custom_posts_navigation' ) ) :

	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
	function pinwheel_custom_posts_navigation() {
		
		the_posts_pagination( array(
                            'mid_size' => 2,
                            'prev_text' => __( '<span aria-hidden="true">&laquo;</span>', 'pinwheel' ),
                            'next_text' => __( '<span aria-hidden="true">&raquo;</span>', 'pinwheel' ),
                        ) );

	}
endif;

add_action( 'pinwheel_action_posts_navigation', 'pinwheel_custom_posts_navigation' );

if ( ! function_exists( 'pinwheel_custom_tags_display' ) ) :

	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
	function pinwheel_custom_tags_display() {


	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
	    /* Translators: used between list items, there is a space after the comma. */
	    $categories_list = get_the_category_list( esc_html__( ', ', 'pinwheel' ) );
	    if ( $categories_list && pinwheel_categorized_blog() ) {
	        printf( '<li>%1$s</li>', $categories_list ); // WPCS: XSS OK.
	    }

	    /* Translators: used between list items, there is a space after the comma. */
	    $tags_list = get_the_tag_list( '', esc_html__( ', ', 'pinwheel' ) );
	    if ( $tags_list ) {
	        printf( '<li>%1$s</li>', $tags_list ); // WPCS: XSS OK.
	    }
	}
	}
	endif;

	add_action( 'pinwheel_action_tags_display', 'pinwheel_custom_tags_display' );

if ( ! function_exists( 'pinwheel_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function pinwheel_simple_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/inc/lib/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		breadcrumb_trail( $breadcrumb_args );

	}

endif;

if ( ! function_exists( 'pinwheel_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function pinwheel_add_breadcrumb() {
		
		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb"> <div class="container">';

		
				pinwheel_simple_breadcrumb();
		
		

		echo '</div></div><!-- #breadcrumb -->';

	}

endif;

add_action( 'pinwheel_action_breadcrumb', 'pinwheel_add_breadcrumb' );



