<!-- Notification Container -->
<div id="notification-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

<script>
class NotificationSystem {
    constructor() {
        this.container = document.getElementById('notification-container');
        this.notifications = [];
    }

    show(type, message, duration = 5000) {
        const id = Date.now() + Math.random();
        const notification = this.createNotification(id, type, message);
        
        this.container.appendChild(notification);
        this.notifications.push({ id, element: notification });

        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full', 'opacity-0');
        }, 100);

        // Auto remove
        if (duration > 0) {
            setTimeout(() => {
                this.remove(id);
            }, duration);
        }

        return id;
    }

    createNotification(id, type, message) {
        const notification = document.createElement('div');
        notification.className = `transform translate-x-full opacity-0 transition-all duration-300 ease-in-out max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden`;
        notification.setAttribute('data-notification-id', id);

        const colors = {
            success: {
                bg: 'bg-green-50',
                border: 'border-green-200',
                icon: 'text-green-400',
                text: 'text-green-800',
                iconPath: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
            },
            error: {
                bg: 'bg-red-50',
                border: 'border-red-200',
                icon: 'text-red-400',
                text: 'text-red-800',
                iconPath: 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'
            },
            warning: {
                bg: 'bg-yellow-50',
                border: 'border-yellow-200',
                icon: 'text-yellow-400',
                text: 'text-yellow-800',
                iconPath: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z'
            },
            info: {
                bg: 'bg-blue-50',
                border: 'border-blue-200',
                icon: 'text-blue-400',
                text: 'text-blue-800',
                iconPath: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
            }
        };

        const config = colors[type] || colors.info;

        notification.innerHTML = `
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 ${config.icon}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${config.iconPath}"/>
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium ${config.text}">${message}</p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button onclick="notifications.remove(${id})" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-hijau-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;

        return notification;
    }

    remove(id) {
        const notification = this.notifications.find(n => n.id === id);
        if (notification) {
            // Animate out
            notification.element.classList.add('translate-x-full', 'opacity-0');
            
            setTimeout(() => {
                if (notification.element.parentNode) {
                    notification.element.parentNode.removeChild(notification.element);
                }
                this.notifications = this.notifications.filter(n => n.id !== id);
            }, 300);
        }
    }

    success(message, duration = 5000) {
        return this.show('success', message, duration);
    }

    error(message, duration = 7000) {
        return this.show('error', message, duration);
    }

    warning(message, duration = 6000) {
        return this.show('warning', message, duration);
    }

    info(message, duration = 5000) {
        return this.show('info', message, duration);
    }

    clear() {
        this.notifications.forEach(notification => {
            this.remove(notification.id);
        });
    }
}

// Initialize global notification system
const notifications = new NotificationSystem();

// Handle Laravel flash messages
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        notifications.success('{{ session('success') }}');
    @endif

    @if(session('error'))
        notifications.error('{{ session('error') }}');
    @endif

    @if(session('warning'))
        notifications.warning('{{ session('warning') }}');
    @endif

    @if(session('info'))
        notifications.info('{{ session('info') }}');
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            notifications.error('{{ $error }}');
        @endforeach
    @endif
});

// Global helper functions
window.showSuccess = function(message) {
    return notifications.success(message);
};

window.showError = function(message) {
    return notifications.error(message);
};

window.showWarning = function(message) {
    return notifications.warning(message);
};

window.showInfo = function(message) {
    return notifications.info(message);
};
</script>

{{-- Notification animations moved to resources/css/app.css --}}
