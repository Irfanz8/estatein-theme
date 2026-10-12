<?php
/**
 * The footer template for Figma Trial Theme (Estatein)
 *
 * Contains the CTA banner, main footer links, newsletter subscription, and copyright bar.
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
    </main><!-- #primary -->

    <!-- Call to Action (CTA) Section -->
    <section class="cta-section">
        <div class="cta-abstract-bg cta-bg-left" aria-hidden="true">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cta-abstract-left.svg' ); ?>" alt="" class="cta-abstract-img" />
        </div>
        <div class="cta-abstract-bg cta-bg-right" aria-hidden="true">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cta-abstract-right.svg' ); ?>" alt="" class="cta-abstract-img" />
        </div>

        <div class="cta-container">
            <div class="cta-text-content">
                <h2 class="cta-heading">
                    <?php echo esc_html( estatein_get_page_field( 'home_cta_title', null, __( 'Start Your Real Estate Journey Today', 'figma-trial-theme' ) ) ); ?>
                </h2>
                <p class="cta-paragraph">
                    <?php echo esc_html( estatein_get_page_field( 'home_cta_desc', null, __( "Your dream property is just a click away. Whether you're looking for a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way. Take the first step towards your real estate goals and explore our available properties or get in touch with our team for personalized assistance.", 'figma-trial-theme' ) ) ); ?>
                </p>
            </div>
            <div class="cta-action">
                <a href="<?php echo esc_url( estatein_get_page_field( 'home_cta_btn_url', null, home_url( '/properties/' ) ) ); ?>" class="btn-primary-purple cta-btn">
                    <?php echo esc_html( estatein_get_page_field( 'home_cta_btn_text', null, __( 'Explore Properties', 'figma-trial-theme' ) ) ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Main Footer -->
    <footer id="colophon" class="site-footer">
        <!-- Top Footer Container -->
        <div class="footer-main-container">
            <!-- Brand & Newsletter Column -->
            <div class="footer-brand-column">
                <div class="footer-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="estatein-logo" rel="home">
                        <span class="logo-symbol" aria-hidden="true">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-emblem.png' ); ?>" alt="<?php esc_attr_e( 'Estatein Logo', 'figma-trial-theme' ); ?>" width="34" height="34" class="estatein-emblem-img" />
                        </span>
                        <span class="logo-text">Estatein</span>
                    </a>
                </div>

                <form class="footer-newsletter-form" action="#" method="post" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                    <div class="newsletter-input-group">
                        <span class="newsletter-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </span>
                        <input type="email" name="subscriber_email" placeholder="<?php esc_attr_e( 'Enter Your Email', 'figma-trial-theme' ); ?>" required class="newsletter-input" />
                        <button type="submit" class="newsletter-submit-btn" aria-label="<?php esc_attr_e( 'Subscribe', 'figma-trial-theme' ); ?>">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m22 2-7 20-4-9-9-4Z"/>
                                <path d="M22 2 11 13"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer Links Columns -->
            <div class="footer-links-grid">
                <!-- Frame 3344 (Top Row in Mobile) -->
                <div class="footer-links-row footer-links-row-top">
                    <!-- Column 1: Home -->
                    <div class="footer-links-column footer-col-home">
                        <h3 class="footer-column-title"><?php esc_html_e( 'Home', 'figma-trial-theme' ); ?></h3>
                        <ul class="footer-column-links">
                            <li><a href="<?php echo esc_url( home_url( '/#hero' ) ); ?>"><?php esc_html_e( 'Hero Section', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#features' ) ); ?>"><?php esc_html_e( 'Features', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#properties' ) ); ?>"><?php esc_html_e( 'Properties', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#testimonials' ) ); ?>"><?php esc_html_e( 'Testimonials', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#faqs' ) ); ?>"><?php esc_html_e( "FAQ's", 'figma-trial-theme' ); ?></a></li>
                        </ul>
                    </div>

                    <div class="footer-col-divider" aria-hidden="true"></div>

                    <!-- Column 2: About Us -->
                    <div class="footer-links-column footer-col-about">
                        <h3 class="footer-column-title"><?php esc_html_e( 'About Us', 'figma-trial-theme' ); ?></h3>
                        <ul class="footer-column-links">
                            <li><a href="<?php echo esc_url( home_url( '/about-us/#our-story' ) ); ?>"><?php esc_html_e( 'Our Story', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/about-us/#our-values' ) ); ?>"><?php esc_html_e( 'Our Values', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/about-us/#how-it-works' ) ); ?>"><?php esc_html_e( 'How It Works', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/about-us/#our-team' ) ); ?>"><?php esc_html_e( 'Our Team', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/about-us/#our-clients' ) ); ?>"><?php esc_html_e( 'Our Clients', 'figma-trial-theme' ); ?></a></li>
                        </ul>
                    </div>
                </div>

                <!-- Frame 3345 (Bottom Row in Mobile) -->
                <div class="footer-links-row footer-links-row-bottom">
                    <!-- Frame 3346 (Stacked Properties & Contact Us in Mobile) -->
                    <div class="footer-col-stacked">
                        <!-- Column 3: Properties -->
                        <div class="footer-links-column footer-col-properties">
                            <h3 class="footer-column-title"><?php esc_html_e( 'Properties', 'figma-trial-theme' ); ?></h3>
                            <ul class="footer-column-links">
                                <li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Portfolio', 'figma-trial-theme' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/properties/#categories' ) ); ?>"><?php esc_html_e( 'Categories', 'figma-trial-theme' ); ?></a></li>
                            </ul>
                        </div>

                        <!-- Column 5: Contact Us -->
                        <div class="footer-links-column footer-col-contact">
                            <h3 class="footer-column-title"><?php esc_html_e( 'Contact Us', 'figma-trial-theme' ); ?></h3>
                            <ul class="footer-column-links">
                                <li><a href="<?php echo esc_url( home_url( '/contact-us/#connect' ) ); ?>"><?php esc_html_e( 'Contact Form', 'figma-trial-theme' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/contact-us/#offices' ) ); ?>"><?php esc_html_e( 'Our Offices', 'figma-trial-theme' ); ?></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="footer-col-divider" aria-hidden="true"></div>

                    <!-- Column 4: Services -->
                    <div class="footer-links-column footer-col-services">
                        <h3 class="footer-column-title"><?php esc_html_e( 'Services', 'figma-trial-theme' ); ?></h3>
                        <ul class="footer-column-links">
                            <li><a href="<?php echo esc_url( home_url( '/services/#unlock-value' ) ); ?>"><?php esc_html_e( 'Valuation Mastery', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/services/#unlock-value' ) ); ?>"><?php esc_html_e( 'Strategic Marketing', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/services/#unlock-value' ) ); ?>"><?php esc_html_e( 'Negotiation Wizardry', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/services/#unlock-value' ) ); ?>"><?php esc_html_e( 'Closing Success', 'figma-trial-theme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/services/#property-management' ) ); ?>"><?php esc_html_e( 'Property Management', 'figma-trial-theme' ); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright & Socials Bar -->
        <div class="footer-bottom-bar">
            <div class="footer-bottom-inner">
                <div class="copyright-group">
                    <p class="copyright-text">
                        &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All Rights Reserved.', 'figma-trial-theme' ); ?>
                    </p>
                    <a href="<?php echo esc_url( home_url( '/#terms' ) ); ?>" class="terms-link">
                        <?php esc_html_e( 'Terms & Conditions', 'figma-trial-theme' ); ?>
                    </a>
                </div>

                <div class="social-icons-group">
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Twitter">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
                        </svg>
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="LinkedIn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                            <rect width="4" height="12" x="2" y="9"/>
                            <circle cx="4" cy="4" r="2"/>
                        </svg>
                    </a>
                    <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="YouTube">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/>
                            <polygon points="10 15 15 12 10 9 10 15" fill="#FFFFFF"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
