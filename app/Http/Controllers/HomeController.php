<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $data = User::has("blogPosts.comments")->where('id', 1)->get();
        $data = User::whereHas("blogPosts.comments")->where('id', 1)->get();
        dd($data);
        // dd(Auth::check());
        // dd(Auth::id());
        // dd(Auth::user());
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
