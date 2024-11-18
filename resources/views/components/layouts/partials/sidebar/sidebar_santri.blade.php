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
        <a wire:navigate href="{{ route('santri.profile') }}" class='sidebar-link {{ Request::routeIs('santri.profile') ? 'text-bg-primary' : '' }}'>
            <i class="{{ Request::routeIs('santri.profile') ? 'bi bi-person-fill text-bg-primary' : 'bi bi-person fs-5' }} fs-5"></i>
            <span>Profile</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('santri.kegiatan') }}" class='sidebar-link {{ Request::routeIs('santri.kegiatan') ? 'text-bg-primary' : '' }}'>
            <i class="{{ Request::routeIs('santri.kegiatan') ? 'bi bi-bookmark-star-fill text-bg-primary' : 'bi bi-bookmark-star' }}"></i>
            <span>Kegiatan</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a wire:navigate href="{{ route('santri.pengumuman') }}" class='sidebar-link {{ Request::routeIs('santri.pengumuman') ? 'text-bg-primary' : '' }}'>
            <i class="{{ Request::routeIs('santri.pengumuman') ? 'bi bi-calendar-event-fill text-bg-primary' : 'bi bi-calendar-event' }}"></i>
            <span>Pengumuman</span>
        </a>
    </li>
</ul>
