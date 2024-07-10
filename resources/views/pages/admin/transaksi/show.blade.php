@extends('layouts.admin')

@section('title', 'Transaksi')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/compiled/css/table-datatable-jquery.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('main')
    <div class="content-wrapper container">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>@yield('title')</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Detail Data @yield('title')</h5>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="row">
                                    <div class="col-4 mb-2">
                                        Tanggal
                                    </div>
                                    <div class="col-6 mb-2">
                                        : {{ $transaksi->created_at }}
                                    </div>
                                    <div class="col-4 mb-2">
                                        Kode Transaksi
                                    </div>
                                    <div class="col-6 mb-2">
                                        : {{ $transaksi->kode_transaksi }}
                                    </div>
                                    <div class="col-4 mb-2">
                                        Status
                                    </div>
                                    <div class="col-6 mb-2">
                                        : {!! formatStatusLabel($transaksi->status) !!}
                                    </div>
                                    <div class="col-4 mb-2">
                                        Total
                                    </div>
                                    <div class="col-6 mb-2">
                                        : {{ formatRupiah($transaksi->total) }}
                                    </div>
                                    <div class="col-4 mb-2">
                                        Customer
                                    </div>
                                    <div class="col-6 mb-2">
                                        : {{ $transaksi->user->nama }}
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="detail-transaksi-table"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Quantity</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                                            <tr>
                                                <td align="center">{{ $loop->iteration }}</td>
                                                <td>{{ $detailTransaksi->barang->nama }}</td>
                                                <td>{{ formatRupiah($detailTransaksi->barang->harga) }}</td>
                                                <td>{{ $detailTransaksi->quantity }}</td>
                                                <td>{{ formatRupiah($detailTransaksi->jumlah) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Total</th>
                                            <th>{{ formatRupiah($transaksi->total) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#detail-transaksi-table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
            });
        });
    </script>
@endpush
