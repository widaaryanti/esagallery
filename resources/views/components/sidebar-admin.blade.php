36<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="container text-center mt-4">
            <a href="/admin">
                <img src="{{ asset('logo.jpg') }}" width="120px" alt="Logo - {{ config('app.name') }}">
            </a>
        </div>
        <div class="sidebar-menu">
            <ul class="menu mb-5">
                <li class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/admin/dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/user') ? 'active' : '' }}">
                    <a href="{{ url('/admin/user') }}" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>User</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/kategori') ? 'active' : '' }}">
                    <a href="{{ url('/admin/kategori') }}" class='sidebar-link'>
                        <i class="bi bi-bookmark"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/barang') || request()->is('admin/barang/*')    ? 'active' : '' }}">
                    <a href="{{ url('/admin/barang') }}" class='sidebar-link'>
                        <i class="bi bi-bag"></i>
                        <span>Barang</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/galeri') || request()->is('admin/galeri/*')  ? 'active' : '' }}">
                    <a href="{{ url('/admin/galeri') }}" class='sidebar-link'>
                        <i class="bi bi-images"></i>
                        <span>Galeri</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/transaksi') ? 'active' : '' }}">
                    <a href="{{ url('/admin/transaksi') }}" class='sidebar-link'>
                        <i class="bi bi-cash"></i>
                        <span>Transaksi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/pengaturan') ? 'active' : '' }}">
                    <a href="{{ url('/admin/pengaturan') }}" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/profile') ? 'active' : '' }}">
                    <a href="{{ url('/admin/profile') }}" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item mb-5">
                    <a href="{{ url('/logout') }}" class='sidebar-link text-danger'>
                        <i class="bi bi-arrow-right-circle-fill text-danger"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
