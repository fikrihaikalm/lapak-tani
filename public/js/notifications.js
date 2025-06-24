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
            success: `<i class="bi bi-check-circle-fill text-green-400 text-lg"></i>`,
            error: `<i class="bi bi-x-circle-fill text-red-400 text-lg"></i>`,
            warning: `<i class="bi bi-exclamation-triangle-fill text-yellow-400 text-lg"></i>`,
            info: `<i class="bi bi-info-circle-fill text-blue-400 text-lg"></i>`
        };

        return icons[type] || icons.info;
    }
}

// Make NotificationManager globally available
window.NotificationManager = NotificationManager;

// Legacy support for existing showSuccess/showError functions
window.showSuccess = (message) => NotificationManager.showSuccess(message);
window.showError = (message) => NotificationManager.showError(message);
