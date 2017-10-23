<div>
        <div class="container">
            <div class="row">
            <?php if(has_post_thumbnail()): ?>
                <div class="col-md-12 col-sm-12 blog-single-wrap">
                    <figure class="blog-img">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="blog">
                    </figure>
                    
                </div>
             <?php endif;?>
                <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <div class="blog-content blog-single-content clearfix">
                        <span class="postdate"><?php echo esc_attr(get_the_date('M')); ?>
                            <span><?php echo esc_attr(get_the_date('d')); ?></span>
                        </span>
                        <div class="blog-info">
                            <h3><?php the_title(); ?></h3>
                          <?php
                                the_content();

                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pinwheel' ),
                                    'after'  => '</div>',
                                ) );
                            ?>
                            
                        </div>
                    </div>
                    <!-- Blog details -->

                    <div class="blog-single-social">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 blog-category">
                                <ul class="blog-cat-lst list-inline">

                                    <?php
                                     do_action( 'pinwheel_action_tags_display' );
                                     ?>
                                </ul>
                            </div>
                           
                        </div>
                    </div>
                    <!-- blog category -->

                    <?php 
                     // Previous/next post navigation.
                    the_post_navigation( array(
                        'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'pinwheel' ) . '</span> ' .
                            '<span class="screen-reader-text">' . __( 'Next post:', 'pinwheel' ) . '</span> ' .
                            '<span class="post-title">%title</span>',
                        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'pinwheel' ) . '</span> ' .
                            '<span class="screen-reader-text">' . __( 'Previous post:', 'pinwheel' ) . '</span> ' .
                            '<span class="post-title">%title</span>',
                    ) );



                    ?>
                   
                    <!-- Comments section -->
                    <div class="clearfix"></div>

                   <?php
                   if ( comments_open() || '0' != get_comments_number() ) :
                        comments_template();
                    endif;
                   ?>
                </div>
                <!-- blog  -->
                
                
            </div>
            
        </div>
    </div>