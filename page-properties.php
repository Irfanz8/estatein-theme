<?php
/**
 * Template Name: Properties Page
 *
 * Dedicated template for displaying the Properties catalog page (/properties/)
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<div id="primary" class="content-area site-main-area">
    <main id="main" class="site-main">
        <?php
        // Load the modular Properties content component
        get_template_part( 'template-parts/content', 'properties' );
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
