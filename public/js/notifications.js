/**
 * Notification Management JavaScript
 * Handles all notification/alert functionality
 */

class NotificationManager {
    static showSuccess(message, duration = 3000) {
        this.createNotification(message, 'success', duration);
    }

    static showError(message, duration = 5000) {
        this.createNotification(message, 'error', duration);
    }

    static showInfo(message, duration = 3000) {
        this.createNotification(message, 'info', duration);
    }

    static showWarning(message, duration = 4000) {
        this.createNotification(message, 'warning', duration);
    }

    static createNotification(message, type, duration) {
        // Remove existing notifications of the same type
        const existingNotifications = document.querySelectorAll(`.notification-${type}`);
        existingNotifications.forEach(notification => notification.remove());

        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification-${type} fixed top-4 right-4 z-50 max-w-sm w-full shadow-lg rounded-lg pointer-events-auto`;
        
        // Set styles based on type
        const styles = this.getNotificationStyles(type);
        notification.className += ` ${styles.bg} ${styles.border} ${styles.text}`;

        // Create notification content
        notification.innerHTML = `
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        ${this.getIcon(type)}
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <p class="text-sm font-medium">
                            ${message}
                        </p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button class="inline-flex text-gray-400 hover:text-gray-600 focus:outline-none" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;

        // Add to DOM
        document.body.appendChild(notification);

        // Add entrance animation
        notification.style.transform = 'translateX(100%)';
        notification.style.transition = 'transform 0.3s ease-in-out';
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);

        // Auto remove after duration
        setTimeout(() => {
            this.removeNotification(notification);
        }, duration);
    }

    static removeNotification(notification) {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }

    static getNotificationStyles(type) {
        const styles = {
            success: {
                bg: 'bg-green-50',
                border: 'border border-green-200',
                text: 'text-green-800'
            },
            error: {
                bg: 'bg-red-50',
                border: 'border border-red-200',
                text: 'text-red-800'
            },
            warning: {
                bg: 'bg-yellow-50',
                border: 'border border-yellow-200',
                text: 'text-yellow-800'
            },
            info: {
                bg: 'bg-blue-50',
                border: 'border border-blue-200',
                text: 'text-blue-800'
            }
        };

        return styles[type] || styles.info;
    }

    static getIcon(type) {
        const icons = {
            success: `<svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>`,
            error: `<svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>`,
            warning: `<svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>`,
            info: `<svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>`
        };

        return icons[type] || icons.info;
    }
}

// Make NotificationManager globally available
window.NotificationManager = NotificationManager;

// Legacy support for existing showSuccess/showError functions
window.showSuccess = (message) => NotificationManager.showSuccess(message);
window.showError = (message) => NotificationManager.showError(message);
