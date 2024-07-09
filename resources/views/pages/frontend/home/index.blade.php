@extends('layouts.frontend')

@section('title', 'Home')

@push('style')
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
@endsection

@push('scripts')
@endpush
