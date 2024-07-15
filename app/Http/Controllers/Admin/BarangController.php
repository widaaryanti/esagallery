<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BarangController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $barang = Barang::with('kategori')->get();
            if ($request->mode == "datatable") {
                return DataTables::of($barang)
                    ->addColumn('kategori', function ($barang) {
                        return $barang->kategori->nama;
                    })
                    ->addColumn('aksi', function ($barang) {
                        $detailButton = '<a class="btn btn-sm btn-info me-1 d-inline-flex" href="/admin/barang/' . $barang->id . '"><i class="bi bi-info-circle me-1"></i>Detail</a>';
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(\'createModal\', \'/admin/barang/' . $barang->id . '\', [\'id\', \'kategori_id\', \'nama\', \'deskripsi\', \'harga\', \'stok\'])"><i class="bi bi-pencil-square me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(\'/admin/barang/' . $barang->id . '\', \'barang-table\')"><i class="bi bi-trash me-1"></i>Hapus</button>';
                        return $detailButton . $editButton . $deleteButton;
                    })
                    ->addColumn('harga', function ($barang) {
                        return formatRupiah($barang->harga);
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'harga', 'kategori'])
                    ->make(true);
            }

            return $this->successResponse($barang, 'Data Barang ditemukan.');
        }

        $kategori = Kategori::all();
        return view('pages.admin.barang.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategoris,id',
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $barang = Barang::create($request->only('kategori_id', 'nama', 'deskripsi', 'harga'));
        return $this->successResponse($barang, 'Data Barang ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $barang = Barang::with('kategori')->find($id);

            if (!$barang) {
                return $this->errorResponse(null, 'Data Barang tidak ditemukan.', 404);
            }

            return $this->successResponse($barang, 'Data Barang ditemukan.');
        }
        $barang = Barang::with('kategori')->find($id);

        return view('pages.admin.barang.show', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategoris,id',
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $barang = Barang::find($id);

        if (!$barang) {
            return $this->errorResponse(null, 'Data Barang tidak ditemukan.', 404);
        }

        $barang->update($request->only('kategori_id', 'nama', 'deskripsi', 'harga'));
        return $this->successResponse($barang, 'Data Barang diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return $this->errorResponse(null, 'Data Barang tidak ditemukan.', 404);
        }

        $barang->delete();
        return $this->successResponse(null, 'Data Barang dihapus.');
    }
}
