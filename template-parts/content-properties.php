<?php
/**
 * Template part for displaying Properties Page content
 *
 * Implements the Figma "Properties Page - Desktop" design specifications.
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="properties-page-content">
    <!-- 1. Hero & Search Banner Section -->
    <section class="properties-hero-section">
        <div class="theme-container">
            <div class="properties-hero-intro">
                <div class="abstract-accent-stars" aria-hidden="true">
                    <span class="star-accent">✦</span>
                    <span class="star-accent">✦</span>
                </div>
                <h1 class="properties-hero-title">
                    <?php echo esc_html( estatein_get_page_field( 'properties_hero_title', null, __( 'Find Your Dream Property', 'figma-trial-theme' ) ) ); ?>
                </h1>
                <p class="properties-hero-desc">
                    <?php echo esc_html( estatein_get_page_field( 'properties_hero_desc', null, __( 'Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life. With categories to suit every dreamer, your journey begins here.', 'figma-trial-theme' ) ) ); ?>
                </p>
            </div>

            <!-- Search Bar Component -->
            <div class="properties-search-card">
                <form class="properties-search-form" action="#" method="get" onsubmit="event.preventDefault();">
                    <div class="search-input-wrap">
                        <input type="text" name="search_property" placeholder="<?php esc_attr_e( 'Search For A Property', 'figma-trial-theme' ); ?>" class="properties-search-input" />
                        <button type="submit" class="btn-primary-purple properties-search-btn">
                            <span class="search-btn-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"/>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                </svg>
                            </span>
                            <span class="search-btn-text"><?php esc_html_e( 'Find Property', 'figma-trial-theme' ); ?></span>
                        </button>
                    </div>
                </form>

                <!-- Filter Dropdowns Strip -->
                <div class="properties-filters-strip">
                    <!-- Filter 1: Location -->
                    <div class="filter-dropdown-box">
                        <div class="filter-icon-label">
                            <span class="filter-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </span>
                            <span class="filter-label-text"><?php esc_html_e( 'Location', 'figma-trial-theme' ); ?></span>
                        </div>
                        <div class="filter-select-wrap">
                            <select class="filter-select" aria-label="<?php esc_attr_e( 'Select Location', 'figma-trial-theme' ); ?>">
                                <option value="" selected><?php esc_html_e( 'Location', 'figma-trial-theme' ); ?></option>
                                <option value="malibu">Malibu, California</option>
                                <option value="newyork">New York, NY</option>
                                <option value="aspen">Aspen, Colorado</option>
                                <option value="miami">Miami, Florida</option>
                            </select>
                            <span class="filter-chevron" aria-hidden="true">▾</span>
                        </div>
                    </div>

                    <div class="filter-separator" aria-hidden="true"></div>

                    <!-- Filter 2: Property Type -->
                    <div class="filter-dropdown-box">
                        <div class="filter-icon-label">
                            <span class="filter-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                    <polyline points="9 22 9 12 15 12 15 22"/>
                                </svg>
                            </span>
                            <span class="filter-label-text"><?php esc_html_e( 'Property Type', 'figma-trial-theme' ); ?></span>
                        </div>
                        <div class="filter-select-wrap">
                            <select class="filter-select" aria-label="<?php esc_attr_e( 'Select Property Type', 'figma-trial-theme' ); ?>">
                                <option value="" selected><?php esc_html_e( 'Property Type', 'figma-trial-theme' ); ?></option>
                                <option value="villa">Luxury Villa</option>
                                <option value="apartment">Penthouse / Apartment</option>
                                <option value="cottage">Cottage / Estate</option>
                                <option value="commercial">Commercial</option>
                            </select>
                            <span class="filter-chevron" aria-hidden="true">▾</span>
                        </div>
                    </div>

                    <div class="filter-separator" aria-hidden="true"></div>

                    <!-- Filter 3: Pricing Range -->
                    <div class="filter-dropdown-box">
                        <div class="filter-icon-label">
                            <span class="filter-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/>
                                    <path d="M12 6v2m0 8v2"/>
                                </svg>
                            </span>
                            <span class="filter-label-text"><?php esc_html_e( 'Pricing Range', 'figma-trial-theme' ); ?></span>
                        </div>
                        <div class="filter-select-wrap">
                            <select class="filter-select" aria-label="<?php esc_attr_e( 'Select Pricing Range', 'figma-trial-theme' ); ?>">
                                <option value="" selected><?php esc_html_e( 'Pricing Range', 'figma-trial-theme' ); ?></option>
                                <option value="range1">$500k - $1,000,000</option>
                                <option value="range2">$1,000,000 - $2,500,000</option>
                                <option value="range3">$2,500,000 - $5,000,000</option>
                                <option value="range4">$5,000,000+</option>
                            </select>
                            <span class="filter-chevron" aria-hidden="true">▾</span>
                        </div>
                    </div>

                    <div class="filter-separator" aria-hidden="true"></div>

                    <!-- Filter 4: Property Size -->
                    <div class="filter-dropdown-box">
                        <div class="filter-icon-label">
                            <span class="filter-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                                    <path d="M3 9h18M9 21V9"/>
                                </svg>
                            </span>
                            <span class="filter-label-text"><?php esc_html_e( 'Property Size', 'figma-trial-theme' ); ?></span>
                        </div>
                        <div class="filter-select-wrap">
                            <select class="filter-select" aria-label="<?php esc_attr_e( 'Select Property Size', 'figma-trial-theme' ); ?>">
                                <option value="" selected><?php esc_html_e( 'Property Size', 'figma-trial-theme' ); ?></option>
                                <option value="size1">< 1,500 sq ft</option>
                                <option value="size2">1,500 - 3,000 sq ft</option>
                                <option value="size3">3,000 - 5,000 sq ft</option>
                                <option value="size4">> 5,000 sq ft</option>
                            </select>
                            <span class="filter-chevron" aria-hidden="true">▾</span>
                        </div>
                    </div>

                    <div class="filter-separator" aria-hidden="true"></div>

                    <!-- Filter 5: Build Year -->
                    <div class="filter-dropdown-box">
                        <div class="filter-icon-label">
                            <span class="filter-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </span>
                            <span class="filter-label-text"><?php esc_html_e( 'Build Year', 'figma-trial-theme' ); ?></span>
                        </div>
                        <div class="filter-select-wrap">
                            <select class="filter-select" aria-label="<?php esc_attr_e( 'Select Build Year', 'figma-trial-theme' ); ?>">
                                <option value="" selected><?php esc_html_e( 'Build Year', 'figma-trial-theme' ); ?></option>
                                <option value="2024">2023 - 2024 (Brand New)</option>
                                <option value="2020">2018 - 2022 (Modern)</option>
                                <option value="2010">2010 - 2017</option>
                                <option value="classic">Historic / Restored</option>
                            </select>
                            <span class="filter-chevron" aria-hidden="true">▾</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Properties Listing Grid Section ("Discover a World of Possibilities") -->
    <section class="properties-catalog-section" id="categories">
        <div class="theme-container">
            <div class="section-header-split">
                <div class="section-header-left">
                    <div class="abstract-accent-stars" aria-hidden="true">
                        <span class="star-accent">✦</span>
                        <span class="star-accent">✦</span>
                    </div>
                    <h2 class="section-heading"><?php esc_html_e( 'Discover a World of Possibilities', 'figma-trial-theme' ); ?></h2>
                    <p class="section-subtext">
                        <?php esc_html_e( 'Our portfolio of properties is as diverse as your dreams. Explore the following categories to find the perfect property that resonates with your vision of home.', 'figma-trial-theme' ); ?>
                    </p>
                </div>
            </div>

            <!-- Properties Cards 3-Column Grid -->
            <div class="properties-cards-grid catalog-grid">
                <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
                $posts_per_page = 6; // Standard 2 rows of 3 columns for optimal catalog display

                $catalog_props = new WP_Query( array(
                    'post_type'      => 'property',
                    'posts_per_page' => $posts_per_page,
                    'paged'          => $paged,
                    'post_status'    => 'publish',
                ) );

                $total_pages = max( 1, $catalog_props->max_num_pages );

                if ( $catalog_props->have_posts() ) :
                    while ( $catalog_props->have_posts() ) :
                        $catalog_props->the_post();
                        $price     = estatein_get_property_field( 'property_price', get_the_ID(), '$1,250,000' );
                        $bedrooms  = estatein_get_property_field( 'property_bedrooms', get_the_ID(), '4-Bedroom' );
                        $bathrooms = estatein_get_property_field( 'property_bathrooms', get_the_ID(), '3-Bathroom' );
                        $type      = estatein_get_property_field( 'property_type', get_the_ID(), 'Villa' );
                        $badge     = estatein_get_property_field( 'property_badge', get_the_ID(), 'Coastal Escapes - Where the Waves Beckon' );
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
                                <div class="property-category-tag">
                                    <span><?php echo esc_html( $badge ); ?></span>
                                </div>
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
                            <div class="property-category-tag">
                                <span><?php esc_html_e( 'Coastal Escapes - Where the Waves Beckon', 'figma-trial-theme' ); ?></span>
                            </div>
                            <h3 class="property-card-title"><?php esc_html_e( 'Seaside Serenity Villa', 'figma-trial-theme' ); ?></h3>
                            <p class="property-card-excerpt">
                                <?php esc_html_e( 'A stunning 4-bedroom, 3-bathroom villa in a peaceful suburban neighborhood offering breathtaking panoramic ocean views and private beach access.', 'figma-trial-theme' ); ?>
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

            <!-- Pagination Bar with Real Links -->
            <div class="section-pagination-bar">
                <span class="pagination-info">
                    <?php echo esc_html( sprintf( '%02d', $paged ) ); ?> 
                    <span class="dim-page">of <?php echo esc_html( sprintf( '%02d', $total_pages ) ); ?></span>
                </span>
                <div class="pagination-nav-arrows">
                    <?php if ( $paged > 1 ) : ?>
                        <a href="<?php echo esc_url( get_pagenum_link( $paged - 1 ) ); ?>#categories" class="arrow-btn prev-arrow" aria-label="<?php esc_attr_e( 'Previous properties', 'figma-trial-theme' ); ?>">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"/>
                                <polyline points="12 19 5 12 12 5"/>
                            </svg>
                        </a>
                    <?php else : ?>
                        <button type="button" class="arrow-btn prev-arrow" aria-label="<?php esc_attr_e( 'Previous properties', 'figma-trial-theme' ); ?>" disabled>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"/>
                                <polyline points="12 19 5 12 12 5"/>
                            </svg>
                        </button>
                    <?php endif; ?>

                    <?php if ( $paged < $total_pages ) : ?>
                        <a href="<?php echo esc_url( get_pagenum_link( $paged + 1 ) ); ?>#categories" class="arrow-btn next-arrow" aria-label="<?php esc_attr_e( 'Next properties', 'figma-trial-theme' ); ?>">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    <?php else : ?>
                        <button type="button" class="arrow-btn next-arrow" aria-label="<?php esc_attr_e( 'Next properties', 'figma-trial-theme' ); ?>" disabled>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Consultation / Inquiry Form Section ("Let's Make it Happen") -->
    <section class="properties-consultation-section" id="consultation">
        <div class="theme-container">
            <div class="consultation-form-card">
                <div class="consultation-intro">
                    <div class="abstract-accent-stars" aria-hidden="true">
                        <span class="star-accent">✦</span>
                        <span class="star-accent">✦</span>
                    </div>
                    <h2 class="section-heading"><?php esc_html_e( "Let's Make it Happen", 'figma-trial-theme' ); ?></h2>
                    <p class="section-subtext">
                        <?php esc_html_e( 'Ready to take the first step toward your dream property? Fill out the form below, and our real estate wizards will craft a personalized selection tailored just for you.', 'figma-trial-theme' ); ?>
                    </p>
                </div>

                <form class="consultation-multi-form" action="#" method="post" onsubmit="event.preventDefault(); alert('Thank you! Your request has been sent to our real estate team.');">
                    <!-- Row 1: Personal Contact Info (4 Columns) -->
                    <div class="consultation-grid-4col">
                        <div class="form-field-group">
                            <label for="c_first_name" class="form-label"><?php esc_html_e( 'First Name', 'figma-trial-theme' ); ?></label>
                            <input type="text" id="c_first_name" name="first_name" placeholder="<?php esc_attr_e( 'Enter First Name', 'figma-trial-theme' ); ?>" required class="form-input" />
                        </div>
                        <div class="form-field-group">
                            <label for="c_last_name" class="form-label"><?php esc_html_e( 'Last Name', 'figma-trial-theme' ); ?></label>
                            <input type="text" id="c_last_name" name="last_name" placeholder="<?php esc_attr_e( 'Enter Last Name', 'figma-trial-theme' ); ?>" required class="form-input" />
                        </div>
                        <div class="form-field-group">
                            <label for="c_email" class="form-label"><?php esc_html_e( 'Email', 'figma-trial-theme' ); ?></label>
                            <input type="email" id="c_email" name="email" placeholder="<?php esc_attr_e( 'Enter your Email', 'figma-trial-theme' ); ?>" required class="form-input" />
                        </div>
                        <div class="form-field-group">
                            <label for="c_phone" class="form-label"><?php esc_html_e( 'Phone', 'figma-trial-theme' ); ?></label>
                            <input type="tel" id="c_phone" name="phone" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'figma-trial-theme' ); ?>" required class="form-input" />
                        </div>
                    </div>

                    <!-- Row 2: Property Preferences (4 Columns) -->
                    <div class="consultation-grid-4col">
                        <div class="form-field-group">
                            <label for="c_location" class="form-label"><?php esc_html_e( 'Preferred Location', 'figma-trial-theme' ); ?></label>
                            <div class="select-wrapper">
                                <select id="c_location" name="preferred_location" class="form-select">
                                    <option value="" selected><?php esc_html_e( 'Select Location', 'figma-trial-theme' ); ?></option>
                                    <option value="malibu">Malibu, California</option>
                                    <option value="newyork">New York, NY</option>
                                    <option value="aspen">Aspen, Colorado</option>
                                    <option value="miami">Miami, Florida</option>
                                    <option value="london">London, UK</option>
                                    <option value="tokyo">Tokyo, Japan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-field-group">
                            <label for="c_type" class="form-label"><?php esc_html_e( 'Property Type', 'figma-trial-theme' ); ?></label>
                            <div class="select-wrapper">
                                <select id="c_type" name="property_type" class="form-select">
                                    <option value="" selected><?php esc_html_e( 'Select Property Type', 'figma-trial-theme' ); ?></option>
                                    <option value="villa">Luxury Villa</option>
                                    <option value="penthouse">Penthouse / Apartment</option>
                                    <option value="cottage">Cottage / Country House</option>
                                    <option value="commercial">Commercial Estate</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-field-group">
                            <label for="c_bathrooms" class="form-label"><?php esc_html_e( 'No. of Bathrooms', 'figma-trial-theme' ); ?></label>
                            <div class="select-wrapper">
                                <select id="c_bathrooms" name="bathrooms" class="form-select">
                                    <option value="" selected><?php esc_html_e( 'Select Bathrooms', 'figma-trial-theme' ); ?></option>
                                    <option value="1">1 Bathroom</option>
                                    <option value="2">2 Bathrooms</option>
                                    <option value="3">3 Bathrooms</option>
                                    <option value="4+">4+ Bathrooms</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-field-group">
                            <label for="c_bedrooms" class="form-label"><?php esc_html_e( 'No. of Bedrooms', 'figma-trial-theme' ); ?></label>
                            <div class="select-wrapper">
                                <select id="c_bedrooms" name="bedrooms" class="form-select">
                                    <option value="" selected><?php esc_html_e( 'Select Bedrooms', 'figma-trial-theme' ); ?></option>
                                    <option value="1">1 Bedroom</option>
                                    <option value="2">2 Bedrooms</option>
                                    <option value="3">3 Bedrooms</option>
                                    <option value="4+">4+ Bedrooms</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Budget & Contact Preference (2 Columns) -->
                    <div class="consultation-grid-2col">
                        <div class="form-field-group">
                            <label for="c_budget" class="form-label"><?php esc_html_e( 'Budget', 'figma-trial-theme' ); ?></label>
                            <div class="select-wrapper">
                                <select id="c_budget" name="budget" class="form-select">
                                    <option value="" selected><?php esc_html_e( 'Select Budget', 'figma-trial-theme' ); ?></option>
                                    <option value="500k-1m">$500,000 - $1,000,000</option>
                                    <option value="1m-2m">$1,000,000 - $2,000,000</option>
                                    <option value="2m-5m">$2,000,000 - $5,000,000</option>
                                    <option value="5m+">$5,000,000+</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-field-group">
                            <label class="form-label"><?php esc_html_e( 'Preferred Contact Method', 'figma-trial-theme' ); ?></label>
                            <div class="contact-method-options">
                                <label class="contact-method-pill">
                                    <input type="radio" name="contact_method" value="phone" checked class="contact-method-radio" />
                                    <span class="method-pill-icon" aria-hidden="true">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        </svg>
                                    </span>
                                    <span class="method-pill-text"><?php esc_html_e( 'Phone', 'figma-trial-theme' ); ?></span>
                                </label>
                                <label class="contact-method-pill">
                                    <input type="radio" name="contact_method" value="email" class="contact-method-radio" />
                                    <span class="method-pill-icon" aria-hidden="true">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="20" height="16" x="2" y="4" rx="2"/>
                                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                        </svg>
                                    </span>
                                    <span class="method-pill-text"><?php esc_html_e( 'Email', 'figma-trial-theme' ); ?></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Row 4: Message Textarea (Full Width) -->
                    <div class="form-field-group full-width">
                        <label for="c_message" class="form-label"><?php esc_html_e( 'Message', 'figma-trial-theme' ); ?></label>
                        <textarea id="c_message" name="message" rows="5" placeholder="<?php esc_attr_e( 'Enter your Message here...', 'figma-trial-theme' ); ?>" required class="form-textarea"></textarea>
                    </div>

                    <!-- Row 5: Agreement & Submit Button -->
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
</div>
