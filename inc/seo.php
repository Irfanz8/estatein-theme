<?php
/**
 * Estatein SEO & Structured Data Engine
 *
 * Implements comprehensive, high-performance SEO for the Estatein real estate theme:
 * - Keyword-optimized Document Titles (pre_get_document_title & document_title_parts)
 * - Dynamic, contextual Meta Descriptions
 * - Self-referencing Canonical URLs
 * - Robots Directives & Max Snippet controls
 * - Full OpenGraph (Facebook, WhatsApp, LinkedIn) & Twitter Card tags
 * - Schema.org JSON-LD Structured Data:
 *     * RealEstateAgent / Organization
 *     * WebSite with SearchAction
 *     * RealEstateListing / SingleFamilyResidence for Properties
 *     * FAQPage Rich Snippet on Home Page
 *     * BreadcrumbList on Subpages & Single Properties
 * - XML Sitemap & Robots.txt Directives
 * - Admin SEO Meta Box with Live Google Snippet Preview & Custom Overrides
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * ============================================================================
 * 1. SEO TITLE GENERATOR
 * ============================================================================
 */

/**
 * Generate an optimized document title for the current view
 *
 * @param int|null $post_id Optional post ID.
 * @return string Optimized title string.
 */
function estatein_get_seo_title( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_queried_object_id();
    }

    // 1. Check custom override first
    if ( $post_id ) {
        $custom_title = get_post_meta( $post_id, '_estatein_seo_title', true );
        if ( ! empty( $custom_title ) ) {
            return esc_html( trim( $custom_title ) );
        }
    }

    $site_name = get_bloginfo( 'name' ) ?: 'Estatein';

    // 2. Front Page / Homepage
    if ( is_front_page() || ( $post_id && (int) get_option( 'page_on_front' ) === (int) $post_id ) ) {
        $hero_title = estatein_get_page_field( 'home_hero_title', $post_id );
        if ( ! empty( $hero_title ) && stripos( $hero_title, 'Discover' ) !== false ) {
            return $site_name . ' - Real Estate & Luxury Property Listings | Discover Your Dream Home';
        }
        return $site_name . ' - Premier Real Estate & Luxury Properties for Sale';
    }

    // 3. Single Property Post
    if ( is_singular( 'property' ) || ( $post_id && get_post_type( $post_id ) === 'property' ) ) {
        $raw_title  = get_the_title( $post_id );
        $title      = ! empty( $raw_title ) ? $raw_title : 'Luxury Property';
        $location   = estatein_get_property_field( 'property_location', $post_id );
        $bedrooms   = estatein_get_property_field( 'property_bedrooms', $post_id );
        $bathrooms  = estatein_get_property_field( 'property_bathrooms', $post_id );

        $specs = array();
        if ( ! empty( $bedrooms ) ) {
            $beds_num = preg_replace( '/[^0-9]/', '', $bedrooms );
            $specs[]  = ( $beds_num ? $beds_num : $bedrooms ) . ' Bed';
        }
        if ( ! empty( $bathrooms ) ) {
            $baths_num = preg_replace( '/[^0-9]/', '', $bathrooms );
            $specs[]   = ( $baths_num ? $baths_num : $bathrooms ) . ' Bath';
        }
        $spec_str = ! empty( $specs ) ? ' (' . implode( ', ', $specs ) . ')' : '';

        if ( ! empty( $location ) ) {
            return $title . $spec_str . ' in ' . $location . ' | ' . $site_name;
        }
        return $title . $spec_str . ' for Sale | ' . $site_name;
    }

    // 4. Properties Catalog Page / Archive
    if ( is_page( 'properties' ) || is_page_template( 'template-properties.php' ) || is_post_type_archive( 'property' ) ) {
        return 'Browse Luxury Real Estate & Homes for Sale | ' . $site_name . ' Properties';
    }

    // 5. About Us Page
    if ( is_page( 'about-us' ) || is_page_template( 'template-about-us.php' ) ) {
        return 'About ' . $site_name . ' - Our Journey, Values & Trusted Real Estate Team';
    }

    // 6. Services Page
    if ( is_page( 'services' ) || is_page_template( 'template-services.php' ) ) {
        return 'Real Estate Valuation, Investment & Property Management | ' . $site_name . ' Services';
    }

    // 7. Contact Us Page
    if ( is_page( 'contact-us' ) || is_page( 'contact' ) || is_page_template( 'template-contact-us.php' ) ) {
        return 'Contact ' . $site_name . ' - Inquire About Luxury Properties & Support';
    }

    // 8. Property Category Taxonomy
    if ( is_tax( 'property_category' ) ) {
        $term = get_queried_object();
        if ( $term && isset( $term->name ) ) {
            return $term->name . ' Properties for Sale | ' . $site_name . ' Real Estate';
        }
    }

    // 9. Search Page
    if ( is_search() ) {
        return 'Search Results for "' . get_search_query() . '" | ' . $site_name . ' Real Estate';
    }

    // 10. 404 Page
    if ( is_404() ) {
        return 'Page Not Found (404) | ' . $site_name;
    }

    // Standard Page / Post
    if ( $post_id ) {
        $page_title = get_the_title( $post_id );
        if ( ! empty( $page_title ) ) {
            return $page_title . ' | ' . $site_name;
        }
    }

    return get_bloginfo( 'name' );
}

/**
 * Filter the document title produced by wp_get_document_title()
 */
add_filter( 'pre_get_document_title', function( $title ) {
    $optimized = estatein_get_seo_title();
    return ! empty( $optimized ) ? $optimized : $title;
}, 20 );

/**
 * Filter the document title parts as an extra layer
 */
add_filter( 'document_title_parts', function( $parts ) {
    $optimized = estatein_get_seo_title();
    if ( ! empty( $optimized ) ) {
        $parts['title'] = $optimized;
        unset( $parts['site'], $parts['tagline'] );
    }
    return $parts;
}, 20 );


/**
 * ============================================================================
 * 2. SEO META DESCRIPTION GENERATOR
 * ============================================================================
 */

/**
 * Generate a clean, 150-160 character meta description
 *
 * @param int|null $post_id Optional post ID.
 * @return string Clean meta description.
 */
function estatein_get_seo_description( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_queried_object_id();
    }

    // 1. Custom override first
    if ( $post_id ) {
        $custom_desc = get_post_meta( $post_id, '_estatein_seo_desc', true );
        if ( ! empty( $custom_desc ) ) {
            return estatein_clean_seo_text( $custom_desc, 160 );
        }
    }

    // 2. Front Page / Homepage
    if ( is_front_page() || ( $post_id && (int) get_option( 'page_on_front' ) === (int) $post_id ) ) {
        $hero_desc = estatein_get_page_field( 'home_hero_desc', $post_id );
        if ( ! empty( $hero_desc ) ) {
            return estatein_clean_seo_text( $hero_desc, 160 );
        }
        return 'Explore verified luxury real estate, villas, and premium properties with Estatein. Start your journey to finding your dream home today.';
    }

    // 3. Single Property Post
    if ( is_singular( 'property' ) || ( $post_id && get_post_type( $post_id ) === 'property' ) ) {
        $title     = get_the_title( $post_id );
        $price     = estatein_get_property_field( 'property_price', $post_id );
        $location  = estatein_get_property_field( 'property_location', $post_id );
        $bedrooms  = estatein_get_property_field( 'property_bedrooms', $post_id );
        $bathrooms = estatein_get_property_field( 'property_bathrooms', $post_id );
        $desc      = estatein_get_property_field( 'property_description', $post_id );

        if ( ! empty( $desc ) ) {
            return estatein_clean_seo_text( $desc, 160 );
        }

        $specs = array();
        if ( ! empty( $bedrooms ) ) {
            $specs[] = $bedrooms . ' bedrooms';
        }
        if ( ! empty( $bathrooms ) ) {
            $specs[] = $bathrooms . ' bathrooms';
        }
        $spec_txt = ! empty( $specs ) ? ' with ' . implode( ' and ', $specs ) : '';
        $loc_txt  = ! empty( $location ) ? ' in ' . $location : '';
        $prc_txt  = ! empty( $price ) ? ' for ' . $price : '';

        return estatein_clean_seo_text( "Discover {$title}{$loc_txt}{$spec_txt}{$prc_txt}. View photos, architectural amenities, and contact Estatein for private viewings.", 160 );
    }

    // 4. Properties Catalog Page
    if ( is_page( 'properties' ) || is_page_template( 'template-properties.php' ) || is_post_type_archive( 'property' ) ) {
        $hero_desc = estatein_get_page_field( 'properties_hero_desc', $post_id );
        if ( ! empty( $hero_desc ) ) {
            return estatein_clean_seo_text( $hero_desc, 160 );
        }
        return 'Browse our curated catalog of luxury properties, villas, and modern apartments for sale. Filter by location, price, and category with Estatein.';
    }

    // 5. About Us Page
    if ( is_page( 'about-us' ) || is_page_template( 'template-about-us.php' ) ) {
        $about_desc = estatein_get_page_field( 'about_journey_desc', $post_id );
        if ( ! empty( $about_desc ) ) {
            return estatein_clean_seo_text( $about_desc, 160 );
        }
        return "Learn about Estatein's journey, our commitment to excellence, core values, and expert real estate advisors guiding clients worldwide.";
    }

    // 6. Services Page
    if ( is_page( 'services' ) || is_page_template( 'template-services.php' ) ) {
        $services_desc = estatein_get_page_field( 'services_hero_desc', $post_id );
        if ( ! empty( $services_desc ) ) {
            return estatein_clean_seo_text( $services_desc, 160 );
        }
        return "Explore Estatein's full spectrum of real estate services: property valuation, strategic investment consulting, property management, and smart acquisitions.";
    }

    // 7. Contact Us Page
    if ( is_page( 'contact-us' ) || is_page( 'contact' ) || is_page_template( 'template-contact-us.php' ) ) {
        $contact_desc = estatein_get_page_field( 'contact_hero_desc', $post_id );
        if ( ! empty( $contact_desc ) ) {
            return estatein_clean_seo_text( $contact_desc, 160 );
        }
        return 'Connect with Estatein real estate specialists. Schedule a private property viewing, consult investment advisors, or get quick assistance today.';
    }

    // 8. Property Category
    if ( is_tax( 'property_category' ) ) {
        $term = get_queried_object();
        if ( $term && isset( $term->description ) && ! empty( $term->description ) ) {
            return estatein_clean_seo_text( $term->description, 160 );
        }
        $name = ( $term && isset( $term->name ) ) ? $term->name : 'luxury';
        return "Browse verified {$name} properties for sale with Estatein. Exclusive selections, prime locations, transparent pricing, and high investment yields.";
    }

    // Fallback: Post excerpt or content
    if ( $post_id ) {
        $post = get_post( $post_id );
        if ( $post ) {
            if ( ! empty( $post->post_excerpt ) ) {
                return estatein_clean_seo_text( $post->post_excerpt, 160 );
            }
            if ( ! empty( $post->post_content ) ) {
                return estatein_clean_seo_text( $post->post_content, 160 );
            }
        }
    }

    $blog_desc = get_bloginfo( 'description' );
    if ( ! empty( $blog_desc ) ) {
        return estatein_clean_seo_text( $blog_desc, 160 );
    }

    return 'Estatein is a premier real estate platform offering luxury residential and commercial properties with verified listings and transparent pricing.';
}

/**
 * Clean and truncate string for SEO meta descriptions
 */
function estatein_clean_seo_text( $text, $max_chars = 160 ) {
    $text = wp_strip_all_tags( $text );
    $text = preg_replace( '/\s+/', ' ', $text );
    $text = trim( $text );

    if ( mb_strlen( $text ) > $max_chars ) {
        $sub = mb_substr( $text, 0, $max_chars - 3 );
        $last_space = mb_strrpos( $sub, ' ' );
        if ( $last_space !== false ) {
            $sub = mb_substr( $sub, 0, $last_space );
        }
        $text = $sub . '...';
    }
    return esc_attr( $text );
}


/**
 * ============================================================================
 * 3. CANONICAL & SOCIAL SHARE IMAGE URLS
 * ============================================================================
 */

/**
 * Get the canonical URL for the current view
 */
function estatein_get_seo_canonical_url() {
    if ( is_front_page() ) {
        return home_url( '/' );
    }

    if ( is_singular() ) {
        return get_permalink();
    }

    if ( is_post_type_archive( 'property' ) ) {
        return get_post_type_archive_link( 'property' );
    }

    if ( is_tax() || is_category() || is_tag() ) {
        $term = get_queried_object();
        if ( $term && isset( $term->term_id ) ) {
            return get_term_link( $term );
        }
    }

    if ( is_search() ) {
        return home_url( '/?s=' . urlencode( get_search_query() ) );
    }

    return home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
}

/**
 * Get primary image URL for OpenGraph and Twitter cards
 */
function estatein_get_seo_image_url( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_queried_object_id();
    }

    // 1. Custom SEO image override
    if ( $post_id ) {
        $custom_img = get_post_meta( $post_id, '_estatein_seo_image', true );
        if ( ! empty( $custom_img ) ) {
            return esc_url( $custom_img );
        }
    }

    // 2. Featured Image (Post Thumbnail)
    if ( $post_id && has_post_thumbnail( $post_id ) ) {
        $thumb = get_the_post_thumbnail_url( $post_id, 'full' );
        if ( ! empty( $thumb ) ) {
            return esc_url( $thumb );
        }
    }

    // 3. Single Property specific images
    if ( $post_id && get_post_type( $post_id ) === 'property' ) {
        $img1 = estatein_get_property_field( 'property_image_1', $post_id );
        if ( ! empty( $img1 ) ) {
            if ( is_array( $img1 ) && ! empty( $img1['url'] ) ) {
                return esc_url( $img1['url'] );
            }
            if ( is_string( $img1 ) ) {
                return esc_url( $img1 );
            }
        }
        $img_url = estatein_get_property_field( 'property_image_url', $post_id );
        if ( ! empty( $img_url ) ) {
            return esc_url( $img_url );
        }
    }

    // 4. Homepage Hero Image
    if ( is_front_page() || ( $post_id && (int) get_option( 'page_on_front' ) === (int) $post_id ) ) {
        $h_img = estatein_get_page_field( 'home_hero_image', $post_id );
        if ( ! empty( $h_img ) ) {
            if ( is_array( $h_img ) && ! empty( $h_img['url'] ) ) {
                return esc_url( $h_img['url'] );
            }
            if ( is_string( $h_img ) ) {
                return esc_url( $h_img );
            }
        }
    }

    // 5. Default Theme Logo / Fallback OpenGraph banner
    $logo_fallback = get_template_directory_uri() . '/assets/images/logo-emblem.png';
    return esc_url( $logo_fallback );
}


/**
 * ============================================================================
 * 4. RENDER META TAGS IN <HEAD> (wp_head)
 * ============================================================================
 */
function estatein_render_seo_meta_tags() {
    $seo_title = estatein_get_seo_title();
    $seo_desc  = estatein_get_seo_description();
    $canonical = estatein_get_seo_canonical_url();
    $seo_img   = estatein_get_seo_image_url();
    $site_name = get_bloginfo( 'name' ) ?: 'Estatein';
    $og_type   = is_singular( 'property' ) ? 'article' : 'website';

    // Robots meta directive
    $robots = ( is_search() || is_404() ) ? 'noindex, follow' : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    ?>
    <!-- Estatein SEO Engine: Core Meta Tags -->
    <meta name="description" content="<?php echo esc_attr( $seo_desc ); ?>" />
    <meta name="robots" content="<?php echo esc_attr( $robots ); ?>" />
    <?php if ( ! empty( $canonical ) ) : ?>
    <link rel="canonical" href="<?php echo esc_url( $canonical ); ?>" />
    <?php endif; ?>

    <!-- Open Graph / Facebook / WhatsApp / LinkedIn -->
    <meta property="og:locale" content="<?php echo esc_attr( get_locale() ); ?>" />
    <meta property="og:type" content="<?php echo esc_attr( $og_type ); ?>" />
    <meta property="og:title" content="<?php echo esc_attr( $seo_title ); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( $seo_desc ); ?>" />
    <meta property="og:url" content="<?php echo esc_url( $canonical ); ?>" />
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>" />
    <?php if ( ! empty( $seo_img ) ) : ?>
    <meta property="og:image" content="<?php echo esc_url( $seo_img ); ?>" />
    <meta property="og:image:secure_url" content="<?php echo esc_url( $seo_img ); ?>" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:alt" content="<?php echo esc_attr( $seo_title ); ?>" />
    <?php endif; ?>

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr( $seo_title ); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr( $seo_desc ); ?>" />
    <?php if ( ! empty( $seo_img ) ) : ?>
    <meta name="twitter:image" content="<?php echo esc_url( $seo_img ); ?>" />
    <meta name="twitter:image:alt" content="<?php echo esc_attr( $seo_title ); ?>" />
    <?php endif; ?>
    <?php
}
add_action( 'wp_head', 'estatein_render_seo_meta_tags', 1 );


/**
 * ============================================================================
 * 5. SCHEMA.ORG JSON-LD STRUCTURED DATA
 * ============================================================================
 */
function estatein_render_json_ld_schema() {
    $site_url  = home_url( '/' );
    $site_name = get_bloginfo( 'name' ) ?: 'Estatein';
    $logo_url  = get_template_directory_uri() . '/assets/images/logo-emblem.png';

    $schemas = array();

    // 1. RealEstateAgent / Organization Schema (Universal)
    $org_schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'RealEstateAgent',
        '@id'         => esc_url( $site_url ) . '#organization',
        'name'        => $site_name,
        'url'         => esc_url( $site_url ),
        'logo'        => array(
            '@type'   => 'ImageObject',
            'url'     => esc_url( $logo_url ),
            'width'   => 512,
            'height'  => 512,
        ),
        'image'       => esc_url( $logo_url ),
        'description' => 'Estatein is a premier real estate platform offering luxury residential and commercial properties with verified listings and transparent pricing.',
        'telephone'   => '+1-555-019-2834',
        'email'       => 'info@estatein.com',
        'address'     => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => '100 Wilshire Blvd, Suite 700',
            'addressLocality' => 'Santa Monica',
            'addressRegion'   => 'CA',
            'postalCode'      => '90401',
            'addressCountry'  => 'US',
        ),
        'priceRange'  => '$$$$',
    );
    $schemas[] = $org_schema;

    // 2. WebSite with Sitelinks Searchbox (Homepage)
    if ( is_front_page() ) {
        $website_schema = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            '@id'             => esc_url( $site_url ) . '#website',
            'url'             => esc_url( $site_url ),
            'name'            => $site_name,
            'potentialAction' => array(
                '@type'       => 'SearchAction',
                'target'      => esc_url( home_url( '/properties/?search_property={search_term_string}' ) ),
                'query-input' => 'required name=search_term_string',
            ),
        );
        $schemas[] = $website_schema;

        // 3. FAQPage Schema on Homepage
        $faq_items = array();
        $faq_1_q = estatein_get_page_field( 'home_faq_1_q', null, 'How do I search for properties on Estatein?' );
        $faq_1_a = estatein_get_page_field( 'home_faq_1_a', null, 'Learn how to use our search filters to find properties that match your criteria, including price, bedrooms, location, and property type.' );
        $faq_2_q = estatein_get_page_field( 'home_faq_2_q', null, 'What documents do I need to sell my property through Estatein?' );
        $faq_2_a = estatein_get_page_field( 'home_faq_2_a', null, 'Find out about the necessary documentation required to list and sell your property with our verified agents and legal advisors.' );
        $faq_3_q = estatein_get_page_field( 'home_faq_3_q', null, 'How can I contact an Estatein agent for property viewing?' );
        $faq_3_a = estatein_get_page_field( 'home_faq_3_a', null, 'Discover the various ways to get in touch with our dedicated property agents through our direct contact page or individual listing forms.' );

        $raw_faqs = array(
            array( 'q' => $faq_1_q, 'a' => $faq_1_a ),
            array( 'q' => $faq_2_q, 'a' => $faq_2_a ),
            array( 'q' => $faq_3_q, 'a' => $faq_3_a ),
        );

        foreach ( $raw_faqs as $faq ) {
            if ( ! empty( $faq['q'] ) && ! empty( $faq['a'] ) ) {
                $faq_items[] = array(
                    '@type'          => 'Question',
                    'name'           => esc_html( $faq['q'] ),
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => esc_html( $faq['a'] ),
                    ),
                );
            }
        }

        if ( ! empty( $faq_items ) ) {
            $schemas[] = array(
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => $faq_items,
            );
        }
    }

    // 4. Single Property RealEstateListing & SingleFamilyResidence Schema
    if ( is_singular( 'property' ) ) {
        $prop_id   = get_the_ID();
        $raw_title = get_the_title( $prop_id );
        $title     = ! empty( $raw_title ) ? $raw_title : 'Estatein Property';
        $price     = estatein_get_property_field( 'property_price', $prop_id, '$1,250,000' );
        $location  = estatein_get_property_field( 'property_location', $prop_id, 'Malibu, California' );
        $bedrooms  = estatein_get_property_field( 'property_bedrooms', $prop_id, '4' );
        $bathrooms = estatein_get_property_field( 'property_bathrooms', $prop_id, '3' );
        $area      = estatein_get_property_field( 'property_area', $prop_id, '2,500 Sq. Ft' );
        $desc      = estatein_get_property_field( 'property_description', $prop_id );
        if ( empty( $desc ) ) {
            $desc = get_the_excerpt( $prop_id ) ?: "Luxury real estate property listed with Estatein in {$location}.";
        }

        // Price sanitization to clean numeric
        $clean_price = preg_replace( '/[^0-9.]/', '', $price );
        $clean_beds  = (int) preg_replace( '/[^0-9]/', '', $bedrooms );
        $clean_baths = (int) preg_replace( '/[^0-9]/', '', $bathrooms );
        $clean_sqft  = (int) preg_replace( '/[^0-9]/', '', $area );

        // Gather images
        $images = array();
        if ( has_post_thumbnail( $prop_id ) ) {
            $images[] = get_the_post_thumbnail_url( $prop_id, 'full' );
        }
        for ( $i = 1; $i <= 6; $i++ ) {
            $img = estatein_get_property_field( "property_image_{$i}", $prop_id );
            if ( ! empty( $img ) ) {
                $i_url = is_array( $img ) ? ( $img['url'] ?? '' ) : (string) $img;
                if ( ! empty( $i_url ) && ! in_array( $i_url, $images, true ) ) {
                    $images[] = $i_url;
                }
            }
        }
        if ( empty( $images ) ) {
            $images[] = estatein_get_seo_image_url( $prop_id );
        }

        $amenities_raw = estatein_get_property_field( 'property_amenities', $prop_id );
        $amenity_specs = array();
        if ( ! empty( $amenities_raw ) ) {
            $lines = preg_split( '/\r\n|\r|\n/', trim( $amenities_raw ) );
            foreach ( $lines as $line ) {
                $line = trim( $line );
                if ( ! empty( $line ) ) {
                    $amenity_specs[] = array(
                        '@type' => 'LocationFeatureSpecification',
                        'name'  => esc_html( $line ),
                        'value' => true,
                    );
                }
            }
        }

        $property_schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'RealEstateListing',
            'name'        => esc_html( $title ),
            'description' => esc_html( wp_strip_all_tags( $desc ) ),
            'url'         => esc_url( get_permalink( $prop_id ) ),
            'image'       => array_map( 'esc_url', $images ),
            'offers'      => array(
                '@type'         => 'Offer',
                'price'         => ! empty( $clean_price ) ? $clean_price : '1250000',
                'priceCurrency' => 'USD',
                'availability'  => 'https://schema.org/InStock',
                'validFrom'     => get_the_date( 'c', $prop_id ),
            ),
            'itemOffered' => array(
                '@type'                  => 'SingleFamilyResidence',
                'name'                   => esc_html( $title ),
                'description'            => esc_html( wp_strip_all_tags( $desc ) ),
                'numberOfBedrooms'       => $clean_beds > 0 ? $clean_beds : 4,
                'numberOfBathroomsTotal' => $clean_baths > 0 ? $clean_baths : 3,
                'numberOfRooms'          => ( $clean_beds + $clean_baths ) > 0 ? ( $clean_beds + $clean_baths ) : 7,
                'floorSize'              => array(
                    '@type'    => 'QuantitativeValue',
                    'value'    => $clean_sqft > 0 ? $clean_sqft : 2500,
                    'unitCode' => 'FTK',
                ),
                'address'                => array(
                    '@type'          => 'PostalAddress',
                    'streetAddress'  => esc_html( $location ),
                    'addressCountry' => 'US',
                ),
            ),
        );

        if ( ! empty( $amenity_specs ) ) {
            $property_schema['itemOffered']['amenityFeature'] = $amenity_specs;
        }

        $schemas[] = $property_schema;
    }

    // 5. BreadcrumbList Schema (Subpages and Single Properties)
    if ( ! is_front_page() ) {
        $breadcrumbs = array();
        $breadcrumbs[] = array(
            '@type'    => 'ListItem',
            'position' => 1,
            'name'     => 'Home',
            'item'     => esc_url( home_url( '/' ) ),
        );

        $pos = 2;
        if ( is_singular( 'property' ) ) {
            $breadcrumbs[] = array(
                '@type'    => 'ListItem',
                'position' => $pos++,
                'name'     => 'Properties',
                'item'     => esc_url( home_url( '/properties/' ) ),
            );
            $breadcrumbs[] = array(
                '@type'    => 'ListItem',
                'position' => $pos,
                'name'     => get_the_title(),
                'item'     => esc_url( get_permalink() ),
            );
        } elseif ( is_page() ) {
            $breadcrumbs[] = array(
                '@type'    => 'ListItem',
                'position' => $pos,
                'name'     => get_the_title(),
                'item'     => esc_url( get_permalink() ),
            );
        }

        if ( count( $breadcrumbs ) > 1 ) {
            $schemas[] = array(
                '@context'        => 'https://schema.org',
                '@type'           => 'BreadcrumbList',
                'itemListElement' => $breadcrumbs,
            );
        }
    }

    // Output all schemas
    foreach ( $schemas as $schema ) {
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'estatein_render_json_ld_schema', 2 );


/**
 * ============================================================================
 * 6. SITEMAP & ROBOTS.TXT DIRECTIVES
 * ============================================================================
 */

/**
 * Append sitemap reference to robots.txt output
 */
add_filter( 'robots_txt', function( $output, $public ) {
    if ( '1' === (string) $public ) {
        $sitemap_url = home_url( '/wp-sitemap.xml' );
        $output     .= "\n# Estatein Real Estate SEO Engine\n";
        $output     .= "Sitemap: {$sitemap_url}\n";
    }
    return $output;
}, 10, 2 );

/**
 * Ensure property custom post type and taxonomy are included in WordPress core sitemap
 */
add_filter( 'wp_sitemaps_post_types', function( $post_types ) {
    if ( isset( $post_types['property'] ) ) {
        return $post_types;
    }
    $cpt = get_post_type_object( 'property' );
    if ( $cpt ) {
        $post_types['property'] = $cpt;
    }
    return $post_types;
} );

add_filter( 'wp_sitemaps_taxonomies', function( $taxonomies ) {
    if ( isset( $taxonomies['property_category'] ) ) {
        return $taxonomies;
    }
    $tax = get_taxonomy( 'property_category' );
    if ( $tax ) {
        $taxonomies['property_category'] = $tax;
    }
    return $taxonomies;
} );


/**
 * ============================================================================
 * 7. ADMIN SEO METABOX (WITH LIVE GOOGLE SERP PREVIEW)
 * ============================================================================
 */

/**
 * Register SEO metabox for Pages and Properties
 */
function estatein_register_seo_metabox() {
    $screens = array( 'page', 'property', 'post' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'estatein_seo_metabox',
            __( '★ Estatein SEO & Social Search Preview', 'figma-trial-theme' ),
            'estatein_render_seo_metabox',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'estatein_register_seo_metabox' );

/**
 * Render SEO metabox HTML
 */
function estatein_render_seo_metabox( $post ) {
    wp_nonce_field( 'estatein_save_seo_meta', 'estatein_seo_meta_nonce' );

    $saved_title = get_post_meta( $post->ID, '_estatein_seo_title', true );
    $saved_desc  = get_post_meta( $post->ID, '_estatein_seo_desc', true );
    $saved_img   = get_post_meta( $post->ID, '_estatein_seo_image', true );

    $default_title = estatein_get_seo_title( $post->ID );
    $default_desc  = estatein_get_seo_description( $post->ID );
    $permalink     = get_permalink( $post->ID ) ?: home_url( '/' );
    ?>
    <div class="estatein-seo-box-wrap">
        <style>
            .estatein-seo-box-wrap {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                padding: 10px 0;
            }
            .estatein-serp-preview {
                background: #ffffff;
                border: 1px solid #dfe1e5;
                border-radius: 8px;
                padding: 16px 20px;
                margin-bottom: 24px;
                box-shadow: 0 1px 6px rgba(32,33,36,0.08);
                max-width: 650px;
            }
            .serp-header {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 6px;
            }
            .serp-favicon {
                width: 18px;
                height: 18px;
                border-radius: 50%;
                background: #703bf7;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 10px;
                font-weight: bold;
            }
            .serp-site-info {
                display: flex;
                flex-direction: column;
                font-size: 12px;
                line-height: 1.3;
            }
            .serp-site-name {
                color: #202124;
                font-weight: 500;
            }
            .serp-url {
                color: #4d5156;
                word-break: break-all;
            }
            .serp-title {
                color: #1a0dab;
                font-size: 18px;
                line-height: 1.3;
                font-weight: 400;
                margin: 4px 0 6px 0;
                cursor: pointer;
                text-decoration: none;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .serp-title:hover {
                text-decoration: underline;
            }
            .serp-desc {
                color: #4d5156;
                font-size: 14px;
                line-height: 1.58;
                margin: 0;
                word-wrap: break-word;
            }
            .seo-field-group {
                margin-bottom: 20px;
            }
            .seo-field-group label {
                display: block;
                font-size: 13px;
                font-weight: 600;
                color: #1d2327;
                margin-bottom: 6px;
            }
            .seo-field-group input[type="text"],
            .seo-field-group textarea {
                width: 100%;
                padding: 10px 14px;
                border: 1px solid #8c8f94;
                border-radius: 6px;
                font-size: 14px;
                box-sizing: border-box;
            }
            .seo-field-group input[type="text"]:focus,
            .seo-field-group textarea:focus {
                border-color: #703bf7;
                box-shadow: 0 0 0 1px #703bf7;
                outline: none;
            }
            .seo-helper {
                display: flex;
                justify-content: space-between;
                font-size: 12px;
                color: #646970;
                margin-top: 5px;
            }
            .char-counter.good { color: #10b981; font-weight: 600; }
            .char-counter.warning { color: #f59e0b; font-weight: 600; }
            .char-counter.over { color: #ef4444; font-weight: 600; }
        </style>

        <!-- Live Google Search Result Preview -->
        <div style="font-weight: 600; font-size: 14px; color: #1d2327; margin-bottom: 8px;">
            <?php _e( 'Google Search Snippet Preview:', 'figma-trial-theme' ); ?>
        </div>
        <div class="estatein-serp-preview">
            <div class="serp-header">
                <div class="serp-favicon">E</div>
                <div class="serp-site-info">
                    <span class="serp-site-name">Estatein</span>
                    <span class="serp-url" id="preview-url"><?php echo esc_html( $permalink ); ?></span>
                </div>
            </div>
            <div class="serp-title" id="preview-title">
                <?php echo esc_html( ! empty( $saved_title ) ? $saved_title : $default_title ); ?>
            </div>
            <p class="serp-desc" id="preview-desc">
                <?php echo esc_html( ! empty( $saved_desc ) ? $saved_desc : $default_desc ); ?>
            </p>
        </div>

        <!-- Custom SEO Title -->
        <div class="seo-field-group">
            <label for="estatein_seo_title"><?php _e( 'Custom SEO Title', 'figma-trial-theme' ); ?></label>
            <input type="text" id="estatein_seo_title" name="estatein_seo_title" value="<?php echo esc_attr( $saved_title ); ?>" placeholder="<?php echo esc_attr( $default_title ); ?>" />
            <div class="seo-helper">
                <span><?php _e( 'Biarkan kosong untuk menggunakan judul otomatis yang telah dioptimalkan SEO.', 'figma-trial-theme' ); ?></span>
                <span id="title-counter" class="char-counter">0 / 60</span>
            </div>
        </div>

        <!-- Custom Meta Description -->
        <div class="seo-field-group">
            <label for="estatein_seo_desc"><?php _e( 'Custom Meta Description', 'figma-trial-theme' ); ?></label>
            <textarea id="estatein_seo_desc" name="estatein_seo_desc" rows="3" placeholder="<?php echo esc_attr( $default_desc ); ?>"><?php echo esc_textarea( $saved_desc ); ?></textarea>
            <div class="seo-helper">
                <span><?php _e( 'Rekomendasi panjang deskripsi: 140–160 karakter agar tampil utuh di hasil pencarian.', 'figma-trial-theme' ); ?></span>
                <span id="desc-counter" class="char-counter">0 / 160</span>
            </div>
        </div>

        <!-- Custom Social Image URL -->
        <div class="seo-field-group">
            <label for="estatein_seo_image"><?php _e( 'Custom Social Image URL (OpenGraph / Twitter)', 'figma-trial-theme' ); ?></label>
            <input type="url" id="estatein_seo_image" name="estatein_seo_image" value="<?php echo esc_attr( $saved_img ); ?>" placeholder="https://example.com/social-preview.jpg" />
            <div class="seo-helper">
                <span><?php _e( 'Opsional. Jika kosong, sistem otomatis memakai Featured Image atau foto galeri properti.', 'figma-trial-theme' ); ?></span>
            </div>
        </div>
    </div>

    <script>
    (function($) {
        function updateSeoCounters() {
            var defaultTitle = <?php echo wp_json_encode( $default_title ); ?>;
            var defaultDesc  = <?php echo wp_json_encode( $default_desc ); ?>;

            var titleVal = $('#estatein_seo_title').val();
            var descVal  = $('#estatein_seo_desc').val();

            var currentTitle = titleVal ? titleVal : defaultTitle;
            var currentDesc  = descVal ? descVal : defaultDesc;

            $('#preview-title').text(currentTitle);
            $('#preview-desc').text(currentDesc);

            // Title counter
            var titleLen = currentTitle.length;
            var $tCount  = $('#title-counter');
            $tCount.text(titleLen + ' / 60');
            $tCount.removeClass('good warning over');
            if (titleLen <= 60) {
                $tCount.addClass('good');
            } else if (titleLen <= 70) {
                $tCount.addClass('warning');
            } else {
                $tCount.addClass('over');
            }

            // Desc counter
            var descLen = currentDesc.length;
            var $dCount = $('#desc-counter');
            $dCount.text(descLen + ' / 160');
            $dCount.removeClass('good warning over');
            if (descLen >= 120 && descLen <= 160) {
                $dCount.addClass('good');
            } else if (descLen < 120) {
                $dCount.addClass('warning');
            } else {
                $dCount.addClass('over');
            }
        }

        $(document).ready(function() {
            $('#estatein_seo_title, #estatein_seo_desc').on('input keyup paste', updateSeoCounters);
            updateSeoCounters();
        });
    })(jQuery);
    </script>
    <?php
}

/**
 * Save SEO meta box values
 */
function estatein_save_seo_metabox( $post_id ) {
    if ( ! isset( $_POST['estatein_seo_meta_nonce'] ) || ! wp_verify_nonce( $_POST['estatein_seo_meta_nonce'], 'estatein_save_seo_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['estatein_seo_title'] ) ) {
        $title = sanitize_text_field( wp_unslash( $_POST['estatein_seo_title'] ) );
        update_post_meta( $post_id, '_estatein_seo_title', $title );
    }

    if ( isset( $_POST['estatein_seo_desc'] ) ) {
        $desc = sanitize_textarea_field( wp_unslash( $_POST['estatein_seo_desc'] ) );
        update_post_meta( $post_id, '_estatein_seo_desc', $desc );
    }

    if ( isset( $_POST['estatein_seo_image'] ) ) {
        $img = esc_url_raw( wp_unslash( $_POST['estatein_seo_image'] ) );
        update_post_meta( $post_id, '_estatein_seo_image', $img );
    }
}
add_action( 'save_post', 'estatein_save_seo_metabox' );
