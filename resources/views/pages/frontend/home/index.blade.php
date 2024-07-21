@extends('layouts.frontend')

@section('title', 'Home')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
@endpush

@section('main')
    <header class="bg-home" style="background-image: url({{ asset('frontend/assets/bg.jpg') }}); ">
        <div class="bg-dark bg-opacity-25">
            <div class="container">
                <div class="row align-items-center" style="height: 90vh">
                    <div class="col-lg-6  py-3 text-center text-lg-start">
                        <h1 class="fs-1 text-shadow mb-2 fw-bolder text-white">
                            Design Interior, Furniture
                        </h1>
                        <h1 class="text-shadow mb-3 fw-bolder text-white">
                            dan Construction
                        </h1>
                        <p class="text-shadow text-white fw-semibold">
                            Your Partner in Construction, Interior & Exterior Design, Landscaping, Rock Features, Furniture, and Pool Design
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-3">
                <div class="col-lg-12 text-center">
                    <h2 class="fw-bold text-esa-secondary mb-3">Tentang</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-3">
                    <img src="{{ asset('frontend/assets/about.jpg') }}" class="img-fluid" alt="Deskripsi Gambar">
                </div>
                <div class="col-lg-5 mb-3">
                    <p>{{ pengaturan()->deskripsi }} </p>
                    <p class="text-justify">Perusahaan swasta yang bergerak di bidang jasa, seperti jasa konstruksi dan
                        bangunan, interior &
                        exterior, taman, tebing, furniture, pembuatan kolam renang dan kolam koi.</p>
                    <div class="list-group">
                        <ul class="list-unstyled">
                            <li class="d-flex gap-3 mb-1">
                                <i class="bi bi-check-circle"></i>
                                <div class="text-justify">Konstruksi dan Bangunan: Kami menyediakan layanan konstruksi mulai
                                    dari perencanaan
                                    hingga penyelesaian proyek, dengan fokus pada keamanan, keandalan, dan keindahan
                                    desain.</div>
                            </li>
                            <li class="d-flex gap-3 mb-1">
                                <i class="bi bi-check-circle"></i>
                                <div class="text-justify">Interior & Eksterior: Desain dan pembangunan interior serta
                                    eksterior yang memukau dan
                                    berfungsional.</div>
                            </li>
                            <li class="d-flex gap-3 mb-1">
                                <i class="bi bi-check-circle"></i>
                                <div class="text-justify">Taman dan Tebing: Penataan taman yang indah dan tebing yang
                                    estetis untuk menciptakan
                                    lingkungan yang harmonis.</div>
                            </li>
                            <li class="d-flex gap-3 mb-1">
                                <i class="bi bi-check-circle"></i>
                                <div class="text-justify">Furniture: Pembuatan furniture khusus dengan desain yang sesuai
                                    keinginan Anda.</div>
                            </li>
                            <li class="d-flex gap-3 mb-1">
                                <i class="bi bi-check-circle"></i>
                                <div class="text-justify">Pembuatan Kolam Renang & Kolam Koi: Desain, konstruksi, dan
                                    pemeliharaan kolam renang
                                    serta kolam koi yang elegan dan terawat dengan baik.</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-3">
                <div class="col-lg-12 text-center">
                    <h2 class="fw-bold text-esa-secondary mb-3">Galeri</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                @forelse ($galeri as $row)
                    <div class="col-lg-4 col-12 col-md-6 mb-3">
                        <a href="/galeri/{{ $row->id }}" class="text-decoration-none text-dark card shadow-sm rounded-3 h-100">
                            <div class="card-body text-center p-0">
                                <div class="mb-3">
                                    <div class="owl-carousel owl-theme">
                                        @forelse ($row->galeriGambars as $galeriGambars)
                                            <div class="item">
                                                <img src="/storage/galeri/gambar/{{ $galeriGambars->gambar }}" class="img-fluid-custom"
                                                    alt="{{ $row->nama }}">
                                            </div>
                                        @empty
                                            <div class="item">
                                                <img src="{{ asset('frontend/assets/tidakada.jpg') }}" class="img-fluid-custom"
                                                    alt="{{ $row->nama }}">
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <p class="card-title fw-bold">{{ $row->nama }}</p>
                                <div class="mb-3">
                                    <small>{{ formatTanggal($row->tanggal_mulai, 'd F Y') . ' - ' . formatTanggal($row->tanggal_selesai, 'd F Y') }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center my-5 py-5">
                            <div class="fw-semibold">Galeri Tidak Ditemukan</div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            initializeOwlCarousel();
        });

        function initializeOwlCarousel() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                items: 1,
            });
        }
    </script>
@endpush
