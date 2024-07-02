@extends('layouts.frontend')

@section('title', 'Transaksi')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.css') }}">
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
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center bg-esa-secondary text-white">
                                        <th width="5%">#</th>
                                        <th>Tanggal</th>
                                        <th>Kode Trasansksi</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                    @forelse ($transaksi as $row)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ formatTanggal($row->created_at) }}</td>
                                            <td>{{ $row->kode_transaksi }}</td>
                                            <td>{{ $row->status }}</td>
                                            <td>{{ formatRupiah($row->total) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Keranjang Kosong</td>
                                        </tr>
                                    @endforelse
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush
