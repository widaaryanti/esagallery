@extends('layouts.frontend')

@section('title', 'Profile')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('main')
    <header class="py-5 min-vh-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="text-dark">Data @yield('title')</h4>
                        </div>
                        <div class="card-body">
                            <form id="updateData">
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ auth()->user()->nama }}">
                                    <small class="invalid-feedback" id="errornama"></small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ auth()->user()->email }}">
                                    <small class="invalid-feedback" id="erroremail"></small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_hp" class="form-label">No HP <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->no_hp }}"
                                        id="no_hp" name="no_hp">
                                    <small class="invalid-feedback" id="errorno_hp"></small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="alamat" class="form-label">Alamat <span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" id="alamat" rows="4" name="alamat">{{ auth()->user()->alamat }}</textarea>
                                    <small class="invalid-feedback" id="erroralamat"></small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-dark">Ubah Password</h4>
                        </div>
                        <div class="card-body">
                            <form id="updatePassword">
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="password_lama" class="form-label">Password Lama <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_lama" name="password_lama">
                                    <small class="invalid-feedback" id="errorpassword_lama"></small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password Baru <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <small class="invalid-feedback" id="errorpassword"></small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                    <small class="invalid-feedback" id="errorpassword_confirmation"></small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $("#updateData").submit(function(e) {
                setButtonLoadingState("#updateData .btn.btn-primary", true);
                e.preventDefault();
                const url = `{{ route('profile') }}`;
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#updateData .btn.btn-primary", false);
                    handleSuccess(response, null, null, "no");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#updateData .btn.btn-primary", false);
                    handleValidationErrors(error, "updateData", ["nama", "email", "no_hp", "alamat"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

            $("#updatePassword").submit(function(e) {
                setButtonLoadingState("#updatePassword .btn.btn-primary", true);
                e.preventDefault();
                const url = `{{ route('profile.password') }}`;
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#updatePassword .btn.btn-primary", false);
                    handleSuccess(response, null, null, "no");
                    $('#updatePassword .form-control').removeClass("is-invalid").val("");
                    $('#updatePassword .invalid-feedback').html("");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#updatePassword .btn.btn-primary", false);
                    handleValidationErrors(error, "updatePassword", ["password_lama", "password"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
