<footer class="bg-dark py-5">
    <div class="container text-white">
        <div class="row">
            <div class="col-12 text-center text-lg-start mb-3">
                <img  src="{{ asset('logo.jpg') }}" class="rounded-3" width="100px"
                    alt="Logo - {{ config('app.name') }}">
            </div>
            <div class="col-lg-4 mb-3">
                <h5 class="fw-bold text-ajl-secondary mb-3">Hubungi Kami</h5>
                <div class="text-white list-group">
                    <div class="mb-2 d-flex align-items-center">
                        <i class="bi bi-envelope-fill  me-3"></i>
                        <span>{{ pengaturan()->email }}</span>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <i class="bi bi-telephone-fill  me-3"></i>
                        <span>{{ pengaturan()->no_hp }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <h5 class="fw-bold text-ajl-secondary mb-3">Kantor</h5>
                <div class="text-white list-group">
                    <div class="mb-2 d-flex align-items-start">
                        <i class="bi bi-geo-alt-fill  me-3"></i>
                        <span>{{ pengaturan()->alamat }}</span>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <img src="{{ asset('frontend/assets/whatsapp.svg') }}" width="16px" class="me-3"
                            alt="icon whatsapp">
                        <span>{{ pengaturan()->no_hp }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <h5 class="fw-bold text-ajl-secondary mb-3">Map</h5>
                <iframe
                    src="https://www.bing.com/ck/a?!&&p=d0ec3f1ef314fd2aJmltdHM9MTcxOTYxOTIwMCZpZ3VpZD0wNDBkZTJhZi1kYTQ2LTZjZjktMmNkZC1mNjBiZGIxMDZkZDYmaW5zaWQ9NTc2OQ&ptn=3&ver=2&hsh=3&fclid=040de2af-da46-6cf9-2cdd-f60bdb106dd6&u=a1L21hcHM_Jm1lcGk9MjN-flRvcE9mUGFnZX5NYXBfSW1hZ2UmdHk9MTgmcT1KYWxhbiUyME5hc2lvbmFsJTIwMyUyQyUyMEtlY2FtYXRhbiUyMFNpbmRhbmdrYXNpaCUyQyUyMENpYW1pcyUyMFJlZ2VuY3klMkMlMjBXZXN0JTIwSmF2YSUyMDQ2MjY4JnBwb2lzPS03LjI4MzE2OTE0MDQ2MzhfMTA4LjIxOTA0MjU5NDczM19KYWxhbiUyME5hc2lvbmFsJTIwMyUyQyUyMEtlY2FtYXRhbiUyMFNpbmRhbmdrYXNpaCUyQyUyMENpYW1pcyUyMFJlZ2VuY3klMkMlMjBXZXN0JTIwSmF2YSUyMDQ2MjY4X34mY3A9LTcuMjgzMTY5fjEwOC4yMTkwNDMmbHZsPTE2JnY9MiZzVj0xJkZPUk09TUlSRQ&ntb=1"
                    width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div
                class="col-12 d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between mt-3 gap-2">
                <div class="text-center text-lg-start">
                    Copyright © 2018 {{ config('app.name') }}
                </div>
                <div class="d-flex flex-column flex-lg-row text-center text-lg-start gap-2">
                    <div>
                        +6282126056028
                    </div>
                    <div>
                        esagalery76@gmail.com
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
