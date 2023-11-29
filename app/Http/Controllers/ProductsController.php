<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\DetailProduct;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = DetailProduct::with('product')->get();
        $cart_count = Cart::all()->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->where('status', '=', "Pending")->count();
        $category = ProductCategory::all();

        $products = DB::table('detail_products')
            ->leftJoin('products', 'detail_products.product_id', '=', 'products.id')
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select(
                'detail_products.id as id',
                'detail_products.asal as asal',
                'detail_products.panen as panen',
                'detail_products.kelas as kelas',
                'detail_products.db as db',
                'detail_products.sisa as sisa',
                'detail_products.produksi as produksi',
                'detail_products.masuk as masuk',
                'detail_products.keluar_komersial as keluar_komersial',
                'detail_products.keluar_nonkomersial as keluar_nonkomersial',
                'detail_products.tahun as tahun',
                'detail_products.bulan as bulan',
                'products.name as product_name',
                'products.image as image',
                'products.description as description',
                'products.unit as unit',
                'products.price as price',
                'products.slug as slug',
                'product_categories.name as category_name'
            )
            ->paginate(5);
        // dd($products);
        return view('user.products', compact('products', 'cart_count', 'category'));
    }

    public function details($id)
    {
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
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */

    public function show($slug)
    {
        $products = Product::with('category')->where('slug', '=', $slug)->first();
        $detail_products = DetailProduct::where('product_id', '=', $products->id)->first();
        if ($detail_products != null) {
            $stok = ($detail_products->sisa + $detail_products->produksi + $detail_products->masuk) - ($detail_products->keluar_komersial - $detail_products->keluar_nonkomersial);
            if ($stok > 0) {
                $stok = $stok;
            } else {
                $stok = 0;
            }
        } else {
            $stok = 0;
        }
        $cart_count = Cart::all()->where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)->where('status', '=', "Pending")->count();

        return view('user.product-details', compact('products', 'detail_products', 'stok', 'cart_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function filter_product(Request $request)
    {
        $products = DB::table('detail_products')
            ->leftJoin('products', 'detail_products.product_id', '=', 'products.id')
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select(
                'detail_products.id as id',
                'detail_products.asal as asal',
                'detail_products.panen as panen',
                'detail_products.kelas as kelas',
                'detail_products.db as db',
                'detail_products.sisa as sisa',
                'detail_products.produksi as produksi',
                'detail_products.masuk as masuk',
                'detail_products.keluar_komersial as keluar_komersial',
                'detail_products.keluar_nonkomersial as keluar_nonkomersial',
                'detail_products.tahun as tahun',
                'detail_products.bulan as bulan',
                'products.name as product_name',
                'products.image as image',
                'products.description as description',
                'products.unit as unit',
                'products.price as price',
                'products.slug as slug',
                'product_categories.name as category_name'
            )
            ->where('product_categories.name', 'LIKE', '%' . $request->keyword . '%')
            ->paginate(5);
        return response()->json($products);
    }
}
