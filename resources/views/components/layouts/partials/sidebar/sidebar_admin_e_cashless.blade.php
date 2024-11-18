<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::routeIs('petugas-e-cashless.dashboard') ? 'active' : '' }}">
        <a href="{{ route('petugas-e-cashless.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item {{ Request::routeIs('petugas-e-cashless.pembayaran') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('petugas-e-cashless.pembayaran') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('petugas-e-cashless.pembayaran') ? 'bi bi-credit-card-fill' : 'bi bi-credit-card' }}"></i>
            <span>Pembayaran</span>
        </a>
    </li>

    <li class="sidebar-item {{ Request::routeIs('petugas-e-cashless.history-pembayaran') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('petugas-e-cashless.history-pembayaran') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('petugas-e-cashless.history-pembayaran') ? 'bi bi-clock-fill' : 'bi bi-clock' }}"></i>
            <span>History Pembayaran</span>
        </a>
    </li>
</ul>
