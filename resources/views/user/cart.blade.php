@extends('user.layouts.app')

@section('content')
<input type="hidden" name="sub_total" value="{{$sub_total}}">

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
                    @if ($data->count() == 0)
                    <p style="background: #F5F5F5; text-align: center">Keranjang Kosong</p>
                    @else
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td class="cart_product_img">
                                    <a href="#"><img src="{{url($d->image)}}" alt="Product"></a>
                                    <h5>{{$d->name}}</h5>
                                </td>
                                <td>
                                    <span>{{$d->unit == 'gram' ? number_format($d->qty,0) : number_format($d->qty / 1000,0)}} {{$d->unit}}</span>
                                </td>
                                <td class="price"><span>Rp {{number_format($d->price, 2)}} / {{$d->unit}}</span></td>
                                <td class="total_price"><span>Rp {{$d->unit == 'gram' ? number_format($d->price * $d->qty, 2) : number_format($d->price * $d->qty / 1000, 2)}}</span></td>
                                <td class="action">
                                    <form action="{{route('keranjang.destroy', $d->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-delete" style="width: 75px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @endif

                </div>
            </div>
        </div>

        {{-- < class="row"> --}}

        <!-- Coupon Discount -->
        <div class="col-12 col-lg-6">
            {{-- <div class="coupon-discount mt-70">
                    <h5>COUPON DISCOUNT</h5>
                    <p>Coupons can be applied in the cart prior to checkout. Add an eligible item from the booth of the seller that created the coupon code to your cart. Click the green "Apply code" button to add the coupon to your order. The order total will update to indicate the savings specific to the coupon code entered.</p>
                    <form action="#" method="post">
                        <input type="text" name="coupon-code" placeholder="Enter your coupon code">
                        <button type="submit">APPLY COUPON</button>
                    </form>
                </div> --}}
        </div>

        <!-- Cart Totals -->

        <div class="col-12 col-lg-6">
            <div class="cart-totals-area mt-70">
                <h5 class="title--">Cart Total</h5>
                <div class="subtotal d-flex justify-content-between">
                    <h5>Subtotal</h5>
                    <h5>Rp. {{number_format($sub_total, 2)}}</h5>
                </div>
                <div class="shipping d-flex justify-content-between">
                    <h5>Shipping</h5>

                    <div class="shipping-address">
                        {{-- <div class="form-group">
                            <label class="font-weight-bold">Peta Lokasi</label>
                            <div id='map' style='width: 400px; height: 300px;'></div>
                        </div> --}}
                        <div class="form-group">
                            <label class="font-weight-bold">PROVINSI TUJUAN</label>
                            <select class="form-control provinsi-tujuan" name="province_destination">
                                <option value="0">-- pilih provinsi tujuan --</option>
                                @foreach ($provinces as $province => $value)
                                <option value="{{ $province  }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">KOTA / KABUPATEN TUJUAN</label>
                            <select class="form-control kota-tujuan" name="city_destination">
                                <option value="">-- pilih kota tujuan --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">KURIR</label>
                            <select class="form-control kurir" name="courier">
                                <option value="0">-- pilih kurir --</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">BERAT (GRAM)</label>
                            <input type="number" class="form-control" name="weight" id="weight" value="{{$berat}}" disabled>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-md btn-primary btn-block btn-check">CEK ONGKOS KIRIM</button>
                        </div>
                    </div>
                </div>

                <div class="ongkir-card">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ongkir d-none">
                                <div class="card-body">
                                    <ul class="list-group" id="ongkir">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="total d-flex justify-content-between">
                    <h5>Total</h5>
                    <h5 id="total_checkout">Rp. {{number_format($sub_total, 2)}}</h5>
                </div>

                <div class="checkout-btn">
                    <form class="form-checkout" action="{{route('checkout.index')}}" method="GET">
                        @csrf
                        <input type="hidden" name="sub_total" value="{{$sub_total}}">
                        <input type="hidden" name="ongkir_total">
                        <input type="hidden" name="total">
                        <button type="action" id="checkout-button" href="#" class="btn alazea-btn w-100 d-none">PROCEED TO CHECKOUT</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
@endsection
<!-- ##### Single Product Details Area End ##### -->

@section('footer')
<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoia2FtdXRlcmJhaWs0IiwiYSI6ImNsMGR5dmNtOTBkengzY3F0dmY1MnE2bXYifQ.yfA1rkRQwCDyGfkZbTU-jw';
    // var map = new mapboxgl.Map({
    //     container: 'map',
    //     style: 'mapbox://styles/mapbox/streets-v11'
    // });
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v11', // style URL
        center: [-96, 37.8], // starting position
        zoom: 3 // starting zoom
    });
    // Add geolocate control to the map.
    map.addControl(
        new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            // When active the map will receive updates to the device's location as it changes.
            trackUserLocation: true,
            // Draw an arrow next to the location dot to indicate which direction the device is heading.
            showUserHeading: true
        })
    );

</script>
<script>
    $('#ongkir').click(function () {
        const ongkir = $('input[name=ongkir-kurir]:checked').val();
        var sub_total = $('input[name=sub_total]').val();
        total = parseInt(sub_total) + parseInt(ongkir);
        $('input[name=ongkir_total]').val(ongkir);
        $('input[name=total]').val(total);
        $("#total_checkout").text("Rp. " + number_format(total, 2));
        $('#checkout-button').addClass('d-block');
    });

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

<script>
    $("#total-button").click(function () {
        var radioValue = $(".ongkir-kurir:checked").val();
        $('.checkout-btn').addClass('d-block');
    });

</script>
{{-- ONGKIR CEK SCRIPT --}}
<script>
    $(document).ready(function () {
        $('select[name="province_origin"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                        $('select[name="city_origin"]').empty();
                        $('select[name="city_origin"]').append(
                            '<option value="">-- pilih kota asal --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="city_origin"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_origin"]').append(
                    '<option value="">-- pilih kota asal --</option>');
            }
        });

        $('select[name="province_destination"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="city_destination"]').empty();
                        $('select[name="city_destination"]').append(
                            '<option value="">-- pilih kota tujuan --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="city_destination"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_destination"]').append(
                    '<option value="">-- pilih kota tujuan --</option>');
            }
        });

        let isProcessing = false;
        $('.btn-check').click(function (e) {
            e.preventDefault();

            let token = $("meta[name='csrf-token']").attr("content");
            let city_origin = $('select[name=city_origin]').val();
            let city_destination = $('select[name=city_destination]').val();
            let courier = $('select[name=courier]').val();
            let weight = $('#weight').val();

            if (isProcessing) {
                return;
            }

            isProcessing = true;
            jQuery.ajax({
                url: "/ongkir",
                data: {
                    _token: token,
                    city_origin: city_origin,
                    city_destination: city_destination,
                    courier: courier,
                    weight: weight,
                },
                dataType: "JSON",
                type: "POST",
                success: function (response) {
                    console.log(response)
                    isProcessing = false;
                    if (response) {
                        $('#ongkir').empty();
                        $('.ongkir').addClass('d-block');
                        $.each(response[0]['costs'], function (key, value) {
                            $('#ongkir').append('<li class="list-group-item">' +
                                '<input type="radio" name="ongkir-kurir" value="' +
                                value.cost[0].value + '"> ' + response[0].code
                                .toUpperCase() + ' : <strong>' + value.service +
                                '</strong> - Rp. ' + number_format(value.cost[0].value, 2) +
                                ' (' + value.cost[0].etd + ') hari</li>')
                        });

                    }
                }
            });

        });

    });

</script>
{{-- ONGKIR CEK SCRIPT --}}
@endsection
