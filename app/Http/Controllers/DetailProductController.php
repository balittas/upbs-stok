<?php

namespace App\Http\Controllers;

use App\Models\DetailProduct;
use Illuminate\Http\Request;

class DetailProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DetailProduct::all();
        return view('user.product-details', compact('detail_products'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailProduct  $detailProduct
     * @return \Illuminate\Http\Response
     */
    public function show(DetailProduct $detailProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailProduct  $detailProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailProduct $detailProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailProduct  $detailProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailProduct $detailProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailProduct  $detailProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailProduct $detailProduct)
    {
        //
    }
}
