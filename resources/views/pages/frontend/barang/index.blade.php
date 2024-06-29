@extends('layouts.frontend')

@section('title', 'Barang')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
@endpush

@section('main')
    <header class="py-5 min-vh-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 mb-3">
                    <h2 class="fw-bold text-esa-secondary mb-3 text-center">Barang</h2>
                    <p class="text-center">Temukan koleksi barang yang kami sediakan</p>
                </div>
                <div class="col-12 mb-3">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Cari Barang ...">
                </div>
            </div>
            <div class="row" id="barang">
            </div>
        </div>
    </header>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            initializeOwlCarousel();
            getBarang(1);

            $('#search').on('input change', function() {
                getBarang(1);
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                getBarang(page);
            });
        });

        function initializeOwlCarousel() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                items: 1,
            });
        }

        const getBarang = (page) => {
            let search = $("#search").val();
            $.ajax({
                url: "{{ url('/barang') }}?page=" + page,
                data: {
                    search,
                },
                success: function(data) {
                    $("#barang").html(data);
                    initializeOwlCarousel(); // Reinitialize Owl Carousel after updating the gallery
                }
            });
        };
    </script>
@endpush
