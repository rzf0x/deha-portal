<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::routeIs('petugas-laundry.dashboard') ? 'active' : '' }}">
        <a href="{{ route('petugas-laundry.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-laundry.laundry-service') }}" class='sidebar-link {{ Request::routeIs('petugas-laundry.laundry-service') ? 'text-bg-primary' : '' }}'>
            <i class="{{ Request::routeIs('petugas-laundry.laundry-service') ? 'bi bi-basket-fill text-bg-primary' : 'bi bi-basket' }}"></i>    
            <span>Laundry Services</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-laundry.list-laundry') }}" class='sidebar-link {{ Request::routeIs('petugas-laundry.list-laundry') ? 'text-bg-primary' : '' }}'>
            <i class="{{ Request::routeIs('petugas-laundry.list-laundry') ? 'bi bi-bucket-fill text-bg-primary' : 'bi bi-bucket' }}"></i>
            <span>List Laundry</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('petugas-laundry.pesanan') }}" class='sidebar-link {{ Request::routeIs('petugas-laundry.pesanan') ? 'text-bg-primary' : '' }}'>
            <i class="{{ Request::routeIs('petugas-laundry.pesanan') ? 'bi bi-clock-fill text-bg-primary' : 'bi bi-clock' }}"></i>    
            <span>Riwayat Pesanan</span>
        </a>
    </li>
</ul>
