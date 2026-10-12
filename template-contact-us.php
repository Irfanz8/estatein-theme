<?php
/**
 * Template Name: Contact Us Template
 *
 * Page template for assigning in WP admin to any page intended to display Contact content
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
                get_template_part( 'template-parts/content', 'contact' );
            endwhile;
        else :
            get_template_part( 'template-parts/content', 'contact' );
        endif;
        ?>
    </main>
</div>

<?php
get_footer();
