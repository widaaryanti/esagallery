<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        $transaksis = Transaksi::with('user')->where('user_id', auth()->user()->id)->latest()->get();
        if ($request->ajax()) {
            if ($request->mode == "datatable") {
                return DataTables::of($transaksis)
                    ->addColumn('total', function ($transaksi) {
                        return formatRupiah($transaksi->total);
                    })
                    ->addColumn('tanggal', function ($transaksi) {
                        return formatTanggal($transaksi->created_at);
                    })
                    ->addColumn('status', function ($transaksi) {
                        return formatStatusLabel($transaksi->status);
                    })
                    ->addColumn('aksi', function ($transaksi) {
                        $detailButton = '<a class="btn btn-sm btn-info me-1 d-inline-flex" href="/transaksi/' . $transaksi->id . '"><i class="bi bi-info-circle me-1"></i>Detail</a>';
                        return $detailButton;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['total', 'tanggal', 'status', 'aksi'])
                    ->make(true);
            }
        }
        return view('pages.frontend.transaksi.index');
    }

    public function store(Request $request)
    {
        $cart = DetailTransaksi::with('barang')->where('cart_id', auth()->user()->id)->whereNull('transaksi_id')->get();

        if ($cart->count() < 1) {
            return $this->errorResponse(null, 'Keranjang kosong.', 404);
        }

        $dataTransaksi = Transaksi::create([
            'kode_transaksi' => getKodeTransaksi(),
            'user_id' => auth()->user()->id,
            'total' => $cart->sum('jumlah'),
            'status' => 'pending',
        ]);

        $itemDetails = [];

        foreach ($cart as $item) {
            $item->update([
                'transaksi_id' => $dataTransaksi->id,
                'cart_id' => null,
            ]);

            $itemDetails[] = [
                'id' => $item->id,
                'price' => $item->barang->harga,
                'quantity' => $item->quantity,
                'name' => $item->barang->nama,
            ];
        }

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $payload = [
            'transaction_details' => [
                'order_id' => $dataTransaksi->kode_transaksi,
                'gross_amount' => $dataTransaksi->total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => $itemDetails,
        ];

        $snapToken = Snap::getSnapToken($payload);

        $snapTokenData = [
            'snapToken' => $snapToken,
            'kode' => $dataTransaksi->kode_transaksi,
        ];

        return $this->successResponse($snapTokenData, 'Transaksi ditambahkan. Silahkan lakukan pembayaran.');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('detailTransaksis', 'user')->where('user_id', auth()->user()->id)->findOrFail($id);
        return view('pages.frontend.transaksi.show', compact('transaksi'));
    }

}
