/**
 * Checkout JavaScript
 * Handles checkout form submission and WhatsApp integration
 */

class CheckoutManager {
    constructor() {
        this.init();
    }

    init() {
        const checkoutForm = document.getElementById('checkout-form');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', (e) => this.handleSubmit(e));
        }
    }

    async handleSubmit(e) {
        e.preventDefault();
        
        const btn = document.getElementById('checkout-btn');
        const text = document.getElementById('checkout-text');
        const loading = document.getElementById('checkout-loading');
        
        // Show loading
        btn.disabled = true;
        text.classList.add('hidden');
        loading.classList.remove('hidden');
        
        const formData = new FormData(e.target);
        
        try {
            const response = await fetch('/konsumen/checkout/process', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                this.showSuccessModal(data.whatsapp_messages);
            } else {
                NotificationManager.showError(data.message || 'Terjadi kesalahan');
            }
        } catch (error) {
            console.error('Checkout Error:', error);
            NotificationManager.showError('Terjadi kesalahan sistem');
        } finally {
            // Hide loading
            btn.disabled = false;
            text.classList.remove('hidden');
            loading.classList.add('hidden');
        }
    }

    showSuccessModal(whatsappMessages) {
        const modal = document.getElementById('success-modal');
        const linksContainer = document.getElementById('whatsapp-links');
        
        if (!modal || !linksContainer) return;
        
        linksContainer.innerHTML = '';
        
        whatsappMessages.forEach((msg) => {
            const linkDiv = document.createElement('div');
            linkDiv.innerHTML = `
                <a href="${msg.url}" 
                   target="_blank"
                   class="block w-full bg-hijau-600 text-white py-3 px-4 rounded-lg hover:bg-hijau-700 transition duration-200 text-center">
                    💬 Chat dengan ${msg.petani_name}
                </a>
            `;
            linksContainer.appendChild(linkDiv);
        });
        
        modal.classList.remove('hidden');
    }

    static closeModal() {
        const modal = document.getElementById('success-modal');
        if (modal) {
            modal.classList.add('hidden');
            window.location.href = '/konsumen/orders';
        }
    }
}

// Initialize checkout when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new CheckoutManager();
});

// Make closeModal globally available for onclick attributes
window.closeModal = CheckoutManager.closeModal;
