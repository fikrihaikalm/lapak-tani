/**
 * Cart Management JavaScript
 * Handles all cart-related functionality
 */

class CartManager {
    static async addToCart(productId, quantity = 1) {
        try {
            const response = await fetch('/konsumen/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            });

            const data = await response.json();

            if (data.success) {
                this.updateCartCount(data.cart_count);
                NotificationManager.showSuccess(data.message);
            } else {
                NotificationManager.showError(data.message);
            }
        } catch (error) {
            console.error('Cart Error:', error);
            NotificationManager.showError('Terjadi kesalahan saat menambahkan ke keranjang');
        }
    }

    static async removeFromCart(cartItemId) {
        try {
            const response = await fetch('/konsumen/cart/remove', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    cart_item_id: cartItemId
                })
            });

            const data = await response.json();

            if (data.success) {
                this.updateCartCount(data.cart_count);
                NotificationManager.showSuccess(data.message);
                // Remove item from DOM
                const cartItem = document.querySelector(`[data-cart-item="${cartItemId}"]`);
                if (cartItem) {
                    cartItem.remove();
                }
            } else {
                NotificationManager.showError(data.message);
            }
        } catch (error) {
            console.error('Cart Error:', error);
            NotificationManager.showError('Terjadi kesalahan saat menghapus dari keranjang');
        }
    }

    static async updateQuantity(cartItemId, quantity) {
        try {
            const response = await fetch('/konsumen/cart/update', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    cart_item_id: cartItemId,
                    quantity: quantity
                })
            });

            const data = await response.json();

            if (data.success) {
                this.updateCartCount(data.cart_count);
                // Update total price in cart page
                this.updateCartTotals(data.cart_total);
            } else {
                NotificationManager.showError(data.message);
            }
        } catch (error) {
            console.error('Cart Error:', error);
            NotificationManager.showError('Terjadi kesalahan saat mengupdate keranjang');
        }
    }

    static updateCartCount(count) {
        const cartCountElements = document.querySelectorAll('#cart-count, .cart-count');
        cartCountElements.forEach(element => {
            element.textContent = count;
            element.style.display = count > 0 ? 'block' : 'none';
        });
    }

    static updateCartTotals(total) {
        const totalElements = document.querySelectorAll('.cart-total');
        totalElements.forEach(element => {
            element.textContent = total;
        });
    }

    static async loadCartCount() {
        try {
            const response = await fetch('/konsumen/keranjang/count');
            const data = await response.json();
            this.updateCartCount(data.count);
        } catch (error) {
            console.error('Failed to load cart count:', error);
        }
    }
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    if (typeof window.isAuthenticated !== 'undefined' && window.isAuthenticated && window.userType === 'konsumen') {
        CartManager.loadCartCount();
    }
});

// Make CartManager globally available
window.CartManager = CartManager;
