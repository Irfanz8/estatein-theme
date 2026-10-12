<?php
/**
 * Template part for displaying Home Page content
 *
 * Implements the Figma "Home Page - Desktop" design specifications.
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="homepage-content">
    <!-- 1. Hero Section -->
    <section class="home-hero-section" id="hero">
        <div class="hero-two-col-container">
            <!-- Left Column: Copy, CTAs, Stats (Murni Hitam / Pure Solid Dark) -->
            <div class="hero-content-col">
                <div class="hero-text-group">
                    <h1 class="hero-main-title">
                        <?php echo esc_html( estatein_get_page_field( 'home_hero_title', null, estatein_get_setting( 'home_hero_title', __( 'Discover Your Dream Property with Estatein', 'figma-trial-theme' ) ) ) ); ?>
                    </h1>
                    <p class="hero-description">
                        <?php echo esc_html( estatein_get_page_field( 'home_hero_desc', null, estatein_get_setting( 'home_hero_desc', __( 'Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.', 'figma-trial-theme' ) ) ) ); ?>
                    </p>

                    <!-- Circular Decorative Badge (Vertically aligned with title text, centered on 50/50 vertical line) -->
                    <div class="circular-hero-badge" aria-hidden="true">
                        <div class="badge-inner-circle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"/>
                                <polyline points="7 7 17 7 17 17"/>
                            </svg>
                        </div>
                        <svg class="badge-rotating-svg" viewBox="0 0 130 130" width="130" height="130">
                            <path id="badgeCirclePath" d="M 65, 65 m -48, 0 a 48,48 0 1,1 96,0 a 48,48 0 1,1 -96,0" fill="none" />
                            <text font-family="'Urbanist', sans-serif" font-size="10" font-weight="600" fill="#FFFFFF" letter-spacing="2px">
                                <textPath href="#badgeCirclePath" startOffset="0%">
                                    ✦ Discover Your Dream Property ✦
                                </textPath>
                            </text>
                        </svg>
                    </div>
                </div>

                <!-- CTA Action Buttons -->
                <?php
                $btn1_text = estatein_get_page_field( 'home_hero_btn1_text', null, __( 'Learn More', 'figma-trial-theme' ) );
                $btn1_url  = estatein_get_page_field( 'home_hero_btn1_url', null, home_url( '/about-us/' ) );
                $btn2_text = estatein_get_page_field( 'home_hero_btn2_text', null, __( 'Browse Properties', 'figma-trial-theme' ) );
                $btn2_url  = estatein_get_page_field( 'home_hero_btn2_url', null, home_url( '/properties/' ) );
                ?>
                <div class="hero-cta-buttons">
                    <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-secondary-dark hero-btn">
                        <?php echo esc_html( $btn1_text ); ?>
                    </a>
                    <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn-primary-purple hero-btn">
                        <?php echo esc_html( $btn2_text ); ?>
                    </a>
                </div>

                <!-- 3 Stats Cards -->
                <div class="hero-stats-grid">
                    <div class="stat-card">
                        <span class="stat-number"><?php echo esc_html( estatein_get_page_field( 'home_stat_1_val', null, estatein_get_setting( 'home_stat_1', '200+' ) ) ); ?></span>
                        <span class="stat-label"><?php echo esc_html( estatein_get_page_field( 'home_stat_1_label', null, __( 'Happy Customers', 'figma-trial-theme' ) ) ); ?></span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number"><?php echo esc_html( estatein_get_page_field( 'home_stat_2_val', null, estatein_get_setting( 'home_stat_2', '10k+' ) ) ); ?></span>
                        <span class="stat-label"><?php echo esc_html( estatein_get_page_field( 'home_stat_2_label', null, __( 'Properties For Clients', 'figma-trial-theme' ) ) ); ?></span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number"><?php echo esc_html( estatein_get_page_field( 'home_stat_3_val', null, estatein_get_setting( 'home_stat_3', '16+' ) ) ); ?></span>
                        <span class="stat-label"><?php echo esc_html( estatein_get_page_field( 'home_stat_3_label', null, __( 'Years of Experience', 'figma-trial-theme' ) ) ); ?></span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Hero Visual -->
            <?php
            $hero_img = estatein_get_page_field( 'home_hero_image', null, '' );
            if ( empty( $hero_img ) ) {
                $hero_img = get_template_directory_uri() . '/assets/images/hero-building.jpg';
            }
            ?>
            <div class="hero-visual-col">
                <div class="hero-image-wrapper">
                    <img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php esc_attr_e( 'Estatein Luxury Modern Skyscraper', 'figma-trial-theme' ); ?>" class="hero-banner-img" fetchpriority="high" decoding="async" />
                </div>
            </div>
        </div>

        <!-- 4 Feature Highlights Strip - Full Width -->
        <div class="feature-highlights-strip" id="features">
            <div class="features-bar-outer-frame">
                <div class="features-grid-four">
                    <!-- Feature 1: Find Your Dream Home -->
                    <div class="feature-card">
                        <div class="feature-arrow-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                        <div class="feature-icon-badge">
                            <div class="feature-badge-glow"></div>
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <h3 class="feature-card-title"><?php esc_html_e( 'Find Your Dream Home', 'figma-trial-theme' ); ?></h3>
                    </div>

                    <!-- Feature 2: Unlock Property Value -->
                    <div class="feature-card">
                        <div class="feature-arrow-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                        <div class="feature-icon-badge">
                            <div class="feature-badge-glow"></div>
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="5" rx="2"/>
                                <line x1="2" x2="22" y1="10" y2="10"/>
                                <circle cx="12" cy="14" r="2.5"/>
                            </svg>
                        </div>
                        <h3 class="feature-card-title"><?php esc_html_e( 'Unlock Property Value', 'figma-trial-theme' ); ?></h3>
                    </div>

                    <!-- Feature 3: Effortless Property Management -->
                    <div class="feature-card">
                        <div class="feature-arrow-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                        <div class="feature-icon-badge">
                            <div class="feature-badge-glow"></div>
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="4" y="2" width="16" height="20" rx="2"/>
                                <path d="M9 22v-4h6v4"/>
                                <path d="M8 6h.01M16 6h.01M8 10h.01M16 10h.01M8 14h.01M16 14h.01"/>
                            </svg>
                        </div>
                        <h3 class="feature-card-title"><?php esc_html_e( 'Effortless Property Management', 'figma-trial-theme' ); ?></h3>
                    </div>

                    <!-- Feature 4: Smart Investments, Informed Decisions -->
                    <div class="feature-card">
                        <div class="feature-arrow-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                        <div class="feature-icon-badge">
                            <div class="feature-badge-glow"></div>
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="4"/>
                                <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                            </svg>
                        </div>
                        <h3 class="feature-card-title"><?php esc_html_e( 'Smart Investments, Informed Decisions', 'figma-trial-theme' ); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Featured Properties Section -->
    <section class="home-properties-section" id="properties">
        <div class="theme-container">
            <div class="section-header-split">
                <div class="section-header-left">
                    <div class="abstract-accent-stars" aria-hidden="true">
                        <span class="star-accent">✦</span>
                        <span class="star-accent">✦</span>
                    </div>
                    <h2 class="section-heading">
                        <?php echo esc_html( estatein_get_page_field( 'home_featured_title', null, __( 'Featured Properties', 'figma-trial-theme' ) ) ); ?>
                    </h2>
                    <p class="section-subtext">
                        <?php echo esc_html( estatein_get_page_field( 'home_featured_desc', null, __( 'Explore our handpicked selection of featured properties. Each listing offers a glimpse into exceptional homes and investments available through Estatein.', 'figma-trial-theme' ) ) ); ?>
                    </p>
                </div>
                <div class="section-header-right">
                    <a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" class="btn-secondary-dark">
                        <?php esc_html_e( 'View All Properties', 'figma-trial-theme' ); ?>
                    </a>
                </div>
            </div>

            <!-- Properties Cards 3-Column Grid Carousel -->
            <div class="properties-cards-grid" id="homePropertiesCarousel">
                <?php
                $featured_props = new WP_Query( array(
                    'post_type'      => 'property',
                    'posts_per_page' => 12,
                    'post_status'    => 'publish',
                ) );

                if ( $featured_props->have_posts() ) :
                    while ( $featured_props->have_posts() ) :
                        $featured_props->the_post();
                        $price     = estatein_get_property_field( 'property_price', get_the_ID(), '$1,250,000' );
                        $bedrooms  = estatein_get_property_field( 'property_bedrooms', get_the_ID(), '4-Bedroom' );
                        $bathrooms = estatein_get_property_field( 'property_bathrooms', get_the_ID(), '3-Bathroom' );
                        $type      = estatein_get_property_field( 'property_type', get_the_ID(), 'Villa' );
                        $img_url   = estatein_get_property_field( 'property_image_url', get_the_ID(), '' );
                        if ( empty( $img_url ) ) {
                            $img_1 = estatein_get_property_field( 'property_image_1', get_the_ID(), '' );
                            if ( ! empty( $img_1 ) ) {
                                if ( is_array( $img_1 ) && isset( $img_1['url'] ) ) {
                                    $img_url = $img_1['url'];
                                } elseif ( is_numeric( $img_1 ) ) {
                                    $img_url = wp_get_attachment_url( $img_1 );
                                } else {
                                    $img_url = (string) $img_1;
                                }
                            }
                        }
                        if ( has_post_thumbnail() ) {
                            $thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                            if ( $thumb ) {
                                $img_url = $thumb;
                            }
                        }
                        if ( empty( $img_url ) ) {
                            $img_url = 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=800&q=80';
                        }
                        $card_desc = estatein_get_property_field( 'property_description', get_the_ID() );
                        if ( empty( $card_desc ) ) {
                            $card_desc = get_the_excerpt();
                        }
                        ?>
                        <div class="property-listing-card">
                            <div class="property-card-img-wrap">
                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" />
                            </div>
                            <div class="property-card-body">
                                <h3 class="property-card-title"><?php the_title(); ?></h3>
                                <p class="property-card-excerpt">
                                    <?php echo esc_html( wp_trim_words( $card_desc, 24, '...' ) ); ?>
                                </p>
                                <div class="property-pill-tags">
                                    <span class="spec-pill">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M2 4v16M2 8h18a2 2 0 0 1 2 2v10M2 17h20M6 8v9"/></svg>
                                        <?php echo esc_html( $bedrooms ); ?>
                                    </span>
                                    <span class="spec-pill">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M9 6 6.5 3.5a1.5 1.5 0 0 0-2.12 0l-.88.88a1.5 1.5 0 0 0 0 2.12L6 9M4 12h16a1 1 0 0 1 1 1v3a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-3a1 1 0 0 1 1-1Z"/></svg>
                                        <?php echo esc_html( $bathrooms ); ?>
                                    </span>
                                    <span class="spec-pill">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                                        <?php echo esc_html( $type ); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="property-card-footer">
                                <div class="card-price-group">
                                    <span class="price-dim-label"><?php esc_html_e( 'Price', 'figma-trial-theme' ); ?></span>
                                    <span class="price-bold-val"><?php echo esc_html( $price ); ?></span>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn-primary-purple card-action-btn">
                                    <?php esc_html_e( 'View Property Details', 'figma-trial-theme' ); ?>
                                </a>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <!-- Fallback Static Cards -->
                    <div class="property-listing-card">
                        <div class="property-card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=800&q=80" alt="Seaside Serenity Villa" loading="lazy" decoding="async" />
                        </div>
                        <div class="property-card-body">
                            <h3 class="property-card-title"><?php esc_html_e( 'Seaside Serenity Villa', 'figma-trial-theme' ); ?></h3>
                            <p class="property-card-excerpt">
                                <?php esc_html_e( 'A stunning 4-bedroom, 3-bathroom villa in a peaceful suburban neighborhood offering breathtaking panoramic ocean views.', 'figma-trial-theme' ); ?>
                            </p>
                            <div class="property-pill-tags">
                                <span class="spec-pill">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M2 4v16M2 8h18a2 2 0 0 1 2 2v10M2 17h20M6 8v9"/></svg>
                                    4-Bedroom
                                </span>
                                <span class="spec-pill">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="M9 6 6.5 3.5a1.5 1.5 0 0 0-2.12 0l-.88.88a1.5 1.5 0 0 0 0 2.12L6 9M4 12h16a1 1 0 0 1 1 1v3a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-3a1 1 0 0 1 1-1Z"/></svg>
                                    3-Bathroom
                                </span>
                                <span class="spec-pill">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                                    Villa
                                </span>
                            </div>
                        </div>
                        <div class="property-card-footer">
                            <div class="card-price-group">
                                <span class="price-dim-label"><?php esc_html_e( 'Price', 'figma-trial-theme' ); ?></span>
                                <span class="price-bold-val">$1,250,000</span>
                            </div>
                            <a href="<?php echo esc_url( home_url( '/property-details/' ) ); ?>" class="btn-primary-purple card-action-btn">
                                <?php esc_html_e( 'View Property Details', 'figma-trial-theme' ); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Carousel Pagination Bar -->
            <div class="section-pagination-bar">
                <span class="pagination-page-info" id="home-props-page-info">01 <span class="pagination-total">of 01</span></span>
                <div class="pagination-buttons">
                    <button type="button" class="btn-circle-nav prev" id="home-props-prev" aria-label="<?php esc_attr_e( 'Previous properties', 'figma-trial-theme' ); ?>" disabled>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <button type="button" class="btn-circle-nav next" id="home-props-next" aria-label="<?php esc_attr_e( 'Next properties', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. What Our Clients Say (Testimonials Section) -->
    <section class="home-testimonials-section" id="testimonials">
        <div class="theme-container">
            <div class="section-header-split">
                <div class="section-header-left">
                    <div class="abstract-accent-stars" aria-hidden="true">
                        <span class="star-accent">✦</span>
                        <span class="star-accent">✦</span>
                    </div>
                    <h2 class="section-heading">
                        <?php echo esc_html( estatein_get_page_field( 'home_testimonials_title', null, __( 'What Our Clients Say', 'figma-trial-theme' ) ) ); ?>
                    </h2>
                    <p class="section-subtext">
                        <?php echo esc_html( estatein_get_page_field( 'home_testimonials_desc', null, __( 'Read the success stories and heartfelt testimonials from our valued clients. Discover why they chose Estatein for their real estate journey.', 'figma-trial-theme' ) ) ); ?>
                    </p>
                </div>
                <div class="section-header-right">
                    <a href="#testimonials-all" class="btn-secondary-dark">
                        <?php esc_html_e( 'View All Testimonials', 'figma-trial-theme' ); ?>
                    </a>
                </div>
            </div>

            <?php
            // Testimonial 1
            $t1_title  = estatein_get_page_field( 'home_test_1_title', null, __( 'Exceptional Service!', 'figma-trial-theme' ) );
            $t1_text   = estatein_get_page_field( 'home_test_1_text', null, __( "Our experience with Estatein was outstanding. Their team's dedication and market knowledge helped us find our dream home smoothly.", 'figma-trial-theme' ) );
            $t1_name   = estatein_get_page_field( 'home_test_1_name', null, 'Wade Warren' );
            $t1_loc    = estatein_get_page_field( 'home_test_1_loc', null, 'USA, California' );
            $t1_avatar = estatein_get_page_field( 'home_test_1_avatar', null, 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80' );

            // Testimonial 2
            $t2_title  = estatein_get_page_field( 'home_test_2_title', null, __( 'Efficient and Reliable', 'figma-trial-theme' ) );
            $t2_text   = estatein_get_page_field( 'home_test_2_text', null, __( 'Estatein made selling our property stress-free. Their valuation expertise and marketing strategy exceeded our expectations.', 'figma-trial-theme' ) );
            $t2_name   = estatein_get_page_field( 'home_test_2_name', null, 'Emelie Thomson' );
            $t2_loc    = estatein_get_page_field( 'home_test_2_loc', null, 'USA, Florida' );
            $t2_avatar = estatein_get_page_field( 'home_test_2_avatar', null, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=120&q=80' );

            // Testimonial 3
            $t3_title  = estatein_get_page_field( 'home_test_3_title', null, __( 'Trusted Advisors', 'figma-trial-theme' ) );
            $t3_text   = estatein_get_page_field( 'home_test_3_text', null, __( 'The team provided invaluable guidance throughout our commercial investment journey. Highly recommended for all real estate needs.', 'figma-trial-theme' ) );
            $t3_name   = estatein_get_page_field( 'home_test_3_name', null, 'John Mans' );
            $t3_loc    = estatein_get_page_field( 'home_test_3_loc', null, 'USA, Nevada' );
            $t3_avatar = estatein_get_page_field( 'home_test_3_avatar', null, 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80' );
            ?>
            <!-- Testimonials 3-Column Grid -->
            <div class="testimonials-cards-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="star-rating-row">
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                    </div>
                    <div class="testimonial-content">
                        <h3 class="testimonial-title"><?php echo esc_html( $t1_title ); ?></h3>
                        <p class="testimonial-paragraph"><?php echo esc_html( $t1_text ); ?></p>
                    </div>
                    <div class="testimonial-client-meta">
                        <img src="<?php echo esc_url( $t1_avatar ); ?>" alt="<?php echo esc_attr( $t1_name ); ?>" class="client-avatar" loading="lazy" decoding="async" />
                        <div class="client-info">
                            <h4 class="client-name"><?php echo esc_html( $t1_name ); ?></h4>
                            <span class="client-location"><?php echo esc_html( $t1_loc ); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="star-rating-row">
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                    </div>
                    <div class="testimonial-content">
                        <h3 class="testimonial-title"><?php echo esc_html( $t2_title ); ?></h3>
                        <p class="testimonial-paragraph"><?php echo esc_html( $t2_text ); ?></p>
                    </div>
                    <div class="testimonial-client-meta">
                        <img src="<?php echo esc_url( $t2_avatar ); ?>" alt="<?php echo esc_attr( $t2_name ); ?>" class="client-avatar" loading="lazy" decoding="async" />
                        <div class="client-info">
                            <h4 class="client-name"><?php echo esc_html( $t2_name ); ?></h4>
                            <span class="client-location"><?php echo esc_html( $t2_loc ); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <div class="star-rating-row">
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                    </div>
                    <div class="testimonial-content">
                        <h3 class="testimonial-title"><?php echo esc_html( $t3_title ); ?></h3>
                        <p class="testimonial-paragraph"><?php echo esc_html( $t3_text ); ?></p>
                    </div>
                    <div class="testimonial-client-meta">
                        <img src="<?php echo esc_url( $t3_avatar ); ?>" alt="<?php echo esc_attr( $t3_name ); ?>" class="client-avatar" loading="lazy" decoding="async" />
                        <div class="client-info">
                            <h4 class="client-name"><?php echo esc_html( $t3_name ); ?></h4>
                            <span class="client-location"><?php echo esc_html( $t3_loc ); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Pagination Bar -->
            <div class="section-pagination-bar">
                <span class="pagination-page-info">01 <span class="pagination-total">of 10</span></span>
                <div class="pagination-buttons">
                    <button type="button" class="btn-circle-nav prev" aria-label="<?php esc_attr_e( 'Previous testimonials', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <button type="button" class="btn-circle-nav next" aria-label="<?php esc_attr_e( 'Next testimonials', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Frequently Asked Questions Section -->
    <section class="home-faq-section" id="faqs">
        <div class="theme-container">
            <div class="section-header-split">
                <div class="section-header-left">
                    <div class="abstract-accent-stars" aria-hidden="true">
                        <span class="star-accent">✦</span>
                        <span class="star-accent">✦</span>
                    </div>
                    <h2 class="section-heading">
                        <?php echo esc_html( estatein_get_page_field( 'home_faq_title', null, __( 'Frequently Asked Questions', 'figma-trial-theme' ) ) ); ?>
                    </h2>
                    <p class="section-subtext">
                        <?php echo esc_html( estatein_get_page_field( 'home_faq_desc', null, __( "Find answers to common questions about Estatein's services, property listings, and the buying or selling process.", 'figma-trial-theme' ) ) ); ?>
                    </p>
                </div>
                <div class="section-header-right">
                    <a href="#faqs-all" class="btn-secondary-dark"><?php esc_html_e( 'View All FAQs', 'figma-trial-theme' ); ?></a>
                </div>
            </div>

            <?php
            // FAQ 1
            $f1_q = estatein_get_page_field( 'home_faq_1_q', null, __( 'How do I search for properties on Estatein?', 'figma-trial-theme' ) );
            $f1_a = estatein_get_page_field( 'home_faq_1_a', null, __( 'Learn how to use our search filters to find properties that match your exact criteria, from location to price point.', 'figma-trial-theme' ) );

            // FAQ 2
            $f2_q = estatein_get_page_field( 'home_faq_2_q', null, __( 'What documents do I need to sell my home?', 'figma-trial-theme' ) );
            $f2_a = estatein_get_page_field( 'home_faq_2_a', null, __( 'Find out about the essential documentation required to list and finalize the sale of your residential property.', 'figma-trial-theme' ) );

            // FAQ 3
            $f3_q = estatein_get_page_field( 'home_faq_3_q', null, __( 'How does Estatein help with property financing?', 'figma-trial-theme' ) );
            $f3_a = estatein_get_page_field( 'home_faq_3_a', null, __( 'Discover our partnerships with certified lenders and mortgage specialists to secure competitive interest rates.', 'figma-trial-theme' ) );
            ?>
            <!-- FAQ 3-Column Grid -->
            <div class="faq-cards-grid">
                <!-- FAQ 1 -->
                <div class="faq-card">
                    <h3 class="faq-card-title"><?php echo esc_html( $f1_q ); ?></h3>
                    <p class="faq-card-answer"><?php echo esc_html( $f1_a ); ?></p>
                    <a href="#faq-search" class="btn-secondary-dark faq-card-btn"><?php esc_html_e( 'Read More', 'figma-trial-theme' ); ?></a>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-card">
                    <h3 class="faq-card-title"><?php echo esc_html( $f2_q ); ?></h3>
                    <p class="faq-card-answer"><?php echo esc_html( $f2_a ); ?></p>
                    <a href="#faq-docs" class="btn-secondary-dark faq-card-btn"><?php esc_html_e( 'Read More', 'figma-trial-theme' ); ?></a>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-card">
                    <h3 class="faq-card-title"><?php echo esc_html( $f3_q ); ?></h3>
                    <p class="faq-card-answer"><?php echo esc_html( $f3_a ); ?></p>
                    <a href="#faq-financing" class="btn-secondary-dark faq-card-btn"><?php esc_html_e( 'Read More', 'figma-trial-theme' ); ?></a>
                </div>
            </div>

            <!-- Carousel Pagination Bar -->
            <div class="section-pagination-bar">
                <span class="pagination-page-info">01 <span class="pagination-total">of 10</span></span>
                <div class="pagination-buttons">
                    <button type="button" class="btn-circle-nav prev" aria-label="<?php esc_attr_e( 'Previous FAQ', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <button type="button" class="btn-circle-nav next" aria-label="<?php esc_attr_e( 'Next FAQ', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div><!-- .homepage-content -->
