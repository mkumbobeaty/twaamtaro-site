<?php 
/**
 * Basic theme functions.
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package Pinwheel
 */

if ( ! function_exists( 'pinwheel_customize_search_form' ) ) :

	/**
	 * Customize search form.
	 *
	 * @since 1.0.0
	 *
	 * @return string The search form HTML output.
	 */
	function pinwheel_customize_search_form() {

		$form = '<form class="menusearch-bar search-form" role="search" method="get"  action="'. esc_url( home_url( '/' ) ).'">
		    <div class="form-group">		        
		        <i class="fa fa-search">
		            <input type="text" required="" name="s" placeholder="'. esc_attr_x('Enter Keywords', 'placeholder', 'pinwheel').'" class="form-control" value="'. get_search_query().'">
			        </i>
			    </div>
			</form>';

		return $form;

	}

endif;

add_filter( 'get_search_form', 'pinwheel_customize_search_form', 15 );


if ( ! function_exists( 'pinwheel_comment_form_fields' ) ) :

function pinwheel_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="col-md-6 col-sm-6 form-group">' . '<div class="holder">'.__("Name","pinwheel").'<span class="red">*</span></div>' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="col-md-6 col-sm-6 form-group"><div class="holder">'.__("Email","pinwheel").'
                                    <span class="red">*</span>
                                </div> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>'       
    );
    
    return $fields;
}
endif;

add_filter( 'comment_form_default_fields', 'pinwheel_comment_form_fields' );

if ( ! function_exists( 'pinwheel_comment_form' ) ) :
function pinwheel_comment_form( $args ) {
    $args['comment_field'] = '<div class="col-md-12 col-sm-12 form-group">
            <div class="holder">'.__("Message ","pinwheel").'<span class="red">*</span></div> 
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';
    $args['class_submit'] = 'btn btn-default'; // since WP 4.1
    
    return $args;
}

endif;


add_filter( 'comment_form_defaults', 'pinwheel_comment_form' );


if ( ! function_exists( 'pinwheel_header_background' ) ) :     

 function pinwheel_header_background(){

    ?>  <style type="text/css">

            .intro-banner{

                background: #f9f9f9 url('<?php header_image(); ?>');
                background-size: cover;
                 height: 250px;
                text-align: center;

                }
                <?php if(header_image()==''): ?>
                .intro-banner h2{
                    color: #343434;
                }
                <?php endif; ?>
               
    </style>

    <?php

 }
 
 endif;

 add_action( 'wp_head', 'pinwheel_header_background');
