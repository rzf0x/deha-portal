<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::routeIs('petugas-warung.dashboard') ? 'active' : '' }}">
        <a href="{{ route('petugas-warung.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-warung.produk') }}" class='sidebar-link {{ Request::routeIs('petugas-warung.produk') ? 'text-bg-primary' : '' }}'>
            <i class="{{ Request::routeIs('petugas-warung.produk') ? 'bi bi-box-seam-fill text-bg-primary' : 'bi bi-box-seam' }}"></i>
            <span>Produk</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-warung.kategori') }}" class='sidebar-link {{ Request::routeIs('petugas-warung.kategori') ? 'text-bg-primary' : '' }}'>
            <i class="{{ Request::routeIs('petugas-warung.kategori') ? 'bi bi-tag-fill text-bg-primary' : 'bi bi-tag' }} fs-5"></i>
            <span>Kategori</span>
        </a>
    </li>
</ul>
