<?php
/**
 * Template part for displaying Contact Page content
 *
 * Implements the Figma "Contact Page - Desktop" specifications:
 * 1. Hero Section & Contact Channels (top: 162px)
 * 2. Let's Connect Form (top: 954px)
 * 3. Discover Our Office Locations with Tabs (top: 2178px)
 * 4. Explore Estatein's World Gallery (top: 3153px)
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="contact-page-content">

    <!-- ======================================================================
         1. Contact Hero & Quick Channels Bar (top: 162px)
         ====================================================================== -->
    <section class="contact-hero-section">
        <!-- Banner Title & Paragraph -->
        <div class="contact-hero-banner">
            <div class="theme-container contact-banner-inner">
                <h1 class="contact-hero-title">
                    <?php echo esc_html( estatein_get_page_field( 'contact_hero_title', null, __( 'Get in Touch with Estatein', 'figma-trial-theme' ) ) ); ?>
                </h1>
                <p class="contact-hero-description">
                    <?php echo esc_html( estatein_get_page_field( 'contact_hero_desc', null, __( "Welcome to Estatein's Contact Us page. We're here to assist you with any inquiries, requests, or feedback you may have. Whether you're looking to buy or sell a property, explore investment opportunities, or simply want to learn more about our services, we're just a message away. Reach out to us today, and let's start a conversation.", 'figma-trial-theme' ) ) ); ?>
                </p>
            </div>
        </div>

        <?php
        $c_email = estatein_get_page_field( 'contact_email', null, 'info@estatein.com' );
        $c_phone = estatein_get_page_field( 'contact_phone', null, '+1 (123) 456-7890' );
        $c_hq    = estatein_get_page_field( 'contact_hq_address', null, __( 'Main Headquarters', 'figma-trial-theme' ) );
        ?>
        <!-- 4 Quick Communication Channels Bar -->
        <div class="contact-channels-container">
            <div class="theme-container">
                <div class="contact-channels-strip">
                    <!-- Channel 1: Email -->
                    <a href="mailto:<?php echo esc_attr( $c_email ); ?>" class="channel-card">
                        <div class="channel-arrow-wrap" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                        <div class="channel-icon-outer">
                            <div class="channel-icon-inner">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                            </div>
                        </div>
                        <span class="channel-label-text"><?php echo esc_html( $c_email ); ?></span>
                    </a>

                    <!-- Channel 2: Phone -->
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9\+]/', '', $c_phone ) ); ?>" class="channel-card">
                        <div class="channel-arrow-wrap" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                        <div class="channel-icon-outer">
                            <div class="channel-icon-inner">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </div>
                        </div>
                        <span class="channel-label-text"><?php echo esc_html( $c_phone ); ?></span>
                    </a>

                    <!-- Channel 3: Main Headquarters -->
                    <a href="#offices" class="channel-card">
                        <div class="channel-arrow-wrap" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                        <div class="channel-icon-outer">
                            <div class="channel-icon-inner">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                        <span class="channel-label-text"><?php echo esc_html( $c_hq ); ?></span>
                    </a>

                    <!-- Channel 4: Socials -->
                    <div class="channel-card channel-socials-card">
                        <div class="channel-arrow-wrap" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                        <div class="channel-icon-outer">
                            <div class="channel-icon-inner">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="18" cy="5" r="3"></circle>
                                    <circle cx="6" cy="12" r="3"></circle>
                                    <circle cx="18" cy="19" r="3"></circle>
                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                </svg>
                            </div>
                        </div>
                        <div class="channel-social-links">
                            <a href="https://instagram.com" target="_blank" rel="noopener" class="channel-social-link"><?php esc_html_e( 'Instagram', 'figma-trial-theme' ); ?></a>
                            <a href="https://linkedin.com" target="_blank" rel="noopener" class="channel-social-link"><?php esc_html_e( 'LinkedIn', 'figma-trial-theme' ); ?></a>
                            <a href="https://facebook.com" target="_blank" rel="noopener" class="channel-social-link"><?php esc_html_e( 'Facebook', 'figma-trial-theme' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================================================================
         2. Let's Connect Form Section (top: 954px)
         ====================================================================== -->
    <section id="connect" class="contact-form-section">
        <div class="theme-container">
            <!-- Section Header -->
            <div class="section-header-wrap">
                <div class="abstract-star-cluster" aria-hidden="true">
                    <span class="star-icon star-lg">✦</span>
                    <span class="star-icon star-md">✦</span>
                    <span class="star-icon star-sm">✦</span>
                </div>
                <h2 class="section-heading">
                    <?php echo esc_html( estatein_get_page_field( 'contact_form_title', null, __( "Let's Connect", 'figma-trial-theme' ) ) ); ?>
                </h2>
                <p class="section-description">
                    <?php echo esc_html( estatein_get_page_field( 'contact_form_desc', null, __( "We're excited to connect with you and learn more about your real estate goals. Use the form below to get in touch with Estatein. Whether you're a prospective client, partner, or simply curious about our services, we're here to answer your questions and guide you through your journey.", 'figma-trial-theme' ) ) ); ?>
                </p>
            </div>

            <!-- Form Card Box (border: 1px solid #262626; padding: 100px) -->
            <div class="contact-form-card">
                <form class="estatein-contact-form" action="#" method="post" onsubmit="event.preventDefault(); alert('Thank you for reaching out! A member of the Estatein team will be in touch shortly.');">
                    <!-- Row 1: 3 Columns -->
                    <div class="form-row-three-col">
                        <div class="contact-form-group">
                            <label for="contact-first-name" class="contact-field-label">
                                <?php esc_html_e( 'First Name', 'figma-trial-theme' ); ?>
                            </label>
                            <input type="text" id="contact-first-name" name="first_name" required placeholder="<?php esc_attr_e( 'Enter First Name', 'figma-trial-theme' ); ?>" class="contact-input-field" />
                        </div>
                        <div class="contact-form-group">
                            <label for="contact-last-name" class="contact-field-label">
                                <?php esc_html_e( 'Last Name', 'figma-trial-theme' ); ?>
                            </label>
                            <input type="text" id="contact-last-name" name="last_name" required placeholder="<?php esc_attr_e( 'Enter Last Name', 'figma-trial-theme' ); ?>" class="contact-input-field" />
                        </div>
                        <div class="contact-form-group">
                            <label for="contact-email" class="contact-field-label">
                                <?php esc_html_e( 'Email', 'figma-trial-theme' ); ?>
                            </label>
                            <input type="email" id="contact-email" name="email" required placeholder="<?php esc_attr_e( 'Enter your Email', 'figma-trial-theme' ); ?>" class="contact-input-field" />
                        </div>
                    </div>

                    <!-- Row 2: 3 Columns -->
                    <div class="form-row-three-col">
                        <div class="contact-form-group">
                            <label for="contact-phone" class="contact-field-label">
                                <?php esc_html_e( 'Phone', 'figma-trial-theme' ); ?>
                            </label>
                            <input type="tel" id="contact-phone" name="phone" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'figma-trial-theme' ); ?>" class="contact-input-field" />
                        </div>
                        <div class="contact-form-group">
                            <label for="contact-inquiry-type" class="contact-field-label">
                                <?php esc_html_e( 'Inquiry Type', 'figma-trial-theme' ); ?>
                            </label>
                            <div class="select-dropdown-wrap">
                                <select id="contact-inquiry-type" name="inquiry_type" class="contact-select-field">
                                    <option value="" disabled selected><?php esc_html_e( 'Select Inquiry Type', 'figma-trial-theme' ); ?></option>
                                    <option value="buying"><?php esc_html_e( 'Property Buying', 'figma-trial-theme' ); ?></option>
                                    <option value="selling"><?php esc_html_e( 'Property Selling', 'figma-trial-theme' ); ?></option>
                                    <option value="consultation"><?php esc_html_e( 'Real Estate Consultation', 'figma-trial-theme' ); ?></option>
                                    <option value="management"><?php esc_html_e( 'Property Management', 'figma-trial-theme' ); ?></option>
                                    <option value="investment"><?php esc_html_e( 'Investment Advisory', 'figma-trial-theme' ); ?></option>
                                </select>
                                <span class="select-chevron" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                                </span>
                            </div>
                        </div>
                        <div class="contact-form-group">
                            <label for="contact-referral" class="contact-field-label">
                                <?php esc_html_e( 'How Did You Hear About Us?', 'figma-trial-theme' ); ?>
                            </label>
                            <div class="select-dropdown-wrap">
                                <select id="contact-referral" name="referral" class="contact-select-field">
                                    <option value="" disabled selected><?php esc_html_e( 'Select', 'figma-trial-theme' ); ?></option>
                                    <option value="google"><?php esc_html_e( 'Google Search', 'figma-trial-theme' ); ?></option>
                                    <option value="social"><?php esc_html_e( 'Social Media', 'figma-trial-theme' ); ?></option>
                                    <option value="friend"><?php esc_html_e( 'Referral from a Friend', 'figma-trial-theme' ); ?></option>
                                    <option value="advertisement"><?php esc_html_e( 'Online Advertisement', 'figma-trial-theme' ); ?></option>
                                    <option value="other"><?php esc_html_e( 'Other', 'figma-trial-theme' ); ?></option>
                                </select>
                                <span class="select-chevron" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: 1 Column Full Width Message -->
                    <div class="form-row-full-col">
                        <div class="contact-form-group">
                            <label for="contact-message" class="contact-field-label">
                                <?php esc_html_e( 'Message', 'figma-trial-theme' ); ?>
                            </label>
                            <textarea id="contact-message" name="message" required rows="5" placeholder="<?php esc_attr_e( 'Enter your Message here...', 'figma-trial-theme' ); ?>" class="contact-textarea-field"></textarea>
                        </div>
                    </div>

                    <!-- Row 4: Terms Checkbox & Submit Button -->
                    <div class="contact-form-bottom-bar">
                        <label class="contact-checkbox-container">
                            <input type="checkbox" required name="agree_terms" class="contact-checkbox-control" />
                            <span class="custom-checkbox-box" aria-hidden="true"></span>
                            <span class="checkbox-label-text">
                                <?php esc_html_e( 'I agree with Terms of Use and Privacy Policy', 'figma-trial-theme' ); ?>
                            </span>
                        </label>
                        <button type="submit" class="btn-primary-purple btn-contact-submit">
                            <?php esc_html_e( 'Send Message', 'figma-trial-theme' ); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ======================================================================
         3. Discover Our Office Locations Section (top: 2178px)
         ====================================================================== -->
    <section id="offices" class="contact-offices-section">
        <div class="theme-container">
            <!-- Section Header -->
            <div class="section-header-wrap">
                <div class="abstract-star-cluster" aria-hidden="true">
                    <span class="star-icon star-lg">✦</span>
                    <span class="star-icon star-md">✦</span>
                    <span class="star-icon star-sm">✦</span>
                </div>
                <h2 class="section-heading">
                    <?php echo esc_html( estatein_get_page_field( 'contact_offices_title', null, __( 'Discover Our Office Locations', 'figma-trial-theme' ) ) ); ?>
                </h2>
                <p class="section-description">
                    <?php echo esc_html( estatein_get_page_field( 'contact_offices_desc', null, __( "Estatein is here to serve you across multiple locations. Whether you're looking to meet our team in person, explore properties locally, or need specialized advice, find the office closest to you and get in touch with our expert representatives.", 'figma-trial-theme' ) ) ); ?>
                </p>
            </div>

            <!-- Filter Tabs Strip (All, Regional, International) -->
            <div class="offices-tabs-wrapper">
                <div class="offices-tabs-pill-box" role="tablist">
                    <button type="button" class="office-tab-btn is-active" role="tab" aria-selected="true" data-filter="all">
                        <?php esc_html_e( 'All', 'figma-trial-theme' ); ?>
                    </button>
                    <button type="button" class="office-tab-btn" role="tab" aria-selected="false" data-filter="regional">
                        <?php esc_html_e( 'Regional', 'figma-trial-theme' ); ?>
                    </button>
                    <button type="button" class="office-tab-btn" role="tab" aria-selected="false" data-filter="international">
                        <?php esc_html_e( 'International', 'figma-trial-theme' ); ?>
                    </button>
                </div>
            </div>

            <!-- Offices 2-Card Grid -->
            <div class="offices-cards-grid">
                <!-- Office 1: Main Headquarters -->
                <div class="office-location-card" data-category="regional international all">
                    <div class="office-card-header">
                        <span class="office-type-tag"><?php esc_html_e( 'Main Headquarters', 'figma-trial-theme' ); ?></span>
                        <h3 class="office-address-title"><?php esc_html_e( '123 Estatein Plaza, City Center, Metropolis', 'figma-trial-theme' ); ?></h3>
                        <p class="office-card-description">
                            <?php esc_html_e( 'Our flagship headquarters offers full-service real estate consultation, investment analysis, and private meeting rooms for high-profile client transactions.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <!-- Meta Tags / Contact Pills -->
                    <div class="office-contact-pills">
                        <a href="mailto:info@estatein.com" class="office-contact-pill">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                            <span>info@estatein.com</span>
                        </a>
                        <a href="tel:+11234567890" class="office-contact-pill">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            <span>+1 (123) 456-7890</span>
                        </a>
                        <span class="office-contact-pill">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <span><?php esc_html_e( 'Metropolis', 'figma-trial-theme' ); ?></span>
                        </span>
                    </div>

                    <a href="https://maps.google.com" target="_blank" rel="noopener" class="btn-primary-purple btn-office-direction">
                        <?php esc_html_e( 'Get Direction', 'figma-trial-theme' ); ?>
                    </a>
                </div>

                <!-- Office 2: Regional Office -->
                <div class="office-location-card" data-category="regional all">
                    <div class="office-card-header">
                        <span class="office-type-tag"><?php esc_html_e( 'Regional Office', 'figma-trial-theme' ); ?></span>
                        <h3 class="office-address-title"><?php esc_html_e( '456 Luxury Way, Palm Harbor, Coastal City', 'figma-trial-theme' ); ?></h3>
                        <p class="office-card-description">
                            <?php esc_html_e( 'Specializing in premium coastal properties, vacation rentals, and seaside estates. Visit our boutique office for personalized regional market insights.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <!-- Meta Tags / Contact Pills -->
                    <div class="office-contact-pills">
                        <a href="mailto:coastal@estatein.com" class="office-contact-pill">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                            <span>coastal@estatein.com</span>
                        </a>
                        <a href="tel:+11237890123" class="office-contact-pill">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            <span>+1 (123) 789-0123</span>
                        </a>
                        <span class="office-contact-pill">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <span><?php esc_html_e( 'Coastal City', 'figma-trial-theme' ); ?></span>
                        </span>
                    </div>

                    <a href="https://maps.google.com" target="_blank" rel="noopener" class="btn-primary-purple btn-office-direction">
                        <?php esc_html_e( 'Get Direction', 'figma-trial-theme' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================================================================
         4. Explore Estatein's World Photo Gallery Section (top: 3153px)
         ====================================================================== -->
    <section class="contact-gallery-section">
        <div class="theme-container">
            <div class="gallery-showcase-box">
                <!-- Abstract Design Background Wave -->
                <div class="gallery-backdrop-abstract" aria-hidden="true">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/abstract-design-1.svg' ); ?>" alt="" class="gallery-wave-img" />
                </div>

                <!-- Top Gallery Row (Grid of 5 curated photos) -->
                <div class="gallery-top-grid">
                    <!-- Left Column: 2 stacked images (width 708.5px) -->
                    <div class="gallery-stacked-col">
                        <div class="gallery-image-frame frame-h236">
                            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80" alt="<?php esc_attr_e( 'Estatein Modern Lounge', 'figma-trial-theme' ); ?>" class="gallery-photo" loading="lazy" decoding="async" />
                        </div>
                        <div class="gallery-image-frame frame-h236">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=80" alt="<?php esc_attr_e( 'Estatein Executive Office', 'figma-trial-theme' ); ?>" class="gallery-photo" loading="lazy" decoding="async" />
                        </div>
                    </div>

                    <!-- Right Column: 1 top image + 2 side-by-side images -->
                    <div class="gallery-stacked-col">
                        <div class="gallery-image-frame frame-h236">
                            <img src="https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?auto=format&fit=crop&w=1200&q=80" alt="<?php esc_attr_e( 'Estatein Reception Space', 'figma-trial-theme' ); ?>" class="gallery-photo" loading="lazy" decoding="async" />
                        </div>
                        <div class="gallery-sub-row-two">
                            <div class="gallery-image-frame frame-h236 frame-sub-half">
                                <img src="https://images.unsplash.com/photo-1600573472550-8090b5e0745e?auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e( 'Estatein Meeting Room', 'figma-trial-theme' ); ?>" class="gallery-photo" loading="lazy" decoding="async" />
                            </div>
                            <div class="gallery-image-frame frame-h236 frame-sub-half">
                                <img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e( 'Estatein Architecture', 'figma-trial-theme' ); ?>" class="gallery-photo" loading="lazy" decoding="async" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Row: Text content on left (708.5px) + 6th featured image on right (708.5px) -->
                <div class="gallery-bottom-split">
                    <div class="gallery-text-col">
                        <div class="abstract-star-cluster" aria-hidden="true">
                            <span class="star-icon star-lg">✦</span>
                            <span class="star-icon star-md">✦</span>
                            <span class="star-icon star-sm">✦</span>
                        </div>
                        <h2 class="gallery-main-heading">
                            <?php esc_html_e( "Explore Estatein's World", 'figma-trial-theme' ); ?>
                        </h2>
                        <p class="gallery-description">
                            <?php esc_html_e( 'Step inside the world of Estatein, where luxury meets craftsmanship. Take a look at our premier offices, client lounges, and modern design spaces designed to inspire your future property aspirations.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <div class="gallery-image-frame frame-h280">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80" alt="<?php esc_attr_e( 'Estatein Architectural Showcase', 'figma-trial-theme' ); ?>" class="gallery-photo" loading="lazy" decoding="async" />
                    </div>
                </div>
            </div>
        </div>
    </section>

</div><!-- .contact-page-content -->
