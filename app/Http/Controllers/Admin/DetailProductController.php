<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use \Yajra\Datatables\Datatables;

class DetailProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('detail_products')
                ->leftJoin('products', 'detail_products.product_id', '=', 'products.id')
                ->select(['detail_products.id', 'products.name as product_name', 'detail_products.asal', 'detail_products.panen', 'detail_products.kelas', 'detail_products.db', 'detail_products.sisa', 'detail_products.produksi', 'detail_products.masuk', 'detail_products.keluar_komersial', 'detail_products.keluar_nonkomersial', 'detail_products.tahun', 'detail_products.bulan',]);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<td class="dropdown"><div class="ik ik-more-vertical dropdown-toggle" data-toggle="dropdown"></div><ul class="dropdown-menu" role="menu"><a class="dropdown-item" href="' . url('admin-page/detail-product/' . $data->id . '/edit') . '"><li> <i class="ik ik-edit" style="color: green;font-size:16px;padding-right:5px"></i><span style="font-size:14px"> Edit</span></li></a><a class="dropdown-item delete" href="#" data-toggle="modal"
                    data-target="#exampleModal" data-id=' . $data->id . '><li><i class="ik ik-trash-2" style="color: red;font-size:16px;padding-right:5px"></i><span style="font-size:14px"> Hapus</span></li></a></ul></td>';
                    return $btn;
                })
                ->addColumn('db', function ($data) {
                    $btn = number_format($data->db, 0) . ' %';
                    return $btn;
                })
                ->addColumn('sisa', function ($data) {
                    $btn = number_format($data->sisa, 0) . ' gram';
                    return $btn;
                })
                ->addColumn('produksi', function ($data) {
                    $btn = number_format($data->produksi, 0) . ' gram';
                    return $btn;
                })
                ->addColumn('masuk', function ($data) {
                    $btn = number_format($data->masuk, 0) . ' gram';
                    return $btn;
                })
                ->addColumn('keluar_komersial', function ($data) {
                    $btn = number_format($data->keluar_komersial, 0) . ' gram';
                    return $btn;
                })
                ->addColumn('keluar_nonkomersial', function ($data) {
                    $btn = number_format($data->keluar_nonkomersial, 0) . ' gram';
                    return $btn;
                })
                ->addColumn('stock', function ($data) {
                    $stock = ($data->sisa + $data->masuk) - ($data->keluar_komersial + $data->keluar_nonkomersial);
                    if ($stock > 0) {
                        $stock = $stock;
                    } else {
                        $stock = 0;
                    }
                    $btn = number_format($stock, 0) . ' gram';
                    return $btn;
                })
                ->rawColumns(['action', 'stock'])
                ->make(true);
        }
        return view('admin.detail_product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        return view('admin.detail_product.add', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $table = new DetailProduct();
        $table->id = Str::random(16) . Carbon::now()->format('YmdHis');
        $table->asal = $request->asal;
        $table->panen = $request->panen;
        $table->kelas = $request->kelas;
        $table->db = $request->db;
        $table->sisa = $request->sisa;
        $table->produksi = $request->produksi;
        $table->masuk = $request->masuk;
        $table->keluar_komersial = $request->keluar_komersial;
        $table->keluar_nonkomersial = $request->keluar_nonkomersial;
        $table->tahun = $request->tahun;
        $table->product_id = $request->product_id;
        $table->bulan = $request->bulan;
        $table->slug = Str::slug($request->nama);

        $table->save();
        return redirect()->route('detail-product.index');
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
        $product = Product::all();
        $data = DetailProduct::find($id);
        return view('admin.detail_product.edit', compact('data', 'product'));
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
        $table = DetailProduct::find($id);

        $table->asal = $request->asal;
        $table->panen = $request->panen;
        $table->kelas = $request->kelas;
        $table->db = $request->db;
        $table->sisa = $request->sisa;
        $table->produksi = $request->produksi;
        $table->masuk = $request->masuk;
        $table->keluar_komersial = $request->keluar_komersial;
        $table->keluar_nonkomersial = $request->keluar_nonkomersial;
        $table->tahun = $request->tahun;
        $table->bulan = $request->bulan;
        $table->slug = Str::slug($request->nama);

        $table->save();

        return redirect()->route('detail-product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $table = DetailProduct::find($request->id);
        $table->delete();
        return redirect()->route('detail-product.index');
    }
}
