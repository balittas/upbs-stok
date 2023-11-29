<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DetailProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use \Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    public function index()
    {
        $produk_terjual = DB::table('carts')
            ->where('status', '=', 'Complete')
            ->sum('qty');
        $penjualan = DB::table('transactions')
            ->where('status', '=', 'Complete')
            ->sum('total_produk');
        $products = DB::table('products')->count('id');
        $terlaris = Cart::select('detail_product_id')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('detail_product_id')
            ->orderByDesc('count')
            ->limit(1)
            ->first();
        if ($terlaris == null) {
            $produk_terlaris = null;
        } else {
            $produk_terlaris = DB::table('detail_products')
                ->leftJoin('products', 'detail_products.product_id', '=', 'products.id')
                ->select('products.name as product_name')
                ->where('detail_products.id', '=', $terlaris->detail_product_id)
                ->first();
        }

        $detail_produk = DetailProduct::all();
        $stok = 0;
        foreach ($detail_produk as $data) {
            $stok = ($data->sisa + $data->masuk) - ($data->keluar_komersial - $data->keluar_nonkomersial);
        }
        return view('admin.dashboard.index', compact('produk_terjual', 'penjualan', 'products', 'produk_terlaris', 'stok'));
    }
}
