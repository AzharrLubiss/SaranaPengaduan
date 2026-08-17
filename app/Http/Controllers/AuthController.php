<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $nisn = $request->nisn;
        $pw = $request->password;

        $login = Auth::attempt(['nisn' => $nisn, 'password'=>$pw]);
        if($login){
            return redirect()->route('home');
        }else{
            return redirect()->route('login')->with('error', 'NISN atau Password salah');
        }


    }

    public function registrasi(Request $request){
        
        $request->validate([
            'nisn'=>'max:4|required|unique:siswas',
            'nama'=>'string|max:255|required',
            'kelas'=>'string|max:35|required',
            'password'=>'max:255|required'
        ]);
        
        Siswa::create([
            'nisn'=>$request->nisn,
            'nama'=>$request->nama,
            'kelas'=>$request->kelas,
            'password'=>Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }


}
