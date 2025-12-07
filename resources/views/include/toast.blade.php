<!-- Toast Container -->
<div id="toastContainer" class="toast-container"></div>

<style>
/* Toast Container */
.toast-container {
    position: fixed;
    top: 100px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 12px;
    max-width: 400px;
}

/* Toast */
.toast {
    background: var(--color-bg-card);
    border: 1px solid var(--color-border-light);
    border-radius: 12px;
    padding: 16px 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15), 0 4px 12px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: flex-start;
    gap: 12px;
    min-width: 320px;
    max-width: 400px;
    animation: slideInRight 0.3s ease-out;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.toast::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
}

.toast.success::before {
    background: linear-gradient(180deg, #28a745, #20c997);
}

.toast.error::before {
    background: linear-gradient(180deg, #dc3545, #e83e8c);
}

.toast.warning::before {
    background: linear-gradient(180deg, #ffc107, #fd7e14);
}

.toast.info::before {
    background: linear-gradient(180deg, #17a2b8, #007bff);
}

/* Toast Icon */
.toast-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.toast.success .toast-icon {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.15), rgba(32, 201, 151, 0.15));
    color: #28a745;
}

.toast.error .toast-icon {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.15), rgba(232, 62, 140, 0.15));
    color: #dc3545;
}

.toast.warning .toast-icon {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(253, 126, 20, 0.15));
    color: #ffc107;
}

.toast.info .toast-icon {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.15), rgba(0, 123, 255, 0.15));
    color: #17a2b8;
}

/* Toast Content */
.toast-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.toast-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--color-text-primary);
    margin: 0;
}

.toast-message {
    font-size: 0.875rem;
    color: var(--color-text-secondary);
    margin: 0;
    line-height: 1.4;
}

/* Toast Close Button */
.toast-close {
    width: 24px;
    height: 24px;
    border: none;
    background: transparent;
    color: var(--color-text-muted);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    transition: all 0.2s ease;
    flex-shrink: 0;
}

.toast-close:hover {
    background: var(--color-bg-secondary);
    color: var(--color-text-primary);
}

/* Toast Progress Bar */
.toast-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    background: linear-gradient(90deg,
        rgba(102, 126, 234, 0.3),
        rgba(118, 75, 162, 0.3)
    );
    animation: toastProgress 5s linear forwards;
}

.toast.success .toast-progress {
    background: linear-gradient(90deg,
        rgba(40, 167, 69, 0.4),
        rgba(32, 201, 151, 0.4)
    );
}

.toast.error .toast-progress {
    background: linear-gradient(90deg,
        rgba(220, 53, 69, 0.4),
        rgba(232, 62, 140, 0.4)
    );
}

.toast.warning .toast-progress {
    background: linear-gradient(90deg,
        rgba(255, 193, 7, 0.4),
        rgba(253, 126, 20, 0.4)
    );
}

.toast.info .toast-progress {
    background: linear-gradient(90deg,
        rgba(23, 162, 184, 0.4),
        rgba(0, 123, 255, 0.4)
    );
}

/* Animations */
@keyframes slideInRight {
    from {
        transform: translateX(120%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(120%);
        opacity: 0;
    }
}

@keyframes toastProgress {
    from {
        width: 100%;
    }
    to {
        width: 0%;
    }
}

.toast.removing {
    animation: slideOutRight 0.3s ease-in forwards;
}

/* Responsive */
@media (max-width: 768px) {
    .toast-container {
        top: 80px;
        right: 12px;
        left: 12px;
        max-width: none;
    }

    .toast {
        min-width: auto;
        max-width: none;
    }
}

@media (max-width: 576px) {
    .toast {
        padding: 12px 16px;
    }

    .toast-icon {
        width: 36px;
        height: 36px;
        font-size: 1rem;
    }

    .toast-title {
        font-size: 0.9rem;
    }

    .toast-message {
        font-size: 0.8rem;
    }
}
</style>

<script>
// Toast Notification System
window.Toast = {
    // Configuration
    defaultDuration: 5000,

    // Show toast notification
    show(message, type = 'info', title = null, duration = null) {
        const container = document.getElementById('toastContainer');
        if (!container) return;

        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;

        // Set default titles if not provided
        if (!title) {
            const titles = {
                success: 'Success',
                error: 'Error',
                warning: 'Warning',
                info: 'Info'
            };
            title = titles[type] || 'Notification';
        }

        // Get icon based on type
        const icons = {
            success: '<i class="bi bi-check-circle-fill"></i>',
            error: '<i class="bi bi-x-circle-fill"></i>',
            warning: '<i class="bi bi-exclamation-triangle-fill"></i>',
            info: '<i class="bi bi-info-circle-fill"></i>'
        };

        // Build toast HTML
        toast.innerHTML = `
            <div class="toast-icon">${icons[type] || icons.info}</div>
            <div class="toast-content">
                <p class="toast-title">${title}</p>
                <p class="toast-message">${message}</p>
            </div>
            <button class="toast-close" onclick="Toast.close(this.parentElement)">
                <i class="bi bi-x-lg"></i>
            </button>
            <div class="toast-progress"></div>
        `;

        // Add to container
        container.appendChild(toast);

        // Auto remove after duration
        const timeoutDuration = duration || this.defaultDuration;
        setTimeout(() => {
            this.close(toast);
        }, timeoutDuration);
    },

    // Close toast
    close(toast) {
        if (!toast) return;

        toast.classList.add('removing');
        setTimeout(() => {
            toast.remove();
        }, 300);
    },

    // Shorthand methods
    success(message, title = null) {
        this.show(message, 'success', title);
    },

    error(message, title = null) {
        this.show(message, 'error', title);
    },

    warning(message, title = null) {
        this.show(message, 'warning', title);
    },

    info(message, title = null) {
        this.show(message, 'info', title);
    }
};

// Handle Laravel session flash messages
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        Toast.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        Toast.error("{{ session('error') }}");
    @endif

    @if(session('warning'))
        Toast.warning("{{ session('warning') }}");
    @endif

    @if(session('info'))
        Toast.info("{{ session('info') }}");
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            Toast.error("{{ $error }}");
        @endforeach
    @endif
});
</script>
