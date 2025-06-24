/**
 * FAQ JavaScript
 * Handles FAQ search and toggle functionality
 */

class FAQManager {
    constructor() {
        this.init();
    }

    init() {
        this.initSearch();
        this.initToggle();
    }

    initSearch() {
        const searchInput = document.getElementById('faq-search');
        if (!searchInput) return;

        searchInput.addEventListener('input', (e) => {
            this.searchFAQ(e.target.value.toLowerCase());
        });
    }

    initToggle() {
        // FAQ toggle functionality is handled by toggleFAQ function
        // which is called from onclick attributes in the view
    }

    searchFAQ(searchTerm) {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question h3')?.textContent.toLowerCase() || '';
            const answer = item.querySelector('.faq-answer p')?.textContent.toLowerCase() || '';
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    static toggleFAQ(button) {
        const answer = button.nextElementSibling;
        const icon = button.querySelector('svg');
        
        if (answer && icon) {
            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                answer.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    }
}

// Initialize FAQ when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new FAQManager();
});

// Make toggleFAQ globally available for onclick attributes
window.toggleFAQ = FAQManager.toggleFAQ;
