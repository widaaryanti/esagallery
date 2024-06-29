<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.frontend.home.index');
    }

    public function galeri()
    {
        return view('pages.frontend.galeri');
    }
}
