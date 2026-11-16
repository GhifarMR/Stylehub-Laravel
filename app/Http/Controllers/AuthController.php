<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('pages.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $berhasil = Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'status'=>'aktif'
        ]);

        if(!$berhasil) {
            return back()
                    ->withErrors(['email'=>'email atau password salah'])
                    ->onlyInput('email');
        }

        $request->session()->regenerate();

        if(Auth::user()->level == 'kasir') {
            return redirect('/transaksi');
        }

        return redirect('/produk');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
