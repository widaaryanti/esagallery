@extends('layouts.frontend')

@section('title', 'barang')

@push('style')
@endpush

@section('main')
    <header class="py-5 min-vh-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 mb-3 text-center">
                    <h2 class="fw-bold text-esa-secondary mb-3 text-center">{{ $barang->nama }}</h2>
                    <p class="text-center">{{ $barang->deskripsi }}</p>
                    <small class="d-block mb-2">Harga : {{ formatRupiah($barang->harga) }}</small>
                    <small class="d-block mb-2">Stok : {{ $barang->stok }}</small>
                    <button class="btn btn-primary"><i class="bi bi-plus me-1"></i>Masukan Keranjang</button>
                </div>
            </div>
            <div class="row" id="barang">
                @forelse ($barang->barangGambars as $barangGambars)
                    <div class="col-lg-4 col-md-6 col-12">
                        <img src="/storage/galeri/barang/{{ $barangGambars->gambar }}" class="img-fluid-custom"
                            alt="{{ $barang->nama }}">
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center my-5 py-5">
                            <div class="fw-semibold">Barang Tidak Ditemukan</div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </header>
@endsection

@push('scripts')
@endpush
