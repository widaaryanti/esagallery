@extends('layouts.frontend')

@section('title', 'Keranjang')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('main')
    <header class="py-5 min-vh-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="text-dark mb-3">Data @yield('title')</h5>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center bg-esa-secondary text-white">
                                        <th width="5%">#</th>
                                        <th width="30%">Produk</th>
                                        <th width="15%">Harga</th>
                                        <th width="15%">Quantity</th>
                                        <th width="15%">Total</th>
                                    </tr>
                                    @forelse ($cart as $row)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $row->barang->nama }}</td>
                                            <td>{{ formatRupiah($row->barang->harga) }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td>{{ formatRupiah($row->jumlah) }}</td>
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
                <div class="col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-dark mb-3">Total</h5>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td class="text-end">{{ formatRupiah($cart->sum('jumlah')) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Bayar</th>
                                        <th class="text-end">{{ formatRupiah($cart->sum('jumlah')) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            @if ($cart->count() > 0)
                                <form id="payMidtrans">
                                    <button onclick="payMidtrans()" type="submit" class="btn btn-success w-100"><i
                                            class="bi bi-credit-card me-2"></i> Bayar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        $(document).ready(function() {
            $("#payMidtrans").submit(function(e) {
                setButtonLoadingState("#payMidtrans .btn.btn-succes", true, "Bayar");
                e.preventDefault();

                const url = "{{ route('transaksi') }}";

                const successCallback = function(response) {
                    setButtonLoadingState("#payMidtrans .btn.btn-succes", false, "Bayar");
                    snap.pay(response.data.snapToken, {
                        onSuccess: function(result) {
                            handleSuccess("Transaksi Berhasil", null,
                                null,
                                "/transaksi");
                        },
                        onPending: function(result) {
                            handleSuccess("Transaksi Berhasil", null,
                                null,
                                "/transaksi");
                        },
                        onError: function(result) {
                            console.log(result)
                        }
                    });
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#payMidtrans .btn.btn-succes", false, "Bayar");
                    handleValidationErrors(error, "payMidtrans");
                };

                ajaxCall(url, "POST", null, successCallback, errorCallback);
            });
        });
    </script>
@endpush
