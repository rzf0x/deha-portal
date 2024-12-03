<!-- Bottom Navbar -->
<nav class="navbar navbar-dark bg-primary navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none p-0">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <a href="{{ route('santri.dashboard') }}"
                class="nav-link text-center {{ Request::routeIs('santri.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill fs-4"></i>
                <span class="small d-block">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a wire:navigate href="{{ route('santri.profile') }}"
                class="nav-link text-center {{ Request::routeIs('santri.profile') ? 'active' : '' }}">
                <i class="bi {{ Request::routeIs('santri.profile') ? 'bi-person-fill' : 'bi-person' }} fs-4"></i>
                <span class="small d-block">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a wire:navigate href="{{ route('santri.kegiatan') }}"
                class="nav-link text-center {{ Request::routeIs('santri.kegiatan') ? 'active' : '' }}">
                <i
                    class="bi {{ Request::routeIs('santri.kegiatan') ? 'bi-bookmark-star-fill' : 'bi-bookmark-star' }} fs-4"></i>
                <span class="small d-block">Kegiatan</span>
            </a>
        </li>
        <li class="nav-item">
            <a wire:navigate href="{{ route('santri.pengumuman') }}"
                class="nav-link text-center {{ Request::routeIs('santri.pengumuman') ? 'active' : '' }}">
                <i
                    class="bi {{ Request::routeIs('santri.pengumuman') ? 'bi-calendar-event-fill' : 'bi-calendar-event' }} fs-4"></i>
                <span class="small d-block">Pengumuman</span>
            </a>
        </li>
        <li class="nav-item">
            <livewire:mobile.auth.logout>
        </li>
    </ul>
</nav>
