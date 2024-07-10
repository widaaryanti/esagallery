@extends('layouts.frontend')

@section('title', 'Tentang')

@push('style')
@endpush

@section('main')
    <header class="py-5 min-vh-100">
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
    </header>
@endsection

@push('scripts')
@endpush
