    @extends('user.layouts.app')

    @section('content')
    <input type="hidden" id="detail_product_id" value="{{$detail_products->id}}">
    <input type="hidden" id="user_id" value="{{Auth::user() == null ? '' : Auth::user()->id}}">
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
    <section class="single_product_details_area mb-50">
        <div class="produts-details--content mb-50">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-6 col-lg-5">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="product-img" href="{{url($products->image)}}" title="Product Image">
                                            <img class="d-block w-100" src="{{url($products->image)}}" alt="1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="single_product_desc">
                            <h4 class="title">{{$products->name}}</h4>
                            <p>Kategori Produk : {{$products->category->name}}</p>
                            <p>Asal Produk : {{$detail_products->asal}}</p>
                            <p>Tahun Panen Produk : {{$detail_products->panen}}</p>
                            <p>Kelas Produk : {{$detail_products->kelas}}</p>
                            <input type="hidden" id="price" value="{{$products->price}}">
                            <h4 class="price">Rp {{number_format($products->price, 2)}} / {{$products->unit}}</h4>
                            <input type="hidden" name="stok" id="stok" value="{{$products->unit == 'gram' ? $stok : $stok / 1000}}">
                            <input type="hidden" name="unit" id="unit" value="{{$products->unit}}">
                            <div class="row">
                                <div class="col-md-4"><h4 class="h_stok" style="background: #F2F4F5; padding: 10px 10px 10px 10px">Stok {{number_format($stok, 0)}}</h4></div>
                                <div class="col-md-4"><p style="padding: 10px 10px 10px 10px">gram</p></div>
                            </div>

                            <!-- <p>Stok : </p> -->
                            <div class="short_overview">
                                <p>{!!html_entity_decode($products->description)!!}</p>
                            </div>

                            <div class="cart--area d-flex flex-wrap align-items-center checkout-div">
                                <form class="cart clearfix d-flex align-items-center" method="post">
                                    <div class="quantity">
                                        <input type="text" class="qty-text" id="qty" name="quantity" value="0" min="0">
                                    </div>
                                    <span>&nbsp; {{$products->unit}}</span>
                                    <div type="submit" id="keranjang" name="keranjang" value="5" class="btn alazea-btn ml-15" style="padding-top:10px">Tambah ke Keranjang</div>
                                </form>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Total Harga (Belum termasuk ongkir)</label>
                                <div class="input-group">
                                    <h4 class="price" id="output">Rp. - </h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    <!-- ##### Single Product Details Area End ##### -->

    @section('footer')
    <script>
        $(document).ready(function () {
            var stok = $('#stok').val();
            totalStok = parseFloat(stok.replace(',',''))
            if (stok != 0) {
                $("input").on("input", function () {

                    var qty = $('#qty').val();
                    var temp_stok = totalStok;
                    if(qty <= totalStok){
                        temp_stok = totalStok - qty;
                        $(".h_stok").html("Stok " + temp_stok);
                    } else {
                        resetToastPosition();
                            $.toast({
                                heading: 'Gagal',
                                text: 'Tidak bisa melebihi jumlah stok',
                                showHideTransition: 'slide',
                                icon: 'error',
                                loaderBg: '#f2a654',
                                position: 'bottom-left'
                            });
                        $('#qty').val(0)
                        $(".h_stok").html("Stok " + temp_stok);
                    }
                });

            } else {
                $(".checkout-div").html('<h3 style="color:red">STOK KOSONG</h3>');
            }

        });

    </script>

<script type="text/javascript">
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
    $("input").on("input", function () {
        var stok = $('#stok').val();
        totalStok = parseFloat(stok.replace(',',''))
        var price = $('#price').val();
        var qty = $('#qty').val();
            if(qty <= totalStok){
                var result = parseInt(price) * parseInt(qty);
                $("#output").text("Rp. " + number_format(result, 2));
            }else{
                $("#output").text("Rp. " + "-");
            }
    });
</script>

<script>
    $('#keranjang').click(function(){
        if($('#qty').val() == 0){
            resetToastPosition();
                    $.toast({
                        heading: 'Gagal',
                        text: 'Gagal menambahkan ke keranjang, qty masih 0',
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'bottom-left'
                    })
        }else{
            keranjang();
        }

    });

    function keranjang(){
            $.ajax({
                url: "{{route('keranjang.store')}}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'unit': $('#unit').val(),
                    'qty': $('#qty').val(),
                    'detail_product_id': $('#detail_product_id').val(),
                    'user_id': $('#user_id').val(),
                },
                statusCode: {
                        500: function (response) {
                            resetToastPosition();
                            $.toast({
                                heading: 'Gagal',
                                text: 'Gagal menambahkan ke keranjang, silahkan login terlebih dahulu',
                                showHideTransition: 'slide',
                                icon: 'error',
                                loaderBg: '#f2a654',
                                position: 'bottom-left'
                            });
                        },
                },
                success:function(data) {
                    $('#cart-qty').html("("+data+")")
                    'use strict';
                    resetToastPosition();
                    $.toast({
                        heading: 'Berhasil',
                        text: 'Berhasil ditambahkan ke keranjang',
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'bottom-left'
                    })
                }
            });
        }

</script>

@endsection
