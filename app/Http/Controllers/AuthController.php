<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $status = Password::sendResetLink($request->only('email'));

            if ($status === Password::RESET_LINK_SENT) {
                return $this->successResponse(null, 'Reset password email terkirim.');
            } else {
                return $this->errorResponse(null, 'Reset password email gagal dikirim.');
            }
        }

        return view('pages.auth.forgot-password');
    }

    public function resetPassword(Request $request, $token = null)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'token' => 'required',
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|min:8|same:password',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return $this->successResponse(null, 'Password berhasil direset.');
            } else {
                return $this->errorResponse(null, 'Password gagal direset.');
            }
        }
        return view('pages.auth.reset-password', compact('token'));
    }
}
