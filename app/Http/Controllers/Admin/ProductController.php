<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use \Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('products')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->select(['products.id', 'products.name', 'product_categories.name as category_name', 'products.description', 'products.price', 'products.image', 'products.slug']);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<td class="dropdown"><div class="ik ik-more-vertical dropdown-toggle" data-toggle="dropdown"></div><ul class="dropdown-menu" role="menu"><a class="dropdown-item" href="' . url('admin-page/product/' . $data->id . '/edit') . '"><li> <i class="ik ik-edit" style="color: green;font-size:16px;padding-right:5px"></i><span style="font-size:14px"> Edit</span></li></a><a class="dropdown-item delete" href="#" data-toggle="modal"
                    data-target="#exampleModal" data-id=' . $data->id . '><li><i class="ik ik-trash-2" style="color: red;font-size:16px;padding-right:5px"></i><span style="font-size:14px"> Hapus</span></li></a></ul></td>';
                    return $btn;
                })
                ->addColumn('image', function ($data) {
                    $btn = '<td><a href=' . url($data->image) . ' target="_blank" style="color:#0000D7">Lihat Gambar</a></td>';
                    return $btn;
                })
                ->addColumn('price', function ($data) {
                    $btn = 'Rp. ' . number_format($data->price, 2);
                    return $btn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductCategory::all();
        return view('admin.product.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Product();
        $table->id = Str::random(16) . Carbon::now()->format('YmdHis');
        $table->category_id = $request->category_id;
        $table->description = $request->description;
        $table->price = $request->price;
        $table->unit = $request->unit;
        $table->name = $request->name;
        $table->slug = Str::slug($request->name);

        $image_name = 'image' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $image_name);
        $table->image = 'images/' . $image_name;

        $table->save();
        return redirect()->route('product.index');
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
        $category = ProductCategory::all();
        $data = Product::find($id);
        return view('admin.product.edit', compact('data', 'category'));
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
        $table = Product::find($id);

        $table->category_id = $request->category_id;
        $table->description = $request->description;
        $table->price = $request->price;
        $table->unit = $request->unit;
        $table->name = $request->name;
        $table->slug = Str::slug($request->name);

        if (!empty($request->image)) {
            $image_name = 'image' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $image_name);
            $table->image = 'images/' . $image_name;
        } else {
            $table->image = $table->image;
        }
        $table->save();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $table = Product::find($request->id);
        $table->delete();
        return redirect()->route('product.index');
    }
}
