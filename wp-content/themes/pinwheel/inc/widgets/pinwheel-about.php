<?php
if ( ! class_exists( 'Pinwheel_About' ) ) :

class Pinwheel_About extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'pinwheel_About_widget', 'description' => __( 'Show the About', 'pinwheel') );
        parent::__construct(false, $name = __('Pinwheel: About', 'pinwheel'), $widget_ops);
		$this->alt_option_name = 'pinwheel_About_widget';
		
    }
	
	function form($instance) {
		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$subtitle     	= isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : '';
		$content  		= isset( $instance['content'] ) ? esc_attr( $instance['content'] ) : '';
		$image_id  		= isset( $instance['image_id'] ) ? esc_attr( $instance['image_id'] ) : '';
					
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('Title', 'pinwheel'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php esc_attr_e('SubTitle', 'pinwheel'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
	</p>
	

	<p><label for="<?php echo $this->get_field_id('content'); ?>"><?php esc_attr_e('Content', 'pinwheel'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea></p>
	
	<div class="gt-input-group gt-input-image">
         
     <label for="<?php  echo $this->get_field_id('image_uri');  ?>"><?php   esc_attr_e('Image','pinwheel'); ?></label>
     <br />
    <div class="image-holder">
     <?php 
       
        $imageUrl = '';
        if($image_id){
          $image = pinwheel_get_attachment( $image_id , 'thumbnail');
          $imageUrl = $image['url']; 
        }
             echo '<img class="custom_media_image" src="' . $imageUrl . '"/>';
         
      ?>
     </div>
     <p>
     <input   type="hidden" class="custom_media_id widefat" name="<?php  echo $this->get_field_name('image_id'); ?>"  value="<?php  echo $image_id;   ?>">
     <input  type="button" id="<?php  echo 'media-'.rand(1,10000000);  ?>" class="button button-primary custom_media_button widefat" name="<?php  echo $this->get_field_name('image_uri');  ?>" value="<?php  esc_attr_e('Select Image','pinwheel'); ?>" />   
     </p>     
     </div>
	

	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			= sanitize_text_field($new_instance['title']);
		$instance['subtitle'] 		= sanitize_text_field($new_instance['subtitle']);
		$instance['content'] 		= sanitize_text_field($new_instance['content']);
		$instance['image_id'] 		= absint($new_instance['image_id']);
						

		return $instance;
	}
		
	// display widget
	function widget($args, $instance) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$content = isset( $instance['content'] ) ? esc_attr($instance['content']) : '';
		$subtitle = isset( $instance['subtitle'] ) ? esc_attr($instance['subtitle']) : '';
		
		  $image_id = isset( $instance['image_id'] ) ? esc_attr($instance['image_id']) : '';      
            if( $image_id ){
               $image = pinwheel_get_attachment( $instance['image_id'] , '');
               $image_url = $image['url'];
               $image_alt = $image['alt'];
            }else{
            	$image_url = "";
            }


		echo $args['before_widget'];

		
	?>

	<div class="pw-about">
    <div class="container">
        <div class="row">
	            <div class="col-sm-6 col-md-6">
	            <?php if(!empty($image_url)): ?>
	                <div class="media-sect">
	                    <img src="<?php echo $image_url; ?>" class="img-responsive">
	                </div>
	             <?php endif; ?>
	            </div>
	            <div class="col-sm-6 col-md-6">
	                <div class="excerpt">
	                    <h3>
	                       <?php echo $title; ?>
	                    </h3>
	                    <h5>
	                       <?php echo $subtitle; ?>
	                    </h5>
	                    <p>
	                       <?php echo $content; ?>
	                    </p>
	                   
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="gap"></div>

	
	<?php echo $args['after_widget'];
	}
	
}
endif;