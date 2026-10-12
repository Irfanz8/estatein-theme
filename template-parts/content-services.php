<?php
/**
 * Template part for displaying Services Page content
 *
 * Implements the Figma "Services Page - Desktop" design specifications.
 *
 * @package Figma_Trial_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="services-page-content">
    <!-- 1. Hero & Service Highlights Strip Section -->
    <section class="services-hero-section">
        <div class="theme-container">
            <div class="services-hero-header">
                <div class="abstract-accent-stars" aria-hidden="true">
                    <span class="star-accent">✦</span>
                    <span class="star-accent">✦</span>
                </div>
                <h1 class="services-hero-title">
                    <?php echo esc_html( estatein_get_page_field( 'services_hero_title', null, __( 'Elevate Your Real Estate Experience', 'figma-trial-theme' ) ) ); ?>
                </h1>
                <p class="services-hero-desc">
                    <?php echo esc_html( estatein_get_page_field( 'services_hero_desc', null, __( 'Welcome to Estatein, where your real estate aspirations meet expert guidance. Explore our comprehensive range of services, each designed to cater to your unique needs and dreams.', 'figma-trial-theme' ) ) ); ?>
                </p>
            </div>

            <!-- 4 Quick-Action Feature Cards Strip -->
            <div class="services-quick-strip">
                <!-- Quick Card 1 -->
                <a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" class="service-quick-card">
                    <div class="quick-card-icon-wrap">
                        <span class="quick-card-icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </span>
                    </div>
                    <span class="quick-card-title"><?php esc_html_e( 'Find Your Dream Home', 'figma-trial-theme' ); ?></span>
                    <span class="quick-card-arrow" aria-hidden="true">↗</span>
                </a>

                <!-- Quick Card 2 -->
                <a href="#unlock-value" class="service-quick-card">
                    <div class="quick-card-icon-wrap">
                        <span class="quick-card-icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/>
                                <path d="M12 6v2m0 8v2"/>
                            </svg>
                        </span>
                    </div>
                    <span class="quick-card-title"><?php esc_html_e( 'Unlock Property Value', 'figma-trial-theme' ); ?></span>
                    <span class="quick-card-arrow" aria-hidden="true">↗</span>
                </a>

                <!-- Quick Card 3 -->
                <a href="#property-management" class="service-quick-card">
                    <div class="quick-card-icon-wrap">
                        <span class="quick-card-icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2"/>
                                <path d="M3 9h18M9 21V9"/>
                            </svg>
                        </span>
                    </div>
                    <span class="quick-card-title"><?php esc_html_e( 'Effortless Property Management', 'figma-trial-theme' ); ?></span>
                    <span class="quick-card-arrow" aria-hidden="true">↗</span>
                </a>

                <!-- Quick Card 4 -->
                <a href="#smart-investments" class="service-quick-card">
                    <div class="quick-card-icon-wrap">
                        <span class="quick-card-icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </span>
                    </div>
                    <span class="quick-card-title"><?php esc_html_e( 'Smart Investments, Informed Decisions', 'figma-trial-theme' ); ?></span>
                    <span class="quick-card-arrow" aria-hidden="true">↗</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 2. Section 2: Unlock Property Value -->
    <section class="services-block-section" id="unlock-value">
        <div class="theme-container">
            <div class="section-title-wrap">
                <div class="abstract-accent-stars" aria-hidden="true">
                    <span class="star-accent">✦</span>
                    <span class="star-accent">✦</span>
                </div>
                <h2 class="section-heading"><?php esc_html_e( 'Unlock Property Value', 'figma-trial-theme' ); ?></h2>
                <p class="section-subtext">
                    <?php esc_html_e( 'Selling your property should be a rewarding experience, not a stressful one. Discover how Estatein transforms property selling into a seamless journey with exceptional value.', 'figma-trial-theme' ); ?>
                </p>
            </div>

            <!-- Services Grid: Row 1 (3 items) & Row 2 (1 item + 1 wide promo) -->
            <div class="services-grid-wrapper">
                <!-- Row 1: 3 Cards -->
                <div class="services-row-three">
                    <!-- Card 1 -->
                    <div class="service-detail-card">
                        <div class="service-card-header">
                            <div class="service-icon-circle">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="20" x2="18" y2="10"/>
                                    <line x1="12" y1="20" x2="12" y2="4"/>
                                    <line x1="6" y1="20" x2="6" y2="14"/>
                                </svg>
                            </div>
                            <h3 class="service-card-title"><?php esc_html_e( 'Valuation Mastery', 'figma-trial-theme' ); ?></h3>
                        </div>
                        <p class="service-card-desc">
                            <?php esc_html_e( 'Discover the true worth of your property with our expert valuation services and deep local market data analytics.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="service-detail-card">
                        <div class="service-card-header">
                            <div class="service-icon-circle">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                                    <path d="M15.54 8.46a5 5 0 0 1 0 7.07"/>
                                    <path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>
                                </svg>
                            </div>
                            <h3 class="service-card-title"><?php esc_html_e( 'Strategic Marketing', 'figma-trial-theme' ); ?></h3>
                        </div>
                        <p class="service-card-desc">
                            <?php esc_html_e( 'Selling a property requires more than just a listing; it takes a targeted marketing approach to attract qualified buyers worldwide.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="service-detail-card">
                        <div class="service-card-header">
                            <div class="service-icon-circle">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/>
                                    <path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/>
                                    <path d="M7 21h10"/>
                                    <path d="M12 3v18"/>
                                    <path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/>
                                </svg>
                            </div>
                            <h3 class="service-card-title"><?php esc_html_e( 'Negotiation Wizardry', 'figma-trial-theme' ); ?></h3>
                        </div>
                        <p class="service-card-desc">
                            <?php esc_html_e( 'Negotiating the best deal is an art, and our seasoned real estate negotiators consistently deliver the highest return on value.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Row 2: 1 Card + 1 Wide Promo Card -->
                <div class="services-row-split">
                    <!-- Card 4 -->
                    <div class="service-detail-card flex-one">
                        <div class="service-card-header">
                            <div class="service-icon-circle">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <polyline points="22 4 12 14.01 9 11.01"/>
                                </svg>
                            </div>
                            <h3 class="service-card-title"><?php esc_html_e( 'Closing Success', 'figma-trial-theme' ); ?></h3>
                        </div>
                        <p class="service-card-desc">
                            <?php esc_html_e( 'A successful sale is not complete until closing. We guide you through the intricate legal and escrow processes with complete clarity.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <!-- Wide Promo Card -->
                    <div class="service-promo-card flex-two">
                        <div class="promo-card-content">
                            <div class="promo-header-row">
                                <h3 class="promo-card-title"><?php esc_html_e( 'Unlock the Value of Your Property Today', 'figma-trial-theme' ); ?></h3>
                                <a href="<?php echo esc_url( home_url( '/properties/#consultation' ) ); ?>" class="btn-secondary-dark promo-action-btn">
                                    <?php esc_html_e( 'Learn More', 'figma-trial-theme' ); ?>
                                </a>
                            </div>
                            <p class="promo-card-desc">
                                <?php esc_html_e( 'Ready to put your property on the market? Contact us today to explore how Estatein can help you achieve the best possible results.', 'figma-trial-theme' ); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Section 3: Effortless Property Management -->
    <section class="services-block-section" id="property-management">
        <div class="theme-container">
            <div class="section-title-wrap">
                <div class="abstract-accent-stars" aria-hidden="true">
                    <span class="star-accent">✦</span>
                    <span class="star-accent">✦</span>
                </div>
                <h2 class="section-heading"><?php esc_html_e( 'Effortless Property Management', 'figma-trial-theme' ); ?></h2>
                <p class="section-subtext">
                    <?php esc_html_e( 'Managing a property shouldn’t be your second job. With Estatein, experience hassle-free property management that preserves your asset and maximizes recurring returns.', 'figma-trial-theme' ); ?>
                </p>
            </div>

            <div class="services-grid-wrapper">
                <!-- Row 1: 3 Cards -->
                <div class="services-row-three">
                    <!-- Card 1 -->
                    <div class="service-detail-card">
                        <div class="service-card-header">
                            <div class="service-icon-circle">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <h3 class="service-card-title"><?php esc_html_e( 'Tenant Harmony', 'figma-trial-theme' ); ?></h3>
                        </div>
                        <p class="service-card-desc">
                            <?php esc_html_e( 'Our tenant management services ensure that your tenants are satisfied and your property remains in immaculate condition year-round.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="service-detail-card">
                        <div class="service-card-header">
                            <div class="service-icon-circle">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                </svg>
                            </div>
                            <h3 class="service-card-title"><?php esc_html_e( 'Maintenance Ease', 'figma-trial-theme' ); ?></h3>
                        </div>
                        <p class="service-card-desc">
                            <?php esc_html_e( 'Say goodbye to maintenance headaches. We handle all routine upkeep, prompt inspections, and trusted vendor oversight.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="service-detail-card">
                        <div class="service-card-header">
                            <div class="service-icon-circle">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="14" x="2" y="5" rx="2"/>
                                    <line x1="2" y1="10" x2="22" y2="10"/>
                                </svg>
                            </div>
                            <h3 class="service-card-title"><?php esc_html_e( 'Financial Peace of Mind', 'figma-trial-theme' ); ?></h3>
                        </div>
                        <p class="service-card-desc">
                            <?php esc_html_e( 'Managing property finances can be complex. Our financial specialists handle transparent accounting, rent collection, and regular reporting.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Row 2: 1 Card + 1 Wide Promo Card -->
                <div class="services-row-split">
                    <!-- Card 4 -->
                    <div class="service-detail-card flex-one">
                        <div class="service-card-header">
                            <div class="service-icon-circle">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                            </div>
                            <h3 class="service-card-title"><?php esc_html_e( 'Legal Safeguard', 'figma-trial-theme' ); ?></h3>
                        </div>
                        <p class="service-card-desc">
                            <?php esc_html_e( 'Stay fully compliant with property laws and lease regulations effortlessly with our proactive legal and contracts guidance.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <!-- Wide Promo Card -->
                    <div class="service-promo-card flex-two">
                        <div class="promo-card-content">
                            <div class="promo-header-row">
                                <h3 class="promo-card-title"><?php esc_html_e( 'Experience Effortless Property Management', 'figma-trial-theme' ); ?></h3>
                                <a href="<?php echo esc_url( home_url( '/properties/#consultation' ) ); ?>" class="btn-secondary-dark promo-action-btn">
                                    <?php esc_html_e( 'Learn More', 'figma-trial-theme' ); ?>
                                </a>
                            </div>
                            <p class="promo-card-desc">
                                <?php esc_html_e( 'Ready to experience hassle-free property management? Explore our tailored services and let us handle the daily details for you.', 'figma-trial-theme' ); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Section 4: Smart Investments, Informed Decisions -->
    <section class="services-investments-section" id="smart-investments">
        <div class="theme-container">
            <div class="investments-two-col-layout">
                <!-- Left Column: Title & Promo Box -->
                <div class="investments-left-col">
                    <div class="investments-text-box">
                        <div class="abstract-accent-stars" aria-hidden="true">
                            <span class="star-accent">✦</span>
                            <span class="star-accent">✦</span>
                        </div>
                        <h2 class="section-heading"><?php esc_html_e( 'Smart Investments, Informed Decisions', 'figma-trial-theme' ); ?></h2>
                        <p class="section-subtext">
                            <?php esc_html_e( 'Building a real estate portfolio requires a strategic approach. Estatein empowers your investment decisions with market insights and customized investment solutions.', 'figma-trial-theme' ); ?>
                        </p>
                    </div>

                    <!-- Left Column Promo Card from Figma -->
                    <div class="investments-promo-card">
                        <h3 class="investments-promo-title"><?php esc_html_e( 'Unlock Your Investment Potential', 'figma-trial-theme' ); ?></h3>
                        <p class="investments-promo-desc">
                            <?php esc_html_e( 'Explore our customized investment advisory services and unlock the true potential of your real estate portfolio.', 'figma-trial-theme' ); ?>
                        </p>
                        <a href="<?php echo esc_url( home_url( '/properties/#consultation' ) ); ?>" class="btn-secondary-dark investments-promo-btn">
                            <?php esc_html_e( 'Learn More', 'figma-trial-theme' ); ?>
                        </a>
                    </div>
                </div>

                <!-- Right Column: 2x2 Grid in Outer Container -->
                <div class="investments-right-col">
                    <div class="investments-cards-container-2x2">
                        <!-- Grid Row 1 -->
                        <div class="investments-grid-row">
                            <!-- Card 1 -->
                            <div class="investment-grid-card">
                                <div class="service-card-header">
                                    <div class="service-icon-circle">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"/>
                                            <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>
                                        </svg>
                                    </div>
                                    <h3 class="service-card-title"><?php esc_html_e( 'Market Insight', 'figma-trial-theme' ); ?></h3>
                                </div>
                                <p class="service-card-desc">
                                    <?php esc_html_e( 'Stay ahead of market trends with our comprehensive research, data analytics, and predictive market reports.', 'figma-trial-theme' ); ?>
                                </p>
                            </div>

                            <!-- Card 2 -->
                            <div class="investment-grid-card">
                                <div class="service-card-header">
                                    <div class="service-icon-circle">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                                            <polyline points="17 6 23 6 23 12"/>
                                        </svg>
                                    </div>
                                    <h3 class="service-card-title"><?php esc_html_e( 'ROI Optimization', 'figma-trial-theme' ); ?></h3>
                                </div>
                                <p class="service-card-desc">
                                    <?php esc_html_e( 'Maximize your returns with tailored investment strategies that balance yield, appreciation, and risk mitigation.', 'figma-trial-theme' ); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Grid Row 2 -->
                        <div class="investments-grid-row">
                            <!-- Card 3 -->
                            <div class="investment-grid-card">
                                <div class="service-card-header">
                                    <div class="service-icon-circle">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                                        </svg>
                                    </div>
                                    <h3 class="service-card-title"><?php esc_html_e( 'Portfolio Growth', 'figma-trial-theme' ); ?></h3>
                                </div>
                                <p class="service-card-desc">
                                    <?php esc_html_e( 'Scale your real estate holdings methodically with expert acquisition sourcing and multi-market portfolio diversification.', 'figma-trial-theme' ); ?>
                                </p>
                            </div>

                            <!-- Card 4 -->
                            <div class="investment-grid-card">
                                <div class="service-card-header">
                                    <div class="service-icon-circle">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A685FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                            <polyline points="9 12 11 14 15 10"/>
                                        </svg>
                                    </div>
                                    <h3 class="service-card-title"><?php esc_html_e( 'Risk Management', 'figma-trial-theme' ); ?></h3>
                                </div>
                                <p class="service-card-desc">
                                    <?php esc_html_e( 'Protect your investments against market volatility with rigorous due diligence and proactive risk mitigation strategies.', 'figma-trial-theme' ); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
