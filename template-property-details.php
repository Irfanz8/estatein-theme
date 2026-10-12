<?php
/**
 * Template Name: Property Details
 * Template Post Type: page, post, property
 *
 * Comprehensive Property Details Page template matching the Figma design specifications.
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

// Load the modular property details content part
get_template_part( 'template-parts/content', 'property-details' );

get_footer();
