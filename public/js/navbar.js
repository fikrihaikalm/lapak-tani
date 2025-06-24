/**
 * Navbar JavaScript
 * Handles mobile navbar and search toggle functionality
 */

class NavbarManager {
    constructor() {
        this.init();
    }

    init() {
        this.initMobileMenu();
        this.initSearchToggle();
    }

    initMobileMenu() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }
    }

    initSearchToggle() {
        const searchToggle = document.getElementById('search-toggle');
        const searchBox = document.getElementById('search-box');
        const searchInput = document.getElementById('global-search');

        if (searchToggle && searchBox) {
            searchToggle.addEventListener('click', () => {
                searchBox.classList.toggle('hidden');
                if (!searchBox.classList.contains('hidden')) {
                    searchInput?.focus();
                }
            });

            // Close search when clicking outside
            document.addEventListener('click', (e) => {
                if (!searchToggle.contains(e.target) && !searchBox.contains(e.target)) {
                    searchBox.classList.add('hidden');
                }
            });

            // Close search on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    searchBox.classList.add('hidden');
                }
            });
        }
    }
}

// Initialize navbar when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new NavbarManager();
});
