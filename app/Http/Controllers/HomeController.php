<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function contact()
    {
        $cart_count = Cart::all()->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->where('status', '=', "Pending")->count();
        return view('user.contact', compact('cart_count'));
    }
}
