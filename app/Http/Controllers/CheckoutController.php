<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DetailProduct;
use App\Models\Province;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sub_total = $request->sub_total;
        $ongkir = $request->ongkir_total;
        $total = $request->total;
        $cart_count = Cart::all()->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->where('status', '=', "Pending")->count();
        $provinces = Province::pluck('name', 'province_id');
        $cart = DB::table('carts')
            ->leftJoin('detail_products', 'carts.detail_product_id', '=', 'detail_products.id')
            ->leftJoin('products', 'detail_products.product_id', '=', 'products.id')
            ->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
            ->where('status', '=', "Pending")
            ->get();
        return view('user.checkout', compact('cart_count', 'sub_total', 'ongkir', 'total', 'cart', 'provinces'));
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
        $transaction = new Transaction();
        $transaction->id = Str::random(16) . Carbon::now()->format('YmdHis');
        $transaction->user_id = Auth::user()->id;
        $transaction->paid_total = $request->paid_total;
        $transaction->status = "Process";
        $transaction->alamat = $request->alamat;
        $transaction->zip_code = $request->zip_code;
        $transaction->kabupaten_kota = $request->city_destination;
        $transaction->provinsi = $request->province_destination;
        $transaction->no_hp = $request->no_hp;
        $transaction->nama_penerima = $request->nama_penerima;
        $transaction->coordinate_map = $request->coordinate_map;

        $image_bukti_transfer_produk = 'bukti_transfer_produk' . Str::random(10) . '.' . $request->bukti_transfer_produk->getClientOriginalExtension();
        $request->bukti_transfer_produk->move(public_path('images'), $image_bukti_transfer_produk);
        $transaction->bukti_transfer_produk = 'images/' . $image_bukti_transfer_produk;

        $image_bukti_transfer_ongkir = 'bukti_transfer_ongkir' . Str::random(10) . '.' . $request->bukti_transfer_ongkir->getClientOriginalExtension();
        $request->bukti_transfer_ongkir->move(public_path('images'), $image_bukti_transfer_ongkir);
        $transaction->bukti_transfer_ongkir = 'images/' . $image_bukti_transfer_ongkir;

        $transaction->total_produk = $request->sub_total;
        $transaction->total_ongkir = $request->ongkir;
        $transaction->order_notes = $request->order_notes;

        if ($transaction->save()) {
            $cart = Cart::where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
                ->where('status', '=', "Pending")
                ->update(['status' =>  "Process", 'transaction_id' =>  $transaction->id]);
            if ($cart) {
                $cart_product = Cart::where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
                    ->where('transaction_id', '=', $transaction->id)
                    ->get();

                foreach ($cart_product as $cp) {
                    $detail_product = DetailProduct::find($cp->detail_product_id);
                    if ($detail_product->sisa > 0) {
                        $stok = $detail_product->sisa - $cp->qty;
                        if ($stok >= 0) {
                            $detail_product->sisa = $stok;
                            $detail_product->keluar_komersial = $detail_product->keluar_komersial + $cp->qty;
                            $detail_product->save();
                        }
                    } else if ($detail_product->produksi > 0) {
                        $stok = $detail_product->produksi - $cp->qty;
                        if ($stok >= 0) {
                            $detail_product->produksi = $stok;
                            $detail_product->keluar_komersial = $detail_product->keluar_komersial + $cp->qty;
                            $detail_product->save();
                        }
                    } else if ($detail_product->masuk > 0) {
                        $stok = $detail_product->masuk - $cp->qty;
                        if ($stok >= 0) {
                            $detail_product->masuk = $stok;
                            $detail_product->keluar_komersial = $detail_product->keluar_komersial + $cp->qty;
                            $detail_product->save();
                        }
                    }
                }
                return redirect()->route('produk.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
