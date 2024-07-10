@extends('layouts.frontend')

@section('title', 'Keranjang')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/compiled/css/table-datatable-jquery.css') }}">
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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered w-100" id="cart-table">
                                    <thead>
                                        <tr class="text-center bg-esa-secondary text-white">
                                            <th width="5%">#</th>
                                            <th width="30%">Barang</th>
                                            <th width="15%">Harga</th>
                                            <th width="15%">Quantity</th>
                                            <th width="15%">Jumlah</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
                                        <td class="text-end" id="total-harga">{{ formatRupiah($cart->sum('jumlah')) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Bayar</th>
                                        <th class="text-end" id="total-bayar">{{ formatRupiah($cart->sum('jumlah')) }}</th>
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
    @include('pages.frontend.cart.modal')
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        $(document).ready(function() {
            datatableCall('cart-table', '{{ route('cart.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'barang',
                    name: 'barang'
                },
                {
                    data: 'harga',
                    name: 'harga'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]);

            $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-primary", true);
                e.preventDefault();
                const kode = $("#saveData #id").val();
                const url = `/cart/${kode}`;
                const data = new FormData(this);

                data.append("_method", "PUT");

                const successCallback = function(response) {
                    getTotalCart();
                    setButtonLoadingState("#saveData .btn.btn-primary", false);
                    handleSuccess(response, "cart-table", "createModal");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false);
                    handleValidationErrors(error, "saveData", ["quantity"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

            $("#payMidtrans").submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi Pembayaran',
                    text: "Apakah Anda yakin akan melanjutkan transaksi pembayaran?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        processPayment();
                    }
                });
            });

            function processPayment() {
                setButtonLoadingState("#payMidtrans .btn.btn-success", true, "Bayar");

                const url = "{{ route('transaksi.index') }}";

                const successCallback = function(response) {
                    setButtonLoadingState("#payMidtrans .btn.btn-success", false, "Bayar");
                    snap.pay(response.data.snapToken, {
                        onSuccess: function(result) {
                            handleSuccess("Transaksi Berhasil", null, null, "/transaksi");
                        },
                        onPending: function(result) {
                            handleSuccess("Transaksi Berhasil", null, null, "/transaksi");
                        },
                        onError: function(result) {
                            console.log(result)
                        }
                    });
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#payMidtrans .btn.btn-success", false, "Bayar");
                    handleValidationErrors(error, "payMidtrans");
                };

                ajaxCall(url, "POST", null, successCallback, errorCallback);
            }
        });
    </script>
@endpush
