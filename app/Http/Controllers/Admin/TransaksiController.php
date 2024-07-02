<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use Midtrans\Config;
use App\Models\Transaksi;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {

        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $transaksis = Transaksi::with('user')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->latest()->get();
        if ($request->ajax()) {
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

        if ($request->mode == "pdf") {
            $bulanTahun = formatTanggal($tahun . "-" . $bulan . "-01", 'F Y');
            $pdf = PDF::loadView('pages.admin.transaksi.pdf', ['transaksis' => $transaksis, 'bulanTahun' => $bulanTahun]);

            $options = [
                'margin_top' => 0,
                'margin_right' => 0,
                'margin_bottom' => 0,
                'margin_left' => 0,
            ];

            $pdf->setOptions($options);
            $pdf->setPaper('a4', 'landscape');

            return $pdf->stream('Laporan Transaksi ' . $bulanTahun . '.pdf');
        }

        return view('pages.admin.transaksi.index');
    }

    public function updateStatus(Request $request)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    
        $twentyFourHoursAgo = Carbon::now()->subHours(24);
    
        $transactions = Transaksi::where('status', 'pending')
                                 ->where('created_at', '>=', $twentyFourHoursAgo)
                                 ->get();
    
        foreach ($transactions as $transaction) {
            $responseData = \Midtrans\Transaction::status($transaction->kode_transaksi);
    
            if ($responseData['transaction_status'] == 'settlement') {
                $transaction->update([
                    'status' => 'disetujui',
                ]);
            }
        }

        return $this->successResponse(null, 'Status transaksi diupdate.');
    }
    
}
