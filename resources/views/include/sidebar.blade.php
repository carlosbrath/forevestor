<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('/assets/images/logo.png') }}" width="35" height="35" alt="Forevestor Logo" />
            <div class="logo-text">
                <h4>{{ in_array(auth()->user()->role?->name, ['super-admin', 'admin', 'moderator']) ? 'Admin Panel' : 'Dashboard' }}</h4>
                <small class="user-role">{{ ucfirst(str_replace('-', ' ', auth()->user()->role?->name ?? 'Guest')) }}</small>
            </div>
        </div>
    </div>

    <ul class="nav-menu">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Investor Routes -->
        @if(in_array(auth()->user()->role?->name, ['investor', 'moderator', 'admin', 'super-admin']))
        <li class="nav-item">
            <a href="{{ route('investments.index') }}" class="nav-link {{ request()->routeIs('investments.*') ? 'active' : '' }}">
                <i class="bi bi-wallet2"></i>
                <span>My Investments</span>
            </a>
        </li>
        @endif

        <!-- Admin Routes -->
        @if(in_array(auth()->user()->role?->name, ['admin', 'moderator', 'super-admin']))
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Admin Dashboard</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a href="{{ route('admin.investments') }}" class="nav-link {{ request()->routeIs('admin.investments') ? 'active' : '' }}">
                <i class="bi bi-hourglass-split"></i>
                <span>Pending Approvals</span>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>User Management</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i>
                <span>Settings</span>
            </a>
        </li>
        @endif

        <!-- Super Admin Routes -->
        @if(auth()->user()->role?->name === 'super-admin')
        <li class="nav-item">
            <a href="{{ route('super-admin.dashboard') }}" class="nav-link {{ request()->routeIs('super-admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-shield-check"></i>
                <span>Super Admin Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('super-admin.roles') }}" class="nav-link {{ request()->routeIs('super-admin.roles') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>
                <span>Roles Management</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('super-admin.permissions') }}" class="nav-link {{ request()->routeIs('super-admin.permissions') ? 'active' : '' }}">
                <i class="bi bi-lock"></i>
                <span>Permissions</span>
            </a>
        </li> --}}
        @endif

        <!-- Logout -->
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav-link" style="border:none; background:none; cursor:pointer; width:100%; text-align:left;">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</aside>
