@extends('admin.layouts.app')
@section('header')
<style>
    .ik {
        cursor: pointer;
    }

    #trHover:hover {
        background-color: #e6e6e6;
    }

</style>
@endsection
@section('iconHeader')
<i class="mdi mdi-sitemap bg-inverse"></i>
@endsection
@section('titleHeader')
Dashboard
@endsection
@section('subtitleHeader')
Home
@endsection
@section('breadcrumb')
Dashboard
@endsection
@section('content-wrapper')
<!-- Content Wrapper. Contains page content -->
@csrf
@method('PUT')
<!-- @method('DELETE') -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Produk Terlaris</h5>
                    <p class="card-text">{{$produk_terlaris == null ? '-' :$produk_terlaris->product_name }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Produk Terlaris</h5>
                    <p class="card-text">.......</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row row-cols-1 row-cols-md-4 g-2">
                <div class="col">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk Terjual</h5>
                        <p class="card-text">{{number_format($produk_terjual,0)}}</p>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Penjualan</h5>
                        <p class="card-text">Rp. {{number_format($penjualan,2)}}</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-4 g-2">
                <div class="col">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Stok Produk</h5>
                        <p class="card-text">{{number_format($stok,0)}}</p>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Produk</h5>
                        <p class="card-text">{{$products}}</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection
