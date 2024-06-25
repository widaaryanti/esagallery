@extends('layouts.auth')

@section('title', 'Login')

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
                <form id="login" autocomplete="off">
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input id="email" type="email" class="form-control" name="email">
                        <small class="invalid-feedback" id="erroremail"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input id="password" type="password" class="form-control" name="password">
                        <small class="invalid-feedback" id="errorpassword"></small>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary btn-block shadow-lg">Login</button>
                    </div>
                </form>
                <div class="text-center">
                    Belum punya akun?
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#login").submit(function(e) {
                setButtonLoadingState("#login .btn.btn-primary", true, "Login");
                e.preventDefault();
                const url = "{{ route('login') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#login .btn.btn-primary", false, "Login");
                    handleSuccess(response, null, null, "/admin/dashboard");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#login .btn.btn-primary", false, "Login");
                    handleValidationErrors(error, "login", ["email", "password"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
