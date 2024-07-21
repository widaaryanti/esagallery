@extends('layouts.admin')

@section('title', 'Dashboard')

@push('style')
@endpush

@section('main')
    <div class="content-wrapper container">
        <div class="page-heading">
            <h3>@yield('title')</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-people text-success fs-1 mb-4"></i>
                            <h6 class="text-muted font-semibold">User</h6>
                            <h6 class="font-extrabold mb-0">{{ $user }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-bookmark text-info fs-1 mb-4"></i>
                            <h6 class="text-muted font-semibold">Kategori</h6>
                            <h6 class="font-extrabold mb-0">{{ $kategori }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-bag text-warning fs-1 mb-4"></i>
                            <h6 class="text-muted font-semibold">Barang</h6>
                            <h6 class="font-extrabold mb-0">{{ $barang }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-images text-primary fs-1 mb-4"></i>
                            <h6 class="text-muted font-semibold">Galeri</h6>
                            <h6 class="font-extrabold mb-0">{{ $galeri }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-body">
                        <div id="chart-transaksi"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            renderChart();
        });

        const renderChart = (labels, transaksi) => {

            const options = {
                chart: {
                    type: "line",
                    height: 350,
                },
                series: [{
                    name: "Transaksi",
                    data: @json($transaksi['data']),
                }, ],
                xaxis: {
                    categories: @json($transaksi['labels']),
                },
                title: {
                    text: "Grafik Transaksi Tahun {{ date('Y') }}",
                },
            };

            const chart = new ApexCharts(
                document.querySelector("#chart-transaksi"),
                options
            );
            chart.render();
        };
    </script>
@endpush
