<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Barang;
use App\Models\Galeri;
use App\Models\Kategori;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard.index', [
            'user' => User::count(),
            'barang' => Barang::count(),
            'galeri' => Galeri::count(),
            'kategori' => Kategori::count(),
        ]);
    }
}