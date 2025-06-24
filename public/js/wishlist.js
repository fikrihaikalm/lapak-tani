/**
 * Wishlist Management JavaScript
 * Handles all wishlist-related functionality
 */

class WishlistManager {
    static async toggle(productId, button) {
        try {
            const response = await fetch('/konsumen/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId
                })
            });

            const data = await response.json();

            if (data.success) {
                this.updateWishlistButton(button, data.action);
                NotificationManager.showSuccess(data.message);
            } else {
                NotificationManager.showError(data.message);
            }
        } catch (error) {
            console.error('Wishlist Error:', error);
            NotificationManager.showError('Terjadi kesalahan saat mengubah wishlist');
        }
    }

    static updateWishlistButton(button, action) {
        const icon = button.querySelector('svg');
        
        if (action === 'added') {
            icon.classList.remove('text-gray-400');
            icon.classList.add('text-red-500');
            icon.setAttribute('fill', 'currentColor');
            button.setAttribute('title', 'Hapus dari Wishlist');
        } else {
            icon.classList.remove('text-red-500');
            icon.classList.add('text-gray-400');
            icon.setAttribute('fill', 'none');
            button.setAttribute('title', 'Tambah ke Wishlist');
        }
    }

    static async remove(productId) {
        try {
            const response = await fetch('/konsumen/wishlist/remove', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId
                })
            });

            const data = await response.json();

            if (data.success) {
                NotificationManager.showSuccess(data.message);
                // Remove item from wishlist page
                const wishlistItem = document.querySelector(`[data-wishlist-item="${productId}"]`);
                if (wishlistItem) {
                    wishlistItem.remove();
                }
                
                // Update wishlist count if exists
                this.updateWishlistCount();
            } else {
                NotificationManager.showError(data.message);
            }
        } catch (error) {
            console.error('Wishlist Error:', error);
            NotificationManager.showError('Terjadi kesalahan saat menghapus dari wishlist');
        }
    }

    static async updateWishlistCount() {
        try {
            const response = await fetch('/konsumen/wishlist/count');
            const data = await response.json();
            
            const countElements = document.querySelectorAll('.wishlist-count');
            countElements.forEach(element => {
                element.textContent = data.count;
                element.style.display = data.count > 0 ? 'block' : 'none';
            });
        } catch (error) {
            console.error('Failed to update wishlist count:', error);
        }
    }
}

// Make WishlistManager globally available
window.WishlistManager = WishlistManager;
