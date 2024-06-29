<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();
            if ($request->mode == "datatable") {
                return DataTables::of($users)
                    ->addColumn('aksi', function ($user) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(`createModal`, `/admin/user/' . $user->id . '`, [`id`, `nama`, `email`, `no_hp`, `alamat`, `role`])"><i class="bi bi-pencil-square me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(`/admin/user/' . $user->id . '`, `user-table`)"><i class="bi bi-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($users, 'Data User ditemukan.');
        }

        return view('pages.admin.user.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'no_hp' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $user = User::create($request->only('nama', 'email', 'password', 'no_hp', 'alamat', 'role'));

        return $this->successResponse($user, 'Data User ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = User::find($id);

            if (!$user) {
                return $this->errorResponse(null, 'Data User tidak ditemukan.', 404);
            }

            return $this->successResponse($user, 'Data User ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'no_hp' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $user = User::find($id);

        if (!$user) {
            return $this->errorResponse(null, 'Data User tidak ditemukan.', 404);
        }

        $user->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? $request->input('password') : $user->password,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => $request->role
        ]);

        return $this->successResponse($user, 'Data User diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->errorResponse(null, 'Data User tidak ditemukan.', 404);
        }

        $user->delete();
        return $this->successResponse(null, 'Data User dihapus.');
    }
}