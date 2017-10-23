<?php
if ( ! class_exists( 'Pinwheel_Services' ) ) :

class Pinwheel_Services extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'pinwheel_services_widget', 'description' => __( 'Show the services', 'pinwheel') );
        parent::__construct(false, $name = __('Pinwheel: Services', 'pinwheel'), $widget_ops);
		$this->alt_option_name = 'pinwheel_services_widget';
		
    }
	
	function form($instance) {
		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$subtitle     	= isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : '';
		$category  		= isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : absint( 0 );
		$number  		= isset( $instance['number'] ) ? esc_attr( $instance['number'] ) : absint( 3 );
					
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('Title', 'pinwheel'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php esc_attr_e('SubTitle', 'pinwheel'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
	</p>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) )?>"><strong><?php echo esc_html( 'Select Category: ', 'pinwheel' ); ?></strong></label>
	<?php
		$cat_args = array(
			'orderby'	=> 'name',
			'hide_empty'	=> 0,
			'id'	=> $this->get_field_id( 'category' ),
			'name'	=> $this->get_field_name( 'category' ),
			'class'	=> 'widefat',
			'taxonomy'	=> 'category',
			'selected'	=> absint( $category ),
			'show_option_all'	=> esc_html__( 'All Categories', 'pinwheel' )
		);
		wp_dropdown_categories( $cat_args );
	?>
	</p>
	<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_attr_e( 'Number Of Posts To Show', 'pinwheel' ); ?></label>
	
	<select class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>">
	
	<option value="3" <?php if($number=='3'): echo "selected"; endif; ?> ><?php esc_attr_e('3','pinwheel') ?></option>
	<option value="6" <?php if($number=='6'): echo "selected"; endif; ?> ><?php esc_attr_e('6','pinwheel') ?></option>
	<option value="9" <?php if($number=='9'): echo "selected"; endif; ?> ><?php esc_attr_e('9','pinwheel') ?></option>
			
	</select>
	</p>	

	

	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			= sanitize_text_field($new_instance['title']);
		$instance['subtitle'] 		= sanitize_text_field($new_instance['subtitle']);
		$instance['category'] 		= absint($new_instance['category']);
		$instance['number'] 		= absint($new_instance['number']);
						

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
		$category = isset( $instance['category'] ) ? esc_attr($instance['category']) : absint( 0 );
		$subtitle = isset( $instance['subtitle'] ) ? esc_attr($instance['subtitle']) : '';
		$number = isset( $instance['number'] ) ? esc_attr($instance['number']) : absint( 3 );
		

		$servicesquery = new WP_Query( array(
			'posts_per_page'	  => $number,
			'category__in'		  => $category,
			'post_type'			  =>'post'
		) );

	echo $args['before_widget'];

		if ($servicesquery->have_posts()) :?>


	<div class="gap"></div>	
		<div class="pw-feature">
			<div class="team-component">
				<h2><?php echo $title; ?></h2>
				<p><?php echo $subtitle; ?></p>
			</div>
		    <div class="container">
		        <div class="row">
		        <?php while($servicesquery->have_posts()): $servicesquery->the_post(); ?>
		            <div class="col-sm-4 col-md-4">
		                <div class="item-norm">
		                <?php if(has_post_thumbnail()): ?>
                    		<div class="media-sect">
		                        <img src="<?php the_post_thumbnail_url(); ?>">
		                    </div>
		                <?php endif;?>
		                    <div class="excerpt">
		                        <h3>
		                           <?php the_title(); ?>
		                        </h3>
		                      
		                        <p>
		                          <?php the_excerpt(); ?>
		                        </p>
		                    </div>
		                </div>
		            </div>
		           <?php endwhile; wp_reset_postdata(); ?>
		          
		           
		        </div>
		    </div>
		</div>
		<div class="gap"></div>
		

		<?php endif;	
	echo $args['after_widget'];
	}
	
}
endif;