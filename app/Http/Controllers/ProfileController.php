<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->isMethod('put')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required|email|unique:users,email,' . auth()->user()->id,
                'no_hp' => 'required',
                'alamat' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $user = auth()->user();

            if (!$user) {
                return $this->errorResponse(null, 'Data Profil tidak ditemukan.', 404);
            }

            $user->update($request->only('nama', 'email', 'no_hp', 'alamat'));

            return $this->successResponse($user, 'Data Profil diubah.');
        }

        return view('pages.frontend.profile');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $user = auth()->user();

        if (!$user) {
            return $this->errorResponse(null, 'Data Profil tidak ditemukan.', 404);
        }

        if (!Hash::check($request->password_lama, $user->password)) {
            return $this->errorResponse(null, 'Password lama tidak sesuai.', 422);
        }

        $user->update($request->only('password'));

        return $this->successResponse($user, 'Data password diubah.');
    }
}