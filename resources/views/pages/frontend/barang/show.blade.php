@extends('layouts.frontend')

@section('title', 'Barang')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
@endpush

@section('main')
    <header class="py-5 min-vh-100">
        <div class="container">
            <div class="row align-items-center" id="barang">
                <div class="col-lg-6">
                    <div class="owl-carousel owl-theme">
                        @forelse ($barang->barangGambars as $barangGambars)
                            <div class="item">
                                <img src="/storage/galeri/barang/{{ $barangGambars->gambar }}" class="img-fluid-detail"
                                    alt="{{ $barang->nama }}">
                            </div>
                        @empty
                            <div class="item">
                                <img src="{{ asset('frontend/assets/tidakada.jpg') }}" class="img-fluid-detail"
                                    alt="{{ $barang->nama }}">
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold text-esa-secondary mb-3">{{ $barang->nama }}</h2>
                    <p>{{ $barang->deskripsi }}</p>
                    <small class="d-block mb-2">Harga : {{ formatRupiah($barang->harga) }}</small>
                    <small class="d-block mb-2">Stok : {{ $barang->stok }}</small>
                    <button onclick="addCart({{ $barang->id }})" class="btn btn-success d-block"><i
                            class="bi bi-cart me-2"></i>Beli</button>
                </div>
            </div>
        </div>
    </header>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
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
