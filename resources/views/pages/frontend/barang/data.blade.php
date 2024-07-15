@forelse ($barang as $row)
    <div class="col-lg-4 col-12 col-md-6 mb-3">
        <div class="card shadow-sm rounded-3 h-100">
            <div class="card-body p-0">
                <div class="mb-3">
                    <div class="owl-carousel owl-theme">
                        @forelse ($row->barangGambars as $barangGambars)
                            <div class="item">
                                <img src="/storage/galeri/barang/{{ $barangGambars->gambar }}" class="img-fluid-custom"
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
                <div class="p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="card-title fw-bold">{{ $row->nama }}</p>
                            <div class="mb-3 d-flex flex-column">
                                <small>Harga: {{ formatRupiah($row->harga) }}</small>
                                <small>Kategori : {{ $row->kategori->nama }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between gap-2">
                        @auth
                            <button onclick="addCart({{ $row->id }})" class="btn btn-success d-block w-100"><i
                                    class="bi bi-cart me-2"></i>Beli</button>
                            <a href="/barang/{{ $row->id }}" class="btn btn-outline-info d-flex"><i
                                    class="bi bi-eye me-2"></i>Detail</a>
                        @else
                            <a href="/barang/{{ $row->id }}" class="btn btn-outline-info d-block w-100"><i
                                    class="bi bi-eye me-2"></i>Detail</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="text-center my-5 py-5">
            <div class="fw-semibold">Barang Tidak Ditemukan</div>
        </div>
    </div>
@endforelse
<div class="col-12">
    <div class="d-flex justify-content-center">
        {!! $barang->links() !!}
    </div>
</div>
