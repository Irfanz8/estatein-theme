<?php
/**
 * The template for displaying single Property posts
 *
 * Implements the Figma "Property Details Page - Desktop" design specifications.
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
        // Load the modular property details content part
        get_template_part( 'template-parts/content', 'property-details' );
    endwhile;
else :
    get_template_part( 'template-parts/content', 'property-details' );
endif;

get_footer();
