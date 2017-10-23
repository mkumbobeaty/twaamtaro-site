<?php
	/**
 * Registers a new setting for 'Primary Color' in the WordPress Theme Customizer
 * that will allow users to change the color of their anchors across the
 * entire site
 *
 * @param      object    $wp_customize    The WordPress Theme Customizer
 * @package    tannistha
 */

function tannistha_register_theme_customizer( $wp_customize ) {

	/**
   	 * Adds the setting with the unique id of 'tannistha_primary_color'. 
   	 *
   	 * Also defines the transport method to 'postMessage' so that 
   	 * we can use JavaScript to dynamically change the color without 
   	 * using the default method of 'refresh.'
   	 */

	//radio button sanitization function
  function tannistha_sanitize_radio( $input, $setting ) {
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
    //get the list of possible radio box options
    $choices = $setting->manager->get_control( $setting->id )->choices;
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
  }

  //checkbox sanitization function
  function tannistha_sanitize_checkbox( $input ) {
    //returns true if checkbox is checked
    return ( isset( $input ) ? true : false );
  }

  //select sanitization function
  function tannistha_sanitize_select( $input, $setting ) {
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
    //get the list of possible select options
    $choices = $setting->manager->get_control( $setting->id )->choices;
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
  }

	$wp_customize->add_setting(
		'tannistha_primary_color',
		array(
			'default'     => '#10498C',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'   => 'postMessage'
		)
  	);
	/**
   	 * Introduces a new color control to the Theme Customizer in the
	 * 'Colors' section. This is the actual control that will allow
	 * a user to pick a color.
	 */
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
			    'label'      => __( 'Primary Color', 'tannistha' ),
			    'section'    => 'colors',
			    'settings'   => 'tannistha_primary_color'
			)
		)
	);

	/**
   	 * Adds the setting with the unique id of 'tannistha_secondary_color'. 
   	 *
   	 * Also defines the transport method to 'postMessage' so that 
   	 * we can use JavaScript to dynamically change the color without 
   	 * using the default method of 'refresh.'
   	 */
	$wp_customize->add_setting(
		'tannistha_secondary_color',
		array(
			'default'     => '#4b4b4b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'   => 'postMessage'
		)
  );
	/**
   	 * Introduces a new color control to the Theme Customizer in the
	 * 'Colors' section. This is the actual control that will allow
	 * a user to pick a color.
	 */
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color',
			array(
			    'label'      => __( 'Secondary Color', 'tannistha' ),
			    'section'    => 'colors',
			    'settings'   => 'tannistha_secondary_color'
			)
		)
	);

	/**
	 * Hover Color
	 */
	$wp_customize->add_setting(
		'tannistha_hover_color',
		array(
			'default'     => '#ff5d5d',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'   => 'postMessage'
		)
  );
	/**
   	 * Introduces a new color control to the Theme Customizer in the
	 * 'Colors' section. This is the actual control that will allow
	 * a user to pick a color.
	 */
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'hover_color',
			array(
			    'label'      => __( 'Hover Color', 'tannistha' ),
			    'section'    => 'colors',
			    'settings'   => 'tannistha_hover_color'
			)
		)
	);

	/*Header Text Customizer Code*/
	//adding section in wordpress customizer   
	$wp_customize->add_section('tannistha_header_settings_section', array(
	  'title'          => __( 'Header Section', 'tannistha' )
	));
	//banner heading text
	$wp_customize->add_setting('tannistha_banner_heading', array(
	 'default'        => __( 'Enter banner heading text here', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_text_field',
	 'transport'         => 'postMessage',
	));
	//banner description text
	$wp_customize->add_setting('tannistha_banner_description', array(
	 'default'        => __( 'Enter banner description text here', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_text_field',
	 'transport'         => 'postMessage',
	));
	$wp_customize->add_control('tannistha_banner_heading', array(
	 'label'   => __( 'Banner Heading Text', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_text_field',
	 'section' => 'tannistha_header_settings_section',
	 'type'    => 'text',
	));
	$wp_customize->add_control('tannistha_banner_description', array(
	 'label'   => __( 'Banner Description Text', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_textarea_field',
	 'section' => 'tannistha_header_settings_section',
	 'type'    => 'textarea',
	));

/*Footer Customizer Code*/
	//adding section in wordpress customizer   
	$wp_customize->add_section('tannistha_footer_settings_section', array(
	  'title'          => __( 'Footer Section', 'tannistha' )
	));
	//adding setting for footer copyright text area
	$wp_customize->add_setting('tannistha_copyright_text', array(
	 'default'        => __( 'Enter copyright text here', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_textarea_field',
	 'transport'         => 'postMessage',
	));
	$wp_customize->add_control('tannistha_copyright_text', array(
	 'label'   => __( 'Footer Copyright Text', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_textarea_field',
	 'section' => 'tannistha_footer_settings_section',
	 'type'    => 'textarea',
	));

/*Blog Customizer Code*/
	//adding section in wordpress customizer   
	$wp_customize->add_section('tannistha_blog_settings_section', array(
	  'title'          => __( 'Single Blog Section', 'tannistha' )
	));
	//adding setting for blog banner heading
	$wp_customize->add_setting('tannistha_blog_banner_heading', array(
	 'default'        => __( 'Enter Blog Banner Heading Here', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_text_field',
	 'transport'         => 'postMessage',
	));
	//adding setting for blog banner description
	$wp_customize->add_setting('tannistha_blog_banner_description', array(
	 'default'        => __( 'Enter Blog Banner Description Here', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_text_field',
	 'transport'         => 'postMessage',
	));
	$wp_customize->add_control('tannistha_blog_banner_heading', array(
	 'label'   => __( 'Single Blog Banner Heading', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_text_field',
	 'section' => 'tannistha_blog_settings_section',
	 'type'    => 'text',
	));
	$wp_customize->add_control('tannistha_blog_banner_description', array(
	 'label'   => __( 'Single Blog Banner Description', 'tannistha' ),
	 'sanitize_callback' => 'sanitize_textarea_field',
	 'section' => 'tannistha_blog_settings_section',
	 'type'    => 'textarea',
	));
	//adding setting for blog banner
	$wp_customize->add_setting('tannistha_blog_banner', array(
	 'sanitize_callback' => 'esc_url_raw',
	 'transport'         => 'postMessage',
	 'default'    => get_template_directory_uri() . '/images/blog-banner.jpg',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'tannistha_blog_banner',array(
	 'label'      => __( 'Single Blog Banner ( 1583px X 270px )', 'tannistha' ),
	 'sanitize_callback' => 'esc_url_raw',
	 'section'    => 'tannistha_blog_settings_section',
	 'settings'   => 'tannistha_blog_banner',
	)));

/*Page Layout Customizer Code*/
	//adding section in wordpress customizer   
	$wp_customize->add_section('tannistha_layout_section', array(
	  'title'          => __( 'Layout Section', 'tannistha' )
	));
	$wp_customize->add_setting( 'tannistha_post_layout', array(
		'title'          => __( 'post_layout_with_right_sidebar', 'tannistha' ),
		'sanitize_callback' => 'tannistha_sanitize_radio',
		'default'   => __( 'post_layout_with_right_sidebar', 'tannistha' ),
	  'transport'         => 'postMessage',
  ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tannistha_post_layout', array(
      'label'     => __( 'Post Layout', 'tannistha' ),
      'sanitize_callback' => 'tannistha_sanitize_radio',
      'section'   => 'tannistha_layout_section',
      'settings'  => 'tannistha_post_layout',
      'transport'   => 'refresh',
      'type'      => 'radio',
      'choices'   => array(
						          'post_layout_with_left_sidebar'   => __( 'Post Layout with Left Sidebar', 'tannistha' ),
						          'post_layout_with_right_sidebar'   => __( 'Post Layout with Right Sidebar', 'tannistha' ),
						          'post_layout_without_sidebar'   => __( 'Post Layout without Sidebar', 'tannistha' )
						        ),
  ) ) );
  $wp_customize->add_setting( 'tannistha_page_layout', array(
		'title'          => __( 'page_layout_with_right_sidebar', 'tannistha' ),
		'sanitize_callback' => 'tannistha_sanitize_radio',
		'default'   => __( 'page_layout_with_right_sidebar', 'tannistha' ),
	  'transport'         => 'postMessage',
  ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tannistha_page_layout', array(
      'label'     => __( 'Page Layout', 'tannistha' ),
      'sanitize_callback' => 'tannistha_sanitize_radio',
      'section'   => 'tannistha_layout_section',
      'settings'  => 'tannistha_page_layout',
      'transport'   => 'refresh',
      'type'      => 'radio',
      'choices'   => array(
          'page_layout_with_left_sidebar'   => __( 'Page Layout with Left Sidebar', 'tannistha' ),
          'page_layout_with_right_sidebar'   => __( 'Page Layout with Right Sidebar', 'tannistha' ),
          'page_layout_without_sidebar'   => __( 'Page Layout without Sidebar', 'tannistha' )
          ),
  ) ) );

} // end tannistha_register_theme_customizer
add_action( 'customize_register', 'tannistha_register_theme_customizer' );
/**
 * Registers the Theme Customizer Preview JavaScript with WordPress.
 *
 * @package tannistha
 */
function tannistha_customizer_live_preview() {
	wp_enqueue_script(
		'tannistha-customize-preview',
		get_template_directory_uri() . '/js/tannistha-customize-preview.js',
		array( 'jquery', 'customize-preview' ),
		'1.1',
		true
	);
} // end tannistha_customizer_live_preview
add_action( 'customize_preview_init', 'tannistha_customizer_live_preview' );