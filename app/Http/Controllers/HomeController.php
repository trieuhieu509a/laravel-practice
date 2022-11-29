<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        // dd(Auth::check());
        // dd(Auth::id());
        // dd(Auth::user());
        User::find(3)->blogPosts()->where('title', 'LIKE', "%a%")->get();
        User::with(['blogPosts'])->where('name', 'LIKE', "%a%")->get();
        return view('home.index');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function secret()
    {
        return view('secret');
    }
}
