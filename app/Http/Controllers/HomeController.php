<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use App\Notifications\InvoicePaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        // dd(Auth::check());
        // dd(Auth::id());
        // dd(Auth::user());
        $user = User::find(1);
        $user->notify(new InvoicePaid());
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
