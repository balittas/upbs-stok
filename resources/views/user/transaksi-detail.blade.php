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
<div class="checkout_area mb-100">
    <div class="container">
        <form id="fileUploadForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-between">
            <div class="col-12 col-lg-7">
                <div class="checkout_details_area clearfix">
                    <h5>RINCIHAN PENAGIHAN</h5>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="nama_penerima">Nama Penerima *</label>
                                <input type="text" class="form-control" name="nama_penerima" id="nama_penerima" value="{{$data->nama_penerima}}" disabled>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="no_hp">No HP *</label>
                                <input type="number" name="no_hp" class="form-control" id="phone_number" min="0"
                                value="{{$data->no_hp}}" disabled>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="alamat">Alamat *</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="{{$data->alamat}}" disabled>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="zip_code">Zip Code</label>
                                <input type="number" class="form-control" id="zip_code" name="zip_code" value="{{$data->zip_code}}"
                                    min="0" disabled>
                            </div>
                            <div class="col-12 mb-4">
                                <label>Provinsi</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="{{$data->provinsi}}" disabled>

                            </div>
                            <div class="col-12 mb-4">
                                <label>Kota / Kabupaten</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="{{$data->kabupaten_kota}}" disabled>
                            </div>
                            <div class="col-12 mb-4">
                                <label>Peta Lokasi Alamat</label>
                                <div id='map' style='width: 640px; height: 290px;'></div>
                                <input type="hidden" name="coordinate_map" id="coordinate_map">
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="order_notes">Order Catatan</label>
                                <textarea class="form-control" id="order_notes" name="order_notes" cols="30" rows="10"
                                    placeholder="Catatan pengiriman" disabled>{{$data->order_notes}}</textarea>
                            </div>
                        </div>

                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="checkout-content">
                    <h5 class="title--">Produk</h5>
                    @foreach ($cart as $item)
                    <div class="subtotal d-flex justify-content-between align-items-center">
                        <small>{{$item->name}} <br> <b>Harga : Rp. {{number_format($item->price, 2)}} /
                                {{$item->unit}}</b> x <b>({{$item->qty}} {{$item->unit}})</b></small>
                                <b>Rp. {{$item->unit == 'gram' ? number_format($item->price * $item->qty, 2) : number_format($item->price * $item->qty / 1000, 2)}}</b>
                    </div>
                    @endforeach
                    <br>
                    <h5 class="title--">Pesanan</h5>
                    <div class="subtotal d-flex justify-content-between align-items-center">
                        <h5>Total Produk</h5>
                        <h5>Rp. {{number_format($data->total_produk, 2)}}</h5>
                    </div>
                    <div class="shipping d-flex justify-content-between align-items-center">
                        <h5>Total Ongkos Kirim</h5>
                        <h5>Rp. {{number_format($data->total_ongkir, 2)}}</h5>
                    </div>
                    <div class="order-total d-flex justify-content-between align-items-center">
                        <h5>Order Total</h5>
                        <h5>Rp. {{number_format($data->total_produk + $data->total_ongkir, 2)}}</h5>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
<!-- ##### Single Product Details Area End ##### -->

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script>
    var loadFileProduk = function (event) {
        var output = document.getElementById('output_produk');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src)
        }
    };

    var loadFileOngkir = function (event) {
        var output = document.getElementById('output_ongkir');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src)
        }
    };

</script>


<script>
    var SITEURL = "{{URL('/')}}";
    let validExt = ['jpg', 'png', 'jpeg'];

    function resetForm($form) {
        $form.find('input:file').val('');
    }
    $('input').on('change', function () {
        var extension = this.files[0].type.split('/')[1]
        console.log(this.files[0].type)
        if (validExt.indexOf(extension) == -1) {
            resetToastPosition();
            $.toast({
                heading: 'Gagal',
                text: 'Bukti transfer yang diupload harus berupa jpg/png/jpeg',
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'bottom-left'
            });
            $('#total_produk').val('');
            $('#total_ongkir').val('');
        }
    });

    $(function () {
        uploadSuccess = function () {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Success',
                text: 'Produk berhasil dibeli. Silahkan tunggu produk akan diproses oleh admin',
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'bottom-left'
            })

        };
        $(document).ready(function () {
            $('#fileUploadForm').ajaxForm({
                beforeSend: function () {
                    var percentage = '0';
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage + '%',
                        function () {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        });
                },
                complete: function (xhr) {
                    var percentage = '0';
                    uploadSuccess();
                    setTimeout(function () {
                        window.location.href = SITEURL + "/";
                    }, 3000);
                }
            });

        });
    });

</script>

<script>
    $(document).ready(function () {
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
                            '<option value="">Pilih Kota</option>');
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
    });

</script>
<script>
    function initMap() {
        var lat = {!! $lat !!};
        var lng = {!! $lng !!};
        console.log(lat)
  const myLatlng = { lat: lat, lng: lng };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: myLatlng,
  });
  // Create the initial InfoWindow.
  let infoWindow = new google.maps.InfoWindow({
    content: "Koordinat Peta Alamat",
    position: myLatlng,
  });

  infoWindow.open(map);
  // Configure the click listener.
//   map.addListener("click", (mapsMouseEvent) => {
//     // Close the current InfoWindow.
//     infoWindow.close();
//     // Create a new InfoWindow.
//     infoWindow = new google.maps.InfoWindow({
//       position: mapsMouseEvent.latLng,
//     });
//     infoWindow.setContent(
//       JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
//     );
//     infoWindow.open(map);
//     const json = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
//     const result = JSON.parse(json);
//     $('#coordinate_map').val([result["lat"],result["lng"]])
//   });
}
</script>
@endsection
