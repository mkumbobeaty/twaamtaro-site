<?php
if ( ! class_exists( 'Pinwheel_CTA' ) ) :

class Pinwheel_CTA extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'pinwheel_cta_widget', 'description' => __( 'Display a call to action block.', 'pinwheel') );
        parent::__construct(false, $name = __('Pinwheel : Call to action', 'pinwheel'), $widget_ops);
		$this->alt_option_name = 'pinwheel_cta_widget';
    }
	
	function form($instance) {
		$title     			= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		 $image_id     = isset( $instance['image_id'] ) ? esc_attr( $instance['image_id'] ) : '';		
		$action_text 		= isset( $instance['action_text'] ) ? esc_textarea( $instance['action_text'] ) : '';
		$action_btn_link 	= isset( $instance['action_btn_link'] ) ? esc_url( $instance['action_btn_link'] ) : '';
		$action_btn_text 	= isset( $instance['action_btn_text'] ) ? esc_html( $instance['action_btn_text'] ) : '';
		$inline 			= isset( $instance['inline'] ) ? (bool) $instance['inline'] : false;
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('Title', 'pinwheel'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

	<div class="gt-input-group gt-input-image">
         
     <label for="<?php  echo $this->get_field_id('image_uri');  ?>"><?php   esc_attr_e('Image','pinwheel'); ?></label>
     <br />
    <div class="image-holder">
     <?php 
        //$image_id = $instance['image_id']; 
        $imageUrl = '';
        if($image_id){
          $image = pinwheel_get_attachment( $image_id , 'thumbnail');
          $imageUrl = $image['url']; 
        }
             echo '<img class="custom_media_image" src="' . $imageUrl . '"/>';
         
      ?>
     </div>
     <p>
     <input   type="hidden" class="custom_media_id widefat" name="<?php  echo $this->get_field_name('image_id'); ?>"  value="<?php echo $image_id;   ?>">
     <input  type="button" id="<?php  echo 'media-'.rand(1,10000000);  ?>" class="button button-primary custom_media_button widefat" name="<?php  echo $this->get_field_name('image_uri');  ?>" value="<?php  esc_attr_e('Select Image','pinwheel'); ?>" />   
     </p>     
     </div>
	<p><label for="<?php echo $this->get_field_id('action_text'); ?>"><?php esc_attr_e('Enter your call to action.', 'pinwheel'); ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('action_text'); ?>" name="<?php echo $this->get_field_name('action_text'); ?>"/></p>
	<p><label for="<?php echo $this->get_field_id('action_btn_link'); ?>"><?php esc_attr_e('Link for the button', 'pinwheel'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('action_btn_link'); ?>" name="<?php echo $this->get_field_name('action_btn_link'); ?>" type="text" value="<?php echo $action_btn_link; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('action_btn_text'); ?>"><?php esc_attr_e('Title for the button', 'pinwheel'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('action_btn_text'); ?>" name="<?php echo $this->get_field_name('action_btn_text'); ?>" type="text" value="<?php echo $action_btn_text; ?>" /></p>
	<p><input class="checkbox" type="checkbox" <?php checked( $inline ); ?> id="<?php echo $this->get_field_id( 'inline' ); ?>" name="<?php echo $this->get_field_name( 'inline' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'inline' ); ?>"><?php esc_attr_e( 'Open In New Tab', 'pinwheel' ); ?></label></p>
	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['image_id']     	 = absint($new_instance['image_id']);
		$instance['title'] 			 = sanitize_text_field($new_instance['title']);
		$instance['action_btn_link'] = esc_url_raw($new_instance['action_btn_link']);
		$instance['action_btn_text'] = sanitize_text_field($new_instance['action_btn_text']);
		$instance['inline'] 		 = isset( $new_instance['inline'] ) ? (bool) $new_instance['inline'] : false;
		$instance['action_text']	 = sanitize_text_field($new_instance['action_text']);
		  
		  
		return $instance;
	}
	
	function widget($args, $instance) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		extract($args);

		$title 			 = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title 			 = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$action_text 	 = isset( $instance['action_text'] ) ? $instance['action_text'] : '';
		$action_btn_link = isset( $instance['action_btn_link'] ) ? esc_url($instance['action_btn_link']) : '';
		$action_btn_text = isset( $instance['action_btn_text'] ) ? esc_html($instance['action_btn_text']) : '';
		$inline 		 = isset( $instance['inline'] ) ? $instance['inline'] : false;
		if ($inline == 1) {
			$target = " target='_blank' ";
		} else {
			$target = '';
		}

		  $image_id = isset( $instance['image_id'] ) ? esc_attr($instance['image_id']) : '';      
            if( $image_id ){
               $image = pinwheel_get_attachment( $instance['image_id'] , '');
               $image_url = $image['url'];
               $image_alt = $image['alt'];
            }else{
            	$image_url="";
            }

		echo $args['before_widget'];

		
?>
       <div class="pw-cta">
       <?php if(!empty($image_url)): ?>
	    <img src="<?php echo $image_url; ?>">
	   <?php endif; ?>
	    <div class="content content-ct">
	        <h1>
	           <?php echo $title ?>
	        </h1>
	        <h3>
	           <?php echo $action_text; ?>
	        </h3>
	        <a href="<?php echo $action_btn_link; ?>" <?php echo $target; ?> class="btn-theme"><?php echo $action_btn_text; ?></a>
	    </div>
	</div>
	<?php

		echo $args['after_widget'];

	}
	
}
endif;