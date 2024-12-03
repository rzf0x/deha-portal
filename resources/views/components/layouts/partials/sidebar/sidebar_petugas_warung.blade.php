<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::routeIs('petugas-warung.dashboard') ? 'active' : '' }}">
        <a href="{{ route('petugas-warung.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-warung.kategori') }}"
            class='sidebar-link {{ Request::routeIs('petugas-warung.kategori') ? 'text-bg-primary' : '' }}'>
            <i
                class="{{ Request::routeIs('petugas-warung.kategori') ? 'bi bi-tag-fill text-bg-primary' : 'bi bi-tag' }} fs-5"></i>
            <span>Kategori</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-warung.produk') }}"
            class='sidebar-link {{ Request::routeIs('petugas-warung.produk') ? 'text-bg-primary' : '' }}'>
            <i
                class="{{ Request::routeIs('petugas-warung.produk') ? 'bi bi-box-seam-fill text-bg-primary' : 'bi bi-box-seam' }}"></i>
            <span>Produk</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-warung.pesanan') }}"
            class='sidebar-link {{ Request::routeIs('petugas-warung.pesanan') ? 'text-bg-primary' : '' }}'>
            <i
                class="{{ Request::routeIs('petugas-warung.pesanan') ? 'bi bi-cart-check-fill text-bg-primary' : 'bi bi-cart-check' }} fs-5"></i>
            <span>Pesanan</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-warung.pembayaran') }}"
            class='sidebar-link {{ Request::routeIs('petugas-warung.pembayaran') ? 'text-bg-primary' : '' }}'>
            <i
                class="{{ Request::routeIs('petugas-warung.pembayaran') ? 'bi bi-credit-card-fill text-bg-primary' : 'bi bi-credit-card' }} fs-5"></i>
            <span>Pembayaran</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-warung.detail-pembayaran') }}"
            class='sidebar-link {{ Request::routeIs('petugas-warung.detail-pembayaran') ? 'text-bg-primary' : '' }}'>
            <i
                class="{{ Request::routeIs('petugas-warung.detail-pembayaran') ? 'bi bi-receipt-cutoff text-bg-primary' : 'bi bi-receipt' }} fs-5"></i>
            <span>Detail Pembayaran</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a href="{{ route('petugas-warung.revenue') }}"
            class='sidebar-link {{ Request::routeIs('petugas-warung.revenue') ? 'text-bg-primary' : '' }}'>
            <i
                class="{{ Request::routeIs('petugas-warung.revenue') ? 'bi bi-graph-up-arrow text-bg-primary' : 'bi bi-graph-up' }} fs-5"></i>
            <span>Revenue</span>
        </a>
    </li>
</ul>
