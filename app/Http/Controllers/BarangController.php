<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with('kategori', 'barangGambars');

        if ($request->has('search')) {
            $query = $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && $request->kategori != "Semua") {
            $query = $query->where('kategori_id', $request->kategori);
        }

        $barang = $query->paginate(12);

        if ($request->ajax()) {
            return view('pages.frontend.barang.data', compact('barang'))->render();
        }

        $kategoris = Kategori::all();
        return view('pages.frontend.barang.index', compact('kategoris'));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('pages.frontend.barang.show', compact('barang'));
    }
}
