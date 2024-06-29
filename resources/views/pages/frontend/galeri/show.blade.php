@extends('layouts.frontend')

@section('title', 'Galeri')

@push('style')
@endpush

@section('main')
    <header class="py-5 min-vh-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 mb-3 text-center">
                    <h2 class="fw-bold text-esa-secondary mb-3 text-center">{{ $galeri->nama }}</h2>
                    <p class="text-center">{{ $galeri->deskripsi }}</p>
                    <small>{{ formatTanggal($galeri->tanggal_mulai, 'd F Y') . ' - ' . formatTanggal($galeri->tanggal_selesai, 'd F Y') }}</small>
                </div>
            </div>
            <div class="row" id="galeri">
                @forelse ($galeri->galeriGambars as $galeriGambars)
                    <div class="col-lg-4 col-md-6 col-12">
                        <img src="/storage/galeri/gambar/{{ $galeriGambars->gambar }}" class="img-fluid-custom"
                            alt="{{ $galeri->nama }}">
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
    </header>
@endsection

@push('scripts')
@endpush
