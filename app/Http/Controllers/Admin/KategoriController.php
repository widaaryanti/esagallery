<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kategori = Kategori::all();
            if ($request->mode == "datatable") {
                return DataTables::of($kategori)
                    ->addColumn('aksi', function ($kategori) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(`createModal`, `/admin/kategori/' . $kategori->id . '`, [`id`, `nama`])"><i class="bi bi-pencil-square me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(`/admin/kategori/' . $kategori->id . '`, `kategori-table`)"><i class="bi bi-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($kategori, 'Data Kategori ditemukan.');
        }

        return view('pages.admin.kategori.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|unique:kategoris,nama',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $kategori = Kategori::create($request->only('nama'));
        return $this->successResponse($kategori, 'Data Kategori ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $kategori = Kategori::find($id);

            if (!$kategori) {
                return $this->errorResponse(null, 'Data Kategori tidak ditemukan.', 404);
            }

            return $this->successResponse($kategori, 'Data Kategori ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|unique:kategoris,nama,' . $id,
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $kategori = Kategori::find($id);

        if (!$kategori) {
            return $this->errorResponse(null, 'Data Kategori tidak ditemukan.', 404);
        }

        $kategori->update($request->only('nama'));
        return $this->successResponse($kategori, 'Data Kategori diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return $this->errorResponse(null, 'Data Kategori tidak ditemukan.', 404);
        }

        $kategori->delete();
        return $this->successResponse(null, 'Data Kategori dihapus.');
    }
}