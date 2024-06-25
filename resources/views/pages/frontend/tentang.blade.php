@extends('layouts.frontend')

@section('title', 'Tentang')

@push('style')
@endpush

@section('main')
    <header class="py-5 min-vh-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-3">
                    <h2 class="fw-bold text-esa-secondary mb-3">Tentang</h2>
                    <p>{{ pengaturan()->deskripsi }}</p>
                    <div class="list-group">
                        <div class="mb-2 d-flex align-items-center">
                            <i class="bi bi-envelope-fill  me-3"></i>
                            <span>{{ pengaturan()->email }}</span>
                        </div>
                        <div class="mb-2 d-flex align-items-center">
                            <i class="bi bi-telephone-fill  me-3"></i>
                            <span>{{ pengaturan()->no_hp }}</span>
                        </div>
                        <div class="mb-2 d-flex align-items-start">
                            <i class="bi bi-geo-alt-fill  me-3"></i>
                            <span>{{ pengaturan()->alamat }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3"></div>
            </div>
        </div>
    </header>
@endsection

@push('scripts')
@endpush
