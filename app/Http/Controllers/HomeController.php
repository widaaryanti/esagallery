<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function tentang()
    {
        return view('pages.frontend.tentang');
    }
}
