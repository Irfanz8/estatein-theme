/**
 * Main JavaScript File for Figma Trial Theme (Estatein)
 */
document.addEventListener('DOMContentLoaded', () => {
    // 1. Top Announcement Banner Dismiss
    const banner = document.getElementById('top-banner');
    const closeBannerBtn = document.getElementById('close-banner-btn');
    if (banner && closeBannerBtn) {
        closeBannerBtn.addEventListener('click', () => {
            banner.style.display = 'none';
        });
    }

    // 2. Mobile Menu Toggle
    const menuToggle = document.getElementById('menu-toggle');
    const siteNav = document.getElementById('primary-navigation');
    if (menuToggle && siteNav) {
        menuToggle.addEventListener('click', () => {
            const isOpen = siteNav.classList.toggle('is-open');
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    // 3. Property Gallery Interactivity
    const thumbnails = document.querySelectorAll('.gallery-thumbnails-strip .thumb-item');
    const mainImg1 = document.getElementById('main-preview-1');
    const mainImg2 = document.getElementById('main-preview-2');
    const dots = document.querySelectorAll('.gallery-indicators .indicator-dot');
    const prevBtn = document.getElementById('gallery-prev');
    const nextBtn = document.getElementById('gallery-next');

    let currentIndex = 0;

    function updateGallery(index) {
        if (!thumbnails.length) return;

        currentIndex = (index + thumbnails.length) % thumbnails.length;

        // Update active thumbnail
        thumbnails.forEach((thumb, idx) => {
            thumb.classList.toggle('active', idx === currentIndex);
        });

        // Update main preview images
        const currentThumbImg = thumbnails[currentIndex].querySelector('img');
        const nextThumbIdx = (currentIndex + 1) % thumbnails.length;
        const nextThumbImg = thumbnails[nextThumbIdx].querySelector('img');

        if (mainImg1 && currentThumbImg) {
            mainImg1.src = currentThumbImg.src;
        }
        if (mainImg2 && nextThumbImg) {
            mainImg2.src = nextThumbImg.src;
        }

        // Update indicator dots
        if (dots.length) {
            const dotIdx = currentIndex % dots.length;
            dots.forEach((dot, idx) => {
                dot.classList.toggle('active', idx === dotIdx);
            });
        }
    }

    thumbnails.forEach((thumb, index) => {
        thumb.addEventListener('click', () => {
            updateGallery(index);
        });
    });

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            updateGallery(currentIndex - 1);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            updateGallery(currentIndex + 1);
        });
    }

    // 4. Office Locations Tabs Filter (Contact Page)
    const officeTabBtns = document.querySelectorAll('.office-tab-btn');
    const officeCards = document.querySelectorAll('.office-location-card');

    if (officeTabBtns.length && officeCards.length) {
        officeTabBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter') || 'all';

                officeTabBtns.forEach((b) => {
                    b.classList.remove('is-active');
                    b.setAttribute('aria-selected', 'false');
                });
                btn.classList.add('is-active');
                btn.setAttribute('aria-selected', 'true');

                officeCards.forEach((card) => {
                    const categories = (card.getAttribute('data-category') || '').split(' ');
                    if (filter === 'all' || categories.includes(filter)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // 5. Featured Properties Carousel (Homepage)
    const homeCarouselGrid = document.getElementById('homePropertiesCarousel');
    const homePrevBtn = document.getElementById('home-props-prev');
    const homeNextBtn = document.getElementById('home-props-next');
    const homePageInfo = document.getElementById('home-props-page-info');

    if (homeCarouselGrid && homePrevBtn && homeNextBtn && homePageInfo) {
        const cards = Array.from(homeCarouselGrid.querySelectorAll('.property-listing-card'));
        
        function getCardsPerPage() {
            if (window.innerWidth < 768) return 1;
            if (window.innerWidth < 1100) return 2;
            return 3;
        }

        let cardsPerPage = getCardsPerPage();
        let totalPages = Math.max(1, Math.ceil(cards.length / cardsPerPage));
        let currentPage = 1;

        function renderPage(page) {
            cardsPerPage = getCardsPerPage();
            totalPages = Math.max(1, Math.ceil(cards.length / cardsPerPage));
            currentPage = Math.max(1, Math.min(page, totalPages));

            const startIndex = (currentPage - 1) * cardsPerPage;
            const endIndex = startIndex + cardsPerPage;

            cards.forEach((card, idx) => {
                if (idx >= startIndex && idx < endIndex) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });

            homePageInfo.innerHTML = `${String(currentPage).padStart(2, '0')} <span class="pagination-total">of ${String(totalPages).padStart(2, '0')}</span>`;

            homePrevBtn.disabled = (currentPage <= 1);
            homeNextBtn.disabled = (currentPage >= totalPages);

            homePrevBtn.style.opacity = (currentPage <= 1) ? '0.35' : '1';
            homeNextBtn.style.opacity = (currentPage >= totalPages) ? '0.35' : '1';
            homePrevBtn.style.cursor = (currentPage <= 1) ? 'not-allowed' : 'pointer';
            homeNextBtn.style.cursor = (currentPage >= totalPages) ? 'not-allowed' : 'pointer';
        }

        homePrevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                renderPage(currentPage - 1);
            }
        });

        homeNextBtn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                renderPage(currentPage + 1);
            }
        });

        renderPage(1);

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                renderPage(currentPage);
            }, 100);
        });
    }
});
