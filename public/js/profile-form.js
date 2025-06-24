/**
 * Profile Form Management JavaScript
 * Handles avatar preview and form validation
 */

class ProfileFormManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupAvatarPreview();
        this.setupBioCounter();
    }

    setupAvatarPreview() {
        const avatarInput = document.getElementById('avatar');
        if (avatarInput) {
            avatarInput.addEventListener('change', (e) => this.previewAvatar(e.target));
        }
    }

    previewAvatar(input) {
        const preview = document.getElementById('avatar-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    setupBioCounter() {
        const bioTextarea = document.getElementById('bio');
        if (bioTextarea) {
            bioTextarea.addEventListener('input', (e) => this.handleBioInput(e.target));
        }
    }

    handleBioInput(textarea) {
        const maxLength = 500;
        const currentLength = textarea.value.length;
        
        // Enforce max length
        if (currentLength > maxLength) {
            textarea.value = textarea.value.substring(0, maxLength);
        }
        
        // Update counter if exists
        const counter = document.getElementById('bio-counter');
        if (counter) {
            const remaining = maxLength - textarea.value.length;
            counter.textContent = `${remaining} karakter tersisa`;
            
            // Change color based on remaining characters
            if (remaining < 50) {
                counter.className = 'text-sm text-red-500 mt-1';
            } else if (remaining < 100) {
                counter.className = 'text-sm text-yellow-500 mt-1';
            } else {
                counter.className = 'text-sm text-gray-500 mt-1';
            }
        }
    }

    // Static method for global access
    static triggerAvatarUpload() {
        const avatarInput = document.getElementById('avatar');
        if (avatarInput) {
            avatarInput.click();
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new ProfileFormManager();
});

// Make functions globally available for onclick handlers
window.previewAvatar = function(input) {
    const manager = new ProfileFormManager();
    manager.previewAvatar(input);
};

window.triggerAvatarUpload = function() {
    ProfileFormManager.triggerAvatarUpload();
};

// Make ProfileFormManager globally available
window.ProfileFormManager = ProfileFormManager;
