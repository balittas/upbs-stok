<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Carts;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('carts')
            ->join('detail_products', 'carts.detail_product_id', '=', 'detail_products.id')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->where('carts.user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
            ->where('carts.status', '=', 'Pending')
            ->select('carts.id as id', 'carts.qty as qty', 'products.id as product_id', 'products.name as name', 'products.image as image', 'products.price as price', 'products.unit as unit', 'products.description as description', 'products.slug as slug', 'detail_products.id as detail_product_id', 'detail_products.asal as asal', 'detail_products.panen as panen', 'detail_products.kelas as kelas', 'detail_products.db as db', 'detail_products.sisa as sisa', 'detail_products.produksi as produksi', 'detail_products.masuk as masuk', 'detail_products.keluar_komersial as keluar_komersial', 'detail_products.keluar_nonkomersial as keluar_nonkomersial', 'detail_products.tahun as tahun', 'detail_products.bulan as bulan',)
            ->get();
        $provinces = Province::pluck('name', 'province_id');
        $cart_count = Cart::all()->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->where('status', '=', 'Pending')->count();
        $berat = 0;
        $sub_total = 0;
        foreach ($data as $d) {
            if ($d->unit == 'kg') {
                $berat += $d->qty;
                $sub_total += $d->qty / 1000 * $d->price;
            } else {
                $berat += $d->qty;
                $sub_total += $d->qty * $d->price;
            }
        }
        return view('user.cart', compact('data', 'cart_count', 'provinces', 'berat', 'sub_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Cart();
        $table->id = Str::random(16) . Carbon::now()->format('YmdHis');
        $table->detail_product_id = $request->detail_product_id;
        $table->user_id = Auth::user() == null ? '' : Auth::user()->id;
        if ($request->unit == 'kg') {
            $table->qty = $request->qty * 1000;
        } else {
            $table->qty = $request->qty;
        }
        $table->status = "Pending";

        $table->save();

        $cart = Cart::all()->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->where('status', '=', "Pending")->count();
        return response()->json($cart);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Cart::find($id);
        $table->delete();
        return redirect()->back();
    }
}
