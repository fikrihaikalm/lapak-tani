/**
 * Posts Management JavaScript
 * Handles post creation, image preview, and interactions
 */

class PostManager {
    static previewPostImages(input) {
        const preview = document.getElementById('post-image-preview');
        const container = document.getElementById('preview-container');

        if (!preview || !container) return;

        // Clear previous previews
        container.innerHTML = '';

        if (input.files && input.files.length > 0) {
            // Limit to 5 images
            const files = Array.from(input.files).slice(0, 5);

            files.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-20 object-cover rounded border border-gray-300">
                        <button type="button" onclick="PostManager.removePostPreview(this, ${index})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                            ×
                        </button>
                    `;
                    container.appendChild(div);
                }

                reader.readAsDataURL(file);
            });

            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    }

    static removePostPreview(button, index) {
        const input = document.getElementById('images');
        const preview = document.getElementById('post-image-preview');
        const container = document.getElementById('preview-container');

        if (!input || !preview || !container) return;

        // Remove the preview element
        button.parentElement.remove();

        // If no more previews, hide the container
        if (container.children.length === 0) {
            preview.classList.add('hidden');
            input.value = '';
        }
    }

    static removePostPreviews() {
        const input = document.getElementById('images');
        const preview = document.getElementById('post-image-preview');
        const container = document.getElementById('preview-container');

        if (!input || !preview || !container) return;

        input.value = '';
        container.innerHTML = '';
        preview.classList.add('hidden');
    }

    static async submitPost(form) {
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        
        try {
            submitButton.disabled = true;
            submitButton.textContent = 'Memposting...';

            const formData = new FormData(form);
            
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                NotificationManager.showSuccess(data.message);
                form.reset();
                this.removePostPreviews();
                
                // Reload page to show new post
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                NotificationManager.showError(data.message || 'Terjadi kesalahan saat memposting');
            }
        } catch (error) {
            console.error('Post Error:', error);
            NotificationManager.showError('Terjadi kesalahan saat memposting');
        } finally {
            submitButton.disabled = false;
            submitButton.textContent = originalText;
        }
    }
}

// Initialize post form handling when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const postForm = document.getElementById('post-form');
    if (postForm) {
        postForm.addEventListener('submit', function(e) {
            e.preventDefault();
            PostManager.submitPost(this);
        });
    }
});

// Make PostManager globally available
window.PostManager = PostManager;

// Legacy support for existing function calls
window.previewPostImages = PostManager.previewPostImages;
window.removePostPreview = PostManager.removePostPreview;
window.removePostPreviews = PostManager.removePostPreviews;
