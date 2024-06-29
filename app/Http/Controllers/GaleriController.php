<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::with('galeriGambars');

        if ($request->has('search')) {
            $query = $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $galeri = $query->paginate(12);

        if ($request->ajax()) {
            return view('pages.frontend.galeri.data', compact('galeri'))->render();
        }
        return view('pages.frontend.galeri.index');
    }

    public function show($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('pages.frontend.galeri.show', compact('galeri'));
    }
}
