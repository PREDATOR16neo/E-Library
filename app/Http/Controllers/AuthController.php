<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Genres;
use App\Models\Authors;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index()
    {
        $books        = Books::with(['genre', 'author'])->get();
        $totalBuku    = $books->count();
        $totalGenre   = \App\Models\Genres::count();
        $totalPenulis = \App\Models\Authors::count();

        return view('user.index', compact('books', 'totalBuku', 'totalGenre', 'totalPenulis'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
    $totalBuku    = \App\Models\Books::count();
    $totalGenre   = \App\Models\Genres::count();
    $totalPenulis = \App\Models\Authors::count();
    return view('index', compact('totalBuku', 'totalGenre', 'totalPenulis'));
    }

    public function actionLogin(Request $request){
        $login = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard')->with('success', 'Login Berhasil sebagai admin');
            }
            return redirect()->route('home')->with('success', 'Login Berhasil sebagai user');
        }

        // ← Ini yang penting, harus ada!
        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logout Berhasil');
    }

    public function ActionRegister(Request $request){
        $validation = $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8'
        ]);

        if(!$validation){
            return redirect()->back()->with('error', 'Isi yang benerlah kocak');
        }
        User::create([
            'name'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>'user'
        ]);
        return redirect()->route('login')->with('success', 'Berhasil Membuat Akun');
    }
}