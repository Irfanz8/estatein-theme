<?php
/**
 * Template part for displaying Property Details content
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$current_id    = get_the_ID();
if ( ! $current_id && isset( $GLOBALS['post']->ID ) ) {
    $current_id = $GLOBALS['post']->ID;
}
$is_cpt        = ( get_post_type( $current_id ) === 'property' || is_singular( 'property' ) || ( is_preview() && ( get_post_type( $current_id ) === 'revision' || get_post_type( $current_id ) === 'property' ) ) );

$raw_title     = get_the_title( $current_id );
$prop_title    = ( ! empty( $raw_title ) && $raw_title !== 'Auto Draft' ) ? $raw_title : ( $is_cpt ? get_the_title( $current_id ) : 'Seaside Serenity Villa' );
$prop_price    = estatein_get_property_field( 'property_price', $current_id, '$1,250,000' );
$prop_location = estatein_get_property_field( 'property_location', $current_id, 'Malibu, California' );
$prop_bedrooms = estatein_get_property_field( 'property_bedrooms', $current_id, '04' );
$prop_bathrooms= estatein_get_property_field( 'property_bathrooms', $current_id, '03' );
$prop_area     = estatein_get_property_field( 'property_area', $current_id, '2,500 Sq. Ft' );
$prop_desc     = estatein_get_property_field( 'property_description', $current_id );
if ( empty( $prop_desc ) ) {
    $prop_desc = get_the_content( null, false, $current_id ) ?: get_the_excerpt( $current_id );
}
if ( empty( $prop_desc ) && isset( $GLOBALS['post']->post_excerpt ) && ! empty( $GLOBALS['post']->post_excerpt ) ) {
    $prop_desc = $GLOBALS['post']->post_excerpt;
}
if ( empty( $prop_desc ) ) {
    $prop_desc = __( 'Discover your own piece of paradise with the Seaside Serenity Villa. Tucked away in an exclusive enclave of Malibu, this stunning property offers breathtaking ocean views, unmatched privacy, and state-of-the-art modern architectural design.', 'figma-trial-theme' );
}
$prop_img = get_the_post_thumbnail_url( $current_id, 'full' );
if ( empty( $prop_img ) ) {
    $prop_img = estatein_get_property_field( 'property_image_url', $current_id );
}

// Assemble Multi-Image Gallery
$gallery_images = array();
if ( ! empty( $prop_img ) ) {
    $gallery_images[] = $prop_img;
}

// 1. Uploaded gallery images from ACF image fields (property_image_1 to 6)
for ( $i = 1; $i <= 6; $i++ ) {
    $uploaded_img = estatein_get_property_field( "property_image_{$i}", $current_id );
    if ( ! empty( $uploaded_img ) ) {
        if ( is_array( $uploaded_img ) && isset( $uploaded_img['url'] ) ) {
            $img_url = $uploaded_img['url'];
        } elseif ( is_numeric( $uploaded_img ) ) {
            $img_url = wp_get_attachment_url( $uploaded_img );
        } else {
            $img_url = (string) $uploaded_img;
        }
        if ( ! empty( $img_url ) && ! in_array( $img_url, $gallery_images, true ) ) {
            $gallery_images[] = $img_url;
        }
    }
}

// 2. Additional URLs from textarea (one URL per line)
$urls_field = estatein_get_property_field( 'property_gallery_urls', $current_id );
if ( ! empty( $urls_field ) ) {
    $url_lines = preg_split( '/\r\n|\r|\n/', trim( $urls_field ) );
    foreach ( $url_lines as $uline ) {
        $clean_url = esc_url_raw( trim( $uline ) );
        if ( filter_var( $clean_url, FILTER_VALIDATE_URL ) && ! in_array( $clean_url, $gallery_images, true ) ) {
            $gallery_images[] = $clean_url;
        }
    }
}

// 3. Attached media images from post
$attachments = get_attached_media( 'image', $current_id );
if ( ! empty( $attachments ) ) {
    foreach ( $attachments as $att ) {
        $att_url = wp_get_attachment_url( $att->ID );
        if ( $att_url && ! in_array( $att_url, $gallery_images, true ) ) {
            $gallery_images[] = $att_url;
        }
    }
}

// Curated stock fallback images
$default_stock_photos = array(
    'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=1200&q=85',
    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85',
    'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
);

if ( empty( $gallery_images ) ) {
    $gallery_images = $default_stock_photos;
} elseif ( count( $gallery_images ) === 1 ) {
    $gallery_images[] = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85';
}

$main_img_1 = $gallery_images[0];
$main_img_2 = isset( $gallery_images[1] ) ? $gallery_images[1] : $gallery_images[0];

// Key Features & Amenities
$amenities_raw = estatein_get_property_field( 'property_amenities', $current_id );
$amenities     = array();
if ( ! empty( $amenities_raw ) ) {
    $amenity_lines = preg_split( '/\r\n|\r|\n/', trim( $amenities_raw ) );
    foreach ( $amenity_lines as $aline ) {
        $aline = trim( $aline );
        if ( ! empty( $aline ) ) {
            $amenities[] = $aline;
        }
    }
}
if ( empty( $amenities ) ) {
    $amenities = array(
        __( 'Expansive oceanfront terrace for outdoor entertaining', 'figma-trial-theme' ),
        __( 'Gourmet kitchen with state-of-the-art appliances', 'figma-trial-theme' ),
        __( 'Private infinity pool overlooking the coastline', 'figma-trial-theme' ),
        __( 'Dedicated home theater and entertainment lounge', 'figma-trial-theme' ),
        __( 'Spacious master suite with spa-like ensuite bathroom', 'figma-trial-theme' ),
    );
}

// Comprehensive Pricing Details
$fee_transfer_tax   = estatein_get_property_field( 'property_transfer_tax', $current_id, '$25,000' );
$fee_legal          = estatein_get_property_field( 'property_legal_fees', $current_id, '$3,500' );
$fee_inspection     = estatein_get_property_field( 'property_inspection_fee', $current_id, '$750' );
$fee_insurance      = estatein_get_property_field( 'property_insurance_fee', $current_id, '$2,400' );
$fee_monthly_tax    = estatein_get_property_field( 'property_monthly_tax', $current_id, '$1,250' );
$fee_hoa            = estatein_get_property_field( 'property_hoa_fee', $current_id, '$450' );
$fee_down_payment   = estatein_get_property_field( 'property_down_payment', $current_id, '$250,000' );
$fee_closing_costs  = estatein_get_property_field( 'property_closing_costs', $current_id, '$31,650' );
$fee_mortgage       = estatein_get_property_field( 'property_monthly_mortgage', $current_id, '$5,420' );
$fee_principal      = estatein_get_property_field( 'property_principal_interest', $current_id, '$4,720' );
?>
<div class="property-details-page">
    <div class="theme-container">

        <!-- 1. Property Header / Overview Bar -->
        <section class="property-header-section">
            <div class="property-header-left">
                <h1 class="property-title"><?php echo esc_html( $prop_title ); ?></h1>
                <div class="property-location-badge">
                    <span class="location-icon" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </span>
                    <span class="location-text"><?php echo esc_html( $prop_location ); ?></span>
                </div>
            </div>

            <div class="property-header-price">
                <span class="price-label"><?php esc_html_e( 'Price', 'figma-trial-theme' ); ?></span>
                <span class="price-value"><?php echo esc_html( $prop_price ); ?></span>
            </div>
        </section>

        <!-- 2. Property Gallery Section -->
        <section class="property-gallery-section">
            <div class="gallery-wrapper">
                <!-- Thumbnail Strip -->
                <div class="gallery-thumbnails-strip">
                    <?php foreach ( $gallery_images as $index => $thumb_url ) : ?>
                        <div class="thumb-item<?php echo $index === 0 ? ' active' : ''; ?>" data-img-index="<?php echo esc_attr( $index ); ?>">
                            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $prop_title ); ?> Thumbnail <?php echo esc_attr( $index + 1 ); ?>" loading="lazy" decoding="async" />
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Main Previews (2-Column Showcase) -->
                <div class="gallery-main-showcase">
                    <div class="main-preview-card">
                        <img id="main-preview-1" src="<?php echo esc_url( $main_img_1 ); ?>" alt="<?php echo esc_attr( $prop_title ); ?> Showcase 1" fetchpriority="high" decoding="async" />
                    </div>
                    <div class="main-preview-card">
                        <img id="main-preview-2" src="<?php echo esc_url( $main_img_2 ); ?>" alt="<?php echo esc_attr( $prop_title ); ?> Showcase 2" decoding="async" />
                    </div>
                </div>

                <!-- Gallery Navigation Bar -->
                <div class="gallery-controls-bar">
                    <button type="button" class="gallery-nav-btn prev-btn" id="gallery-prev" aria-label="<?php esc_attr_e( 'Previous images', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                    </button>

                    <div class="gallery-indicators">
                        <?php foreach ( $gallery_images as $index => $dot_url ) : ?>
                            <span class="indicator-dot<?php echo $index === 0 ? ' active' : ''; ?>"></span>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="gallery-nav-btn next-btn" id="gallery-next" aria-label="<?php esc_attr_e( 'Next images', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- 3. Property Description & Key Features Grid -->
        <section class="property-overview-grid">
            <!-- Left Card: Description & Specs -->
            <div class="overview-card description-card">
                <div class="card-inner-heading">
                    <h2 class="card-title"><?php esc_html_e( 'Description', 'figma-trial-theme' ); ?></h2>
                    <p class="card-description-text">
                        <?php echo esc_html( $prop_desc ); ?>
                    </p>
                </div>

                <div class="property-specs-strip">
                    <!-- Bedroom Spec -->
                    <div class="spec-item">
                        <div class="spec-header">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 4v16M2 8h18a2 2 0 0 1 2 2v10M2 17h20M6 8v9"/>
                            </svg>
                            <span class="spec-label"><?php esc_html_e( 'Bedrooms', 'figma-trial-theme' ); ?></span>
                        </div>
                        <span class="spec-value"><?php echo esc_html( $prop_bedrooms ); ?></span>
                    </div>

                    <div class="spec-divider" aria-hidden="true"></div>

                    <!-- Bathroom Spec -->
                    <div class="spec-item">
                        <div class="spec-header">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 6 6.5 3.5a1.5 1.5 0 0 0-2.12 0l-.88.88a1.5 1.5 0 0 0 0 2.12L6 9M4 12h16a1 1 0 0 1 1 1v3a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-3a1 1 0 0 1 1-1Z"/>
                            </svg>
                            <span class="spec-label"><?php esc_html_e( 'Bathrooms', 'figma-trial-theme' ); ?></span>
                        </div>
                        <span class="spec-value"><?php echo esc_html( $prop_bathrooms ); ?></span>
                    </div>

                    <div class="spec-divider" aria-hidden="true"></div>

                    <!-- Area Spec -->
                    <div class="spec-item">
                        <div class="spec-header">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2"/>
                                <path d="M3 9h18M9 21V9"/>
                            </svg>
                            <span class="spec-label"><?php esc_html_e( 'Area', 'figma-trial-theme' ); ?></span>
                        </div>
                        <span class="spec-value"><?php echo esc_html( $prop_area ); ?></span>
                    </div>
                </div>
            </div>

            <!-- Right Card: Key Features and Amenities -->
            <div class="overview-card amenities-card">
                <h2 class="card-title"><?php esc_html_e( 'Key Features and Amenities', 'figma-trial-theme' ); ?></h2>
                <div class="amenities-list">
                    <?php foreach ( $amenities as $amenity_item ) : ?>
                        <div class="amenity-item">
                            <span class="amenity-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                                </svg>
                            </span>
                            <span class="amenity-text"><?php echo esc_html( $amenity_item ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- 4. Inquiry Contact Form Section -->
        <section class="property-inquiry-section" id="inquire">
            <div class="inquiry-grid">
                <!-- Left Title Column -->
                <div class="inquiry-intro">
                    <div class="abstract-accent-stars" aria-hidden="true">
                        <span class="star-accent">✦</span>
                        <span class="star-accent">✦</span>
                    </div>
                    <h2 class="section-heading">
                        <?php printf( esc_html__( 'Inquire About %s', 'figma-trial-theme' ), esc_html( $prop_title ) ); ?>
                    </h2>
                    <p class="section-subtext">
                        <?php esc_html_e( 'Interested in this property? Fill out the form below, and our real estate experts will get back to you with more details and scheduling options.', 'figma-trial-theme' ); ?>
                    </p>
                </div>

                <!-- Right Form Column -->
                <div class="inquiry-form-card">
                    <form class="estatein-inquiry-form" action="#" method="post" onsubmit="event.preventDefault(); alert('Inquiry submitted! Our team will contact you shortly.');">
                        <div class="form-row-two-col">
                            <div class="form-field-group">
                                <label for="first_name" class="form-label"><?php esc_html_e( 'First Name', 'figma-trial-theme' ); ?></label>
                                <input type="text" id="first_name" name="first_name" placeholder="<?php esc_attr_e( 'Enter First Name', 'figma-trial-theme' ); ?>" required class="form-input" />
                            </div>
                            <div class="form-field-group">
                                <label for="last_name" class="form-label"><?php esc_html_e( 'Last Name', 'figma-trial-theme' ); ?></label>
                                <input type="text" id="last_name" name="last_name" placeholder="<?php esc_attr_e( 'Enter Last Name', 'figma-trial-theme' ); ?>" required class="form-input" />
                            </div>
                        </div>

                        <div class="form-row-two-col">
                            <div class="form-field-group">
                                <label for="email_address" class="form-label"><?php esc_html_e( 'Email', 'figma-trial-theme' ); ?></label>
                                <input type="email" id="email_address" name="email_address" placeholder="<?php esc_attr_e( 'Enter your Email', 'figma-trial-theme' ); ?>" required class="form-input" />
                            </div>
                            <div class="form-field-group">
                                <label for="phone_number" class="form-label"><?php esc_html_e( 'Phone', 'figma-trial-theme' ); ?></label>
                                <input type="tel" id="phone_number" name="phone_number" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'figma-trial-theme' ); ?>" required class="form-input" />
                            </div>
                        </div>

                        <div class="form-field-group full-width">
                            <label for="selected_property" class="form-label"><?php esc_html_e( 'Selected Property', 'figma-trial-theme' ); ?></label>
                            <div class="select-wrapper">
                                <select id="selected_property" name="selected_property" class="form-select">
                                    <option value="<?php echo esc_attr( $prop_title . ( ! empty( $prop_location ) ? ', ' . $prop_location : '' ) ); ?>" selected>
                                        <?php echo esc_html( $prop_title . ( ! empty( $prop_location ) ? ', ' . $prop_location : '' ) ); ?>
                                    </option>
                                    <option value="Seaside Serenity Villa, Malibu, California">Seaside Serenity Villa, Malibu, California</option>
                                    <option value="Metropolitan Haven, New York">Metropolitan Haven, New York</option>
                                    <option value="Rustic Retreat Cottage, Aspen">Rustic Retreat Cottage, Aspen</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-field-group full-width">
                            <label for="inquiry_message" class="form-label"><?php esc_html_e( 'Message', 'figma-trial-theme' ); ?></label>
                            <textarea id="inquiry_message" name="inquiry_message" rows="4" placeholder="<?php esc_attr_e( 'Enter your Message here...', 'figma-trial-theme' ); ?>" required class="form-textarea"></textarea>
                        </div>

                        <div class="form-bottom-row">
                            <label class="checkbox-container">
                                <input type="checkbox" required class="form-checkbox" />
                                <span class="checkbox-label-text"><?php esc_html_e( 'I agree with Terms of Use and Privacy Policy', 'figma-trial-theme' ); ?></span>
                            </label>

                            <button type="submit" class="btn-primary-purple form-submit-btn">
                                <?php esc_html_e( 'Send Your Message', 'figma-trial-theme' ); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- 5. Comprehensive Pricing Details Section -->
        <section class="pricing-details-section">
            <div class="section-title-wrap">
                <div class="abstract-accent-stars" aria-hidden="true">
                    <span class="star-accent">✦</span>
                    <span class="star-accent">✦</span>
                </div>
                <h2 class="section-heading"><?php esc_html_e( 'Comprehensive Pricing Details', 'figma-trial-theme' ); ?></h2>
                <p class="section-subtext">
                    <?php esc_html_e( 'At Estatein, transparency is key. Here is a breakdown of all associated costs and estimated financial schedules for this property.', 'figma-trial-theme' ); ?>
                </p>
            </div>

            <!-- Disclaimer Notice Banner -->
            <div class="pricing-note-banner">
                <span class="note-badge"><?php esc_html_e( 'Note', 'figma-trial-theme' ); ?></span>
                <span class="note-text"><?php esc_html_e( 'The figures provided below are estimates and subject to change based on actual transaction terms, local jurisdiction, and closing dates.', 'figma-trial-theme' ); ?></span>
            </div>

            <!-- Pricing Grid -->
            <div class="pricing-layout-grid">
                <!-- Sidebar Listing Price Box -->
                <div class="listing-price-box">
                    <span class="price-box-label"><?php esc_html_e( 'Listing Price', 'figma-trial-theme' ); ?></span>
                    <span class="price-box-amount"><?php echo esc_html( $prop_price ); ?></span>
                </div>

                <!-- Main Breakdown Cards -->
                <div class="pricing-cards-column">
                    <!-- Pricing Card 1: Additional Fees -->
                    <div class="pricing-card">
                        <div class="pricing-card-header">
                            <h3 class="pricing-card-title"><?php esc_html_e( 'Additional Fees', 'figma-trial-theme' ); ?></h3>
                            <button type="button" class="btn-secondary-dark"><?php esc_html_e( 'Learn More', 'figma-trial-theme' ); ?></button>
                        </div>
                        <div class="card-horizontal-line"></div>
                        <div class="pricing-items-row">
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'Property Transfer Tax', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_transfer_tax ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( 'Based on standard 2% rate', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                            <div class="fee-col-divider"></div>
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'Legal & Title Fees', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_legal ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( 'Approximate attorney cost', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-horizontal-line"></div>
                        <div class="pricing-items-row">
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'Home Inspection', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_inspection ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( 'Certified inspector', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                            <div class="fee-col-divider"></div>
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'Property Insurance', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_insurance ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( 'Annual premium estimate', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Card 2: Monthly Costs -->
                    <div class="pricing-card">
                        <div class="pricing-card-header">
                            <h3 class="pricing-card-title"><?php esc_html_e( 'Monthly Costs', 'figma-trial-theme' ); ?></h3>
                            <button type="button" class="btn-secondary-dark"><?php esc_html_e( 'Learn More', 'figma-trial-theme' ); ?></button>
                        </div>
                        <div class="card-horizontal-line"></div>
                        <div class="pricing-items-row single-col-row">
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'Property Taxes', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_monthly_tax ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( 'Approximate assessment per month', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-horizontal-line"></div>
                        <div class="pricing-items-row single-col-row">
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'HOA Fees', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_hoa ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( 'Covers gated security & grounds maintenance', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Card 3: Total Initial Investment -->
                    <div class="pricing-card">
                        <div class="pricing-card-header">
                            <h3 class="pricing-card-title"><?php esc_html_e( 'Total Initial Investment', 'figma-trial-theme' ); ?></h3>
                            <button type="button" class="btn-secondary-dark"><?php esc_html_e( 'Learn More', 'figma-trial-theme' ); ?></button>
                        </div>
                        <div class="card-horizontal-line"></div>
                        <div class="pricing-items-row">
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'Down Payment', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_down_payment ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( '20% standard initial equity', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                            <div class="fee-col-divider"></div>
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'Closing Costs', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_closing_costs ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( 'Total upfront transaction fees', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Card 4: Monthly Mortgage Breakdown -->
                    <div class="pricing-card">
                        <div class="pricing-card-header">
                            <h3 class="pricing-card-title"><?php esc_html_e( 'Monthly Mortgage Breakdown', 'figma-trial-theme' ); ?></h3>
                            <button type="button" class="btn-secondary-dark"><?php esc_html_e( 'Learn More', 'figma-trial-theme' ); ?></button>
                        </div>
                        <div class="card-horizontal-line"></div>
                        <div class="pricing-items-row">
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'Estimated Monthly Payment', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_mortgage ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( 'Based on 30-year fixed rate at 6.5%', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                            <div class="fee-col-divider"></div>
                            <div class="fee-col">
                                <span class="fee-name"><?php esc_html_e( 'Principal & Interest', 'figma-trial-theme' ); ?></span>
                                <div class="fee-val-wrap">
                                    <span class="fee-amount"><?php echo esc_html( $fee_principal ); ?></span>
                                    <span class="fee-pill"><?php esc_html_e( 'Direct loan payoff', 'figma-trial-theme' ); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Frequently Asked Questions Section -->
        <section class="property-faq-section" id="faqs">
            <div class="faq-header-bar">
                <div class="faq-header-text">
                    <div class="abstract-accent-stars" aria-hidden="true">
                        <span class="star-accent">✦</span>
                        <span class="star-accent">✦</span>
                    </div>
                    <h2 class="section-heading"><?php esc_html_e( 'Frequently Asked Questions', 'figma-trial-theme' ); ?></h2>
                    <p class="section-subtext"><?php esc_html_e( 'Find quick answers to common questions about purchasing and inspecting this property.', 'figma-trial-theme' ); ?></p>
                </div>
                <div class="faq-header-action">
                    <a href="#all-faqs" class="btn-secondary-dark"><?php esc_html_e( 'View All FAQs', 'figma-trial-theme' ); ?></a>
                </div>
            </div>

            <!-- FAQ Cards Grid -->
            <div class="faq-cards-grid">
                <!-- FAQ Card 1 -->
                <div class="faq-card">
                    <h3 class="faq-card-title"><?php esc_html_e( 'How does the property purchasing process work with Estatein?', 'figma-trial-theme' ); ?></h3>
                    <p class="faq-card-answer"><?php esc_html_e( 'From initial offer submission to escrow closing, our dedicated team guides you through verified inspections, title search, and smooth closing.', 'figma-trial-theme' ); ?></p>
                    <a href="#faq-1" class="btn-secondary-dark faq-card-btn"><?php esc_html_e( 'Read More', 'figma-trial-theme' ); ?></a>
                </div>

                <!-- FAQ Card 2 -->
                <div class="faq-card">
                    <h3 class="faq-card-title"><?php esc_html_e( 'Can I schedule a private property viewing for this villa?', 'figma-trial-theme' ); ?></h3>
                    <p class="faq-card-answer"><?php esc_html_e( 'Yes! Simply use the inquiry form above or contact our Malibu representative to schedule an exclusive, discreet on-site or virtual tour.', 'figma-trial-theme' ); ?></p>
                    <a href="#faq-2" class="btn-secondary-dark faq-card-btn"><?php esc_html_e( 'Read More', 'figma-trial-theme' ); ?></a>
                </div>

                <!-- FAQ Card 3 -->
                <div class="faq-card">
                    <h3 class="faq-card-title"><?php esc_html_e( 'What financing or mortgage pre-approvals are required?', 'figma-trial-theme' ); ?></h3>
                    <p class="faq-card-answer"><?php esc_html_e( 'We recommend obtaining a verified mortgage pre-approval letter or proof of funds to facilitate expeditious seller review of offers.', 'figma-trial-theme' ); ?></p>
                    <a href="#faq-3" class="btn-secondary-dark faq-card-btn"><?php esc_html_e( 'Read More', 'figma-trial-theme' ); ?></a>
                </div>
            </div>

            <!-- FAQ Pagination Bar -->
            <div class="faq-pagination-bar">
                <span class="pagination-page-info">01 <span class="pagination-total">of 10</span></span>
                <div class="pagination-buttons">
                    <button type="button" class="btn-circle-nav prev" aria-label="<?php esc_attr_e( 'Previous FAQ page', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                    </button>
                    <button type="button" class="btn-circle-nav next" aria-label="<?php esc_attr_e( 'Next FAQ page', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

    </div><!-- .theme-container -->
</div><!-- .property-details-page -->
