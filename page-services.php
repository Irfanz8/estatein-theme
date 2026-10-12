<?php
/**
 * Template Name: Services Page
 *
 * Dedicated template for displaying the Services page (/services/)
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
        // Load the modular Services content component
        get_template_part( 'template-parts/content', 'services' );
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
