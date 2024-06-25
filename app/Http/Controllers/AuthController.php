<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponder;

    public function login(Request $request)
    {
        if (auth()->check()) {
            return redirect('/admin/dashboard');
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            if (!auth()->attempt($request->only('email', 'password'))) {
                return $this->errorResponse(null, 'Password  tidak valid.', 401);
            }

            $user = auth()->user();
            return $this->successResponse($user, 'Login berhasil.');
        }

        return view('pages.auth.login');
    }

    public function register(Request $request)
    {
        if (auth()->check()) {
            return redirect('/admin/dashboard');
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $user = User::create($request->only('nama', 'email', 'password'));

            if (!auth()->attempt($request->only('email', 'password'))) {
                return $this->errorResponse(null, 'Password  tidak valid.', 401);
            }

            $auth = auth()->user();
            return $this->successResponse($auth, 'Register berhasil.');
        }

        return view('pages.auth.register');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
