<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::routeIs('petugas-laundry.dashboard') ? 'active' : '' }}">
        <a href="{{ route('petugas-laundry.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>
</ul>
