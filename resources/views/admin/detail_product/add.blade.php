@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="{{url('assets/admin/plugins/select2/dist/css/select2.min.css')}}">
@endsection
@section('titleHeader')
Data Produk
@endsection
@section('subtitleHeader')
Tambah Produk
@endsection
@section('breadcrumb')
Data Produk
@endsection
@section('content-wrapper')
<input class="js-dynamic-enable" type="hidden"/>
<input class="js-dynamic-disable" type="hidden"/>

<input type="hidden" class="js-large" />
<input type="hidden" class="js-medium" />
<input type="hidden" class="js-small" />
<div class="row">
    <div class="col-sm-12" style="margin-bottom:20%">
        <div class="card">
            <div class="box-body" style="padding-bottom:50px">
                <form id="fileUploadForm" class="text-left border border-light p-5" action="{{route('detail-product.store')}}" method="POST"
                    enctype="multipart/form-data" style="padding-bottom: 50px;">
                    @csrf

                    <div class="form-group">
                        <label>Produk</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                                <select name="product_id" class="select2 form-control" id="default-select">
                                        @foreach($product as $data)
                                        <option value="{{$data->id}}"
                                        >{{$data->name}}</option>
                                        @endforeach
                                </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Asal Produk</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control" name="asal" placeholder="Asal Produk"
                            id="asal" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kelas Produk</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <select name="kelas" class="select2 form-control" id="default-select">
                                <option value="Dasar">Dasar</option>
                                <option value="Pokok">Pokok</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>DB Produk (%)</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="number" class="form-control" name="db" placeholder="DB Produk (%)"
                            id="db" max="100" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tahun Panen Produk</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" id="datepicker" class="form-control  " name="panen" id="panen" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Sisa Stock Produk (gram)</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Sisa Stock Produk"
                            id="sisa" required>
                        <input type="hidden" name="sisa" class="sisa">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Produksi Stock Produk (gram)</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Produksi Stock Produk"
                            id="produksi" required>
                        <input type="hidden" name="produksi" class="produksi">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Masuk Stock Produk (gram)</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Masuk Stock Produk"
                            id="masuk" required>
                        <input type="hidden" name="masuk" class="masuk">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keluar Komersial Stock Produk (gram)</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Keluar Komersial Stock Produk"
                            id="keluar_komersial" required>
                        <input type="hidden" name="keluar_komersial" class="keluar_komersial">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keluar Non-Komersial Stock Produk (gram)</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" class="form-control  " placeholder="Keluar Non-Komersial Stock Produk"
                            id="keluar_nonkomersial" required>
                        <input type="hidden" name="keluar_nonkomersial" class="keluar_nonkomersial">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Bulan Stock Produk</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="month" class="form-control" name="bulan" id="bulan" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tahun Stock Produk</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text"><i class="ik ik-edit-1"></i></label>
                            </span>
                            <input type="text" id="tahun_datepicker" class="form-control  " name="tahun" id="tahun" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                style="width: 0%"></div>
                        </div>
                    </div>

                    <div class="footer-buttons">
                        <a class="fixedButtonRefresh" href="{{route('detail-product.index')}}">
                            <button data-toggle="tooltip" data-placement="top" title="" type="button"
                                class="btn btn-icon btn-secondary " data-original-title="Back">
                                <i class="ik ik-arrow-left"></i>
                            </button>
                        </a>
                        <a class="fixedButtonAdd">
                            <button data-toggle="tooltip" type="submit" data-placement="top" title="" href=""
                                class="btn btn-icon btn-info" data-original-title="Tambah">
                                <i class="ik ik-save"></i>
                            </button>
                        </a>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@endsection
@section('fixedButton')

@endsection
@section('footer')

<script src="{{url('assets/admin/plugins/select2/dist/js/select2.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/jquery.repeater/jquery.repeater.min.js')}}"></script>
<script src="{{url('assets/admin/plugins/mohithg-switchery/dist/switchery.min.js')}}"></script>
<script src="{{url('assets/admin/js/form-advanced.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    var SITEURL = "{{URL('/')}}";
    $(function () {
        uploadSuccess = function () {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Success',
                text: 'Jenis Produk berhasil ditambahkan',
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-right'
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
                        window.location.href = SITEURL + "/" + "admin-page/detail-product";
                    }, 3000);
                }
            });

        });
    });

</script>

<script>
    $("#datepicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });

    $("#tahun_datepicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
</script>

<script>

    $('#sisa').keyup(function(event) {
        if (event.which >= 37 && event.which <= 40) return;
        var number = $(this).val()
        $(this).val(format(number))
        $('.sisa').val(deformat($(this).val()))
    })

    $('#produksi').keyup(function(event) {
        if (event.which >= 37 && event.which <= 40) return;
        var number = $(this).val()
        $(this).val(format(number))
        $('.produksi').val(deformat($(this).val()))
    })

    $('#masuk').keyup(function(event) {
        if (event.which >= 37 && event.which <= 40) return;
        var number = $(this).val()
        $(this).val(format(number))
        $('.masuk').val(deformat($(this).val()))
    })

    $('#keluar_komersial').keyup(function(event) {
        if (event.which >= 37 && event.which <= 40) return;
        var number = $(this).val()
        $(this).val(format(number))
        $('.keluar_komersial').val(deformat($(this).val()))
    })

    $('#keluar_nonkomersial').keyup(function(event) {
        if (event.which >= 37 && event.which <= 40) return;
        var number = $(this).val()
        $(this).val(format(number))
        $('.keluar_nonkomersial').val(deformat($(this).val()))
    })

    function format(value){
        return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
    function deformat(value){
        var number = ''
        for (const c of value) {
            if (c != '.') {
                number += c;
            }
        }
        return number;
    }
</script>
@endsection
