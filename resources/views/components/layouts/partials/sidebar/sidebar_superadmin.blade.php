<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" wire:navigate wire:click='$refresh' class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- Data Master Pondok --}}
    <li class="sidebar-title">Data Master Pondok</li>

    {{-- Master Pondok --}}
    <li class="sidebar-item has-sub {{ Request::routeIs('admin.master-pondok*') ? 'active' : '' }}">
        <a href="" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>Master Pondok</span>
        </a>

        <ul class="submenu ">
            <li class="submenu-item">
                <a href="{{ route('admin.master-pondok.jenjang') }}" wire:navigate 
                    class="submenu-link {{ Request::routeIs('admin.master-pondok.jenjang') ? 'text-primary fs-6' : '' }}">
                    Jenjang
                </a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('admin.master-pondok.wali-kamar') }}" wire:navigate 
                    class="submenu-link {{ Request::routeIs('admin.master-pondok.wali-kamar') ? 'text-primary fs-6' : '' }}">
                    Wali Kamar
                </a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('admin.master-pondok.kamar') }}" wire:navigate 
                    class="submenu-link {{ Request::routeIs('admin.master-pondok.kamar') ? 'text-primary fs-6' : '' }}">
                    Kamar
                </a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('admin.master-pondok.wali-kelas') }}" wire:navigate 
                    class="submenu-link {{ Request::routeIs('admin.master-pondok.wali-kelas') ? 'text-primary fs-6' : '' }}">
                    Wali Kelas
                </a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('admin.master-pondok.kelas') }}" wire:navigate 
                    class="submenu-link {{ Request::routeIs('admin.master-pondok.kelas') ? 'text-primary fs-6' : '' }}">
                    Kelas
                </a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('admin.master-pondok.angkatan') }}" wire:navigate 
                    class="submenu-link {{ Request::routeIs('admin.master-pondok.angkatan') ? 'text-primary fs-6' : '' }}">
                    Angkatan
                </a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('admin.master-pondok.semester') }}" wire:navigate 
                    class="submenu-link {{ Request::routeIs('admin.master-pondok.semester') ? 'text-primary fs-6' : '' }}">
                    Semester
                </a>
            </li>
        </ul>
    </li>
    {{-- Master Pondok --}}

    {{-- Master Santri --}}
    <li class="sidebar-item has-sub {{ Request::routeIs('admin.master-santri*') ? 'active' : '' }}">
        <a href="" class='sidebar-link'>
            <i class="bi bi-people"></i>
            <span>Master Santri</span>
        </a>

        <ul class="submenu ">
            <li class="submenu-item  ">
                <a href="{{ route('admin.master-santri.santri') }}" wire:navigate 
                    class="submenu-link {{ Request::routeIs('admin.master-santri.santri') ? 'text-primary fs-6' : '' }}">List Santri</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('admin.master-santri.wali-santri') }}" wire:navigate 
                    class="submenu-link {{ Request::routeIs('admin.master-santri.wali-santri') ? 'text-primary fs-6' : '' }}">List Wali Santri</a>
            </li>
        </ul>
    </li>
    {{-- Master Santri --}}

    {{-- Master Admin --}}
    <li class="sidebar-item has-sub {{ Request::routeIs('admin.master-admin*') ? 'active' : '' }}">
        <a href="" class='sidebar-link'>
            <i class="bi bi-person-gear"></i>
            <span>Master Admin</span>
        </a>

        <ul class="submenu ">
            <li class="submenu-item  ">
                <a href="{{ route('admin.master-admin.list-admin') }}" wire:navigate  class="submenu-link {{ Request::routeIs('admin.master-admin.list-admin') ? 'text-primary fs-6' : '' }}">List Admin</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('admin.master-admin.list-role') }}" wire:navigate  class="submenu-link {{ Request::routeIs('admin.master-admin.list-role') ? 'text-primary fs-6' : '' }}">Tambah Role</a>
            </li>
        </ul>
    </li>
    {{-- Master Admin --}}

    {{-- Data Master Pondok --}}

</ul>
