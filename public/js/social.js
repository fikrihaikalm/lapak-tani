/**
 * Social Features JavaScript
 * Handles social interactions like follow, like posts, tabs
 */

class SocialManager {
    static async toggleFollow(userId, button) {
        if (!window.isAuthenticated) {
            window.location.href = '/login';
            return;
        }

        try {
            const response = await fetch('/follow', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ user_id: userId })
            });

            const data = await response.json();

            if (data.success) {
                button.textContent = data.action === 'followed' ? 'Unfollow' : 'Follow';
                button.classList.toggle('bg-hijau-600', data.action === 'followed');
                button.classList.toggle('text-white', data.action === 'followed');
                button.classList.toggle('bg-gray-200', data.action !== 'followed');
                button.classList.toggle('text-gray-700', data.action !== 'followed');
                
                // Update follower count if element exists
                const followerCount = document.querySelector('.follower-count');
                if (followerCount && data.follower_count !== undefined) {
                    followerCount.textContent = data.follower_count;
                }
                
                NotificationManager.showSuccess(data.message);
            } else {
                NotificationManager.showError(data.message);
            }
        } catch (error) {
            console.error('Follow Error:', error);
            NotificationManager.showError('Terjadi kesalahan saat mengikuti pengguna');
        }
    }

    static async likePost(postId, button) {
        if (!window.isAuthenticated) {
            window.location.href = '/login';
            return;
        }

        try {
            const response = await fetch('/posts/like', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ post_id: postId })
            });

            const data = await response.json();

            if (data.success) {
                const icon = button.querySelector('svg');
                const countSpan = button.querySelector('.likes-count');
                
                if (data.action === 'liked') {
                    icon.classList.add('text-red-500');
                    icon.setAttribute('fill', 'currentColor');
                } else {
                    icon.classList.remove('text-red-500');
                    icon.setAttribute('fill', 'none');
                }
                
                if (countSpan) {
                    countSpan.textContent = data.likes_count;
                }
            } else {
                NotificationManager.showError(data.message);
            }
        } catch (error) {
            console.error('Like Error:', error);
            NotificationManager.showError('Terjadi kesalahan saat menyukai post');
        }
    }

    static switchTab(tabName, button) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Remove active class from all buttons
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Show selected tab and mark button as active
        const targetTab = document.getElementById(tabName + '-tab');
        if (targetTab) {
            targetTab.classList.remove('hidden');
        }
        button.classList.add('active');
    }
}

// Make SocialManager globally available
window.SocialManager = SocialManager;
