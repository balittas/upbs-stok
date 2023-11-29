@extends('user.layouts.app')
@section('css')
<link rel="stylesheet" href="{{url('alazea-gh-pages/css/custom.css')}}">
@endsection
@section('content')
<style>
    .projects-catalog .catalog-slider {
        margin: 50px 0px;
    }

    .projects-catalog .catalog-cover {
        position: relative;
    }

    .projects-catalog ul {
        white-space: nowrap;
        overflow-x: auto;
    }

    .projects-catalog li {
        width: 75%;
        height: 200px;
    }

    li.catalog-item {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .projects-catalog li {
        display: inline-block;
        margin: 0 10px 0 0;
        width: 350px;
        height: 250px;
        background: #222;
    }

    .category-active{
        background-color: #ffce00;
        color:#06250f
    }

    .category-notactive{
        background-color: #06250f;
        color: white
    }

</style>

<!-- ##### Shop Area Start ##### -->
<section class="shop-page section-padding-0-100">
    <div class="container">
        <div class="row mb-4" style="display: flex;
            flex-wrap: nowrap;
            overflow: auto;">
            @foreach ($category as $key => $item)
            <div class="col-2 text-center align-items-center justify-content-center" style="flex: 0 0 auto;">
                <p id="r{{$key}}" class="category-notactive" onclick='selectCategory({{$key}})'
                    style="cursor: pointer; border-radius:5px; padding:10px 10px 10px 10px;">
                    {{$item->name}}</p>
            </div>
            @endforeach
        </div>

        <div class="row">
            <!-- All Products Area -->
            <div class="col-12 col-md-12 col-lg-12">
                <div class="shop-products-area">
                    <div id="product-content" class="row justify-content-center">
                        @foreach ($products as $p)
                        <div class="col-12 col-md-4 col-sm-12 col-xs-12 mb-4">
                            <div class="card pl-4 pr-3 py-2">
                                <div class="div1 row py-4 px-2">
                                    <div class="col-12 d-flex justify-content-center"> <img src="{{$p->image}}"
                                            class="rounded" alt=""> </div>
                                </div>
                                <div class="py-2">
                                    @if (($p->sisa + $p->masuk) - ($p->keluar_komersial + $p->keluar_nonkomersial) > 0)
                                    <p class="ml-3 ml-md-5">
					 <p class="ml-3 ml-md-5">
                                        <h5>
                                            <b>
                                                <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span class="small">

                                                    Stok:
                                                    {{number_format(($p->sisa + $p->produksi + $p->masuk) - ($p->keluar_komersial - $p->keluar_nonkomersial),0)}}
                                                    {{$p->unit}}
                                                </span>&nbsp; <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="small"> Terjual:
                                                    {{number_format($p->keluar_komersial,0) }} {{$p->unit}}</span>
                                            </b>
                                        </h5>
                                    </p>
                                    <h5>{{$p->product_name}}</h5>
                                    <p> {{$p->category_name}} </p>
                                    <p> Asal : {{$p->asal}} </p>
                                    <div class="d-flex">
                                        <h5 class="align-self-center">Rp {{number_format($p->price, 2)}} / {{$p->unit}}
                                        </h5>
                                        <button class="buy d-flex ml-auto font-weight-bold pl-4 pr-5 py-2 border-0"><a
                                                href="{{url('produk/'.$p->slug)}}">Buy</a></button> <span
                                            class="cart text-white d-flex p-2"><i
                                                class="fa fa-shopping-cart fa-lg align-self-center"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    @else
                                    <p class="ml-3 ml-md-5"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span
                                            class="small" style="color: red">Stok: Kosong</span>&nbsp; <i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="small">
                                            Terjual:
                                            {{number_format($p->keluar_komersial + $p->keluar_nonkomersial,0) }}
                                            {{$p->unit}}</span> </p>
                                    <h5>{{$p->product_name}}</h5>
                                    <p> {{$p->category_name}} </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="row text-center align-items-center justify-content-center">
            <div class="col-md-12 ">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-2 ">
                        <p id="load-more"
                            style="background-color: #06250f;color:white;padding:10px 5px 10px 5px;border-radius:10px;cursor: pointer;">
                            Load More..</p>
                        <p id="no-more" class="d-none">
                            No More Product</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- ##### Shop Area End ##### -->

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

<script>
    var page = 1
    var keyword = ""
    var cur_index = 0
    $('#load-more').click(function (){
        page++
        $.ajax({
                url: "{{route('filter_product')}}",
                type: 'GET',
                data: {
                    'page': page,
                    'keyword': keyword
                },
                success: (data) => {
                    if(data.last_page < page){
                        $('#load-more').addClass('d-none')
                        $('#no-more').removeClass('d-none')
                    }else{
                        $('#load-more').removeClass('d-none')
                        $('#no-more').addClass('d-none')
                    }
                    var stok = ""
                    var html = ""
                    data.data.forEach(element => {
                        if((element.sisa + element.masuk) - (element.keluar_komersial + element.keluar_nonkomersial) > 0){
                        stok = "<p class='ml-3 ml-md-5'> <i class='fa fa-shopping-bag' aria-hidden='true'></i>"
                        +" <span class='small'>Stok: " + number_format((element.sisa + element.produksi + element.masuk) - (element.keluar_komersial - element.keluar_nonkomersial),0)
                        + element.unit+"</span>&nbsp; <i class='fa fa-shopping-cart'"
                        +"aria-hidden='true'></i> <span class='small'> Terjual:"
                        + number_format(element.keluar_komersial, 0) +" "+element.unit+"</span> </p>"
                        +"<h5>"+element.product_name+"</h5><p>"+element.category_name+"</p><p>Asal : "+element.asal+"</p>"
                        +"<div class='d-flex'>"
                        +"<h5 class='align-self-center'>Rp "+ number_format(element.price, 2)+ "/"+ element.unit
                        +"</h5><button class='buy d-flex ml-auto font-weight-bold pl-4 pr-5 py-2 border-0'>"
                        +"<a href='produk/"+element.slug+"'>Buy</a></button>"
                        +"<span class='cart text-white d-flex p-2'>"
                        +"<i class='fa fa-shopping-cart fa-lg align-self-center' aria-hidden='true'></i></span></div>"
                        }else{
                            stok = "<p class='ml-3 ml-md-5'> <i class='fa fa-shopping-bag' aria-hidden='true'></i>"
                            +"<span class='small' style='color: red'>Stok: Kosong</span>&nbsp; <i class='fa fa-shopping-cart' aria-hidden='true'></i> <span class='small'>"
                            +"Terjual"+number_format(element.keluar_komersial + element.keluar_nonkomersial,0)
                            +element.unit+"</span></p><h5>"+element.product_name+"</h5><p>"+element.category_name+"</p>"
                        }

                        html += "<div class='col-12 col-md-4 col-sm-12 col-xs-12 mb-4'>"
                        +"<div class='card pl-4 pr-3 py-2'>"
                        +"<div class='div1 row py-4 px-2'>"
                        +"<div class='col-12 d-flex justify-content-center'><img src='"+element.image+"' class='rounded'></div>"
                        +"</div><div class='py-2'>"
                        +stok+"</div></div></div>"
                    });

                    $('#product-content').append(html)
                },
            })
    })

    function selectCategory(index) {

        if($('#r'+cur_index).hasClass('category-active')){
            $('#r'+cur_index).addClass('category-notactive')
            $('#r'+cur_index).removeClass('category-active')
        }

        if($('#r'+index).hasClass('category-notactive')){
            $('#r'+index).removeClass('category-notactive')
            $('#r'+index).addClass('category-active')
        }else{
            $('#r'+index).removeClass('category-active')
            $('#r'+index).addClass('category-notactive')
        }

        cur_index = index

        keyword = $('#r' + index).text()
            $.ajax({
                url: "{{route('filter_product')}}",
                type: 'GET',
                data: {
                    'keyword': $('#r' + index).text()
                },
                success: (data) => {
                    if(data.total == 0){
                        $('#load-more').addClass('d-none')
                        $('#no-more').removeClass('d-none')
                    }else if(data.total < 5){
                        $('#load-more').addClass('d-none')
                        $('#no-more').removeClass('d-none')
                    }else{
                        $('#load-more').removeClass('d-none')
                        $('#no-more').addClass('d-none')
                    }

                    console.log('success')
                    var stok = ""
                    var html = ""
                    data.data.forEach(element => {
                        if((element.sisa + element.masuk) - (element.keluar_komersial + element.keluar_nonkomersial) > 0){
                        stok = "<p class='ml-3 ml-md-5'> <i class='fa fa-shopping-bag' aria-hidden='true'></i>"
                        +" <span class='small'>Stok: " + number_format((element.sisa + element.produksi + element.masuk) - (element.keluar_komersial - element.keluar_nonkomersial),0)
                        + element.unit+"</span>&nbsp; <i class='fa fa-shopping-cart'"
                        +"aria-hidden='true'></i> <span class='small'> Terjual:"
                        + number_format(element.keluar_komersial, 0) +" "+element.unit+"</span> </p>"
                        +"<h5>"+element.product_name+"</h5><p>"+element.category_name+"</p><p>Asal : "+element.asal+"</p>"
                        +"<div class='d-flex'>"
                        +"<h5 class='align-self-center'>Rp "+ number_format(element.price, 2)+ "/"+ element.unit
                        +"</h5><button class='buy d-flex ml-auto font-weight-bold pl-4 pr-5 py-2 border-0'>"
                        +"<a href='produk/"+element.slug+"'>Buy</a></button>"
                        +"<span class='cart text-white d-flex p-2'>"
                        +"<i class='fa fa-shopping-cart fa-lg align-self-center' aria-hidden='true'></i></span></div>"
                        }else{
                            stok = "<p class='ml-3 ml-md-5'> <i class='fa fa-shopping-bag' aria-hidden='true'></i>"
                            +"<span class='small' style='color: red'>Stok: Kosong</span>&nbsp; <i class='fa fa-shopping-cart' aria-hidden='true'></i> <span class='small'>"
                            +"Terjual"+number_format(element.keluar_komersial + element.keluar_nonkomersial,0)
                            +element.unit+"</span></p><h5>"+element.product_name+"</h5><p>"+element.category_name+"</p>"
                        }

                        html += "<div class='col-12 col-md-4 col-sm-12 col-xs-12 mb-4'>"
                        +"<div class='card pl-4 pr-3 py-2'>"
                        +"<div class='div1 row py-4 px-2'>"
                        +"<div class='col-12 d-flex justify-content-center'><img src='"+element.image+"' class='rounded'></div>"
                        +"</div><div class='py-2'>"
                        +stok+"</div></div></div>"
                    });

                    $('#product-content').html(html)
                    console.log(data)
                },
            })
    }
</script>

<script>


</script>
@endsection
