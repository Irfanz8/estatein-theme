<?php
/**
 * Template Name: Home Page
 * Template Post Type: page
 *
 * Comprehensive Home Page template matching the Figma design specifications.
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        // Load the modular Home Page template part
        get_template_part( 'template-parts/content', 'home' );
    endwhile;
else :
    get_template_part( 'template-parts/content', 'home' );
endif;

get_footer();
