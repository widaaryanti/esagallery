@extends('layouts.frontend')

@section('title', 'Galeri')

@push('style')
<style>
    .carousel-item img {
        max-height: 400px;
        width: auto;
        object-fit: cover;
    }

    .galeri-content {
        padding: 20px;
    }
</style>
@endpush

@section('main')
<header class="py-5 min-vh-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 mb-5">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($galeri->galeriGambars as $key => $galeriGambar)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($galeri->galeriGambars as $key => $galeriGambar)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="/storage/galeri/gambar/{{ $galeriGambar->gambar }}" class="d-block w-100 mx-auto" alt="{{ $galeri->nama }}">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>            
            <div class="container">
                <div class="card bg-light galeri-content">
                    <div class="card-body">
                        <h2 class="card-title fw-bold text-esa-secondary mb-3">{{ $galeri->nama }}</h2>
                        <p class="card-text"><small class="text-muted">Tanggal Mulai: {{ formatTanggal($galeri->tanggal_mulai, 'd F Y') }}</small></p>
                        <p class="card-text"><small class="text-muted">Tanggal Selesai: {{ formatTanggal($galeri->tanggal_selesai, 'd F Y') }}</small></p>
                        <p class="card-text">{{ $galeri->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@push('scripts')
<!-- Tambahkan script khusus jika diperlukan -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endpush
