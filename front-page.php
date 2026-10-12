<?php
/**
 * The template for displaying the front page (Home Page)
 *
 * Automatically displays the Home Page layout matching Figma specifications.
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

// Load the modular Home Page content directly on the front page
get_template_part( 'template-parts/content', 'home' );

get_footer();
