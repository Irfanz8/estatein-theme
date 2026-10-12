<?php
/**
 * Theme Functions & Setup
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Load Modular Theme Extensions & SEO Engine
 */
require_once get_template_directory() . '/inc/seo.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function figma_trial_theme_setup() {
    // Enable support for document title tag managed by WordPress
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );

    // Switch default core markup for search form, comment form, etc. to valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Register theme navigation menus
    register_nav_menus( array(
        'primary-menu' => esc_html__( 'Primary Menu', 'figma-trial-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'figma_trial_theme_setup' );

/**
 * Enqueue styles and scripts.
 */
function figma_trial_theme_scripts() {
    // 1. Enqueue Google Fonts (Urbanist - Figma design specification)
    wp_enqueue_style(
        'figma-trial-google-fonts',
        'https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // 2. Enqueue Main Theme Stylesheet (style.css with auto cache-busting)
    $style_path = get_stylesheet_directory() . '/style.css';
    $style_ver  = file_exists( $style_path ) ? filemtime( $style_path ) : time();

    wp_enqueue_style(
        'figma-trial-theme-style',
        get_stylesheet_uri(),
        array( 'figma-trial-google-fonts' ),
        $style_ver
    );

    // 3. Enqueue Main JavaScript (/assets/js/main.js)
    $script_path = get_template_directory() . '/assets/js/main.js';
    $script_ver  = file_exists( $script_path ) ? filemtime( $script_path ) : '1.0.0';

    wp_enqueue_script(
        'figma-trial-theme-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $script_ver,
        true // Load in footer before </body>
    );
}
add_action( 'wp_enqueue_scripts', 'figma_trial_theme_scripts' );

/**
 * Auto-create default pages (Home and Property Details) in the WordPress database if not yet present.
 */
function figma_trial_theme_create_default_pages() {
    // 1. Ensure Property Details page exists
    if ( ! get_page_by_path( 'property-details' ) ) {
        wp_insert_post( array(
            'post_title'    => 'Property Details',
            'post_name'     => 'property-details',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'page_template' => 'template-property-details.php',
        ) );
    }

    // 2. Ensure Home page exists and is set as front page
    if ( ! get_page_by_path( 'home' ) ) {
        $home_id = wp_insert_post( array(
            'post_title'    => 'Home',
            'post_name'     => 'home',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'page_template' => 'template-home.php',
        ) );

        if ( $home_id && ! is_wp_error( $home_id ) ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $home_id );
        }
    }

    // 3. Ensure About Us page exists
    if ( ! get_page_by_path( 'about-us' ) ) {
        wp_insert_post( array(
            'post_title'    => 'About Us',
            'post_name'     => 'about-us',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'page_template' => 'template-about-us.php',
        ) );
    }

    // 4. Ensure Properties page exists
    if ( ! get_page_by_path( 'properties' ) ) {
        wp_insert_post( array(
            'post_title'    => 'Properties',
            'post_name'     => 'properties',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'page_template' => 'template-properties.php',
        ) );
    }

    // 5. Ensure Services page exists
    if ( ! get_page_by_path( 'services' ) ) {
        wp_insert_post( array(
            'post_title'    => 'Services',
            'post_name'     => 'services',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'page_template' => 'template-services.php',
        ) );
    }

    // 6. Ensure Contact Us page exists
    if ( ! get_page_by_path( 'contact-us' ) && ! get_page_by_path( 'contact' ) ) {
        wp_insert_post( array(
            'post_title'    => 'Contact Us',
            'post_name'     => 'contact-us',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'page_template' => 'template-contact-us.php',
        ) );
    }
}
add_action( 'after_switch_theme', 'figma_trial_theme_create_default_pages' );
add_action( 'init', 'figma_trial_theme_create_default_pages' );

/**
 * ============================================================================
 * Custom Post Type: Property & Taxonomy: Property Category
 * ============================================================================
 */
function figma_trial_register_property_cpt() {
    $labels = array(
        'name'                  => _x( 'Properties', 'Post Type General Name', 'figma-trial-theme' ),
        'singular_name'         => _x( 'Property', 'Post Type Singular Name', 'figma-trial-theme' ),
        'menu_name'             => __( 'Properties', 'figma-trial-theme' ),
        'name_admin_bar'        => __( 'Property', 'figma-trial-theme' ),
        'archives'              => __( 'Property Archives', 'figma-trial-theme' ),
        'attributes'            => __( 'Property Attributes', 'figma-trial-theme' ),
        'parent_item_colon'     => __( 'Parent Property:', 'figma-trial-theme' ),
        'all_items'             => __( 'All Properties', 'figma-trial-theme' ),
        'add_new_item'          => __( 'Add New Property', 'figma-trial-theme' ),
        'add_new'               => __( 'Add New', 'figma-trial-theme' ),
        'new_item'              => __( 'New Property', 'figma-trial-theme' ),
        'edit_item'             => __( 'Edit Property', 'figma-trial-theme' ),
        'update_item'           => __( 'Update Property', 'figma-trial-theme' ),
        'view_item'             => __( 'View Property', 'figma-trial-theme' ),
        'view_items'            => __( 'View Properties', 'figma-trial-theme' ),
        'search_items'          => __( 'Search Property', 'figma-trial-theme' ),
    );
    $args = array(
        'label'                 => __( 'Property', 'figma-trial-theme' ),
        'description'           => __( 'Estatein Real Estate Properties', 'figma-trial-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
        'taxonomies'            => array( 'property_category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-home',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => false,
        'rewrite'               => array( 'slug' => 'property' ),
    );
    register_post_type( 'property', $args );

    $tax_labels = array(
        'name'              => _x( 'Property Categories', 'taxonomy general name', 'figma-trial-theme' ),
        'singular_name'     => _x( 'Property Category', 'taxonomy singular name', 'figma-trial-theme' ),
        'search_items'      => __( 'Search Categories', 'figma-trial-theme' ),
        'all_items'         => __( 'All Categories', 'figma-trial-theme' ),
        'parent_item'       => __( 'Parent Category', 'figma-trial-theme' ),
        'parent_item_colon' => __( 'Parent Category:', 'figma-trial-theme' ),
        'edit_item'         => __( 'Edit Category', 'figma-trial-theme' ),
        'update_item'       => __( 'Update Category', 'figma-trial-theme' ),
        'add_new_item'      => __( 'Add New Category', 'figma-trial-theme' ),
        'new_item_name'     => __( 'New Category Name', 'figma-trial-theme' ),
        'menu_name'         => __( 'Categories', 'figma-trial-theme' ),
    );
    register_taxonomy( 'property_category', array( 'property' ), array(
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'property-category' ),
    ) );
}
add_action( 'init', 'figma_trial_register_property_cpt', 0 );

/**
 * Helper to fetch site/page setting from CMS options
 */
function estatein_get_setting( $key, $default = '' ) {
    $settings = get_option( 'estatein_cms_settings', array() );
    if ( is_array( $settings ) && isset( $settings[ $key ] ) && $settings[ $key ] !== '' ) {
        return $settings[ $key ];
    }
    return $default;
}

/**
 * Helper to fetch property fields (supports live preview transients, ACF, native post meta, revisions)
 */
function estatein_get_property_field( $field_name, $post_id = null, $default = '' ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    if ( ! $post_id ) {
        $post_id = get_queried_object_id();
    }
    if ( ! $post_id && isset( $_GET['p'] ) ) {
        $post_id = (int) $_GET['p'];
    }
    if ( ! $post_id && isset( $_GET['page_id'] ) ) {
        $post_id = (int) $_GET['page_id'];
    }
    if ( ! $post_id && isset( $_GET['preview_id'] ) ) {
        $post_id = (int) $_GET['preview_id'];
    }

    // Support live uncommitted preview changes, transients, and autosaves
    if ( is_preview() || isset( $_GET['preview'] ) ) {
        $lookup_id = $post_id;
        if ( $lookup_id && wp_is_post_revision( $lookup_id ) ) {
            $lookup_id = wp_get_post_parent_id( $lookup_id );
        }

        // 1. Check live temporary preview transient
        $user_id = get_current_user_id();
        if ( $user_id && $lookup_id ) {
            $preview_data = get_transient( 'estatein_preview_' . $lookup_id . '_' . $user_id );
            if ( is_array( $preview_data ) && isset( $preview_data[ $field_name ] ) && $preview_data[ $field_name ] !== '' ) {
                return $preview_data[ $field_name ];
            }
        }
        if ( $lookup_id ) {
            $preview_data = get_transient( 'estatein_preview_' . $lookup_id );
            if ( is_array( $preview_data ) && isset( $preview_data[ $field_name ] ) && $preview_data[ $field_name ] !== '' ) {
                return $preview_data[ $field_name ];
            }
        }

        // 2. Check WordPress autosave revision meta
        if ( $post_id ) {
            if ( get_post_type( $post_id ) === 'revision' ) {
                $rev_val = get_post_meta( $post_id, $field_name, true );
                if ( ! empty( $rev_val ) ) {
                    return $rev_val;
                }
            }

            $preview = wp_get_post_autosave( $post_id, $user_id );
            if ( $preview ) {
                $prev_val = get_post_meta( $preview->ID, $field_name, true );
                if ( ! empty( $prev_val ) ) {
                    return $prev_val;
                }
                if ( function_exists( 'get_field' ) ) {
                    $acf_prev = get_field( $field_name, $preview->ID );
                    if ( ! empty( $acf_prev ) ) {
                        return $acf_prev;
                    }
                }
            }
        }
    }

    if ( $post_id && function_exists( 'get_field' ) ) {
        $val = get_field( $field_name, $post_id );
        if ( ! empty( $val ) ) {
            return $val;
        }
    }

    if ( $post_id ) {
        $val = get_post_meta( $post_id, $field_name, true );
        if ( ! empty( $val ) ) {
            return $val;
        }
    }

    // Fallback to CMS settings option if stored
    $cms_val = estatein_get_setting( $field_name );
    if ( ! empty( $cms_val ) ) {
        return $cms_val;
    }

    return $default;
}

/**
 * Helper to fetch page custom fields (supports live preview transients, ACF, native post meta, revisions)
 */
function estatein_get_page_field( $field_name, $post_id = null, $default = '' ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    if ( ! $post_id ) {
        $post_id = get_queried_object_id();
    }
    if ( ! $post_id && is_front_page() ) {
        $front_id = get_option( 'page_on_front' );
        if ( $front_id ) {
            $post_id = (int) $front_id;
        }
    }
    if ( ! $post_id && isset( $_GET['p'] ) ) {
        $post_id = (int) $_GET['p'];
    }
    if ( ! $post_id && isset( $_GET['page_id'] ) ) {
        $post_id = (int) $_GET['page_id'];
    }
    if ( ! $post_id && isset( $_GET['preview_id'] ) ) {
        $post_id = (int) $_GET['preview_id'];
    }

    // Support live uncommitted preview changes, transients, and autosaves
    if ( is_preview() || isset( $_GET['preview'] ) ) {
        $lookup_id = $post_id;
        if ( $lookup_id && wp_is_post_revision( $lookup_id ) ) {
            $lookup_id = wp_get_post_parent_id( $lookup_id );
        }

        // 1. Check live temporary preview transient
        $user_id = get_current_user_id();
        if ( $user_id && $lookup_id ) {
            $preview_data = get_transient( 'estatein_preview_' . $lookup_id . '_' . $user_id );
            if ( is_array( $preview_data ) && isset( $preview_data[ $field_name ] ) && $preview_data[ $field_name ] !== '' ) {
                return $preview_data[ $field_name ];
            }
        }
        if ( $lookup_id ) {
            $preview_data = get_transient( 'estatein_preview_' . $lookup_id );
            if ( is_array( $preview_data ) && isset( $preview_data[ $field_name ] ) && $preview_data[ $field_name ] !== '' ) {
                return $preview_data[ $field_name ];
            }
        }

        // 2. Check WordPress autosave revision meta
        if ( $post_id ) {
            if ( get_post_type( $post_id ) === 'revision' ) {
                $rev_val = get_post_meta( $post_id, $field_name, true );
                if ( ! empty( $rev_val ) ) {
                    return $rev_val;
                }
            }

            $preview = wp_get_post_autosave( $post_id, $user_id );
            if ( $preview ) {
                $prev_val = get_post_meta( $preview->ID, $field_name, true );
                if ( ! empty( $prev_val ) ) {
                    return $prev_val;
                }
                if ( function_exists( 'get_field' ) ) {
                    $acf_prev = get_field( $field_name, $preview->ID );
                    if ( ! empty( $acf_prev ) ) {
                        return $acf_prev;
                    }
                }
            }
        }
    }

    if ( $post_id && function_exists( 'get_field' ) ) {
        $val = get_field( $field_name, $post_id );
        if ( ! empty( $val ) ) {
            return $val;
        }
    }

    if ( $post_id ) {
        $val = get_post_meta( $post_id, $field_name, true );
        if ( ! empty( $val ) ) {
            return $val;
        }
    }

    // Fallback to estatein_get_setting() if stored in site options
    $cms_val = estatein_get_setting( $field_name );
    if ( ! empty( $cms_val ) ) {
        return $cms_val;
    }

    return $default;
}

/**
 * Register ACF Local Field Group for Property Details (if ACF is active)
 */
function figma_trial_register_acf_property_fields() {
    if ( function_exists( 'acf_add_local_field_group' ) ) {
        $json_files = glob( get_stylesheet_directory() . '/acf-json/*.json' );
        if ( ! empty( $json_files ) ) {
            foreach ( $json_files as $json_file ) {
                $group = json_decode( file_get_contents( $json_file ), true );
                if ( is_array( $group ) && ! empty( $group['key'] ) ) {
                    acf_add_local_field_group( $group );
                }
            }
        }
    }
}
add_action( 'acf/init', 'figma_trial_register_acf_property_fields' );

/**
 * ACF Local JSON Save and Load Paths
 */
add_filter( 'acf/settings/save_json', function( $path ) {
    $dir = get_stylesheet_directory() . '/acf-json';
    if ( ! file_exists( $dir ) ) {
        wp_mkdir_p( $dir );
    }
    return $dir;
} );

add_filter( 'acf/settings/load_json', function( $paths ) {
    unset( $paths[0] );
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
} );

/**
 * Auto-import All Field Groups (Properties & Pages) into WordPress database
 */
function figma_trial_sync_acf_to_db() {
    if ( function_exists( 'acf_import_field_group' ) ) {
        $json_files = glob( get_stylesheet_directory() . '/acf-json/*.json' );
        if ( ! empty( $json_files ) ) {
            foreach ( $json_files as $json_file ) {
                $group_key = basename( $json_file, '.json' );
                $last_sync = get_option( 'estatein_acf_sync_' . $group_key, 0 );
                $file_time = filemtime( $json_file );
                if ( $file_time !== $last_sync ) {
                    $json        = file_get_contents( $json_file );
                    $field_group = json_decode( $json, true );
                    if ( is_array( $field_group ) && ! empty( $field_group['key'] ) ) {
                        acf_import_field_group( $field_group );
                        update_option( 'estatein_acf_sync_' . $group_key, $file_time );
                    }
                }
            }
        }
    }
}
add_action( 'admin_init', 'figma_trial_sync_acf_to_db' );
add_action( 'init', 'figma_trial_sync_acf_to_db', 25 );

/**
 * Ensure all Estatein core pages have their proper template and front-page assigned in DB.
 */
function figma_trial_ensure_page_templates_assigned() {
    $map = array(
        'home'        => 'template-home.php',
        'about-us'    => 'template-about-us.php',
        'about'       => 'template-about-us.php',
        'properties'  => 'template-properties.php',
        'services'    => 'template-services.php',
        'contact-us'  => 'template-contact-us.php',
        'contact'     => 'template-contact-us.php',
    );

    foreach ( $map as $slug => $template ) {
        $page = get_page_by_path( $slug );
        if ( ! $page ) {
            $pages = get_posts( array(
                'post_type'   => 'page',
                'title'       => ucfirst( str_replace( '-', ' ', $slug ) ),
                'numberposts' => 1,
            ) );
            if ( ! empty( $pages ) ) {
                $page = $pages[0];
            }
        }
        if ( $page ) {
            $curr = get_post_meta( $page->ID, '_wp_page_template', true );
            if ( $curr !== $template ) {
                update_post_meta( $page->ID, '_wp_page_template', $template );
            }
            if ( ( $slug === 'home' || $slug === 'front-page' ) && (int) get_option( 'page_on_front' ) !== $page->ID ) {
                update_option( 'show_on_front', 'page' );
                update_option( 'page_on_front', $page->ID );
            }
        }
    }
}
add_action( 'admin_init', 'figma_trial_ensure_page_templates_assigned' );
add_action( 'init', 'figma_trial_ensure_page_templates_assigned', 20 );

/**
 * Dynamic ACF Location Rule Matcher:
 * Ensures all ACF field groups (Home, About Us, Services, Properties, Contact Us)
 * display 100% reliably on their corresponding pages, exactly like Property Details!
 */
add_filter( 'acf/location/rule_match', 'estatein_acf_location_rule_match_pages', 20, 4 );
function estatein_acf_location_rule_match_pages( $match, $rule, $options, $field_group ) {
    $post_id = isset( $options['post_id'] ) ? (int) $options['post_id'] : 0;
    if ( ! $post_id && isset( $_GET['post'] ) ) {
        $post_id = (int) $_GET['post'];
    }
    if ( ! $post_id && isset( $_POST['post_ID'] ) ) {
        $post_id = (int) $_POST['post_ID'];
    }
    if ( ! $post_id && isset( $GLOBALS['post']->ID ) ) {
        $post_id = (int) $GLOBALS['post']->ID;
    }
    if ( ! $post_id ) {
        return $match;
    }

    $post = get_post( $post_id );
    if ( ! $post || $post->post_type !== 'page' ) {
        return $match;
    }

    $group_key = '';
    if ( is_array( $field_group ) && isset( $field_group['key'] ) ) {
        $group_key = $field_group['key'];
    } elseif ( is_object( $field_group ) && isset( $field_group->key ) ) {
        $group_key = $field_group->key;
    }

    // 1. Home Page Field Group
    if ( $group_key === 'group_estatein_home_page' ) {
        $is_home = ( (int) get_option( 'page_on_front' ) === $post_id )
            || in_array( $post->post_name, array( 'home', 'beranda', 'front-page' ), true )
            || ( stripos( $post->post_title, 'home' ) !== false || stripos( $post->post_title, 'beranda' ) !== false )
            || ( get_post_meta( $post_id, '_wp_page_template', true ) === 'template-home.php' );
        if ( $is_home ) {
            if ( get_post_meta( $post_id, '_wp_page_template', true ) !== 'template-home.php' ) {
                update_post_meta( $post_id, '_wp_page_template', 'template-home.php' );
            }
            return ( $rule['operator'] === '==' );
        } else {
            return ( $rule['operator'] === '!=' );
        }
    }

    // 2. About Us Field Group
    if ( $group_key === 'group_estatein_about_page' ) {
        $is_about = in_array( $post->post_name, array( 'about-us', 'about', 'tentang-kami', 'tentang' ), true )
            || ( stripos( $post->post_title, 'about' ) !== false || stripos( $post->post_title, 'tentang' ) !== false )
            || ( get_post_meta( $post_id, '_wp_page_template', true ) === 'template-about-us.php' );
        if ( $is_about ) {
            if ( get_post_meta( $post_id, '_wp_page_template', true ) !== 'template-about-us.php' ) {
                update_post_meta( $post_id, '_wp_page_template', 'template-about-us.php' );
            }
            return ( $rule['operator'] === '==' );
        } else {
            return ( $rule['operator'] === '!=' );
        }
    }

    // 3. Properties Catalog Field Group
    if ( $group_key === 'group_estatein_properties_page' ) {
        $is_props = in_array( $post->post_name, array( 'properties', 'properti', 'property-catalog' ), true )
            || ( stripos( $post->post_title, 'propert' ) !== false )
            || ( get_post_meta( $post_id, '_wp_page_template', true ) === 'template-properties.php' );
        if ( $is_props ) {
            if ( get_post_meta( $post_id, '_wp_page_template', true ) !== 'template-properties.php' ) {
                update_post_meta( $post_id, '_wp_page_template', 'template-properties.php' );
            }
            return ( $rule['operator'] === '==' );
        } else {
            return ( $rule['operator'] === '!=' );
        }
    }

    // 4. Services Field Group
    if ( $group_key === 'group_estatein_services_page' ) {
        $is_services = in_array( $post->post_name, array( 'services', 'layanan' ), true )
            || ( stripos( $post->post_title, 'service' ) !== false || stripos( $post->post_title, 'layanan' ) !== false )
            || ( get_post_meta( $post_id, '_wp_page_template', true ) === 'template-services.php' );
        if ( $is_services ) {
            if ( get_post_meta( $post_id, '_wp_page_template', true ) !== 'template-services.php' ) {
                update_post_meta( $post_id, '_wp_page_template', 'template-services.php' );
            }
            return ( $rule['operator'] === '==' );
        } else {
            return ( $rule['operator'] === '!=' );
        }
    }

    // 5. Contact Us Field Group
    if ( $group_key === 'group_estatein_contact_page' ) {
        $is_contact = in_array( $post->post_name, array( 'contact-us', 'contact', 'kontak' ), true )
            || ( stripos( $post->post_title, 'contact' ) !== false || stripos( $post->post_title, 'kontak' ) !== false )
            || ( get_post_meta( $post_id, '_wp_page_template', true ) === 'template-contact-us.php' );
        if ( $is_contact ) {
            if ( get_post_meta( $post_id, '_wp_page_template', true ) !== 'template-contact-us.php' ) {
                update_post_meta( $post_id, '_wp_page_template', 'template-contact-us.php' );
            }
            return ( $rule['operator'] === '==' );
        } else {
            return ( $rule['operator'] === '!=' );
        }
    }

    return $match;
}

/**
 * Direct Form for Property Fields (hooked to edit_form_after_title)
 * If ACF is active, ACF renders seamlessly.
 * If ACF is inactive, this renders direct form fields seamlessly without any meta box.
 */
function figma_trial_render_property_direct_form( $post ) {
    if ( ! $post || $post->post_type !== 'property' ) {
        return;
    }
    // If ACF is active and handles this field group, ACF will render its own seamless fields
    if ( function_exists( 'acf_get_field_group' ) && acf_get_field_group( 'group_estatein_property_details' ) ) {
        return;
    }

    wp_nonce_field( 'estatein_save_property_meta', 'estatein_property_meta_nonce' );
    $price     = get_post_meta( $post->ID, 'property_price', true );
    $location  = get_post_meta( $post->ID, 'property_location', true );
    $bedrooms  = get_post_meta( $post->ID, 'property_bedrooms', true );
    $bathrooms = get_post_meta( $post->ID, 'property_bathrooms', true );
    $type      = get_post_meta( $post->ID, 'property_type', true );
    $area      = get_post_meta( $post->ID, 'property_area', true );
    $badge     = get_post_meta( $post->ID, 'property_badge', true );
    $desc      = get_post_meta( $post->ID, 'property_description', true );
    $img_url   = get_post_meta( $post->ID, 'property_image_url', true );
    ?>
    <div class="estatein-direct-form-wrapper">
        <div class="estatein-direct-form-header">
            <h3><?php _e( 'Property Details', 'figma-trial-theme' ); ?></h3>
            <p><?php _e( 'Isi detail properti di bawah ini langsung tanpa meta box. Bidang formulir otomatis tersimpan ke data properti dan bisa di-preview sebelum dipublikasikan.', 'figma-trial-theme' ); ?></p>
        </div>
        <div class="estatein-direct-form-grid">
            <div class="form-group">
                <label for="property_price"><strong><?php _e( 'Price', 'figma-trial-theme' ); ?></strong></label>
                <input type="text" id="property_price" name="property_price" value="<?php echo esc_attr( $price ); ?>" placeholder="$1,250,000" />
                <span class="field-instruction"><?php _e( 'Listing price (e.g. $1,250,000)', 'figma-trial-theme' ); ?></span>
            </div>
            <div class="form-group">
                <label for="property_location"><strong><?php _e( 'Location', 'figma-trial-theme' ); ?></strong></label>
                <input type="text" id="property_location" name="property_location" value="<?php echo esc_attr( $location ); ?>" placeholder="Malibu, California" />
                <span class="field-instruction"><?php _e( 'Location (e.g. Malibu, California)', 'figma-trial-theme' ); ?></span>
            </div>
            <div class="form-group">
                <label for="property_bedrooms"><strong><?php _e( 'Bedrooms', 'figma-trial-theme' ); ?></strong></label>
                <input type="text" id="property_bedrooms" name="property_bedrooms" value="<?php echo esc_attr( $bedrooms ); ?>" placeholder="4-Bedroom" />
                <span class="field-instruction"><?php _e( 'Number of bedrooms (e.g. 4-Bedroom)', 'figma-trial-theme' ); ?></span>
            </div>
            <div class="form-group">
                <label for="property_bathrooms"><strong><?php _e( 'Bathrooms', 'figma-trial-theme' ); ?></strong></label>
                <input type="text" id="property_bathrooms" name="property_bathrooms" value="<?php echo esc_attr( $bathrooms ); ?>" placeholder="3-Bathroom" />
                <span class="field-instruction"><?php _e( 'Number of bathrooms (e.g. 3-Bathroom)', 'figma-trial-theme' ); ?></span>
            </div>
            <div class="form-group">
                <label for="property_type"><strong><?php _e( 'Property Type', 'figma-trial-theme' ); ?></strong></label>
                <input type="text" id="property_type" name="property_type" value="<?php echo esc_attr( $type ); ?>" placeholder="Villa" />
                <span class="field-instruction"><?php _e( 'Property type (e.g. Villa, Penthouse)', 'figma-trial-theme' ); ?></span>
            </div>
            <div class="form-group">
                <label for="property_area"><strong><?php _e( 'Area / Size', 'figma-trial-theme' ); ?></strong></label>
                <input type="text" id="property_area" name="property_area" value="<?php echo esc_attr( $area ); ?>" placeholder="2,500 Sq. Ft" />
                <span class="field-instruction"><?php _e( 'Total area (e.g. 2,500 Sq. Ft)', 'figma-trial-theme' ); ?></span>
            </div>
            <div class="form-group full-width">
                <label for="property_badge"><strong><?php _e( 'Card Subtitle / Category Badge', 'figma-trial-theme' ); ?></strong></label>
                <input type="text" id="property_badge" name="property_badge" value="<?php echo esc_attr( $badge ); ?>" placeholder="Coastal Escapes - Where the Waves Beckon" />
                <span class="field-instruction"><?php _e( 'Subtitle shown on property card badge', 'figma-trial-theme' ); ?></span>
            </div>
            <div class="form-group full-width">
                <label for="property_description"><strong><?php _e( 'Description', 'figma-trial-theme' ); ?></strong></label>
                <textarea id="property_description" name="property_description" rows="4" placeholder="<?php _e( 'Discover your own piece of paradise with this stunning property...', 'figma-trial-theme' ); ?>"><?php echo esc_textarea( $desc ); ?></textarea>
                <span class="field-instruction"><?php _e( 'Full description shown on single property page and card excerpts', 'figma-trial-theme' ); ?></span>
            </div>
            <div class="form-group full-width">
                <label for="property_image_url"><strong><?php _e( 'Image URL (External Fallback)', 'figma-trial-theme' ); ?></strong></label>
                <input type="url" id="property_image_url" name="property_image_url" value="<?php echo esc_attr( $img_url ); ?>" placeholder="https://images.unsplash.com/..." />
                <span class="field-instruction"><?php _e( 'Optional external image URL if no Featured Image is uploaded', 'figma-trial-theme' ); ?></span>
            </div>
        </div>
    </div>
    <?php
}
add_action( 'edit_form_after_title', 'figma_trial_render_property_direct_form' );

/**
 * Completely disable Gutenberg block editor for both pages and properties,
 * keeping the fast, seamless classic editor layout with direct form fields.
 */
add_filter( 'use_block_editor_for_post_type', function( $use_block_editor, $post_type ) {
    if ( $post_type === 'page' || $post_type === 'property' ) {
        return false;
    }
    return $use_block_editor;
}, 99, 2 );

add_filter( 'use_block_editor_for_post', function( $use_block_editor, $post ) {
    if ( $post && ( $post->post_type === 'page' || $post->post_type === 'property' ) ) {
        return false;
    }
    return $use_block_editor;
}, 99, 2 );

/**
 * Remove default giant WordPress WYSIWYG content editor for pages so only direct form fields are shown
 */
add_action( 'init', function() {
    remove_post_type_support( 'page', 'editor' );
}, 99 );

/**
 * Direct Form for Page Fields (hooked to edit_form_after_title)
 * Displays direct form fields right below the page title without Gutenberg.
 */
function estatein_render_page_direct_form( $post ) {
    if ( ! $post || $post->post_type !== 'page' ) {
        return;
    }

    // If ACF is active and handles field groups for this page, let native ACF render seamlessly!
    if ( function_exists( 'acf_get_field_groups' ) ) {
        $groups = acf_get_field_groups( array( 'post_id' => $post->ID ) );
        if ( ! empty( $groups ) ) {
            return;
        }
        if ( function_exists( 'acf_get_field_group' ) && (
            acf_get_field_group( 'group_estatein_home_page' ) ||
            acf_get_field_group( 'group_estatein_about_page' ) ||
            acf_get_field_group( 'group_estatein_properties_page' ) ||
            acf_get_field_group( 'group_estatein_services_page' ) ||
            acf_get_field_group( 'group_estatein_contact_page' )
        ) ) {
            return;
        }
    }

    $is_home = ( (int) get_option( 'page_on_front' ) === $post->ID )
        || ( in_array( $post->post_name, array( 'home', 'beranda' ), true ) )
        || ( stripos( $post->post_title, 'home' ) !== false || stripos( $post->post_title, 'beranda' ) !== false )
        || ( get_post_meta( $post->ID, '_wp_page_template', true ) === 'template-home.php' );

    $is_about = ( in_array( $post->post_name, array( 'about-us', 'about', 'tentang-kami', 'tentang' ), true ) )
        || ( stripos( $post->post_title, 'about' ) !== false || stripos( $post->post_title, 'tentang' ) !== false )
        || ( get_post_meta( $post->ID, '_wp_page_template', true ) === 'template-about-us.php' );

    $is_props = ( in_array( $post->post_name, array( 'properties', 'properti' ), true ) )
        || ( stripos( $post->post_title, 'propert' ) !== false )
        || ( get_post_meta( $post->ID, '_wp_page_template', true ) === 'template-properties.php' );

    $is_services = ( in_array( $post->post_name, array( 'services', 'layanan' ), true ) )
        || ( stripos( $post->post_title, 'service' ) !== false || stripos( $post->post_title, 'layanan' ) !== false )
        || ( get_post_meta( $post->ID, '_wp_page_template', true ) === 'template-services.php' );

    $is_contact = ( in_array( $post->post_name, array( 'contact-us', 'contact', 'kontak' ), true ) )
        || ( stripos( $post->post_title, 'contact' ) !== false || stripos( $post->post_title, 'kontak' ) !== false )
        || ( get_post_meta( $post->ID, '_wp_page_template', true ) === 'template-contact-us.php' );

    wp_nonce_field( 'estatein_save_page_meta', 'estatein_page_meta_nonce' );

    if ( $is_home ) {
        // Hero & Stats
        $h_title     = estatein_get_page_field( 'home_hero_title', $post->ID, __( 'Discover Your Dream Property with Estatein', 'figma-trial-theme' ) );
        $h_desc      = estatein_get_page_field( 'home_hero_desc', $post->ID, __( 'Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.', 'figma-trial-theme' ) );
        $h_img       = estatein_get_page_field( 'home_hero_image', $post->ID, '' );
        $h_b1_txt    = estatein_get_page_field( 'home_hero_btn1_text', $post->ID, __( 'Learn More', 'figma-trial-theme' ) );
        $h_b1_url    = estatein_get_page_field( 'home_hero_btn1_url', $post->ID, home_url( '/about-us/' ) );
        $h_b2_txt    = estatein_get_page_field( 'home_hero_btn2_text', $post->ID, __( 'Browse Properties', 'figma-trial-theme' ) );
        $h_b2_url    = estatein_get_page_field( 'home_hero_btn2_url', $post->ID, home_url( '/properties/' ) );
        $h_s1_v      = estatein_get_page_field( 'home_stat_1_val', $post->ID, '200+' );
        $h_s1_l      = estatein_get_page_field( 'home_stat_1_label', $post->ID, __( 'Happy Customers', 'figma-trial-theme' ) );
        $h_s2_v      = estatein_get_page_field( 'home_stat_2_val', $post->ID, '10k+' );
        $h_s2_l      = estatein_get_page_field( 'home_stat_2_label', $post->ID, __( 'Properties For Clients', 'figma-trial-theme' ) );
        $h_s3_v      = estatein_get_page_field( 'home_stat_3_val', $post->ID, '16+' );
        $h_s3_l      = estatein_get_page_field( 'home_stat_3_label', $post->ID, __( 'Years of Experience', 'figma-trial-theme' ) );

        // Featured Properties Header
        $h_feat_title = estatein_get_page_field( 'home_featured_title', $post->ID, __( 'Featured Properties', 'figma-trial-theme' ) );
        $h_feat_desc  = estatein_get_page_field( 'home_featured_desc', $post->ID, __( 'Explore our handpicked selection of featured properties. Each listing offers a glimpse into exceptional homes and investments available through Estatein.', 'figma-trial-theme' ) );

        // Testimonials
        $h_test_title = estatein_get_page_field( 'home_testimonials_title', $post->ID, __( 'What Our Clients Say', 'figma-trial-theme' ) );
        $h_test_desc  = estatein_get_page_field( 'home_testimonials_desc', $post->ID, __( 'Read the success stories and heartfelt testimonials from our valued clients. Discover why they chose Estatein for their real estate journey.', 'figma-trial-theme' ) );

        $h_t1_title  = estatein_get_page_field( 'home_test_1_title', $post->ID, __( 'Exceptional Service!', 'figma-trial-theme' ) );
        $h_t1_text   = estatein_get_page_field( 'home_test_1_text', $post->ID, __( "Our experience with Estatein was outstanding. Their team's dedication and market knowledge helped us find our dream home smoothly.", 'figma-trial-theme' ) );
        $h_t1_name   = estatein_get_page_field( 'home_test_1_name', $post->ID, 'Wade Warren' );
        $h_t1_loc    = estatein_get_page_field( 'home_test_1_loc', $post->ID, 'USA, California' );
        $h_t1_avatar = estatein_get_page_field( 'home_test_1_avatar', $post->ID, 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80' );

        $h_t2_title  = estatein_get_page_field( 'home_test_2_title', $post->ID, __( 'Efficient and Reliable', 'figma-trial-theme' ) );
        $h_t2_text   = estatein_get_page_field( 'home_test_2_text', $post->ID, __( 'Estatein made selling our property stress-free. Their valuation expertise and marketing strategy exceeded our expectations.', 'figma-trial-theme' ) );
        $h_t2_name   = estatein_get_page_field( 'home_test_2_name', $post->ID, 'Emelie Thomson' );
        $h_t2_loc    = estatein_get_page_field( 'home_test_2_loc', $post->ID, 'USA, Florida' );
        $h_t2_avatar = estatein_get_page_field( 'home_test_2_avatar', $post->ID, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=120&q=80' );

        $h_t3_title  = estatein_get_page_field( 'home_test_3_title', $post->ID, __( 'Trusted Advisors', 'figma-trial-theme' ) );
        $h_t3_text   = estatein_get_page_field( 'home_test_3_text', $post->ID, __( 'The team provided invaluable guidance throughout our commercial investment journey. Highly recommended for all real estate needs.', 'figma-trial-theme' ) );
        $h_t3_name   = estatein_get_page_field( 'home_test_3_name', $post->ID, 'John Mans' );
        $h_t3_loc    = estatein_get_page_field( 'home_test_3_loc', $post->ID, 'USA, Nevada' );
        $h_t3_avatar = estatein_get_page_field( 'home_test_3_avatar', $post->ID, 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80' );

        // FAQs
        $h_faq_title = estatein_get_page_field( 'home_faq_title', $post->ID, __( 'Frequently Asked Questions', 'figma-trial-theme' ) );
        $h_faq_desc  = estatein_get_page_field( 'home_faq_desc', $post->ID, __( "Find answers to common questions about Estatein's services, property listings, and the buying or selling process.", 'figma-trial-theme' ) );

        $h_f1_q = estatein_get_page_field( 'home_faq_1_q', $post->ID, __( 'How do I search for properties on Estatein?', 'figma-trial-theme' ) );
        $h_f1_a = estatein_get_page_field( 'home_faq_1_a', $post->ID, __( 'Learn how to use our search filters to find properties that match your exact criteria, from location to price point.', 'figma-trial-theme' ) );

        $h_f2_q = estatein_get_page_field( 'home_faq_2_q', $post->ID, __( 'What documents do I need to sell my home?', 'figma-trial-theme' ) );
        $h_f2_a = estatein_get_page_field( 'home_faq_2_a', $post->ID, __( 'Find out about the essential documentation required to list and finalize the sale of your residential property.', 'figma-trial-theme' ) );

        $h_f3_q = estatein_get_page_field( 'home_faq_3_q', $post->ID, __( 'How does Estatein help with property financing?', 'figma-trial-theme' ) );
        $h_f3_a = estatein_get_page_field( 'home_faq_3_a', $post->ID, __( 'Discover our partnerships with certified lenders and mortgage specialists to secure competitive interest rates.', 'figma-trial-theme' ) );

        // CTA Banner
        $h_cta_title    = estatein_get_page_field( 'home_cta_title', $post->ID, __( 'Start Your Real Estate Journey Today', 'figma-trial-theme' ) );
        $h_cta_desc     = estatein_get_page_field( 'home_cta_desc', $post->ID, __( "Your dream property is just a click away. Whether you're looking for a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way. Take the first step towards your real estate goals and explore our available properties or get in touch with our team for personalized assistance.", 'figma-trial-theme' ) );
        $h_cta_btn_text = estatein_get_page_field( 'home_cta_btn_text', $post->ID, __( 'Explore Properties', 'figma-trial-theme' ) );
        $h_cta_btn_url  = estatein_get_page_field( 'home_cta_btn_url', $post->ID, home_url( '/properties/' ) );
        ?>
        <div class="estatein-direct-form-wrapper">
            <div class="estatein-direct-form-header">
                <h3><?php _e( 'Home Page Content & Settings', 'figma-trial-theme' ); ?></h3>
                <p><?php _e( 'Kelola seluruh teks hero banner, angka pencapaian, featured properties, ulasan klien (testimonials), tanya jawab (FAQs), dan banner ajakan (CTA) beranda Estatein di bawah ini. Semua perubahan tersimpan otomatis.', 'figma-trial-theme' ); ?></p>
            </div>
            <div class="estatein-direct-form-grid">
                <!-- 1. Hero Banner -->
                <div class="form-group full-width" style="border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '1. Hero Banner Section', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group">
                    <label for="home_hero_title"><strong><?php _e( 'Hero Main Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_hero_title" name="home_hero_title" value="<?php echo esc_attr( $h_title ); ?>" />
                    <span class="field-instruction"><?php _e( 'Headline utama banner beranda', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group">
                    <label for="home_hero_image"><strong><?php _e( 'Hero Skyscraper Image URL', 'figma-trial-theme' ); ?></strong></label>
                    <input type="url" id="home_hero_image" name="home_hero_image" value="<?php echo esc_attr( $h_img ); ?>" placeholder="https://..." />
                    <span class="field-instruction"><?php _e( 'URL foto gedung hero (kosongkan untuk default gedung)', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group full-width">
                    <label for="home_hero_desc"><strong><?php _e( 'Hero Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="home_hero_desc" name="home_hero_desc" rows="3"><?php echo esc_textarea( $h_desc ); ?></textarea>
                    <span class="field-instruction"><?php _e( 'Paragraf deskripsi di bawah headline hero', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group">
                    <label for="home_hero_btn1_text"><strong><?php _e( 'Button 1 Text', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_hero_btn1_text" name="home_hero_btn1_text" value="<?php echo esc_attr( $h_b1_txt ); ?>" />
                    <span class="field-instruction"><?php _e( 'Tombol sekunder hitam (contoh: Learn More)', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group">
                    <label for="home_hero_btn1_url"><strong><?php _e( 'Button 1 URL', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_hero_btn1_url" name="home_hero_btn1_url" value="<?php echo esc_attr( $h_b1_url ); ?>" />
                    <span class="field-instruction"><?php _e( 'Tautan URL tombol 1 (contoh: /about-us/)', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group">
                    <label for="home_hero_btn2_text"><strong><?php _e( 'Button 2 Text', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_hero_btn2_text" name="home_hero_btn2_text" value="<?php echo esc_attr( $h_b2_txt ); ?>" />
                    <span class="field-instruction"><?php _e( 'Tombol primer ungu (contoh: Browse Properties)', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group">
                    <label for="home_hero_btn2_url"><strong><?php _e( 'Button 2 URL', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_hero_btn2_url" name="home_hero_btn2_url" value="<?php echo esc_attr( $h_b2_url ); ?>" />
                    <span class="field-instruction"><?php _e( 'Tautan URL tombol 2 (contoh: /properties/)', 'figma-trial-theme' ); ?></span>
                </div>

                <!-- 2. Statistics -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '2. Key Statistics (3 Angka Pencapaian)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group">
                    <label for="home_stat_1_val"><strong><?php _e( 'Stat 1 Value', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_stat_1_val" name="home_stat_1_val" value="<?php echo esc_attr( $h_s1_v ); ?>" placeholder="200+" />
                </div>
                <div class="form-group">
                    <label for="home_stat_1_label"><strong><?php _e( 'Stat 1 Label', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_stat_1_label" name="home_stat_1_label" value="<?php echo esc_attr( $h_s1_l ); ?>" placeholder="Happy Customers" />
                </div>
                <div class="form-group">
                    <label for="home_stat_2_val"><strong><?php _e( 'Stat 2 Value', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_stat_2_val" name="home_stat_2_val" value="<?php echo esc_attr( $h_s2_v ); ?>" placeholder="10k+" />
                </div>
                <div class="form-group">
                    <label for="home_stat_2_label"><strong><?php _e( 'Stat 2 Label', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_stat_2_label" name="home_stat_2_label" value="<?php echo esc_attr( $h_s2_l ); ?>" placeholder="Properties For Clients" />
                </div>
                <div class="form-group">
                    <label for="home_stat_3_val"><strong><?php _e( 'Stat 3 Value', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_stat_3_val" name="home_stat_3_val" value="<?php echo esc_attr( $h_s3_v ); ?>" placeholder="16+" />
                </div>
                <div class="form-group">
                    <label for="home_stat_3_label"><strong><?php _e( 'Stat 3 Label', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_stat_3_label" name="home_stat_3_label" value="<?php echo esc_attr( $h_s3_l ); ?>" placeholder="Years of Experience" />
                </div>

                <!-- 3. Featured Properties Header -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '3. Featured Properties Section (Header)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group full-width">
                    <label for="home_featured_title"><strong><?php _e( 'Featured Section Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_featured_title" name="home_featured_title" value="<?php echo esc_attr( $h_feat_title ); ?>" />
                    <span class="field-instruction"><?php _e( 'Judul bagian properti pilihan (contoh: Featured Properties)', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group full-width">
                    <label for="home_featured_desc"><strong><?php _e( 'Featured Section Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="home_featured_desc" name="home_featured_desc" rows="3"><?php echo esc_textarea( $h_feat_desc ); ?></textarea>
                    <span class="field-instruction"><?php _e( 'Paragraf pengantar bagian properti pilihan', 'figma-trial-theme' ); ?></span>
                </div>

                <!-- 4. Testimonials (What Our Clients Say) -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '4. Testimonials Section (What Our Clients Say)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group full-width">
                    <label for="home_testimonials_title"><strong><?php _e( 'Testimonials Section Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_testimonials_title" name="home_testimonials_title" value="<?php echo esc_attr( $h_test_title ); ?>" />
                </div>
                <div class="form-group full-width">
                    <label for="home_testimonials_desc"><strong><?php _e( 'Testimonials Section Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="home_testimonials_desc" name="home_testimonials_desc" rows="2"><?php echo esc_textarea( $h_test_desc ); ?></textarea>
                </div>

                <!-- Testimonial 1 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0; margin-top: 6px;">
                    <strong style="color: #4f46e5;"><?php _e( 'Testimonial Card 1', 'figma-trial-theme' ); ?></strong>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-top: 8px;">
                        <div>
                            <label><?php _e( 'Client Name', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="home_test_1_name" value="<?php echo esc_attr( $h_t1_name ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Location', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="home_test_1_loc" value="<?php echo esc_attr( $h_t1_loc ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Avatar Photo URL', 'figma-trial-theme' ); ?></label>
                            <input type="url" name="home_test_1_avatar" value="<?php echo esc_attr( $h_t1_avatar ); ?>" />
                        </div>
                    </div>
                    <div style="margin-top: 8px;">
                        <label><?php _e( 'Review Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="home_test_1_title" value="<?php echo esc_attr( $h_t1_title ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 8px;">
                        <label><?php _e( 'Review Text', 'figma-trial-theme' ); ?></label>
                        <textarea name="home_test_1_text" rows="2" style="width: 100%;"><?php echo esc_textarea( $h_t1_text ); ?></textarea>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0; margin-top: 6px;">
                    <strong style="color: #4f46e5;"><?php _e( 'Testimonial Card 2', 'figma-trial-theme' ); ?></strong>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-top: 8px;">
                        <div>
                            <label><?php _e( 'Client Name', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="home_test_2_name" value="<?php echo esc_attr( $h_t2_name ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Location', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="home_test_2_loc" value="<?php echo esc_attr( $h_t2_loc ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Avatar Photo URL', 'figma-trial-theme' ); ?></label>
                            <input type="url" name="home_test_2_avatar" value="<?php echo esc_attr( $h_t2_avatar ); ?>" />
                        </div>
                    </div>
                    <div style="margin-top: 8px;">
                        <label><?php _e( 'Review Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="home_test_2_title" value="<?php echo esc_attr( $h_t2_title ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 8px;">
                        <label><?php _e( 'Review Text', 'figma-trial-theme' ); ?></label>
                        <textarea name="home_test_2_text" rows="2" style="width: 100%;"><?php echo esc_textarea( $h_t2_text ); ?></textarea>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0; margin-top: 6px;">
                    <strong style="color: #4f46e5;"><?php _e( 'Testimonial Card 3', 'figma-trial-theme' ); ?></strong>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-top: 8px;">
                        <div>
                            <label><?php _e( 'Client Name', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="home_test_3_name" value="<?php echo esc_attr( $h_t3_name ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Location', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="home_test_3_loc" value="<?php echo esc_attr( $h_t3_loc ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Avatar Photo URL', 'figma-trial-theme' ); ?></label>
                            <input type="url" name="home_test_3_avatar" value="<?php echo esc_attr( $h_t3_avatar ); ?>" />
                        </div>
                    </div>
                    <div style="margin-top: 8px;">
                        <label><?php _e( 'Review Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="home_test_3_title" value="<?php echo esc_attr( $h_t3_title ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 8px;">
                        <label><?php _e( 'Review Text', 'figma-trial-theme' ); ?></label>
                        <textarea name="home_test_3_text" rows="2" style="width: 100%;"><?php echo esc_textarea( $h_t3_text ); ?></textarea>
                    </div>
                </div>

                <!-- 5. Frequently Asked Questions (FAQs) -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '5. Frequently Asked Questions (FAQs)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group full-width">
                    <label for="home_faq_title"><strong><?php _e( 'FAQ Section Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_faq_title" name="home_faq_title" value="<?php echo esc_attr( $h_faq_title ); ?>" />
                </div>
                <div class="form-group full-width">
                    <label for="home_faq_desc"><strong><?php _e( 'FAQ Section Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="home_faq_desc" name="home_faq_desc" rows="2"><?php echo esc_textarea( $h_faq_desc ); ?></textarea>
                </div>

                <!-- FAQ 1 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0; margin-top: 6px;">
                    <strong style="color: #4f46e5;"><?php _e( 'FAQ Item 1', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Question', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="home_faq_1_q" value="<?php echo esc_attr( $h_f1_q ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Answer', 'figma-trial-theme' ); ?></label>
                        <textarea name="home_faq_1_a" rows="2" style="width: 100%;"><?php echo esc_textarea( $h_f1_a ); ?></textarea>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0; margin-top: 6px;">
                    <strong style="color: #4f46e5;"><?php _e( 'FAQ Item 2', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Question', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="home_faq_2_q" value="<?php echo esc_attr( $h_f2_q ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Answer', 'figma-trial-theme' ); ?></label>
                        <textarea name="home_faq_2_a" rows="2" style="width: 100%;"><?php echo esc_textarea( $h_f2_a ); ?></textarea>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0; margin-top: 6px;">
                    <strong style="color: #4f46e5;"><?php _e( 'FAQ Item 3', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Question', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="home_faq_3_q" value="<?php echo esc_attr( $h_f3_q ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Answer', 'figma-trial-theme' ); ?></label>
                        <textarea name="home_faq_3_a" rows="2" style="width: 100%;"><?php echo esc_textarea( $h_f3_a ); ?></textarea>
                    </div>
                </div>

                <!-- 6. Bottom CTA Banner -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '6. Call To Action (Bottom CTA Banner)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group full-width">
                    <label for="home_cta_title"><strong><?php _e( 'CTA Heading', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_cta_title" name="home_cta_title" value="<?php echo esc_attr( $h_cta_title ); ?>" />
                </div>
                <div class="form-group full-width">
                    <label for="home_cta_desc"><strong><?php _e( 'CTA Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="home_cta_desc" name="home_cta_desc" rows="3"><?php echo esc_textarea( $h_cta_desc ); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="home_cta_btn_text"><strong><?php _e( 'CTA Button Text', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_cta_btn_text" name="home_cta_btn_text" value="<?php echo esc_attr( $h_cta_btn_text ); ?>" />
                </div>
                <div class="form-group">
                    <label for="home_cta_btn_url"><strong><?php _e( 'CTA Button URL', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="home_cta_btn_url" name="home_cta_btn_url" value="<?php echo esc_attr( $h_cta_btn_url ); ?>" />
                </div>
            </div>
        </div>
        <?php
    } elseif ( $is_about ) {
        // Our Journey & Stats
        $a_title  = estatein_get_page_field( 'about_journey_title', $post->ID, __( 'Our Journey', 'figma-trial-theme' ) );
        $a_desc   = estatein_get_page_field( 'about_journey_desc', $post->ID, __( "Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary. Over the years, we've expanded our reach, forged lasting partnerships, and earned the trust of countless clients.", 'figma-trial-theme' ) );
        $a_img    = estatein_get_page_field( 'about_journey_image', $post->ID, 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=1200&q=85' );
        $a_s1_v   = estatein_get_page_field( 'about_stat_1_val', $post->ID, '200+' );
        $a_s1_l   = estatein_get_page_field( 'about_stat_1_label', $post->ID, __( 'Happy Customers', 'figma-trial-theme' ) );
        $a_s2_v   = estatein_get_page_field( 'about_stat_2_val', $post->ID, '10k+' );
        $a_s2_l   = estatein_get_page_field( 'about_stat_2_label', $post->ID, __( 'Properties For Clients', 'figma-trial-theme' ) );
        $a_s3_v   = estatein_get_page_field( 'about_stat_3_val', $post->ID, '16+' );
        $a_s3_l   = estatein_get_page_field( 'about_stat_3_label', $post->ID, __( 'Years of Experience', 'figma-trial-theme' ) );

        // Values
        $a_val_title = estatein_get_page_field( 'about_values_title', $post->ID, __( 'Our Values', 'figma-trial-theme' ) );
        $a_val_desc  = estatein_get_page_field( 'about_values_desc', $post->ID, __( 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.', 'figma-trial-theme' ) );
        $a_v1_t      = estatein_get_page_field( 'about_val_1_title', $post->ID, __( 'Trust', 'figma-trial-theme' ) );
        $a_v1_d      = estatein_get_page_field( 'about_val_1_desc', $post->ID, __( 'Trust is the cornerstone of every relationship we build. We prioritize honesty and transparency in every transaction.', 'figma-trial-theme' ) );
        $a_v2_t      = estatein_get_page_field( 'about_val_2_title', $post->ID, __( 'Excellence', 'figma-trial-theme' ) );
        $a_v2_d      = estatein_get_page_field( 'about_val_2_desc', $post->ID, __( 'We set the bar high for ourselves. From the properties we list to the services we provide, we strive for nothing less than excellence.', 'figma-trial-theme' ) );
        $a_v3_t      = estatein_get_page_field( 'about_val_3_title', $post->ID, __( 'Client-Centric', 'figma-trial-theme' ) );
        $a_v3_d      = estatein_get_page_field( 'about_val_3_desc', $post->ID, __( 'Your dreams and needs are at the center of our universe. We listen, understand, and deliver tailored solutions.', 'figma-trial-theme' ) );
        $a_v4_t      = estatein_get_page_field( 'about_val_4_title', $post->ID, __( 'Our Commitment', 'figma-trial-theme' ) );
        $a_v4_d      = estatein_get_page_field( 'about_val_4_desc', $post->ID, __( 'We are dedicated to providing you with the highest level of service, professionalism, and integrity throughout your real estate journey.', 'figma-trial-theme' ) );

        // Achievements
        $a_ach_title = estatein_get_page_field( 'about_achieve_title', $post->ID, __( 'Our Achievements', 'figma-trial-theme' ) );
        $a_ach_desc  = estatein_get_page_field( 'about_achieve_desc', $post->ID, __( 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.', 'figma-trial-theme' ) );
        $a_ac1_t     = estatein_get_page_field( 'about_achieve_1_title', $post->ID, __( '3+ Years of Excellence', 'figma-trial-theme' ) );
        $a_ac1_d     = estatein_get_page_field( 'about_achieve_1_desc', $post->ID, __( "With over 3 years in the industry, we've amassed a wealth of knowledge and experience, becoming a go-to resource for all things real estate.", 'figma-trial-theme' ) );
        $a_ac2_t     = estatein_get_page_field( 'about_achieve_2_title', $post->ID, __( 'Happy Clients', 'figma-trial-theme' ) );
        $a_ac2_d     = estatein_get_page_field( 'about_achieve_2_desc', $post->ID, __( 'Our greatest achievement is the satisfaction of our clients. Over 200 happy families and individuals have found their dream homes with us.', 'figma-trial-theme' ) );
        $a_ac3_t     = estatein_get_page_field( 'about_achieve_3_title', $post->ID, __( 'Industry Recognition', 'figma-trial-theme' ) );
        $a_ac3_d     = estatein_get_page_field( 'about_achieve_3_desc', $post->ID, __( "We've earned the respect of our peers and industry leaders, with accolades and awards that reflect our commitment to excellence.", 'figma-trial-theme' ) );

        // Team
        $a_team_title = estatein_get_page_field( 'about_team_title', $post->ID, __( 'Meet the Estatein Team', 'figma-trial-theme' ) );
        $a_team_desc  = estatein_get_page_field( 'about_team_desc', $post->ID, __( 'At Estatein, our success is driven by the dedication and expertise of our team. Get to know the people behind our mission to deliver exceptional real estate experiences.', 'figma-trial-theme' ) );
        $a_m1_name    = estatein_get_page_field( 'about_team_1_name', $post->ID, 'Max Mitchell' );
        $a_m1_role    = estatein_get_page_field( 'about_team_1_role', $post->ID, __( 'Founder', 'figma-trial-theme' ) );
        $a_m1_photo   = estatein_get_page_field( 'about_team_1_photo', $post->ID, 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80' );
        $a_m2_name    = estatein_get_page_field( 'about_team_2_name', $post->ID, 'Sarah Johnson' );
        $a_m2_role    = estatein_get_page_field( 'about_team_2_role', $post->ID, __( 'Chief Real Estate Officer', 'figma-trial-theme' ) );
        $a_m2_photo   = estatein_get_page_field( 'about_team_2_photo', $post->ID, 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80' );
        $a_m3_name    = estatein_get_page_field( 'about_team_3_name', $post->ID, 'David Brown' );
        $a_m3_role    = estatein_get_page_field( 'about_team_3_role', $post->ID, __( 'Head of Property Management', 'figma-trial-theme' ) );
        $a_m3_photo   = estatein_get_page_field( 'about_team_3_photo', $post->ID, 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=600&q=80' );
        $a_m4_name    = estatein_get_page_field( 'about_team_4_name', $post->ID, 'Michael Turner' );
        $a_m4_role    = estatein_get_page_field( 'about_team_4_role', $post->ID, __( 'Legal Counsel', 'figma-trial-theme' ) );
        $a_m4_photo   = estatein_get_page_field( 'about_team_4_photo', $post->ID, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80' );

        // Valued Clients
        $a_cli_title  = estatein_get_page_field( 'about_clients_title', $post->ID, __( 'Our Valued Clients', 'figma-trial-theme' ) );
        $a_cli_desc   = estatein_get_page_field( 'about_clients_desc', $post->ID, __( 'At Estatein, we have had the privilege of working with a diverse range of clients across various industries. Here are some of the clients we have served:', 'figma-trial-theme' ) );
        $a_c1_since   = estatein_get_page_field( 'about_client_1_since', $post->ID, __( 'Since 2019', 'figma-trial-theme' ) );
        $a_c1_name    = estatein_get_page_field( 'about_client_1_name', $post->ID, 'ABC Corporation' );
        $a_c1_url     = estatein_get_page_field( 'about_client_1_url', $post->ID, 'https://example.com' );
        $a_c1_domain  = estatein_get_page_field( 'about_client_1_domain', $post->ID, __( 'Commercial Real Estate', 'figma-trial-theme' ) );
        $a_c1_cat     = estatein_get_page_field( 'about_client_1_category', $post->ID, __( 'Luxury Retail / Corporate HQ', 'figma-trial-theme' ) );
        $a_c1_quote   = estatein_get_page_field( 'about_client_1_quote', $post->ID, __( "Estatein's expertise in finding prime locations helped us expand our retail footprint significantly. Their team is truly top-tier.", 'figma-trial-theme' ) );
        $a_c2_since   = estatein_get_page_field( 'about_client_2_since', $post->ID, __( 'Since 2021', 'figma-trial-theme' ) );
        $a_c2_name    = estatein_get_page_field( 'about_client_2_name', $post->ID, 'Wade Warren Ventures' );
        $a_c2_url     = estatein_get_page_field( 'about_client_2_url', $post->ID, 'https://example.com' );
        $a_c2_domain  = estatein_get_page_field( 'about_client_2_domain', $post->ID, __( 'Residential Development', 'figma-trial-theme' ) );
        $a_c2_cat     = estatein_get_page_field( 'about_client_2_category', $post->ID, __( 'Luxury Waterfront Villas', 'figma-trial-theme' ) );
        $a_c2_quote   = estatein_get_page_field( 'about_client_2_quote', $post->ID, __( 'From site acquisition to final sales closing, Estatein provided unmatched professionalism, transparency, and strategic market foresight.', 'figma-trial-theme' ) );
        ?>
        <div class="estatein-direct-form-wrapper">
            <div class="estatein-direct-form-header">
                <h3><?php _e( 'About Us Content & Settings', 'figma-trial-theme' ); ?></h3>
                <p><?php _e( 'Kelola seluruh bagian halaman About Us: cerita perjalanan (Our Journey), nilai-nilai perusahaan (Our Values), pencapaian (Our Achievements), profil tim (Meet The Team), dan testimoni klien (Our Valued Clients) langsung di bawah ini.', 'figma-trial-theme' ); ?></p>
            </div>
            <div class="estatein-direct-form-grid">
                <!-- 1. Our Journey -->
                <div class="form-group full-width" style="border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '1. Our Journey Section', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group">
                    <label for="about_journey_title"><strong><?php _e( 'Journey Headline', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_journey_title" name="about_journey_title" value="<?php echo esc_attr( $a_title ); ?>" />
                    <span class="field-instruction"><?php _e( 'Judul bagian cerita perusahaan (contoh: Our Journey)', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group">
                    <label for="about_journey_image"><strong><?php _e( 'Visual Image URL', 'figma-trial-theme' ); ?></strong></label>
                    <input type="url" id="about_journey_image" name="about_journey_image" value="<?php echo esc_attr( $a_img ); ?>" />
                    <span class="field-instruction"><?php _e( 'URL foto arsitektur visual di sisi kanan cerita', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group full-width">
                    <label for="about_journey_desc"><strong><?php _e( 'Journey Story Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="about_journey_desc" name="about_journey_desc" rows="4"><?php echo esc_textarea( $a_desc ); ?></textarea>
                    <span class="field-instruction"><?php _e( 'Teks lengkap perjalanan dan dedikasi Estatein', 'figma-trial-theme' ); ?></span>
                </div>

                <!-- Company Statistics -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '2. Company Statistics (3 Angka Pencapaian)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group">
                    <label for="about_stat_1_val"><strong><?php _e( 'Stat 1 Value', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_stat_1_val" name="about_stat_1_val" value="<?php echo esc_attr( $a_s1_v ); ?>" placeholder="200+" />
                </div>
                <div class="form-group">
                    <label for="about_stat_1_label"><strong><?php _e( 'Stat 1 Label', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_stat_1_label" name="about_stat_1_label" value="<?php echo esc_attr( $a_s1_l ); ?>" placeholder="Happy Customers" />
                </div>
                <div class="form-group">
                    <label for="about_stat_2_val"><strong><?php _e( 'Stat 2 Value', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_stat_2_val" name="about_stat_2_val" value="<?php echo esc_attr( $a_s2_v ); ?>" placeholder="10k+" />
                </div>
                <div class="form-group">
                    <label for="about_stat_2_label"><strong><?php _e( 'Stat 2 Label', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_stat_2_label" name="about_stat_2_label" value="<?php echo esc_attr( $a_s2_l ); ?>" placeholder="Properties For Clients" />
                </div>
                <div class="form-group">
                    <label for="about_stat_3_val"><strong><?php _e( 'Stat 3 Value', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_stat_3_val" name="about_stat_3_val" value="<?php echo esc_attr( $a_s3_v ); ?>" placeholder="16+" />
                </div>
                <div class="form-group">
                    <label for="about_stat_3_label"><strong><?php _e( 'Stat 3 Label', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_stat_3_label" name="about_stat_3_label" value="<?php echo esc_attr( $a_s3_l ); ?>" placeholder="Years of Experience" />
                </div>

                <!-- 3. Our Values -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '3. Our Values (Nilai-Nilai Inti Perusahaan)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group full-width">
                    <label for="about_values_title"><strong><?php _e( 'Values Section Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_values_title" name="about_values_title" value="<?php echo esc_attr( $a_val_title ); ?>" />
                </div>
                <div class="form-group full-width">
                    <label for="about_values_desc"><strong><?php _e( 'Values Section Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="about_values_desc" name="about_values_desc" rows="2"><?php echo esc_textarea( $a_val_desc ); ?></textarea>
                </div>
                <!-- Value 1 & 2 -->
                <div class="form-group" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Value 1', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_val_1_title" value="<?php echo esc_attr( $a_v1_t ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Description', 'figma-trial-theme' ); ?></label>
                        <textarea name="about_val_1_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $a_v1_d ); ?></textarea>
                    </div>
                </div>
                <div class="form-group" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Value 2', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_val_2_title" value="<?php echo esc_attr( $a_v2_t ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Description', 'figma-trial-theme' ); ?></label>
                        <textarea name="about_val_2_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $a_v2_d ); ?></textarea>
                    </div>
                </div>
                <!-- Value 3 & 4 -->
                <div class="form-group" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Value 3', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_val_3_title" value="<?php echo esc_attr( $a_v3_t ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Description', 'figma-trial-theme' ); ?></label>
                        <textarea name="about_val_3_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $a_v3_d ); ?></textarea>
                    </div>
                </div>
                <div class="form-group" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Value 4', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_val_4_title" value="<?php echo esc_attr( $a_v4_t ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Description', 'figma-trial-theme' ); ?></label>
                        <textarea name="about_val_4_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $a_v4_d ); ?></textarea>
                    </div>
                </div>

                <!-- 4. Our Achievements -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '4. Our Achievements (Pencapaian Perusahaan)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group full-width">
                    <label for="about_achieve_title"><strong><?php _e( 'Achievements Section Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_achieve_title" name="about_achieve_title" value="<?php echo esc_attr( $a_ach_title ); ?>" />
                </div>
                <div class="form-group full-width">
                    <label for="about_achieve_desc"><strong><?php _e( 'Achievements Section Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="about_achieve_desc" name="about_achieve_desc" rows="2"><?php echo esc_textarea( $a_ach_desc ); ?></textarea>
                </div>
                <!-- Achievement 1 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Achievement 1', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_achieve_1_title" value="<?php echo esc_attr( $a_ac1_t ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Description', 'figma-trial-theme' ); ?></label>
                        <textarea name="about_achieve_1_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $a_ac1_d ); ?></textarea>
                    </div>
                </div>
                <!-- Achievement 2 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Achievement 2', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_achieve_2_title" value="<?php echo esc_attr( $a_ac2_t ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Description', 'figma-trial-theme' ); ?></label>
                        <textarea name="about_achieve_2_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $a_ac2_d ); ?></textarea>
                    </div>
                </div>
                <!-- Achievement 3 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Achievement 3', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Title', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_achieve_3_title" value="<?php echo esc_attr( $a_ac3_t ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Description', 'figma-trial-theme' ); ?></label>
                        <textarea name="about_achieve_3_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $a_ac3_d ); ?></textarea>
                    </div>
                </div>

                <!-- 5. Meet the Team -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '5. Meet the Estatein Team (Profil Anggota Tim)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group full-width">
                    <label for="about_team_title"><strong><?php _e( 'Team Section Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_team_title" name="about_team_title" value="<?php echo esc_attr( $a_team_title ); ?>" />
                </div>
                <div class="form-group full-width">
                    <label for="about_team_desc"><strong><?php _e( 'Team Section Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="about_team_desc" name="about_team_desc" rows="2"><?php echo esc_textarea( $a_team_desc ); ?></textarea>
                </div>
                <!-- Member 1 & 2 -->
                <div class="form-group" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Team Member 1', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Full Name', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_team_1_name" value="<?php echo esc_attr( $a_m1_name ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Role / Position', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_team_1_role" value="<?php echo esc_attr( $a_m1_role ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Photo URL', 'figma-trial-theme' ); ?></label>
                        <input type="url" name="about_team_1_photo" value="<?php echo esc_attr( $a_m1_photo ); ?>" style="width: 100%;" />
                    </div>
                </div>
                <div class="form-group" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Team Member 2', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Full Name', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_team_2_name" value="<?php echo esc_attr( $a_m2_name ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Role / Position', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_team_2_role" value="<?php echo esc_attr( $a_m2_role ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Photo URL', 'figma-trial-theme' ); ?></label>
                        <input type="url" name="about_team_2_photo" value="<?php echo esc_attr( $a_m2_photo ); ?>" style="width: 100%;" />
                    </div>
                </div>
                <!-- Member 3 & 4 -->
                <div class="form-group" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Team Member 3', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Full Name', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_team_3_name" value="<?php echo esc_attr( $a_m3_name ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Role / Position', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_team_3_role" value="<?php echo esc_attr( $a_m3_role ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Photo URL', 'figma-trial-theme' ); ?></label>
                        <input type="url" name="about_team_3_photo" value="<?php echo esc_attr( $a_m3_photo ); ?>" style="width: 100%;" />
                    </div>
                </div>
                <div class="form-group" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Team Member 4', 'figma-trial-theme' ); ?></strong>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Full Name', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_team_4_name" value="<?php echo esc_attr( $a_m4_name ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Role / Position', 'figma-trial-theme' ); ?></label>
                        <input type="text" name="about_team_4_role" value="<?php echo esc_attr( $a_m4_role ); ?>" style="width: 100%;" />
                    </div>
                    <div style="margin-top: 6px;">
                        <label><?php _e( 'Photo URL', 'figma-trial-theme' ); ?></label>
                        <input type="url" name="about_team_4_photo" value="<?php echo esc_attr( $a_m4_photo ); ?>" style="width: 100%;" />
                    </div>
                </div>

                <!-- 6. Our Valued Clients -->
                <div class="form-group full-width" style="margin-top: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #1d2327;">✦ <?php _e( '6. Our Valued Clients (Klien Utama Perusahaan)', 'figma-trial-theme' ); ?></h4>
                </div>
                <div class="form-group full-width">
                    <label for="about_clients_title"><strong><?php _e( 'Clients Section Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="about_clients_title" name="about_clients_title" value="<?php echo esc_attr( $a_cli_title ); ?>" />
                </div>
                <div class="form-group full-width">
                    <label for="about_clients_desc"><strong><?php _e( 'Clients Section Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="about_clients_desc" name="about_clients_desc" rows="2"><?php echo esc_textarea( $a_cli_desc ); ?></textarea>
                </div>
                <!-- Client 1 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Client Case Study 1', 'figma-trial-theme' ); ?></strong>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-top: 8px;">
                        <div>
                            <label><?php _e( 'Client Company Name', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="about_client_1_name" value="<?php echo esc_attr( $a_c1_name ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Tenure / Badge', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="about_client_1_since" value="<?php echo esc_attr( $a_c1_since ); ?>" placeholder="Since 2019" />
                        </div>
                        <div>
                            <label><?php _e( 'Website URL', 'figma-trial-theme' ); ?></label>
                            <input type="url" name="about_client_1_url" value="<?php echo esc_attr( $a_c1_url ); ?>" />
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 8px;">
                        <div>
                            <label><?php _e( 'Domain', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="about_client_1_domain" value="<?php echo esc_attr( $a_c1_domain ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Category', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="about_client_1_category" value="<?php echo esc_attr( $a_c1_cat ); ?>" />
                        </div>
                    </div>
                    <div style="margin-top: 8px;">
                        <label><?php _e( 'What They Said (Quote)', 'figma-trial-theme' ); ?></label>
                        <textarea name="about_client_1_quote" rows="2" style="width: 100%;"><?php echo esc_textarea( $a_c1_quote ); ?></textarea>
                    </div>
                </div>
                <!-- Client 2 -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <strong style="color: #4f46e5;"><?php _e( 'Client Case Study 2', 'figma-trial-theme' ); ?></strong>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-top: 8px;">
                        <div>
                            <label><?php _e( 'Client Company Name', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="about_client_2_name" value="<?php echo esc_attr( $a_c2_name ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Tenure / Badge', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="about_client_2_since" value="<?php echo esc_attr( $a_c2_since ); ?>" placeholder="Since 2021" />
                        </div>
                        <div>
                            <label><?php _e( 'Website URL', 'figma-trial-theme' ); ?></label>
                            <input type="url" name="about_client_2_url" value="<?php echo esc_attr( $a_c2_url ); ?>" />
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 8px;">
                        <div>
                            <label><?php _e( 'Domain', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="about_client_2_domain" value="<?php echo esc_attr( $a_c2_domain ); ?>" />
                        </div>
                        <div>
                            <label><?php _e( 'Category', 'figma-trial-theme' ); ?></label>
                            <input type="text" name="about_client_2_category" value="<?php echo esc_attr( $a_c2_cat ); ?>" />
                        </div>
                    </div>
                    <div style="margin-top: 8px;">
                        <label><?php _e( 'What They Said (Quote)', 'figma-trial-theme' ); ?></label>
                        <textarea name="about_client_2_quote" rows="2" style="width: 100%;"><?php echo esc_textarea( $a_c2_quote ); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } elseif ( $is_props ) {
        $p_title = estatein_get_page_field( 'properties_hero_title', $post->ID, __( 'Find Your Dream Property', 'figma-trial-theme' ) );
        $p_desc  = estatein_get_page_field( 'properties_hero_desc', $post->ID, __( 'Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life. With categories to suit every dreamer, your journey begins here.', 'figma-trial-theme' ) );
        ?>
        <div class="estatein-direct-form-wrapper">
            <div class="estatein-direct-form-header">
                <h3><?php _e( 'Properties Catalog Header & Introduction', 'figma-trial-theme' ); ?></h3>
                <p><?php _e( 'Kelola judul headline dan paragraf intro di halaman katalog pencarian properti.', 'figma-trial-theme' ); ?></p>
            </div>
            <div class="estatein-direct-form-grid">
                <div class="form-group full-width">
                    <label for="properties_hero_title"><strong><?php _e( 'Catalog Hero Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="properties_hero_title" name="properties_hero_title" value="<?php echo esc_attr( $p_title ); ?>" />
                    <span class="field-instruction"><?php _e( 'Headline halaman katalog pencarian properti', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group full-width">
                    <label for="properties_hero_desc"><strong><?php _e( 'Catalog Intro Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="properties_hero_desc" name="properties_hero_desc" rows="4"><?php echo esc_textarea( $p_desc ); ?></textarea>
                    <span class="field-instruction"><?php _e( 'Paragraf pengantar katalog properti di bawah judul', 'figma-trial-theme' ); ?></span>
                </div>
            </div>
        </div>
        <?php
    } elseif ( $is_services ) {
        $s_title = estatein_get_page_field( 'services_hero_title', $post->ID, __( 'Elevate Your Real Estate Experience', 'figma-trial-theme' ) );
        $s_desc  = estatein_get_page_field( 'services_hero_desc', $post->ID, __( 'Welcome to Estatein, where your real estate aspirations meet expert guidance. Explore our comprehensive range of services, each designed to cater to your unique needs and dreams.', 'figma-trial-theme' ) );
        ?>
        <div class="estatein-direct-form-wrapper">
            <div class="estatein-direct-form-header">
                <h3><?php _e( 'Services Page Hero & Introduction', 'figma-trial-theme' ); ?></h3>
                <p><?php _e( 'Kelola judul headline dan paragraf pengantar layanan Estatein.', 'figma-trial-theme' ); ?></p>
            </div>
            <div class="estatein-direct-form-grid">
                <div class="form-group full-width">
                    <label for="services_hero_title"><strong><?php _e( 'Services Hero Headline', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="services_hero_title" name="services_hero_title" value="<?php echo esc_attr( $s_title ); ?>" />
                    <span class="field-instruction"><?php _e( 'Headline utama banner halaman layanan', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group full-width">
                    <label for="services_hero_desc"><strong><?php _e( 'Services Intro Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="services_hero_desc" name="services_hero_desc" rows="4"><?php echo esc_textarea( $s_desc ); ?></textarea>
                    <span class="field-instruction"><?php _e( 'Paragraf pengantar layanan di bawah judul', 'figma-trial-theme' ); ?></span>
                </div>
            </div>
        </div>
        <?php
    } elseif ( $is_contact ) {
        $c_title   = estatein_get_page_field( 'contact_hero_title', $post->ID, __( 'Get in Touch with Estatein', 'figma-trial-theme' ) );
        $c_desc    = estatein_get_page_field( 'contact_hero_desc', $post->ID, __( "Welcome to Estatein's Contact Us page. We're here to assist you with any inquiries, requests, or feedback you may have. Whether you're looking to buy or sell a property, explore investment opportunities, or simply want to learn more about our services, we're just a message away. Reach out to us today, and let's start a conversation.", 'figma-trial-theme' ) );
        $c_email   = estatein_get_page_field( 'contact_email', $post->ID, 'info@estatein.com' );
        $c_phone   = estatein_get_page_field( 'contact_phone', $post->ID, '+1 (123) 456-7890' );
        $c_address = estatein_get_page_field( 'contact_hq_address', $post->ID, __( 'Main Headquarters, Los Angeles', 'figma-trial-theme' ) );
        ?>
        <div class="estatein-direct-form-wrapper">
            <div class="estatein-direct-form-header">
                <h3><?php _e( 'Contact Us Content & Channels', 'figma-trial-theme' ); ?></h3>
                <p><?php _e( 'Kelola judul banner kontak, deskripsi, email resmi, telepon, dan alamat kantor pusat.', 'figma-trial-theme' ); ?></p>
            </div>
            <div class="estatein-direct-form-grid">
                <div class="form-group full-width">
                    <label for="contact_hero_title"><strong><?php _e( 'Contact Hero Title', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="contact_hero_title" name="contact_hero_title" value="<?php echo esc_attr( $c_title ); ?>" />
                    <span class="field-instruction"><?php _e( 'Judul utama banner halaman kontak', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group full-width">
                    <label for="contact_hero_desc"><strong><?php _e( 'Contact Intro Description', 'figma-trial-theme' ); ?></strong></label>
                    <textarea id="contact_hero_desc" name="contact_hero_desc" rows="3"><?php echo esc_textarea( $c_desc ); ?></textarea>
                    <span class="field-instruction"><?php _e( 'Paragraf pengantar di bawah judul kontak', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group">
                    <label for="contact_email"><strong><?php _e( 'Official Office Email', 'figma-trial-theme' ); ?></strong></label>
                    <input type="email" id="contact_email" name="contact_email" value="<?php echo esc_attr( $c_email ); ?>" />
                    <span class="field-instruction"><?php _e( 'Email resmi perusahaan (contoh: info@estatein.com)', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group">
                    <label for="contact_phone"><strong><?php _e( 'Official Phone Number', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="contact_phone" name="contact_phone" value="<?php echo esc_attr( $c_phone ); ?>" />
                    <span class="field-instruction"><?php _e( 'Nomor telepon kantor (contoh: +1 (123) 456-7890)', 'figma-trial-theme' ); ?></span>
                </div>
                <div class="form-group full-width">
                    <label for="contact_hq_address"><strong><?php _e( 'Main Headquarters Location', 'figma-trial-theme' ); ?></strong></label>
                    <input type="text" id="contact_hq_address" name="contact_hq_address" value="<?php echo esc_attr( $c_address ); ?>" />
                    <span class="field-instruction"><?php _e( 'Nama/alamat kantor pusat (contoh: Main Headquarters, Los Angeles)', 'figma-trial-theme' ); ?></span>
                </div>
            </div>
        </div>
        <?php
    }
}
add_action( 'edit_form_after_title', 'estatein_render_page_direct_form' );

/**
 * Save handler for page direct form fields
 */
function estatein_save_page_direct_meta( $post_id ) {
    if ( ! isset( $_POST['estatein_page_meta_nonce'] ) || ! wp_verify_nonce( $_POST['estatein_page_meta_nonce'], 'estatein_save_page_meta' ) ) {
        return;
    }

    $fields = array(
        // Home Page
        'home_hero_title',
        'home_hero_desc',
        'home_hero_image',
        'home_hero_btn1_text',
        'home_hero_btn1_url',
        'home_hero_btn2_text',
        'home_hero_btn2_url',
        'home_stat_1_val',
        'home_stat_1_label',
        'home_stat_2_val',
        'home_stat_2_label',
        'home_stat_3_val',
        'home_stat_3_label',
        'home_featured_title',
        'home_featured_desc',
        'home_testimonials_title',
        'home_testimonials_desc',
        'home_test_1_title',
        'home_test_1_text',
        'home_test_1_name',
        'home_test_1_loc',
        'home_test_1_avatar',
        'home_test_2_title',
        'home_test_2_text',
        'home_test_2_name',
        'home_test_2_loc',
        'home_test_2_avatar',
        'home_test_3_title',
        'home_test_3_text',
        'home_test_3_name',
        'home_test_3_loc',
        'home_test_3_avatar',
        'home_faq_title',
        'home_faq_desc',
        'home_faq_1_q',
        'home_faq_1_a',
        'home_faq_2_q',
        'home_faq_2_a',
        'home_faq_3_q',
        'home_faq_3_a',
        'home_cta_title',
        'home_cta_desc',
        'home_cta_btn_text',
        'home_cta_btn_url',
        // About Us Page
        'about_journey_title',
        'about_journey_desc',
        'about_journey_image',
        'about_stat_1_val',
        'about_stat_1_label',
        'about_stat_2_val',
        'about_stat_2_label',
        'about_stat_3_val',
        'about_stat_3_label',
        'about_values_title',
        'about_values_desc',
        'about_val_1_title',
        'about_val_1_desc',
        'about_val_2_title',
        'about_val_2_desc',
        'about_val_3_title',
        'about_val_3_desc',
        'about_val_4_title',
        'about_val_4_desc',
        'about_achieve_title',
        'about_achieve_desc',
        'about_achieve_1_title',
        'about_achieve_1_desc',
        'about_achieve_2_title',
        'about_achieve_2_desc',
        'about_achieve_3_title',
        'about_achieve_3_desc',
        'about_team_title',
        'about_team_desc',
        'about_team_1_name',
        'about_team_1_role',
        'about_team_1_photo',
        'about_team_2_name',
        'about_team_2_role',
        'about_team_2_photo',
        'about_team_3_name',
        'about_team_3_role',
        'about_team_3_photo',
        'about_team_4_name',
        'about_team_4_role',
        'about_team_4_photo',
        'about_clients_title',
        'about_clients_desc',
        'about_client_1_since',
        'about_client_1_name',
        'about_client_1_url',
        'about_client_1_domain',
        'about_client_1_category',
        'about_client_1_quote',
        'about_client_2_since',
        'about_client_2_name',
        'about_client_2_url',
        'about_client_2_domain',
        'about_client_2_category',
        'about_client_2_quote',
        // Properties Page
        'properties_hero_title',
        'properties_hero_desc',
        // Services Page
        'services_hero_title',
        'services_hero_desc',
        // Contact Us Page
        'contact_hero_title',
        'contact_hero_desc',
        'contact_email',
        'contact_phone',
        'contact_hq_address',
    );

    $textareas = array(
        'home_hero_desc',
        'home_featured_desc',
        'home_testimonials_desc',
        'home_test_1_text',
        'home_test_2_text',
        'home_test_3_text',
        'home_faq_desc',
        'home_faq_1_a',
        'home_faq_2_a',
        'home_faq_3_a',
        'home_cta_desc',
        'about_journey_desc',
        'about_values_desc',
        'about_val_1_desc',
        'about_val_2_desc',
        'about_val_3_desc',
        'about_val_4_desc',
        'about_achieve_desc',
        'about_achieve_1_desc',
        'about_achieve_2_desc',
        'about_achieve_3_desc',
        'about_team_desc',
        'about_clients_desc',
        'about_client_1_quote',
        'about_client_2_quote',
        'properties_hero_desc',
        'services_hero_desc',
        'contact_hero_desc',
    );

    if ( wp_is_post_revision( $post_id ) ) {
        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                $val = in_array( $field, $textareas, true ) ? sanitize_textarea_field( $_POST[ $field ] ) : sanitize_text_field( $_POST[ $field ] );
                update_metadata( 'post', $post_id, $field, $val );
            }
        }
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            $val = in_array( $field, $textareas, true ) ? sanitize_textarea_field( $_POST[ $field ] ) : sanitize_text_field( $_POST[ $field ] );
            update_post_meta( $post_id, $field, $val );
            if ( function_exists( 'update_field' ) ) {
                update_field( $field, $val, $post_id );
            }
        }
    }

    // Clear live preview transients on permanent save
    delete_transient( 'estatein_preview_' . $post_id . '_' . get_current_user_id() );
    delete_transient( 'estatein_preview_' . $post_id );
}
add_action( 'save_post_page', 'estatein_save_page_direct_meta' );
add_action( 'save_post_revision', 'estatein_save_page_direct_meta' );

/**
 * AJAX handler to save temporary uncommitted preview data to transient
 */
function estatein_ajax_save_preview_data() {
    check_ajax_referer( 'estatein_preview_nonce', 'nonce' );

    $post_id = isset( $_POST['post_id'] ) ? (int) $_POST['post_id'] : 0;
    if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
        wp_send_json_error( array( 'message' => 'Unauthorized or invalid post ID' ) );
    }

    $raw_fields = isset( $_POST['fields'] ) && is_array( $_POST['fields'] ) ? $_POST['fields'] : array();
    $sanitized = array();

    foreach ( $raw_fields as $key => $val ) {
        $key = sanitize_key( $key );
        if ( strpos( $key, 'desc' ) !== false || strpos( $key, 'text' ) !== false || strpos( $key, 'quote' ) !== false || strpos( $key, '_a' ) !== false || strpos( $key, 'description' ) !== false || strpos( $key, 'amenities' ) !== false || strpos( $key, 'gallery' ) !== false ) {
            $sanitized[ $key ] = sanitize_textarea_field( wp_unslash( $val ) );
        } else {
            $sanitized[ $key ] = sanitize_text_field( wp_unslash( $val ) );
        }
    }

    $user_id = get_current_user_id();
    set_transient( 'estatein_preview_' . $post_id . '_' . $user_id, $sanitized, 600 );
    set_transient( 'estatein_preview_' . $post_id, $sanitized, 600 );

    // If an autosave revision exists, also update its post metadata
    $autosave = wp_get_post_autosave( $post_id, $user_id );
    if ( $autosave ) {
        foreach ( $sanitized as $key => $val ) {
            update_metadata( 'post', $autosave->ID, $key, $val );
        }
    }

    wp_send_json_success( array( 'saved' => true, 'count' => count( $sanitized ) ) );
}
add_action( 'wp_ajax_estatein_save_preview_data', 'estatein_ajax_save_preview_data' );

/**
 * Admin live preview script: intercepts "Preview Changes" click,
 * saves uncommitted direct form edits to preview transient via AJAX,
 * then opens preview window reflecting all live changes.
 */
function estatein_admin_preview_script() {
    $screen = get_current_screen();
    if ( ! $screen || ( $screen->post_type !== 'page' && $screen->post_type !== 'property' ) ) {
        return;
    }
    ?>
    <script>
    jQuery(document).ready(function($) {
        $(document).on('click', '#post-preview, #preview-action a', function(e) {
            var $btn = $(this);
            if ($btn.data('estatein-preview-ready')) {
                $btn.removeData('estatein-preview-ready');
                return true;
            }

            e.preventDefault();
            e.stopImmediatePropagation();

            var postID     = $('#post_ID').val();
            var targetName = $btn.attr('target') || ('wp-preview-' + postID);
            var previewUrl = $btn.attr('href');

            // 1. Open preview window synchronously on user click to prevent popup blockers
            var previewWin = window.open('about:blank', targetName);

            // 2. Collect all input & textarea values from direct form wrapper and ACF fields
            var formData = {};

            // Native ACF field capture via ACF JS API if available
            if (window.acf && typeof acf.getFields === 'function') {
                try {
                    acf.getFields().forEach(function(field) {
                        var fName = field.get('name');
                        if (fName) {
                            var fVal = field.val();
                            if (fVal !== null && fVal !== undefined) {
                                formData[fName] = fVal;
                            }
                        }
                    });
                } catch(e) {}
            }

            // DOM fallback for ACF fields
            $('.acf-field').each(function() {
                var fieldName = $(this).data('name');
                if (!fieldName || formData[fieldName] !== undefined) return;
                var $radio = $(this).find(':radio:checked');
                if ($radio.length) {
                    formData[fieldName] = $radio.val();
                    return;
                }
                var $inputs = $(this).find('textarea, select, input[type="text"], input[type="url"], input[type="number"], input[type="hidden"][name^="acf"]');
                if ($inputs.length) {
                    formData[fieldName] = $inputs.first().val();
                }
            });

            // Direct form wrapper inputs
            $('.estatein-direct-form-wrapper :input').each(function() {
                if (this.name) {
                    if ($(this).is(':radio, :checkbox')) {
                        if ($(this).is(':checked')) {
                            formData[this.name] = $(this).val();
                        }
                    } else {
                        formData[this.name] = $(this).val();
                    }
                }
            });

            // 3. Fast AJAX POST to save preview transient
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'estatein_save_preview_data',
                    post_id: postID,
                    nonce: '<?php echo wp_create_nonce( 'estatein_preview_nonce' ); ?>',
                    fields: formData
                },
                timeout: 3000
            }).always(function() {
                // 4. Navigate pre-opened preview window to preview URL
                if (previewWin && !previewWin.closed) {
                    previewWin.location.href = previewUrl;
                } else {
                    $btn.data('estatein-preview-ready', true);
                    $btn[0].click();
                }
            });
        });
    });
    </script>
    <?php
}
add_action( 'admin_footer-post.php', 'estatein_admin_preview_script' );
add_action( 'admin_footer-post-new.php', 'estatein_admin_preview_script' );

/**
 * Styling to ensure ACF and direct fields display seamlessly without meta box borders or headers
 */
function figma_trial_property_admin_styling() {

    $screen = get_current_screen();
    if ( ! $screen || ( $screen->post_type !== 'property' && $screen->post_type !== 'page' ) ) {
        return;
    }
    ?>
    <style>
        /* Seamless styling for all ACF field groups (Property Details and all Pages) */
        #acf-group_estatein_property_details,
        #acf-group_estatein_home_page,
        #acf-group_estatein_about_page,
        #acf-group_estatein_services_page,
        #acf-group_estatein_contact_page,
        #acf-group_estatein_properties_page,
        .postbox.acf-postbox.seamless,
        .acf-postbox {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            margin: 20px 0 !important;
            padding: 0 !important;
        }
        .postbox.acf-postbox.seamless > .postbox-header,
        .acf-postbox > .postbox-header,
        .postbox.acf-postbox.seamless > button.handlediv,
        .acf-postbox > button.handlediv {
            display: none !important;
        }
        .postbox.acf-postbox.seamless > .inside,
        .acf-postbox > .inside {
            padding: 0 !important;
            margin: 0 !important;
        }

        /* 2. Seamless ACF direct form fields */
        .acf-fields.-top > .acf-field {
            border: none !important;
            padding: 10px 14px !important;
        }
        .acf-fields {
            background: #ffffff;
            border: 1px solid #c3c4c7;
            border-radius: 8px;
            padding: 20px 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            margin-top: 15px;
        }
        .acf-field .acf-label label {
            font-size: 13px;
            font-weight: 600;
            color: #1d2327;
        }
        .acf-field input[type="text"],
        .acf-field input[type="url"],
        .acf-field textarea {
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #8c8f94;
        }
        .acf-tab-wrap {
            margin-bottom: 12px !important;
        }
        .acf-tab-group {
            border-bottom: 2px solid #e2e4e7 !important;
        }
        .acf-tab-group li a {
            font-size: 14px !important;
            font-weight: 600 !important;
            padding: 10px 18px !important;
            border-radius: 6px 6px 0 0 !important;
        }
        .acf-tab-group li.active a {
            background: #ffffff !important;
            color: #703bf7 !important;
            border-bottom-color: #ffffff !important;
        }

        /* 3. Direct Form styling (fallback) */
        .estatein-direct-form-wrapper {
            margin: 20px 0;
            background: #ffffff;
            border: 1px solid #c3c4c7;
            border-radius: 8px;
            padding: 24px 28px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .estatein-direct-form-header h3 {
            margin: 0 0 6px 0;
            font-size: 16px;
            font-weight: 600;
            color: #1d2327;
        }
        .estatein-direct-form-header p {
            margin: 0 0 20px 0;
            font-size: 13px;
            color: #646970;
        }
        .estatein-direct-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .estatein-direct-form-grid .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .estatein-direct-form-grid .form-group.full-width {
            grid-column: 1 / -1;
        }
        .estatein-direct-form-grid label {
            font-size: 13px;
            font-weight: 600;
            color: #1d2327;
        }
        .estatein-direct-form-grid input[type="text"],
        .estatein-direct-form-grid input[type="url"],
        .estatein-direct-form-grid textarea {
            width: 100%;
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #8c8f94;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .estatein-direct-form-grid input:focus,
        .estatein-direct-form-grid textarea:focus {
            border-color: #2271b1;
            box-shadow: 0 0 0 1px #2271b1;
            outline: 2px solid transparent;
        }
        .estatein-direct-form-grid .field-instruction {
            font-size: 12px;
            color: #646970;
        }
    </style>
    <?php
}
add_action( 'admin_head', 'figma_trial_property_admin_styling' );

function figma_trial_save_property_meta( $post_id ) {
    if ( ! isset( $_POST['estatein_property_meta_nonce'] ) || ! wp_verify_nonce( $_POST['estatein_property_meta_nonce'], 'estatein_save_property_meta' ) ) {
        return;
    }

    $fields = array(
        'property_price',
        'property_location',
        'property_bedrooms',
        'property_bathrooms',
        'property_type',
        'property_area',
        'property_badge',
        'property_description',
        'property_image_1',
        'property_image_2',
        'property_image_3',
        'property_image_4',
        'property_image_5',
        'property_image_6',
        'property_gallery_urls',
        'property_image_url',
        'property_amenities',
        'property_transfer_tax',
        'property_legal_fees',
        'property_inspection_fee',
        'property_insurance_fee',
        'property_monthly_tax',
        'property_hoa_fee',
        'property_down_payment',
        'property_closing_costs',
        'property_monthly_mortgage',
        'property_principal_interest',
    );

    // If it is an autosave revision, store fields on the revision ID
    if ( wp_is_post_revision( $post_id ) ) {
        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                $val = in_array( $field, array( 'property_description', 'property_amenities', 'property_gallery_urls' ), true )
                    ? sanitize_textarea_field( $_POST[ $field ] )
                    : sanitize_text_field( $_POST[ $field ] );
                update_metadata( 'post', $post_id, $field, $val );
            }
        }
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            $val = in_array( $field, array( 'property_description', 'property_amenities', 'property_gallery_urls' ), true )
                ? sanitize_textarea_field( $_POST[ $field ] )
                : sanitize_text_field( $_POST[ $field ] );
            update_post_meta( $post_id, $field, $val );
        }
    }

    // Clear live preview transients on permanent save
    delete_transient( 'estatein_preview_' . $post_id . '_' . get_current_user_id() );
    delete_transient( 'estatein_preview_' . $post_id );
}
add_action( 'save_post_property', 'figma_trial_save_property_meta' );
add_action( 'save_post_revision', 'figma_trial_save_property_meta' );

/**
 * Route single property previews and detail views to single-property.php
 */
function figma_trial_property_template( $template ) {
    $is_prop = is_singular( 'property' );

    if ( ! $is_prop && is_preview() ) {
        $p_id = isset( $_GET['p'] ) ? (int) $_GET['p'] : ( isset( $_GET['preview_id'] ) ? (int) $_GET['preview_id'] : 0 );
        if ( get_post_type() === 'property' || get_query_var( 'post_type' ) === 'property' || ( $p_id && get_post_type( $p_id ) === 'property' ) ) {
            $is_prop = true;
        }
    }

    // Intercept 404 or unrouted URLs for /property/{slug} so property details always load
    if ( ! $is_prop ) {
        $req_path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
        if ( preg_match( '#(^|/)property/([^/]+)/?$#', $req_path, $matches ) ) {
            $slug = sanitize_title( $matches[2] );
            $found_prop = get_page_by_path( $slug, OBJECT, 'property' );
            if ( ! $found_prop ) {
                $query = new WP_Query( array(
                    'name'           => $slug,
                    'post_type'      => 'property',
                    'post_status'    => 'any',
                    'posts_per_page' => 1,
                ) );
                if ( $query->have_posts() ) {
                    $found_prop = $query->posts[0];
                }
            }
            if ( $found_prop ) {
                global $wp_query, $post;
                $wp_query->is_404      = false;
                $wp_query->is_single   = true;
                $wp_query->is_singular = true;
                status_header( 200 );
                $post = $found_prop;
                setup_postdata( $post );
                $wp_query->posts      = array( $post );
                $wp_query->post_count = 1;
                $wp_query->post       = $post;
                $is_prop              = true;
            }
        }
    }

    if ( $is_prop ) {
        $single_prop = get_template_directory() . '/single-property.php';
        if ( file_exists( $single_prop ) ) {
            return $single_prop;
        }
    }
    return $template;
}
add_filter( 'template_include', 'figma_trial_property_template', 99 );

/**
 * Ensure property rewrite rules are flushed in database
 */
function figma_trial_ensure_property_rewrites() {
    $rules = get_option( 'rewrite_rules' );
    if ( ! is_array( $rules ) || ! isset( $rules['property/([^/]+)/?$'] ) ) {
        flush_rewrite_rules( false );
    }
}
add_action( 'init', 'figma_trial_ensure_property_rewrites', 99 );
add_action( 'after_switch_theme', function() {
    figma_trial_register_property_cpt();
    flush_rewrite_rules( false );
} );

/**
 * Auto-seed sample properties if none exist in the database
 */
function figma_trial_seed_sample_properties() {
    $existing = get_posts( array(
        'post_type'      => 'property',
        'posts_per_page' => 1,
        'post_status'    => 'any',
    ) );

    if ( empty( $existing ) ) {
        $samples = array(
            array(
                'title'     => 'Seaside Serenity Villa',
                'excerpt'   => 'A stunning 4-bedroom, 3-bathroom villa in a peaceful suburban neighborhood offering breathtaking panoramic ocean views and private beach access.',
                'price'     => '$1,250,000',
                'location'  => 'Malibu, California',
                'bedrooms'  => '4-Bedroom',
                'bathrooms' => '3-Bathroom',
                'type'      => 'Villa',
                'area'      => '2,500 Square Feet',
                'badge'     => 'Coastal Escapes - Where the Waves Beckon',
                'image'     => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'     => 'Metropolitan Haven',
                'excerpt'   => 'A chic and fully-furnished 2-bedroom penthouse with panoramic skyline views, private terrace, 24/7 concierge, and direct transit access.',
                'price'     => '$650,000',
                'location'  => 'New York, NY',
                'bedrooms'  => '2-Bedroom',
                'bathrooms' => '2-Bathroom',
                'type'      => 'Penthouse',
                'area'      => '1,800 Square Feet',
                'badge'     => 'Urban Oasis - Life in the Heart of the City',
                'image'     => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'     => 'Rustic Retreat Cottage',
                'excerpt'   => 'An elegant 3-bedroom cottage nestled amidst nature with custom wooden finishes, heated flooring, and large private acreage.',
                'price'     => '$820,000',
                'location'  => 'Aspen, Colorado',
                'bedrooms'  => '3-Bedroom',
                'bathrooms' => '3-Bathroom',
                'type'      => 'Cottage',
                'area'      => '3,100 Square Feet',
                'badge'     => 'Countryside Charms - Nature\'s Embrace',
                'image'     => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=800&q=80',
            ),
        );

        foreach ( $samples as $sample ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $sample['title'],
                'post_excerpt' => $sample['excerpt'],
                'post_content' => $sample['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'property',
            ) );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, 'property_price', $sample['price'] );
                update_post_meta( $post_id, 'property_location', $sample['location'] );
                update_post_meta( $post_id, 'property_bedrooms', $sample['bedrooms'] );
                update_post_meta( $post_id, 'property_bathrooms', $sample['bathrooms'] );
                update_post_meta( $post_id, 'property_type', $sample['type'] );
                update_post_meta( $post_id, 'property_area', $sample['area'] );
                update_post_meta( $post_id, 'property_badge', $sample['badge'] );
                update_post_meta( $post_id, 'property_image_url', $sample['image'] );
            }
        }
    }
}
add_action( 'init', 'figma_trial_seed_sample_properties', 20 );

/**
 * ============================================================================
 * ESTATEIN PAGES CMS & DEDICATED ADMIN MENU
 * ============================================================================
 */

/**
 * Returns configuration definitions for all Estatein frontend CMS pages
 */
function estatein_get_cms_pages_config() {
    return array(
        'home' => array(
            'slug'        => 'home',
            'title'       => __( 'Home Page', 'figma-trial-theme' ),
            'template'    => 'template-home.php',
            'icon'        => 'dashicons-admin-home',
            'color'       => '#703bf7',
            'badge'       => 'Front Page',
            'description' => __( 'Hero banner headline, deskripsi, CTA buttons, dan 3 kartu statistik utama (Happy Customers, Properties, Experience).', 'figma-trial-theme' ),
            'fields_list' => array( 'Hero Headline', 'Hero Description', 'Hero Visual Image', 'CTA Buttons', 'Statistics 200+ / 10k+ / 16+' ),
            'is_front'    => true,
        ),
        'about' => array(
            'slug'        => 'about-us',
            'alt_slugs'   => array( 'about', 'tentang-kami' ),
            'title'       => __( 'About Us', 'figma-trial-theme' ),
            'template'    => 'template-about-us.php',
            'icon'        => 'dashicons-groups',
            'color'       => '#3b82f6',
            'badge'       => 'About Story',
            'description' => __( 'Bagian Our Journey timeline, cerita perjalanan perusahaan, dan statistik pencapaian klien.', 'figma-trial-theme' ),
            'fields_list' => array( 'Our Journey Headline', 'Journey Description Story', 'Visual Image', 'Company Achievements' ),
        ),
        'properties' => array(
            'slug'        => 'properties',
            'alt_slugs'   => array( 'properti', 'property-listing' ),
            'title'       => __( 'Properties Page', 'figma-trial-theme' ),
            'template'    => 'template-properties.php',
            'icon'        => 'dashicons-building',
            'color'       => '#10b981',
            'badge'       => 'Catalog Hub',
            'description' => __( 'Header katalog pencarian properti, intro teks, filter pencarian, dan pagination listings.', 'figma-trial-theme' ),
            'fields_list' => array( 'Catalog Hero Title', 'Intro Description', 'Filter Controls', 'Listings Display' ),
        ),
        'services' => array(
            'slug'        => 'services',
            'alt_slugs'   => array( 'layanan' ),
            'title'       => __( 'Services', 'figma-trial-theme' ),
            'template'    => 'template-services.php',
            'icon'        => 'dashicons-businessperson',
            'color'       => '#f59e0b',
            'badge'       => 'Services & Valuation',
            'description' => __( 'Hero section layanan, konsultasi properti, manajemen investasi, dan value proposition.', 'figma-trial-theme' ),
            'fields_list' => array( 'Services Hero Headline', 'Introduction Text', 'Consultation Cards' ),
        ),
        'contact' => array(
            'slug'        => 'contact-us',
            'alt_slugs'   => array( 'contact', 'kontak' ),
            'title'       => __( 'Contact Us', 'figma-trial-theme' ),
            'template'    => 'template-contact-us.php',
            'icon'        => 'dashicons-email-alt',
            'color'       => '#ec4899',
            'badge'       => 'Communication Hub',
            'description' => __( 'Informasi kontak kantor resmi, email, nomor telepon bantuan, lokasi kantor, dan media sosial.', 'figma-trial-theme' ),
            'fields_list' => array( 'Contact Hero Title', 'Intro Description', 'Office Email', 'Phone Number', 'Main Headquarters' ),
        ),
    );
}

/**
 * Helper to get or automatically create a CMS page ID and ensure its page template is assigned
 */
function estatein_get_cms_page_id( $key ) {
    $configs = estatein_get_cms_pages_config();
    if ( ! isset( $configs[ $key ] ) ) {
        return 0;
    }
    $conf     = $configs[ $key ];
    $slug     = $conf['slug'];
    $title    = $conf['title'];
    $template = $conf['template'];

    $page = get_page_by_path( $slug, OBJECT, 'page' );

    if ( ! $page && ! empty( $conf['alt_slugs'] ) ) {
        foreach ( $conf['alt_slugs'] as $alt ) {
            $page = get_page_by_path( $alt, OBJECT, 'page' );
            if ( $page ) {
                break;
            }
        }
    }

    if ( ! $page && ! empty( $conf['is_front'] ) ) {
        $front_id = (int) get_option( 'page_on_front' );
        if ( $front_id ) {
            $page = get_post( $front_id );
        }
    }

    if ( ! $page ) {
        $page = get_page_by_title( $title, OBJECT, 'page' );
    }

    if ( ! $page && $template ) {
        $by_tpl = get_posts( array(
            'post_type'      => 'page',
            'meta_key'       => '_wp_page_template',
            'meta_value'     => $template,
            'posts_per_page' => 1,
            'post_status'    => 'any',
        ) );
        if ( ! empty( $by_tpl ) ) {
            $page = $by_tpl[0];
        }
    }

    if ( ! $page ) {
        $new_id = wp_insert_post( array(
            'post_title'     => $title,
            'post_name'      => $slug,
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ) );
        if ( $new_id && ! is_wp_error( $new_id ) ) {
            if ( $template ) {
                update_post_meta( $new_id, '_wp_page_template', $template );
            }
            if ( ! empty( $conf['is_front'] ) && ! get_option( 'page_on_front' ) ) {
                update_option( 'show_on_front', 'page' );
                update_option( 'page_on_front', $new_id );
            }
            return $new_id;
        }
        return 0;
    }

    // Ensure template meta is saved
    if ( $template && get_post_meta( $page->ID, '_wp_page_template', true ) !== $template ) {
        update_post_meta( $page->ID, '_wp_page_template', $template );
    }

    return $page->ID;
}

/**
 * Auto-ensure all CMS pages exist upon initialization
 */
function estatein_ensure_cms_pages_exist() {
    $configs = estatein_get_cms_pages_config();
    foreach ( array_keys( $configs ) as $key ) {
        estatein_get_cms_page_id( $key );
    }
}
add_action( 'init', 'estatein_ensure_cms_pages_exist', 25 );

/**
 * Register dedicated "Pages CMS" top-level menu and submenus
 */
function estatein_register_page_cms_admin_menu() {
    // Top-level menu positioned at 6 (immediately below Properties at 5)
    add_menu_page(
        __( 'Pages CMS', 'figma-trial-theme' ),
        __( 'Pages CMS', 'figma-trial-theme' ),
        'edit_pages',
        'estatein-pages-cms',
        'estatein_render_pages_cms_hub',
        'dashicons-layout',
        6
    );

    // Hub overview submenu
    add_submenu_page(
        'estatein-pages-cms',
        __( 'All Pages CMS Hub', 'figma-trial-theme' ),
        __( '★ All Pages Hub', 'figma-trial-theme' ),
        'edit_pages',
        'estatein-pages-cms',
        'estatein_render_pages_cms_hub'
    );

    // Direct 1-click edit links for each page
    $configs = estatein_get_cms_pages_config();
    foreach ( $configs as $key => $conf ) {
        $page_id = estatein_get_cms_page_id( $key );
        if ( $page_id ) {
            $edit_url = 'post.php?post=' . $page_id . '&action=edit';
            add_submenu_page(
                'estatein-pages-cms',
                $conf['title'],
                $conf['title'],
                'edit_pages',
                $edit_url
            );
        }
    }
}
add_action( 'admin_menu', 'estatein_register_page_cms_admin_menu' );

/**
 * Keep Pages CMS highlighted in the admin sidebar when editing any of the CMS pages
 */
add_filter( 'parent_file', function( $parent_file ) {
    global $current_screen, $post;
    if ( $current_screen && $current_screen->base === 'post' && $current_screen->post_type === 'page' && $post ) {
        $configs = estatein_get_cms_pages_config();
        foreach ( array_keys( $configs ) as $key ) {
            $cms_id = (int) estatein_get_cms_page_id( $key );
            if ( $cms_id && $cms_id === (int) $post->ID ) {
                return 'estatein-pages-cms';
            }
        }
    }
    return $parent_file;
} );

add_filter( 'submenu_file', function( $submenu_file ) {
    global $current_screen, $post;
    if ( $current_screen && $current_screen->base === 'post' && $current_screen->post_type === 'page' && $post ) {
        $configs = estatein_get_cms_pages_config();
        foreach ( array_keys( $configs ) as $key ) {
            $cms_id = (int) estatein_get_cms_page_id( $key );
            if ( $cms_id && $cms_id === (int) $post->ID ) {
                return 'post.php?post=' . $cms_id . '&action=edit';
            }
        }
    }
    return $submenu_file;
} );


/**
 * Ensure ACF location matches correctly for page templates regardless of exact slug or query
 */
add_filter( 'acf/location/rule_match/page_template', function( $match, $rule, $options ) {
    if ( empty( $options['post_id'] ) ) {
        return $match;
    }
    $post_id = (int) $options['post_id'];
    $post    = get_post( $post_id );
    if ( ! $post || $post->post_type !== 'page' ) {
        return $match;
    }

    $template_slug_map = array(
        'template-home.php'        => array( 'home' ),
        'template-about-us.php'     => array( 'about-us', 'about', 'tentang-kami' ),
        'template-properties.php'   => array( 'properties', 'properti' ),
        'template-services.php'     => array( 'services', 'layanan' ),
        'template-contact-us.php'   => array( 'contact-us', 'contact', 'kontak' ),
    );

    if ( isset( $template_slug_map[ $rule['value'] ] ) ) {
        if ( in_array( $post->post_name, $template_slug_map[ $rule['value'] ], true ) ) {
            return ( $rule['operator'] === '==' );
        }
        if ( $rule['value'] === 'template-home.php' && (int) get_option( 'page_on_front' ) === $post_id ) {
            return ( $rule['operator'] === '==' );
        }
    }

    return $match;
}, 10, 3 );

/**
 * Render the Estatein Pages CMS Hub Dashboard in WP Admin
 */
function estatein_render_pages_cms_hub() {
    $configs = estatein_get_cms_pages_config();
    ?>
    <div class="wrap estatein-cms-wrap">
        <style>
            .estatein-cms-wrap {
                margin: 20px 20px 40px 0;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            }
            .estatein-cms-hero {
                background: linear-gradient(135deg, #141414 0%, #1e1e24 100%);
                border: 1px solid #2a2a30;
                border-radius: 12px;
                padding: 32px 36px;
                margin-bottom: 28px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                color: #ffffff;
                position: relative;
                overflow: hidden;
            }
            .estatein-cms-hero::after {
                content: '';
                position: absolute;
                top: -60px;
                right: -60px;
                width: 220px;
                height: 220px;
                background: radial-gradient(circle, rgba(112, 59, 247, 0.25) 0%, rgba(112, 59, 247, 0) 70%);
                pointer-events: none;
            }
            .estatein-cms-hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: rgba(112, 59, 247, 0.2);
                border: 1px solid rgba(112, 59, 247, 0.4);
                color: #c4b5fd;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                padding: 4px 10px;
                border-radius: 20px;
                margin-bottom: 12px;
            }
            .estatein-cms-hero h1 {
                font-size: 26px;
                font-weight: 700;
                color: #ffffff;
                margin: 0 0 8px 0;
                line-height: 1.2;
            }
            .estatein-cms-hero p {
                font-size: 14px;
                color: #a1a1aa;
                max-width: 680px;
                margin: 0;
                line-height: 1.6;
            }
            .estatein-cms-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
                gap: 22px;
                margin-bottom: 30px;
            }
            .estatein-cms-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                padding: 24px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            }
            .estatein-cms-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
                border-color: #cbd5e1;
            }
            .estatein-card-header {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                margin-bottom: 14px;
            }
            .estatein-card-icon-title {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .estatein-card-icon {
                width: 44px;
                height: 44px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ffffff;
            }
            .estatein-card-icon .dashicons {
                font-size: 24px;
                width: 24px;
                height: 24px;
            }
            .estatein-card-title {
                font-size: 18px;
                font-weight: 700;
                color: #0f172a;
                margin: 0;
            }
            .estatein-card-badge {
                font-size: 11px;
                font-weight: 600;
                padding: 3px 8px;
                border-radius: 6px;
                background: #f1f5f9;
                color: #475569;
                border: 1px solid #e2e8f0;
            }
            .estatein-card-desc {
                font-size: 13px;
                color: #64748b;
                line-height: 1.55;
                margin: 0 0 16px 0;
                flex-grow: 1;
            }
            .estatein-card-fields {
                margin-bottom: 20px;
                padding: 12px 14px;
                background: #f8fafc;
                border-radius: 8px;
                border: 1px solid #f1f5f9;
            }
            .estatein-fields-label {
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                color: #94a3b8;
                margin-bottom: 8px;
                display: block;
            }
            .estatein-fields-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
            }
            .estatein-tag {
                font-size: 11px;
                background: #ffffff;
                border: 1px solid #e2e8f0;
                color: #334155;
                padding: 2px 7px;
                border-radius: 4px;
                font-weight: 500;
            }
            .estatein-card-actions {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-top: auto;
                padding-top: 14px;
                border-top: 1px solid #f1f5f9;
            }
            .btn-edit-cms {
                background: #703bf7 !important;
                border-color: #703bf7 !important;
                color: #ffffff !important;
                font-weight: 600 !important;
                padding: 6px 16px !important;
                border-radius: 6px !important;
                display: inline-flex !important;
                align-items: center !important;
                gap: 6px !important;
                text-decoration: none !important;
                box-shadow: 0 1px 3px rgba(112, 59, 247, 0.3) !important;
                transition: background-color 0.15s ease !important;
            }
            .btn-edit-cms:hover {
                background: #5b28d9 !important;
                border-color: #5b28d9 !important;
                color: #ffffff !important;
            }
            .btn-view-live {
                background: #f1f5f9 !important;
                border-color: #cbd5e1 !important;
                color: #475569 !important;
                font-weight: 600 !important;
                padding: 6px 12px !important;
                border-radius: 6px !important;
                display: inline-flex !important;
                align-items: center !important;
                gap: 4px !important;
                text-decoration: none !important;
                transition: background-color 0.15s ease !important;
            }
            .btn-view-live:hover {
                background: #e2e8f0 !important;
                color: #0f172a !important;
            }
            .estatein-cpt-card {
                background: linear-gradient(180deg, #faf5ff 0%, #ffffff 100%);
                border: 1px dashed #d8b4fe;
            }
            .estatein-cpt-card .estatein-card-icon {
                background: #8b5cf6 !important;
            }
            .estatein-cpt-card .estatein-card-title {
                color: #581c87;
            }
        </style>

        <!-- Top Hero Banner -->
        <div class="estatein-cms-hero">
            <span class="estatein-cms-hero-badge">Estatein CMS Suite</span>
            <h1><?php _e( 'Pages & Content Management System', 'figma-trial-theme' ); ?></h1>
            <p><?php _e( 'Kelola seluruh teks, gambar, headline, CTA button, dan statistik halaman website Estatein secara instan. Setiap halaman dilengkapi ACF tabbed seamless editing tanpa meta box yang rumit.', 'figma-trial-theme' ); ?></p>
        </div>

        <!-- Cards Grid -->
        <div class="estatein-cms-grid">
            <?php foreach ( $configs as $key => $conf ) :
                $page_id   = estatein_get_cms_page_id( $key );
                $edit_url  = admin_url( 'post.php?post=' . $page_id . '&action=edit' );
                $view_url  = $page_id ? get_permalink( $page_id ) : home_url( '/' . $conf['slug'] . '/' );
                $post_obj  = $page_id ? get_post( $page_id ) : null;
                $status    = $post_obj ? ucfirst( $post_obj->post_status ) : 'Published';
                ?>
                <div class="estatein-cms-card">
                    <div>
                        <div class="estatein-card-header">
                            <div class="estatein-card-icon-title">
                                <div class="estatein-card-icon" style="background-color: <?php echo esc_attr( $conf['color'] ); ?>;">
                                    <span class="dashicons <?php echo esc_attr( $conf['icon'] ); ?>"></span>
                                </div>
                                <div>
                                    <h2 class="estatein-card-title"><?php echo esc_html( $conf['title'] ); ?></h2>
                                    <span style="font-size: 11px; color: #94a3b8; font-family: monospace;">/<?php echo esc_html( $conf['slug'] ); ?>/</span>
                                </div>
                            </div>
                            <span class="estatein-card-badge"><?php echo esc_html( $conf['badge'] ); ?></span>
                        </div>

                        <p class="estatein-card-desc"><?php echo esc_html( $conf['description'] ); ?></p>

                        <div class="estatein-card-fields">
                            <span class="estatein-fields-label"><?php _e( 'Bidang ACF Tersedia:', 'figma-trial-theme' ); ?></span>
                            <div class="estatein-fields-tags">
                                <?php foreach ( $conf['fields_list'] as $field_tag ) : ?>
                                    <span class="estatein-tag"><?php echo esc_html( $field_tag ); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="estatein-card-actions">
                        <a href="<?php echo esc_url( $edit_url ); ?>" class="button btn-edit-cms">
                            <span class="dashicons dashicons-edit" style="font-size: 16px; width: 16px; height: 16px;"></span>
                            <?php _e( 'Edit Page (ACF)', 'figma-trial-theme' ); ?>
                        </a>
                        <a href="<?php echo esc_url( $view_url ); ?>" target="_blank" class="button btn-view-live">
                            <span class="dashicons dashicons-external" style="font-size: 14px; width: 14px; height: 14px;"></span>
                            <?php _e( 'View Page', 'figma-trial-theme' ); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Property CPT Card -->
            <div class="estatein-cms-card estatein-cpt-card">
                <div>
                    <div class="estatein-card-header">
                        <div class="estatein-card-icon-title">
                            <div class="estatein-card-icon">
                                <span class="dashicons dashicons-admin-home"></span>
                            </div>
                            <div>
                                <h2 class="estatein-card-title"><?php _e( 'Properties (CPT)', 'figma-trial-theme' ); ?></h2>
                                <span style="font-size: 11px; color: #94a3b8; font-family: monospace;">post_type=property</span>
                            </div>
                        </div>
                        <span class="estatein-card-badge" style="background: #ede9fe; color: #6b21a8; border-color: #ddd6fe;"><?php _e( 'Listing Catalog', 'figma-trial-theme' ); ?></span>
                    </div>

                    <p class="estatein-card-desc"><?php _e( 'Kelola seluruh listing unit properti, harga jual, lokasi, jumlah kamar tidur/mandi, galeri foto, fasilitas, dan kalkulator biaya.', 'figma-trial-theme' ); ?></p>

                    <div class="estatein-card-fields">
                        <span class="estatein-fields-label"><?php _e( 'Struktur Data Properti:', 'figma-trial-theme' ); ?></span>
                        <div class="estatein-fields-tags">
                            <span class="estatein-tag">Basic Details & Desc</span>
                            <span class="estatein-tag">Multi-Image Gallery</span>
                            <span class="estatein-tag">Amenities & Features</span>
                            <span class="estatein-tag">Pricing & Taxes</span>
                            <span class="estatein-tag">Monthly Expenses</span>
                        </div>
                    </div>
                </div>

                <div class="estatein-card-actions">
                    <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=property' ) ); ?>" class="button btn-edit-cms">
                        <span class="dashicons dashicons-list-view" style="font-size: 16px; width: 16px; height: 16px;"></span>
                        <?php _e( 'All Properties', 'figma-trial-theme' ); ?>
                    </a>
                    <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=property' ) ); ?>" class="button btn-view-live">
                        <span class="dashicons dashicons-plus-alt" style="font-size: 14px; width: 14px; height: 14px;"></span>
                        <?php _e( 'Add New', 'figma-trial-theme' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

