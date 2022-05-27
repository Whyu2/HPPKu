<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');
    }
    public function home()
    {
        return view('home.home');
    }
    public function auth(Request $request)
    {
        $credentials =$request -> validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->intended('/admin');
            }
            if ($user->level == 'user') {
                return redirect()->intended('/user');
            }
        }
    return back()->with('loginError','Username & Password Tidak Sesuai!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/')->with('loginError','Berhasil Logout!');
    }
}


