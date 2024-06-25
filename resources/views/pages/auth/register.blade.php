@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('main')
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-5 col-md-7 col-12">
            <div class="card card-body p-4">
                <div class="text-center mb-3">
                    <img src="{{ asset('logo.jpg') }}" class="img-fluid" width="200px" alt="Logo - {{ config('app.name') }}">
                </div>
                <h4 class="mb-3 text-center">@yield('title')</h4>
                <form id="register" autocomplete="off">
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <small class="invalid-feedback" id="errornama"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email">
                        <small class="invalid-feedback" id="errornama"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="invalid-feedback" id="errorpassword"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <small class="invalid-feedback" id="errorpassword_confirmation"></small>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary btn-block shadow-lg">Register</button>
                    </div>
                </form>
                <div class="text-center">
                    Sudah punya akun?
                    <a href="{{ url('/login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#register").submit(function(e) {
                setButtonLoadingState("#register .btn.btn-primary", true, "Register");
                e.preventDefault();
                const url = "{{ route('register') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#register .btn.btn-primary", false, "Register");
                    handleSuccess(response, null, null, "/admin/dashboard");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#register .btn.btn-primary", false, "Register");
                    handleValidationErrors(error, "register", ["email", "nama", "password"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
