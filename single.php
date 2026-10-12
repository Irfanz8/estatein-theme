<?php
/**
 * Single post fallback template
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( get_post_type() === 'property' ) {
    get_template_part( 'single-property' );
    return;
}

get_header();

while ( have_posts() ) :
    the_post();
    ?>
    <div class="theme-container" style="padding: 60px 0;">
        <h1><?php the_title(); ?></h1>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
    <?php
endwhile;

get_footer();
