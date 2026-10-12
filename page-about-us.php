<?php
/**
 * Template Name: About Us Page
 *
 * Dedicated template for displaying the About Us page (/about-us/)
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
        // Load the modular About Us content component
        get_template_part( 'template-parts/content', 'about-us' );
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
