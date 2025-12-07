<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('/assets/images/favicon.png') }}" width="60" height="40" alt="Forevestor Logo" />
            <h4>Forevestor</h4>
        </div>
    </div>
    
    <nav class="nav-menu">
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('investments.index') }}" class="nav-link {{ request()->routeIs('investments.*') ? 'active' : '' }}">
                    <i class="bi bi-wallet2"></i>
                    <span>Investments</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="{{ route('trading') }}" class="nav-link {{ request()->routeIs('trading') ? 'active' : '' }}">
                    <i class="bi bi-graph-up"></i>
                    <span>Trading</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transactions') }}" class="nav-link {{ request()->routeIs('transactions') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>
                    <span>Transactions</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('settings') }}" class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('support') }}" class="nav-link {{ request()->routeIs('support') ? 'active' : '' }}">
                    <i class="bi bi-question-circle"></i>
                    <span>Support</span>
                </a>
            </li> --}}
        </ul>
    </nav>

    <div class="sidebar-footer">
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <div class="sidebar-user" onclick="document.getElementById('logoutForm').submit();" style="cursor: pointer;">
                <div class="sidebar-avatar">
                    {{ strtoupper(substr($user->full_name ?? 'JD', 0, 1)) }}{{ strtoupper(substr(explode(' ', $user->full_name ?? 'John Doe')[1] ?? 'D', 0, 1)) }}
                </div>
                <div class="sidebar-user-info">
                    <h5>{{ explode(' ', $user->full_name ?? 'John Doe')[0] }} {{ explode(' ', $user->full_name ?? 'John Doe')[1] ?? '' }}</h5>
                    <p>Premium Investor</p>
                </div>
                <i class="bi bi-box-arrow-right" style="margin-left: auto; color: #94a3b8;"></i>
            </div>
        </form>
    </div>
</aside>

