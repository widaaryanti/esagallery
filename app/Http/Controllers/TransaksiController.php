<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Midtrans\Snap;

class TransaksiController extends Controller
{
    use ApiResponder;

    public function cart()
    {
        $cart = DetailTransaksi::where('cart_id', auth()->user()->id)->whereNull('transaksi_id')->get();
        return view('pages.frontend.transaksi.cart', compact('cart'));
    }
    public function addCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang' => 'required|exists:barangs,id',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $barang = Barang::find($request->barang);
        $cart = DetailTransaksi::where('barang_id', $request->barang)->whereNull('transaksi_id')->where('cart_id', auth()->user()->id)->first();

        if (!$cart) {
            $cart = DetailTransaksi::create([
                'cart_id' => auth()->user()->id,
                'barang_id' => $request->barang,
                'quantity' => 1,
                'jumlah' => 1 * $barang->harga,
            ]);
        } else {
            $quantity = $cart->quantity + 1;
            $cart->update([
                'quantity' => $quantity,
                'jumlah' => $quantity * $barang->harga,
            ]);
        }

        $count = DetailTransaksi::whereNull('transaksi_id')->where('cart_id', auth()->user()->id)->count();

        return $this->successResponse(compact('cart', 'count'), 'Data ditambahkan ke keranjang.');
    }

    public function index()
    {
        $transaksi = Transaksi::with('user')->where('user_id', auth()->user()->id)->latest()->get();
        return view('pages.frontend.transaksi.index', compact('transaksi'));
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
}
