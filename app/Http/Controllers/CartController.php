<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CartController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        $cart = DetailTransaksi::with('barang')->where('cart_id', auth()->user()->id)->whereNull('transaksi_id')->get();
        if ($request->ajax()) {
            if ($request->mode == "datatable") {
                return DataTables::of($cart)
                    ->addColumn('jumlah', function ($detail) {
                        return formatRupiah($detail->jumlah);
                    })
                    ->addColumn('harga', function ($detail) {
                        return formatRupiah($detail->barang->harga);
                    })
                    ->addColumn('barang', function ($detail) {
                        return $detail->barang->nama;
                    })
                    ->addColumn('aksi', function ($detail) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(`createModal`, `/cart/' . $detail->id . '`, [`id`, `quantity`])"><i class="bi bi-pencil-square"></i></button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDeleteCart(`/cart/' . $detail->id . '`, `cart-table`)"><i class="bi bi-trash"></i></button>';
                        return $editButton . $deleteButton;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'jumlah', 'harga', 'barang'])
                    ->make(true);
            }

            $total = formatRupiah($cart->sum('jumlah') ?? 0);
            $count = $cart->count();
            return $this->successResponse(compact('total', 'count'), 'Data keranjang ditemukan.');
        }

        return view('pages.frontend.cart.index', compact('cart'));
    }

    public function store(Request $request)
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

    public function show($id)
    {
        $cart = DetailTransaksi::with('barang')->where('cart_id', auth()->user()->id)->where('id', $id)->first();

        if (!$cart) {
            return $this->errorResponse(null, 'Data tidak ditemukan.', 404);
        }

        return $this->successResponse($cart, 'Data ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $cart = DetailTransaksi::where('cart_id', auth()->user()->id)->where('id', $id)->first();

        if (!$cart) {
            return $this->errorResponse(null, 'Data tidak ditemukan.', 404);
        }

        $cart->update([
            'quantity' => $request->quantity,
            'jumlah' => $request->quantity * $cart->barang->harga,
        ]);

        return $this->successResponse(null, 'Data di update.');
    }

    public function destroy($id)
    {
        $cart = DetailTransaksi::where('cart_id', auth()->user()->id)->where('id', $id)->first();

        if (!$cart) {
            return $this->errorResponse(null, 'Data tidak ditemukan.', 404);
        }

        $cart->delete();
        return $this->successResponse(null, 'Data di hapus dari keranjang.');
    }
}
