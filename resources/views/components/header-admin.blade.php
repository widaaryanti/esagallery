<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="dropdown  ms-auto ">
                    <a href="#" id="topbarUserDropdown"
                        class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            <img src="{{ asset('admin/compiled/jpg/1.jpg') }}" id="foto-profil"
                                alt="Logo - {{ config('app.name') }}">
                        </div>
                        <div class="text">
                            <h6 class="user-dropdown-name">{{ auth()->user()->nama ?? '' }}</h6>
                            <p class="user-dropdown-status text-sm text-muted">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
