<?php
/**
 * Template Name: Home Template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pinwheel
 * @since 1.0.1
 */

get_header(); ?>

    <?php 
        $enable = esc_attr(get_theme_mod('enable_slider','disable'));
        if($enable =='enable'):
        $categoryid  = esc_attr(get_theme_mod('slider_category_display','1'));
        $number = esc_attr(get_theme_mod('slider_posts','3'));

     ?>
    
    <div class="banner-section">
        <div id="carousel-example-generic" class="carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
            <?php
                $args = array(
                  'paged' => 1,
                  'cat' => $categoryid,
                  'posts_per_page' => $number,
                );
                $loop = new WP_Query($args);

                $i = -1;
                if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                $i++;
              ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo esc_attr($i); ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>"></li>
                 <?php  endwhile; wp_reset_postdata();    endif;  ?> 
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- First slide -->
                <?php
                $args = array(
                  'paged' => 1,
                  'cat' => $categoryid,
                   'posts_per_page' => $number,
                );
                $loop = new WP_Query($args);

                $i = -1;
                if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'pinwheel-slider-thumb' );
                $i++;
              ?>
                <div class="item <?php echo $i == 0 ? 'active' : ''; ?>">
                    <img class="img-100" src="<?php the_post_thumbnail_url('pinwheel-slider-thumb'); //echo esc_url($image[0]); ?>" alt="">
                    <span class="overlay banner-ovarlay"></span>
                    <div class="container">
                        <div class="carousel-caption">
                            <h2 data-animation="animated bounceInLeft">
                           <?php esc_attr(the_title()); ?>
                            </h2>
                            <a href="<?php esc_url(the_permalink()); ?>" data-animation="animated zoomInUp"></a>
                        </div>
                    </div>
                </div>
                <!-- /.item -->
                <?php  endwhile; wp_reset_postdata();    endif;  ?> 

               


            </div>
            <!-- /.carousel-inner -->
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only"><?php esc_attr_e('Previous','pinwheel') ?></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only"><?php esc_attr_e('Next','pinwheel'); ?></span>
            </a>
        </div>
       
    </div>
    <!-- Banner -->
    <?php 
    endif;
    ?>

     <?php 
        $enable = esc_attr(get_theme_mod('enable_feature','enable'));
        if($enable =='enable'):
        
        $categoryid  = esc_attr(get_theme_mod('feature_category_display','1'));
        $number = esc_attr(get_theme_mod('feature_posts','3'));

     ?>
    
    <div class="latest-collection">
        <div class="container-fluid">
            <div class="row">
             <?php
                $args = array(
                  'paged' => 1,
                  'cat' => $categoryid,
                   'posts_per_page' => $number,
                );
                $loop = new WP_Query($args);

                $i = -1;
                if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'pinwheel-feature-thumb' );
                $i++;
              ?>

                <div class="col-sm-4 col-pad-10 text-center">
                    <div class="collection-item white-bg-1">
                        <h3><?php esc_attr(the_title()); ?></h3>
                        <figure>
                            <a href="<?php esc_url(the_permalink()); ?>">
                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php esc_attr(the_title()); ?>">
                            </a>
                        </figure>
                    </div>
                </div>
                 <?php  endwhile; wp_reset_postdata();    endif;  ?> 

               
            </div>
        </div>
    </div>
    <!-- Latest Collection -->
    <?php 
    endif;
    ?>
    <?php 
        $enable = esc_attr(get_theme_mod('enable_popular','disable'));
        if($enable =='enable'):
        
        $categoryid  = esc_attr(get_theme_mod('popular_category_display','1'));
        $number = esc_attr(get_theme_mod('popular_posts','3'));

        $title = esc_attr(get_theme_mod('title_popular',__( 'Popular', 'pinwheel' )));

     ?>

    <div class="popular-products section-padding white-bg">
        <div class="container">
            <div class="section-title text-center">
                <h2><?php echo $title; ?></h2>
            </div>
            <div class="row">
            <?php
                $args = array(
                  'paged' => 1,
                  'cat' => $categoryid,
                   'posts_per_page' => $number,
                );
                $loop = new WP_Query($args);

                $i = -1;
                if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'pinwheel-popular-thumb' );
                $i++;
              ?>

                <div class="col-md-4 col-sm-6 text-center mb-50">
                    <figure class="pop-img">
                        <a href="<?php esc_url(the_permalink()); ?>">
                            <img src="<?php echo esc_url($image[0]); ?>" alt="">
                        </a>
                    </figure>
                    <div class="pop-caption">
                        <h4><a href="<?php esc_url(the_permalink()); ?>"><?php esc_attr(the_title()); ?></a></h4>
                        
                    </div>
                </div>
              <?php  endwhile; wp_reset_postdata();    endif;  ?> 
              
            </div>
        </div>
    </div>
    <!-- Popular Products -->

    <?php 
    endif;
    ?>
     <?php 
        $enable = esc_attr(get_theme_mod('enable_news','disable'));
        if($enable =='enable'):
        
        $categoryid  = esc_attr(get_theme_mod('news_category_display','1'));
        $number = esc_attr(get_theme_mod('news_posts','3'));
         $title = esc_attr(get_theme_mod('title_news',__( 'News & Blog', 'pinwheel' )));

     ?>

    <div class="news-updates white-bg section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h2><?php echo $title; ?></h2>
            </div>
            <div class="row">
              <?php
                $args = array(
                  'paged' => 1,
                  'cat' => $categoryid,
                   'posts_per_page' => $number,
                );
                $loop = new WP_Query($args);

                $i = -1;
                if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'pinwheel-news-thumb' );
                $i++;
              ?>
                <div class="col-md-4">
                    <figure class="news-img mb-20">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image[0]); ?>" alt=""></a>
                    </figure>
                    <div class="news-caption font-16"><h4><?php the_title(); ?></h4>
                        <?php the_excerpt(); ?>
                        <a class="news-link" href="<?php the_permalink(); ?>"<?php esc_attr_e('>Read More','pinwheel') ?></a>
                    </div>
                </div>
            <?php  endwhile; wp_reset_postdata();    endif;  ?> 
              
            </div>
        </div>
    </div>
    <!-- News and updates -->

    <?php 
    endif;
    ?>
    <?php 
        $enable = esc_attr(get_theme_mod('enable_testimonial','disable'));
        if($enable =='enable'):
        
        $categoryid  = esc_attr(get_theme_mod('testimonial_category_display','1'));
        $number = esc_attr(get_theme_mod('testimonial_posts','9'));
        $title = esc_attr(get_theme_mod('title_testimonial',__( '@GreenTurtleLab', 'pinwheel' )));

     ?>

    <div class="instagram-section white-bg section-padding">
        <div class="container-fluid no-padding">
            <div class="section-title text-center">
                <h2><em><?php echo $title; ?></em></h2>
            </div>
            
            <div class="row row-instagram">
                <ul>
                 <?php
                $args = array(
                  'paged' => 1,
                  'cat' => $categoryid,
                   'posts_per_page' => $number,
                );
                $loop = new WP_Query($args);

                $i = -1;
                if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'pinwheel-testimonial-thumb' );
                $i++;
              ?>
                    <li><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image[0]); ?>" alt=""></a></li>
                <?php  endwhile; wp_reset_postdata();    endif;  ?> 
                </ul>
            </div>
        </div>
    </div>
    <!-- Instagram section -->
 <?php 
    endif;
 ?>
    
   <?php get_footer(); ?>