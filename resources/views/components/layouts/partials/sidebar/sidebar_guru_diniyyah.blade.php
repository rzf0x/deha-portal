<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-diniyyah.dashboard') ? 'active' : '' }}">
        <a href="{{ route('e-santri-guru-diniyyah.dashboard') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-diniyyah.dashboard') ? 'bi bi-house-fill' : 'bi bi-house' }}"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-title">Lainnya</li>

    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-diniyyah.jadwal-pelajaran') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('e-santri-guru-diniyyah.jadwal-pelajaran') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-diniyyah.jadwal-pelajaran') ? 'bi bi-calendar-fill' : 'bi bi-calendar' }}"></i>
            <span>Jadwal Pelajaran</span>
        </a>

    </li>
    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-diniyyah.kategori-pelajaran') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('e-santri-guru-diniyyah.kategori-pelajaran') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-diniyyah.kategori-pelajaran') ? 'bi bi-calendar-fill' : 'bi bi-calendar' }}"></i>
            <span>Kategory Pelajaran</span>
        </a>
    </li>
    
    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-diniyyah.jadwal-piket') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('e-santri-guru-diniyyah.jadwal-piket') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-diniyyah.jadwal-piket') ? 'bi bi-clock-fill' : 'bi bi-clock' }}"></i>
            <span>Jadwal Piket</span>
        </a>
    </li>

    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-diniyyah.pengumuman') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('e-santri-guru-diniyyah.pengumuman') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-diniyyah.pengumuman') ? 'bi bi-bell-fill' : 'bi-bell' }}"></i>
            <span>Pengumuman</span>
        </a>
    </li>
</ul>
