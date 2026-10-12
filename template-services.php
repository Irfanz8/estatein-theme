<?php
/**
 * Template Name: Services Page
 *
 * Custom page template selectable from WordPress Admin Page Attributes.
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
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content', 'services' );
            endwhile;
        else :
            get_template_part( 'template-parts/content', 'services' );
        endif;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
