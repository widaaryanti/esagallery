<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with('galeriGambars')->inRandomOrder()->limit(6)->get();
        return view('pages.frontend.home.index', compact('galeri'));
    }
}
