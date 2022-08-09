<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserControl extends Controller
{
    public function view_register()
    {
        return view('auth.register');
    }

    public function view_login()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        try{
            $validate = $request->validate([
                'name' => 'required',
                'email' => 'required|email:dns',
                'password' => 'required|min:6'
            ]);

            $validate['password'] = bcrypt($validate['password']);

            User::create($validate);
            return redirect('/login')->with('success', 'Registrasi berhasil!');
        }catch(QueryException $e) {

            if($e->errorInfo[1] == 1062) {
    
                return redirect()->back()->with('error', 'Email sudah terdaftar!');
    
            } else {
                throw $e;
            }
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        
        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
