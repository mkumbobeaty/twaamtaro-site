<?php
/**
 * Pinwheel Theme Customizer
 *
 * @package Pinwheel
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pinwheel_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  // Load Upgrade to Pro control.
  require_once trailingslashit( get_template_directory() ) . '/inc/upgrade-to-pro/control.php';

  // Register custom section types.
  $wp_customize->register_section_type( 'Pinwheel_Customize_Section_Upsell' );

  // Register sections.
  $wp_customize->add_section(
    new Pinwheel_Customize_Section_Upsell(
      $wp_customize,
      'theme_upsell',
      array(
        'title'    => esc_html__( 'Pinwheel Pro', 'pinwheel' ),
        'pro_text' => esc_html__( 'Get Pro', 'pinwheel' ),
        'pro_url'  => 'http://www.greenturtlelab.com/downloads/pinwheel-pro-theme/',
        'priority' => 1,
      )
    )
  );
 
}
add_action( 'customize_register', 'pinwheel_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pinwheel_customize_preview_js() {
	wp_enqueue_script( 'pinwheel_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'pinwheel_customize_preview_js' );

function pinwheel_customizer_register( $wp_customize ) 
    {
      
      /**********************************************/
      /***** ADJUSTMENT OF SIDEBAR POSITION SECTION *****/
      /**********************************************/
    
      $wp_customize->add_panel( 'layout', array(
        'priority' => 160,
        'title' => __( 'Pinwheel Option', 'pinwheel' ),
        'description' => __( 'Pinwheel Theme Option', 'pinwheel' ),
      ));

    


        /**********************************************/
      /************* MAIN SLIDER SECTION *************/
      /**********************************************/     
      $wp_customize->add_section('main_slider_category',array(       
        'title' => __('Slider Categories','pinwheel'),
        'description' => __('Select the Slide Category for Home Page Slider.','pinwheel'),
        'panel' => 'layout'
      ));

       $wp_customize->add_setting('enable_slider',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'=>'disable',
        ));

       $wp_customize->add_control( 'enable_slider', array(
       'settings' => 'enable_slider',
       'label'    =>  __( 'Enable/Disable Slider', 'pinwheel' ),
       'section'  => 'main_slider_category',
       'type'     => 'radio',
       'choices'  => array(
           'enable' => __( 'Enable', 'pinwheel' ),
           'disable' => __( 'Disable', 'pinwheel' ),
                
           ),

        ) ); 

        $wp_customize->add_setting('slider_posts',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'pinwheel_sanitize_number_field',
        'default'=>'3',
        ));

       $wp_customize->add_control( 'slider_posts', array(
       'settings' => 'slider_posts',
       'label'    =>  __( 'Number Of Slider', 'pinwheel' ),
       'section'  => 'main_slider_category',
       'type'     => 'select',
       'choices'  => array(
           '1' => __( '1', 'pinwheel' ),
           '2' => __( '2', 'pinwheel' ),
           '3' => __( '3', 'pinwheel' ),
           '4' => __( '4', 'pinwheel' ),
           '5' => __( '5', 'pinwheel' ),
           '6' => __( '6', 'pinwheel' ),
           '7' => __( '7', 'pinwheel' ),
           '8' => __( '8', 'pinwheel' ),
           '9' => __( '9', 'pinwheel' ),
           '10' => __( '10', 'pinwheel' ),
           '-1' => __( 'All', 'pinwheel' ),        
                
           ),

        ) ); 

       $wp_customize->add_setting('slider_category_display',array(
        'sanitize_callback' => 'pinwheel_sanitize_category',
        'default' => '1'
      ));
      $wp_customize->add_control(new pinwheel_Customize_Dropdown_Taxonomies_Control($wp_customize,'slider_category_display',array(
        'label' => __('Choose category','pinwheel'),
        'section' => 'main_slider_category',
        'settings' => 'slider_category_display',
        'type'=> 'dropdown-taxonomies',
        )  

      ));

      $wp_customize->add_setting('slider_info',array(
        'sanitize_callback' => 'sanitize_text_field',
      ));
     $wp_customize->add_control( new  Pinwheel_Info_Text($wp_customize,'slider_info', array(
        'section'    => 'main_slider_category',
        'settings'   => 'slider_info',
        'label'     => __( 'Note:', 'pinwheel' ),  
        'description' => __( 'The Post featured image works as a slider banner and the title & content work as a slider caption. <br/> Recommended Image Size: 1920X800', 'pinwheel' ),
        )
      ));



        /**********************************************/
      /************* MAIN FEATURED SECTION *************/
      /**********************************************/     
      $wp_customize->add_section('main_featured_category',array(       
        'title' => __('Featured Categories','pinwheel'),
        'description' => __('Select the Feature Category for Home Page Feature Section.','pinwheel'),
        'panel' => 'layout'
      ));

       $wp_customize->add_setting('enable_feature',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'=>'enable',
        ));

       $wp_customize->add_control( 'enable_feature', array(
       'settings' => 'enable_feature',
       'label'    =>  __( 'Enable/Disable Feature', 'pinwheel' ),
       'section'  => 'main_featured_category',
       'type'     => 'radio',
       'choices'  => array(
           'enable' => __( 'Enable', 'pinwheel' ),
           'disable' => __( 'Disable', 'pinwheel' ),
                
           ),

        ) ); 

        $wp_customize->add_setting('feature_posts',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'pinwheel_sanitize_number_field',
        'default'=>'3',
        ));

       $wp_customize->add_control( 'feature_posts', array(
       'settings' => 'feature_posts',
       'label'    =>  __( 'Number Of Posts', 'pinwheel' ),
       'section'  => 'main_featured_category',
       'type'     => 'select',
       'choices'  => array(
           '3' => __( '3', 'pinwheel' ),
           '6' => __( '6', 'pinwheel' ),
           '9' => __( '9', 'pinwheel' ),
           ),

        ) ); 

       $wp_customize->add_setting('feature_category_display',array(
        'sanitize_callback' => 'pinwheel_sanitize_category',
        'default' => '1'
      ));
      $wp_customize->add_control(new pinwheel_Customize_Dropdown_Taxonomies_Control($wp_customize,'feature_category_display',array(
        'label' => __('Choose Feature Category','pinwheel'),
        'section' => 'main_featured_category',
        'settings' => 'feature_category_display',
        'type'=> 'dropdown-taxonomies',
        )  

      ));

      $wp_customize->add_setting('feature_info',array(
        'sanitize_callback' => 'sanitize_text_field',
      ));
     $wp_customize->add_control( new  Pinwheel_Info_Text($wp_customize,'feature_info', array(
        'section'    => 'main_featured_category',
        'settings'   => 'feature_info',
        'label'     => __( 'Note:', 'pinwheel' ),  
        'description' => __( 'The Post featured image works as a  image and the title caption. ', 'pinwheel' ),
        )
      ));


      /**********************************************/
      /************* MAIN POPULAR SECTION *************/
      /**********************************************/     
      $wp_customize->add_section('main_popular_category',array(       
        'title' => __('Popular Categories','pinwheel'),
        'description' => __('Select the Popular Category for Home Page  Popular Section.','pinwheel'),
        'panel' => 'layout'
      ));

       $wp_customize->add_setting('enable_popular',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'=>'disable',
        ));

       $wp_customize->add_control( 'enable_popular', array(
       'settings' => 'enable_popular',
       'label'    =>  __( 'Enable/Disable Popular Section', 'pinwheel' ),
       'section'  => 'main_popular_category',
       'type'     => 'radio',
       'choices'  => array(
           'enable' => __( 'Enable', 'pinwheel' ),
           'disable' => __( 'Disable', 'pinwheel' ),
                
           ),

        ) ); 

        $wp_customize->add_setting('title_popular',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'=>__( 'Popular', 'pinwheel' ),
        ));

       $wp_customize->add_control( 'title_popular', array(
       'settings' => 'title_popular',
       'label'    =>  __( 'Popular Title', 'pinwheel' ),
       'section'  => 'main_popular_category',
       'type'     => 'text',       

        ) ); 

        $wp_customize->add_setting('popular_posts',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'pinwheel_sanitize_number_field',
        'default'=>'3',
        ));

       $wp_customize->add_control( 'popular_posts', array(
       'settings' => 'popular_posts',
       'label'    =>  __( 'Number Of Posts', 'pinwheel' ),
       'section'  => 'main_popular_category',
       'type'     => 'select',
       'choices'  => array(
           '3' => __( '3', 'pinwheel' ),
           '6' => __( '6', 'pinwheel' ),
           '9' => __( '9', 'pinwheel' ),
           ),

        ) ); 

       $wp_customize->add_setting('popular_category_display',array(
        'sanitize_callback' => 'pinwheel_sanitize_category',
        'default' => '1'
      ));
      $wp_customize->add_control(new pinwheel_Customize_Dropdown_Taxonomies_Control($wp_customize,'popular_category_display',array(
        'label' => __('Choose Popular Category','pinwheel'),
        'section' => 'main_popular_category',
        'settings' => 'popular_category_display',
        'type'=> 'dropdown-taxonomies',
        )  

      ));

      $wp_customize->add_setting('popular_info',array(
        'sanitize_callback' => 'sanitize_text_field',
      ));
     $wp_customize->add_control( new  Pinwheel_Info_Text($wp_customize,'popular_info', array(
        'section'    => 'main_popular_category',
        'settings'   => 'popular_info',
        'label'     => __( 'Note:', 'pinwheel' ),  
        'description' => __( 'The Post featured image works as a  image and the title caption. ', 'pinwheel' ),
        )
      ));

    

     /**********************************************/
      /************* MAIN NEWS SECTION *************/
      /**********************************************/     
      $wp_customize->add_section('main_news_category',array(       
        'title' => __('News Categories','pinwheel'),
        'description' => __('Select the news Category for Home Page News Section.','pinwheel'),
        'panel' => 'layout'
      ));

       $wp_customize->add_setting('enable_news',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'=>'disable',
        ));

       $wp_customize->add_control( 'enable_news', array(
       'settings' => 'enable_news',
       'label'    =>  __( 'Enable/Disable News Section', 'pinwheel' ),
       'section'  => 'main_news_category',
       'type'     => 'radio',
       'choices'  => array(
           'enable' => __( 'Enable', 'pinwheel' ),
           'disable' => __( 'Disable', 'pinwheel' ),
                
           ),

        ) ); 


       $wp_customize->add_setting('title_news',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'=>__( 'News & Blog', 'pinwheel' ),
        ));

       $wp_customize->add_control( 'title_news', array(
       'settings' => 'title_news',
       'label'    =>  __( 'News Title', 'pinwheel' ),
       'section'  => 'main_news_category',
       'type'     => 'text',
      

        ) ); 

        $wp_customize->add_setting('news_posts',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'pinwheel_sanitize_number_field',
        'default'=>'3',
        ));

       $wp_customize->add_control( 'news_posts', array(
       'settings' => 'news_posts',
       'label'    =>  __( 'Number Of Posts', 'pinwheel' ),
       'section'  => 'main_news_category',
       'type'     => 'select',
       'choices'  => array(
           '3' => __( '3', 'pinwheel' ),
           '6' => __( '6', 'pinwheel' ),
           '9' => __( '9', 'pinwheel' ),
           ),

        ) ); 

       $wp_customize->add_setting('news_category_display',array(
        'sanitize_callback' => 'pinwheel_sanitize_category',
        'default' => '1'
      ));
      $wp_customize->add_control(new pinwheel_Customize_Dropdown_Taxonomies_Control($wp_customize,'news_category_display',array(
        'label' => __('Choose news Category','pinwheel'),
        'section' => 'main_news_category',
        'settings' => 'news_category_display',
        'type'=> 'dropdown-taxonomies',
        )  

      ));

      $wp_customize->add_setting('news_info',array(
        'sanitize_callback' => 'sanitize_text_field',
      ));
     $wp_customize->add_control( new  Pinwheel_Info_Text($wp_customize,'news_info', array(
        'section'    => 'main_news_category',
        'settings'   => 'news_info',
        'label'     => __( 'Note:', 'pinwheel' ),  
        'description' => __( 'The Post featured image works as a  image and the title caption. ', 'pinwheel' ),
        )
      ));

      /**********************************************/
      /************* TESTIMONIAL SECTION *************/
      /**********************************************/     
      $wp_customize->add_section('main_testimonial_category',array(       
        'title' => __('Testimonial Categories','pinwheel'),
        'description' => __('Select the Testimonial Category for Home Page Testimonial Section.','pinwheel'),
        'panel' => 'layout'
      ));

       $wp_customize->add_setting('enable_testimonial',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'=>'disable',
        ));

       $wp_customize->add_control( 'enable_testimonial', array(
       'settings' => 'enable_testimonial',
       'label'    =>  __( 'Enable/Disable Testimonial Section', 'pinwheel' ),
       'section'  => 'main_testimonial_category',
       'type'     => 'radio',
       'choices'  => array(
           'enable' => __( 'Enable', 'pinwheel' ),
           'disable' => __( 'Disable', 'pinwheel' ),
                
           ),

        ) ); 

       $wp_customize->add_setting('title_testimonial',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'default'=>__( '@GreenTurtleLab', 'pinwheel' ),
        ));

       $wp_customize->add_control( 'title_testimonial', array(
       'settings' => 'title_testimonial',
       'label'    =>  __( 'Testimonial Title', 'pinwheel' ),
       'section'  => 'main_testimonial_category',
       'type'     => 'text',
      
        ) ); 

        $wp_customize->add_setting('testimonial_posts',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'pinwheel_sanitize_number_field',
        'default'=>'3',
        ));

       $wp_customize->add_control( 'testimonial_posts', array(
       'settings' => 'testimonial_posts',
       'label'    =>  __( 'Number Of Posts', 'pinwheel' ),
       'section'  => 'main_testimonial_category',
       'type'     => 'select',
       'choices'  => array(
           '3' => __( '3', 'pinwheel' ),
           '6' => __( '6', 'pinwheel' ),
           '9' => __( '9', 'pinwheel' ),
           ),

        ) ); 

       $wp_customize->add_setting('testimonial_category_display',array(
        'sanitize_callback' => 'pinwheel_sanitize_category',
        'default' => '1'
      ));
      $wp_customize->add_control(new pinwheel_Customize_Dropdown_Taxonomies_Control($wp_customize,'testimonial_category_display',array(
        'label' => __('Choose Testimonial Category','pinwheel'),
        'section' => 'main_testimonial_category',
        'settings' => 'testimonial_category_display',
        'type'=> 'dropdown-taxonomies',
        )  

      ));

      $wp_customize->add_setting('testimonial_info',array(
        'sanitize_callback' => 'sanitize_text_field',
      ));
     $wp_customize->add_control( new  Pinwheel_Info_Text($wp_customize,'testimonial_info', array(
        'section'    => 'main_testimonial_category',
        'settings'   => 'testimonial_info',
        'label'     => __( 'Note:', 'pinwheel' ),  
        'description' => __( 'The Post featured image works as a  image  ', 'pinwheel' ),
        )
      ));

     $wp_customize->add_section('main_sidebar_category',array(       
        'title' => __('Sidebar Position','pinwheel'),
        'description' => __('Select the Testimonial Category for Home Page.','pinwheel'),
        'panel' => 'layout'
      ));


      $wp_customize->add_setting('category_sidebar_position', array(
        'sanitize_callback' => 'sanitize_text_field',
          'default' => __('right','pinwheel')
        ));
      $wp_customize->add_control('category_sidebar_position', array(
        'label'      => __('Archive Sidebar position', 'pinwheel'),
        'section'    => 'main_sidebar_category',
        'settings'   => 'category_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
          'none'   => __('None','pinwheel'),
          'left'   => __('left','pinwheel'),
          'right'  => __('right','pinwheel'),
        ),

      ));

       $wp_customize->add_setting('single_post_sidebar_position', array(
        'sanitize_callback' => 'sanitize_text_field',
          'default' => __('right','pinwheel')
        ));
      $wp_customize->add_control('single_post_sidebar_position', array(
        'label'      => __('Single Post Sidebar position', 'pinwheel'),
        'section'    => 'main_sidebar_category',
        'settings'   => 'single_post_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
          'none'   => __('None','pinwheel'),
          'left'   => __('left','pinwheel'),
          'right'  => __('right','pinwheel'),
        ),

      ));

       $wp_customize->add_setting('single_page_sidebar_position', array(
        'sanitize_callback' => 'sanitize_text_field',
          'default' => __('right','pinwheel')
        ));
      $wp_customize->add_control('single_page_sidebar_position', array(
        'label'      => __('Single Page Sidebar position', 'pinwheel'),
        'section'    => 'main_sidebar_category',
        'settings'   => 'single_page_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
          'none'   => __('None','pinwheel'),
          'left'   => __('left','pinwheel'),
          'right'  => __('right','pinwheel'),
        ),

      ));

       /**********************************************/
      /************* FOOTER SECTION *************/
      /**********************************************/     
      $wp_customize->add_section('footer_section',array(       
        'title' => __('Footer Section','pinwheel'),
        'description' => __('Change Footer Setting','pinwheel'),
        'panel' => 'layout'
      ));

       $wp_customize->add_setting('footer_setting',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
       'default'      => __('Copyright &copy; All rights reserved.', 'pinwheel'),
        ));

       $wp_customize->add_control( 'footer_setting', array(
       'settings' => 'footer_setting',
       'label'    =>  __( 'Footer Copyright Text', 'pinwheel' ),
       'section'  => 'footer_section',
       'type'     => 'text',      

        ) ); 

    }

add_action( 'customize_register', 'pinwheel_customizer_register' );


function pinwheel_sanitize_number_field($input){
  return absint(  $input  );
}

function pinwheel_sanitize_category($input){
  $output=intval( $input );
  return $output;
}


if( class_exists( 'WP_Customize_Control' ) ): 

  class Pinwheel_Info_Text extends WP_Customize_Control{

    public function render_content(){
    ?>
      <span class="customize-control-title">
      <?php echo esc_html( $this->label ); ?>
    </span>

    <?php if($this->description){ ?>
      <span class="description customize-control-description">
      <?php echo wp_kses_post($this->description); ?>
      </span>
    <?php }
    }

}

endif;

/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.4
 */
function pinwheel_customizer_control_scripts() {

  wp_enqueue_script( 'pinwheel-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

  wp_enqueue_style( 'pinwheel-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.css' );

}

add_action( 'customize_controls_enqueue_scripts', 'pinwheel_customizer_control_scripts', 0 );
