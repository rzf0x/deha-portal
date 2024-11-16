<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::routeIs('santri.dashboard') ? 'active' : '' }}">
        <a href="{{ route('santri.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- Data Master Pondok --}}
    <li class="sidebar-title">Lainnya</li>

    <li class="sidebar-item">
        <a href="{{ route('santri.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Profile</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a href="{{ route('santri.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Jadwal</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a href="{{ route('santri.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Pengumuman</span>
        </a>
    </li>
</ul>
