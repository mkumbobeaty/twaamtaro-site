<?php
/**
 * Template Name: Page Builder Template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pinwheel
 * @since 1.0.2
 */

get_header(); ?>



            <?php           
            while ( have_posts() ) : the_post();

               the_content();

               
            endwhile; // End of the loop.
            ?>

 <?php get_footer(); ?>