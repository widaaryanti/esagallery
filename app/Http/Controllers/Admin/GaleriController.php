<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Kategori;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class GaleriController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $galeri = Galeri::all();
            if ($request->mode == "datatable") {
                return DataTables::of($galeri)
                    ->addColumn('aksi', function ($galeri) {
                        $detailButton = '<a class="btn btn-sm btn-info me-1 d-inline-flex" href="/admin/galeri/' . $galeri->id . '"><i class="bi bi-info-circle me-1"></i>Detail</a>';
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(`createModal`, `/admin/galeri/' . $galeri->id . '`, [`id`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `deskripsi`])"><i class="bi bi-pencil-square me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(`/admin/galeri/' . $galeri->id . '`, `galeri-table`)"><i class="bi bi-trash me-1"></i>Hapus</button>';
                        return $detailButton .$editButton . $deleteButton;
                    })
                    ->addColumn('tanggal_mulai', function ($galeri) {
                        return formatTanggal($galeri->tanggal_mulai, 'd F Y');
                    })
                    ->addColumn('tanggal_selesai', function ($galeri) {
                        return formatTanggal($galeri->tanggal_selesai, 'd F Y');
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'tanggal_mulai', 'tanggal_selesai'])
                    ->make(true);
            }

            return $this->successResponse($galeri, 'Data Galeri ditemukan.');
        }

        return view('pages.admin.galeri.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $galeri = Galeri::create($request->only('nama', 'tanggal_mulai', 'tanggal_selesai', 'deskripsi'));
        return $this->successResponse($galeri, 'Data Galeri ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $galeri = Galeri::with('kategori')->find($id);
            
            if (!$galeri) {
                return $this->errorResponse(null, 'Data Galeri tidak ditemukan.', 404);
            }
            
            return $this->successResponse($galeri, 'Data Galeri ditemukan.');
        }
        
        $galeri = Galeri::find($id);
        return view('pages.admin.galeri.show', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $galeri = Galeri::find($id);

        if (!$galeri) {
            return $this->errorResponse(null, 'Data Galeri tidak ditemukan.', 404);
        }

        $galeri->update($request->only('nama', 'tanggal_mulai', 'tanggal_selesai', 'deskripsi'));
        return $this->successResponse($galeri, 'Data Galeri diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return $this->errorResponse(null, 'Data Galeri tidak ditemukan.', 404);
        }

        $galeri->delete();
        return $this->successResponse(null, 'Data Galeri dihapus.');
    }
}
