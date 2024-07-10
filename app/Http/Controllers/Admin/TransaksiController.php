<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Transaction;
use PDF;
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
                    ->addColumn('status', function ($transaksi) {
                        return formatStatusLabel($transaksi->status);
                    })
                    ->addColumn('aksi', function ($transaksi) {
                        $detailButton = '<a class="btn btn-sm btn-info me-1 d-inline-flex" href="/admin/transaksi/' . $transaksi->id . '"><i class="bi bi-info-circle me-1"></i>Detail</a>';
                        if ($transaksi->status == 'pending') {
                            $confirmationButton = '<button class="btn btn-sm btn-success d-inline-flex" onclick="confirmTransaction(`' . $transaksi->id . '`)"><i class="bi bi-check-circle me-1"></i>Konfirmasi</button>';
                            return $detailButton . $confirmationButton;
                        } elseif ($transaksi->status == 'disetujui') {
                            $cetakButton = '<a class="btn btn-sm btn-primary me-1 d-inline-flex" href="/admin/transaksi/struk/' . $transaksi->id . '"><i class="bi bi-printer me-1"></i>Cetak</a>';
                            return $detailButton . $cetakButton;
                        } else {
                            return $detailButton;
                        }
                    })
                    ->addIndexColumn()
                    ->rawColumns(['total', 'tanggal', 'customer', 'status', 'aksi'])
                    ->make(true);
            }
        }

        if ($request->mode == "pdf") {
            $bulanTahun = formatTanggal($tahun . "-" . $bulan . "-01", 'F Y');
            $pdf = PDF::loadView('pages.admin.transaksi.pdf', ['transaksis' => $transaksis->where('status', 'disetujui'), 'bulanTahun' => $bulanTahun]);

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

    public function update(Request $request, $id)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return $this->errorResponse(null, 'Transaksi tidak ditemukan.', 404);
        }
        if ($request->status == 'disetujui') {
            try {
                $responseData = Transaction::status($transaksi->kode_transaksi);

                if ($responseData->transaction_status == 'settlement') {
                    $transaksi->update([
                        'status' => 'disetujui',
                    ]);
                } else {
                    $transaksi->update([
                        'status' => 'ditolak',
                    ]);
                }
            } catch (\Exception $e) {
                $transaksi->update([
                    'status' => 'ditolak',
                ]);
            }
        } elseif ($request->status == 'ditolak') {
            $transaksi->update([
                'status' => 'ditolak',
            ]);
        }

        return $this->successResponse($transaksi, 'Status transaksi diupdate.');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('detailTransaksis', 'user')->findOrFail($id);
        return view('pages.admin.transaksi.show', compact('transaksi'));
    }

    public function struk($id)
    {
        $transaksi = Transaksi::with('detailTransaksis', 'user')->where('status', 'disetujui')->findOrFail($id);
        $pdf = PDF::loadView('pages.admin.transaksi.struk', compact('transaksi'));
        $options = [
            'margin_top' => 0,
            'margin_right' => 0,
            'margin_bottom' => 0,
            'margin_left' => 0,
        ];

        $pdf->setOptions($options);
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan Transaksi ' . $transaksi->kode_transaksi . '.pdf');
    }

}