<?php
/**
 * Template Name: Contact Us Page
 *
 * Dedicated template for displaying the Contact Us page (/contact-us/)
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
        // Load modular Contact page content component
        get_template_part( 'template-parts/content', 'contact' );
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
