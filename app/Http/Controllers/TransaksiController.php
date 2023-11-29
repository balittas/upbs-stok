<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart_count = Cart::all()->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->where('status', '=', "Pending")->count();
        $transactions = Transaction::where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->get();
        return view('user.transaksi', compact('transactions', 'cart_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaction::find($id);
        $cart_count = Cart::all()->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->where('status', '=', "Pending")->count();
        $cart = DB::table('carts')
            ->leftJoin('detail_products', 'carts.detail_product_id', '=', 'detail_products.id')
            ->leftJoin('products', 'detail_products.product_id', '=', 'products.id')
            ->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
            ->where('transaction_id', '=', $id)
            ->get();
        $map = explode(',', $data->coordinate_map);
        $lat = $map[0];
        $lng = $map[1];
        return view('user.transaksi-detail', compact('data', 'cart_count', 'cart', 'lat', 'lng'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
