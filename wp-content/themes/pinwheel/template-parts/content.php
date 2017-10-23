<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pinwheel
 */

?>
 <div  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 <?php if(has_post_thumbnail()): ?>
    <figure class="blog-img">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo the_post_thumbnail_url(''); ?>" alt="">
        </a>
    </figure>
<?php endif;?> 
    <div class="blog-content clearfix">
        <span class="postdate"><?php echo esc_attr(get_the_date('M')); ?>
            <span><?php echo esc_attr(get_the_date('d')); ?></span>
        </span>
        <div class="blog-info">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="blog-link"><?php esc_attr_e('Read More ','pinwheel'); ?><i class="fa fa-long-arrow-right"></i></a>
        </div>
    </div>
</div>

