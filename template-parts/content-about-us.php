<?php
/**
 * Template part for displaying About Us page content
 *
 * Implements the Figma "About Us Page - Desktop" design specifications.
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="about-page-content">

    <!-- 1. Our Journey Section -->
    <section class="about-journey-section" id="our-story">
        <div class="theme-container">
            <div class="journey-two-col-grid">
                <!-- Left Column: Copy & Stats -->
                <div class="journey-content-col">
                    <div class="section-title-wrap">
                        <div class="abstract-accent-stars" aria-hidden="true">
                            <span class="star-accent">✦</span>
                            <span class="star-accent">✦</span>
                        </div>
                        <h1 class="section-heading">
                            <?php echo esc_html( estatein_get_page_field( 'about_journey_title', null, __( 'Our Journey', 'figma-trial-theme' ) ) ); ?>
                        </h1>
                        <p class="section-subtext">
                            <?php echo esc_html( estatein_get_page_field( 'about_journey_desc', null, __( "Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary. Over the years, we've expanded our reach, forged lasting partnerships, and earned the trust of countless clients.", 'figma-trial-theme' ) ) ); ?>
                        </p>
                    </div>

                    <!-- 3 Stats Cards Grid -->
                    <div class="journey-stats-grid">
                        <div class="stat-card">
                            <span class="stat-number"><?php echo esc_html( estatein_get_page_field( 'about_stat_1_val', null, '200+' ) ); ?></span>
                            <span class="stat-label"><?php echo esc_html( estatein_get_page_field( 'about_stat_1_label', null, __( 'Happy Customers', 'figma-trial-theme' ) ) ); ?></span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number"><?php echo esc_html( estatein_get_page_field( 'about_stat_2_val', null, '10k+' ) ); ?></span>
                            <span class="stat-label"><?php echo esc_html( estatein_get_page_field( 'about_stat_2_label', null, __( 'Properties For Clients', 'figma-trial-theme' ) ) ); ?></span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number"><?php echo esc_html( estatein_get_page_field( 'about_stat_3_val', null, '16+' ) ); ?></span>
                            <span class="stat-label"><?php echo esc_html( estatein_get_page_field( 'about_stat_3_label', null, __( 'Years of Experience', 'figma-trial-theme' ) ) ); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Visual Showcase -->
                <?php
                $about_img = estatein_get_page_field( 'about_journey_image', null, '' );
                if ( empty( $about_img ) ) {
                    $about_img = 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=1200&q=85';
                }
                ?>
                <div class="journey-visual-col">
                    <div class="journey-image-wrapper">
                        <img src="<?php echo esc_url( $about_img ); ?>" alt="<?php esc_attr_e( 'Estatein Headquarters & Team', 'figma-trial-theme' ); ?>" class="journey-main-img" fetchpriority="high" decoding="async" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Our Values Section -->
    <section class="about-values-section" id="our-values">
        <div class="theme-container">
            <div class="values-two-col-grid">
                <!-- Left Column: Title & Intro -->
                <div class="values-header-col">
                    <div class="abstract-accent-stars" aria-hidden="true">
                        <span class="star-accent">✦</span>
                        <span class="star-accent">✦</span>
                    </div>
                    <h2 class="section-heading">
                        <?php echo esc_html( estatein_get_page_field( 'about_values_title', null, __( 'Our Values', 'figma-trial-theme' ) ) ); ?>
                    </h2>
                    <p class="section-subtext">
                        <?php echo esc_html( estatein_get_page_field( 'about_values_desc', null, __( 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.', 'figma-trial-theme' ) ) ); ?>
                    </p>
                </div>

                <?php
                $v1_title = estatein_get_page_field( 'about_val_1_title', null, __( 'Trust', 'figma-trial-theme' ) );
                $v1_desc  = estatein_get_page_field( 'about_val_1_desc', null, __( 'Trust is the cornerstone of every relationship we build. We prioritize honesty and transparency in every transaction.', 'figma-trial-theme' ) );

                $v2_title = estatein_get_page_field( 'about_val_2_title', null, __( 'Excellence', 'figma-trial-theme' ) );
                $v2_desc  = estatein_get_page_field( 'about_val_2_desc', null, __( 'We set the bar high for ourselves. From the properties we list to the services we provide, we strive for nothing less than excellence.', 'figma-trial-theme' ) );

                $v3_title = estatein_get_page_field( 'about_val_3_title', null, __( 'Client-Centric', 'figma-trial-theme' ) );
                $v3_desc  = estatein_get_page_field( 'about_val_3_desc', null, __( 'Your dreams and needs are at the center of our universe. We listen, understand, and deliver tailored solutions.', 'figma-trial-theme' ) );

                $v4_title = estatein_get_page_field( 'about_val_4_title', null, __( 'Our Commitment', 'figma-trial-theme' ) );
                $v4_desc  = estatein_get_page_field( 'about_val_4_desc', null, __( 'We are dedicated to providing you with the highest level of service, professionalism, and integrity throughout your real estate journey.', 'figma-trial-theme' ) );
                ?>
                <!-- Right Column: 2x2 Values Card Box -->
                <div class="values-cards-box">
                    <div class="values-grid-2x2">
                        <!-- Value 1: Trust -->
                        <div class="value-item">
                            <div class="value-item-header">
                                <div class="value-icon-circle">
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                </div>
                                <h3 class="value-item-title"><?php echo esc_html( $v1_title ); ?></h3>
                            </div>
                            <p class="value-item-desc"><?php echo esc_html( $v1_desc ); ?></p>
                        </div>

                        <!-- Value 2: Excellence -->
                        <div class="value-item">
                            <div class="value-item-header">
                                <div class="value-icon-circle">
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="8" r="7"/>
                                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>
                                    </svg>
                                </div>
                                <h3 class="value-item-title"><?php echo esc_html( $v2_title ); ?></h3>
                            </div>
                            <p class="value-item-desc"><?php echo esc_html( $v2_desc ); ?></p>
                        </div>

                        <!-- Value 3: Client-Centric -->
                        <div class="value-item">
                            <div class="value-item-header">
                                <div class="value-icon-circle">
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                </div>
                                <h3 class="value-item-title"><?php echo esc_html( $v3_title ); ?></h3>
                            </div>
                            <p class="value-item-desc"><?php echo esc_html( $v3_desc ); ?></p>
                        </div>

                        <!-- Value 4: Our Commitment -->
                        <div class="value-item">
                            <div class="value-item-header">
                                <div class="value-icon-circle">
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    </svg>
                                </div>
                                <h3 class="value-item-title"><?php echo esc_html( $v4_title ); ?></h3>
                            </div>
                            <p class="value-item-desc"><?php echo esc_html( $v4_desc ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Our Achievements Section -->
    <section class="about-achievements-section" id="our-achievements">
        <div class="theme-container">
            <div class="section-title-wrap">
                <div class="abstract-accent-stars" aria-hidden="true">
                    <span class="star-accent">✦</span>
                    <span class="star-accent">✦</span>
                </div>
                <h2 class="section-heading">
                    <?php echo esc_html( estatein_get_page_field( 'about_achieve_title', null, __( 'Our Achievements', 'figma-trial-theme' ) ) ); ?>
                </h2>
                <p class="section-subtext">
                    <?php echo esc_html( estatein_get_page_field( 'about_achieve_desc', null, __( 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.', 'figma-trial-theme' ) ) ); ?>
                </p>
            </div>

            <?php
            $ac1_title = estatein_get_page_field( 'about_achieve_1_title', null, __( '3+ Years of Excellence', 'figma-trial-theme' ) );
            $ac1_desc  = estatein_get_page_field( 'about_achieve_1_desc', null, __( "With over 3 years in the industry, we've amassed a wealth of knowledge and experience, becoming a go-to resource for all things real estate.", 'figma-trial-theme' ) );

            $ac2_title = estatein_get_page_field( 'about_achieve_2_title', null, __( 'Happy Clients', 'figma-trial-theme' ) );
            $ac2_desc  = estatein_get_page_field( 'about_achieve_2_desc', null, __( 'Our greatest achievement is the satisfaction of our clients. Over 200 happy families and individuals have found their dream homes with us.', 'figma-trial-theme' ) );

            $ac3_title = estatein_get_page_field( 'about_achieve_3_title', null, __( 'Industry Recognition', 'figma-trial-theme' ) );
            $ac3_desc  = estatein_get_page_field( 'about_achieve_3_desc', null, __( "We've earned the respect of our peers and industry leaders, with accolades and awards that reflect our commitment to excellence.", 'figma-trial-theme' ) );
            ?>
            <!-- 3 Achievements Cards -->
            <div class="achievements-cards-grid">
                <div class="achievement-card">
                    <h3 class="achievement-title"><?php echo esc_html( $ac1_title ); ?></h3>
                    <p class="achievement-desc"><?php echo esc_html( $ac1_desc ); ?></p>
                </div>
                <div class="achievement-card">
                    <h3 class="achievement-title"><?php echo esc_html( $ac2_title ); ?></h3>
                    <p class="achievement-desc"><?php echo esc_html( $ac2_desc ); ?></p>
                </div>
                <div class="achievement-card">
                    <h3 class="achievement-title"><?php echo esc_html( $ac3_title ); ?></h3>
                    <p class="achievement-desc"><?php echo esc_html( $ac3_desc ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Navigating the Estatein Experience (6 Steps) -->
    <section class="about-experience-section" id="how-it-works">
        <div class="theme-container">
            <div class="section-title-wrap">
                <div class="abstract-accent-stars" aria-hidden="true">
                    <span class="star-accent">✦</span>
                    <span class="star-accent">✦</span>
                </div>
                <h2 class="section-heading"><?php esc_html_e( 'Navigating the Estatein Experience', 'figma-trial-theme' ); ?></h2>
                <p class="section-subtext">
                    <?php esc_html_e( "At Estatein, we've designed a straightforward process to help you find and purchase your dream property with ease. Here's how it works:", 'figma-trial-theme' ); ?>
                </p>
            </div>

            <!-- 6 Steps Grid (2 rows x 3 columns) -->
            <div class="experience-steps-grid">
                <!-- Step 01 -->
                <div class="step-card-item">
                    <div class="step-number-header">
                        <span class="step-number"><?php esc_html_e( 'Step 01', 'figma-trial-theme' ); ?></span>
                    </div>
                    <div class="step-card-body">
                        <h3 class="step-title"><?php esc_html_e( 'Discover a World of Possibilities', 'figma-trial-theme' ); ?></h3>
                        <p class="step-desc">
                            <?php esc_html_e( 'Explore our comprehensive property listings with detailed descriptions, high-quality images, and virtual tours to find your ideal home.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Step 02 -->
                <div class="step-card-item">
                    <div class="step-number-header">
                        <span class="step-number"><?php esc_html_e( 'Step 02', 'figma-trial-theme' ); ?></span>
                    </div>
                    <div class="step-card-body">
                        <h3 class="step-title"><?php esc_html_e( 'Narrowing Down Your Choices', 'figma-trial-theme' ); ?></h3>
                        <p class="step-desc">
                            <?php esc_html_e( 'Use our advanced search filters to refine your search based on price, location, property type, and specific amenities that matter to you.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Step 03 -->
                <div class="step-card-item">
                    <div class="step-number-header">
                        <span class="step-number"><?php esc_html_e( 'Step 03', 'figma-trial-theme' ); ?></span>
                    </div>
                    <div class="step-card-body">
                        <h3 class="step-title"><?php esc_html_e( 'Personalized Guidance', 'figma-trial-theme' ); ?></h3>
                        <p class="step-desc">
                            <?php esc_html_e( 'Connect with our expert agents who will provide dedicated guidance, market insights, and schedule private viewings tailored to your schedule.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Step 04 -->
                <div class="step-card-item">
                    <div class="step-number-header">
                        <span class="step-number"><?php esc_html_e( 'Step 04', 'figma-trial-theme' ); ?></span>
                    </div>
                    <div class="step-card-body">
                        <h3 class="step-title"><?php esc_html_e( 'See It for Yourself', 'figma-trial-theme' ); ?></h3>
                        <p class="step-desc">
                            <?php esc_html_e( 'Arrange on-site property viewings accompanied by our experienced real estate professionals to get a firsthand feel of the space.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Step 05 -->
                <div class="step-card-item">
                    <div class="step-number-header">
                        <span class="step-number"><?php esc_html_e( 'Step 05', 'figma-trial-theme' ); ?></span>
                    </div>
                    <div class="step-card-body">
                        <h3 class="step-title"><?php esc_html_e( 'Making Informed Decisions', 'figma-trial-theme' ); ?></h3>
                        <p class="step-desc">
                            <?php esc_html_e( 'We provide comprehensive valuation data, legal documentation assistance, and neighborhood analysis to empower confident decisions.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Step 06 -->
                <div class="step-card-item">
                    <div class="step-number-header">
                        <span class="step-number"><?php esc_html_e( 'Step 06', 'figma-trial-theme' ); ?></span>
                    </div>
                    <div class="step-card-body">
                        <h3 class="step-title"><?php esc_html_e( 'Getting the Best Deal', 'figma-trial-theme' ); ?></h3>
                        <p class="step-desc">
                            <?php esc_html_e( 'Our seasoned negotiators work on your behalf to secure optimal terms, handle contract agreements, and ensure a seamless closing process.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Meet the Estatein Team -->
    <section class="about-team-section" id="our-team">
        <div class="theme-container">
            <div class="section-title-wrap">
                <div class="abstract-accent-stars" aria-hidden="true">
                    <span class="star-accent">✦</span>
                    <span class="star-accent">✦</span>
                </div>
                <h2 class="section-heading">
                    <?php echo esc_html( estatein_get_page_field( 'about_team_title', null, __( 'Meet the Estatein Team', 'figma-trial-theme' ) ) ); ?>
                </h2>
                <p class="section-subtext">
                    <?php echo esc_html( estatein_get_page_field( 'about_team_desc', null, __( 'At Estatein, our success is driven by the dedication and expertise of our team. Get to know the people behind our mission to deliver exceptional real estate experiences.', 'figma-trial-theme' ) ) ); ?>
                </p>
            </div>

            <?php
            // Member 1
            $m1_name  = estatein_get_page_field( 'about_team_1_name', null, 'Max Mitchell' );
            $m1_role  = estatein_get_page_field( 'about_team_1_role', null, __( 'Founder', 'figma-trial-theme' ) );
            $m1_photo = estatein_get_page_field( 'about_team_1_photo', null, 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80' );

            // Member 2
            $m2_name  = estatein_get_page_field( 'about_team_2_name', null, 'Sarah Johnson' );
            $m2_role  = estatein_get_page_field( 'about_team_2_role', null, __( 'Chief Real Estate Officer', 'figma-trial-theme' ) );
            $m2_photo = estatein_get_page_field( 'about_team_2_photo', null, 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80' );

            // Member 3
            $m3_name  = estatein_get_page_field( 'about_team_3_name', null, 'David Brown' );
            $m3_role  = estatein_get_page_field( 'about_team_3_role', null, __( 'Head of Property Management', 'figma-trial-theme' ) );
            $m3_photo = estatein_get_page_field( 'about_team_3_photo', null, 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=600&q=80' );

            // Member 4
            $m4_name  = estatein_get_page_field( 'about_team_4_name', null, 'Michael Turner' );
            $m4_role  = estatein_get_page_field( 'about_team_4_role', null, __( 'Legal Counsel', 'figma-trial-theme' ) );
            $m4_photo = estatein_get_page_field( 'about_team_4_photo', null, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80' );
            ?>
            <!-- 4-Column Team Cards Grid -->
            <div class="team-cards-grid">
                <!-- Team Member 1 -->
                <div class="team-card">
                    <div class="team-image-wrapper">
                        <img src="<?php echo esc_url( $m1_photo ); ?>" alt="<?php echo esc_attr( $m1_name ); ?>" class="team-photo" loading="lazy" decoding="async" />
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="team-social-badge" aria-label="<?php echo esc_attr( $m1_name ); ?> on Twitter">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFFFFF">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="team-info-box">
                        <h3 class="team-member-name"><?php echo esc_html( $m1_name ); ?></h3>
                        <span class="team-member-role"><?php echo esc_html( $m1_role ); ?></span>
                    </div>
                    <div class="team-say-hello-pill">
                        <span class="say-hello-text"><?php esc_html_e( 'Say Hello 👋', 'figma-trial-theme' ); ?></span>
                        <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="btn-send-pill" aria-label="<?php esc_attr_e( 'Send message to team member', 'figma-trial-theme' ); ?>">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="team-card">
                    <div class="team-image-wrapper">
                        <img src="<?php echo esc_url( $m2_photo ); ?>" alt="<?php echo esc_attr( $m2_name ); ?>" class="team-photo" loading="lazy" decoding="async" />
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="team-social-badge" aria-label="<?php echo esc_attr( $m2_name ); ?> on Twitter">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFFFFF">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="team-info-box">
                        <h3 class="team-member-name"><?php echo esc_html( $m2_name ); ?></h3>
                        <span class="team-member-role"><?php echo esc_html( $m2_role ); ?></span>
                    </div>
                    <div class="team-say-hello-pill">
                        <span class="say-hello-text"><?php esc_html_e( 'Say Hello 👋', 'figma-trial-theme' ); ?></span>
                        <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="btn-send-pill" aria-label="<?php esc_attr_e( 'Send message to team member', 'figma-trial-theme' ); ?>">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="team-card">
                    <div class="team-image-wrapper">
                        <img src="<?php echo esc_url( $m3_photo ); ?>" alt="<?php echo esc_attr( $m3_name ); ?>" class="team-photo" loading="lazy" decoding="async" />
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="team-social-badge" aria-label="<?php echo esc_attr( $m3_name ); ?> on Twitter">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFFFFF">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="team-info-box">
                        <h3 class="team-member-name"><?php echo esc_html( $m3_name ); ?></h3>
                        <span class="team-member-role"><?php echo esc_html( $m3_role ); ?></span>
                    </div>
                    <div class="team-say-hello-pill">
                        <span class="say-hello-text"><?php esc_html_e( 'Say Hello 👋', 'figma-trial-theme' ); ?></span>
                        <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="btn-send-pill" aria-label="<?php esc_attr_e( 'Send message to team member', 'figma-trial-theme' ); ?>">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="team-card">
                    <div class="team-image-wrapper">
                        <img src="<?php echo esc_url( $m4_photo ); ?>" alt="<?php echo esc_attr( $m4_name ); ?>" class="team-photo" loading="lazy" decoding="async" />
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="team-social-badge" aria-label="<?php echo esc_attr( $m4_name ); ?> on Twitter">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFFFFF">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="team-info-box">
                        <h3 class="team-member-name"><?php echo esc_html( $m4_name ); ?></h3>
                        <span class="team-member-role"><?php echo esc_html( $m4_role ); ?></span>
                    </div>
                    <div class="team-say-hello-pill">
                        <span class="say-hello-text"><?php esc_html_e( 'Say Hello 👋', 'figma-trial-theme' ); ?></span>
                        <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="btn-send-pill" aria-label="<?php esc_attr_e( 'Send message to team member', 'figma-trial-theme' ); ?>">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Our Valued Clients -->
    <section class="about-clients-section" id="our-clients">
        <div class="theme-container">
            <div class="section-title-wrap">
                <div class="abstract-accent-stars" aria-hidden="true">
                    <span class="star-accent">✦</span>
                    <span class="star-accent">✦</span>
                </div>
                <h2 class="section-heading">
                    <?php echo esc_html( estatein_get_page_field( 'about_clients_title', null, __( 'Our Valued Clients', 'figma-trial-theme' ) ) ); ?>
                </h2>
                <p class="section-subtext">
                    <?php echo esc_html( estatein_get_page_field( 'about_clients_desc', null, __( 'At Estatein, we have had the privilege of working with a diverse range of clients across various industries. Here are some of the clients we have served:', 'figma-trial-theme' ) ) ); ?>
                </p>
            </div>

            <?php
            // Client 1
            $cl1_since    = estatein_get_page_field( 'about_client_1_since', null, __( 'Since 2019', 'figma-trial-theme' ) );
            $cl1_name     = estatein_get_page_field( 'about_client_1_name', null, 'ABC Corporation' );
            $cl1_url      = estatein_get_page_field( 'about_client_1_url', null, 'https://example.com' );
            $cl1_domain   = estatein_get_page_field( 'about_client_1_domain', null, __( 'Commercial Real Estate', 'figma-trial-theme' ) );
            $cl1_category = estatein_get_page_field( 'about_client_1_category', null, __( 'Luxury Retail / Corporate HQ', 'figma-trial-theme' ) );
            $cl1_quote    = estatein_get_page_field( 'about_client_1_quote', null, __( "Estatein's expertise in finding prime locations helped us expand our retail footprint significantly. Their team is truly top-tier.", 'figma-trial-theme' ) );

            // Client 2
            $cl2_since    = estatein_get_page_field( 'about_client_2_since', null, __( 'Since 2021', 'figma-trial-theme' ) );
            $cl2_name     = estatein_get_page_field( 'about_client_2_name', null, 'Wade Warren Ventures' );
            $cl2_url      = estatein_get_page_field( 'about_client_2_url', null, 'https://example.com' );
            $cl2_domain   = estatein_get_page_field( 'about_client_2_domain', null, __( 'Residential Development', 'figma-trial-theme' ) );
            $cl2_category = estatein_get_page_field( 'about_client_2_category', null, __( 'Luxury Waterfront Villas', 'figma-trial-theme' ) );
            $cl2_quote    = estatein_get_page_field( 'about_client_2_quote', null, __( 'From site acquisition to final sales closing, Estatein provided unmatched professionalism, transparency, and strategic market foresight.', 'figma-trial-theme' ) );
            ?>
            <!-- 2 Large Client Case Study Cards -->
            <div class="clients-cards-grid">
                <!-- Client Card 1 -->
                <div class="client-case-card">
                    <div class="client-card-top">
                        <div class="client-identity">
                            <span class="client-tenure-tag"><?php echo esc_html( $cl1_since ); ?></span>
                            <h3 class="client-corp-name"><?php echo esc_html( $cl1_name ); ?></h3>
                        </div>
                        <a href="<?php echo esc_url( $cl1_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-secondary-dark client-website-btn">
                            <?php esc_html_e( 'Visit Website', 'figma-trial-theme' ); ?>
                        </a>
                    </div>

                    <div class="client-meta-strip">
                        <div class="meta-item">
                            <div class="meta-icon-text">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                                <span class="meta-label"><?php esc_html_e( 'Domain', 'figma-trial-theme' ); ?></span>
                            </div>
                            <span class="meta-val"><?php echo esc_html( $cl1_domain ); ?></span>
                        </div>
                        <div class="meta-divider" aria-hidden="true"></div>
                        <div class="meta-item">
                            <div class="meta-icon-text">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                <span class="meta-label"><?php esc_html_e( 'Category', 'figma-trial-theme' ); ?></span>
                            </div>
                            <span class="meta-val"><?php echo esc_html( $cl1_category ); ?></span>
                        </div>
                    </div>

                    <div class="client-testimonial-quote-box">
                        <span class="quote-box-label"><?php esc_html_e( 'What They Said', 'figma-trial-theme' ); ?></span>
                        <p class="quote-box-text">
                            <?php echo esc_html( $cl1_quote ); ?>
                        </p>
                    </div>
                </div>

                <!-- Client Card 2 -->
                <div class="client-case-card">
                    <div class="client-card-top">
                        <div class="client-identity">
                            <span class="client-tenure-tag"><?php echo esc_html( $cl2_since ); ?></span>
                            <h3 class="client-corp-name"><?php echo esc_html( $cl2_name ); ?></h3>
                        </div>
                        <a href="<?php echo esc_url( $cl2_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-secondary-dark client-website-btn">
                            <?php esc_html_e( 'Visit Website', 'figma-trial-theme' ); ?>
                        </a>
                    </div>

                    <div class="client-meta-strip">
                        <div class="meta-item">
                            <div class="meta-icon-text">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                                <span class="meta-label"><?php esc_html_e( 'Domain', 'figma-trial-theme' ); ?></span>
                            </div>
                            <span class="meta-val"><?php echo esc_html( $cl2_domain ); ?></span>
                        </div>
                        <div class="meta-divider" aria-hidden="true"></div>
                        <div class="meta-item">
                            <div class="meta-icon-text">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                <span class="meta-label"><?php esc_html_e( 'Category', 'figma-trial-theme' ); ?></span>
                            </div>
                            <span class="meta-val"><?php echo esc_html( $cl2_category ); ?></span>
                        </div>
                    </div>

                    <div class="client-testimonial-quote-box">
                        <span class="quote-box-label"><?php esc_html_e( 'What They Said', 'figma-trial-theme' ); ?></span>
                        <p class="quote-box-text">
                            <?php echo esc_html( $cl2_quote ); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Carousel Pagination Bar -->
            <div class="section-pagination-bar">
                <span class="pagination-page-info">01 <span class="pagination-total">of 10</span></span>
                <div class="pagination-buttons">
                    <button type="button" class="btn-circle-nav prev" aria-label="<?php esc_attr_e( 'Previous clients', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#808080" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <button type="button" class="btn-circle-nav next" aria-label="<?php esc_attr_e( 'Next clients', 'figma-trial-theme' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

</div><!-- .about-page-content -->
