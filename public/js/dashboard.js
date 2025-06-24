/**
 * Dashboard Management JavaScript
 * Handles dashboard sidebar and mobile menu functionality
 */

class DashboardManager {
    constructor() {
        this.mobileMenuButton = document.getElementById('mobile-menu-button');
        this.sidebar = document.getElementById('sidebar');
        this.overlay = document.getElementById('mobile-menu-overlay');
        this.closeSidebar = document.getElementById('close-sidebar');
        
        this.init();
    }

    init() {
        this.setupEventListeners();
    }

    openSidebar() {
        if (this.sidebar) {
            this.sidebar.classList.remove('-translate-x-full');
        }
        if (this.overlay) {
            this.overlay.classList.remove('hidden');
        }
    }

    closeSidebarFunc() {
        if (this.sidebar) {
            this.sidebar.classList.add('-translate-x-full');
        }
        if (this.overlay) {
            this.overlay.classList.add('hidden');
        }
    }

    setupEventListeners() {
        // Mobile menu button
        this.mobileMenuButton?.addEventListener('click', () => this.openSidebar());
        
        // Close sidebar button
        this.closeSidebar?.addEventListener('click', () => this.closeSidebarFunc());
        
        // Overlay click
        this.overlay?.addEventListener('click', () => this.closeSidebarFunc());

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (event) => {
            if (window.innerWidth < 1024) {
                if (this.sidebar && this.mobileMenuButton && 
                    !this.sidebar.contains(event.target) && 
                    !this.mobileMenuButton.contains(event.target)) {
                    this.closeSidebarFunc();
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                this.closeSidebarFunc();
            }
        });
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new DashboardManager();
});

// Make DashboardManager globally available
window.DashboardManager = DashboardManager;
