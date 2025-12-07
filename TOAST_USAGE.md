# Toast Notification System - Usage Guide

## Overview
A beautiful, modern toast notification system that appears from the top-right corner with smooth animations.

## Features
- ✅ 4 types: Success, Error, Warning, Info
- ✅ Auto-dismiss with progress bar
- ✅ Manual close button
- ✅ Slide-in/out animations
- ✅ Responsive design (mobile-friendly)
- ✅ Automatic Laravel session flash message handling
- ✅ Global JavaScript API

## Automatic Usage (Laravel Session Flash)

The toast system automatically displays Laravel session flash messages:

### In Controllers:
```php
// Success notification
return redirect()->route('dashboard')
    ->with('success', 'Investment approved successfully!');

// Error notification
return redirect()->route('dashboard')
    ->with('error', 'An error occurred. Please try again.');

// Warning notification
return redirect()->route('dashboard')
    ->with('warning', 'This action cannot be undone.');

// Info notification
return redirect()->route('dashboard')
    ->with('info', 'Your profile has been updated.');
```

## Manual Usage (JavaScript)

You can trigger toasts manually from JavaScript:

### Basic Usage:
```javascript
// Success toast
Toast.success('Investment approved successfully!');

// Error toast
Toast.error('Failed to process payment.');

// Warning toast
Toast.warning('Please verify your information.');

// Info toast
Toast.info('New features available!');
```

### With Custom Titles:
```javascript
Toast.success('Investment approved successfully!', 'Great News!');
Toast.error('Payment failed', 'Oops!');
Toast.warning('Please check your email', 'Important');
Toast.info('Check out our new features', 'Update Available');
```

### With Custom Duration:
```javascript
// Show for 10 seconds (default is 5 seconds)
Toast.show('Custom message', 'success', 'Custom Title', 10000);
```

## Examples

### In Blade Templates:
```html
<button onclick="Toast.success('Profile updated successfully!')">
    Update Profile
</button>

<button onclick="Toast.error('Invalid credentials')">
    Test Error
</button>
```

### In JavaScript Files:
```javascript
// After AJAX success
fetch('/api/endpoint')
    .then(response => response.json())
    .then(data => {
        Toast.success('Data loaded successfully!');
    })
    .catch(error => {
        Toast.error('Failed to load data');
    });

// Form submission
document.getElementById('myForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Process form...

    Toast.success('Form submitted successfully!');
});
```

## Toast Types

| Type    | Icon                    | Color  | Use Case                    |
|---------|-------------------------|--------|-----------------------------|
| Success | ✓ Check Circle         | Green  | Successful operations       |
| Error   | ✗ X Circle             | Red    | Errors and failures         |
| Warning | ⚠ Triangle             | Yellow | Warnings and cautions       |
| Info    | ℹ Info Circle          | Blue   | Information and updates     |

## Configuration

### Change Default Duration:
```javascript
// Set default duration to 3 seconds
Toast.defaultDuration = 3000;
```

### Close Toast Programmatically:
```javascript
// Get toast element
const toast = document.querySelector('.toast');

// Close it
Toast.close(toast);
```

## Implementation Examples

### Investment Approval (Already Implemented)
```php
// AdminController.php
public function approveInvestment(Investment $investment)
{
    // ... approval logic ...

    return redirect()->route('admin.dashboard')
        ->with('success', 'Investment of ₹' . number_format($investment->investment_amount, 2) . ' has been approved!');
}
```

### Form Validation Errors
```php
// Automatically shows errors
return back()
    ->with('error', 'Please fill all required fields.');
```

### AJAX Response
```javascript
// In your JavaScript
axios.post('/api/submit', formData)
    .then(response => {
        Toast.success(response.data.message);
    })
    .catch(error => {
        Toast.error(error.response.data.message || 'An error occurred');
    });
```

## Files Modified

1. `resources/views/include/toast.blade.php` - Toast component
2. `resources/views/layouts/master.blade.php` - Include toast in dashboard layout
3. `resources/views/layouts/master-public.blade.php` - Include toast in public layout
4. `app/Http/Controllers/AdminController.php` - Updated to use toast notifications
5. `app/Http/Controllers/InvestmentController.php` - Updated error handling

## Styling

The toast system uses CSS variables from your theme:
- `--color-bg-card` - Toast background
- `--color-border-light` - Toast border
- `--color-text-primary` - Toast title color
- `--color-text-secondary` - Toast message color

Toasts automatically adapt to your dark/light theme!

## Browser Support
- Chrome, Firefox, Safari, Edge (latest versions)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Notes
- Toasts auto-dismiss after 5 seconds by default
- Users can manually close toasts anytime
- Multiple toasts stack vertically
- Mobile-responsive (adjusts position on small screens)
