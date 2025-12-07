<!-- Top Bar -->
<div class="top-bar">
    <div class="welcome-text">
        <h2>Dashboard</h2>
        <p>Welcome back, {{ strtoupper(substr(auth()->user()->full_name, 0, 2)) }}! Here's your portfolio overview.</p>
    </div>
    <div class="user-actions">
        {{-- <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search..." class="search-input">
        </div> --}}
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="bi bi-house-door"></i>
            Visit Home
        </a>
        <a href="{{ route('investments.create') }}" class="invest-now-btn">
            <span class="invest-btn-border"></span>
            <span class="invest-btn-text">
                <i class="bi bi-lightning-charge-fill"></i>
                Invest Now
            </span>
        </a>
        <button class="notification-btn">
            <i class="bi bi-bell"></i>
        </button>
        <div class="user-profile">
            <span class="user-date">Friday, Dec 5<br><small>11:51 PM</small></span>
        </div>
    </div>
</div>
