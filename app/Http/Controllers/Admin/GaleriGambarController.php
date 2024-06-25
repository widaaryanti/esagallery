<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriGambar;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class GaleriGambarController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $galeriId = $request->kode_galeri;
            $galeries = GaleriGambar::where('galeri_id', $galeriId)->get();
            if ($request->mode == "datatable") {
                return DataTables::of($galeries)
                    ->addColumn('aksi', function ($galeri) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(`createModal`, `/admin/galeri-gambar/' . $galeri->id . '`, [`id`])"><i class="bi bi-pencil-square me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(`/admin/galeri-gambar/' . $galeri->id . '`, `galeri-table`)"><i class="bi bi-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addColumn('gambar', function ($galeri) {
                        return '<img src="/storage/galeri/gambar/' . $galeri->gambar . '" width="400px" alt="">';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'gambar'])
                    ->make(true);
            }

            return $this->successResponse($galeries, 'Data Galeri Gambar ditemukan.');
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar')->hashName();
            $request->file('gambar')->storeAs('public/galeri/gambar', $file);
        }

        $galeri = GaleriGambar::create([
            'galeri_id' => $request->galeri_id,
            'gambar' => $file,
        ]);

        return $this->successResponse($galeri, 'Data Galeri Gambar ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $galeri = GaleriGambar::find($id);

            if (!$galeri) {
                return $this->errorResponse(null, 'Data Galeri Gambar tidak ditemukan.', 404);
            }

            return $this->successResponse($galeri, 'Data Galeri Gambar ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $galeri = GaleriGambar::find($id);

        if (!$galeri) {
            return $this->errorResponse(null, 'Data Galeri Gambar tidak ditemukan.', 404);
        }

        $file = $galeri->gambar;

        if ($request->hasFile('gambar')) {
            Storage::delete('public/galeri/gambar/' . $galeri->gambar);
            $file = $request->file('gambar')->hashName();
            $request->file('gambar')->storeAs('public/galeri/gambar', $file);
        }

        $galeri->update([
            'gambar' => $file,
        ]);

        return $this->successResponse($galeri, 'Data Galeri Gambar diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = GaleriGambar::find($id);

        if (!$galeri) {
            return $this->errorResponse(null, 'Data Galeri Gambar tidak ditemukan.', 404);
        }
        Storage::delete('public/galeri/gambar/' . $galeri->gambar);
        $galeri->delete();
        return $this->successResponse(null, 'Data Galeri Gambar dihapus.');
    }
}
