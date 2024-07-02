<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {

        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        if ($request->ajax()) {
            $transaksis = Transaksi::with('user')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->latest()->get();
            if ($request->mode == "datatable") {
                return DataTables::of($transaksis)
                    ->addColumn('total', function ($transaksi) {
                        return formatRupiah($transaksi->total);
                    })
                    ->addColumn('tanggal', function ($transaksi) {
                        return formatTanggal($transaksi->created_at);
                    })
                    ->addColumn('customer', function ($transaksi) {
                        return $transaksi->user->nama;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['total', 'tanggal', 'customer'])
                    ->make(true);
            }
        }

        return view('pages.admin.transaksi.index');
    }
}