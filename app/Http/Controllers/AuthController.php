<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


}
