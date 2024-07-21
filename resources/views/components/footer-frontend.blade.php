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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2301657818502!2d108.22444907412564!3d-7.3280259926802795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f575ac796e5bd%3A0x1266496f1d655684!2sUniversitas%20BSI%20Kampus%20Tasikmalaya!5e0!3m2!1sid!2sid!4v1721540388121!5m2!1sid!2sid"  width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</footer>
