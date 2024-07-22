<footer class="bg-dark py-5">
    <div class="container text-white">
        <div class="row">
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d989.4120021543815!2d108.20866526951015!3d-7.2808309995454055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMTYnNTEuMCJTIDEwOMKwMTInMzMuNSJF!5e0!3m2!1sid!2sid!4v1721607076475!5m2!1sid!2sid" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></>
            </div>
        </div>
    </div>
</footer>
