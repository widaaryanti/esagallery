<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TentangController extends Controller
{
    public function index()
    {
        return view('pages.frontend.tentang.index');
    }
}
