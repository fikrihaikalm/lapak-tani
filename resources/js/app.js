import './bootstrap';

// AJAX Setup
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Form submission handler
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submissions with AJAX
    const forms = document.querySelectorAll('form[data-ajax="true"]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Memproses...';
            
            // Clear previous errors
            clearErrors();
            
            fetch(this.action, {
                method: this.method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message, 'success');
                    if (data.redirect) {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1500);
                    }
                } else {
                    showAlert(data.message, 'error');
                    if (data.errors) {
                        showErrors(data.errors);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
            })
            .finally(() => {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    });
    
    // Handle delete buttons
    const deleteButtons = document.querySelectorAll('[data-delete]');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const url = this.getAttribute('data-delete');
                
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert(data.message, 'success');
                        // Remove the row or reload page
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                });
            }
        });
    });
});

// Alert function
function showAlert(message, type = 'info') {
    const alertContainer = document.getElementById('alert-container') || createAlertContainer();
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm`;
    
    if (type === 'success') {
        alertDiv.className += ' bg-green-100 border border-green-400 text-green-700';
    } else if (type === 'error') {
        alertDiv.className += ' bg-red-100 border border-red-400 text-red-700';
    } else {
        alertDiv.className += ' bg-blue-100 border border-blue-400 text-blue-700';
    }
    
    alertDiv.innerHTML = `
        <div class="flex items-center justify-between">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-lg font-bold">&times;</button>
        </div>
    `;
    
    alertContainer.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

function createAlertContainer() {
    const container = document.createElement('div');
    container.id = 'alert-container';
    document.body.appendChild(container);
    return container;
}

function clearErrors() {
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach(el => el.remove());
    
    const inputElements = document.querySelectorAll('.border-red-500');
    inputElements.forEach(el => {
        el.classList.remove('border-red-500');
        el.classList.add('border-gray-300');
    });
}

function showErrors(errors) {
    Object.keys(errors).forEach(field => {
        const input = document.querySelector(`[name="${field}"]`);
        if (input) {
            input.classList.remove('border-gray-300');
            input.classList.add('border-red-500');
            
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message text-red-500 text-sm mt-1';
            errorDiv.textContent = errors[field][0];
            
            input.parentNode.appendChild(errorDiv);
        }
    });
}