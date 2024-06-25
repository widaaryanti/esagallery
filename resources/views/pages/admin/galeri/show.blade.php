@extends('layouts.admin')

@section('title', 'Galeri')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/compiled/css/table-datatable-jquery.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/extensions/dropify/css/dropify.css') }}">
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
                            <div class="row">
                                <div class="col-4">
                                    Nama
                                </div>
                                <div class="col-6 mb-2">
                                    : {{ $galeri->nama }}
                                </div>
                                <div class="col-4 mb-2">
                                    Deskripsi
                                </div>
                                <div class="col-6 mb-2">
                                    : {{ $galeri->deskripsi }}
                                </div>
                                <div class="col-4 mb-2">
                                    Tanggal Mulai
                                </div>
                                <div class="col-6 mb-2">
                                    : {{ formatTanggal($galeri->tanggal_mulai, 'd F Y') }}
                                </div>
                                <div class="col-4 mb-2">
                                    Tanggal Selesai
                                </div>
                                <div class="col-6 mb-2">
                                    : {{ formatTanggal($galeri->tanggal_selesai, 'd F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Data Galeri Gambar</h5>
                                <div>
                                    <button class="btn btn-success btn-sm" onclick="getModal('createModal'), clearImage()">
                                        <i class="bi bi-plus me-2"></i>Tambah
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="galeri-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Foto</th>
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <input type="hidden" value="{{ $galeri->id }}" id="kode_galeri">
    @include('pages.admin.galeri.modal-gambar')
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin/extensions/dropify/js/dropify.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            datatableCall('galeri-table', '{{ route('admin.galeri-gambar.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'gambar',
                    name: 'foto'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]);

            $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-primary", true);
                e.preventDefault();
                const kode = $("#saveData #id").val();
                let url = "{{ route('admin.galeri-gambar.store') }}";
                const data = new FormData(this);
                data.append("galeri_id", {{ $galeri->id }})
                if (kode !== "") {
                    data.append("_method", "PUT");
                    url = `/admin/galeri-gambar/${kode}`;
                }

                const successCallback = function(response) {
                    $('#saveData #gambar').parent().find(".dropify-clear").trigger('click');
                    setButtonLoadingState("#saveData .btn.btn-primary", false);
                    handleSuccess(response, "galeri-table", "createModal");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false);
                    handleValidationErrors(error, "saveData", ["gambar"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

        });

        const clearImage = () => {
            $('#saveData #gambar').val('').trigger('change');
        }
    </script>
@endpush
