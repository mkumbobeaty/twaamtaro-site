<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Pinwheel
 * @since   1.0
 */

 /**
     * Generates attachment url and other details 
     * @return array
     */

if ( ! function_exists( 'pinwheel_get_attachment' ) ) :

function pinwheel_get_attachment( $attachment_id , $size ) {
    $image = array(
        'url' => '',
        'alt' => '',
        'caption' => '',
        'description' => '',
        'href' => '',
        'src' => '',
        'title' => ''
    );
    $thumbimg = wp_get_attachment_image_src( $attachment_id , $size );    
    $attachment = get_post( $attachment_id );
    if( is_array( $thumbimg ) ){
        $image =  array(
                    'url' => $thumbimg[0],
                    'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
                    'caption' => $attachment->post_excerpt,
                    'description' => $attachment->post_content,
                    'href' => get_permalink( $attachment->ID ),
                    'src' => $attachment->guid,
                    'title' => $attachment->post_title
                );
    }
    return $image;
}
endif;



if ( ! function_exists( 'pinwheel_recommend_plugin' ) ) :
function pinwheel_recommend_plugin() {

    $plugins[] = array(
            'name'               => 'Page Builder by SiteOrigin',
            'slug'               => 'siteorigin-panels',
            'required'           => false,
    );

    tgmpa( $plugins);

}


endif;

add_action( 'tgmpa_register', 'pinwheel_recommend_plugin' );






if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;

/**
 * Class pinwheel_Customize_Dropdown_Taxonomies_Control
 */
class pinwheel_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $type = 'dropdown-taxonomies';

  public $taxonomy = '';


  public function __construct( $manager, $id, $args = array() ) {

    $pinwheel_taxonomy = 'category';
    if ( isset( $args['taxonomy'] ) ) {
      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
      if ( true === $taxonomy_exist ) {
        $our_taxonomy = esc_attr( $args['taxonomy'] );
      }
    }
    $args['taxonomy'] = $pinwheel_taxonomy;
    $this->taxonomy = esc_attr( $pinwheel_taxonomy );

    parent::__construct( $manager, $id, $args );
  }

  public function render_content() {

    $tax_args = array(
      'hierarchical' => 0,
      'taxonomy'     => $this->taxonomy,
    );
    $all_taxonomies = get_categories( $tax_args );

    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <select <?php echo $this->link(); ?>>
            <?php
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),esc_attr_e('Select', 'pinwheel') );
             ?>
            <?php if ( ! empty( $all_taxonomies ) ): ?>
              <?php foreach ( $all_taxonomies as $key => $tax ): ?>
                <?php
                  printf('<option value="%s" %s>%s</option>', $tax->term_id, selected($this->value(), $tax->term_id, false), $tax->name );
                 ?>
              <?php endforeach ?>
           <?php endif ?>
         </select>

    </label>
    <?php
  }

}








