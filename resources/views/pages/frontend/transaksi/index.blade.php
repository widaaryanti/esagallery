@extends('layouts.frontend')

@section('title', 'Transaksi')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/compiled/css/table-datatable-jquery.css') }}">
@endpush

@section('main')
    <header class="py-5 min-vh-100">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="text-dark mb-3">Data @yield('title')</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="transaksi-table" width="100%">
                                    <thead>
                                        <tr class="text-center bg-esa-secondary text-white">
                                            <th width="5%">#</th>
                                            <th>Tanggal</th>
                                            <th>Kode Trasansksi</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            datatableCall('transaksi-table', '{{ route('transaksi.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'kode_transaksi',
                    name: 'kode_transaksi'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]);
        });
    </script>
@endpush
