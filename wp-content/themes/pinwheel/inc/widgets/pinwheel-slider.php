<?php 
if ( ! class_exists( 'Pinwheel_Slider' ) ) :

class Pinwheel_Slider extends WP_Widget{

    /**
     * Register widget with WordPress.
     */
     public function __construct(){
          parent::__construct(
               'gt_banner_widget_34',
               __('Pinwheel: Banner', 'pinwheel'),
               array( 'description' => 'This show banner' ),
               array( 'classname'=> '' )
          );
     }

    
      /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
     public function form( $instance ){ 

      $title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
      $subtitle     = isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : '';
      $image_id     = isset( $instance['image_id'] ) ? esc_attr( $instance['image_id'] ) : '';
      $btn1         = isset( $instance['btn1'] ) ? esc_attr( $instance['btn1'] ) : '';
      $btnlink1     = isset( $instance['btnlink1'] ) ? esc_url( $instance['btnlink1'] ) : '';
      $btn2         = isset( $instance['btn2'] ) ? esc_attr( $instance['btn2'] ) : '';
      $btnlink2     = isset( $instance['btnlink2'] ) ? esc_url( $instance['btnlink2'] ) : '';



           ?>
         <div class="gt-input-group">
         <p>
             <label for="<?php  echo $this->get_field_id('title');  ?>"><?php  esc_attr_e('Title','pinwheel'); ?></label><br />
             <input class="widefat"  type="text" name="<?php  echo $this->get_field_name('title');  ?>" id="<?php  echo $this->get_field_id('title');  ?>" value="<?php echo $title;    ?>"  />
          </p>
         </div>

         <div class="gt-input-group">
         <p>
             <label for="<?php  echo $this->get_field_id('subtitle');  ?>"><?php  esc_attr_e('Subtitle','pinwheel'); ?></label><br />
             <input class="widefat"  type="text" name="<?php  echo $this->get_field_name('subtitle');  ?>" id="<?php  echo $this->get_field_id('subtitle');  ?>" value="<?php  echo $subtitle;  ?>"   />
             </p>
            
         </div>
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

             <div class="gt-input-group">
             <p>
               <label for="<?php  echo $this->get_field_id('btn1');  ?>"><?php  esc_attr_e('Button 1','pinwheel'); ?></label>
               <textarea class="widefat"  name="<?php  echo $this->get_field_name('btn1');  ?>" id="<?php  echo $this->get_field_id('btn1');  ?>"  ><?php  echo $btn1;  ?></textarea>
               </p>
            </div>

             <div class="gt-input-group">
             <p>
               <label for="<?php  echo $this->get_field_id('btnlink1');  ?>"><?php  esc_attr_e('Button Link','pinwheel'); ?></label>
               <textarea class="widefat"  name="<?php  echo $this->get_field_name('btnlink1');  ?>" id="<?php  echo $this->get_field_id('btnlink1');  ?>"  ><?php  echo $btnlink1;   ?></textarea>
               </p>
            </div>

            <div class="gt-input-group">
             <p>
               <label for="<?php  echo $this->get_field_id('btn2');  ?>"><?php  esc_attr_e('Button 2','pinwheel'); ?></label>
               <textarea class="widefat"  name="<?php  echo $this->get_field_name('btn2');  ?>" id="<?php  echo $this->get_field_id('btn2');  ?>"  ><?php  echo $btn2;   ?></textarea>
               </p>
            </div>

             <div class="gt-input-group">
             <p>
               <label for="<?php  echo $this->get_field_id('btnlink2');  ?>"><?php  esc_attr_e('Button Link','pinwheel'); ?></label>
               <textarea class="widefat"  name="<?php  echo $this->get_field_name('btnlink2');  ?>" id="<?php  echo $this->get_field_id('btnlink2');  ?>"  ><?php  echo $btnlink2;   ?></textarea>
               </p>
            </div>
     
              
          <?php 
     }

     /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
     public function update( $new_instance, $instance ){
          $instance = $old_instance;
          $instance['title']        = sanitize_text_field($new_instance['title']);
          $instance['subtitle']     = sanitize_text_field($new_instance['subtitle']);
          $instance['image_id']     = absint($new_instance['image_id']);
          $instance['btn1']         = sanitize_text_field($new_instance['btn1']);
          $instance['btnlink1']     = esc_url_raw($new_instance['btnlink1']);
          $instance['btn2']         = sanitize_text_field($new_instance['btn2']);
          $instance['btnlink2']     = esc_url_raw($new_instance['btnlink2']);
          return $instance;
     }


      /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
     public function widget( $args, $instance ){
       
            if ( ! isset( $args['widget_id'] ) ) {
              $args['widget_id'] = $this->id;
            }
            extract($args);


            $title    = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
            $title    = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $subtitle = isset( $instance['subtitle'] ) ? esc_attr($instance['subtitle']) : '';
            $image_id = isset( $instance['image_id'] ) ? esc_attr($instance['image_id']) : '';      
            if( $image_id ){
               $image = pinwheel_get_attachment( $instance['image_id'] , '');
               $image_url = $image['url'];
               $image_alt = $image['alt'];
            }else{
              $image_url = "";
            }
            $btn1     = isset( $instance['btn1'] ) ? esc_attr($instance['btn1']) : ''; 
            $btnlink1 = isset( $instance['btnlink1'] ) ? esc_url($instance['btnlink1']) : ''; 
            $btn2     = isset( $instance['btn2'] ) ? esc_attr($instance['btn2']) : ''; 
            $btnlink2 = isset( $instance['btnlink2'] ) ? esc_url($instance['btnlink2']) : ''; 
             
       
             echo $args['before_widget'];
               ?>        

              <div class="v-banner">
              <?php if($image_url): ?>          
                      <img src="<?php  echo $image_url;  ?>" alt="<?php  $image_alt;  ?>"> 
              <?php endif;?>  
                <div class="container">
                    <div class="content content-lt">
                        <h1>
                           <?php echo $title; ?>
                        </h1>
                        <h3>
                           <?php  echo $subtitle; ?>
                        </h3>
                        <div class="btn-group">
                        <?php if($btn1): ?>
                            <a href="<?php echo $btnlink1; ?>" class="btn-theme"><?php echo $btn1; ?></a>
                          <?php endif;?>
                           <?php if($btn2): ?>
                            <a href="<?php echo $btnlink2; ?>" class="btn-theme"><?php echo $btn2; ?></a>
                          <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>

          <?php 
          echo $args['after_widget'];
         
     }


    
}
endif;
