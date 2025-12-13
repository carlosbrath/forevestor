 {{-- Top Bar --}}
<div class="top-bar">
    <div class="welcome-text">
        <h2>Dashboard</h2>
        <p class="welcome-message">Welcome back, {{ strtoupper(substr(auth()->user()->full_name, 0, 2)) }}! Here's your portfolio overview.</p>
    </div>
    <div class="user-actions">
        {{-- <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search..." class="search-input">
        </div> --}}
        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-top-bar">
            <i class="bi bi-house-door"></i>
            <span class="btn-text">Visit Home</span>
        </a>
        <a href="{{ route('investments.create') }}" class="invest-now-btn">
            <span class="invest-btn-border"></span>
            <span class="invest-btn-text">
                <i class="bi bi-lightning-charge-fill"></i>
                <span class="btn-text">Invest Now</span>
            </span>
        </a>
        <button class="notification-btn" aria-label="Notifications">
            <i class="bi bi-bell"></i>
        </button>
        <div class="user-profile">
            <span class="user-date">
                <span class="date-day">Friday, Dec 5</span>
                <small class="date-time">11:51 PM</small>
            </span>
        </div>
    </div>
</div> 