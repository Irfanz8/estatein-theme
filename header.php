<?php
/**
 * The header template for Figma Trial Theme (Estatein)
 *
 * Displays the Top Banner, Main Navigation Bar, and open <main id="primary">
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class( 'figma-dark-theme' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site-wrapper">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'figma-trial-theme' ); ?></a>


    <!-- Main Navigation Bar -->
    <header id="masthead" class="site-header">
        <div class="header-container">
            <!-- Brand Logo -->
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="estatein-logo" rel="home">
                    <span class="logo-symbol" aria-hidden="true">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-emblem.png' ); ?>" alt="<?php esc_attr_e( 'Estatein Logo', 'figma-trial-theme' ); ?>" width="34" height="34" class="estatein-emblem-img" />
                    </span>
                    <span class="logo-text">Estatein</span>
                </a>
            </div>

            <!-- Hamburger Button for Mobile -->
            <button type="button" id="menu-toggle" class="mobile-menu-toggle" aria-controls="primary-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'figma-trial-theme' ); ?>">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>

            <!-- Navigation Links -->
            <nav id="primary-navigation" class="site-navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'figma-trial-theme' ); ?>">
                <?php
                if ( has_nav_menu( 'primary-menu' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary-menu',
                        'menu_id'        => 'nav-menu-list',
                        'menu_class'     => 'nav-links-list',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ) );
                } else {
                    ?>
                    <ul class="nav-links-list">
                        <li class="menu-item <?php echo ( is_front_page() || is_page_template( 'template-home.php' ) ) ? 'active' : ''; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'figma-trial-theme' ); ?></a></li>
                        <li class="menu-item <?php echo ( is_page( 'about-us' ) || is_page_template( 'template-about-us.php' ) ) ? 'active' : ''; ?>"><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About Us', 'figma-trial-theme' ); ?></a></li>
                        <li class="menu-item <?php echo ( is_page( 'properties' ) || is_page_template( 'template-properties.php' ) || is_page( 'property-details' ) || is_page_template( 'template-property-details.php' ) ) ? 'active' : ''; ?>"><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Properties', 'figma-trial-theme' ); ?></a></li>
                        <li class="menu-item <?php echo ( is_page( 'services' ) || is_page_template( 'template-services.php' ) ) ? 'active' : ''; ?>"><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'figma-trial-theme' ); ?></a></li>
                    </ul>
                    <?php
                }
                ?>
            </nav>

            <!-- Header Action Button -->
            <div class="header-action">
                <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="btn-contact-nav <?php echo ( is_page( 'contact-us' ) || is_page( 'contact' ) || is_page_template( 'template-contact-us.php' ) || is_page_template( 'template-contact.php' ) ) ? 'active' : ''; ?>">
                    <?php esc_html_e( 'Contact Us', 'figma-trial-theme' ); ?>
                </a>
            </div>
        </div>
    </header>

    <main id="primary" class="site-main-content">
