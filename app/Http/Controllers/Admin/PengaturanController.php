<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaturanController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        $pengaturan = Pengaturan::find(1);
        if ($request->isMethod('put')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required',
                'alamat' => 'required',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                'deskripsi' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $pengaturan = Pengaturan::find(1);

            if (!$pengaturan) {
                return $this->errorResponse(null, 'Data Pengaturan tidak ditemukan.', 404);
            }

            $pengaturan->update($request->only('nama', 'email', 'no_hp', 'alamat', 'deskripsi'));

            return $this->successResponse($pengaturan, 'Data Pengaturan diubah.');
        }
        return view('pages.admin.pengaturan.index', compact('pengaturan'));
    }
}
