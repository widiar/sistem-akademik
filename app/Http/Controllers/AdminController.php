<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function login()
    {
        if (Auth::check()) return redirect()->route('admin.dashboard');
        else return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else return redirect()->route('admin.login')->with('status', 'Username atau Password anda salah')->withInput();
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
