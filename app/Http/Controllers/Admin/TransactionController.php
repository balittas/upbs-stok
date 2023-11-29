<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use \Yajra\Datatables\Datatables;
use App\Exports\TransactionExport;
use App\Models\Cart;
use App\Models\DetailProduct;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transactions')
                ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
                ->select(['transactions.id', 'users.name as user_name',  'transactions.paid_total', 'transactions.status', 'transactions.alamat', 'transactions.zip_code', 'transactions.kabupaten_kota', 'transactions.provinsi', 'transactions.no_hp', 'transactions.nama_penerima', 'transactions.bukti_transfer_produk', 'transactions.bukti_transfer_ongkir', 'transactions.total_produk', 'transactions.total_ongkir', 'transactions.order_notes']);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<td class="dropdown"><div class="ik ik-more-vertical dropdown-toggle" data-toggle="dropdown"></div><ul class="dropdown-menu" role="menu"><a class="dropdown-item" href="' . url('admin-page/transaction/' . $data->id . '/edit') . '"><li> <i class="ik ik-edit" style="color: green;font-size:16px;padding-right:5px"></i><span style="font-size:14px"> Proses</span></li></a><a class="dropdown-item delete" href="#" data-toggle="modal"
                    data-target="#exampleModal" data-id=' . $data->id . '><li><i class="ik ik-trash-2" style="color: red;font-size:16px;padding-right:5px"></i><span style="font-size:14px"> Hapus</span></li></a></ul></td>';
                    return $btn;
                })
                ->addColumn('paid_total', function ($data) {
                    $btn = 'Rp. ' . number_format($data->paid_total, 2);
                    return $btn;
                })
                ->addColumn('bukti_transfer_produk', function ($data) {
                    $btn = '<td><a href=' . url($data->bukti_transfer_produk) . ' target="_blank" style="color:#0000D7">Lihat Bukti</a></td>';
                    return $btn;
                })
                ->addColumn('bukti_transfer_ongkir', function ($data) {
                    $btn = '<td><a href=' . url($data->bukti_transfer_ongkir) . ' target="_blank" style="color:#0000D7">Lihat Bukti</a></td>';
                    return $btn;
                })
                ->addColumn('total_produk', function ($data) {
                    $btn = 'Rp. ' . number_format($data->total_produk, 2);
                    return $btn;
                })
                ->addColumn('total_ongkir', function ($data) {
                    $btn = 'Rp. ' . number_format($data->total_ongkir, 2);
                    return $btn;
                })
                ->rawColumns(['action', 'bukti_transfer_produk', 'bukti_transfer_ongkir'])
                ->make(true);
        }
        return view('admin.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.transaction.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Transaction();
        $table->id = 'transaction-' . Str::random(3) . '-' . Carbon::now()->format('YmdHis');
        $table->user_id = $request->user_id;
        $table->paid_total = $request->paid_total;
        $table->status = $request->status;
        $table->alamat = $request->alamat;
        $table->zip_code = $request->zip_code;
        $table->kabupaten_kota = $request->kabupaten_kota;
        $table->provinsi = $request->provinsi;
        $table->no_hp = $request->no_hp;
        $table->nama_penerima = $request->nama_penerima;
        $table->total_produk = $request->total_produk;
        $table->total_ongkir = $request->total_ongkir;
        $table->order_notes = $request->order_notes;

        $image_name_produk = 'buktiProduk' . Str::random(10) . '.' . $request->bukti_transfer_produk->getClientOriginalExtension();
        $request->bukti_transfer_produk->move(public_path('images'), $image_name_produk);
        $table->bukti_transfer_produk = 'images/' . $image_name_produk;

        $image_name_ongkir = 'buktiOngkir' . Str::random(10) . '.' . $request->bukti_transfer_ongkir->getClientOriginalExtension();
        $request->bukti_transfer_ongkir->move(public_path('images'), $image_name_ongkir);
        $table->bukti_transfer_ongkir = 'images/' . $image_name_ongkir;

        $table->save();
        return redirect()->route('transaction.index');
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
        $products = Product::all();
        $users = User::all();
        $data = Transaction::find($id);
        $carts = DB::table('carts')
            ->leftJoin('detail_products', 'carts.detail_product_id', '=', 'detail_products.id')
            ->leftJoin('products', 'detail_products.product_id', '=', 'products.id')
            ->where('transaction_id', '=', $id)
            ->get();
        return view('admin.transaction.edit', compact('data', 'products', 'users', 'carts'));
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
        $table = Transaction::find($id);
        $table->user_id = $request->user_id;
        $table->paid_total = $request->paid_total;
        $table->status = $request->status;
        $table->alamat = $request->alamat;
        $table->zip_code = $request->zip_code;
        $table->kabupaten_kota = $request->kabupaten_kota;
        $table->provinsi = $request->provinsi;
        $table->no_hp = $request->no_hp;
        $table->nama_penerima = $request->nama_penerima;
        $table->total_produk = $request->total_produk;
        $table->total_ongkir = $request->total_ongkir;
        $table->order_notes = $request->order_notes;

        if ($request->status == 'Cancel') {
            $cart = Cart::where('transaction_id', '=', $id)
                ->get();
            foreach ($cart as $item) {
                $dp = DetailProduct::find($item->detail_product_id);
                $dp->keluar_komersial = $dp->keluar_komersial - $item->qty;
                $dp->sisa = $dp->sisa + $item->qty;
                $dp->save();
            }
        }

        if (!empty($request->bukti_transfer_produk)) {
            $image_name_produk = 'buktiProduk' . Str::random(10) . '.' . $request->bukti_transfer_produk->getClientOriginalExtension();
            $request->bukti_transfer_produk->move(public_path('images'), $image_name_produk);
            $table->bukti_transfer_produk = 'images/' . $image_name_produk;
        } else {
            $table->bukti_transfer_produk = $table->bukti_transfer_produk;
        }

        if (!empty($request->bukti_transfer_ongkir)) {
            $image_name_ongkir = 'buktiOngkir' . Str::random(10) . '.' . $request->bukti_transfer_ongkir->getClientOriginalExtension();
            $request->bukti_transfer_ongkir->move(public_path('images'), $image_name_ongkir);
            $table->bukti_transfer_ongkir = 'images/' . $image_name_ongkir;
        } else {
            $table->bukti_transfer_ongkir = $table->bukti_transfer_ongkir;
        }

        $table->save();

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $table = Transaction::find($request->id);
        $table->delete();
        return redirect()->route('transaction.index');
    }

    // export
    public function export_excel()
    {
        $year = Carbon::now()->year;
        return Excel::download(new TransactionExport($year), 'transactions.xlsx');
    }
}
