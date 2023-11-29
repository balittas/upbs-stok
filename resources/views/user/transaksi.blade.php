@extends('user.layouts.app')

@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
{{-- <div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center"
        style="background-image: url('assets/frontend/img/bg-img/24.jpg;);">
        <h2>Detail Produk</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Single Product Details Area Start ##### -->
<div class="cart-area section-padding-0-100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $data)
                            <tr>
                                <td class="id"><span>{{$data->id}}</span></td>
                                <td class="status">
                                    @if ($data->status == 'Process')
                                    <span class="badge badge-primary">{{$data->status}}</span>
                                    @elseif ($data->status == 'Complete')
                                    <span class="badge badge-success">{{$data->status}}</span>
                                    @elseif ($data->status == 'Cancel')
                                    <span class="badge badge-danger">{{$data->status}}</span>
                                    @endif

                                </td>
                                <td>
                                    <p>{{date('d-m-Y', strtotime($data->created_at))}}</p>
                                </td>
                                <td class="action">
                                     <a href="{{route('transaksi.show', $data->id)}}" class="btn btn-primary btn-delete" style="width: 75px;">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- ##### Single Product Details Area End ##### -->

@section('footer')
<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

</script>

@endsection
