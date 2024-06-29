@forelse ($galeri as $row)
    <div class="col-lg-4 col-12 col-md-6 mb-3">
        <a href="/galeri/{{ $row->id }}" class="text-decoration-none text-dark card shadow-sm rounded-3 h-100">
            <div class="card-body text-center p-0">
                <div class="mb-3">
                    <div class="owl-carousel owl-theme">
                        @forelse ($row->galeriGambars as $galeriGambars)
                            <div class="item">
                                <img src="/storage/galeri/gambar/{{ $galeriGambars->gambar }}" class="img-fluid-custom"
                                    alt="{{ $row->nama }}">
                            </div>
                        @empty
                            <div class="item">
                                <img src="{{ asset('frontend/assets/tidakada.jpg') }}" class="img-fluid-custom"
                                    alt="{{ $row->nama }}">
                            </div>
                        @endforelse
                    </div>
                </div>
                <p class="card-title fw-bold">{{ $row->nama }}</p>
                <small>{{ formatTanggal($row->tanggal_mulai, 'd F Y') . ' - ' . formatTanggal($row->tanggal_selesai, 'd F Y') }}</small>
                <p>{{ $row->deskripsi }}</p>
            </div>
        </a>
    </div>
@empty
    <div class="col-12">
        <div class="text-center my-5 py-5">
            <div class="fw-semibold">Galeri Tidak Ditemukan</div>
        </div>
    </div>
@endforelse
<div class="col-12">
    <div class="d-flex justify-content-center">
        {!! $galeri->links() !!}
    </div>
</div>
