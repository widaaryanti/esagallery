<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex gap-2 align-items-center" href="/">
            <img class="profile-img" src="{{ asset('logo.jpg') }}" width="70px" alt="Logo - {{ config('app.name') }}">
            <div class="fw-bold fs-5">{{ config('app.name') }}</div>
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon mid-bar"></span>
            <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                <li class="nav-item">
                    <a class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('/') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                        href="/">Home</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('tentang') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                        href="/tentang">Tentang</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('galeri') || Request::is('galeri/*') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                        href="/galeri">Galeri</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('barang') || Request::is('barang/*') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                        href="/barang">Barang</a>
                </li>
                @auth
                    <li class="nav-item"><a
                            class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('transaksi') || Request::is('transaksi/*') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                            href="/transaksi">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-lg-3 text-center text-lg-start position-relative {{ Request::is('cart') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                            href="/cart">
                            <i class="bi bi-bag-fill me-2 mb-1"></i>
                            Keranjang
                            <span
                                class="position-absolute top-0 start-100 translate-middle p-1 badge rounded-pill bg-danger"
                                style="font-size: 0.6rem; padding: 0.2em 0.4em;" id="cart">
                                {{ auth()->user()->carts->count() }}
                            </span>
                        </a>
                    </li>
                @endauth
            </ul>
            <div class="ms-3 text-center text-dark d-flex gap-3">
                @auth
                    <div class="dropdown">
                        <a class="text-decoration-none text-dark fw-semibold dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->nama ?? '' }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="/profile">Profil</a></li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <a href="/login" class="btn bg-esa-secondary text-white fw-semibold shadow-0 btn-sm px-3">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
