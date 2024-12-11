<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-umum.dashboard') ? 'active' : '' }}">
        <a href="{{ route('e-santri-guru-umum.dashboard') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-umum.dashboard') ? 'bi bi-house-fill' : 'bi bi-house' }}"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-title">Lainnya</li>

    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-umum.jadwal-pelajaran') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('e-santri-guru-umum.jadwal-pelajaran') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-umum.jadwal-pelajaran') ? 'bi bi-calendar-fill' : 'bi bi-calendar' }}"></i>
            <span>Jadwal Pelajaran</span>
        </a>

    </li>
    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-umum.kategori-pelajaran') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('e-santri-guru-umum.kategori-pelajaran') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-umum.kategori-pelajaran') ? 'bi bi-calendar-fill' : 'bi bi-calendar' }}"></i>
            <span>Kategory Pelajaran</span>
        </a>
    </li>
    
    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-umum.jadwal-piket') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('e-santri-guru-umum.jadwal-piket') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-umum.jadwal-piket') ? 'bi bi-clock-fill' : 'bi bi-clock' }}"></i>
            <span>Jadwal Piket</span>
        </a>
    </li>

    <li class="sidebar-item {{ Request::routeIs('e-santri-guru-umum.pengumuman') ? 'active' : '' }}">
        <a wire:navigate  href="{{ route('e-santri-guru-umum.pengumuman') }}" class='sidebar-link'>
            <i class="{{ Request::routeIs('e-santri-guru-umum.pengumuman') ? 'bi bi-bell-fill' : 'bi-bell' }}"></i>
            <span>Pengumuman</span>
        </a>
    </li>
</ul>
