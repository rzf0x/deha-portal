<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li wire:click='$refresh' class="sidebar-item {{ Request::routeIs('petugas-warung.dashboard') ? 'active' : '' }}">
        <a href="{{ route('petugas-warung.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li wire:click='$refresh' class="sidebar-item">
        <a href="{{ route('petugas-warung.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Produk</span>
        </a>
    </li>
</ul>
