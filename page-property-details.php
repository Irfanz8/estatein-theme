<?php
/**
 * The template for displaying the Property Details page (slug: property-details)
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

// Load the modular Property Details content
get_template_part( 'template-parts/content', 'property-details' );

get_footer();
