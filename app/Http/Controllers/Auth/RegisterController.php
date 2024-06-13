<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.unique' => 'Username sudah digunakan. Harap pilih yang lain.',
        ]);
        // Memeriksa apakah username sudah ada dalam basis data
        $existingUser = User::where('username', $request->username)->first();
        if ($existingUser) {
            return redirect()->back()->withErrors(['username' => 'Username sudah digunakan. Harap pilih yang lain.'])->withInput();
        }
        // Jika username tersedia, lanjutkan dengan proses registrasi
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/login')->with('success', 'Registrasi berhasil. Anda sekarang dapat login.');
    }
}