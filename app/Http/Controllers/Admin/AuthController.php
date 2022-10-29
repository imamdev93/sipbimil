<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only('username', 'password'))) {
                return redirect()->route('admin.loginView')->with('error', 'Gagal Login');
            }
            return redirect()->route('admin.dashboard')->with('success', 'Berhasil Login');
        } catch (\Throwable $th) {
            return redirect()->route('admin.loginView')->with('error', $th->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.loginView')->with('success', 'Berhasil Logout');
    }
}
