<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Galeri;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $labels = [];
        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthString = date('Y') . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);

            $totalPerBulan = Transaksi::where('status', 'disetujui')
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $month)
                ->sum('total');

            $labels[] = Carbon::createFromFormat('Y-m', $monthString)->locale('id')->format('F');
            $data[] = $totalPerBulan;
        }

        $transaksi = [
            'labels' => $labels,
            'data' => $data,
        ];

        return view('pages.admin.dashboard.index', [
            'user' => User::count(),
            'barang' => Barang::count(),
            'galeri' => Galeri::count(),
            'kategori' => Kategori::count(),
            'transaksi' => $transaksi,
        ]);
    }
}