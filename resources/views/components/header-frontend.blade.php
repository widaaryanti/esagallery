<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex gap-2 align-items-center" href="/">
            <img class="profile-img" src="{{ asset('logo.jpg') }}" width="70px" alt="Logo - {{ config('app.name') }}">
            <div class="fw-bold">{{ config('app.name') }}</div>
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon mid-bar"></span>
            <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder me-lg-auto">
                <li class="nav-item">
                    <a class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('/') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                        href="/">Home</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('tentang') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                        href="/tentang">Tentang</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('galeri') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                        href="/galeri">Galeri</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('barang') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                        href="/barang">Barang</a>
                </li>
                @auth
                    <li class="nav-item"><a
                            class="nav-link ms-lg-3 text-center text-lg-start {{ Request::is('transaksi') ? 'text-esa-secondary fw-bold border-bottom border-esa-secondary border-3' : '' }}"
                            href="/transaksi">Transaksi</a>
                    </li>
                @endauth
            </ul>
            <div class="text-center text-dark">
                @auth
                    {{ auth()->user()->nama ?? '' }}
                @else
                    <a href="/login" class="btn bg-esa-secondary text-white fw-semibold shadow-0 btn-sm px-3">Login</a>
                @endauth
            </div>            
    </div>
</nav>
