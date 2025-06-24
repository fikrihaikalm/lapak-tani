/**
 * Global Search JavaScript
 * Handles global search functionality
 */

class SearchManager {
    constructor() {
        this.searchTimeout = null;
        this.searchInput = document.getElementById('global-search');
        this.searchResults = document.getElementById('search-results');
        this.searchLoading = document.getElementById('search-loading');
        this.searchContent = document.getElementById('search-content');
        
        this.init();
    }

    init() {
        if (!this.searchInput) return;

        this.searchInput.addEventListener('input', (e) => {
            this.handleSearchInput(e.target.value.trim());
        });

        // Hide search results when clicking outside
        document.addEventListener('click', (e) => {
            if (!this.searchInput.contains(e.target) && !this.searchResults.contains(e.target)) {
                this.hideResults();
            }
        });
    }

    handleSearchInput(query) {
        if (query.length < 2) {
            this.hideResults();
            return;
        }

        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(() => {
            this.performSearch(query);
        }, 300);
    }

    async performSearch(query) {
        this.showLoading();

        try {
            const response = await fetch('/search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ query: query })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            this.hideLoading();

            if (data.error) {
                this.showError(data.error);
                NotificationManager.showError(data.error);
            } else {
                this.displayResults(data);
            }
        } catch (error) {
            console.error('Search error:', error);
            this.hideLoading();
            this.showError('Terjadi kesalahan saat mencari');
            NotificationManager.showError('Terjadi kesalahan saat mencari: ' + error.message);
        }
    }

    showLoading() {
        this.searchLoading.classList.remove('hidden');
        this.searchContent.innerHTML = '';
        this.searchResults.classList.remove('hidden');
    }

    hideLoading() {
        this.searchLoading.classList.add('hidden');
    }

    hideResults() {
        this.searchResults.classList.add('hidden');
    }

    showError(message) {
        this.searchContent.innerHTML = `<div class="p-4 text-center text-red-500">${message}</div>`;
    }

    displayResults(data) {
        let html = '';

        // Products
        if (data.products && data.products.length > 0) {
            html += '<div class="p-3 border-b border-gray-200"><h4 class="font-semibold text-gray-900 mb-2">Produk</h4>';
            data.products.forEach(product => {
                html += `
                    <a href="/produk/${product.slug}" class="flex items-center p-2 hover:bg-gray-50 rounded">
                        <img src="${product.image_url}" alt="${product.name}" class="w-10 h-10 rounded object-cover mr-3">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">${product.name}</p>
                            <p class="text-sm text-gray-500">${product.formatted_price} • ${product.user.name}</p>
                        </div>
                    </a>
                `;
            });
            html += '</div>';
        }

        // Articles
        if (data.articles && data.articles.length > 0) {
            html += '<div class="p-3 border-b border-gray-200"><h4 class="font-semibold text-gray-900 mb-2">Artikel</h4>';
            data.articles.forEach(article => {
                html += `
                    <a href="/edukasi/${article.slug}" class="flex items-center p-2 hover:bg-gray-50 rounded">
                        <div class="w-10 h-10 bg-purple-100 rounded flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">${article.title}</p>
                            <p class="text-sm text-gray-500">Oleh ${article.user.name}</p>
                        </div>
                    </a>
                `;
            });
            html += '</div>';
        }

        // Farmers
        if (data.farmers && data.farmers.length > 0) {
            html += '<div class="p-3"><h4 class="font-semibold text-gray-900 mb-2">Petani</h4>';
            data.farmers.forEach(farmer => {
                html += `
                    <a href="/profile/${farmer.slug}" class="flex items-center p-2 hover:bg-gray-50 rounded">
                        <img src="${farmer.avatar_url}" alt="${farmer.name}" class="w-10 h-10 rounded-full mr-3">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">${farmer.name}</p>
                            <p class="text-sm text-gray-500">${farmer.farm_name || 'Petani'}</p>
                        </div>
                    </a>
                `;
            });
            html += '</div>';
        }

        if (html === '') {
            html = '<div class="p-4 text-center text-gray-500">Tidak ada hasil ditemukan</div>';
        }

        this.searchContent.innerHTML = html;
    }
}

// Initialize search when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new SearchManager();
});
