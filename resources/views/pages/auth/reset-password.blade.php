@extends('layouts.auth')

@section('title', 'Reset Password')

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
                <form id="reset-password" autocomplete="off">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $_GET['email'] }}">
                    <div class="form-group mb-3">
                        <label for="password" class="control-label">Password <span class="text-danger">*</span></label>
                        <input id="password" type="password" class="form-control" name="password">
                        <small class="invalid-feedback" id="errorpassword"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <small class="invalid-feedback" id="errorpassword_confirmation"></small>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary btn-block shadow-lg">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#reset-password").submit(function(e) {
                setButtonLoadingState("#reset-password .btn.btn-primary", true, "Reset Password");
                e.preventDefault();
                const url = "{{ route('password.update') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#reset-password .btn.btn-primary", false, "Reset Password");
                    handleSuccess(response, null, null, "/");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#reset-password .btn.btn-primary", false, "Reset Password");
                    handleValidationErrors(error, "reset-password", ["email", "password",
                        "password_confirmation"
                    ]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
